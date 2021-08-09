<style type="text/css">
  .list-group-item:hover{
    background-color: #777 !important;
    color:#FFFFFF !important;
  }
</style>
<section class="content">
	<div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['PRODUCT_LIMIT']; ?></span>
            <a href="<?php echo url('product_limit/create'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">
              <i class="material-icons">security</i> <b> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></b>
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                  <th scope="col"><?php echo $_SESSION['YEAR']; ?></th>
                  <th scope="col"><?php echo $_SESSION['MONTH']; ?></th>
                  <th scope="col" style="max-width: 60px;"><?php echo $_SESSION['DETAILS']; ?></th>
                  <!-- <th scope="col"><?php //echo $_SESSION['ACTION']; ?></th> -->
                </tr>
              </thead>
              <tbody>
              <?php
                $i=0;
                foreach($data as $head){
                  $p = in_out_object("section_id=".$head['product_limit_section'], "section_en,section_bn", "section");
                  $section = $_SESSION['LANGUAGE_SETTED']=='en'?$p->section_en:$p->section_bn;
              ?>
                <tr>
                	<td><?php echo ++$i; ?></td>
                	<td><?php echo $section; ?></td>
                  <td><?php echo $head['product_limit_year']; ?></td>
                  <td><?php echo date("F", strtotime($head['product_limit_month'])); ?></td>
                  <td style="max-width: 60px;">
                    <button type="button" class="btn bg-teal waves-effect waves-float" data-toggle="modal" data-target="#largeModal_<?php echo $head['product_limit_section'].$head['product_limit_year'].$head['product_limit_month']; ?>">
                      <i class="material-icons">search</i> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'View Details':'বিস্তারিত দেখুন'; ?>
                    </button>
                  </td>
                	<!-- <td>
                    <a href="<?php //echo url('product_limit/edit/').$head['product_limit_id']; ?>" title="Edit Data">
                      <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
                        <i class="material-icons">edit</i>
                      </button>
                    </a>
                  </td> -->
                </tr>
<!-- Details Modal -->
<div class="modal fade" id="largeModal_<?php echo $head['product_limit_section'].$head['product_limit_year'].$head['product_limit_month']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="largeModalLabel">
          <?php echo $section; ?> এর চাহিদা সীমাবদ্ধতার বিস্তারিত <?php echo date("F", strtotime($head['product_limit_month'])); ?> মাস, <?php echo $head['product_limit_year']; ?> এর জন্য ।
        </h4>
      </div>
      <div class="modal-body">
        <div class="list-group">
      <?php
        $data_details = query_out_2("product_limit_section=".$head['product_limit_section']." AND product_limit_year=".$head['product_limit_year']." AND product_limit_month=".$head['product_limit_month'], "*", "product_limit");

        foreach($data_details as $dt){
          $p = in_out_object("product_id=".$dt['product_limit_product'], "product_unit,product_name_en,product_name_bn", "product");
          $product = $_SESSION['LANGUAGE_SETTED']=='en'?$p->product_name_en:$p->product_name_bn;
          $product_unit_obj = in_out_object("unit_id=".$p->product_unit, "unit_en,unit_bn", "unit");
          $product_unit = $_SESSION['LANGUAGE_SETTED']=='en'?$product_unit_obj->unit_en:$product_unit_obj->unit_bn;
      ?>
          <a href="javascript:void(0);" class="list-group-item">
            <?php echo $product; ?>
            <span class="badge bg-<?php echo $dt['product_limit_status']==1?'orange':'green'; ?>" style="padding: 7px; width: 80px;">
              <?php echo $dt['product_limit_status']==1?'লিমিট আছে':'লিমিট নাই'; ?>
            </span>
            <span class="badge bg-cyan" style="padding: 7px;"><?php echo $dt['product_limit_requisition_limit'].' '.$product_unit; ?></span>
          </a>

      <?php
        }
      ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
      </div>
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