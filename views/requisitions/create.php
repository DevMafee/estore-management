<style>
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .select2-container--default .select2-results>.select2-results__options {
    max-height: 400px !important;
  }
  .select2-container{
      /*width:200px !important;*/
      width:100% !important;
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
              <i class="material-icons">next_week</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'My Requisitions':'আমার চাহিদা পত্র সমূহ'; ?></b>
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
                  <div class="col-md-3">
                    <label for="requisitions_section"><?php echo $_SESSION['PRODUCT_CATEGORY']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select class="form-control category_class" name="category_class" required onchange="return loadProducts(this)">
                          <option value="">  - <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> -  </option>
                          <?php
                          foreach ($data3 as $cat) {
                            $cat_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $cat['product_category_en'] : $cat['product_category_bn'];
                          ?>
                            <option value="<?php echo $cat['product_category_id']; ?>"> <?php echo $cat_name; ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <label for="requisitions_date"><?php echo $_SESSION['PRODUCT']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select class="form-control select2 product_class_add" name="requisitions_iopiop[]" multiple>
                          <!--  onchange="addItem(this.value)"> -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="requisitions_date"> &nbsp; </label><br>
                    <button type="button" onclick="return addItem('product_class_add');" class="btn bg-teal btn-block waves-effect" style="float: right; margin-right: 5px;">
                      <?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'Load Items' : 'লোড আইটেম'; ?>
                    </button>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['IN_PRADHIKAR']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['RECEIVED']; ?></th>
                          <!-- <th style="max-width:50px;"><?php //echo $_SESSION['LIMIT']; ?></th> -->
                          <th style="max-width:70px;"><?php echo $_SESSION['REST_STOCK']; ?></th>
                          <th style="max-width:70px;"><?php echo $_SESSION['REQUIRED_QTY']; ?></th>
                          <th>
                            &nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody id="AddProducts">

                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" style="padding:15px;font-size:16px;font-weight:bold;">
                    <?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'Submit Requisition' : 'সাবমিট রিকুইজিশন'; ?>
                  </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function loadProducts(e) {
    var cat = e.value;
    $('.product_class_add').html('');
    var pdList = '';
    var url_product = "<?php echo url('requisitions/jsondata_category/'); ?>" + cat;
    $.getJSON(url_product, function(result) {
      $.each(result, function(i, field) {
        <?php
        if ($_SESSION['LANGUAGE_SETTED'] == 'en') {
        ?>
          pdList += '<option value="' + field.product_id + '">' + field.product_name_en + '</option>';
        <?php } else { ?>
          pdList += '<option value="' + field.product_id + '">' + field.product_name_bn + '</option>';
        <?php } ?>
      });
      $('.product_class_add').append(pdList);
    });
  }

  $("#saveRequisition").submit(function() {
    var url = "<?php echo url('requisitions/save'); ?>";
    // var products = $(".product_class option:selected").html();
    var products = $(".requisitions_product").val();
    if (products != '') {
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
    } else {
      alert('Please Add Atleast one Product!');
    }
  })

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

  var qqqq = "<?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'Quantity' : 'পরিমাণ'; ?>";

  var itemAyyay = [];
  function addItem(itemid) {
    // var tableRow = $("#AddProducts").html();
    var tableRow = '';
    // console.log(tableRow);
    // $("#AddProducts").html('');
    var itemid = $("." + itemid);
    var products = itemid.val();
    console.log(products);
    var url = "<?php echo url('requisitions/jsondata/'); ?>" + products;
    $.getJSON(url, function(result) {
      console.log(result);
      if(result == 'NO_DATA'){
        return true;
      }else{
        $.each(result, function(i, field) {
          var item_dts = field.split(' - ');
          if (item_dts[5] == 1) {
            var ache = 'আছে';
          } else {
            var ache = 'নাই';
          }
          tableRow += '<tr>\
                  <td style="max-width:170px !important;"><input class="form-control requisitions_product" name="requisitions_product[]" type="hidden" value="' + item_dts[0] + '" readonly><input class="form-control" name="requisitions_product_name[]" type="text" value="' + item_dts[1] + '" readonly></td>\
                  <td style="max-width:50px; padding-left: 5px !important"><input class="form-control stock" type="text" value="' + item_dts[2] + '" readonly></td>\
                  <td style="max-width:50px; padding-left: 5px !important"><input class="form-control received-stock" type="text" value="' + item_dts[3] + '" readonly></td>\
                  <td style="max-width:60px; padding-left: 5px !important"><input class="form-control limit-yes-no" type="text" value="' + item_dts[4] + '" readonly></td>\
                  <td style="max-width:100px; padding-left: 5px !important"><input class="form-control requisitions_product_qty" name="requisitions_product_qty[]" type="number" onkeyup="return checkLimitorNot(this)" placeholder="'+qqqq+' .. " required></td>\
                  <td><button type="button" onclick="return removeItem(this)" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="float: right; margin-right: 5px;"><i class="material-icons">remove</i></button></td>\
                </tr>';
        })
        $("#AddProducts").append(tableRow);
      }
    });
    $('.product_class_add').html('');
  }

  function removeItem(e) {
    if (confirm('Are you Sure?') == true) {
      e.closest('tr').remove();
    }
  }
  $(".select2-container").css('width','200px');
</script>