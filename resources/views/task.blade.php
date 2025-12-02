@extends('layouts.app')
@section('title', $task->title)
@section('content')
    @if (session('success'))
        <div style="color: green; margin-bottom: 1.5rem;">{{ session('success') }}</div>
    @endif
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>{{ $task->long_description }}</p>
    <p>{{ $task->completed ? 'Done' : 'Pending' }}</p>
    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('task.index') }}">Back to List</a>
        <a href="{{ route('task.edit', ['task' => $task]) }}">Edit</a>
        <form action="{{ route('task.destroy', ['task' => $task]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
