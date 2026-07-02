@if ($paginator->hasPages())
    <div class="flex items-center justify-center gap-10 px-2">

        {{-- Results text --}}
        <p class="text-sm text-gray-500">
            Showing
            <span class="font-medium text-gray-700">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-medium text-gray-700">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-medium text-gray-700">{{ $paginator->total() }}</span>
            results
        </p>

        {{-- Page navigation --}}
        <nav class="flex items-center gap-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-9 h-9 rounded-lg text-gray-300 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span
                        class="w-9 h-9 flex items-center justify-center text-sm text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="w-9 h-9 flex items-center justify-center text-sm font-semibold bg-indigo-600 text-white rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="w-9 h-9 flex items-center justify-center text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="flex items-center justify-center w-9 h-9 rounded-lg text-gray-300 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </nav>
    </div>
@endif
