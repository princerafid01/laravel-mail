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

                            <div class="col m6">
                                <p>Date range</p>
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
                            <div class="input-field col m4">
                                <input id="trip" name="trip"  type="text">
                                <label for="trip">Trip</label>
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
                    <i class="material-icons">attach_money</i> Income
                </div>
                <div class="collapsible-body light-blue lighten-5">
                    <a class="mb-0 btn waves-effect waves-light green darken-1 float-right" id="reset">Reset Filter</a>
                    <div class="section section-data-tables">
                    <table id="page-length-option" style="cursor: pointer" class="display DataTable stripe">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Trip</th>
                            <th>Detail</th>
                            <th>Amount</th>
                            <th>Created by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </li>
        </ul>
    </div>
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
//            responsive: true,
            "ajax": "/transactionList?type=income",
            "columns": [
                {"data": "created_at"},
                {'data':'trip'},
                {'data':'detail'},
                {"data": "amount"},
                {"data": "created_by"},
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
              row.className = "transaction_link";
          },
            columnDefs:[
                {targets:1,
                    render:function(a,n,e,s){
                        return  a.number}
                },
                {targets:4,
                    render:function(a,n,e,s){
                        return  a.name}
                },
                {targets:3,
                    render:function(a,n,e,s){
                        return formatMoney(a)}
                },
                {targets:5,
                    render:function(a,n,e,s) {
                        return "<a class='dropdown-trigger' href='#' data-target='dropdown"+a+"'><i class='material-icons'>more_horiz</i></a>" +
                            "<ul id='dropdown"+a+"' class='dropdown-content'>" +
                    <?php if (\Entrust::can('income_edit')) : ?> "<li><a class='remote' href='/transaction/edit/"+a+"'><i class='material-icons'>edit</i>Edit</a></li>" + <?php endif; // Entrust::can ?>
                    <?php if (\Entrust::can('income_delete')) : ?> "<li><a onclick='confirm_delete(\"<?php echo e(route('transactionDelete',['id'=>''])); ?>/"+a+"\")'><i class='material-icons'>delete</i>Delete</a></li>" + <?php endif; // Entrust::can ?>

                            "</ul>";
                    }
                },
            ],
        });
    $('#filter_form').on('submit', function (e) {
        e.preventDefault();
        form = $(this);
        $('#table_tab').trigger('click');
        var url = "/transactionList?type=income&"+form.serialize();
        DT.ajax.url(url).load();
    });
      $(document).on('click','.transaction_link td:not(:last-child)', function () {
          var id = $(this).parent('.transaction_link').attr('id');
          var url = '<?php echo e(route('transactionModal', ['id'=>''])); ?>/'+id;
          $('#remote_modal').load(url,function(result){
              $('#remote_modal').modal('open');
          });
      });
    $('#reset').on('click', function () {
        var url = "/transactionList?type=income";
        DT.ajax.url(url).load();
    })
        $('#trip').autocomplete({
            data: <?php echo $data->toJson(); ?>,
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/transaction/income.blade.php ENDPATH**/ ?>