<x-sidebar-parent>
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item @if (request()->routeIs('officer.dashboard')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('officer.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboards">@lang('language.Dashboards')</span></a>

        </li>
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">@lang('language.Apps Pages')</span><i
                data-feather="more-horizontal"></i>
        </li>


        <li class=" nav-item @if (request()->routeIs([
                'officer.claims',
                'officer.add-claim',
                'officer.claims.discount.history',
                'officer.rejectclaims',
                'officer.approved-claims',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='file-text'></i><span class="menu-title text-truncate"
                    data-i18n="eCommerce">@lang('language.Claims Request')</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.claims')) active @endif"
                        href="{{ route('officer.claims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Shop">@lang('language.All Request')</span></a>
                </li>
                @permission('add-claim')
                    <li><a class="d-flex align-items-center @if (request()->routeIs('officer.add-claim')) active @endif"
                            href="{{ route('officer.add-claim') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Add Claim')</span></a>
                    </li>
                @endpermission
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.claims.discount.history')) active @endif"
                        href="{{ route('officer.claims.discount.history') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Shop">@lang('language.Discount History')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.rejectclaims')) active @endif"
                        href="{{ route('officer.rejectclaims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Details">@lang('language.Rejected Requests')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.approved-claims')) active @endif"
                        href="{{ route('officer.approved-claims') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Wish List">@lang('language.Approved Requests')</span></a>
                </li>
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
                'officer.sms-response',
                'officer.check.call.status',
                'officer.check-call',
                'officer.RespondObjection',
                'officer.ValidObjection',
                'officer.InValidObjection',
                'officer.CaseCloseObjection',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='phone-call'></i><span class="menu-title text-truncate"
                    data-i18n="Extensions">@lang('language.Call Sms Response')</span></a>
            <ul class="menu-content">
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('admin.elm-status')) active @endif" href="{{route('admin.elm-status')}}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sweet Alert">@lang('language.ELM Status')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.sms-response')) active @endif"
                        href="{{ route('officer.sms-response') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Block UI">@lang('language.SMS Status')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('officer.check.call.status')) active @endif" href="{{route('officer.check.call.status')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Toastr">@lang('language.Call Status')</span></a>
                </li> --}}

                {{-- Call Status Beta --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.check-call')) active @endif"
                        href="{{ route('officer.check-call') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Sliders">@lang('language.Call Status')</span></a>
                </li>

                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('responseRefused')) active @endif"
                        href="{{ route('responseRefused') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tour">@lang('language.Refused by Debtor')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.RespondObjection')) active @endif"
                        href="{{ route('officer.RespondObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Clipboard">@lang('language.Objection by Debtor')</span></a>
                </li>
                {{-- <li><a class="d-flex align-items-center @if (request()->routeIs('CompanyObjection')) active @endif" href="{{route('CompanyObjection')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                            data-i18n="Media player">@lang('language.Objection by Company')</span></a>
                </li> --}}
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.ValidObjection')) active @endif"
                        href="{{ route('officer.ValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Context Menu">@lang('language.Valid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.InValidObjection')) active @endif"
                        href="{{ route('officer.InValidObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="swiper">@lang('language.Invalid Objection')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.CaseCloseObjection')) active @endif"
                        href="{{ route('officer.CaseCloseObjection') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="Tree">@lang('language.Case Closed Objection')</span></a>
                </li>

            </ul>
        </li>

        {{-- targets  --}}
        <li class=" nav-item @if (request()->routeIs(['officer.targets.statistics','officer.achieved-targets'])) open @endif"><a class="d-flex align-items-center"
                href="#"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                    </path>
                </svg><span class="menu-title text-truncate" data-i18n="User">@lang('language.Targets')</span></a>
            <ul class="menu-content">

                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.targets.statistics')) active @endif"
                        href="{{ route('officer.targets.statistics') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Targets Statistics')</span></a>
                </li>
                <li><a class="d-flex align-items-center @if (request()->routeIs('officer.achieved-targets')) active @endif"
                        href="{{ route('officer.achieved-targets') }}"><i data-feather="circle"></i><span
                            class="menu-item text-truncate" data-i18n="List">@lang('language.Achieved Targets')</span></a>
                </li>

            </ul>
        </li>

        <li class=" nav-item "><a class="d-flex align-items-center "
                href="{{ url('officer/transaction') }}"><i data-feather="save"></i><span
                    class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Transaction History')</span></a>
        </li>
        <li class=" nav-item @if (request()->routeIs('officer.partial-payment')) active @endif"><a class="d-flex align-items-center "
                href="{{ route('officer.partial-payment') }}"><i data-feather="save"></i><span
                    class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Partial Detail')</span></a>
        </li>

        <li class=" nav-item @if (request()->routeIs('officer.calendar')) active @endif">
            <a class="d-flex align-items-center " href="{{ route('officer.calendar') }}">
                <i data-feather='calendar'></i>
                <span class="menu-title text-truncate" data-i18n="File Manager">@lang('language.Calendar')</span>
            </a>
        </li>

    </ul>
</x-sidebar-parent>
