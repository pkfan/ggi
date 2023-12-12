<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <x-push-styles-on-stack />

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">





    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    {{-- added and overide by Muhammad Amir  --}}
    <style>
        .apexcharts-toolbar {
            display: none !important;
        }

        .card-hover-light-blue:hover {
            background: #d5d5ff;
        }
    </style>

    {{-- bootsrap styles override  --}}
    {{-- <style>
        .btn-primary {
            background-image: linear-gradient(0deg, #00225e, #7babff);

        }

        .btn-warning {

            background-image: linear-gradient(0deg, #b75900, #ffdb76);

        }

        .btn-secondary {
            background-image: linear-gradient(0deg, #515458, #e7e7e7);
        }

        .btn-success {
            background-image: linear-gradient(0deg, #01662e , #8effc0 );
        }
        .btn-danger {
            background-image: linear-gradient(0deg, #870304 , #f78687 );
        }
        .btn-info {
            background-image: linear-gradient(0deg, #004f58 , #9ff5ff );
        }
        .btn-dark {
            background-image: linear-gradient(0deg, #000000 , #b5b5b5 );
        }
    </style> --}}
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            padding-top: 10px;

        }

        .page-item.active .page-link {
            background-color: #3f3f3f;
        }

        .demo-inline-spacing {
            display: flex;
            flex-wrap: initial;
            justify-content: flex-start;
            align-items: center;
        }






        #mytmp .dz-remove {
            z-index: 999;
            position: absolute;
            display: block;
            top: 0%;
            left: 0%;
            margin-left: -16px;
            margin-top: -16px;
        }

        #mytmp .dz-remove svg {
            fill: #444;
            cursor: pointer;
        }


        .bx-history:before {
            content: "\ea72";
        }

        .panel {
            display: none;
        }

        @media screen and (max-width: 935px) {
            .demo-inline-spacing {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;
            }

        }
    </style>
    {{-- krajee file input plugin  --}}
    <style>
        .file-input.file-input-ajax-new {
            width: 100%;
            padding: 0 16px;
        }

        .krajee-file-label {
            padding: 8px 16px;
            width: 100%;
        }

        .file-input {
            width: 100%;
        }
    </style>
    {{-- overide global all styles with new | Muhammad Amir  --}}
    <style>
        /* scroll overide  */
        /* @import "color-palette.css"; */
        ::placeholder {
            color: #C1C0C0 !important;
            opacity: 1;
        }

        ::-webkit-scrollbar {
            background-color: rgb(255, 250, 250);
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 8px
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgb(63, 63, 63);
            border-radius: 16px
        }


        .app-content.content {
            padding-top: 86px !important;
        }

        .header-navbar {
            border: 1px solid #dfdfdf;
            box-shadow: 0 2px 4px rgba(34, 41, 47, 0.1) !important;
            margin-top: 0.7rem !important;
        }

        .card {
            padding: 1.5rem;
            border: 1px solid #cdcdcd;
            box-shadow: 0 2px 4px rgba(34, 41, 47, 0.1) !important;

        }


        .table:not(.table-dark):not(.table-light) thead:not(.thead-dark) th,
        .table:not(.table-dark):not(.table-light) tfoot:not(.thead-dark) th {
            background-color: #f3f2f7;
        }

        .table thead th,
        .table tfoot th {
            color: black;
            vertical-align: top;
            text-transform: uppercase;
            font-size: 0.857rem;
            letter-spacing: 0.5px;
        }

        .table thead th,
        .table tfoot th {
            vertical-align: top;
            text-transform: uppercase;
            font-size: 0.857rem;
            letter-spacing: 0.5px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #ebe9f1;
        }

        th.text-nowrap {}

        .table th,
        .table td {
            padding: 0.72rem 2rem;
            vertical-align: middle;
        }

        .table th,
        .table td {
            padding: 0.72rem;
            vertical-align: top;
            border-top: 1px solid #ebe9f1;
        }

        .text-nowrap {
            white-space: nowrap !important;
        }

        thead tr th {
            background: #4b4b4b !important;
            color: white !important;
        }

        tbody tr:nth-child(even) {
            background: #ededed;
        }

        .table-responsive {
            height: 85vh;
        }

        .modal .modal-header {
            background-color: #E3E3FF;
            border-top: 6px solid #037293;
            align-items: center;
        }

        .page-item .page-link:hover {
            color: #00b4e9;
            background: #cfe2ff;
        }

        /* #basic-table .col-12 .card {
            border-top: 4px solid #037293;
        } */

        #basic-table .card-header {
            padding: 0;
        }

        .input-group:not(.bootstrap-touchspin):focus-within {
            box-shadow: none !important;
        }

        .demo-inline-spacing {
            display: flex;
            flex-wrap: initial;
            justify-content: flex-start;
            align-items: center;
        }

        .form-check-inline {
            margin-bottom: 20px !important;
        }

        .form-control {
            color: rgb(54 54 54) !important;
        }

        .modal .modal-header {
            background-color: #e3e3ff;
            border-top: 6px solid #037293;
            align-items: center;
        }

        div#details-container h6 {
            border-bottom: 1px solid #cfcfcf;
            padding-bottom: 4px;
            margin-bottom: 16px;
        }

        div#details-container label {
            padding-top: 16px;
        }

        select,
        input,
        textarea,
        .demo-inline-spacing,
        .select2-selection {
            background-color: #f5f5f5 !important;
        }

        .select2-selection {
            border: 1px solid #82868b !important;
        }

        .modal .modal-header .modal-title {
            color: #037293 !important;
            font-size: 18px;
            font-weight: bold;
        }
    </style>

    {{-- add by Muhammad amir - 12-12-30323 --}}
    <style>
        .main-menu .navbar-header .navbar-brand .brand-logo img {
            max-width: 110px;
        }

        .main-menu .navbar-header {
            background-color: #037293;
            height: 5rem;
            border-bottom: 1px solid #82a5ff;
            margin-left: 8px;
            padding-left: 16px;
        }
    </style>



</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="" style="background-color: #dfdcdc;">

    <!-- BEGIN: Header-->
    {{-- <x-header /> --}}
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @if (request()->is('admin/*'))
        <!-- BEGIN: Header-->
        <x-header />
        <!-- END: Header-->
        <x-admin::sidebar />
    @elseif(request()->is('supervisor/*'))
        <!-- BEGIN: Header-->
        <x-supervisor::header />
        <!-- END: Header-->
        <x-supervisor::sidebar />
    @elseif(request()->is('officer/*'))
        <!-- BEGIN: Header-->
        <x-officer::header />
        <!-- END: Header-->
        <x-officer::sidebar />
    @elseif(request()->is('legal-department/*'))
        <!-- BEGIN: Header-->
        <x-legal::header />
        <!-- END: Header-->
        <x-legal::sidebar />
    @elseif(request()->is('collector/*'))
        <!-- BEGIN: Header-->
        <x-collector::header />
        <!-- END: Header-->
        <x-collector::sidebar />
    @endif
    <!-- END: Main Menu-->


    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    {{-- <x-footer /> --}}
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <!-- END: Theme JS-->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <x-push-scripts-on-stack />

    <x-toaster />


    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>
    <script>
        function getActiveChooseClassOfSelectedStatus() {
            var name = $("#sectionChooser").val();
            var className;
            if (name == 1) {
                className = "followupDiv"
            } else if (name == 2) {
                className = "collectedDiv"
            } else if (name == 3) {
                className = "delayedDiv"
            } else if (name == 4) {
                className = "partialPayDiv"
            } else if (name == 5) {
                className = "transferMorr"
            } else if (name == 6) {
                className = "assignLaw"
            } else if (name == 7) {
                className = "assignAcc"
            } else if (name == 8) {
                className = "assignElm"
            } else if (name == 9) {
                className = "assignIc"
            } else if (name == 10) {
                className = "closeClaim"
            } else if (name == 11) {
                className = "collectedbyic"
            } else if (name == 20) {
                className = "sendToLegalDeparment"
            } else if (name == 21) {
                className = "sendToCollectionOffice";
            } else if (name == 22) {
                className = "sendBackToSV";
            } else {
                className = "followupDiv"
            }

            return className;
        }

        $(document).ready(function() {
            // default
            // var className = getActiveChooseClassOfSelectedStatus();
            // $("."+className).show();

            $("#sectionChooser").change(function() {
                var className = getActiveChooseClassOfSelectedStatus();
                $(".panel").hide();
                $("." + className).show();
            });
        })
    </script>
    <script>
        $(function() {
            if ($('.othServCheck').prop('checked') == false) {
                $(this).parent().siblings([':datetime-local']).hide();
            }
            $('.othServCheck').click(function() {
                $(this).parent().siblings([':datetime-local']).toggle();
            });
        });

        function showLoaderOnButtonOnClickClaimImport(keepLoading) {
            // show loader on click on buttons
            let showLoadingOnClick = document.querySelector('.show-loading-on-click');
            let loadingOnClickCircle = document.querySelector('.loading-on-click-circle');

            console.log('showLoadingOnClick : ', showLoadingOnClick);
            console.log('loadingOnClickCircle : ', loadingOnClickCircle);

            let hasFile = showLoadingOnClick.getAttribute('hasFile');

            if (hasFile == 'no') {
                return;
            }

            loadingOnClickCircle.classList.remove('d-none');

            if (!keepLoading) {
                setTimeout(() => {
                    loadingOnClickCircle.classList.add('d-none');
                }, 2000);
            }
        }
    </script>
    <!--{{-- notification of bell icons  --}}-->
    <script>
        function markNotificationAsRead(notification_id) {
            // domain=window.location.hostname;
            // alert('domain');
            $.ajax({
                method: "get",
                url: `/api/mark-notification-as-read/${notification_id}`,
            }).done(function(response) {
                if (response.data.link) {
                    window.location.assign(response.data.link);
                } else {
                    window.location.reload()
                }
            });
        }
    </script>





</body>
<!-- END: Body-->

</html>
