<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Forgot Password | {{option('site_name')}}</title>
{{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
<!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/vendors.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <style>
        .forgot-bg
        {
            background-image: url('/assets/images/flat-bg.jpg');
            background-repeat: no-repeat;
            -webkit-background-size: cover;
            background-size: cover;
        }

        #forgot-password
        {
            display: -webkit-box;
            display: -webkit-flex;
            display:    -moz-box;
            display: -ms-flexbox;
            display:         flex;

            height: 100vh;

            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -moz-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        #forgot-password .card-panel.border-radius-6.forgot-card
        {
            margin-left: 0 !important;
        }
    </style>
    <!-- END: Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column forgot-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
<div class="row">
    <div class="col s12">
        <div class="container"><div id="forgot-password" class="row">
                <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
                    @if (session('status'))
                        <div class="card-alert card gradient-45deg-green-teal">
                            <div class="card-content white-text">
                                <p>{{ session('status') }}</p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4">Forgot Password</h5>
                                <p class="ml-4">You can reset your password</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">email_outline</i>
                                <input id="email" type="email" value="{{ old('email') }}" name="email" required>
                                <label for="email" class="center-align">Email</label>
                                @error('email')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a href="{{route('login')}}">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('assets/js/plugins.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/custom-script.js')}}" type="text/javascript"></script>
<script>
    $(".card-alert .close").click(function () {
        $(this)
            .closest(".card-alert")
            .fadeOut("slow");
    });
</script>
</body>
</html>
