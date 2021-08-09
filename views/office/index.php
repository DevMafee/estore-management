<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['OFFICE']; ?></span>
              		<a href="#" class="btn btn-success waves-effect mr-2 mb-2" style="float: right; margin-top: -10px;" data-toggle="modal" data-target="#office">
              			<i class="material-icons">control_point</i> <b>Create New</b>
              		</a>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['DEPARTMENT']; ?></th>
                        <th scope="col"><?php echo $_SESSION['OFFICE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['office_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $department = $_SESSION['LANGUAGE_SETTED']=='en'?$head['department_en']:$head['department_bn'];
                        $office = $_SESSION['LANGUAGE_SETTED']=='en'?$head['office_en']:$head['office_bn'];
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $department; ?></td>
                        <td><?php echo $office; ?></td>
                        <td><?php echo $status; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_office_<?php echo $head['office_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_office_<?php echo $head['office_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_office_<?php echo $head['office_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('office/update/'.$head['office_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['office_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['office_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['office_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="office_department_<?php echo $head['office_id']; ?>"><?php echo $_SESSION['DEPARTMENT']; ?> <span class="text-danger">*</span></label>
            <div class="form-line">
              <select class="form-control" id="office_department_<?php echo $head['office_id']; ?>" name="office_department_<?php echo $head['office_id']; ?>" required>
                <option value="">- Select -</option>
              <?php foreach($data2 as $department){ ?>
                <option value="<?php echo $department['department_id']; ?>" <?php echo $head['office_department']==$department['department_id']?'selected':''; ?>>
                  <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$department['department_en']:$department['department_bn']; ?>
                </option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="office_en_<?php echo $head['office_id']; ?>">Office Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="office_en_<?php echo $head['office_id']; ?>" name="office_en_<?php echo $head['office_id']; ?>" class="form-control" value="<?php echo $head['office_en']; ?>" required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="office_bn_<?php echo $head['office_id']; ?>">অফিস এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="office_bn_<?php echo $head['office_id']; ?>" name="office_bn_<?php echo $head['office_id']; ?>" class="form-control" value="<?php echo $head['office_bn']; ?>" required>
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
<div class="modal fade" id="Status_office_<?php echo $head['office_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('office/update_status/'.$head['office_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="office_status_<?php echo $head['office_id']; ?>" value="<?php echo $head['office_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['office_status']==1) {
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
<div class="modal fade" id="office" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['CREATE_OFFICE']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('office/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_office']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_office" value="<?php echo $_SESSION['csrf_token_office']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="office_department"><?php echo $_SESSION['DEPARTMENTS']; ?> <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="office_department" id="office_department">
                    <option value="">- Select -</option>
                  <?php foreach($data2 as $department): ?>
                    <option value="<?php echo $department['department_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$department['department_en']:$department['department_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="office_en">Office Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="office_en" name="office_en" class="form-control" placeholder="Office Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="office_bn">অফিস এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="office_bn" name="office_bn" class="form-control" placeholder="অফিস এর নাম ..." required>
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