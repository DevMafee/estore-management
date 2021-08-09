<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
        	<div class="header">
            <span class="h4 mt-2"><?php echo $_SESSION['EMAIL_CONFIG']; ?></span>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Host Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Title</th>
                    <th scope="col">Sent From</th>
                    <th scope="col">Reply To</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i=0;
                  foreach($data as $company){
                    if ($company['company_settings_status']==1 && $company['hostname'] != null) {
                ?>
                  <tr>
                  	<td><?php echo ++$i; ?></td>
                  	<td><?php echo $company['hostname']; ?></td>
                    <td><?php echo $company['username']; ?></td>
                    <td><?php echo $company['password']; ?></td>
                    <td><?php echo $company['senttitle']; ?></td>
                    <td><?php echo $company['sentfrom']; ?></td>
                    <td><?php echo $company['replyto']; ?></td>
                  	<td><button class="btn bg-orange" data-toggle="modal" title="Edit" data-target="#Edit_company_settings<?php echo $company['company_settings_id']; ?>"><i class="material-icons">edit</i></button></td>
                  </tr>
<!-- Update Modal -->
<div class="modal fade" id="Edit_company_settings<?php echo $company['company_settings_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Update Email Configuration </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('company_settings/updateemailconfiguration'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="hostname">Host Name <span class="text-danger">*</span></label>
                  <input type="hidden" class="form-control" id="company_settings_id" name="company_settings_id" value="<?php echo $company['company_settings_id']; ?>" required>
                  <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo $company['hostname']; ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="username">User Email (Server Setting)</label>
                  <input type="email" class="form-control" id="username" name="username" value="<?php echo $company['username']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="password">Password (Server Setting)<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $company['password']; ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="sentfrom">Sent From Email (Server Setting)</label>
                  <input type="email" class="form-control" id="sentfrom" name="sentfrom" value="<?php echo $company['sentfrom']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="senttitle">Email Title (Server Setting)<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="senttitle" name="senttitle" value="<?php echo $company['senttitle']; ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label for="replyto">Reply To Email (Server Setting)</label>
                  <input type="email" class="form-control" id="replyto" name="replyto" value="<?php echo $company['replyto']; ?>">
                </div>
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
                <?php }} ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>