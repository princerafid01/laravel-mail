<?php $__env->startSection('content'); ?>
    <div class="col s12 m6 l6 animate fadeLeft">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title mb-0">Personal Info</h4>
                <ul class="collection">
                    <li class="collection-item">Name: <?php echo e($loggedUser->name); ?></li>
                    <li class="collection-item">Email: <?php echo e($loggedUser->email); ?></li>
                    <li class="collection-item">Phone: <?php echo e($loggedUser->phone); ?></li>
                    <li class="collection-item">Role: <?php echo e($loggedUser->role->display_name); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l6 animate fadeLeft">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title mb-0">Update Info</h4>
                <form id="add_user_form" method="post" action="<?php echo e(route('profilePost')); ?>">
                    <?php echo csrf_field(); ?>
                <?php if (\Entrust::hasRole('super_admin')) : ?>
                <div class="input-field col s12">
                    <input id="name" name="name" value="<?php echo e($loggedUser->name); ?>" type="text" required>
                    <label for="name">Name *</label>
                </div>
                <?php endif; // Entrust::hasRole ?>
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="text" value="<?php echo e($loggedUser->phone); ?>" required>
                    <label for="phone">Phone *</label>
                </div>
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>











































<?php $__env->stopSection(); ?>
<?php $__env->startSection('other_java'); ?>
    <script src="<?php echo e(asset('/')); ?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#add_user_form").validate({
            rules: {
                'password': "required",
                'old_password': "required",
                'password-confirmation': "required",

            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/users/profile.blade.php ENDPATH**/ ?>