<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item prev-item {{ $paginator->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url(1) }}" tabindex="-1" aria-disabled="true">
                << </a>
        </li>
        <li class="page-item prev-item {{ $paginator->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
                < </a>

        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @else
                @if ($i == 1 || $i == $paginator->lastPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#">{{ $i }}</a>
                    </li>
                @endif
            @endif
        @endfor
        <li class="page-item next-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                >
            </a>
        </li>
        <li class="page-item next-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                >>
            </a>
        </li>
    </ul>
</nav>
