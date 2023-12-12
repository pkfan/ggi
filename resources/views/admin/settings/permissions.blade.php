@extends('layout.master')
@section('title', 'Permissions')

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
                            <h2 class="content-header-title float-left mb-0">{{ strtoupper($role->display_name) }} PERMISSIONS</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.settings')}}">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.settings.roles')}}">Roles & Permissions</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Permissions
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                <div class="row">
                    @foreach ($permissionTypes as $type => $permissions)
                        <div class="col-md-6 col-lg-4">
                            <form method="POST" action="{{route('admin.settings.role.permissions')}}">
                            @csrf
                            <input type="hidden" name="permissions_type" value="{{$type}}">
                            <input type="hidden" name="role_id" value="{{$role->id}}">

                            <div class="card mb-3">
                                <div class="card-header" style="background: #a3f2ff;display: flex;justify-content: center;">
                                    <h4 class="card-title">{{ ucfirst($type) }} Permissions</h4>
                                </div>



                                <div class="card-body p-1">
                                    @foreach ($permissions as $permission)
                                        {{-- switch  --}}
                                        <div class="custom-control custom-switch custom-switch-success" style="padding: 4px 0;">

                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="{{$permission->name}}"
                                                name="permissions[]"
                                                value="{{$permission->name}}"
                                                @if ($permission->hasPermission)
                                                    checked
                                                @endif
                                            >
                                            <label class="custom-control-label" for="{{$permission->name}}">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-check">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6" y2="18">
                                                        </line>
                                                        <line x1="6" y1="6" x2="18" y2="18">
                                                        </line>
                                                    </svg></span>
                                            </label>
                                            <span
                                                style="font-weight: bold; font-size: 16px;">{{ $permission->display_name }}</span>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="card-footer text-muted d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark mr-1 waves-effect waves-float waves-light"
                                        style="padding: 8px 12px;">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    @endforeach


                </div>



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection
