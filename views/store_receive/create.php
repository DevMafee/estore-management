<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['STORE_RECEIVE']; ?></span>
              		<a href="<?php echo url('store_receive/all'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              			<i class="material-icons">shopping_basket</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'All Receive':'সমস্ত গ্রহণ'; ?></b>
              		</a>
              	</div>
                <div class="body">
                  <form action="<?php echo url('store_receive/save'); ?>" method="post" enctype="multipart/form-data">
                    <?php $_SESSION['csrf_token_store_rcv']=md5(rand()); ?>
                    <input type="hidden" name="csrf_token_store_rcv" value="<?php echo $_SESSION['csrf_token_store_rcv']; ?>">
                    <div class="modal-body mt-2">

                      <div class="row clearfix">
                        <input type="hidden" name="store_receive_section" value="2">
                        <!-- <div class="col-md-6">
                          <label for="store_receive_section"><?php //echo $_SESSION['SECTION']; ?></label>
                          <div class="form-group">
                            <div class="form-line">
                              <select id="store_receive_section" name="store_receive_section" class="form-control">
                                <option value="">Select</option>
                              <?php //foreach($data as $section){ ?>
                                <option value="<?php //echo $section['section_id']; ?>">
                              <?php //echo $_SESSION['LANGUAGE_SETTED']=='en'?$section['section_en']:$section['section_bn']; ?>
                                </option>
                              <?php //} ?>
                              </select>
                            </div>
                          </div>
                        </div> -->
                        <div class="col-md-4">
                          <label for="store_receive_indent"><?php echo $_SESSION['INDENT']; ?></label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="store_receive_indent" name="store_receive_indent" class="form-control" placeholder="<?php echo $_SESSION['INDENT']; ?> ..">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="store_receive_supplier"><?php echo $_SESSION['SUPPLIERS']; ?></label>
                          <div class="form-group">
                            <div class="form-line">
                              <select id="store_receive_supplier" name="store_receive_supplier" class="form-control select2">
                                <option value="">- <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> -</option>
                              <?php foreach($data2 as $supplier){ ?>
                                <option value="<?php echo $supplier['suppliers_id']; ?>">
                              <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$supplier['suppliers_en']:$supplier['suppliers_bn']; ?>
                                </option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <!-- <label for="store_receive_comments"><?php //echo $_SESSION['COMMENT']; ?></label> -->
                          <div class="form-group">
                            <div class="form-line">
                              <textarea type="text" id="store_receive_comments" name="store_receive_comments" class="form-control" placeholder="<?php echo $_SESSION['COMMENT']; ?> .."></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th><?php echo $_SESSION['PRODUCT']; ?></th>
                            <th>
                              <?php echo $_SESSION['QTY']; ?>
                            </th>
                            <th>
                              <button type="button" onclick="return addItem();" class="btn bg-teal waves-effect" style="float: right; margin-right: 5px;">
                              <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add Product':'পণ্য যুক্ত করুন'; ?>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody id="AddProducts">

                        </tbody>
                      </table>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Make Store Receive':'স্টোর রিসিভ করুন'; ?></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
<script>
  // $("#AddProducts").delegate(".select2", "change", function(){
  //   alert('HELLO');
  // });
  var opt = "<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?>";
  var plc = "<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Quantity':'পরিমাণ'; ?>";
  function addItem(){
    var store_receive_details_product = '<option value="">'+opt+'</option>';
    var tableRow = '';
    var url = "<?php echo url('product/jsondata');?>";
    $.getJSON(url, function(result){
      $.each(result, function(i, field){
        store_receive_details_product += '<option value="'+field.product_id+'">'+field.product_name_bn+'</option>';
      });
      tableRow = '<tr>\
              <td style="padding-left: 15px !important"><select class="form-control select2" name="store_receive_details_product_id[]" required>'+store_receive_details_product+'</select></td>\
              <td style="padding-left: 15px !important"><input class="form-control" name="store_receive_details_quantity[]" type="number" placeholder="'+plc+' .. "></td>\
              <td><button type="button" onclick="return removeItem(this)" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="float: right; margin-right: 5px;"><i class="material-icons">remove</i></button></td>\
            </tr>';
      $("#AddProducts").append(tableRow);
    });
  }

  function removeItem(e){
    if (confirm('Are you Sure?') == true) {
      e.closest('tr').remove();
    }    
  }

</script>