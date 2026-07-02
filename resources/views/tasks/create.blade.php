@extends('layouts.layout')

@section('title', 'Create Task')

@section('content')
    <div class="w-1/2 mx-auto">
        <h1 class="text-2xl font-bold mb-4">Create a New Task</h1>
        <div class="bg-white shadow-md rounded-2xl px-8 py-10 border border-gray-100">
            <form action="{{ route('handle.task.create') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Title
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
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
                        placeholder="Task details">{{ old('description') }}</textarea>
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
                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                        <option value="todo" {{ old('status') === 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
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
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" required
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
                    Create Task
                </button>
            </form>
        </div>
    </div>
@endsection
