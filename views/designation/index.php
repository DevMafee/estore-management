<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['DESIGNATION']; ?></span>
              		<a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#designation">
              			<i class="material-icons">control_point</i> <b>Create New</b>
              		</a>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['DESIGNATION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['designation_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $designation = $_SESSION['LANGUAGE_SETTED']=='en'?$head['designation_en']:$head['designation_bn'];
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $designation; ?></td>
                        <td><?php echo $status; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_designation_<?php echo $head['designation_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_designation_<?php echo $head['designation_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_designation_<?php echo $head['designation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('designation/update/'.$head['designation_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['designation_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['designation_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['designation_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="designation_en_<?php echo $head['designation_id']; ?>">Designation Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="designation_en_<?php echo $head['designation_id']; ?>" name="designation_en_<?php echo $head['designation_id']; ?>" value="<?php echo $head['designation_en']; ?>" required>
          </div>
          <div class="form-group">
            <label for="designation_bn_<?php echo $head['designation_id']; ?>">পদবী এর নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="designation_bn_<?php echo $head['designation_id']; ?>" name="designation_bn_<?php echo $head['designation_id']; ?>" value="<?php echo $head['designation_bn']; ?>" required>
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
<div class="modal fade" id="Status_designation_<?php echo $head['designation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('designation/update_status/'.$head['designation_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="designation_status_<?php echo $head['designation_id']; ?>" value="<?php echo $head['designation_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['designation_status']==1) {
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
<div class="modal fade" id="designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('designation/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_designation']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_designation" value="<?php echo $_SESSION['csrf_token_designation']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="designation_en">Designation Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="designation_en" name="designation_en" class="form-control" placeholder="Designation Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="designation_bn">পদবী এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="designation_bn" name="designation_bn" class="form-control" placeholder="পদবী এর নাম ..." required>
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