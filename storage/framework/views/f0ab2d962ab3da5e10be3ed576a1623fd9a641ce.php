<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php ($this_user = \Illuminate\Support\Facades\Auth::user()); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title><?php echo e($meta['page_title']); ?> | <?php echo e(option('site_name')); ?></title>
    
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/vendors.min.css')); ?>">
    <?php echo $__env->yieldContent('other_vendor_css'); ?>
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/materialize.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <?php echo $__env->yieldContent('other_css'); ?>
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <!-- END: Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

<!-- BEGIN: Header-->
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">



                <?php ($nn = $this_user->notifications->take(10)); ?>
                <?php ($unread = $this_user->unreadNotifications->count()); ?>
                <ul class="navbar-list right">
                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                    <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge <?php if($unread>0): ?> pulse <?php endif; ?>"><?php echo e($unread); ?></small></i></a></li>
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="<?php echo e(asset('assets/images/avatar-3.png')); ?>" alt="avatar"><i></i></span></a></li>
                    </ul>
                <!-- notifications-dropdown-->
                <ul class="dropdown-content" id="notifications-dropdown" style="max-width: 350px; max-height: 500px;">
                    <li>
                        <h6>NOTIFICATIONS<span class="new badge" data-badge-caption="Mark read" onclick="mark_as_read()"></span></h6>
                    </li>
                    <li class="divider"></li>
                    <?php $__currentLoopData = $nn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a class="grey-text text-darken-2 n_action <?php echo e($n->data['modal']); ?>" data-id="<?php echo e($n->id); ?>" href="<?php echo e($n->data['action']?:'#!'); ?>"><span class="material-icons icon-bg-circle small <?php if(!$n->read_at): ?> unread pulse red <?php else: ?> green <?php endif; ?>"><?php echo e($n->data['icon']); ?></span><span><?php echo e($n->data['msg']); ?></span></a>
                            <time class="media-meta" datetime="2015-06-12T20:50:48+08:00"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $n->created_at)->diffForHumans()); ?></time>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li id="last_n" style="text-align: center">
                        <?php if($this_user->notifications->count()>10): ?>
                        <img width="100px" src="<?php echo e(asset('assets/images/loading.gif')); ?>" alt="">
                            <?php else: ?>
                        End
                            <?php endif; ?>
                    </li>
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="<?php echo e(route('profile')); ?>"><i class="material-icons">person_outline</i> Profile</a></li>
                    <li><a class="grey-text text-darken-1" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a><form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form></li>
                </ul>
            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form>
                        <div class="input-field">
                            <input class="search-box-sm" type="search" required="">
                            <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
<!-- END: Header-->



<!-- BEGIN: SideNav-->
<aside class="sidenav-main no_print nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-green-teal sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('assets/images/logo/materialize-logo-color.png')); ?>" alt="materialize logo"/><span class="logo-text hide-on-med-and-down"><?php echo e(option('site_name')); ?></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="<?php if($meta['active_menu'] == 'home'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'home'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/home"><i class="material-icons">home</i><span class="menu-title" data-i18n="">Home</span></a>
        </li>
        <?php $__currentLoopData = $ships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php if($meta['active_menu'] == $ship->name): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == $ship->name): ?> active <?php endif; ?> waves-effect waves-cyan " href="/ships/<?php echo e($ship->id); ?>"><i class="material-icons">directions_boat</i><span class="menu-title" data-i18n=""><?php echo e($ship->name); ?></span></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if (\Entrust::can('trip_*')) : ?>
        <li class="<?php if($meta['active_menu'] == 'trips'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'trips'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/trips"><i class="material-icons">timeline</i><span class="menu-title" data-i18n="">Trips</span></a>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('income_*')) : ?>
        <li class="<?php if($meta['active_menu'] == 'income'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'income'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/income"><i class="material-icons">attach_money</i><span class="menu-title" data-i18n="">Income</span></a>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('expense_*')) : ?>
        <li class="<?php if($meta['active_menu'] == 'expense'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'expense'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/expense"><i class="material-icons">money_off</i><span class="menu-title" data-i18n="">Expense</span></a>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('gexpense_*')) : ?>
        <li class="<?php if($meta['active_menu'] == 'gexpense'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'gexpense'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/gexpense"><i class="material-icons">money_off</i><span class="menu-title" data-i18n="">General Expense</span></a>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('user_*')) : ?>
        <li class="<?php if($meta['active_menu'] == 'users'): ?> active <?php endif; ?> bold"><a class=" <?php if($meta['active_page'] == 'users'): ?> active <?php endif; ?> waves-effect waves-cyan " href="/users"><i class="material-icons">group</i><span class="menu-title" data-i18n="">User</span></a>
        </li>
        <?php endif; // Entrust::can ?>
        <li class="<?php if($meta['active_menu'] == 'settings'): ?> active <?php endif; ?> bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">settings</i><span class="menu-title" data-i18n="">Settings</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="">
                        <a class="collapsible-body <?php if($meta['active_page'] == 'system_settings'): ?> active <?php endif; ?> waves-effect waves-cyan" href="<?php echo e(route('settings')); ?>" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>System Settings</span></a>
                    </li>
                    <li class="">
                        <a class="collapsible-body <?php if($meta['active_page'] == 'role'): ?> active <?php endif; ?> waves-effect waves-cyan" href="<?php echo e(route('Role')); ?>" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Role</span></a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->

<!-- BEGIN: Page Main-->
<div id="main" >
    <div class="row">
        <div class="no_print content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="no_print breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><?php echo e($meta['page_title']); ?></h5>
                        <ol class="breadcrumbs mb-0">
                            <?php $__currentLoopData = $meta['bc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="breadcrumb-item <?php if($value == 'active'): ?> active"> <?php echo e($key); ?> <?php else: ?> "><a href="<?php echo e($value); ?>"><?php echo e($key); ?></a><?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div>
                    <?php echo $__env->yieldContent('bc'); ?>
                </div>
            </div>
        </div>
        <div class="col s12 printable">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
<!-- END: Page Main-->

<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span class="right hide-on-small-only">Design and Developed by <a href="https://jaks.pro/">Jaks Pro</a></span></div>
    </div>
</footer>

<div id="remote_modal" class="modal">
</div>
<div id="remote_modal_bottom" class="modal bottom-sheet">

</div>
<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="<?php echo e(asset('assets/js/vendors.min.js')); ?>" type="text/javascript"></script>
<?php echo $__env->yieldContent('other_vendor_java'); ?>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="<?php echo e(asset('assets/js/plugins.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom-script.js')); ?>" type="text/javascript"></script>
<script>
    if (localStorage.getItem('len') == null){
        localStorage.setItem('len', '10');
    }
    $(".card-alert .close").click(function () {
        $(this)
            .closest(".card-alert")
            .fadeOut("slow");
    });
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
    function mark_as_read() {
        $.get("<?php echo e(route('mark_as_read', ['id' => $this_user->id ])); ?>",{})
            .done(function (data) {
                if (data === 'yes'){
                    notify('All notification marked read!', 'success')
                }
                $('.unread').removeClass('pulse red unread').addClass('green');
                $('.notification-badge ').text(0).removeClass('pulse');

            })
        
    }
    $(document).on('click', '.n_action', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var id = $(this).data('id');
        var span = $(this).children('span.unread');
        if ($(this).find('.unread').length == 1){
            $.get("/mark_read/"+id,{})
                .done(function (data) {
                    span.removeClass('pulse red unread').addClass('green');
                   var badge =  $('.notification-badge ');
                   var n = parseInt(badge.text())-1;
                   badge.text(n <0? 0:n);
                   if (n==0){
                       badge.removeClass('pulse');
                   }
                })
        }
        if (! $(this).is('.remote, .remote_b')) {
            window.location.href = url;
        }

    });
    $('.modal').modal();
    function confirm_delete(url) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, Delete It'
            }
        }).then(function (willDelete) {
            if (willDelete) {
                location.replace(url);
            } else {
                swal("Your data is safe", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        });
    }
    var take = 10;
    $('#notifications-dropdown').scroll(function () {
        console.log((this.offsetHeight + this.scrollTop), this.scrollHeight);

        if (this.offsetHeight + this.scrollTop >= (this.scrollHeight-1)) {
            $.get("<?php echo e(route('load_more', ['id' => $this_user->id ,'take' => '' ])); ?>/"+take,{})
                .done(function (data) {
                    if (data === 'no'){
                        notify('No more notification for you', 'info');
                        $('#last_n').text('End')
                    }else{
                        $('#last_n').before(data);
                        take+=10;
                    }

                });
        }

    });
    $(document).on('click', '.remote', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('#remote_modal').load(url,function(result){
            $('#remote_modal').modal('open');
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                showClearBtn:true,
                onOpen: function () {
                    $('#remote_modal').css('overflow', 'visible');
                },
                onClose: function () {
                    $('#remote_modal').css('overflow', 'auto');
                }
            });
        });
    });
    $(document).on('click', '.remote_b', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('#remote_modal_bottom').load(url,function(result){
            $('#remote_modal_bottom').modal('open');
            $('.tabs').tabs();
        });
    });
    $(document).on('change', '.dataTables_length input', function (e) {
        console.log($(this).val());
    });
    <?php if($m = session()->pull('error')): ?>
notify('<?php echo e($m); ?>','error');
    <?php endif; ?>
    <?php if($m = session()->pull('success')): ?>
notify('<?php echo e($m); ?>','success');
    <?php endif; ?>
    <?php if($m = session()->pull('info')): ?>
notify('<?php echo e($m); ?>','info');
    <?php endif; ?>
    <?php if($m = session()->pull('warning')): ?>
notify('<?php echo e($m); ?>','warning');
    <?php endif; ?>
    $(document).ready(function(){
        $('.tooltipped').tooltip({
            html: true
        });
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            showClearBtn:true
        });
    });
</script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<?php echo $__env->yieldContent('other_java'); ?>
<script>
    $('#page-length-option').on( 'length.dt', function ( e, settings, len ) {
        localStorage.setItem('len', len);
    });
</script>
<!-- END PAGE LEVEL JS-->
</body>
</html><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/layouts/master.blade.php ENDPATH**/ ?>