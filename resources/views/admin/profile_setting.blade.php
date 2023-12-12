@extends('layout.master')
@section('title', 'Profile Setting')

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
                        <h2 class="content-header-title float-left mb-0">Account Settings</h2>

                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">General</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Change Password</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- header media -->
                                        {{-- <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">
                                                <img src="{{asset('app-assets/images/avatar.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                            </a>
                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <input type="file" id="account-upload" hidden accept="image/*" />
                                                <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div> --}}
                                        <!--/ header media -->

                                        <!-- form -->
                                        <form class=" mt-2" method="POST" action="{{route('admin.setting.general')}}">
                                            @csrf
                                            <div class="row">
                                                {{-- <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-username">Username</label>
                                                        <input type="text" class="form-control" id="account-username" name="username" value="johndoe" />
                                                    </div>
                                                </div> --}}
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-name">Name</label>
                                                        <input type="text" class="form-control" id="account-name" name="name" value="{{$user->name}}"  />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">E-mail</label>
                                                        <input type="email" class="form-control" id="account-e-mail" name="email" value="{{$user->email}}"  />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">Address</label>
                                                        <input type="text" class="form-control" id="account-e-mail" name="address" value="{{$user->address}}"  />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">Age</label>
                                                        <input type="number" class="form-control" id="account-e-mail" name="age" value="{{$user->age}}" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-e-mail">Phone Number</label>
                                                        <input type="phone" class="form-control" id="account-e-mail" name="phone" value="{{$user->phone}}" />
                                                    </div>
                                                </div>


                                                {{-- @if(!$user->email_verified_at)
                                                <div class="col-12 mt-75">
                                                    <div class="alert alert-warning mb-50" role="alert">
                                                        <h4 class="alert-heading">Your email is not confirmed. Please check your inbox.</h4>
                                                        <div class="alert-body">
                                                            <a href="javascript: void(0);" class="alert-link">Resend confirmation</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif --}}
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    {{-- <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button> --}}
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <form  action="{{url('user/change/password')}}" method="POST">
                                            @csrf
									<input  name="id" value="{{$user->id}}" type="hidden">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-old-password">Current Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-old-password" name="currentpassword" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer btn-outline-secondary">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('currentpassword')<span class="text-danger">Required</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-new-password">New Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" id="account-new-password" name="newpassword" class="form-control" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer btn-outline-secondary">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('newpassword')<span class="text-danger">Required</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-retype-new-password">Retype New Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-retype-new-password" name="conpassword" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer btn-outline-secondary"><i data-feather="eye"></i></div>
                                                            </div>
                                                        </div>
                                                        @error('conpassword')<span class="text-danger">Required</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                                    {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button> --}}
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->



                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('profile-setting-css')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
<!-- END: Page CSS-->
@endpush

@push('profile-setting-js')
<!-- BEGIN: Page Vendor JS-->
{{-- <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script> --}}
<script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/page-account-settings.js')}}"></script>
<!-- END: Page JS-->
@endpush
