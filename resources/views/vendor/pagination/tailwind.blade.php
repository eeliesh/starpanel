@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        <div class="previous">
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span class="material-icons">arrow_back</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <span class="material-icons">arrow_back</span>
                </a>
            @endif
        </div>

        {{-- Pagination Elements --}}
        <div class="pages">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        <div class="next">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                    <span class="material-icons">arrow_forward</span>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="material-icons">arrow_forward</span>
                </span>
            @endif
        </div>

        <div class="text">
            <p>
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span>
                        <strong>{{ $paginator->firstItem() }}</strong>
                    </span>
                    {!! __('to') !!}
                    <span>
                        <strong>{{ $paginator->lastItem() }}</strong>
                    </span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span>
                    <strong>{{ $paginator->total() }}</strong>
                </span>
                {!! __('results') !!}
            </p>
        </div>
    </nav>
@endif
