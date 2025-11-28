<?php

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

# -------------------------------
# Example Tasks
# -------------------------------
class Task
{
    public function __construct(public int $id, public string $title, public string $description, public ?string $long_description, public bool $completed, public string $created_at, public string $updated_at) {}
}

$tasks = [
    new Task(1, 'Buy groceries', 'Task 1 description', 'Task 1 long description', false, '2023-03-01 12:00:00', '2023-03-01 12:00:00'),
    new Task(2, 'Sell old stuff', 'Task 2 description', 'Task 2 long description', false, '2023-03-02 12:00:00', '2023-03-02 12:00:00'),
    new Task(3, 'Learn Laravel', 'Task 3 description', 'Task 3 long description', true, '2023-03-03 12:00:00', '2023-03-03 12:00:00'),
    new Task(4, 'Learn PHP', 'Task 4 description', 'Task 4 long description', true, '2023-03-04 12:00:00', '2023-03-04 12:00:00'),
    new Task(5, 'Learn Vue.js', 'Task 5 description', 'Task 5 long description', false, '2023-03-05 12:00:00', '2023-03-05 12:00:00'),
    new Task(6, 'Learn React.js', 'Task 6 description', 'Task 6 long description', false, '2023-03-06 12:00:00', '2023-03-06 12:00:00'),
    new Task(7, 'Learn Angular.js', 'Task 7 description', 'Task 7 long description', false, '2023-03-07 12:00:00', '2023-03-07 12:00:00'),
    new Task(8, 'Learn Svelte.js', 'Task 8 description', 'Task 8 long description', false, '2023-03-08 12:00:00', '2023-03-08 12:00:00'),
    new Task(9, 'Learn Node.js', 'Task 9 description', 'Task 9 long description', false, '2023-03-09 12:00:00', '2023-03-09 12:00:00'),
    new Task(10, 'Learn Express.js', 'Task 10 description', 'Task 10 long description', false, '2023-03-10 12:00:00', '2023-03-10 12:00:00'),
];

# -------------------------------
# Routes
# -------------------------------

Route::get('/', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks,
    ]);
})->name('task.index');

Route::get('/task/{id}', function ($id) use ($tasks) {
    $task = collect($tasks)->firstWhere('id', $id);

    if (!$task) {
        return abort(Response::HTTP_NOT_FOUND);
    }

    return view('task', [
        'task' => $task,
    ]);
})->name('task.show');

Route::fallback(function () {
    return 'Page Not Found';
});
