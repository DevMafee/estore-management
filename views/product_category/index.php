<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['PRODUCT_CATEGORY']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#product_category">
                    <i class="material-icons">control_point</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['PRODUCT_CATEGORY']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['product_status'] == 1) {
                          $active = $_SESSION['LANGUAGE_SETTED']=='en'?'Actice':'সক্রিয়';
                          $status = '<span class="btn bg-green waves-effect"> '.$active.' </span>';
                        } else {
                          $inactive = $_SESSION['LANGUAGE_SETTED']=='en'?'Inactive':'নিষ্ক্রিয়';
                          $status = '<span class="btn bg-orange waves-effect">'.$inactive.'</span>';
                        }
                        $product_category = $_SESSION['LANGUAGE_SETTED']=='en'?$head['product_category_en']:$head['product_category_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $product_category; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_product_category_<?php echo $head['product_category_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_product_category_<?php echo $head['product_category_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_product_category_<?php echo $head['product_category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Edit':'সম্পাদনা করুন'; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('product_category/update/'.$head['product_category_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['product_category_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['product_category_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['product_category_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="product_category_en_<?php echo $head['product_category_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (English)':'পণ্য বিভাগের নাম (ইংরেজি)'; ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_category_en_<?php echo $head['product_category_id']; ?>" name="product_category_en_<?php echo $head['product_category_id']; ?>" value="<?php echo $head['product_category_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="product_category_bn_<?php echo $head['product_category_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (Bengali)':'পণ্য বিভাগের নাম (বাংলা)'; ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_category_bn_<?php echo $head['product_category_id']; ?>" name="product_category_bn_<?php echo $head['product_category_id']; ?>" value="<?php echo $head['product_category_bn']; ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
          <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="Status_product_category_<?php echo $head['product_category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Change Status':'স্ট্যাটাস পরিবির্তন করুন'; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('product_category/update_status/'.$head['product_category_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_category_status_<?php echo $head['product_category_id']; ?>" value="<?php echo $head['product_category_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['product_category_status']==1) {
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-orange waves-effect"> Inactive </span></center>';
            }else{
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-green waves-effect"> Active </span></center>';
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
          <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
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
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="product_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('product_category/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_product_category']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_product_category" value="<?php echo $_SESSION['csrf_token_product_category']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="product_category_en"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (English)':'পণ্য বিভাগের নাম (ইংরেজি)'; ?> <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="product_category_en" name="product_category_en" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (English)':'পণ্য বিভাগের নাম (ইংরেজি)'; ?>..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="product_category_bn"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (Bengali)':'পণ্য বিভাগের নাম (বাংলা)'; ?> <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="product_category_bn" name="product_category_bn" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Product Category Name (Bengali)':'পণ্য বিভাগের নাম (বাংলা)'; ?> ..." required>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
          <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>