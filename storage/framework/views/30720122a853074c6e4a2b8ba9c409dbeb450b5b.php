<?php $__env->startSection('content'); ?>
    <div class="col s12 m12 l12">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                <?php if($errors->any()): ?>
                <div class="card-alert card red">
                    <div class="card-content white-text">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($m); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?php endif; ?>
                <form class="col s12" id="add_user_form" method="post" action="<?php echo e(route('addUserPost')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="input-field col m4">
                            <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" required>
                            <label for="name">Full Name *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required>
                            <label for="email">Email *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="phone" name="phone" type="text" value="<?php echo e(old('phone')); ?>" required>
                            <label for="phone">Phone *</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <label for="status">Status *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="password" name="password" type="password" required autocomplete="new-password">
                            <label for="password">Password *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="password-confirm" name="password_confirmation" type="password"  required autocomplete="new-password">
                            <label for="password-confirm">Confirm Password *</label>
                        </div>
                        <div class="col m4">
                            <label for="role">Role *</label>
                            <select class="error browser-default" id="role" name="role" data-error=".errorTxt6">
                                <option value="" disabled selected>Select Role</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->display_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="input-field">
                                <div class="errorTxt6"></div>
                            </div>
                        </div>

                        <div class="col m4 input-field">
                            <label class="float-right">
                                <input type="checkbox" class="filled-in" name="notify">
                                <span>Send welcome email to user</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
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
                name: {
                    required: true
                },
                email:{
                    required: true,
                    email: true,
                },
                password:{
                    required: true
                },
                'password-confirm': "required",
                role: "required",

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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/users/add_user.blade.php ENDPATH**/ ?>