<style>
    .indigo{
        background-color:white;
        border:1px solid #3F51B5 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #3F51B5 !important;
    }
    .indigo:hover{
        background-color:#3F51B5 !important;
        border:1px solid #3F51B5 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #FFFFFF !important
    }
    
    .cyan{
        background-color:white;
        border:1px solid #00BCD4 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #00BCD4 !important;
    }
    .cyan:hover{
        background-color:#00BCD4 !important;
        border:1px solid #00BCD4 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #FFFFFF !important
    }
    .green{
        background-color:white;
        border:1px solid #4CAF50 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #4CAF50 !important;
    }
    .green:hover{
        background-color:#4CAF50 !important;
        border:1px solid #4CAF50 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #FFFFFF !important
    }
    
    .orange{
        background-color:white;
        border:1px solid #ff9600 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #ff9600 !important;
    }
    .orange:hover{
        background-color:#ff9600 !important;
        border:1px solid #ff9600 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #FFFFFF !important
    }
    .teal{
        background-color:white;
        border:1px solid #009688 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #009688 !important;
    }
    .teal:hover{
        background-color:#009688 !important;
        border:1px solid #009688 !important;
        margin-right: 10px;
        padding: 7px !important;
        font-size:15px;
        color: #FFFFFF !important
    }
</style>
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
            <span class="h4 mt-2"><?php echo $_SESSION['REQUISITIONS_APPROVAL']; ?></span>
            <a href="<?php echo url('requisitions/pendingListPrint'); ?>" target="_BLANK" class="btn btn-warning mt-2 mr-2" style="float: right;">
                <i class="material-icons">print</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Print':'প্রিন্ট করুন'; ?></b>
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                  <th scope="col"><?php echo $_SESSION['DEMANDER']; ?></th>
                  <th scope="col"><?php echo $_SESSION['DATE_REQUISITION']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                  <th scope="col" style="max-width: 100px;"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Take Action':'পদক্ষেপ গ্রহণ করুন'; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $head) {
                  $emp = in_out_object("employee_information_id=" . $head['requisitions_employee'], "employee_name_en,employee_name_bn", "employee_information");
                  $employee = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;

                  $p = in_out_object("section_id=" . $head['requisitions_section'], "section_en,section_bn", "section");
                  $section = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $p->section_en : $p->section_bn;
                  if ($head['requisitions_status'] == 1) {
                    $status = '<button type="button" class="btn bg-teal waves-effect"><i class="material-icons">home</i> '.$_SESSION['PENDING'].'</button>';
                  }
                ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $section; ?></td>
                    <td><?php echo $employee; ?></td>
                    <td><?php echo date_format(date_create($head['requisitions_date']),'d-m-Y'); ?></td>
                    <td><?php echo $status; ?></td>
                    <td style="max-width: 100px;">
                        <?php if ($_SESSION['user_type']=='1' || $_SESSION['user_type']=='3' ||$_SESSION['user_type']=='5') { ?>
                          <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" title="View Details" data-target="#View_requisitions_<?php echo $head['requisitions_id']; ?>">
                            <i class="material-icons">search</i>
                          </button>
                          <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" onclick="return takeActionApprove(<?php echo $head['requisitions_id']; ?>)">
                            <i class="material-icons">check</i>
                          </button>
                          <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" onclick="return takeActionReject(<?php echo $head['requisitions_id']; ?>)">
                            <i class="material-icons">close</i>
                          </button>
                      <?php } ?>
                    </td>
                  </tr>

                  <!-- Details Modal -->
                  <div class="modal fade" id="View_requisitions_<?php echo $head['requisitions_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="width: 90% !important;">
                      <div class="modal-content">
                        <div class="modal-header bg-green">
                          <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Details':'বিবরণ'; ?> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="<?php echo 'form_id_' . $head['requisitions_id']; ?>" onsubmit="return false">
                          <div class="modal-body">
                            <div class="list-group">
                              <?php
                              $data_details = query_out_2("requisitions_id=" . $head['requisitions_id'], "*", "requisitions_details");
                              foreach ($data_details as $dd) {
                                $p = in_out_object("product_id=" . $dd['requisitions_product'], "product_unit,product_name_en,product_name_bn", "product");
                                $product = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $p->product_name_en : $p->product_name_bn;
                                $product_unit_obj = in_out_object("unit_id=" . $p->product_unit, "unit_en,unit_bn", "unit");
                                $product_unit = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $product_unit_obj->unit_en : $product_unit_obj->unit_bn;
                                $ym = date('Y-m');
                                $f_date = $ym . '-01';
                                $l_date = $ym . '-31';
                                $rcv_this_month = in_out_object("`requisitions`.`requisitions_id`=`requisitions_details`.`requisitions_id` AND `requisitions`.`requisitions_section`=" . $head['requisitions_section'] . " AND `requisitions_details`.`requisitions_product`=" . $dd['requisitions_product'] . " AND `requisitions`.`requisitions_date` BETWEEN '$f_date' AND '$l_date'", "SUM(`requisitions_details`.`requisitions_approve_product_qty`) AS approved_qty", "`requisitions`,`requisitions_details`"); //product_limit_section
                                $product_limit = in_out_object("product_limit_product=" . $dd['requisitions_product'] . " AND product_limit_section=" . $head['requisitions_section'] . " ORDER BY product_limit_id DESC LIMIT 0,1", "product_limit_requisition_limit", "product_limit");
                                $limit = !empty($product_limit) ? $product_limit->product_limit_requisition_limit : '0';

                                $product_in_stock = in_out_object("stocks_product_id=" . $dd['requisitions_product'] . " ORDER BY stocks_id DESC LIMIT 0,1", "stocks_current_stock", "stocks");
                                $qtttty = !empty($product_in_stock) ? $product_in_stock->stocks_current_stock : '0';
                              ?>
                                <button type="button" class="list-group-item"><?php echo $product; ?>
                                  <input type="hidden" name="" value="<?php echo $dd['requisitions_product']; ?>">
                                  <input type="hidden" name="<?php echo 'product_id_' . $head['requisitions_id'] . '[]'; ?>" value="<?php echo $dd['requisitions_product']; ?>">
                                  <input type="number" name="<?php echo 'product_qty_' . $head['requisitions_id'] . '[]'; ?>" style="position: relative; float: right; margin-right: 10px; max-width: 60px !important; border-radius: 3px;p adding-left:5px; text-align:right;" id="<?php echo $head['requisitions_id'] . '_' . $dd['requisitions_product'] . '_qty'; ?>" value="<?php echo $dd['requisitions_product_qty']>$qtttty?($qtttty>0?$qtttty:0):$dd['requisitions_product_qty']; ?>">
                                  <span class="badge teal" style=""><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Requisition Quantity':'চাহিত পরিমান'; ?> - <?php echo $dd['requisitions_product_qty'] . ' ' . $product_unit; ?></span>&nbsp;
                                  <span class="badge orange" style=""><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Rest Stock':'অবশিষ্ট মজুদ'; ?> - <?php echo ($limit-($rcv_this_month->approved_qty?$rcv_this_month->approved_qty:0)) . ' ' . $product_unit; ?></span>&nbsp;
                                  <span class="badge green" style=""><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Received Quantity':'গৃহীত পরিমান'; ?> - <?php echo $rcv_this_month->approved_qty > 0 ? $rcv_this_month->approved_qty : '0' . ' ' . $product_unit; ?></span>
                                  <span class="badge cyan" style=""><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Authority':'প্রাধিকার'; ?> - <?php echo $limit . ' ' . $product_unit; ?></span>
                                  <span class="badge indigo" style=""><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Current Stock in Store':'স্টোরে মোট মজুদ'; ?> - <?php echo $qtttty . ' ' . $product_unit; ?></span>
                                </button>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-teal" onclick="return takeActionApprove(<?php echo $head['requisitions_id']; ?>)"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Approve':'অনুমোদন করুন'; ?></button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
                          </div>
                        </form>
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
<script type="text/javascript">
  function takeActionApprove(requisitions_id) {
    swal({
      title: "আপনি কি নিশ্চিত?",
      text: "আপনি এটি আবার নিশ্চিত করতে সক্ষম হবেন না!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "হ্যাঁ, আমি নিশ্চিত",
      cancelButtonText: "না, বন্ধ করুন!",
      closeOnConfirm: false,
      closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $(".confirm").attr('disabled', 'disabled');
          $(".cancel").attr('disabled', 'disabled');

          var url_return = "<?php echo url('requisitions/approval'); ?>";
          var url = "<?php echo url('requisitions/approve_requisitions/'); ?>" + requisitions_id;
          var form_id = '#form_id_' + requisitions_id;
          $.ajax({
            url: url,
            method: "POST",
            data: $(form_id).serialize(),
            success: function(data) {
              if (data == 'SUCCESS') {
                window.location.href = url_return;
              } else {
                console.log(data);
                // window.location.href = url_return;
              }
            }
          });
        } else {
          swal("ধন্যবাদ", "আপনি অপারেশন টি বাতিল করেছেন।", "success");
        }
      }
    );
  }

  function takeActionReject(requisitions_id) {
    swal({
        title: "আপনি কি নিশ্চিত?",
        text: "আপনি এটি আবার নিশ্চিত করতে সক্ষম হবেন না!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "হ্যাঁ, আমি নিশ্চিত",
        cancelButtonText: "না, বন্ধ করুন!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          var url_return = "<?php echo url('requisitions/approval'); ?>";
          var url = "<?php echo url('requisitions/reject_requisitions/'); ?>" + requisitions_id;
          $.ajax({
            url: url,
            method: "GET",
            success: function(data) {
              if (data == 'SUCCESS') {
                window.location.href = url_return;
              }
            }
          });
        } else {
          swal("ধন্যবাদ", "আপনি অপারেশন টি বাতিল করেছেন।", "success");
        }
      }
    );
  }
</script>