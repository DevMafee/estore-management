<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['EMP_CLASS']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#emp_class">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['EMP_CLASS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['EMP_CLASS_RANK']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['emp_class_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $emp_class = $_SESSION['LANGUAGE_SETTED']=='en'?$head['emp_class_en']:$head['emp_class_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $emp_class; ?></td>
                        <td><?php echo $head['emp_class_rank']; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_emp_class_<?php echo $head['emp_class_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_emp_class_<?php echo $head['emp_class_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_emp_class_<?php echo $head['emp_class_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('emp_class/update/'.$head['emp_class_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['emp_class_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['emp_class_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['emp_class_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="emp_class_en_<?php echo $head['emp_class_id']; ?>">Employee Class Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="emp_class_en_<?php echo $head['emp_class_id']; ?>" name="emp_class_en_<?php echo $head['emp_class_id']; ?>" value="<?php echo $head['emp_class_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="emp_class_bn_<?php echo $head['emp_class_id']; ?>">কর্মকর্তা শ্রেণী এর নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="emp_class_bn_<?php echo $head['emp_class_id']; ?>" name="emp_class_bn_<?php echo $head['emp_class_id']; ?>" value="<?php echo $head['emp_class_bn']; ?>" required>
          </div>
          <div class="form-group">
            <label for="emp_class_rank_<?php echo $head['emp_class_id']; ?>">Employee Class Rank <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="number" id="emp_class_rank_<?php echo $head['emp_class_id']; ?>" name="emp_class_rank_<?php echo $head['emp_class_id']; ?>" class="form-control" value="<?php echo $head['emp_class_rank']; ?>" required>
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

<!-- Status Modal -->
<div class="modal fade" id="Status_emp_class_<?php echo $head['emp_class_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('emp_class/update_status/'.$head['emp_class_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="emp_class_status_<?php echo $head['emp_class_id']; ?>" value="<?php echo $head['emp_class_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['emp_class_status']==1) {
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
<div class="modal fade" id="emp_class" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('emp_class/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_emp_class']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_emp_class" value="<?php echo $_SESSION['csrf_token_emp_class']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="emp_class_en">Employee Class Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="emp_class_en" name="emp_class_en" class="form-control" placeholder="Employee Class Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="emp_class_bn">কর্মকর্তা শ্রেণী এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="emp_class_bn" name="emp_class_bn" class="form-control" placeholder="কর্মকর্তা শ্রেণী এর নাম ..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="emp_class_rank">Employee Class Rank <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="number" id="emp_class_rank" name="emp_class_rank" class="form-control" placeholder="Employee Class Rank..." required>
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