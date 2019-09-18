<div class="modal-content">
    <h4>Trip - <?php echo e($trip->number); ?></h4>
        <div class="row" id="main-view-tab">
            <div class="col s12">
                <ul class="tabs tab-demo-active z-depth-1 cyan">
                    <li class="tab col m4"><a class="white-text waves-effect waves-light active" href="#sapien">Detail</a>
                    </li>
                    <li class="tab col m4"><a class="white-text waves-effect waves-light" href="#activeone">Income</a>
                    </li>
                    <li class="tab col m4"><a class="white-text waves-effect waves-light" href="#vestibulum">Expense</a>
                    </li>
                </ul>
            </div>
            <div class="col s12">
                <div id="sapien" class="col s12  cyan lighten-4">
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
                                    <td><?php echo e($trip->cargo); ?></td>
                                </tr>
                                <tr>
                                    <td><b class="uppercase strong black-text">Cargo Quantity</b></td>
                                    <td><?php echo e($trip->cargo_quantity); ?></td>
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
                </div>
                <div id="activeone" style="min-height: 200px" class="col s12  cyan lighten-4">
                    <table>
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Detail</th>
                            <th>Amount</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $income; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php if( $i->created_at != null){
                echo date(option('date_format'), strtotime($i->created_at));
                } ?></td>
                                <td><?php echo e($i->detail); ?></td>
                                <td> <?php echo number_format($i->amount, 2).' Tk.'; ?></td>
                                <td> <?php echo e($i->created_by->name); ?></td><td><a class="tooltipped remote" data-position="top" data-tooltip="Edit" href="/transaction/edit/<?php echo e($i->id); ?>"><i class="material-icons">edit</i></a><a style="cursor: pointer" class="tooltipped" data-position="top" data-tooltip="Delete" onclick="confirm_delete('<?php echo e(route('transactionDelete', ['id'=> $i->id])); ?>')"><i class="material-icons">delete</i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div id="vestibulum" style="min-height: 200px" class="col s12  cyan lighten-4">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Detail</th>
                                <th>Amount</th>
                                <th>Created by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php if( $i->created_at != null){
                echo date(option('date_format'), strtotime($i->created_at));
                } ?></td>
                                <td><?php echo e($i->detail); ?></td>
                                <td> <?php echo number_format($i->amount, 2).' Tk.'; ?></td>
                                <td> <?php echo e($i->created_by->name); ?></td>
                                <td><a class="tooltipped remote" data-position="top" data-tooltip="Edit" href="/transaction/edit/<?php echo e($i->id); ?>"><i class="material-icons">edit</i></a><a style="cursor: pointer" class="tooltipped" data-position="top" data-tooltip="Delete" onclick="confirm_delete('<?php echo e(route('transactionDelete', ['id'=> $i->id])); ?>')"><i class="material-icons">delete</i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/trips/view_modal.blade.php ENDPATH**/ ?>