<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['UNIT']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#unit">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['UNIT']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['unit_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $unit = $_SESSION['LANGUAGE_SETTED']=='en'?$head['unit_en']:$head['unit_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $unit; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_unit_<?php echo $head['unit_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_unit_<?php echo $head['unit_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_unit_<?php echo $head['unit_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('unit/update/'.$head['unit_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['unit_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['unit_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['unit_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="unit_en_<?php echo $head['unit_id']; ?>">Unit Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="unit_en_<?php echo $head['unit_id']; ?>" name="unit_en_<?php echo $head['unit_id']; ?>" value="<?php echo $head['unit_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="unit_bn_<?php echo $head['unit_id']; ?>">একক এর নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="unit_bn_<?php echo $head['unit_id']; ?>" name="unit_bn_<?php echo $head['unit_id']; ?>" value="<?php echo $head['unit_bn']; ?>" required>
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

<!-- Status Modal -->
<div class="modal fade" id="Status_unit_<?php echo $head['unit_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('unit/update_status/'.$head['unit_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="unit_status_<?php echo $head['unit_id']; ?>" value="<?php echo $head['unit_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['unit_status']==1) {
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-orange waves-effect"> Inactive </span></center>';
            }else{
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-green waves-effect"> Active </span></center>';
            }
          ?>
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
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('unit/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_unit']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_unit" value="<?php echo $_SESSION['csrf_token_unit']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="unit_en">Unit Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="unit_en" name="unit_en" class="form-control" placeholder="Unit Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="unit_bn">একক এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="unit_bn" name="unit_bn" class="form-control" placeholder="একক এর নাম ..." required>
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