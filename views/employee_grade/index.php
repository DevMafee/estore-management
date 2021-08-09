<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['EMPLOYEE_GRADE']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#employee_grade">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['EMPLOYEE_GRADE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['EMPLOYEE_GRADE_RANK']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['employee_grade_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $employee_grade = $_SESSION['LANGUAGE_SETTED']=='en'?$head['employee_grade_en']:$head['employee_grade_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $employee_grade; ?></td>
                        <td><?php echo $head['employee_grade_rank']; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_employee_grade_<?php echo $head['employee_grade_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_employee_grade_<?php echo $head['employee_grade_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_employee_grade_<?php echo $head['employee_grade_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_grade/update/'.$head['employee_grade_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['employee_grade_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['employee_grade_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['employee_grade_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="employee_grade_en_<?php echo $head['employee_grade_id']; ?>">Employee Grade Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employee_grade_en_<?php echo $head['employee_grade_id']; ?>" name="employee_grade_en_<?php echo $head['employee_grade_id']; ?>" value="<?php echo $head['employee_grade_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="employee_grade_bn_<?php echo $head['employee_grade_id']; ?>">কর্মকর্তা গ্রেড এর নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employee_grade_bn_<?php echo $head['employee_grade_id']; ?>" name="employee_grade_bn_<?php echo $head['employee_grade_id']; ?>" value="<?php echo $head['employee_grade_bn']; ?>" required>
          </div>
          <div class="form-group">
            <label for="employee_grade_rank_<?php echo $head['employee_grade_id']; ?>">Employee Grade Rank <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="number" id="employee_grade_rank_<?php echo $head['employee_grade_id']; ?>" name="employee_grade_rank_<?php echo $head['employee_grade_id']; ?>" class="form-control" value="<?php echo $head['employee_grade_rank']; ?>" required>
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
<div class="modal fade" id="Status_employee_grade_<?php echo $head['employee_grade_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_grade/update_status/'.$head['employee_grade_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="employee_grade_status_<?php echo $head['employee_grade_id']; ?>" value="<?php echo $head['employee_grade_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['employee_grade_status']==1) {
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
<div class="modal fade" id="employee_grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_grade/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_employee_grade']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_employee_grade" value="<?php echo $_SESSION['csrf_token_employee_grade']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="employee_grade_en">Employee Grade Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="employee_grade_en" name="employee_grade_en" class="form-control" placeholder="Employee Grade Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="employee_grade_bn">কর্মকর্তা গ্রেড এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="employee_grade_bn" name="employee_grade_bn" class="form-control" placeholder="কর্মকর্তা গ্রেড এর নাম ..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="employee_grade_rank">Employee Grade Rank <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="number" id="employee_grade_rank" name="employee_grade_rank" class="form-control" placeholder="Employee Grade Rank..." required>
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