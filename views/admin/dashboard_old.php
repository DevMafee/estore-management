<main class="app-main">
    <div class="wrapper">
      <div class="page">
        <div class="page-inner">
          <div class="page-section">
            <div class="section-block">
              <div class="metric-row">
                <?php $data3 = json_decode( $data3 ); ?>
                <div class="col-lg-2">
                  <a href="user-tasks.html" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> TODAY'S SALES</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub> <span class="value">8</span>
                    </p>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="user-tasks.html" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> LAST 7 DAYS SALES</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub> <span class="value">8</span>
                    </p>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="#" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> LAST 30 DAYS SALES</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub>
                      <span class="value">
                        <?php echo $data3->users; ?>
                      </span>
                    </p>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="user-tasks.html" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> ONGOING ORDERS</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub> <span class="value">8</span>
                    </p>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="user-tasks.html" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> TOTAL CUSTOMERS</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub>
                      <span class="value">
                        <?php echo $data3->sub_menu; ?>
                      </span>
                    </p>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="user-tasks.html" class="metric metric-bordered" style="<?php echo theme_options($_SESSION['user_id'], "grid"); ?>">
                    <div class="metric-badge">
                      <span class="badge badge-lg badge-success" style="width: 100%;"><span class="oi oi-media-record pulse mr-1"></span> TOTAL DUES</span>
                    </div>
                    <p class="metric-value h3">
                      <sub><i class="oi oi-timer"></i></sub>
                      <span class="value">
                        <?php echo $data3->main_menu; ?>
                      </span>
                    </p>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6 col-xl-4">
                <!-- .card -->
                <div class="card card-fluid">
                  <!-- .card-body -->
                  <div class="card-body">
                    <h3 class="card-title"> Tasks Performance </h3><!-- easy-pie-chart -->
                    <div class="text-center pt-3">
                      <div class="chart-inline-group" style="height:214px">
                        <div class="easypiechart" data-toggle="easypiechart" data-percent="60" data-size="214" data-bar-color="#346CB0" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                        <div class="easypiechart" data-toggle="easypiechart" data-percent="50" data-size="174" data-bar-color="#00A28A" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                        <div class="easypiechart" data-toggle="easypiechart" data-percent="75" data-size="134" data-bar-color="#5F4B8B" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                      </div>
                    </div><!-- /easy-pie-chart -->
                  </div><!-- /.card-body -->
                  <!-- .card-footer -->
                  <div class="card-footer">
                    <div class="card-footer-item">
                      <i class="fa fa-fw fa-circle text-indigo"></i> 100% <div class="text-muted small"> Assigned </div>
                    </div>
                    <div class="card-footer-item">
                      <i class="fa fa-fw fa-circle text-purple"></i> 75% <div class="text-muted small"> Completed </div>
                    </div>
                    <div class="card-footer-item">
                      <i class="fa fa-fw fa-circle text-teal"></i> 60% <div class="text-muted small"> Active </div>
                    </div>
                  </div><!-- /.card-footer -->
                </div><!-- /.card -->
              </div><!-- /grid column -->
              <!-- grid column -->
              <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid">
                  <div class="card-body pb-0">
                    <h3 class="card-title"> Leaderboard </h3>
                    <ul class="list-inline small">
                      <li class="list-inline-item">
                        <i class="fa fa-fw fa-circle text-light"></i> Tasks </li>
                      <li class="list-inline-item">
                        <i class="fa fa-fw fa-circle text-purple"></i> Completed </li>
                      <li class="list-inline-item">
                        <i class="fa fa-fw fa-circle text-teal"></i> Active </li>
                      <li class="list-inline-item">
                        <i class="fa fa-fw fa-circle text-red"></i> Overdue </li>
                    </ul>
                  </div>
                  <div class="list-group list-group-flush">
                    <div class="list-group-item">
                      <div class="list-group-item-figure">
                        <a href="user-profile.html" class="user-avatar" data-toggle="tooltip" title="Martha Myers"><img src="assets/images/avatars/uifaces16.jpg" alt=""></a>
                      </div>
                      <div class="list-group-item-body">
                        <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='<div class="text-left small"><i class="fa fa-fw fa-circle text-purple"></i> 2065<br><i class="fa fa-fw fa-circle text-teal"></i> 231<br><i class="fa fa-fw fa-circle text-red"></i> 54</div>'>
                          <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="53.46140163642832" aria-valuemin="0" aria-valuemax="100" style="width: 53.46140163642832%">
                            <span class="sr-only">73.46140163642832% Complete</span>
                          </div>
                          <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="8.217716115261473" aria-valuemin="0" aria-valuemax="100" style="width: 8.217716115261473%">
                            <span class="sr-only">8.217716115261473% Complete</span>
                          </div>
                          <div class="progress-bar bg-red" role="progressbar" aria-valuenow="1.92102454642476" aria-valuemin="0" aria-valuemax="100" style="width: 1.92102454642476%">
                            <span class="sr-only">1.92102454642476% Complete</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid">
                  <div class="list-group list-group-flush">
                    <div class="list-group-item">
                      <div class="list-group-item-body">
                      <?php
                        $users = json_decode( $data2 );
                        foreach($users as $user):
                      ?>
                          <h4 class="text-center bg-teal col-12 text-light"><?php echo $user->full_name; ?></h4>
                          <img src="<?php echo url('assets/user_photo/').$user->user_photo;?>" class="img-responsive thumbnail" style="width: 100%">
                    <?php
                        endforeach;
                    ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
<!-- <script>
  $(document).ready(function(){
    $.ajax({
      url   : 'dashboard/dashboard_data',
      method: 'GET',
      success:function(data){
        console.log(data);
      }
    })
  })
</script> -->