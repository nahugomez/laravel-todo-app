<?php

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

# -------------------------------
# Routes
# -------------------------------

Route::get('/', function () {
    return view('index', [
        'tasks' => Task::all(),
    ]);
})->name('task.index');

Route::get('/task/{id}', function ($id) {
    return view('task', [
        'task' => Task::findOrFail($id),
    ]);
})->name('task.show');

Route::fallback(function () {
    return abort(Response::HTTP_NOT_FOUND);
});
