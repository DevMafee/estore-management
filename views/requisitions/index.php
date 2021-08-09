<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <?php if (isset($_SESSION['message']) && $_SESSION['message'] != '') { ?>
          <?php echo $_SESSION['message'];
          $_SESSION['message'] = ''; ?>
        <?php } ?>
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['user_type'] == 1 ? $_SESSION['REQUISITIONS'] : $_SESSION['MY_REQUISITIONS']; ?></span>
            <a href="<?php echo url('requisitions/create'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">plus_one</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New Requisition':'নতুন চাহিদা পত্র যুক্ত করুন'; ?></b>
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['DATE']; ?></th>
                  <?php if ($_SESSION['user_type'] == 1) { ?>
                    <th scope="col"><?php echo $_SESSION['DEMANDER']; ?></th>
                  <?php } ?>
                  <th scope="col"><?php echo $_SESSION['RECEIVER']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                  <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $head) {
                  if ($head['requisitions_status'] == 1) {
                    $status = '<button type="button" class="btn bg-amber waves-effect" style="color:#000 !important;"><i class="material-icons" style="color:#000 !important;">home</i> '.$_SESSION['PENDING'].'</button>';
                  } elseif ($head['requisitions_status'] == 2) {
                    $status = '<button type="button" class="btn bg-blue waves-effect"><i class="material-icons">verified_user</i> '.$_SESSION['APPROVED'].'</button>';
                  } elseif ($head['requisitions_status'] == 3) {
                    $status = '<button type="button" class="btn bg-green waves-effect"><i class="material-icons">flight_takeoff</i> '.$_SESSION['RECEIVEDQTY'].'</button>';
                  } else {
                    $status = '<button type="button" class="btn btn-danger waves-effect"><i class="material-icons">report_problem</i> '.$_SESSION['REJECTED'].'</button>';
                  }

                  $emp = in_out_object("employee_information_id=" . $head['requisitions_employee'], "employee_name_en,employee_name_bn", "employee_information");
                  $employee = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;
                  if ($head['requisitions_receiver'] != '') {
                    $emp_r = in_out_object("employee_information_id=" . $head['requisitions_receiver'], "employee_name_en,employee_name_bn", "employee_information");
                    $receiver = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp_r->employee_name_en??'' : $emp_r->employee_name_bn??'';
                  } else {
                    $receiver = '';
                  }

                ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo date('d F, Y', strtotime($head['requisitions_date'])); ?></td>
                    <?php if ($_SESSION['user_type'] == 1) { ?>
                      <td><?php echo $employee; ?></td>
                    <?php } ?>
                    <td><?php echo $receiver; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                      <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" title="View Details" data-target="#View_requisitions_<?php echo $head['requisitions_id']; ?>">
                        <i class="material-icons">search</i>
                      </button>
                      <?php if ($head['requisitions_status'] == 3) { ?>
                        <a href="prints/<?php echo md5(rand()) . $head['requisitions_id'] . md5(rand()); ?>" target="_blank" type="button" class="btn bg-grey waves-effect" title="Print This">
                          <i class="material-icons">print</i>
                        </a>
                      <?php } else { ?>
                        <a href="prints_woa/<?php echo md5(rand()) . $head['requisitions_id'] . md5(rand()); ?>" target="_blank" type="button" class="btn bg-grey waves-effect" title="Print This">
                          <i class="material-icons">print</i>
                        </a>
                      <?php } ?>
                    </td>
                  </tr>

                  <!-- Details Modal -->
                  <div class="modal fade" id="View_requisitions_<?php echo $head['requisitions_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Details':'বিবরণ'; ?> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="list-group">
                            <?php
                            $data_details = query_out_2("requisitions_id=" . $head['requisitions_id'], "*", "requisitions_details");
                            foreach ($data_details as $dd) {
                              $p = in_out_object("product_id=" . $dd['requisitions_product'], "product_unit,product_name_en,product_name_bn", "product");
                              $product = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $p->product_name_en : $p->product_name_bn;
                              $product_unit_obj = in_out_object("unit_id=" . $p->product_unit, "unit_en,unit_bn", "unit");
                              $product_unit = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $product_unit_obj->unit_en : $product_unit_obj->unit_bn;
                            ?>
                              <button type="button" class="list-group-item"><?php echo $product; ?>
                                <?php if ($head['requisitions_status'] >= 2) { ?>
                                  <span class="badge bg-green mr-2"><?php echo $_SESSION['APPROVED']; ?> - <?php echo $dd['requisitions_approve_product_qty'] . ' ' . $product_unit; ?></span>
                                <?php } ?>
                                <span class="badge bg-orange mr-2"><?php echo $_SESSION['REQUIRED_QTY']; ?> - <?php echo $dd['requisitions_product_qty'] . ' ' . $product_unit; ?></span>
                              </button>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>