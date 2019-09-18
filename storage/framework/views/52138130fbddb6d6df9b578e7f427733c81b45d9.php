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
        .collection-item {
            padding: 1px 10px !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($current_trip->count() > 0): ?>
        <div class="row">
        <?php $__currentLoopData = $current_trip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col s12 m12 l4">
            <div id="profile-card" class="card animate fadeLeft">
                <div class="card-image waves-effect waves-block waves-light">
                    <img src="<?php echo e(asset('assets/images/transport.jpg')); ?>" alt="user bg">
                </div>
                <div class="card-content">
                    <img src="<?php echo e(asset('assets/images/avatar-3.png')); ?>" alt="" class="circle responsive-img activator card-profile-image cyan lighten-1 padding-2">
                    <a href="/trips/edit/<?php echo e($ctrip->id); ?>" class="btn-floating btn-move-up waves-effect waves-light indigo accent-2 z-depth-4 right tooltipped" data-position="top" data-tooltip="Edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a onclick="render('income', <?php echo e($ctrip->id); ?>)" class="btn-floating activator btn-move-up waves-effect waves-light green accent-2 z-depth-4 right tooltipped" data-position="top" data-tooltip="Add income">
                        <i class="material-icons">attach_money</i>
                    </a>
                    <a onclick="render('expense', <?php echo e($ctrip->id); ?>)"  class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right tooltipped" data-position="top" data-tooltip="Add expense">
                        <i class="material-icons">money_off</i>
                    </a>
                    <h5 class="card-title" style="display: inline-block !important;">Trip: <?php echo e($ctrip->number); ?></h5>
                    <ul class="collection">
                        <li class="collection-item">Ship: <?php echo e($ctrip->ship->name); ?></li>
                        <li class="collection-item">Type: <?php echo e($ctrip->type); ?></li>
                        <li class="collection-item">Start date : <?php if( $ctrip->start_date != null){
                echo date(option('date_format'), strtotime($ctrip->start_date));
                } ?></li>
                        <li class="collection-item">Sailing start : <?php if( $ctrip->sailing_start != null){
                echo date(option('date_format'), strtotime($ctrip->sailing_start));
                } ?></li>
                        <li class="collection-item">Sailing end : <?php if( $ctrip->sailing_end != null){
                echo date(option('date_format'), strtotime($ctrip->sailing_end));
                } ?></li>
                        <li class="collection-item">End date : <?php if( $ctrip->end_date != null){
                echo date(option('date_format'), strtotime($ctrip->end_date));
                } ?></li>
                        <li class="collection-item">Income: <?php echo number_format($ctrip->income, 2).' Tk.'; ?></li>
                        <li class="collection-item">Expense: <?php echo number_format($ctrip->expense, 2).' Tk.'; ?></li>
                        <li class="collection-item">Profit: <?php echo number_format($ctrip->income-$ctrip->expense, 2).' Tk.'; ?></li>
                    </ul>
                </div>
                <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Add <span id="title_type_<?php echo e($ctrip->id); ?>">Income</span> <i class="material-icons right">close</i>
               </span>
                    <form id="form_tr" action="/transaction/add" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="type" value="" id="type_<?php echo e($ctrip->id); ?>">
                        <input type="hidden" name="trip_id" value="<?php echo e($ctrip->id); ?>">
                        <?php if (\Entrust::can('date')) : ?>
                        <div class="input-field">
                            <input id="date" class="" name="date" required value="<?php echo e(date('Y-m-d')); ?>" type="date">
                            <label for="date">Date</label>
                        </div>
                        <?php endif; // Entrust::can ?>
                        <div class="input-field">
                            <input id="detail" name="detail" required  type="text">
                            <label for="detail">Detail</label>
                        </div>
                        <div class="input-field">
                            <input id="amount" name="amount" required  type="number">
                            <label for="amount">Amount</label>
                        </div>
                        <button class="btn float-right waves-effect waves-green" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <div id="card-stats">
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content cyan white-text">
                        <p class="card-stats-title"><i class="material-icons">timeline</i>Total Trip</p>
                        <h4 class="card-stats-number white-text"><?php echo e($total_trip); ?></h4>




                    </div>
                    <div class="card-action cyan darken-1">
                        <div id="clients-bar" class="center-align"><canvas width="227" height="25" style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeLeft">
                    <div class="card-content red accent-2 white-text">
                        <p class="card-stats-title"><i class="material-icons">attach_money</i>Total Income</p>
                        <h4 class="card-stats-number white-text"><?php echo number_format($total_income, 2).' Tk.'; ?></h4>



                    </div>
                    <div class="card-action red">
                        <div id="sales-compositebar" class="center-align"><canvas width="227" height="25" style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content orange lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">money_off</i> Total expense</p>
                        <h4 class="card-stats-number white-text"><?php echo number_format($total_expense, 2).' Tk.'; ?></h4>
                        
                        
                        
                        
                    </div>
                    <div class="card-action orange">
                        <div id="profit-tristate" class="center-align"><canvas width="227" height="25" style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card animate fadeRight">
                    <div class="card-content green lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">trending_up</i> Total profit</p>
                        <h4 class="card-stats-number white-text"><?php echo number_format($total_profit, 2).' Tk.'; ?></h4>
                        
                        
                        
                        
                    </div>
                    <div class="card-action green">
                        <div id="invoice-line" class="center-align"><canvas width="251" height="25" style="display: inline-block; width: 251.175px; height: 25px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h5 class="center-align grey-text lighten-1">Last 12 months</h5>
        <div class="col s12 m6 l6">
            <div class="card animate fadeUp">
                <div class="card-content  teal">
                    <a class="btn-floating btn-move-up waves-effect waves-light red mt-5 accent-2 z-depth-4 right">
                        <i class="material-icons activator">visibility</i>
                    </a>
                    <div class="line-chart-wrapper">
                        <p class="margin white-text">Trips</p>
                        <canvas id="line-chart" height="114"></canvas>
                    </div>
                </div>
                <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Trips and profit <i class="material-icons right">close</i>
               </span>
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th data-field="country-name">Month</th>
                            <th data-field="item-sold">Trip</th>
                            <th data-field="total-profit">Total Profit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php ($c = count($month)); ?>
                        <?php for($i=0;$i<$c; $i++): ?>
                        <tr>
                            <td><?php echo e($month[$i]); ?></td>
                            <td><?php echo e($trips[$i]); ?></td>
                            <td><?php echo e(count($trips_profit[$i])>0?  number_format($trips_profit[$i][0]->profit).' Tk.':'0 Tk.'); ?></td>
                        </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div id="chartjs-bar-chart" class="card">
                <div class="card-content">
                    <h4 class="card-title">Income vs Expense</h4>
                    <div class="row">
                        <div class="col s12">
                            <div class="sample-chart-wrapper"><canvas id="bar-chart" height="400"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        function render(type, id) {
            console.log(id);
            $('#title_type_'+id).text(type);
            $('#type_'+id).val(type);
        }
        $('#page-length-option').DataTable({
            "processing": true,
            "serverSide": true,
           // responsive: true,
            "ajax": "<?php echo e(route('tripList')); ?>?month=<?php echo e(date('M d, Y')); ?>",
            "columns": [
                {"data": "number"},
                {'data':'ship'},
                {"data": "type"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "status"},
                {'data':'created_by'},
                {"data": "income"},
                {"data": "expense"},
                {"data": "actions"}
            ],
            fnDrawCallback: function (nRow, aData, iDisplayIndex) {
                $('.dropdown-trigger').dropdown({
                        constrainWidth: false,
                    }
                );
                $('.modal').modal();
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
                {targets:5,
                    render:function(a,n,e,s){
                        return a == 'Completed'? '<span class="badge new gradient-45deg-green-teal gradient-shadow" data-badge-caption="'+a+'"></span>':'<span class="badge new gradient-45deg-indigo-blue gradient-shadow" data-badge-caption="'+a+'"></span>'}
                },
                {targets:6,
                    render:function(a,n,e,s){
                        return a.name}
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
                        return "<a class='dropdown-trigger' href='#' data-target='dropdown1'><i class='material-icons'>more_horiz</i></a>" +
                            "<ul id='dropdown1' class='dropdown-content'>" +
                                <?php if (\Entrust::can('expense_add')) : ?> "<li><a class='remote_b' href='/trips/view_modal/"+a+"'><i class='material-icons'>remove_red_eye</i>View</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('expense_add')) : ?> "<li><a class='remote' href='/transaction/add?type=expense&trip="+a+"'><i class='material-icons'>money_off</i>Add Expense</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('income_add')) : ?> "<li><a class='remote' href='/transaction/add?type=income&trip="+a+"' ><i class='material-icons'>attach_money</i>Add Income</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('trip_edit')) : ?> "<li><a href='<?php echo e(route('editTrip',['id'=>''])); ?>/"+a+"'><i class='material-icons'>edit</i>Edit Trip</a></li>" + <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can('trip_delete')) : ?> "<li><a onclick='confirm_delete(\"<?php echo e(route('deleteTrip',['id'=>''])); ?>/"+a+"\")'><i class='material-icons'>delete</i>Delete Trip</a></li>" + <?php endif; // Entrust::can ?>

                        "</ul>";
                    }
                    
                },
            ],
        });
    </script>
    <script src="<?php echo e(asset('assets/vendors/chartjs/chart.min.js')); ?>" type="text/javascript"></script>
    <script>
        var countryRevenueChartCTX = $("#line-chart");

        var countryRevenueChartOption = {
            responsive: true,
            // maintainAspectRatio: false,
            legend: {
                display: false
            },
            hover: {
                mode: "label"
            },
            scales: {
                xAxes: [
                    {
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: "#fff"
                        }
                    }
                ],
                yAxes: [
                    {
                        display: true,
                        fontColor: "#fff",
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: false,
                            fontColor: "#fff"
                        }
                    }
                ]
            }
        };

        var countryRevenueChartData = {
            labels: <?php echo json_encode($month); ?>,
            datasets: [
                {
                    label: "Sales",
                    data: <?php echo json_encode($trips); ?>,
                    fill: false,
                    lineTension: 0,
                    borderColor: "#fff",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#009688",
                    pointHighlightFill: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    borderWidth: 2,
                    pointBorderWidth: 2,
                    pointHoverBorderWidth: 4,
                    pointRadius: 4
                }
            ]
        };
        var countryRevenueChartConfig = {
            type: "line",
            options: countryRevenueChartOption,
            data: countryRevenueChartData
        };
        window.onload = function() {
            var countryRevenueChart = new Chart(countryRevenueChartCTX, countryRevenueChartConfig);
        };
    </script>
    <script>
        //Get the context of the Chart canvas element we want to select
        var ctx = $("#bar-chart");

        // Chart Options
        var chartOptions = {
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide and green
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: "rgb(0, 255, 0)",
                    borderSkipped: "left"
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            legend: {
                position: "top"
            },
            scales: {
                xAxes: [
                    {
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false
                        },
                        scaleLabel: {
                            display: true
                        }
                    }
                ],
                yAxes: [
                    {
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false
                        },
                        scaleLabel: {
                            display: true
                        }
                    }
                ]
            },
            title: {
                display: false,
                text: "Income vs Expense"
            }
        };

        // Chart Data
        var chartData = {
            labels: <?php echo json_encode($month); ?>,
            datasets: [
                {
                    label: "Income",
                    data: <?php echo json_encode($income); ?>,
                    backgroundColor: "#00bcd4",
                    hoverBackgroundColor: "#00acc1",
                    borderColor: "transparent"
                },
                {
                    label: "Expense",
                    data: <?php echo json_encode($expense); ?>,
                    backgroundColor: "#ffeb3b",
                    hoverBackgroundColor: "#fdd835",
                    borderColor: "transparent"
                }
            ]
        };

        var config = {
            type: "bar",

            // Chart Options
            options: chartOptions,

            data: chartData
        };

        // Create the chart
        var barChart = new Chart(ctx, config);
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/home.blade.php ENDPATH**/ ?>