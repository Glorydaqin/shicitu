@if ($paginator->hasPages())
    <div class="pagenavi_txt">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:false;"> «</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="extend"> «</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="javascript:false;" class="current">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="javascript:false;" class="current">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="extend">&raquo;</a>
        @else
            <a href="javascript:false;">&raquo;</a>
        @endif
    </div>
@endif
