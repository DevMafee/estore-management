<style>
    a:hover{
        text-decoration:none !important;
        cursor:pointer !important;
    }
</style>
<script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/chartjs/Chart.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if (isset($_SESSION['message']) && $_SESSION['message'] != '') { ?>
                    <?php echo $_SESSION['message'];
                    $_SESSION['message'] = ''; ?>
                <?php } ?>
            </div>
            <?php
            $data3 = json_decode($data3);
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] != 6 ?url('requisitions/all'):url('requisitions/all'); ?>">
                        <div class="info-box bg-teal hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">addchart</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['TOTAL_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['total_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] != 6 ?url('requisitions/approved'):url('requisitions/all'); ?>">
                        <div class="info-box bg-teal hover-expand-effect" style="background-color: #3892d2 !important;">
                            <div class="icon">
                                <i class="material-icons">offline_pin</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['APPROVED_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['approved_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] != 6 ?url('requisitions/approved'):url('requisitions/all'); ?>">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">add_shopping_cart</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['DELIVERED_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['delivered_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] != 6 ?url('requisitions/approval'):url('requisitions/all'); ?>">
                        <div class="info-box bg-teal hover-expand-effect" style="background-color: #568655 !important;">
                            <div class="icon">
                                <i class="material-icons">hourglass_empty</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['TOTAL_PENDING_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['pending_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] == 4 ?url('stock_out/create'):url('requisitions/all'); ?>">
                        <div class="info-box bg-teal hover-expand-effect" style="background-color: #296775 !important;">
                            <div class="icon">
                                <i class="material-icons">label_important</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['TOTAL_PENDING_DELIVERY_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['pending_delivery_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="<?php echo $_SESSION['user_type'] != 6 ?url('requisitions/approval'):url('requisitions/all'); ?>">
                        <div class="info-box bg-cyan hover-expand-effect" style="background-color: #88680f !important;">
                            <div class="icon">
                                <i class="material-icons">help_center</i>
                            </div>
                            <div class="content">
                                <div class="text text-white"><?php echo $_SESSION['TOTAL_REJECT_REQUISITIONS']; ?></div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $data7['rejected_requisitions'][0]['data']; ?>" data-speed="100" data-fresh-interval="5"></div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix card card-body">
        <?php if ($_SESSION['user_type'] != 6) { ?>
            <!-- <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
                <canvas class="card card-body" id="myChartPie" width="600" height="400"></canvas>
            </div> -->
            <!-- <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
                <canvas class="card card-body" id="myChartBar" width="600" height="400"></canvas>
            </div> -->
        <?php } ?>
            <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6" style="margin-top:15px;">
                <canvas class="card card-body" id="myChartBar" width="600" height="400"></canvas>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6" style="margin-top:15px;">
                <canvas class="card card-body" id="stockChartBar" width="600" height="400"></canvas>
            </div>
        </div>
    <script>
        var ctx = document.getElementById('stockChartBar');
        var stockChartBar = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $data8['categories']; ?>,
                datasets: [{
                    label: 'Stocks',
                    data: <?php echo $data8['stocks']; ?>,
                    backgroundColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<?php
$labels = '["'.$_SESSION['TOTAL_REQUISITIONS'].'", "'.$_SESSION['APPROVED_REQUISITIONS'].'", "'.$_SESSION['DELIVERED_REQUISITIONS'].'", "'.$_SESSION['TOTAL_PENDING_REQUISITIONS'].'", "'.$_SESSION['TOTAL_PENDING_DELIVERY_REQUISITIONS'].'", "'.$_SESSION['TOTAL_REJECT_REQUISITIONS'].'"]';
$values = '["'.$data7['total_requisitions'][0]['data'].'", "'.$data7['approved_requisitions'][0]['data'].'", "'.$data7['delivered_requisitions'][0]['data'].'", "'.$data7['pending_requisitions'][0]['data'].'", "'.$data7['pending_delivery_requisitions'][0]['data'].'", "'.$data7['rejected_requisitions'][0]['data'].'"]';
?>
    <script>
        var ctx = document.getElementById('myChartBar');
        var myChartBar = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Requisitions # ',
                    data: <?php echo $values; ?>,
                    backgroundColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('myChartPie');
        var myChartPie = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $data4; ?>,
                datasets: [{
                    label: 'Requisitions # ',
                    data: <?php echo $data5; ?>,
                    backgroundColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderColor: [
                        'rgba(0,206,209)',
                        'rgba(60,179,113)',
                        'rgba(0,139,139)',
                        'rgba(65,105,225)',
                        'rgba(123,104,238)',
                        'rgba(186,85,211)',
                        'rgba(176,196,222)',
                        'rgba(169,169,169)',
                        'rgba(240,255,255)',
                        'rgba(255,222,173)',
                        'rgba(221,160,221)',
                        'rgba(106,90,205)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    </div>
</section>