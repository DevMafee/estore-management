<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="header">
            <?php
            //Find Product And Unit Name
            $dt = in_out_object("product_id=" . $data['opening'][0]['product'], "*", "product");
            $product_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $dt->product_name_en : $dt->product_name_bn;

            $dt_unit = in_out_object("unit_id=" . $dt->product_unit, "*", "unit");
            $product_unit = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $dt_unit->unit_en : $dt_unit->unit_bn;

            $date_from = date_create($data['opening'][0]['from_date']);
            $date_to = date_create($data['opening'][0]['to_date']);
            ?>
            <span class="h4 mt-2"><?php echo $product_name . " এর লেজার " . date_format($date_from, 'd F, Y') . ' তারিখ হতে ' . date_format($date_to, 'd F, Y') . ' তারিখ পর্যন্ত'; ?></span>
          </div>
          <div class="body">
            <?php //print_r($data); 
            ?>
            <table class="table table-hover table-striped table-bordered">
              <thead style="background-color: #CCCCCC;">
                <tr>
                  <th scope="col" rowspan="2">#</th>
                  <th scope="col" rowspan="2"><?php echo $_SESSION['DATE']; ?></th>
                  <th scope="col" rowspan="2" align="center" style="text-align: center;"><?php echo $_SESSION['OPENING']; ?></th>
                  <th scope="col" align="center" colspan="3" style="text-align: center;"><?php echo $_SESSION['TRANSACTION']; ?></th>
                  <th scope="col" rowspan="2" align="center" style="text-align: center;"><?php echo $_SESSION['STOCK']; ?></th>
                </tr>
                <tr>
                  <th align="center" style="text-align: right;"><?php echo $_SESSION['PURCHASE']; ?></th>
                  <th align="center" style="text-align: right;"><?php echo $_SESSION['DISTRIBUTION']; ?></th>
                  <th align="center" style="text-align: right;"><?php echo $_SESSION['SECTION']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $stocks_current_stock = $data['opening'][0]['stock'];
                $total_trg_qty_in = 0;
                $total_trg_qty_out = 0;
                if (count($data['data']) > 0) {
                  foreach ($data['data'] as $dtall) {
                    $stocks_date = date_create($dtall['stocks_date']);
                    $opening = $stocks_current_stock;
                    $stocks_trng_qty_rcv = $dtall['stocks_trng_qty_in'];
                    $stocks_current_stock = $stocks_current_stock + $stocks_trng_qty_rcv;
                    $total_trg_qty_in += $dtall['stocks_trng_qty_in'];
                    $stocks_trng_qty_prvd = $dtall['stocks_trng_qty_out'];
                    $stocks_current_stock = $stocks_current_stock - $stocks_trng_qty_prvd;
                    $total_trg_qty_out += $dtall['stocks_trng_qty_out'];
                    $stocks_section = $dtall['stocks_section'];
                ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo date_format($stocks_date, 'd F, Y'); ?></td>
                      <td align="right" style="text-align: right;"><?php echo $opening . ' ' . $product_unit; ?></td>
                      <td align="right" style="text-align: right;"><?php echo $stocks_trng_qty_rcv != '' ? $stocks_trng_qty_rcv . ' ' . $product_unit : ''; ?></td>
                      <td align="right" style="text-align: right;"><?php echo $stocks_trng_qty_prvd != '' ? $stocks_trng_qty_prvd . ' ' . $product_unit : ''; ?></td>

                      <td align="right" style="text-align: right;">
                        <?php
                        if ($stocks_trng_qty_prvd != '') {
                          $p = in_out_object("section_id=" . $stocks_section, "section_en,section_bn", "section");
                          $section = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $p->section_en : $p->section_bn;
                          echo $section;
                        } else {
                          echo " ";
                        }
                        ?>
                      </td>
                      <td align="right" style="text-align: right;"><?php echo $stocks_current_stock . ' ' . $product_unit; ?></td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo date_format($date_to, 'd F, Y'); ?></td>
                    <td align="right" style="text-align: right;"><?php echo $stocks_current_stock . ' ' . $product_unit; ?></td>
                    <td align="center" style="text-align: center;" colspan="2"><?php echo '<span class="badge bg-orange" style="width:250px !important;">লেনদেন হয়নি</span>'; ?></td>
                    <td align="right"></td>
                    <td align="right" style="text-align: right;"><?php echo $stocks_current_stock . ' ' . $product_unit; ?></td>
                  </tr>
                <?php } ?>
                <tr style="background-color: #CCCCCC;">
                  <td colspan="2" align="right"><?php echo $_SESSION['TOTAL']; ?></td>
                  <td align="right"><?php echo $data['opening'][0]['stock'] . ' ' . $product_unit; ?></td>
                  <td align="right"><?php echo $total_trg_qty_in != 0 ? $total_trg_qty_in . ' ' . $product_unit : ''; ?></td>
                  <td align="right"><?php echo $total_trg_qty_out != '' ? $total_trg_qty_out . ' ' . $product_unit : ''; ?></td>
                  <td align="right"></td>
                  <td align="right"><?php echo $stocks_current_stock != '' ? $stocks_current_stock . ' ' . $product_unit : ''; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>