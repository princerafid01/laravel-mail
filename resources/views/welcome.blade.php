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
    <title>Welcome | {{option('site_name')}}</title>
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
        /*----------------------------------------
    404 Page
------------------------------------------*/
        .section.section-404
        {
            display: -webkit-box;
            display: -webkit-flex;
            display:    -moz-box;
            display: -ms-flexbox;
            display:         flex;
            overflow: hidden;

            height: 100vh;

            background: #fff;

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
        .section.section-404 .error-code
        {
            font-size: 10rem !important;
        }

        @media screen and (min-width: 992px)
        {
            .section.section-404 .error-code
            {
                font-size: 5rem !important;
            }
            .section.section-404 .bg-image-404
            {
                width: 70% !important;
            }
        }

        @media screen and (min-width: 769px)
        {
            .bg-image-404
            {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 768px)
        {
            .section.section-404 .error-code
            {
                font-size: 5rem !important;
            }
            .section.section-404 .bg-image-404
            {
                width: 100%;
            }
        }

        @media screen and (max-width: 540px)
        {
            .section.section-404 .error-code
            {
                font-size: 2rem !important;
            }
        }
    </style>
    <!-- END: Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">

<div class="container gradient-45deg-light-blue-cyan">
    <div class="section gradient-45deg-light-blue-cyan section-404 p-0 m-0 height-100vh">
        <div class="row">
            <div class="col s12">
                <div class="col s12 center-align">
                    <img src="{{asset('assets/images/intro-app.png')}}" class="bg-image-404" alt="">
                    <h1 class="error-code m-0">{{option('site_name')}}</h1>
                    <a class="btn waves-effect waves-light green gradient-shadow mb-4" href="{{route('login')}}">Login</a>
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
    function notify(message, type){
        switch(type) {
            case 'success':
                M.toast({ html: message, classes:'gradient-45deg-green-teal' });
                break;
            case 'error':
                M.toast({ html: message, classes:'gradient-45deg-deep-orange-orange' });
                break;
            case 'warning':
                M.toast({ html: message, classes:'gradient-45deg-amber-amber' });
                break;
            case 'info':
                M.toast({ html: message, classes:'gradient-45deg-indigo-blue' });
                break;
            default:
                M.toast({ html: message, classes:'gradient-45deg-indigo-blue' });
        }
    };
    @if($m = session()->pull('error'))
notify('{{$m}}','error');
    @endif
    @if($m = session()->pull('success'))
notify('{{$m}}','success');
    @endif
    @if($m = session()->pull('info'))
notify('{{$m}}','info');
    @endif
    @if($m = session()->pull('warning'))
notify('{{$m}}','warning');
    @endif
</script>
</body>
</html>
