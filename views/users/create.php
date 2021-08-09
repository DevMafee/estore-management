<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <span class="h4">Create New User</span>
            <a href="<?php echo url('users/all'); ?>" class="btn bg-teal mt-2 mr-2" style="float: right;">All Users List</a>
          </div>
          <div class="body">
            <form action="<?php echo url('users/save'); ?>" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token']=md5(rand()); ?>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              
              <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name...">
                    <small class="form-text text-danger"><?php echo isset( $_SESSION['full_name'] )?$_SESSION['full_name']:''; $_SESSION['full_name'] = "";?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name...">
                    <small class="form-text text-danger"><?php echo isset( $_SESSION['username'] )?$_SESSION['username']:''; $_SESSION['username'] = "";?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password ..">
                    <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select class="form-control" id="user_type" name="user_type">                   
                      <?php foreach ($data2 as $d2) {
                     echo '<option value="'.$d2['user_type_id'].'">'.$d2['user_type_name'].'</option>';
                     }  ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-actions">
                  <button class="btn btn-primary mx-2" type="submit">Submit</button>
                  <button class="btn btn-warning mx-2" type="reset">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>