@extends('layouts.layout')

@section('title', 'Task')

@section('content')
    {{-- Card --}}
    <div class="bg-white w-1/2 shadow-md rounded-2xl border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 border-b border-gray-100 flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h1>

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
                    class="inline-block mt-2 text-xs font-medium px-2.5 py-1 rounded-full {{ $statusStyles[$task->status] }}">
                    {{ $statusLabels[$task->status] }}
                </span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
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

        {{-- Body --}}
        <div class="px-8 py-6 space-y-6">

            <div>
                <h2 class="text-sm font-medium text-gray-500 mb-2">Description</h2>
                <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $task->description }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                <div>
                    <h2 class="text-sm font-medium text-gray-500 mb-1">Due Date</h2>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500 mb-1">Created</h2>
                    <p class="text-gray-800">{{ $task->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
