<?php $__env->startSection('other_css'); ?>
    <style>
        .custom td {
            padding: 5px !important;
        }
        @media  print {
            .custom td {
                padding: 2px !important;
            }
            table {
                font-size: 1.2em;
            }
        }
    </style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
    $income = 0;
    $expense = 0;
    ?>
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h3 class="center-align uppercase"><?php echo e($trip->ship->name); ?></h3>
                <h5 class="center-align"><?php echo e($trip->number); ?></h5>
                <hr>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6">
                        <table class="striped custom">
                            <tr>
                                <td><b class="uppercase strong black-text">Ship</b></td>
                                <td><?php echo e($trip->ship->name); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip Number</b></td>
                                <td><?php echo e($trip->number); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Cargo</b></td>
                                <td><?php echo e($trip->cargo?:'NA'); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Cargo Quantity</b></td>
                                <td><?php echo e($trip->cargo_quantity?:'NA'); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Fuel</b></td>
                                <td><?php echo e($trip->total_fuel?:'NA'); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">From</b></td>
                                <td><?php echo e($trip->from?:'NA'); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">To</b></td>
                                <td><?php echo e($trip->to?:'NA'); ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Status</b></td>
                                <td><?php echo e($trip->status); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col s6">
                        <table class="striped custom">
                            <tr>
                                <td><b class="uppercase strong black-text">Loading Date</b></td>
                                <td><?php if( $trip->start_date != null){
                echo date(option('date_format'), strtotime($trip->start_date));
                } ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Sailing Date</b></td>
                                <td><?php if( $trip->sailing_start != null){
                echo date(option('date_format'), strtotime($trip->sailing_start));
                } ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Sailing End Date</b></td>
                                <td><?php if( $trip->sailing_end != null){
                echo date(option('date_format'), strtotime($trip->sailing_end));
                } ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip End Date</b></td>
                                <td><?php if( $trip->end_date != null){
                echo date(option('date_format'), strtotime($trip->end_date));
                } ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Trip Duration</b></td>
                                <td><?php echo e($trip->duration); ?> days</td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Type</b></td>
                                <td><?php echo e($trip->type); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6">
                        <h6 class="uppercase strong">Expenses</h6>
                        <hr>
                        <?php if($trip->transactions->where('type','expense')->count()>0): ?>
                            <table class="custom">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $trip->transactions->where('type','expense'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php if( $ex->created_at != null){
                echo date(option('date_format'), strtotime($ex->created_at));
                } ?></td>
                                        <td><?php echo e($ex->detail); ?></td>
                                        <td class="right-align"><?php echo number_format($ex->amount, 2).' Tk.'; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="3" class="right-align"><?php echo number_format($expense = $trip->transactions->where('type','expense')->sum('amount'), 2).' Tk.'; ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No expenses</p>
                        <?php endif; ?>
                    </div>
                    <div class="col s6">
                        <h6 class="uppercase strong">Income</h6>
                        <hr>
                        <?php if($trip->transactions->where('type','income')->count()>0): ?>
                            <table class="custom">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $trip->transactions->where('type','income'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php if( $ex->created_at != null){
                echo date(option('date_format'), strtotime($ex->created_at));
                } ?></td>
                                        <td><?php echo e($ex->detail); ?></td>
                                        <td class="right-align"><?php echo number_format($ex->amount, 2).' Tk.'; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="3" class="right-align"><?php echo number_format($income = $trip->transactions->where('type','income')->sum('amount'), 2).' Tk.'; ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No Income</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s6 offset-s6">
                        <table class="custom">
                            <tbody>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Income</b></td>
                                <td class="right-align"><?php echo number_format($income, 2).' Tk.'; ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Expense</b></td>
                                <td class="right-align"><?php echo number_format($expense, 2).' Tk.'; ?></td>
                            </tr>
                            <tr>
                                <td><b class="uppercase strong black-text">Total Profit</b></td>
                                <td class="right-align"><?php echo number_format($income-$expense, 2).' Tk.'; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/trips/view_trip.blade.php ENDPATH**/ ?>