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
            'collector.claims',
            'collector.claim-details',
            ])) open @endif"><a class="d-flex align-items-center"
                href="#"><i data-feather='file-text'></i><span class="menu-title text-truncate"
                    data-i18n="eCommerce">@lang('language.Claims Request')</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center @if (request()->routeIs('collector.claims')) active @endif"
                        href="{{ route('collector.claims') }}"><i data-feather="circle"></i><span
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
<!--                 
                    <li><a class="d-flex align-items-center @if (request()->routeIs('supervisor.exceede-claims')) active @endif"
                            href="{{ route('supervisor.exceede-claims') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">@lang('language.Exceeded Claims')</span></a>
                    </li> -->
                
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
        


        {{-- targets  --}}
            </ul>
</x-sidebar-parent>
