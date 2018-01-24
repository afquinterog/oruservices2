@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button previous disabled">
                <a href="#"><i class="icon wb-chevron-left-mini"></i></a>
            </li>
        @else
            <li class="paginate_button">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="icon wb-chevron-left-mini"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li class="paginate_button"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="icon wb-chevron-right-mini"></i>
                </a>
            </li>
        @else
            <li class="paginate_button disabled">
                <a href="#"><i class="icon wb-chevron-right-mini"></i></a>
            </li>
        @endif
    </ul>
@endif
