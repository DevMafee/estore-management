<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['PRODUCT']; ?></span>
            <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#product">
              <i class="material-icons">control_point</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></b>
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['PRODUCT']; ?></th>
                  <th scope="col"><?php echo $_SESSION['PRODUCT_CATEGORY']; ?></th>
                  <th scope="col"><?php echo $_SESSION['UNIT']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STOCK_LIMIT']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                  <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $head) {
                  if ($head['product_status']==1) {
                    $active = $_SESSION['LANGUAGE_SETTED']=='en'?'Actice':'সক্রিয়';
                    $status = '<span class="btn bg-green waves-effect"> '.$active.' </span>';
                  }else{
                    $inactive = $_SESSION['LANGUAGE_SETTED']=='en'?'Inactive':'নিষ্ক্রিয়';
                    $status = '<span class="btn bg-orange waves-effect">'.$inactive.'</span>';
                  }
                  $category = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $head['product_category_en'] : $head['product_category_bn'];
                  $unit = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $head['unit_en'] : $head['unit_bn'];
                  $product = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $head['product_name_en'] : $head['product_name_bn'];
                ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $product; ?></td>
                    <td><?php echo $category; ?></td>
                    <td><?php echo $unit; ?></td>
                    <td><?php echo $head['product_stock_limit'] . ' ' . $unit; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                      <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_product_<?php echo $head['product_id']; ?>">
                        <i class="material-icons">edit</i>
                      </a>
                      <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_product_<?php echo $head['product_id']; ?>">
                        <i class="material-icons">cached</i>
                      </a>
                    </td>
                  </tr>
                  <!-- Edit Modal -->
                  <div class="modal fade" id="Edit_product_<?php echo $head['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Edit':'সম্পাদনা করুন'; ?> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="<?php echo url('product/update/' . $head['product_id']); ?>" method="post" enctype="multipart/form-data">
                          <?php $_SESSION['csrf_token_' . $head['product_id']] = md5(rand()); ?>
                          <input type="hidden" name="csrf_token_<?php echo $head['product_id']; ?>" value="<?php echo $_SESSION['csrf_token_' . $head['product_id']]; ?>">
                          <div class="modal-body mt-2">
                            <div class="form-group">
                              <div class="form-line">
                                <select class="form-control" name="product_category_<?php echo $head['product_id']; ?>" id="product_category_<?php echo $head['product_id']; ?>" required>
                                  <option value=""> -Select - </option>
                                  <?php foreach ($data2 as $cat) : ?>
                                    <option value="<?php echo $cat['product_category_id']; ?>" <?php echo $cat['product_category_id'] == $head['product_category'] ? 'selected' : ''; ?>><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $cat['product_category_en'] : $cat['product_category_bn']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-line">
                                <select class="form-control" name="product_unit_<?php echo $head['product_id']; ?>" id="product_unit_<?php echo $head['product_id']; ?>" required>
                                  <option value=""> -Select - </option>
                                  <?php foreach ($data3 as $unit) : ?>
                                    <option value="<?php echo $unit['unit_id']; ?>" <?php echo $unit['unit_id'] == $head['product_unit'] ? 'selected' : ''; ?>><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $unit['unit_en'] : $unit['unit_bn']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="product_name_en_<?php echo $head['product_id']; ?>">Product Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="product_name_en_<?php echo $head['product_id']; ?>" name="product_name_en_<?php echo $head['product_id']; ?>" value="<?php echo $head['product_name_en']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="product_name_bn_<?php echo $head['product_id']; ?>">প্রোডাক্ট এর নাম <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="product_name_bn_<?php echo $head['product_id']; ?>" name="product_name_bn_<?php echo $head['product_id']; ?>" value="<?php echo $head['product_name_bn']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="product_stock_limit_<?php echo $head['product_id']; ?>">Product's Stock Limits <span class="text-danger">*</span></label>
                              <div class="form-group">
                                <div class="form-line">
                                  <input type="number" id="product_stock_limit_<?php echo $head['product_id']; ?>" name="product_stock_limit_<?php echo $head['product_id']; ?>" class="form-control" value="<?php echo $head['product_stock_limit']; ?>" required>
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

                  <!-- Status Modal -->
                  <div class="modal fade" id="Status_product_<?php echo $head['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="<?php echo url('product/update_status/' . $head['product_id']); ?>" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="product_status_<?php echo $head['product_id']; ?>" value="<?php echo $head['product_status']; ?>">
                          <div class="modal-body mt-2">
                            <?php
                            if ($head['product_status'] == 1) {
                              echo $status = '<center><span class="h4">Make </span><span class="btn bg-orange waves-effect"> Inactive </span></center>';
                            } else {
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
<div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('product/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_product'] = md5(rand()); ?>
        <input type="hidden" name="csrf_token_product" value="<?php echo $_SESSION['csrf_token_product']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <div class="form-line">
              <select class="form-control" name="product_category" id="product_category" required>
                <option value=""> -Select - </option>
                <?php foreach ($data2 as $cat) : ?>
                  <option value="<?php echo $cat['product_category_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $cat['product_category_en'] : $cat['product_category_bn']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="form-line">
              <select class="form-control" name="product_unit" id="product_unit" required>
                <option value=""> -Select - </option>
                <?php foreach ($data3 as $unit) : ?>
                  <option value="<?php echo $unit['unit_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $unit['unit_en'] : $unit['unit_bn']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="product_name_en">Product Name <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="product_name_en" name="product_name_en" class="form-control" placeholder="Product Name..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="product_name_bn">প্রোডাক্ট এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="product_name_bn" name="product_name_bn" class="form-control" placeholder="প্রোডাক্ট এর নাম ..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="product_stock_limit">Product's Stock Limits <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="number" id="product_stock_limit" name="product_stock_limit" class="form-control" placeholder="Product's Stock Limits ..." required>
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