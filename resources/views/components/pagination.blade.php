@props([
    'data' => null
])

@if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
<nav aria-label="...">
    <ul class="pagination">
    {!! $data->links() !!}

    </ul>
</nav>
@endif
