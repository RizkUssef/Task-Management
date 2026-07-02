@extends('layouts.layout')

@section('title', 'All Tasks')

@section('content')

    <div class="w-full">
        <h1 class="text-2xl font-bold mb-4">All Tasks</h1>
        @if ($tasks->isEmpty())
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-8 py-16 text-center">
                <p class="text-gray-500">No tasks yet. Create your first one to get started.</p>
            </div>
        @else
            <div class="flex items-center justify-center gap-5 flex-wrap divide-y divide-gray-100 overflow-hidden">
                @foreach ($tasks as $task)
                    <div onclick="window.location.href='{{ route('tasks.show', ['task' => $task]) }}'" class="flex items-center justify-between px-6 py-5 border cursor-pointer border-gray-100 rounded-2xl shadow-sm bg-white hover:bg-gray-50 transition w-100">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-base font-semibold text-gray-900 truncate">
                                    {{ $task->title }}
                                </h3>

                                @php
                                    $statusStyles = [
                                        'todo' => 'bg-gray-100 text-gray-700',
                                        'in_progress' => 'bg-yellow-100 text-yellow-700',
                                        'done' => 'bg-green-100 text-green-700',
                                    ];
                                    $statusLabels = [
                                        'todo' => 'To Do',
                                        'in_progress' => 'In Progress',
                                        'done' => 'Done',
                                    ];
                                @endphp
                                <span
                                    class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusStyles[$task->status] }}">
                                    {{ $statusLabels[$task->status] }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-500 truncate">{{ $task->description }}</p>

                            <p class="text-xs text-gray-400 mt-1">
                                Due {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2 ml-4">
                            <a href="{{ route('task.edit', $task) }}"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                Edit
                            </a>
                            <form action="{{ route('home') }}" method="POST"
                                onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>
        <div class="ml-auto">
        <a href="{{ route('task.create') }}"
            class="text-sm font-medium bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            Create Task
        </a>
    </div>
@endsection
