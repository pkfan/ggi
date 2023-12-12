@props([
    'message' => ''
])

<div style="
    display: flex;
    flex-direction: column;
    align-items: center;
">

    <div style="width: 100%;text-align: center;">

        <img src="{{asset('not-found.png')}}" alt="not found" style="width: 40%;">

    </div>
    @if ($message)
        <h3>{{$message}}</h3>
    @else
        <h3>There are no records</h3>
    @endif

</div>
