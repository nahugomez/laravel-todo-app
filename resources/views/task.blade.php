@extends('layouts.app')
@section('title', $task->title)
@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>{{ $task->long_description }}</p>
    <p>{{ $task->completed ? 'Done' : 'Pending' }}</p>
    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
    <a href="{{ route('task.index') }}">Back to List</a>
@endsection
