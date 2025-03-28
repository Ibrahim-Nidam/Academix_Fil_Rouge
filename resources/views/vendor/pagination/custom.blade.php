@if ($paginator->hasPages())
    <div class="flex flex-wrap justify-between items-center mt-4">
        <div class="flex space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Previous</a>
            @endif

            @php
                $current = $paginator->currentPage();
                $last    = $paginator->lastPage();
                $adjacent = 2;

                $start = max($current - $adjacent, 1);
                $end   = min($current + $adjacent, $last);
            @endphp

            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}" class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">1</a>
                @if ($start > 2)
                    <span class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">...</span>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <span class="px-3 py-1 rounded bg-primary-accent text-white text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">{{ $page }}</a>
                @endif
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <span class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">...</span>
                @endif
                <a href="{{ $paginator->url($last) }}" class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">{{ $last }}</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Next</a>
            @else
                <span class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Next</span>
            @endif
        </div>
    </div>
@endif