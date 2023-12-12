<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">--}}
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/plugins/toast/build/toastr.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/toast/build/toastr.min.css')}}"/>
    <title>Sign_In</title>
</head>

<body class="bg-login">
            <style>
        .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  padding: 15px 46px 15px 46px
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
  padding: 15px 46px 15px 46px
}
    </style>
<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Insurance Company Sign in</h3>
                                    <p>Don't have an account yet? <a href="{{route('IcSignUpForm')}}">Sign up here</a>
                                    </p>
                                </div>
                                <div class="form-body">
                                     @if (session('invalid'))
                                        <span class="text-danger">{{session('invalid')}}</span>
                                    @endif
                                    <form class="row g-3" action="{{route('IcSignIn')}}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="inputEmailAddress" name="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
{{--                                            <div class="form-check form-switch">--}}
{{--                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>--}}
{{--                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>--}}
{{--                                            </div>--}}
                                        </div>
                                          <div class="col-12">
                                        <div class="dropdown d-grid">
                                            <button type="button" class="btn btn-gradient">Login As</button>
                                            <div class="dropdown-content">
                                                <a href="{{url('lawfirm/sign-in')}}">Law Firm</a>
                                                <a href="{{route('AdminSignInForm')}}">Admin</a>
                                                <a href="{{route('fclogin')}}">Finance Company</a>
                                            </div>
                                        </div>
                                    </div>
                                        <!--<div class="col-12">-->
                                        <!--    <a href="{{route('AdminSignInForm')}}">Login As Admin</a><br>-->
                                        <!--    <a href="{{url('lawfirm/sign-in')}}">Login As Law Firm</a><br>-->
                                            <!--<a href="{{url('ic/sign-in-form')}}">Login As Insurance Company</a><br>-->
                                        <!--    <a href="{{route('fclogin')}}">Login As Finance Company</a>-->
                                        <!--</div>-->
{{--                                        <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>--}}
{{--                                        </div>--}}
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, rgba(49, 123, 215, 1) 11%, rgba(158, 227, 69, 1) 98%)"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/toast/toastr.js')}}"></script>
<script src="{{asset('assets/plugins/toast/build/toastr.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
@if (session()->has('success'))
    <script>
        toastr.success('{{session()->get('success')}}');
        {{session()->forget('success')}}
    </script>
@endif
@if (session()->has('error'))
    <script>
        toastr.error('{{session()->get('error')}}');
        {{session()->forget('error')}}
    </script>
@endif
@if (session()->has('info'))
    <script>
        toastr.success('{{session()->get('info')}}');
        {{session()->forget('info')}}
    </script>
@endif
@if (session()->has('warn'))
    <script>
        toastr.success('{{session()->get('warn')}}');
        {{session()->forget('warn')}}
    </script>
@endif
</body>

</html>
