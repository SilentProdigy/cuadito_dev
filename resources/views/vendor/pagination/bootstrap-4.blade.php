@if ($paginator->hasPages())
    <nav>
        <ul class="pagination mb-0 align-items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item " aria-disabled="true" aria-label="@lang('pagination.previous')">
                    {{-- <span class="page-link" aria-hidden="true">&lsaquo;</span> --}}
                    <span class="page-link p-1 text-black bg-transparent" aria-hidden="true">Previous</span>
                </li>
            @else
                <li class="page-item bg-transparent" >
                    <a class="page-link bg-transparent text-black" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item " aria-disabled="true"><span class="page-link fw-lighter">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active " aria-current="page"><span class="page-link text-black font-lighter px-2 py-0 fw-normal">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link text-black fw-normal" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-black fw-normal bg-transparent" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    {{-- <span class="page-link" aria-hidden="true">&rsaquo;</span> --}}
                    <span class="page-link fw-normal bg-transparent text-black" aria-hidden="true">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
