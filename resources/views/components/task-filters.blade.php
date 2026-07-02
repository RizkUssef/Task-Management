<form method="GET" action="{{ route('tasks') }}" class="flex flex-col sm:flex-row gap-3 mb-6">

    {{-- Search by title --}}
    <div class="flex-1 relative">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..."
            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                   transition text-gray-400 placeholder-gray-700" />
    </div>

    {{-- Filter by status --}}
    <select name="status" onchange="this.form.submit()"
        class="px-4 py-2.5 rounded-lg border border-gray-300
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               transition text-gray-900 bg-white">
        <option value="">All Statuses</option>
        <option value="todo" {{ request('status') === 'todo' ? 'selected' : '' }}>To Do</option>
        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>
    </select>

    <button type="submit"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition shadow-sm">
        Filter
    </button>

    @if (request('search') || request('status'))
        <a href="{{ route('tasks') }}"
            class="flex items-center justify-center text-sm font-medium text-gray-500 hover:text-red-500 transition px-3">
            Clear
        </a>
    @endif
</form>
