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
    <title>Sign-Up</title>
</head>

<body class="bg-login">
    <style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<!--wrapper-->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
{{--                        <img src="assets/images/logo-img.png" width="180" alt="" />--}}
                    </div>
                    <div class="card" style="margin-top: 20%">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Sign Up</h3>
                                    <p>Already have an account? <a href="{{route('IcSignInForm')}}">Sign in here</a>
                                    </p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{route('IcSignUp')}}" method="post">
                                        @csrf
                                        <div class="col-sm-6">
                                            <label for="inputFirstName" class="form-label">Company Name*</label>
                                            <input type="text" class="form-control" id="inputFirstName" name="cname" value="{{old('cname')}}" required pattern="[أ-يa-zA-Z ]*">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address*</label>
                                            <input type="email" class="form-control" id="inputEmailAddress" value="{{old('email')}}" name="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                                        </div>
                                        @error('email')
                                            <span class="text-danger">Email already exist</span>
                                        @enderror
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Cr* #</label>
                                            <div class="input-group">
                                                <input type="text" maxLength="10"  class="form-control border-end-0" id="inputChoosePassword" value="{{old('srcode')}}" name="srcode" required pattern="^[A-Za-z0-9_-]*$" oninvalid="setCustomValidity('It should only contain number,alphabets and underscore')"> <a href="javascript:;" class="input-group-text bg-transparent"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password*</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" minLength="6" maxLength="8" name="password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
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
