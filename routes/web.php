<?php

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\TaskRequest;
use App\Models\Task;

# -------------------------------
# Routes
# -------------------------------

# Get all tasks
Route::get('/', function () {
    return view('index', [
        'tasks' => Task::all(),
    ]);
})->name('task.index');

# Create a new task view
Route::view('/tasks/create', 'create')->name('task.create');

# Edit a task view
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task,
    ]);
})->name('task.edit');

# Get a specific task
Route::get('/tasks/{task}', function (Task $task) {
    return view('task', [
        'task' => $task,
    ]);
})->name('task.show');

# Store a new task
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    # Redirect to the task details
    return redirect()->route('task.show', ['task'=> $task])->with('success', 'Task created successfully');
})->name('task.store');

# Update a task
Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
    $task->update($request->validated());

    # Redirect to the task details
    return redirect()->route('task.show', ['task'=> $task])->with('success', 'Task updated successfully');
})->name('task.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    # Redirect to the task list after deleting the task
    return redirect()->route('task.index')->with('success', 'Task deleted successfully');
})->name('task.destroy');

# Handle fallback routes
Route::fallback(function () {
    return abort(Response::HTTP_NOT_FOUND);
});
