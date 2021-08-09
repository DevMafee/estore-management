<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['STORE_RECEIVE']; ?></span>
              		<a href="<?php echo url('store_receive/create'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              			<i class="material-icons">control_point</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></b>
              		</a>
              	</div>
                <div class="body">
                  <div class="table-responsive">
                    <table class="table datatable table-hover">
                      <thead>
                        <tr>
                          <th scope="col" rowspan="2">#</th>
                          <th scope="col" rowspan="2"><?php echo $_SESSION['INDENT']; ?></th>
                          <th scope="col" rowspan="2"><?php echo $_SESSION['SUPPLIERS']; ?></th>
                          <th scope="col" rowspan="2"><?php echo $_SESSION['SECTION']; ?></th>
                          <th scope="col" colspan="3"><?php echo $_SESSION['DETAILS']; ?></th>
                        </tr>
                        <tr>
                          <th scope="col"><?php echo $_SESSION['PRODUCT']; ?></th>
                          <th scope="col"><?php echo $_SESSION['QTY']; ?></th>
                          <th scope="col"><?php echo $_SESSION['UNIT']; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $i=0;

                        foreach($data as $head){
                          $section = $_SESSION['LANGUAGE_SETTED']=='en'?$head['section_en']:$head['section_bn'];
                          $supplier_name = $_SESSION['LANGUAGE_SETTED']=='en'?$head['suppliers_en']:$head['suppliers_bn'];
                          $dts = query_out_2("store_receive_details.store_receive_details_rcv_id=".$head['store_receive_id'], "*", "store_receive_details");
                      ?>
                        <tr>
                        	<td><?php echo ++$i; ?></td>
                        	<td><?php echo $head['store_receive_indent'];?></td>
                        	<td><?php echo $supplier_name; ?></td>
                        	<td><?php echo $section; ?></td>
                          <td>
                            <?php
                              foreach ($dts as $dt) {
                                $pdct = in_out_object("product_id=".$dt['store_receive_details_product_id'], "product_name_en,product_name_bn", "product");
                                $pdct_name = $_SESSION['LANGUAGE_SETTED']=='en'?$pdct->product_name_en:$pdct->product_name_bn;
                                echo '<table><tr><td>'.$pdct_name.'</td></tr></table>';
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                              foreach ($dts as $dt) {
                                echo '<table><tr><td>'.$dt['store_receive_details_quantity'].'</td></tr></table>';
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                              foreach ($dts as $dt) {
                                $pdct = in_out_object("product_id=".$dt['store_receive_details_product_id'], "product_unit", "product");
                                $unit = in_out_object("unit_id=".$pdct->product_unit, "unit_en,unit_bn", "unit");
                                $unit_name = $_SESSION['LANGUAGE_SETTED']=='en'?$unit->unit_en:$unit->unit_bn;
                                echo '<table><tr><td>'.$unit_name.'</td></tr></table>';
                              }
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>