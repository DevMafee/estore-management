<style>
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
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
            <span class="h4 mt-2"><?php echo $_SESSION['CREATE_REQUISITION']; ?></span>
            <a href="<?php echo url('requisitions/all'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">next_week</i> <b>View My Requisitions</b>
            </a>
          </div>
          <div class="body">
            <form onsubmit="return false" id="saveRequisition" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token_req_by_emp'] = md5(rand()); ?>
              <input type="hidden" name="csrf_token_req_by_emp" value="<?php echo $_SESSION['csrf_token_req_by_emp']; ?>">
              <div class="modal-body mt-2">

                <div class="row clearfix">
                  <div class="col-md-6">
                    <label for="requisitions_section"><?php echo $_SESSION['SECTION']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="hidden" id="requisitions_section" name="requisitions_section" class="form-control" value="<?php echo $data; ?>">
                        <input type="text" class="form-control" value="<?php echo $data2; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="requisitions_date"><?php echo $_SESSION['DATE']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" id="requisitions_date" name="requisitions_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th><?php echo $_SESSION['PRODUCT_CATEGORY']; ?></th>
                          <th><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['QTY']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['IN_STOCK']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['IN_PRADHIKAR']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['RECEIVED']; ?></th>
                          <th style="max-width:50px;"><?php echo $_SESSION['LIMIT']; ?></th>
                          <th>
                            <button type="button" onclick="return addItem();" class="btn bg-teal waves-effect" style="float: right; margin-right: 5px;">
                              Add
                            </button>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="AddProducts">

                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" style="padding:15px;font-size:16px;font-weight:bold;">Submit Requisition</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$cat_data = query_out_2("`product_category_status`=1", "*", "product_category");
$cat = '<select class="form-control select2 category_class" name="category_class[]" required onchange="return loadProducts(this)">';
$cat .= '<option value=""> Select </option>';
foreach ($cat_data as $cdata) {
  $cat .= '<option value="' . $cdata['product_category_id'] . '">' . $cdata['product_category_bn'] . '</option>';
}
$cat .= '</select>';

?>

<script>
  $("#saveRequisition").submit(function() {
    var url = "<?php echo url('requisitions/save'); ?>";
    var products = $(".product_class option:selected").html();
    if (confirm('Are you Sure?') == true) {
      $.ajax({
        url: url,
        method: "POST",
        data: $(this).serialize(),
        success: function(data) {
          window.location.href = "<?php echo url('requisitions/all'); ?>";
        }
      })
    }
  })
  addItem();

  function loadProducts(e) {
    var cat = e.value;
    var thisrow = $(e).parent().parent();
    thisrow.find('.product_class').html('');
    var pdList = '<option value=""> Select </option>';
    var url_product = "<?php echo url('requisitions/jsondata_category/'); ?>" + cat;
    $.getJSON(url_product, function(result) {
      $.each(result, function(i, field) {
        pdList += '<option value="' + field.product_id + '">' + field.product_name_bn + '</option>';
      });
      thisrow.find('.product_class').append(pdList);
    });
    console.log(pdList);
  }

  function checkLimitorNot(fieldsProduct) {
    var yesno = $(fieldsProduct).closest('tr').find('td .limit-yes-no').val();
    if (yesno == 'আছে') {
      var typing_qty = parseInt($(fieldsProduct).val());
      var limit = parseInt($(fieldsProduct).closest('tr').find('td .limit-stock').val());
      var received = parseInt($(fieldsProduct).closest('tr').find('td .received-stock').val());
      var limit_received = (limit - received);
      if (typing_qty > limit_received) {
        alert('You Are not Allowed to Exceed Limit');
        $(fieldsProduct).val(limit_received);
      }
    }
    /* else {
      var typing_qty = parseInt($(fieldsProduct).val());
      var stock = $(fieldsProduct).closest('tr').find('td .stock').val();
      if (typing_qty > stock) {
        alert('You Are not Allowed to Exceed Limit');
        $(fieldsProduct).val(stock);
      } else {
        var typing = $(fieldsProduct).val();
      }
    } */
  }

  function stockAndLimit(field) {
    var section = <?php echo $data; ?>;
    var year = <?php echo date('Y'); ?>;
    var month = <?php echo date('m'); ?>;
    var product = field.value;
    var url = "<?php echo url('requisitions/jsondata/'); ?>" + product;
    $.ajax({
      url: url,
      method: "GET",
      success: function(data) {
        var stock = data;
        $(field).closest('tr').find('td .stock').val(stock);
      }
    });

    var url = "<?php echo url('requisitions/jsondataMystocklimit/'); ?>" + product + '-' + section + '-' + year + '-' + month;
    $.ajax({
      url: url,
      method: "GET",
      success: function(limitStock) {
        var limit = limitStock;
        $(field).closest('tr').find('td .limit-stock').val(limit);
      }
    });
    //Stock Limit Query
    var url = "<?php echo url('requisitions/jsondataMystocklimitYesNo/'); ?>" + product + '-' + section + '-' + year + '-' + month;
    $.ajax({
      url: url,
      method: "GET",
      success: function(yes_no) {
        if (yes_no == 0) {
          var yesno = 'নাই';
        } else {
          var yesno = 'আছে';
        }
        $(field).closest('tr').find('td .limit-yes-no').val(yesno);
      }
    });

    //Stock Out Query
    var url = "<?php echo url('requisitions/jsondataMystockReceived/'); ?>" + product + '-' + section + '-' + year + '-' + month;
    $.ajax({
      url: url,
      method: "GET",
      success: function(yes_no) {
        $(field).closest('tr').find('td .received-stock').val(yes_no);
      }
    });
  }

  function addItem() {
    var store_receive_details_product = '<option value="">Select</option>';
    var categories = '<?php echo $cat; ?>';
    var tableRow = '';
    var url = "<?php echo url('product/jsondata'); ?>";
    $.getJSON(url, function(result) {
      $.each(result, function(i, field) {
        store_receive_details_product += '<option value="' + field.product_id + '">' + field.product_name_bn + '</option>';
      });
      tableRow = '<tr>\
              <td style="padding-left: 5px !important;max-width:100px !important;">' + categories + '</td>\
              <td style="max-width:170px !important;"><select class="form-control product_class" name="requisitions_product[]" required onchange="return stockAndLimit(this)">' + store_receive_details_product + '</select></td>\
              <td style="max-width:100px; padding-left: 5px !important"><input class="form-control" name="requisitions_product_qty[]" type="number" onkeyup="return checkLimitorNot(this)" placeholder="Quantity .. "></td>\
              <td style="max-width:50px; padding-left: 5px !important"><input class="form-control stock" type="text" value="0" readonly></td>\
              <td style="max-width:50px; padding-left: 5px !important"><input class="form-control limit-stock" type="text" placeholder="0" value="0" readonly></td>\
              <td style="max-width:50px; padding-left: 5px !important"><input class="form-control received-stock" type="text" placeholder="0" value="0" readonly></td>\
              <td style="max-width:60px; padding-left: 5px !important"><input class="form-control limit-yes-no" type="text" placeholder="0" value="আছে" readonly></td>\
              <td><button type="button" onclick="return removeItem(this)" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="float: right; margin-right: 5px;"><i class="material-icons">remove</i></button></td>\
            </tr>';
      $("#AddProducts").append(tableRow);
    });
  }

  function removeItem(e) {
    if (confirm('Are you Sure?') == true) {
      e.closest('tr').remove();
    }
  }
</script>