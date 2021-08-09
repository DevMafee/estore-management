<section class="content">
  <div class="container-fluid">
    <?php $_SESSION['csrf_token_ac_disable']=md5(rand()); ?>
    <!-- Widgets -->
    <div class="row clearfix">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
            <h2>Public Profile of <?php echo $data[0]['full_name']; ?></h2>
          </div>
          <div class="body">
            <div class="row">
          <?php foreach ($data as $value) { ?>
              <div class="mb-3 col-5 col-lg-5 col-xl-5" style="border-right: 1px solid #CCC;">
                <div class="user-avatar user-avatar-xl fileinput-button mb-3">
                  <center>
                    <img src="<?php echo base_url('site_link'); ?>assets/user_photo/<?php echo $value['user_photo']; ?>" style="width: 200px;">
                  </center>
                </div>
                <div style="margin: 10px; padding: 10px;">
                  <form action="<?php echo url('dashboard/changePhoto');?>" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <label for="user_photo" class="col-md-3">Profile Photo</label>
                      <div class="col-md-9 mb-3">
                        <div class="custom-file">
                          <input type="hidden" id="user_photo_pre" name="user_photo_pre" value="<?php echo $value['user_photo']; ?>">
                          <input type="hidden" id="user_id" name="user_id" value="<?php echo $value['user_id']; ?>">
                          <input type="file" class="custom-file-input" id="user_photo" name="user_photo" required>
                        </div><small class="text-muted">Upload a new Profile image, JPG 250x300</small>
                        <button type="submit" class="btn btn-info">Change</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-6 col-lg-6 col-xl-6" style="float: right; margin-left: 10px;">
                <h3> Change Your Signature </h3>
                <hr>
              <?php if($value['user_signature'] != ''){ ?>
                <div class="user-avatar user-avatar-xl fileinput-button mb-3">
                  <center>
                    <img src="<?php echo base_url('site_link'); ?>assets/user_photo/<?php echo $value['user_signature']; ?>" style="width: 250px;height: 100px;">
                  </center>
                </div>
                <br>
              <?php } ?>
                <form action="<?php echo url('dashboard/changeSignature');?>" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <label for="user_signature" class="col-md-3">Change Signature</label>
                    <div class="col-md-9 mb-3">
                      <div class="custom-file">
                        <input type="hidden" id="user_signature_pre" name="user_signature_pre" value="<?php echo $value['user_signature']; ?>">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $value['user_id']; ?>">
                        <input type="file" class="custom-file-input" id="user_signature" name="user_signature" required>
                      </div><small class="text-muted">Upload a Signature image, JPG 250x100</small>
                      <br>
                      <button type="submit" class="btn btn-success">Upload Now</button>
                    </div>
                  </div>
                </form>
               <!--  <form id="makeDisableMyAccount" onsubmit="return false" method="post" class="bg-warning" style="padding: 10px;">
                  <div class="form-row">
                    <div class="col-md-9 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="hidden" name="csrf_token_ac_disable" value="<?php echo $_SESSION['csrf_token_ac_disable']; ?>">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $value['user_id_md5']; ?>">
                        <label class="custom-control-label" for="user_id">Yes, Disable My Account.</label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-danger ml-auto">Disable Profile</button>
                  </div>
                </form> -->
              </div>
          <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>