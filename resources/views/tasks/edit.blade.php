@extends('layouts.layout')

@section('title', 'Edit Task')

@section('content')
    <a href="{{ route('tasks.show', $task) }}"
        class="inline-flex items-start mr-auto gap-1 text-sm font-medium text-gray-500 hover:text-indigo-600 transition mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>Back to task</a>
    <div class="w-1/2 mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Task</h1>
        <p class="text-gray-500 mt-2 mb-5">Update the task details</p>

        {{-- Card --}}
        <div class="bg-white shadow-md rounded-2xl px-8 py-10 border border-gray-100">

            <x-alert />

            <form action="{{ route('handle.task.update', $task) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Title
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border @error('title') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-400 text-gray-900"
                        placeholder="Task title" />
                    @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-4 py-2.5 rounded-lg border @error('description') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition placeholder-gray-400 text-gray-900"
                        placeholder="Task details">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-2.5 rounded-lg border @error('status') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition text-gray-900 bg-white">
                        @php $currentStatus = old('status', $task->status); @endphp
                        <option value="todo" {{ $currentStatus === 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ $currentStatus === 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="done" {{ $currentStatus === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Due Date
                    </label>
                    <input type="date" name="due_date" id="due_date"
                        value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border @error('due_date') border-red-400 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   transition text-gray-900" />
                    @error('due_date')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium
                               py-2.5 rounded-lg transition duration-200 shadow-sm
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Task
                </button>
            </form>
        </div>
    </div>
@endsection
