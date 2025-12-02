@extends('layouts.app')
@section('title', 'List of Tasks')
@section('content')
    <h1>Todo App</h1>
    @if (session('success'))
        <div style="color: green; margin-bottom: 1.5rem;">{{ session('success') }}</div>
    @endif
    <div>
        @isset($tasks)
            <ul>
                @foreach ($tasks as $task)
                    <li>{{ $task->title }} - {{ $task->completed ? 'Done' : 'Pending' }} - <a
                            href="{{ route('task.show', ['task' => $task]) }}">Show</a></li>
                @endforeach
            </ul>
        @endisset
        <a href="{{ route('task.create') }}">Create New Task</a>
    </div>
@endsection
