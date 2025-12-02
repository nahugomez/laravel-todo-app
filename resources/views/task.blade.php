@extends('layouts.app')
@section('title', $task->title)
@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Task Detail Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-white">{{ $task->title }}</h1>
                    @if($task->completed)
                        <span class="px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded-full shadow-lg">
                            ✓ Done
                        </span>
                    @else
                        <span class="px-4 py-2 bg-yellow-400 text-gray-800 text-sm font-semibold rounded-full shadow-lg">
                            ⏱ Pending
                        </span>
                    @endif
                </div>
            </div>

            <!-- Content Section -->
            <div class="px-8 py-6">
                <!-- Description -->
                @if($task->description)
                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Description</h2>
                        <p class="text-gray-800 text-lg">{{ $task->description }}</p>
                    </div>
                @endif

                <!-- Long Description -->
                @if($task->long_description)
                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Details</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $task->long_description }}</p>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium mr-2">Created:</span>
                        <span>{{ $task->created_at->format('M d, Y - H:i') }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span class="font-medium mr-2">Updated:</span>
                        <span>{{ $task->updated_at->format('M d, Y - H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-8 py-4 flex flex-wrap items-center justify-between gap-3">
                <a href="{{ route('task.index') }}" 
                   class="px-5 py-2.5 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    ← Back to List
                </a>
                
                <div class="flex flex-wrap gap-3">
                    <!-- Toggle Button -->
                    <form action="{{ route('task.toggle', ['task' => $task]) }}" method="post" class="inline">
                        @csrf
                        @method('put')
                        <button 
                            type="submit"
                            class="px-5 py-2.5 {{ $task->completed ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg">
                            {{ $task->completed ? 'Mark as Pending' : 'Mark as Done' }}
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <a href="{{ route('task.edit', ['task' => $task]) }}" 
                       class="px-5 py-2.5 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors shadow-md hover:shadow-lg">
                        Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('task.destroy', ['task' => $task]) }}" method="post" class="inline">
                        @csrf
                        @method('delete')
                        <button 
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this task?')"
                            class="px-5 py-2.5 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-colors shadow-md hover:shadow-lg">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
