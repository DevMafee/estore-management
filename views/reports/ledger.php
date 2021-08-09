<style>
    .select2-container{
      /*width:200px !important;*/
      width:100% !important;
  }
</style>
<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['PRODUCT_LEDGER']; ?></span>
          </div>
          <div class="body">
            <form action="<?php echo url('product_ledger/load_ledger_report'); ?>" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token_search_ledger']=md5(rand()); ?>
              <input type="hidden" name="csrf_token_search_ledger" value="<?php echo $_SESSION['csrf_token_search_ledger']; ?>">
              <div class="modal-body mt-2">
                <div class="row clearfix">
                  <div class="col-md-3">
                    <label for="product"><?php echo $_SESSION['PRODUCT']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select id="product" name="product" class="form-control select2" required>
                          <option value="">Select</option>
                        <?php foreach($data as $product){ ?>
                          <option value="<?php echo $product['product_id']; ?>">
                        <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$product['product_name_en']:$product['product_name_bn']; echo ' [ '.$product['product_id'].' ]'; ?>
                          </option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="from_date"><?php echo $_SESSION['DATE_FROM']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="to_date"><?php echo $_SESSION['DATE_TO']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label></label>
                    <div class="form-group">
                      <input type="submit" class="btn bg-green" value="SEARCH">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>