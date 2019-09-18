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
    <div class="col s12 m12 l12">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <h5 class="center-align uppercase">Noble Navigation & Shipping Line</h5>
                <h6 class="center-align">General Expense</h6>
                <h6 class="center-align"><?php echo e($month->format('F-Y')); ?></h6>
                <hr>
                <div class="row mb-5"></div>
                <div class="row">
                    <div class="col s12">
                        <?php if($tr->count()>0): ?>
                            <table>
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Created By</th>
                                    <th class="right-align">Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $tr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php if( $t->created_at != null){
                echo date(option('date_format'), strtotime($t->created_at));
                } ?></td>
                                        <td><?php echo e($t->detail); ?></td>
                                        <td><?php echo e($t->created_by->name); ?></td>
                                        <td class="right-align" ><?php echo number_format($t->amount, 2).' Tk.'; ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="3" class="right-align">Total</td>
                                    <td class="right-align" ><?php echo number_format($tr->sum('amount'), 2).' Tk.'; ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="center-align">No expenses</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/expense/print.blade.php ENDPATH**/ ?>