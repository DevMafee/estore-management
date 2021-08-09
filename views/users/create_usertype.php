<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <span class="h4">User Type</span>
            <a href="#" class="btn bg-green mt-2 mr-2 text-success" style="float: right;" data-toggle="modal" data-target="#user_type">
              Create New
            </a>
          </div>
            <div class="body">
              <table class="table datatable table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">User Type Name</th>
                  <th scope="col">Access</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i=0;
                foreach($data as $head){
                  if ($head['user_type_access'] != null) {
                    $ctrls = explode(',', $head['user_type_access']);
                  }else{
                    $ctrls = ['<span class="text-danger bg-white">User has no Access!</span>'];
                  }
                  
              ?>
                <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $head['user_type_name']; ?></td>
                  <td><?php $j = 0; foreach($ctrls as $ctrl){ $j++; echo '<i class="badge bg-teal">'.$ctrl.'</i>&nbsp;'; echo $j%3==0?'<br>':''; } ?></td>
                  <td>
                    <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_user_type_<?php echo $head['user_type_id'] ;?>"><i class="material-icons  bg-orange text-warning">edit</i></a>
                    <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_user_type_<?php echo $head['user_type_id'] ;?>"><i class="material-icons  bg-red text-red">delete</i></a>
                  </td>
                </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_user_type_<?php echo $head['user_type_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit User Type </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_name">User Type <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="user_type_id" name="user_type_id" value="<?php echo $head['user_type_id'] ;?>">
            <input type="text" class="form-control" id="user_type_name" name="user_type_name" value="<?php echo $head['user_type_name'] ;?>">
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
<!-- Delete Modal -->
<div class="modal fade" id="Delete_user_type_<?php echo $head['user_type_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete User Type </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <input type="hidden" class="form-control" id="user_type_id" name="user_type_id" value="<?php echo $head['user_type_id'] ;?>">        
          </div>
          <h3 class="text-danger">Are you sure to delete <?php echo $head['user_type_name'] ;?> ?</h3>
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

<div class="modal fade" id="user_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_name">User Type <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="user_type_name" name="user_type_name" placeholder="Enter User Type" required>
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