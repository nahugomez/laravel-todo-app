<h1>Todo App</h1>
<div>
    @isset($tasks)
        <ul>
            @foreach ($tasks as $task)
                <li>{{ $task->title }} - {{ $task->completed ? 'Done' : 'Pending' }} - <a
                        href="{{ route('task.show', ['id' => $task->id]) }}">Show</a></li>
            @endforeach
        </ul>
    @endisset
</div>
