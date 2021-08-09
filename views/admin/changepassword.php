<section class="content">
  <div class="container-fluid">
    <!-- Widgets -->
    <div class="row clearfix">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
          <div class="header">
            <h2>Change Password</h2>
          </div>
          <div class="body">
            <div class="row">
            <?php foreach ($data as $value) { ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action="<?php echo url('dashboard/changepassword_action'); ?>" method="POST">
                  <div class="form-group">
                    <label for="old_password">Old Password <small class="form-text text-danger">Your Old Password.</small></label>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo md5($value['user_id']); ?>">
                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password ... .. .">
                  </div>
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password ... .. .">
                  </div>
                  <div class="form-group">
                    <label for="retype_new_password">Retype New Password</label>
                    <input type="password" class="form-control" id="retype_new_password" name="retype_new_password" placeholder="Retype New Password ... .. .">
                  </div>
                  <div class="form-actions">
                    <button class="btn btn-primary mx-2" type="submit">Submit form</button>
                    <button class="btn btn-warning mx-2" type="reset">Reset</button>
                  </div>
                </form>
              </div>
            <?php $_SESSION['csrf_profile'] = ''; } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
          <div class="header">
            <h2>Change User ID</h2>
          </div>
          <div class="body">
            <div class="row">
            <?php foreach ($data as $value) { ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action="<?php echo url('dashboard/change_username_action'); ?>" method="POST">
                  <div class="form-group">
                    <label for="old_username">Old ID <small class="form-text text-danger">Your Old ID.</small></label>
                    <input type="hidden" class="form-control" id="user_id_md5" name="user_id_md5" value="<?php echo md5($value['user_id']); ?>">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']; ?>">
                    <input type="text" class="form-control" name="old_username" id="old_username" value="<?php echo $value['username']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="new_username">New Username</label>
                    <input type="text" class="form-control" id="new_username" name="new_username" placeholder="New Username ... .. .">
                  </div>
                  <div class="form-group">
                    <label for="retype_new_username">This is Employee ID? <span class="text-danger">*</span></label>
                    <select class="form-control" name="employee_id" id="employee_id" required>
                      <option value="">- Select -</option>
                      <option value="YES">Yes</option>
                      <option value="NO">No</option>
                    </select>
                  </div>
                  <div class="form-actions">
                    <button class="btn btn-primary mx-2" type="submit">Submit form</button>
                    <button class="btn btn-warning mx-2" type="reset">Reset</button>
                  </div>
                </form>
              </div>
            <?php $_SESSION['csrf_profile'] = ''; } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>