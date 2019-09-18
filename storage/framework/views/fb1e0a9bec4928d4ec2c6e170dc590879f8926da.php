<?php $__env->startSection('content'); ?>
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
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
                <form class="col s12" id="add_trip_form" method="post" action="<?php echo e(route('addTripPost')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="input-field col m4">
                            <select name="ship_id" id="ship_id">
                                <?php $__currentLoopData = $ships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ship->id); ?>" <?php if( isset($_GET['shipName']) &&$_GET['shipName'] == $ship->name): ?> selected <?php endif; ?>><?php echo e($ship->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="date_format">Ship</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="from" name="from" value="<?php echo e(old('from')); ?>" type="text">
                            <label for="from">From</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="to" name="to" value="<?php echo e(old('to')); ?>" type="text">
                            <label for="to">To</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="start_date" name="start_date" class="datepicker" value="<?php echo e(old('start_date')); ?>" type="text">
                            <label for="start_date">Loading Start</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="sailing_start" name="sailing_start" class="datepicker" value="<?php echo e(old('sailing_start')); ?>" type="text">
                            <label for="sailing_start">Sailing Start</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="sailing_end" name="sailing_end" class="datepicker" value="<?php echo e(old('sailing_end')); ?>" type="text">
                            <label for="sailing_end">Sailing end</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="end_date"  name="end_date" class="datepicker" value="<?php echo e(old('end_date')); ?>" type="text">
                            <label for="end_date">Discharge End</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="cargo" class="" name="cargo" value="<?php echo e(old('cargo')); ?>" type="text">
                            <label for="start_date">Cargo</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="quantity" class="" name="cargo_quantity" value="<?php echo e(old('cargo_quantity')); ?>" type="text">
                            <label for="quantity">Cargo Quantity</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="total_fuel" class="" name="total_fuel" value="<?php echo e(old('total_fuel')); ?>" type="text">
                            <label for="total_fuel">Total Fuel</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="type" id="type">
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                            </select>
                            <label for="status">Type</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="status" id="status">
                                <option value="Loading">Loading</option>
                                <option value="Sailing">Sailing</option>
                                <option value="Discharging">Discharging</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <label for="status">Status</label>
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
        $("#add_trip_form").validate({
            rules: {
                ship_id: {
                    required: true
                },
                from:'required',
                to:'required',
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
        <?php if($ship != null): ?>
            $('#ship_id').val(<?php echo e($ship_id); ?>);
            <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/trips/add_trip.blade.php ENDPATH**/ ?>