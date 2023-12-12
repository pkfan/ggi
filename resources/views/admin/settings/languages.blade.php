@extends('layout.master')
@section('title', 'Languages')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">LANGUAGES</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.settings') }}">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active">Languages
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <x-form-errors-alert />

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <form method="POST" action="{{ route('admin.settings.languages.set') }}">
                            @csrf
                            <div class="card">
                                <div class="card-header ">
                                    <h4>Choose Language:</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="language-options checkbox">
                                        @foreach ($languages as $language)
                                            <div class="custom-control custom-radio mb-50">
                                                <input type="radio" id="{{ $language['code'] }}--language"
                                                    name="language_code"
                                                    value="{{ $language['code'] }}"
                                                    class="custom-control-input i18n-lang-option" data-lng="en_p"
                                                    @if ($language['is_active']) checked @endif>
                                                <label class="custom-control-label"
                                                    for="{{ $language['code'] }}--language">{{ $language['language'] }}</label>
                                            </div>
                                        @endforeach
                                        {{-- <div class="custom-control custom-radio mb-50">
                                            <input type="radio" id="i18n-lang-radio2" name="i18n-lang-radios" class="custom-control-input i18n-lang-option" data-lng="fr_p">
                                            <label class="custom-control-label" for="i18n-lang-radio2">Arabic</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-50">
                                            <input type="radio" id="i18n-lang-radio3" name="i18n-lang-radios" class="custom-control-input i18n-lang-option" data-lng="de_p">
                                            <label class="custom-control-label" for="i18n-lang-radio3">Urdu</label>
                                        </div> --}}

                                    </div>

                                    <h3>@lang('test.language')</h3>
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                                        Save Changes
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
