@props([
    'label' => '',
    'name' => 'officer_id',
    'onchange'=>"",
    'default' => '--select officer--'
])

<div class="w-100">
    @php
        $officers = \App\Models\User::whereHasRole('officer')->get();
    @endphp
    <div class="form-group">
        @if ($label)
            <label>{{ $label }}: </label>
        @endif
        <div data-select2-id="187" class=" ">
            <div class="position-relative " data-select2-id="186">
                <select name='{{ $name }}'
                    class=" select2 btn btn-outline-secondary btn-sm waves-effect form-control select2-hidden-accessible dropdown-toggle"
                    data-select2-id="16"
                    tabindex="-1"
                    aria-hidden="true"
                    onchange="{{$onchange}}"
                >
                    <option value="" data-select2-id="all">{{$default}}</option>
                    @foreach ($officers as $officer)
                        <option value="{{ $officer->id }}" data-select2-id="{{ $officer->id }}">
                            {{ $officer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
