<nav
        class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl"
        >
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">



            </div>
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><svg
                            xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-menu ficon">
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

                <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);"
                        data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
                            class="badge badge-pill badge-danger badge-up">{{getRemarkRemainder()->where('readRemark',0)->count()}}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header d-flex">
                                        <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                        <div class="badge badge-pill badge-light-primary">{{getRemarkRemainder()->where('readRemark',0)->count()}} New</div>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
                                    @foreach (getRemarkRemainder() as $rem)
                                    <a class="d-flex" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left">
                                                <div class="avatar"><img
                                                        src="{{asset('app-assets/images/portrait/small/avatar-s-15.jpg')}}"
                                                        alt="avatar" width="32" height="32"></div>
                                            </div>
                                            <div class="media-body" onclick="claimRemainder(<?php echo $rem->claim_id; echo ','.$rem->id ?>)">
                                                <p class="media-heading"><span class="font-weight-bolder">Claim
                                                            </span>GGI00{{$rem->claim_id}}</p><small class="notification-text">
                                                            {{ $rem->remark }} </small>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </li>
                                <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block"
                                        href="javascript:void(0)" onclick="markReadReminder()">Read all notifications</a></li>
                            </ul>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">John
                                Doe</span><span class="user-status">Admin</span></div><span class="avatar"><img
                                class="round" src="{{asset('app-assets/images/portrait/small/avatar-s-11.jpg')}}"
                                alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{url('admin/setting/'.Auth::user()->id)}}"><i class="mr-50"
                                data-feather="user"></i> Setting</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('AdminLogout')}}"><i
                                class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

         function claimRemainder(claimid,reminderId){
           // domain=window.location.hostname;
             alert('domain');

            $.ajax({
                method: "get",
                url: "/admin-read-reminder/"+reminderId,
            }).done(function() {
                window.location.assign('/admin/claim/detail/'+claimid) ;
                });


        }

        function markReadReminder(){
            $.ajax({
                method: "get",
                url: "/admin-read-all-reminder/",
            }).done(function() {

                alert('done');
                Swal.fire('Successfully marked as read')
            });
        }
    </script>
