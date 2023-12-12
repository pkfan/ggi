@extends('layout.master')
@section('title', 'Roles & Permissions')

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
                            <h2 class="content-header-title float-left mb-0">ROLES & PERMISSIONS</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.settings')}}">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active">Roles & Permissions
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
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <button class="btn btn-dark mr-1 waves-effect waves-float waves-light"
                                    style="padding: 8px 12px;" data-toggle="modal" data-target="#createRole">
                                    Add New Role
                                </button>
                                {{-- <a href="#" class="btn btn-warning mr-1 waves-effect waves-float waves-light" style="padding: 8px 12px;">
                                    Create Permission
                                </a> --}}
                            </div>
                            <x-admin::roles-permissions.create-role-modal id="createRole" />

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap"
                                                style="color: white;background: #4b4b4b;">Role</th>
                                            <th scope="col" class="text-nowrap"
                                                style="color: white;background: #4b4b4b;">Users</th>
                                            <th scope="col" class="text-nowrap"
                                                style="color: white;background: #4b4b4b;">Permissions</th>
                                            <th scope="col" class="text-nowrap"
                                                style="color: white;background: #4b4b4b;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->display_name }}</td>
                                                <td>{{ $role->users_count }}</td>
                                                @if ($role->name == 'super-admin' || $role->name == 'director' || $role->name == 'manager')
                                                <td>
                                                    <span style="
                                                    background: #9cff8a;
                                                    padding: 6px;border-radius: 50%;font-weight: 700;">
                                                        All
                                                    </span>
                                                    </td>
                                                @else
                                                    <td>{{ $role->permissions_count }}</td>
                                                @endif
                                                <td class="d-flex">

                                                    {{-- users  --}}
                                                    <a href="{{ route('admin.all-users-list', ['role' => $role->name]) }}"
                                                        class=" text-primary" style="margin-right:6px" data-toggle="tooltip"
                                                        data-placement="bottom" title="View {{$role->display_name}} list">
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M10.27 12h3.46a1.5 1.5 0 001.48-1.75l-.3-1.79a2.951 2.951 0 00-5.82.01l-.3 1.79c-.15.91.55 1.74 1.48 1.74zM1.66 11.11c-.13.26-.18.57-.1.88.16.69.76 1.03 1.53 1h1.95c.83 0 1.51-.58 1.51-1.29 0-.14-.03-.27-.07-.4-.01-.03-.01-.05.01-.08.09-.16.14-.34.14-.53 0-.31-.14-.6-.36-.82-.03-.03-.03-.06-.02-.1.07-.2.07-.43.01-.65a1.12 1.12 0 00-.99-.74.09.09 0 01-.07-.03C5.03 8.14 4.72 8 4.37 8c-.3 0-.57.1-.75.26-.03.03-.06.03-.09.02a1.24 1.24 0 00-1.7 1.03c0 .02-.01.04-.03.06-.29.26-.46.65-.41 1.05.03.22.12.43.25.6.03.02.03.06.02.09zM16.24 13.65c-1.17-.52-2.61-.9-4.24-.9-1.63 0-3.07.39-4.24.9A2.988 2.988 0 006 16.39V18h12v-1.61c0-1.18-.68-2.26-1.76-2.74zM1.22 14.58A2.01 2.01 0 000 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29-.37-.06-.74-.1-1.13-.1-.99 0-1.93.21-2.78.58zM22.78 14.58A6.95 6.95 0 0020 14c-.39 0-.76.04-1.13.1.4.68.63 1.46.63 2.29V18H24v-1.57c0-.81-.48-1.53-1.22-1.85zM22 11v-.5c0-1.1-.9-2-2-2h-2c-.42 0-.65.48-.39.81l.7.63c-.19.31-.31.67-.31 1.06 0 1.1.9 2 2 2s2-.9 2-2z"></path></svg>
                                                    </a>
                                                    @if ($role->name != 'super-admin')
                                                     {{-- permissions --}}
                                                        <a  class=" text-info" href="{{ route('admin.settings.roles.permissions', ['role_id' => $role->id]) }}"
                                                            class=" text-primary" style="margin-right:6px" data-toggle="tooltip"
                                                            data-placement="bottom" title="View Permissions List">
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M832 464H332V240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v68c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-68c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM540 701v53c0 4.4-3.6 8-8 8h-40c-4.4 0-8-3.6-8-8v-53a48.01 48.01 0 1 1 56 0z"></path></svg>
                                                        </a>
                                                    @endif
                                                    @if ($role->is_changeable)
                                                        {{-- edit --}}
                                                        <a href="#" user-role-id="{{ $role->id }}"
                                                            role-name="{{ $role->name }}"
                                                            role-display-name="{{ $role->display_name }}"
                                                            role-description="{{ $role->description }}"
                                                            onclick="updateUserRole(this);" class=" text-secondary"
                                                            data-toggle="modal" data-target="#updateRole"
                                                            style="margin-right:6px">
                                                            <span data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit Role">
                                                                <svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 576 512" height="18"
                                                                    width="18" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        {{-- delete --}}
                                                        {{-- <a href="{{ route('admin.settings.role.delete', ['role' => $role->id]) }}"
                                                            class=" text-danger" style="margin-right:6px"
                                                            data-toggle="tooltip" data-placement="bottom"
                                                            title="Delete Role">
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                                viewBox="0 0 24 24" height="18" width="18"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
                                                                </path>
                                                            </svg>
                                                        </a> --}}
                                                    @endif

                                                </td>





                                            </tr>
                                        @endforeach

                                        <x-admin::roles-permissions.update-role-modal id="updateRole" />

                                    </tbody>
                                </table>
                            </div>
                            {{-- <x-pagination :data="$claims" /> --}}
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection
