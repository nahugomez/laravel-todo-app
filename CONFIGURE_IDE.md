# ⚙️ Configuración de VS Code para Laravel Sail (WSL)

Esta guía explica cómo configurar **Visual Studio Code** para trabajar correctamente con un entorno de **Laravel Sail** corriendo dentro de **WSL (Ubuntu)**.

El objetivo es que VS Code utilice el PHP y las herramientas que están dentro del contenedor de Docker, en lugar de buscar herramientas que no existen en tu máquina local.

## 1. 🧩 Conexión Correcta (WSL)

Para que las extensiones funcionen, **VS Code debe estar conectado al subsistema de Linux**, no simplemente editando archivos desde Windows.

1. Abre tu proyecto.
2. Mira la esquina inferior izquierda de VS Code (barra de estado azul/morada).
3. Debe decir: `>< WSL: Ubuntu`.

Si solo ves el icono `><` o no dice “WSL”, haz clic ahí y selecciona:

> **Reopen Folder in WSL** (o **New WSL Window**)

## 2. 🔌 Extensiones Recomendadas

Estas son las extensiones esenciales que deben instalarse **en el entorno WSL**:

| Extensión                      | Descripción                                                                           |
| ------------------------------ | ------------------------------------------------------------------------------------- |
| **PHP Intelephense**           | Motor principal de inteligencia para PHP. Autocompletado rápido y análisis de código. |
| **Laravel Extra Intellisense** | Autocompletado específico de Laravel (rutas, vistas, configuraciones).                |
| **Laravel Blade Snippets**     | Atajos para sintaxis Blade (`b:foreach`, etc.).                                       |
| **Laravel Blade Formatter**    | Formateo automático de HTML/Blade.                                                    |
| **Laravel goto view**          | Permite ir a la vista con `Ctrl + Click` sobre `view('home')`.                        |
| **Tailwind CSS IntelliSense**  | Autocompletado de clases de Tailwind.                                                 |
| **SQLite Viewer**              | Para inspeccionar bases de datos SQLite (útil en testing).                            |

## 3. ⚙️ Configuración Crítica (`settings.json`)

Para evitar errores como `php not found` o problemas de rutas con Docker, debemos configurar VS Code para que "hable" con Sail.

Abre tu configuración de usuario:

> `Ctrl + Shift + P` → **Preferences: Open User Settings (JSON)**

Agrega o ajusta estas líneas:

```json
{
    // 1. Desactivar el validador nativo de PHP (muy básico)
    "php.validate.enable": false,

    // 2. Usar el PHP dentro del contenedor Sail (Docker)
    "LaravelExtraIntellisense.phpCommand": "./vendor/bin/sail php -r \"{code}\"",

    // 3. Mapear la ruta: VS Code vs Docker
    "LaravelExtraIntellisense.basePath": "/var/www/html"
}
```

> 💡 **Nota:** Sin el punto 3, verás errores como
> `vendor/autoload.php not found`,
> ya que Docker no conoce la ruta de tu usuario en Linux.

## 4. 🧠 Laravel IDE Helper (Autocompletado “Mágico”)

Laravel usa mucha "magia" (Facades) que VS Code no entiende por defecto (ej: `Route::get`).
Para que no marque todo en rojo y ofrezca autocompletado, instala el paquete de ayuda:

```bash
sail composer require --dev barryvdh/laravel-ide-helper
```

Luego genera el archivo de ayuda:

```bash
sail artisan ide-helper:generate
```

> 🔁 Cada vez que agregues **nuevos paquetes o modelos**, vuelve a correr `ide-helper:generate`.

## 5. ⚡ Alias de Sail (Opcional pero recomendado)

Para no escribir `./vendor/bin/sail` todo el tiempo:

```bash
echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.bashrc && source ~/.bashrc
```

Ahora puedes usar comandos cortos:

```bash
sail up -d       # Iniciar contenedor
sail down        # Detener contenedor
sail artisan migrate  # Migraciones
```

✅ **Con esto, VS Code estará completamente integrado con Laravel Sail en WSL.**
