<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content" style="position: relative;">

        {{-- officer targets static  --}}

        @if (recoverTargets())
            <a
                href="{{route('officer.achieved-targets')}}"
                style="position: absolute;background: #037293;color: white;
                top: 0;
                left: 0;
                padding: 8px;
                height: 63px;
                border-bottom-left-radius: 6px;
                border-top-left-radius: 6px;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 8px;
            ">
                <div>
                    <div
                        style="
                display: flex;
                gap: 6px;
                border-bottom: 1px solid white;
            ">
                        <div style="
                color: white;
                font-size: 16px;
            ">
                            {{ recoverTargets()->total ?? 0 }} <span
                                style="
                font-size: 12px;
                color: yellow;
            ">target</span>
                        </div>
                    </div>
                    <div style="
                display: flex;
                gap: 6px;
            ">
                        <div style="
                color: white;
                font-size: 16px;
            ">
                            {{ recoverTargets()?->achieved ?? 0 }}
                            <span style="color: #65fb65;font-size: 12px;">acheived</span>
                        </div>
                    </div>

                </div>
                <div style="
                font-size: 24px;
            ">
                    {{ recoverTargets()?->acheived_percentage ?? 0 }}%</div>

            </a>
        @endif

        <div class="bookmark-wrapper d-flex align-items-center">

        </div>
        <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><svg
                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-menu ficon">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg></a></li>
        </ul>
        <ul class="nav navbar-nav align-items-center ml-auto">

            <!-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                    <div class="search-input">
                        <div class="search-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                        <div class="search-input-close"><i data-feather="x"></i></div>
                        <ul class="search-list search-list-main"></ul>
                    </div>
                </li> -->

            @php
                $counts = getRemarkRemainder()
                    ->where('readRemark', 0)
                    ->count();
                $counts += \App\Models\Notification::where('to', auth()->user()->id)
                    ->where('read', false)
                    ->count();
            @endphp
            <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);"
                    data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
                        class="badge badge-pill badge-danger badge-up">{{ $counts }}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">


                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">
                                {{ $counts }} New</div>
                        </div>
                    </li>


                    <li class="scrollable-container media-list">
                        @foreach (getRemarkRemainder() as $rem)
                            <a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar"><img
                                                src="{{ asset('app-assets/images/portrait/small/avatar-s-15.jpg') }}"
                                                alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="media-body" onclick="claimRemainder(<?php echo $rem->claim_id;
                                    echo ',' . $rem->id; ?>)">
                                        <p class="media-heading"><span class="font-weight-bolder">Claim
                                            </span>GGI00{{ $rem->claim_id }}</p><small class="notification-text">
                                            {{ $rem->remark }} </small>
                                    </div>
                                </div>
                            </a>
                    </li>
                    @endforeach
                    @php
                        $notifications = \App\Models\Notification::where('to', auth()->user()->id)
                            ->where('read', false)
                            ->get();
                    @endphp
                    @foreach ($notifications as $notification)
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left d-flex">
                                        <div class="avatar"
                                            style="
                                            width: 16px;
                                            height: 16px;
                                            background: #3e3ead;margin-right: 8px;">
                                        </div>
                                        <div class="media-body" onclick="markNotificationAsRead(<?php echo $notification->id; ?>)">
                                            <p class="media-heading">
                                                <span class="font-weight-bolder">
                                                    {{ $notification->type }}
                                                </span>
                                            </p>
                                            <small class="notification-text">
                                                {{ $notification->message }}
                                            </small>
                                        </div>
                                    </div>
                            </a>
                        </li>
                    @endforeach



                </ul>
            </li>

            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i
                        class="flag-icon @if (app()->getLocale() == 'en') flag-icon-us @elseif (app()->getLocale() == 'ar') flag-icon-sa @endif"></i>
                    <span class="selected-language">
                        @if (app()->getLocale() == 'en')
                            English
                        @elseif (app()->getLocale() == 'ar')
                            عربي
                        @endif
                    </span></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{ route('language.translate', ['languageCode' => 'en']) }}"
                        data-language="en"><i class="flag-icon flag-icon-us"></i>
                        English</a>
                    <a class="dropdown-item" href="{{ route('language.translate', ['languageCode' => 'ar']) }}"
                        data-language="fr"><i class="flag-icon flag-icon-sa"></i> عربي</a>

            </li>

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">
                            {{ auth()->user()->name }}
                        </span><span class="user-status">Officer</span></div><span class="avatar"><img class="round"
                            src="{{ asset('app-assets/images/avatars/default-avatar.png') }}" alt="avatar"
                            height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ url('admin/setting/' . Auth::user()->id) }}"><i class="mr-50"
                            data-feather="user"></i> Setting</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item"
                        href="{{ route('AdminLogout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function claimRemainder(claimid, reminderId) {
        // domain=window.location.hostname;
        alert('domain');

        $.ajax({
            method: "get",
            url: "/admin-read-reminder/" + reminderId,
        }).done(function() {
            window.location.assign('/admin/claim/detail/' + claimid);
        });


    }



    function markReadReminder() {
        $.ajax({
            method: "get",
            url: "/admin-read-all-reminder/",
        }).done(function() {

            alert('done');
            Swal.fire('Successfully marked as read')
        });
    }
</script>
