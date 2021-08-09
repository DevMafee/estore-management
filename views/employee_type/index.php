<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['EMPLOYEE_TYPE']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#employee_type">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['EMPLOYEE_TYPE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['employee_type_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $employee_type = $_SESSION['LANGUAGE_SETTED']=='en'?$head['employee_type_en']:$head['employee_type_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $employee_type; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_employee_type_<?php echo $head['employee_type_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_employee_type_<?php echo $head['employee_type_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_employee_type_<?php echo $head['employee_type_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_type/update/'.$head['employee_type_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['employee_type_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['employee_type_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['employee_type_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="employee_type_en_<?php echo $head['employee_type_id']; ?>">Employee Type Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employee_type_en_<?php echo $head['employee_type_id']; ?>" name="employee_type_en_<?php echo $head['employee_type_id']; ?>" value="<?php echo $head['employee_type_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="employee_type_bn_<?php echo $head['employee_type_id']; ?>">কর্মচারী প্রকার এর নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employee_type_bn_<?php echo $head['employee_type_id']; ?>" name="employee_type_bn_<?php echo $head['employee_type_id']; ?>" value="<?php echo $head['employee_type_bn']; ?>" required>
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
<div class="modal fade" id="Status_employee_type_<?php echo $head['employee_type_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_type/update_status/'.$head['employee_type_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="employee_type_status_<?php echo $head['employee_type_id']; ?>" value="<?php echo $head['employee_type_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['employee_type_status']==1) {
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
<div class="modal fade" id="employee_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_type/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_employee_type']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_employee_type" value="<?php echo $_SESSION['csrf_token_employee_type']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="employee_type_en">Employee Type Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="employee_type_en" name="employee_type_en" class="form-control" placeholder="Employee Type Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="employee_type_bn">কর্মচারী প্রকার এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="employee_type_bn" name="employee_type_bn" class="form-control" placeholder="কর্মচারী প্রকার এর নাম ..." required>
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