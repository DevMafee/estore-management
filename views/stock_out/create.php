<?php
$search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
$replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
?>
<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
      <?php if(isset($_SESSION['message']) && $_SESSION['message']!=''){ ?>
        <?php echo $_SESSION['message']; $_SESSION['message']=''; ?>
      <?php } ?>
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['STOCK_OUT_ENTRY']; ?></span>
            <a href="<?php echo url('stock_out/all'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">next_week</i> <b><?php echo $_SESSION['ALL_STOCK_OUTS']; ?></b>
            </a>
          </div>
          <div class="body">
            <div class="modal-body mt-2">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table table-responsive datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['DEMANDER']; ?></th>
                        <th scope="col"><?php echo $_SESSION['DATE_REQUISITION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['DATE_APPROVE']; ?></th>
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
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $section; ?></td>
                        <td><?php echo $employee; ?></td>
                        <td><?php echo $head['requisitions_date']!=''?str_replace( $search_array, $replace_array, date_format(date_create($head['requisitions_date']),"d-m-Y") ):''; ?></td>
                        <td><?php echo $head['requisitions_approve_date']!=''?str_replace( $search_array, $replace_array, date_format(date_create($head['requisitions_approve_date']),"d-m-Y") ):''; ?></td>
                        <?php if ($_SESSION['user_type']=='4') { ?>
                        <td><button type="button" class="btn bg-teal waves-effect" data-toggle="modal" title="View Details" data-target="#View_requisitions_<?php echo $head['requisitions_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'TO Provide':'প্রদান করুন'; ?></button></td>
                        <?php } ?>
                      </tr>
                  <!-- Details Modal -->
                  <div class="modal fade" id="View_requisitions_<?php echo $head['requisitions_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content">
                        <form id="<?php echo 'form_id_' . $head['requisitions_id']; ?>" onsubmit="return false">
                          <div class="modal-header bg-green">
                            <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Details':'বিবরণ'; ?> <input type="date" id="stock_out_date" name="stock_out_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="list-group">
                              <input type="hidden" name="stock_out_section" value="<?php echo $head['requisitions_section']; ?>">
                              <input type="hidden" id="stock_out_requisition" name="stock_out_requisition" value="<?php echo $head['requisitions_id']; ?>">
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

                                $product_in_stock = in_out_object("stocks_product_id=" . $dd['requisitions_product'] . " ORDER BY stocks_id DESC LIMIT 0,1", "stocks_current_stock", "stocks");
                                $qtttty = !empty($product_in_stock) ? $product_in_stock->stocks_current_stock : '0';
                              ?>
  <button type="button" class="list-group-item"><?php echo $product; ?>
    <input type="hidden" name="stock_out_details_product[]" value="<?php echo $dd['requisitions_product']; ?>">
    <input type="hidden" name="stock_out_details_product_qty[]" value="<?php echo $dd['requisitions_approve_product_qty']; ?>">
    <span class="badge bg-default" style="margin-right: 10px; padding: 7px !important;"><?php echo $dd['requisitions_approve_product_qty'] . ' ' . $product_unit; ?></span>
    <!-- <span class="badge bg-indigo" style="margin-right: 10px; padding: 7px !important;"><?php //echo 'মজুদ আছে - ' . $qtttty . ' ' . $product_unit; ?></span> -->
  </button>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <label><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'OTP':'ওটিপি'; ?></label>
                            <input id="otp_<?php echo $head['requisitions_id']; ?>" type="number" name="otp_<?php echo $head['requisitions_id']; ?>" style="height:30px; padding: 5px; margin-right: 10px;" required>
                            &nbsp;&nbsp;&nbsp;
                            <label><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Receiver':'গ্রহণকারী'; ?></label>
                            <select id="stock_out_receiver_<?php echo $head['requisitions_id']; ?>" name="stock_out_receiver" style="height:30px; padding: 5px; margin-right: 10px;" >
                            <?php
                              $empdrop = query_out_2("employee_section=" . $head['requisitions_section'], "employee_name_en,employee_name_bn,employee_information_id", "employee_information");
                              foreach($empdrop as $empdropsingle){
                              $ename = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $empdropsingle['employee_name_en'] : $empdropsingle['employee_name_bn'];
                              $eid = $empdropsingle['employee_information_id'];
                            ?>
                              <option value="<?php echo $eid;?>"><?php echo $ename;?></option>
                            <?php } ?>
                            <option value="other_emp" selected><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Other':'অন্যান্য'; ?></option>
                            </select>
                            <label><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Other :':'অন্যান্য :'; ?></label>
                            <input id="other_receiver_<?php echo $head['requisitions_id']; ?>" type="text" name="other_receiver" style="height:30px; padding: 5px; margin-right: 10px;">
                            <!-- <span id="othersOption"></span> -->
                            <button type="button" class="btn bg-teal" onclick="return takeActionApprove(<?php echo $head['requisitions_id']; ?>)"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'TO Provide':'প্রদান করুন'; ?></button>
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
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $("#stock_out_receiver").change(function(){
    var other_emp = $(this).val();
    alert(other_emp);
    if(other_emp == 'other_emp'){
      $("#other_receiver").removeAttr('required');
      $("#other_receiver").attr('required', 'required');
    }else{
      $("#other_receiver").removeAttr('required');
    }
  })
  
  function takeActionApprove(requisitions_id) {
    let otp = document.getElementById('otp_'+requisitions_id).value;
    if(otp == ''){
      swal({
        title: "অনুগ্রহ করে OTP দিন। ",
        text: "OPT ব্যতীত সম্পন্ন করা সম্ভব নয়।",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ফিরে যান",
        cancelButtonText: "বন্ধ করুন",
        closeOnConfirm: true,
        closeOnCancel: true
      })
      return;
    }
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
          let other_emp = document.getElementById('stock_out_receiver_'+requisitions_id).value;
          let other_receiver = document.getElementById('other_receiver_'+requisitions_id).value;
        //   var other_emp = $("#stock_out_receiver").val();
        //   var other_receiver = $("#other_receiver").val();
          if(other_emp == 'other_emp' && other_receiver == ''){
            swal({
              title: "অনুগ্রহ করে গ্রহণকারীর নাম দিন। ",
              text: "OPT ব্যতীত সম্পন্ন করা সম্ভব নয়।",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ফিরে যান",
              cancelButtonText: "বন্ধ করুন",
              closeOnConfirm: true,
              closeOnCancel: true
            })
            return;
          }
          var stock_out_requisition = $("#stock_out_requisition").val();
          var req_id = "<?php echo md5(rand()); ?>"+stock_out_requisition+"<?php echo md5(rand()); ?>";
          var printUrl = "<?php echo url('stock_out/prints/'); ?>"+req_id;
          
          var url_return = "<?php echo url('stock_out/create'); ?>";
          var url = "<?php echo url('stock_out/save/'); ?>" + requisitions_id;
          var form_id = '#form_id_' + requisitions_id;
          $.ajax({
            url: url,
            method: "POST",
            data: $(form_id).serialize(),
            success: function(data) {
              console.log(data);
              if (data == 'SUCCESS') {
                swal({
                  title: "আপনি সঠিক তথ্য দিয়েছেন।",
                  text: "আপনি সফল হয়েছেন। ",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "ফিরে যান",
                  cancelButtonText: "বন্ধ করুন",
                  closeOnConfirm: true,
                  closeOnCancel: true
                });
                setTimeout(function(){ window.location.href = printUrl; }, 5000);
              } else {
                swal({
                  title: "আপনি ভুল তথ্য দিয়েছেন।",
                  text: "আপনি বিফল হয়েছেন।",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "ফিরে যান",
                  cancelButtonText: "বন্ধ করুন",
                  closeOnConfirm: true,
                  closeOnCancel: true
                });
                setTimeout(function(){ window.location.href = url_return; }, 5000);
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
