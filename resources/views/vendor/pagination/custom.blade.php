
<!-- resources/views/vendor/pagination/custom.blade.php -->
<nav class="pagination">
    <ul class="pagination-list">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</nav>

@section('css')
    <style>


    .pagination {
        display: flex;
        justify-content: start;
        margin: 20px 0;
    }

    .pagination-list {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 10px;
    }

    .pagination-list li {
        display: inline;
    }

    .pagination-list a {
        text-decoration: none;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        color: #333;
    }

    .pagination-list .active span {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
        padding: 5px 15px;
        border-radius: 5px;
    }

    .pagination-list .disabled span {
        color: #ccc;
    }

    .pagination-list a:hover {
        background-color: #f0f0f0;
    }
    </style>
@endsection
