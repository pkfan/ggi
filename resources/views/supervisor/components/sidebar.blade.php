<x-sidebar-parent>
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item @if (request()->routeIs('supervisor.dashboard')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('supervisor.dashboard') }}"><i data-feather="home"></i><span
                    class="menu-title text-truncate" data-i18n="Dashboards">@lang('language.Dashboards')</span></a>

        </li>
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">@lang('language.Apps Pages')</span><i
                data-feather="more-horizontal"></i>
        </li>


        <li class=" nav-item @if (request()->routeIs([
                'supervisor.claims',
                'supervisor.add-claim',
                'supervisor.bulkClaimReg',
                'supervisor.rejectclaims',
                'supervisor.approved-claims',
                'supervisor.officers.discount.requests',
                'supervisor.officers.discounts.list',
                'supervisor.claims.discount.history',
                'supervisor.exceede-claims',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='file-text'></i><span class="menu-title text-truncate"
                    data-i18n="eCommerce">@lang('language.Claims Request')</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.claims')) active @endif"
                        href="{{ route('supervisor.claims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Shop">@lang('language.All Request')</span></a>
                </li>
                @permission('add-claim')
                    <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.add-claim')) active @endif"
                            href="{{ route('supervisor.add-claim') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Add Claim')</span></a>
                    </li>
                @endpermission
                @permission('bulk-import-claims')
                    <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.bulkClaimReg')) active @endif"
                            href="{{ route('supervisor.bulkClaimReg') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Import Bulk Claims')</span></a>
                    </li>
                @endpermission
                
                    <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.exceede-claims')) active @endif"
                            href="{{ route('supervisor.exceede-claims') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Exceeded Claims')</span></a>
                    </li>
                
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.officers.discount.requests')) active @endif"
                        href="{{ route('supervisor.officers.discount.requests') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Discount Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.claims.discount.history')) active @endif"
                        href="{{ route('supervisor.claims.discount.history') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Shop">@lang('language.Discount History')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.officers.discounts.list')) active @endif"
                        href="{{ route('supervisor.officers.discounts.list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Officer Discounts List')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.rejectclaims')) active @endif"
                        href="{{ route('supervisor.rejectclaims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Rejected Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.approved-claims')) active @endif"
                        href="{{ route('supervisor.approved-claims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Wish List">@lang('language.Approved Requests')</span></a>
                </li> --}}
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.view-claims-remarks')) active @endif"
                        href="{{ route('admin.view-claims-remarks') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Checkout">@lang('language.Claim Remarks')</span></a>
                </li> --}}
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('AdminViewClaims')) active @endif" href="{{route('AdminViewClaims')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Checkout">@lang('language.Claim Beta')</span></a>
                </li> --}}
            </ul>
        </li>
        <li class=" nav-item @if (request()->routeIs([
                'supervisor.sms-response',
                'supervisor.check.call.status',
                'supervisor.check-call',
                'supervisor.RespondObjection',
                'supervisor.ValidObjection',
                'supervisor.InValidObjection',
                'supervisor.CaseCloseObjection',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='phone-call'></i><span class="menu-title text-truncate"
                    data-i18n="Extensions">@lang('language.Call Sms Response')</span></a>
            <ul class="menu-content">
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.elm-status')) active @endif" href="{{route('admin.elm-status')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sweet Alert">@lang('language.ELM Status')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.sms-response')) active @endif"
                        href="{{ route('supervisor.sms-response') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Block UI">@lang('language.SMS Status')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.check.call.status')) active @endif" href="{{route('supervisor.check.call.status')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Toastr">@lang('language.Call Status')</span></a>
                </li> --}}

                {{-- Call Status Beta --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.check-call')) active @endif"
                        href="{{ route('supervisor.check-call') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sliders">@lang('language.Call Status')</span></a>
                </li>

                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('responseRefused')) active @endif"
                        href="{{ route('responseRefused') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tour">@lang('language.Refused by Debtor')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.RespondObjection')) active @endif"
                        href="{{ route('supervisor.RespondObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Clipboard">@lang('language.Objection by Debtor')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('CompanyObjection')) active @endif" href="{{route('CompanyObjection')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Media player">@lang('language.Objection by Company')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.ValidObjection')) active @endif"
                        href="{{ route('supervisor.ValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Context Menu">@lang('language.Valid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.InValidObjection')) active @endif"
                        href="{{ route('supervisor.InValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="swiper">@lang('language.Invalid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.CaseCloseObjection')) active @endif"
                        href="{{ route('supervisor.CaseCloseObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tree">@lang('language.Case Closed Objection')</span></a>
                </li>

            </ul>
        </li>

        {{-- user  --}}
        <li class=" nav-item @if (request()->routeIs(['supervisor.all-officers-list', 'supervisor.register.officer'])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather="user"></i><span class="menu-title text-truncate"
                    data-i18n="User">@lang('language.User')</span></a>
            <ul class="menu-content">

                <li>
                    <a class="d-flex align-items-center @if (request()->routeIs('supervisor.all-officers-list')) active @endif"
                        href="{{ route('supervisor.all-officers-list') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.All Officers')</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center @if (request()->routeIs('supervisor.register.officer')) active @endif"
                        href="{{ route('supervisor.register.officer') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Register Officer')</span>
                    </a>
                </li>




            </ul>
        </li>


        {{-- targets  --}}
        <li class=" nav-item @if (request()->routeIs([
                'supervisor.officer.targets',
                'supervisor.officer.achieved-targets',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                    viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                    </path>
                </svg><span class="menu-title text-truncate" data-i18n="User">@lang('language.Targets')</span></a>
            <ul class="menu-content">

                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.officer.targets')) active @endif"
                        href="{{ route('supervisor.officer.targets') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Officer Targets')</span></a>
                </li>

                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.officers.targets.statistics')) active @endif"
                        href="{{ route('supervisor.officers.targets.statistics') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Targets Statistics')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.officer.achieved-targets')) active @endif"
                        href="{{ route('supervisor.officer.achieved-targets') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Achieved Targets')</span></a>
                </li>

            </ul>
        </li>

        <li class=" nav-item @if (request()->routeIs('supervisor.partial-payment')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('supervisor.partial-payment') }}"><i data-feather="save"></i><span
                    class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Partial Detail')</span></a>
        </li>

        <li class=" nav-item @if (request()->routeIs('supervisor.calendar')) active @endif">
            <a class="d-flex align-items-center " href="{{ route('supervisor.calendar') }}">
                <i data-feather='calendar'></i>
                <span class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Calendar')</span>
            </a>
        </li>

        <li class=" nav-item @if (request()->routeIs('supervisorClaims')) active @endif">
            <a class="d-flex align-items-center " href="{{ route('supervisorClaims') }}">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"></path></svg>
            <!-- <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"></path> -->
                <span class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Supervisor Claims')</span>
            </a>
        </li>

    </ul>
</x-sidebar-parent>
