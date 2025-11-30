<?php

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

# Get a specific task
Route::get('/tasks/{id}', function ($id) {
    return view('task', [
        'task' => Task::findOrFail($id),
    ]);
})->name('task.show');

# Store a new task
Route::post('/tasks', function (Request $request) {
    # Validate the request
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'long_description' => 'required|string',
    ]);

    # Create the task
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    # Redirect to the task details
    return redirect()->route('task.show', ['id'=> $task->id]);
})->name('task.store');

# Handle fallback routes
Route::fallback(function () {
    return abort(Response::HTTP_NOT_FOUND);
});
