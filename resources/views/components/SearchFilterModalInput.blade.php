@props([
    'title'=>'title here',
    'name'=>'',
    'id'=>''
])

<div class="col-xl-4 col-md-6 col-sm-12 mb-2">
    <label for="credit-card">{{$title}}</label>
    <input type="text"
        name="{{$name}}"
        class="form-control credit-card-mask"
        placeholder="{{$title}}" id="{{$id}}" />
</div>
