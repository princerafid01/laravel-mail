<?php $__env->startSection('content'); ?>
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <form class="col s12" id="system_setting_form" method="post" action="<?php echo e(route('settings_post')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="input-field col m4">
                            <input id="site_name" name="site_name" value="<?php echo e(option('site_name')); ?>" type="text">
                            <label for="site_name">Site Name</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="date_format" id="date_format">
                                <?php ($format = option('date_format')); ?>
                                <option value="Y-m-d" <?php if($format == 'Y-m-d'): ?> selected <?php endif; ?>>2019-01-20</option>
                                <option value="d-m-Y" <?php if($format == 'd-m-Y'): ?> selected <?php endif; ?>>20-01-2019</option>
                                <option value="d M Y" <?php if($format == 'd M Y'): ?> selected <?php endif; ?>>20 January 2019</option>
                            </select>
                            <label for="date_format">Date Format</label>
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
        $("#system_setting_form").validate({
            rules: {
                site_name: {
                    required: true
                }
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/settings/index.blade.php ENDPATH**/ ?>