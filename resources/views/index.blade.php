@extends('layouts.app')
@section('title', 'List of Tasks')
@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Todo App</h1>
            <p class="text-gray-600">Manage your tasks efficiently</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tasks List -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            @isset($tasks)
                @if($tasks->count() > 0)
                    <ul class="space-y-3">
                        @foreach ($tasks as $task)
                            <li class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center space-x-3 flex-1">
                                    <span class="text-gray-800 font-medium">{{ $task->title }}</span>
                                    @if($task->completed)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Done</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Pending</span>
                                    @endif
                                </div>
                                <a href="{{ route('task.show', ['task' => $task]) }}" 
                                   class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                                    Show
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center py-8">No tasks yet. Create your first task!</p>
                @endif
            @else
                <p class="text-gray-500 text-center py-8">No tasks available.</p>
            @endisset
        </div>

        <!-- Create New Task Button -->
        <div class="text-center">
            <a href="{{ route('task.create') }}" 
               class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">
                + Create New Task
            </a>
        </div>
    </div>
@endsection
