<section class="content">
	<div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
        	<div class="header">
        		<span class="h4 mt-2"><?php echo $_SESSION['PRODUCT_LIMIT']; ?></span>
        		<a href="<?php echo url('product_limit/all'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">next_week</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'View All':'সব দেখুন'; ?></b>
            </a>
        	</div>
          <div class="body">
            <form action="<?php echo url('product_limit/save'); ?>" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token_store_rcv']=md5(rand()); ?>
              <input type="hidden" name="csrf_token_store_rcv" value="<?php echo $_SESSION['csrf_token_store_rcv']; ?>">
              <div class="modal-body mt-2">
<?php foreach($data4 as $ddt){$ddt_section=$ddt['product_limit_section'];$ddt_date=$ddt['product_limit_date'];} ?>
                <div class="row clearfix">
                  <div class="col-md-6">
                    <label for="product_limit_section"><?php echo $_SESSION['SECTION']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <select id="product_limit_section" name="product_limit_section" class="form-control select2">
                          <option value="">- <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> -</option>
                        <?php foreach($data as $section){ ?>
                          <option value="<?php echo $section['section_id']; ?>" <?php echo $section['section_id']==$ddt_section?'selected':''; ?>>
                        <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$section['section_en']:$section['section_bn']; ?>
                          </option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="product_limit_date"><?php echo $_SESSION['DATE']; ?></label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" id="product_limit_date" name="product_limit_date" class="form-control" value="<?php echo $ddt_date; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row clearfix">
                  <div class="col-md-6" style="border-right: 1px solid #CCC;">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th style="max-width: 80px;"><?php echo $_SESSION['QTY']; ?></th>
                          <th style="max-width: 80px;"><?php echo $_SESSION['STATUS']; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $i=0;
                        foreach($data2 as $p1){
                          $d1 =rand();
                          $product_limit_requisition_limit = 0;
                          $product_limit_status = 1;
                          foreach($data4 as $pd){
                            if ($p1['product_id'] == $pd['product_limit_product']) {
                              $product_limit_requisition_limit=$pd['product_limit_requisition_limit'];
                              $product_limit_status=$pd['product_limit_status'];
                            }
                          }
                      ?>
                        <tr>
                          <td><?php echo ++$i; ?> . <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$p1['product_name_en']:$p1['product_name_bn']; ?></td>
                          <td style="max-width: 80px;"><input type="hidden" name="product_limit_product[]" value="<?php echo $p1['product_id']; ?>"><input type="number" name="product_limit_requisition_limit[]" class="form-control" value="<?php echo $product_limit_requisition_limit; ?>"></td>
                          <td style="max-width: 80px;">
                            <select class="form-control" name="product_limit_status[]" required>
                              <option value="1" <?php echo $product_limit_status==1?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Allow':'অনুমোদিত'; ?></option>
                              <option value="0" <?php echo $product_limit_status==0?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Not-allow':'অনুমতি নেই'; ?></option>
                            </select>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th style="max-width: 80px;"><?php echo $_SESSION['QTY']; ?></th>
                          <th style="max-width: 80px;"><?php echo $_SESSION['STATUS']; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($data3 as $p2){
                          $d1 =rand();
                          $product_limit_requisition_limit = 0;
                          $product_limit_status = 1;
                          foreach($data4 as $pd){
                            if ($p1['product_id'] == $pd['product_limit_product']) {
                              $product_limit_requisition_limit=$pd['product_limit_requisition_limit'];
                              $product_limit_status=$pd['product_limit_status'];
                            }
                          }
                      ?>
                        <tr>
                          <td><?php echo ++$i; ?> . <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$p2['product_name_en']:$p2['product_name_bn']; ?></td>
                          <td style="max-width: 80px;"><input type="hidden" name="product_limit_product[]" value="<?php echo $p2['product_id']; ?>"><input type="number" name="product_limit_requisition_limit[]" class="form-control" value="<?php echo $product_limit_requisition_limit; ?>"></td>
                          <td style="max-width: 80px;">
                            <select class="form-control" name="product_limit_status[]" required>
                              <option value="1" <?php echo $product_limit_status==1?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Allow':'অনুমোদিত'; ?></option>
                              <option value="0" <?php echo $product_limit_status==0?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Not-allow':'অনুমতি নেই'; ?></option>
                            </select>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>