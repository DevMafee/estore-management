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
            <span class="h4 mt-2"><?php echo $_SESSION['ALL_STOCK_OUTS']; ?></span>
            <a href="<?php echo url('stock_out/create'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">plus_one</i> <b><?php echo $_SESSION['STOCK_OUT_ENTRY']; ?></b>
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                  <th scope="col"><?php echo $_SESSION['APPLICANT']; ?></th>
                  <th scope="col"><?php echo $_SESSION['RECEIVER']; ?></th>
                  <th scope="col"><?php echo $_SESSION['DATE']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                  <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                //print_r($data);
                $i = 0;
                foreach ($data as $head) {
                  if ($head['stock_out_status'] == 1) {
                    $status = '<button type="button" class="btn bg-green waves-effect"><i class="material-icons">check</i> '.$_SESSION['DELIVERED'].'</button>';
                  } else {
                    $status = '<button type="button" class="btn btn-danger waves-effect"><i class="material-icons">report_problem</i>'.$_SESSION['NOT_DELIVERED'].'</button>';
                  }
                  $req_emp = in_out_object("requisitions_id=" . $head['stock_out_requisition'], "requisitions_employee", "requisitions");
                  $applicant = in_out_object("employee_information_id=" . $req_emp->requisitions_employee, "employee_name_en,employee_name_bn", "employee_information");
                  $main_employee = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $applicant->employee_name_en : $applicant->employee_name_bn;
                  if($head['other_receiver'] != null){
                    $employee = $head['other_receiver'];
                  }else{
                    $emp = in_out_object("employee_information_id=" . $head['stock_out_receiver'], "employee_name_en,employee_name_bn", "employee_information");
                    $employee = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;
                  }
                  $se = in_out_object("section_id=" . $head['stock_out_section'], "section_en,section_bn", "section");
                  $section = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $se->section_en : $se->section_bn;
                ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $section; ?></td>
                    <td><?php echo $main_employee; ?></td>
                    <td><?php echo $employee; ?></td>
                    <td><?php echo date('d F, Y', strtotime($head['stock_out_date'])); ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                      <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" title="View Details" data-target="#View_Stock_Outs_<?php echo $head['stock_out_id']; ?>">
                        <i class="material-icons">search</i>
                      </button>
                      <a href="prints/<?php echo md5(rand()) . $head['stock_out_requisition'] . md5(rand()); ?>" target="_blank" type="button" class="btn bg-grey waves-effect" title="Print This">
                        <i class="material-icons">print</i>
                      </a>
                    </td>
                  </tr>
                  <!-- Details Modal -->
                  <div class="modal fade" id="View_Stock_Outs_<?php echo $head['stock_out_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $_SESSION['DETAILS']; ?> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="list-group">
                            <?php
                            $data_details = query_out_2("stock_out_details_stock_out_id=" . $head['stock_out_id'], "*", "stock_out_details");
                            foreach ($data_details as $dd) {
                              $p = in_out_object("product_id=" . $dd['stock_out_details_product'], "product_unit,product_name_en,product_name_bn", "product");
                              $product = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $p->product_name_en : $p->product_name_bn;
                              $product_unit_obj = in_out_object("unit_id=" . $p->product_unit, "unit_en,unit_bn", "unit");
                              $product_unit = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $product_unit_obj->unit_en : $product_unit_obj->unit_bn;
                            ?>
                              <button type="button" class="list-group-item"><?php echo $product; ?>
                                <span class="badge bg-orange" style="padding: 7px !important;"><?php echo $dd['stock_out_details_product_qty'] . ' ' . $product_unit; ?></span>
                              </button>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="reset" class="btn btn-primary" data-dismiss="modal"><?php echo $_SESSION['CLOSE']; ?></button>
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