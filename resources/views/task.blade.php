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
    <a href="{{ route('task.index') }}">Back to List</a>
    <a href="{{ route('task.edit', ['task' => $task]) }}">Edit</a>
@endsection
