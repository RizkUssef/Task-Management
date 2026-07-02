<nav class="bg-white border-b border-gray-200 px-6 py-4 w-full">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-xl font-extrabold text-indigo-600">
            {{ app('currentTenant')->name ?? config('app.name') }}
        </a>

        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('tasks') }}">Tasks</a>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('handle.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>