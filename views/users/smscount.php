<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <span class="h4">
                SMS List
                <?php echo isset($data2)?'From - '.date("F j, Y, g:i a", strtotime($data2)):date("F j, Y, g:i a"); ?>
                <?php echo isset($data3)?'To - '.date("F j, Y, g:i a", strtotime($data3)):date("F j, Y, g:i a"); ?>
            </span>
            <form action="<?php echo url('users/smscount'); ?>" method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo isset($data2)?$data2:date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo isset($data3)?$data3:date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="to_date" class="form-label" style="color:#FFF">&nbsp; </label><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
          </div>
          <div class="body">
            <div class="table-responsive">
                <table class="table table-hover export-datatable">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Mobile </th>
                      <th> SMS </th>
                      <th> Date & Time </th>
                      <th> Status </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $i = 0;
                    foreach ($data as $value) {
                  ?>
                    <tr>
                      <td class="align-middle"><?php echo ++$i; ?></td>
                      <td class="align-middle"><?php echo $value['number_msisdn']; ?></td>
                      <td class="align-middle"><?php echo $value['sms_body']; ?></td>
                      <td class="align-middle"><?php echo date("F j, Y, g:i a", strtotime($value['datetime_info'])); ?></td>
                      <td class="align-middle"><?php echo $value['sms_status']; ?></td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>