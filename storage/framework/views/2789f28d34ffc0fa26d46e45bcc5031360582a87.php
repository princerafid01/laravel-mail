<?php $__env->startSection('other_vendor_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/data-tables/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('other_css'); ?>
    <style>
        /*----------------------------------------
        Data Tables
------------------------------------------*/
        #main .section-data-tables table
        {
            width: 100%;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable thead th
        {
            min-width: 69px;

            color: #616161;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable thead th.background-image-none
        {
            background-image: none !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable thead th.select-all
        {
            background-image: none !important;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable th,
        #main .section-data-tables .dataTables_wrapper table.dataTable td
        {
            font-weight: 300;

            padding: 17px 14px;

            white-space: nowrap;

            border-bottom: 1px solid #cfd8dc;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable tbody
        {
            overflow: auto;

            max-width: 100%;
            height: 300px;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody th,
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody td
        {
            padding: 8px 14px;

            white-space: nowrap;

            border: none !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody tr td:before,
        #main .section-data-tables .dataTables_wrapper table.dataTable tbody tr th:before
        {
            font-size: .9rem;
            line-height: 14px;

            top: 10px;
            left: -3px;

            width: 12px;
            height: 12px;

            text-indent: 0;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable tfoot th,
        #main .section-data-tables .dataTables_wrapper table.dataTable tfoot td
        {
            font-weight: 300;

            white-space: nowrap;

            border-top: 1px solid #cfd8dc;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr
        {
            height: auto;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd
        {
            background-color: #f4f5f7;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd > .sorting_1
        {
            background-color: transparent;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd.selected,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd.selected
        {
            background-color: #acbad4 !important;
        }
        #main .section-data-tables .dataTables_wrapper table.dataTable.stripe tbody tr .odd.selected th,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr .odd.selected th
        {
            border-radius: 0;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr.hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.display tbody tr:hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.order-column.hover tbody tr.hover > .sorting_1,
        #main .section-data-tables .dataTables_wrapper table.dataTable.order-column.hover tbody tr:hover > .sorting_1
        {
            background-color: transparent;
        }

        #main .section-data-tables .dataTables_wrapper table [type='checkbox'] + span:not(.lever):before,
        #main .section-data-tables .dataTables_wrapper table [type='checkbox']:not(.filled-in) + span:not(.lever):after
        {
            opacity: .5;
            border-radius: 4px !important;
        }

        #main .section-data-tables .dataTables_wrapper .dataTables_length#page-length-option_length,
        #main .section-data-tables .dataTables_wrapper .dataTables_filter#page-length-option_filter
        {
            display: block;
        }


        #main .section-data-tables .dataTables_wrapper .dataTables_length,
        #main .section-data-tables .dataTables_wrapper .dataTables_filter
        {
            display: none;
        }

        #main .section-data-tables .dataTables_wrapper .dataTables_info
        {
            margin-left: 18px;

            color: #616161;
        }

        #main .section-data-tables .dataTables_wrapper .dataTables_paginate,
        #main .section-data-tables .dataTables_wrapper #page-length-option_paginate
        {
            margin-right: .35rem;
            margin-bottom: .75rem;
        }
        #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button,
        #main .section-data-tables .dataTables_wrapper #page-length-option_paginate .paginate_button
        {
            margin-top: .25rem;
            padding: .25em .65em;
        }
        #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
        #main .section-data-tables .dataTables_wrapper #page-length-option_paginate .paginate_button.current,
        #main .section-data-tables .dataTables_wrapper #page-length-option_paginate .paginate_button.current:hover
        {
            color: #fff !important;
            border: 1px solid #2196f3;
            border-radius: 6px;
            background: #2196f3;
            -webkit-box-shadow: 0 0 8px 0 #2196f3;
            box-shadow: 0 0 8px 0 #2196f3;
        }
        #main .section-data-tables .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        #main .section-data-tables .dataTables_wrapper #page-length-option_paginate .paginate_button:hover
        {
            color: #fff !important;
            border: 1px solid #2196f3;
            border-radius: 6px;
            background: #2196f3;
            -webkit-box-shadow: 0 0 8px 0 #2196f3;
            box-shadow: 0 0 8px 0 #2196f3;
        }
    </style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="section section-data-tables">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">Users List</h4>
                            <?php if (\Entrust::can('user_add')) : ?> <a href="<?php echo e(route('addUser')); ?>" class="waves-effect waves-light btn mb-1 float-right">
                                <i class="material-icons right">person_add</i> New User</a> <?php endif; // Entrust::can ?>
                            <div class="row">
                                <div class="col s12">
                                    <table id="page-length-option" class="display DataTable stripe">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Created by</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td><?php echo e($user->role->display_name); ?></td>
                                                <td><?php if($user->active): ?> <span class="badge new gradient-45deg-green-teal gradient-shadow" data-badge-caption="Active"></span> <?php else: ?> <span class="badge gradient-45deg-purple-deep-orange gradient-shadow" data-badge-caption="Inactive"></span> <?php endif; ?></td>
                                                <td><?php echo e($user->created_by->name); ?></td>
                                                <td><?php if (\Entrust::can('user_edit')) : ?> <a class="btn-floating waves-effect waves-light gradient-45deg-indigo-purple tooltipped"  data-position="top" data-tooltip="Edit" href="<?php echo e(route('editUser', ['id'=>$user->id])); ?>"><i class="material-icons">edit</i></a> <?php endif; // Entrust::can ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th><th></th><th></th><th></th><th></th><th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>
<?php $__env->startSection('other_vendor_java'); ?>
    <script src="<?php echo e(asset('assets/vendors/data-tables/js/jquery.dataTables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('other_java'); ?>
    <script>
        $('#page-length-option').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/users/index.blade.php ENDPATH**/ ?>