<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
          <div class="header">
            <span class="h4 mt-2"><?php echo isset($_SESSION['LANGUAGE_SET']) ? $_SESSION['LANGUAGE_SET'] : ''; ?></span>
            <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#languages">
              Create New
            </a>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover export-datatable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Language Type</th>
                    <th>Code</th>
                    <th>Text</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($data as $head) {
                    if ($head['languages_status'] == 1) {
                      $status = '<span class="btn bg-green waves-effect"> Active </span>';
                    } else {
                      $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                    }
                  ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $head['languages_type']; ?></td>
                      <td><?php echo $head['languages_code']; ?></td>
                      <td><?php echo $head['languages_text']; ?></td>
                      <td><?php echo $status; ?></td>
                      <td><button class="btn bg-orange" data-toggle="modal" title="Edit" data-target="#Edit_languages<?php echo $head['languages_id']; ?>"><i class="material-icons">edit</i></button></td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="Edit_languages<?php echo $head['languages_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">UPDATE LANGUAGE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?php echo url('languages/update/' . $head['languages_id']); ?>" method="post" enctype="multipart/form-data">
                            <?php $_SESSION['csrf_token_' . $head['languages_id']] = md5(rand()); ?>
                            <input type="hidden" name="csrf_token_<?php echo $head['languages_id']; ?>" value="<?php echo $_SESSION['csrf_token_' . $head['languages_id']]; ?>">
                            <div class="modal-body mt-2">
                              <div class="form-group">
                                <label for="languages_text">Update Language<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="languages_text_<?php echo $head['languages_id']; ?>" name="languages_text_<?php echo $head['languages_id']; ?>" value="<?php echo $head['languages_text']; ?>" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Language Type</th>
                    <th>Code</th>
                    <th>Text</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="languages" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('languages/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_languages'] = md5(rand()); ?>
        <input type="hidden" name="csrf_token_languages" value="<?php echo $_SESSION['csrf_token_languages']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="languages_code">Code <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="languages_code" name="languages_code" class="form-control" placeholder="languages..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="languages_en">English <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="languages_en" name="languages_en" class="form-control" placeholder="English ..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="languages_bn">Bangla <span class="text-danger">*</span></label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="languages_bn" name="languages_bn" class="form-control" placeholder="Bangla ..." required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>