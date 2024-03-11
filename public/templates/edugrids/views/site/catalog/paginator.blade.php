@if($pageCount  && $pageCount > 1)

    <!-- Pagination -->
    <div class="pagination center">
        <ul class="pagination-list">
            @if(isset($previous))
            <li><a href="{{ $route }}?{{ http_build_query(array_merge($_GET,array('page' => $previous))) }}">&laquo;</a></li>
            @else
                <li class="disabled"><a href="javascript:void(0)" class="disabled">&laquo;</a></li>
            @endif
                @foreach($pagesInRange as $page)
            @if($page != $current)
                <li><a href="{{ $route }}?{{ http_build_query(array_merge($_GET,array('page' => $page))) }}">{{ $page }}</a></li>
                @else
            <li class="active "><a href="javascript:void(0)">{{ $page }}</a></li>
            @endif
                @endforeach

                @if(isset($next))
            <li><a href="{{ $route }}?{{ http_build_query(array_merge($_GET,array('page' => $next))) }}">&raquo;</a></li>
                @else
                    <li><a href="javascript:void(0)">&raquo;</a></li>
                @endif

        </ul>
    </div>
    <!--/ End Pagination -->






@endif

