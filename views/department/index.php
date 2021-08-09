<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['DEPARTMENT']; ?></span>
                  <a href="#" class="btn btn-success waves-effect mr-2 mb-2" style="float: right; margin-top: -10px;" data-toggle="modal" data-target="#department">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['DEPARTMENT']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['department_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $lang = isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?$head['department_en']:$head['department_bn'];
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $lang; ?></td>
                        <td><?php echo $status; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_department_<?php echo $head['department_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_department_<?php echo $head['department_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_department_<?php echo $head['department_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('department/update/'.$head['department_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" id="department_id_<?php echo $head['department_id']; ?>" name="department_id_<?php echo $head['department_id']; ?>" class="form-control" value="<?php echo $head['department_id']; ?>" required>
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="department_en_<?php echo $head['department_id']; ?>">Department Name (English)<span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="department_en_<?php echo $head['department_id']; ?>" name="department_en_<?php echo $head['department_id']; ?>" class="form-control" value="<?php echo $head['department_en']; ?>" required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="department_bn_<?php echo $head['department_id']; ?>">ডিপার্টমেন্ট এর নাম (Bangla)<span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="department_bn_<?php echo $head['department_id']; ?>" name="department_bn_<?php echo $head['department_id']; ?>" class="form-control" value="<?php echo $head['department_bn']; ?>" required>
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
<div class="modal fade" id="Status_department_<?php echo $head['department_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('department/update_status/'.$head['department_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" name="department_status_<?php echo $head['department_id']; ?>" value="<?php echo $head['department_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['department_status']==1) {
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
<div class="modal fade" id="department" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['CREATE_DEPARTMENT']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('department/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="department_en">Department Name (English)<span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="department_en" name="department_en" class="form-control" placeholder="department..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="department_bn">ডিপার্টমেন্ট এর নাম (Bangla)<span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="department_bn" name="department_bn" class="form-control" placeholder="ডিপার্টমেন্ট এর নাম..." required>
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