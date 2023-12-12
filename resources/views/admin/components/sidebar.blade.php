<x-sidebar-parent>
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item @if (request()->routeIs('AdminDashboard')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('AdminDashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboards">@lang('language.Dashboards')</span></a>

        </li>
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">@lang('language.Apps Pages')</span><i
                data-feather="more-horizontal"></i>
        </li>


        <li class=" nav-item @if (request()->routeIs([
                'AdminViewClaims',
                'admin.add-claim',
                'rejectclaims',
                'adminapprovedclaims',
                'admin.view-claims-remarks',
                'admin.officers.discount.requests',
                'admin.officers.discounts.list',
                'admin.claims.discount.history',
                'admin.request.change.status.list'
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='file-text'></i><span class="menu-title text-truncate"
                    data-i18n="eCommerce">@lang('language.Claims Request')</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center @if (request()->routeIs('AdminViewClaims')) active @endif"
                        href="{{ route('AdminViewClaims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Shop">@lang('language.All Request')</span></a>
                </li>
                @permission('add-claim')
                    <li><a class="d-flex align-items-center @if (request()->routeIs('admin.add-claim')) active @endif"
                            href="{{ route('admin.add-claim') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Add Claim')</span></a>
                    </li>
                @endpermission
                @permission('bulk-import-claims')
                    <li><a class="d-flex align-items-center @if (request()->routeIs('bulkClaimReg')) active @endif"
                            href="{{ route('bulkClaimReg') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Import Bulk Claims')</span></a>
                    </li>
                @endpermission
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.officers.discount.requests')) active @endif"
                        href="{{ route('admin.officers.discount.requests') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Discount Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.claims.discount.history')) active @endif"
                    href="{{ route('admin.claims.discount.history') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Shop">@lang('language.Discount History')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.officers.discounts.list')) active @endif"
                        href="{{ route('admin.officers.discounts.list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Officer Discounts List')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('rejectclaims')) active @endif"
                        href="{{ route('rejectclaims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Rejected Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminapprovedclaims')) active @endif"
                        href="{{ route('adminapprovedclaims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Wish List">@lang('language.Approved Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminReassignedClaim')) active @endif"
                        href="{{ route('adminReassignedClaim') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Wish List">@lang('language.Reassign Claims')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminReassignedClaim')) active @endif"
                        href="{{ route('adminReassignedClaim') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Wish List">@lang('language.Status Request')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.view-claims-remarks')) active @endif" href="{{route('admin.view-claims-remarks')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Checkout">@lang('language.Claim Remarks')</span></a>
                </li> --}}
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('AdminViewClaims')) active @endif" href="{{route('AdminViewClaims')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Checkout">@lang('language.Claim Beta')</span></a>
                </li> --}}
            </ul>
        </li>
        <li class=" nav-item @if (request()->routeIs([
                'admin.elm-status',
                'admin.sms-response',
                'callstatus',
                'admin.check-call-demo',
                'responseRefused',
                'RespondObjection',
                'CompanyObjection',
                'ValidObjection',
                'InValidObjection',
                'AdminCaseCloseObjection',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='phone-call'></i><span class="menu-title text-truncate"
                    data-i18n="Extensions">@lang('language.Call Sms Response')</span></a>
            <ul class="menu-content">
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.elm-status')) active @endif" href="{{route('admin.elm-status')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sweet Alert">@lang('language.ELM Status')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.sms-response')) active @endif"
                        href="{{ route('admin.sms-response') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Block UI">@lang('language.SMS Status')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('callstatus')) active @endif" href="{{route('callstatus')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Toastr">@lang('language.Call Status')</span></a>
                </li> --}}

                {{-- Call Status Beta --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.check-call-demo')) active @endif"
                        href="{{ route('admin.check-call-demo') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sliders">@lang('language.Call Status')</span></a>
                </li>

                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('responseRefused')) active @endif" href="{{route('responseRefused')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tour">@lang('language.Refused by Debtor')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('RespondObjection')) active @endif"
                        href="{{ route('RespondObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Clipboard">@lang('language.Objection by Debtor')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('CompanyObjection')) active @endif" href="{{route('CompanyObjection')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Media player">@lang('language.Objection by Company')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('ValidObjection')) active @endif"
                        href="{{ route('ValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Context Menu">@lang('language.Valid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('InValidObjection')) active @endif"
                        href="{{ route('InValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="swiper">@lang('language.Invalid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('AdminCaseCloseObjection')) active @endif"
                        href="{{ route('AdminCaseCloseObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tree">@lang('language.Case Closed Objection')</span></a>
                </li>

            </ul>
        </li>


        {{-- <li class=" nav-item @if (request()->routeIs(['adminLoanView', 'adminLoanAcc', 'adminLoanRej'])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate"
                    data-i18n="Invoice">@lang('language.Finance Department')</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminLoanView')) active @endif"
                        href="{{ route('adminLoanView') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Loan Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminLoanAcc')) active @endif"
                        href="{{ route('adminLoanAcc') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Preview">@lang('language.Accepted By Company')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('adminLoanRej')) active @endif"
                        href="{{ route('adminLoanRej') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Edit">@lang('language.Rejected By Company')</span></a>
                </li>

            </ul>
        </li> --}}

        {{-- user  --}}
        <li class=" nav-item @if (request()->routeIs([
                'admin-list',
                'admin.companies-list',
                'admin.company-employee-list',
                'admin.finance-companies-list',
                'admin.finance-company-employee-list',
                'admin.add-collectors',
                'admin.all-users-list',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather="user"></i><span class="menu-title text-truncate"
                    data-i18n="User">@lang('language.User')</span></a>
            <ul class="menu-content">

                <li><a class="d-flex align-items-center @if (!request()->query('role') && request()->routeIs('admin.all-users-list')) active @endif"
                        href="{{ route('admin.all-users-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.All Users')</span></a>
                </li>
                @php
                    $roles = DB::table('roles')->get();
                @endphp
                @foreach ($roles as $role)
                    <li><a class="d-flex align-items-center @if (request()->routeIs('admin.all-users-list') && $role->name == request()->query('role')) active @endif"
                            href="{{ route('admin.all-users-list', ['role' => $role->name]) }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="List">{{ $role->display_name }}</span></a>
                    </li>
                @endforeach

                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin-list')) active @endif"
                        href="{{ route('admin-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Registered Admin')</span></a>
                </li> --}}
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.companies-list')) active @endif"
                        href="{{ route('admin.companies-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="View">@lang('language.Companies')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.company-employee-list')) active @endif"
                        href="{{ route('admin.company-employee-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Edit">@lang('language.Company Employees')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.finance-companies-list')) active @endif"
                        href="{{ route('admin.finance-companies-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Edit">@lang('language.Financial Companies')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.finance-company-employee-list')) active @endif"
                        href="{{ route('admin.finance-company-employee-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Edit">@lang('language.Finance Employees')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.add-collectors')) active @endif"
                        href="{{ route('admin.add-collectors') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Edit">@lang('language.Collectors')</span></a>
                </li> --}}
            </ul>
        </li>


        {{-- targets  --}}
        <li class=" nav-item @if (request()->routeIs([
                'admin.officer.targets',
                'admin.officers.targets.statistics',
                'admin.officer.achieved-targets'

            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                </path>
            </svg><span class="menu-title text-truncate"
                    data-i18n="User">@lang('language.Targets')</span></a>
            <ul class="menu-content">

                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.officer.targets')) active @endif"
                        href="{{ route('admin.officer.targets') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Officer Targets')</span></a>
                </li>

                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.officers.targets.statistics')) active @endif"
                        href="{{ route('admin.officers.targets.statistics') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Targets Statistics')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('admin.officer.achieved-targets')) active @endif"
                        href="{{ route('admin.officer.achieved-targets') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Achieved Targets')</span></a>
                </li>

            </ul>
        </li>





        <li class=" nav-item @if (request()->routeIs('admin.partial-payment')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('admin.partial-payment') }}"><i data-feather="save"></i><span
                    class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Partial Detail')</span></a>
        </li>

        <li class=" nav-item @if (request()->routeIs('admin.transaction-history')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('admin.transaction-history') }}"><i data-feather='credit-card'></i><span
                    class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Transaction History')</span></a>
        </li>

        <li class=" nav-item @if (request()->routeIs('admin-calendar')) active @endif">
            <a class="d-flex align-items-center " href="{{ route('admin-calendar') }}">
                <i data-feather='calendar'></i>
                <span class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Calendar')</span>
            </a>
        </li>

        <li class=" nav-item @if (request()->routeIs('admin.settings')) active @endif">
            <a class="d-flex align-items-center " href="{{ route('admin.settings') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z" />
                </svg>
                <span class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Settings')</span>
            </a>
        </li>

    </ul>
</x-sidebar-parent>
