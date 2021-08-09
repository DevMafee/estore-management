<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2">password_reset <span class="text-danger">Please Change This Title !</span></span>
              		<a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#password_reset">
              			<i class="material-icons">control_point</i> <b>Create New</b>
              		</a>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['password_reset_status']; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_password_reset"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_password_reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('password_reset/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="password_reset_title">password_reset <span class="text-danger">Please Change This Title !</span></label>
            <input type="text" class="form-control" id="password_reset_title" name="password_reset_title" placeholder="..........." required>
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
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="password_reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('password_reset/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="password_reset_name">password_reset <span class="text-danger">Please Change This Title !</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="password_reset_name" name="password_reset_name" class="form-control" placeholder="password_reset..." required>
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