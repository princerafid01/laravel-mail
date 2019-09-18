<?php $__env->startSection('other_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/daterangepicker.css')); ?>">
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bc'); ?>
    <div class="col s12 m6 l6">
        <form action="/ships/<?php echo e($ship->id); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div>
                <div class="input-field col m8">
                    <input id="icon_prefix1" type="text" class="validate date_range_picker white-text" name="date_range">
                    <label for="icon_prefix1">Date Range</label>
                </div>
                    <div class="input-field col m4">
                        <button class="btn cyan waves-effect waves-light" type="submit" name="action">
                            <i class="material-icons left">filter_list</i> Filter</button>
                    </div>
            </div>
        </form>
    </div>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="chartjs-line-chart" class="card">
        <div class="card-content">
            <h4 class="card-title">Income-Expense-Profit Chart</h4>
            <div id="chartdiv"></div>
        </div>
    </div>
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
    <?php if (\Entrust::can('trip_add')) : ?>
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn " ><a href="<?php echo e(route('addTrip')); ?>?ship_id=<?php echo e($ship->id); ?>" class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow tooltipped" data-position="top" data-tooltip="Add new Trip"><i class="material-icons">add</i></a>
    </div>
    <?php endif; // Entrust::can ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('other_java'); ?>
    <script src="<?php echo e(asset('assets/js/moment.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/daterangepicker.js')); ?>" type="text/javascript"></script>
    <script>
        $('.date_range_picker').daterangepicker({
            opens: 'left',
            startDate: moment('<?php echo e($start->toDatetimeString()); ?>', 'YYYY-MM-DD hh:mm:ss'),
            endDate:  moment('<?php echo e($end->toDatetimeString()); ?>', 'YYYY-MM-DD hh:mm:ss'),
            format:'',
            locale: {
                format: 'DD MMMM, YYYY'
            },
            showDropdowns: 'true',
            ranges: {
                'Today': [moment().hours(0).minutes(0).seconds(0), moment()],
                'Yesterday': [moment().subtract('days', 1).hours(0).minutes(0).seconds(0), moment().subtract('days', 1).hours(23).minutes(59).seconds(59)],
                'Last 7 Days': [moment().subtract('days', 6).hours(0).minutes(0).seconds(0), moment().hours(23).minutes(59).seconds(59)],
                'Last 30 Days': [moment().subtract('days', 29).hours(0).minutes(0).seconds(0), moment().hours(23).minutes(59).seconds(59)],
                'This Month': [moment().startOf('month').hours(0).minutes(0).seconds(0), moment().endOf('month').hours(23).minutes(59).seconds(59)],
                'Last Month': [moment().subtract('month', 1).startOf('month').hours(0).minutes(0).seconds(0), moment().subtract('month', 1).endOf('month').hours(23).minutes(59).seconds(59)],
                'This Year': [moment().startOf('year').hours(0).minutes(0).seconds(0), moment().endOf('year').hours(23).minutes(59).seconds(59)],
                'Last Year': [moment().subtract('year', 1).startOf('year').hours(0).minutes(0).seconds(0), moment().subtract('year', 1).endOf('year').hours(23).minutes(59).seconds(59)]

            }
        });
    </script>
    <script src="<?php echo e(asset('assets/vendors/amcharts4/core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/amcharts4/charts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/amcharts4/themes/animated.js')); ?>"></script>

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

// Themes begin
            am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
            chart.data = <?php echo $tr_data; ?>


// Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.stroke = am4core.color("#43a047");
            series.dataFields.valueY = "income";
            series.dataFields.dateX = "date";
            series.name = 'Income';
            series.tooltipText = "{name}: {income} tk."
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

// Drop-shaped tooltips
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            var series2 = chart.series.push(new am4charts.LineSeries());
            series2.stroke = am4core.color("#ffc400");
            series2.dataFields.valueY = "expense";
            series2.dataFields.dateX = "date";
            series2.name = 'Expense';
            series2.tooltipText = "{name}: {expense} Tk."
            series2.strokeWidth = 2;
            series2.minBulletDistance = 15;

// Drop-shaped tooltips
            series2.tooltip.background.cornerRadius = 20;
            series2.tooltip.background.strokeOpacity = 0;
            series2.tooltip.pointerOrientation = "vertical";
            series2.tooltip.label.minWidth = 40;
            series2.tooltip.label.minHeight = 40;
            series2.tooltip.label.textAlign = "middle";
            series2.tooltip.label.textValign = "middle";

            var series3 = chart.series.push(new am4charts.LineSeries());
            series3.stroke = am4core.color("#4a148c");
            series3.dataFields.valueY = "profit";
            series3.dataFields.dateX = "date";
            series3.name = 'Profit';
            series3.tooltipText = "{name}: {profit} Tk."
            series3.strokeWidth = 2;
            series3.minBulletDistance = 15;

// Drop-shaped tooltips
            series3.tooltip.background.cornerRadius = 20;
            series3.tooltip.background.strokeOpacity = 0;
            series3.tooltip.pointerOrientation = "vertical";
            series3.tooltip.label.minWidth = 40;
            series3.tooltip.label.minHeight = 40;
            series3.tooltip.label.textAlign = "middle";
            series3.tooltip.label.textValign = "middle";

// Make bullets grow on hover
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.3;
            var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
            bullet2.circle.strokeWidth = 2;
            bullet2.circle.radius = 4;
            bullet2.circle.fill = am4core.color("#fff");

            var bullethover2 = bullet2.states.create("hover");
            bullethover2.properties.scale = 1.3;
            var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
            bullet3.circle.strokeWidth = 2;
            bullet3.circle.radius = 4;
            bullet3.circle.fill = am4core.color("#fff");

            var bullethover3 = bullet.states.create("hover");
            bullethover3.properties.scale = 1.3;

// Make a panning cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            chart.events.on("ready", function () {
                dateAxis.zoom({start:0.79, end:1});
            });
            // Add legend
                        chart.legend = new am4charts.Legend();



        }); // end am4core.ready()
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/ships/view.blade.php ENDPATH**/ ?>