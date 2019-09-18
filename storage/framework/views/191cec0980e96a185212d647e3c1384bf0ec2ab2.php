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
    <title>Reset Password | <?php echo e(option('site_title')); ?></title>

<!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/vendors.min.css')); ?>">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/materialize.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
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
                    <?php if(session('status')): ?>
                        <div class="card-alert card gradient-45deg-green-teal">
                            <div class="card-content white-text">
                                <p><?php echo e(session('status')); ?></p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <form class="login-form" method="POST" action="<?php echo e(route('password.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="token" value="<?php echo e($token); ?>">
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4"><?php echo e(__('Reset Password')); ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">email_outline</i>
                                <input id="email" type="email" value="<?php echo e($email ?? old('email')); ?>" autocomplete="email" autofocus name="email" required>
                                <label for="email" class="center-align">Email</label>
                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <div class="error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input id="password" type="password" name="password" autocomplete="new-password" required>
                                <label for="password" class="center-align">New Password</label>
                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                <div class="error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input id="password-confirm" type="password" name="password-confirm" autocomplete="new-password" required>
                                <label for="password-confirm" class="center-align">Confirm Password</label>
                                <?php if ($errors->has('password-confirm')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password-confirm'); ?>
                                <div class="error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1"><?php echo e(__('Reset Password')); ?></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a href="<?php echo e(route('login')); ?>">Login</a></p>
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
<script src="<?php echo e(asset('assets/js/vendors.min.js')); ?>" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="<?php echo e(asset('assets/js/plugins.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom-script.js')); ?>" type="text/javascript"></script>
<script>
    $(".card-alert .close").click(function () {
        $(this)
            .closest(".card-alert")
            .fadeOut("slow");
    });
</script>
</body>
</html>
<?php /**PATH G:\xampp\htdocs\Laravel\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>