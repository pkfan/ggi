@extends('layout.master')
@section('title', 'settings')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0" style="border-right: none;">ALL SETTINGS</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">


                <div class="row">
                    {{-- roles and permissions  --}}
                    @role('super-admin|director|manager')
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ route('admin.settings.roles') }}">
                                <div class="p-1 card text-center card-hover-light-blue waves-effect waves-float waves-dark" style= "border: 1px solid gainsboro; border-top: 4px solid #4b4b4b;" >
                                    <div class="card-body" style="padding-left: 0; padding-right: 0;">
                                        <div class="avatar bg-dark p-50 mb-1">
                                            <div class="avatar-content">
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 16 16" height="40" width="40"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1V1Z">
                                                    </path>
                                                    <path
                                                        d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <h4 class="font-weight-bolder">Roles &amp; Permissions</h4>
                                        <p class="text-secondary">edit, change roles and permissions for users</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endrole

                    {{-- languages (localizations) --}}
                    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{route('admin.settings.languages')}}">
                            <div class="p-1 card text-center card-hover-light-blue waves-effect waves-float waves-dark" style= "border: 1px solid gainsboro; border-top: 4px solid #4b4b4b;" >
                                <div class="card-body" style="padding-left: 0; padding-right: 0;">
                                    <div class="avatar bg-dark p-50 mb-1">
                                        <div class="avatar-content">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 24 24" height="40" width="40"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="none" stroke-width="2"
                                                    d="M12,23 C18.0751322,23 23,18.0751322 23,12 C23,5.92486775 18.0751322,1 12,1 C5.92486775,1 1,5.92486775 1,12 C1,18.0751322 5.92486775,23 12,23 Z M12,23 C15,23 16,18 16,12 C16,6 15,1 12,1 C9,1 8,6 8,12 C8,18 9,23 12,23 Z M2,16 L22,16 M2,8 L22,8">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="font-weight-bolder">Languages</h4>
                                    <p class="text-secondary">change languages i.e arabic, english</p>

                                </div>
                            </div>
                        </a>
                    </div> --}}
                    {{-- payments gateways --}}
                    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="#">
                            <div class="p-1 card text-center card-hover-light-blue waves-effect waves-float waves-dark" style= "border: 1px solid gainsboro; border-top: 4px solid #4b4b4b;" >
                                <div class="card-body" style="padding-left: 0; padding-right: 0;">
                                    <div class="avatar bg-dark p-50 mb-1">
                                        <div class="avatar-content">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 512 512" height="40" width="40"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="font-weight-bolder">Payments Setting</h4>
                                    <p class="text-secondary">Integrate and handle all payments methods</p>

                                </div>
                            </div>
                        </a>
                    </div> --}}


                </div>



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection
