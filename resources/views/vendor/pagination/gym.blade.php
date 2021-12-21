@if ($paginator->hasPages())
    <div class="blog-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:void(0)" class="d-none">&lsaquo;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="javascript:void(0)" style="color:#f36100;">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
        @else
            <a href="javascript:void(0)" class="d-none">&rsaquo;</a>
        @endif
    </div>
@endif
