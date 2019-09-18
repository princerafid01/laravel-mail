<?php $__env->startSection('other_vendor_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/data-tables/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/sweetalert/sweetalert.css')); ?>">
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
    <div class="col s12">
        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
            <li>
                <div class="collapsible-header light-blue light-blue-text text-lighten-5">
                    <i class="material-icons">filter_list</i> Filter
                </div>
                <div class="collapsible-body light-blue lighten-5">
                    <form id="filter_form" method="get" action="<?php echo e(route('tripList')); ?>">
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
                            <div class="col m6">
                                <p>Start Date range</p>
                                <div class="input-field col m6">
                                    <input id="start_date1" class="datepicker" name="start_date1" type="text">
                                    <label for="start_date1">Date 1</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="start_date2" class="datepicker" name="start_date2" type="text">
                                    <label for="start_date2">Date 2</label>
                                </div>
                            </div>
                            <div class="col m6">
                                <p>End Date range</p>
                                <div class="input-field col m6">
                                    <input id="end_date1" class="datepicker" name="end_date1" type="text">
                                    <label for="end_date1">Date 1</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="end_date2" class="datepicker" name="end_date2" type="text">
                                    <label for="end_date2">Date 2</label>
                                </div>
                            </div>
                            <div class="col m6">
                                <p>Cargo Quantity range</p>
                                <div class="input-field col m6">
                                    <input id="cargo_quantity1"  name="cargo_quantity1" type="text">
                                    <label for="cargo_quantity1">Quantity</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="cargo_quantity2" name="cargo_quantity2" type="text">
                                    <label for="cargo_quantity2">Quantity</label>
                                </div>
                            </div>
                            <div class="col m6">
                                <p>Fuel range</p>
                                <div class="input-field col m6">
                                    <input id="fuel1"  name="fuel1" type="text">
                                    <label for="fuel1">Fuel</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="fuel2" name="fuel2" type="text">
                                    <label for="fuel2">Fuel</label>
                                </div>
                            </div>
                            <div class="col m6">
                                <p>Income range</p>
                                <div class="input-field col m6">
                                    <input id="income1"  name="income1" type="number">
                                    <label for="income1">Income</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="income2" name="income2" type="number">
                                    <label for="income2">Income</label>
                                </div>
                            </div>
                            <div class="col m6">
                                <p>Expense range</p>
                                <div class="input-field col m6">
                                    <input id="expense1"  name="expense1" type="number">
                                    <label for="expense1">Expense</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="expense2" name="expense2" type="number">
                                    <label for="expense2">Expense</label>
                                </div>
                            </div>
                            <div class="input-field col m4">
                                <input id="cargo" class="" name="cargo" value="<?php echo e(old('cargo')); ?>" type="text">
                                <label for="start_date">Cargo</label>
                            </div>
                            <div class="input-field col m4">
                                <select name="type" id="type">
                                    <option value="">All</option>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                </select>
                                <label for="status">Type</label>
                            </div>
                            <div class="input-field col m4">
                                <select name="status" id="status">
                                    <option value="">All</option>
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
                                <button class="btn cyan waves-effect waves-light right" type="submit" id="filer">Filter
                                    <i class="material-icons right">filter_list</i>
                                </button>
                                <button class="btn cyan waves-effect waves-light right mr-1" type="reset" id="filer">Clear form
                                    <i class="material-icons right">refresh</i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </li>
            <li class="active">
                <div id="table_tab" class="collapsible-header light-blue light-blue-text text-lighten-5">
                    <i class="material-icons">timeline</i> Trips
                </div>
                <div class="collapsible-body light-blue lighten-5">
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
                    <a class="mb-0 btn waves-effect waves-light green darken-1 float-right" id="reset">Reset Filter</a>
                    <div class="section section-data-tables">
                    <table id="page-length-option" style="cursor: pointer" class="display DataTable stripe">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ship</th>
                            <th>Trip type</th>
                            <th>Start</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Income</th>
                            <th>Expense</th>
                            <th>Profit</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <?php if (\Entrust::can('trip_add')) : ?>
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn " ><a href="<?php echo e(route('addTrip')); ?>" class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow tooltipped" data-position="top" data-tooltip="Add new Trip"><i class="material-icons">add</i></a>
    </div>
    <?php endif; // Entrust::can ?>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('other_vendor_java'); ?>
    <script src="<?php echo e(asset('assets/vendors/data-tables/js/jquery.dataTables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/sweetalert/sweetalert.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('other_java'); ?>
    <script>
      var DT = $('#page-length-option').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": localStorage.getItem('len'),
          "order": [],
            "ajax": "<?php echo e(route('tripList')); ?>",
            "columns": [
                {"data": "number"},
                {'data':'ship'},
                {"data": "type"},
                {"data": "start_date"},
                {"data": "status"},
                {'data':'created_by'},
                {"data": "income"},
                {"data": "expense"},
                {"data":"profit"},
                {"data": "id"}
            ],
            fnDrawCallback: function (nRow, aData, iDisplayIndex) {
                $('.dropdown-trigger').dropdown({
                    constrainWidth: false,
                    }
                );
                $('.modal').modal();
            },
              rowCallback: function( row, data ) {
                  row.id = data.id;
                  row.className = "trip_link";
              },
            columnDefs:[
                {targets:1,
                    render:function(a,n,e,s){
                        return a.name}
                },
                {targets:2,
                    render:function(a,n,e,s){
                        return a == 'Single'? '<span class="badge new gradient-45deg-green-teal gradient-shadow" data-badge-caption="'+a+'"></span>':'<span class="badge new gradient-45deg-purple-deep-orange gradient-shadow" data-badge-caption="'+a+'"></span>'}
                },
                {targets:4,
                    render:function(a,n,e,s){
                        return a == 'Completed'? '<span class="badge new gradient-45deg-green-teal gradient-shadow" data-badge-caption="'+a+'"></span>':'<span class="badge new gradient-45deg-indigo-blue gradient-shadow" data-badge-caption="'+a+'"></span>'}
                },
                {targets:5,
                    render:function(a,n,e,s){
                        return a.name}
                },
                {targets:6,
                    render:function(a,n,e,s){
                        return formatMoney(a)}
                },
                {targets:7,
                    render:function(a,n,e,s){
                        return formatMoney(a)}
                },
                {targets:8,
                    render:function(a,n,e,s){
                        return formatMoney(a)}
                },
                {targets:9,
                    render:function(a,n,e,s) {
                        return "<a class='dropdown-trigger' href='#' data-target='dropdown"+a+"'><i class='material-icons'>more_horiz</i></a>" +
                            "<ul id='dropdown"+a+"' class='dropdown-content'>" +
                                <?php if (\Entrust::can('expense_view')) : ?> "<li><a  href='/trips/view/"+a+"'><i class='material-icons'>print</i>Print View</a></li>" +<?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('expense_add')) : ?> "<li><a class='remote' href='/transaction/add?type=expense&trip="+a+"'><i class='material-icons'>money_off</i>Add Expense</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('income_add')) : ?> "<li><a class='remote' href='/transaction/add?type=income&trip="+a+"' ><i class='material-icons'>attach_money</i>Add Income</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('trip_edit')) : ?> "<li><a href='<?php echo e(route('editTrip',['id'=>''])); ?>/"+a+"'><i class='material-icons'>edit</i>Edit Trip</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('trip_delete')) : ?> "<li><a onclick='confirm_delete(\"<?php echo e(route('deleteTrip',['id'=>''])); ?>/"+a+"\")'><i class='material-icons'>delete</i>Delete Trip</a></li>" + <?php endif; // Entrust::can ?>

                            "</ul>";
                    }
                        
                },
            ],
        });
    $('#filter_form').on('submit', function (e) {
        e.preventDefault();
        form = $(this);
        $('#table_tab').trigger('click');
        var url = "<?php echo e(route('tripList')); ?>?"+form.serialize();
        DT.ajax.url(url).load();
    })
      $(document).on('click','.trip_link td:not(:last-child)', function () {
          var id = $(this).parent('.trip_link').attr('id');
          var url = '<?php echo e(route('TripViewModal', ['id'=>''])); ?>/'+id;
          $('#remote_modal_bottom').load(url,function(result){
              $('#remote_modal_bottom').modal('open');
              $('.tabs').tabs();
          });
      });
        $('#reset').on('click', function () {
            var url = "<?php echo e(route('tripList')); ?>";
            DT.ajax.url(url).load();
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/trips/index.blade.php ENDPATH**/ ?>