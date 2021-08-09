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
            <form action="<?php echo url('stock_out/save'); ?>" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token_stock_out_store_admin']=md5(rand()); ?>
              <input type="hidden" name="csrf_token_stock_out_store_admin" value="<?php echo $_SESSION['csrf_token_stock_out_store_admin']; ?>">
              <div class="modal-body mt-2">

                <div class="row clearfix">
                  <div class="col-md-3">
                    <label for="stock_out_section"><?php echo $_SESSION['SECTION']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select id="stock_out_section" name="stock_out_section" class="form-control select2" onchange="return loadRequisitions(this.value)">
                          <option value="">Select</option>
                        <?php foreach($data as $section){ ?>
                          <option value="<?php echo $section['section_id']; ?>">
                        <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$section['section_en']:$section['section_bn']; ?>
                          </option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="stock_out_requisition"><?php echo $_SESSION['REQUISITIONS']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select id="stock_out_requisition" name="stock_out_requisition" class="form-control" onchange="return loadProducts(this.value)">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="stock_out_receiver"><?php echo $_SESSION['RECEIVER']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select id="stock_out_receiver" name="stock_out_receiver" class="form-control select2">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="stock_out_date"><?php echo $_SESSION['DATE']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" id="stock_out_date" name="stock_out_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row clearfix">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['QTY']; ?></th>
                        </tr>
                      </thead>
                      <tbody id="AddProducts">

                      </tbody>
                    </table>
                  </div>
                </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Stock Out Confirm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function loadRequisitions(section){
    var url = "<?php echo url('stock_out/loadRequisitions/');?>"+section;
    $("#stock_out_requisition").html('');
    $("#stock_out_receiver").html('');
    $("#AddProducts").html('');
    $.ajax({
      url : url,
      method : "GET",
      success : function(data){
        var dt = JSON.parse(data);
        var options = '<option value=""> - Select Requisition - </option>';
        $.each(dt, function (index, value) {
          options += '<option value="'+value.requisitions_id+'">Requisition ID - '+value.requisitions_id+'</option>';
        });
        $("#stock_out_requisition").append(options);
      }
    });
    loadReceiver(section);
    
  }

  function loadReceiver(section){
    var url = "<?php echo url('stock_out/loadReceiver/');?>"+section;
    $("#stock_out_receiver").html('');
    $.ajax({
      url : url,
      method : "GET",
      success : function(data){
        var dt = JSON.parse(data);
        var options = '<option value=""> - Select Receiver - </option>';
        $.each(dt, function (index, value) {
          options += '<option value="'+value.employee_information_id+'">'+value.employee_name_bn+'</option>';
        });
        $("#stock_out_receiver").append(options);
      }
    })
    
  }

  function loadProducts(requisitions_id){
    if (requisitions_id != '') {
      var url = "<?php echo url('stock_out/loadProducts/');?>"+requisitions_id;
      $("#AddProducts").html('');
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          var dt = JSON.parse(data);
          var i = 0;
          var ddd = '';
          $.each(dt, function (index, value) {
            ddd +=`<tr>
                    <td>`+ (++i) +`</td>
                    <td><input type="hidden" name="stock_out_details_product[]" value="`+value.requisitions_product+`"><span class="label bg-teal">`+value.product_name_bn+`</span></td>
                    <td><input type="hidden" name="stock_out_details_product_qty[]" value="`+value.requisitions_approve_product_qty+`">`+ value.requisitions_approve_product_qty +` `+value.unit_bn+`</td>
                  </tr>`;
          });
          $("#AddProducts").append(ddd);
        }
      });
    }else{
      alert('Please Select a Valid Requisition!');
      $("#AddProducts").html('');
    }
  }
</script>