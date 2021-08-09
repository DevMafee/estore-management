<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <?php if(isset($_SESSION['modules_error'])){ echo $_SESSION['modules_error']?'<div id="hideMe" class="alert alert-warning alert-dismissible fade show" role="alert">'.$_SESSION['modules_error'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':''; $_SESSION['modules_error']='';} ?>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
            <h2><?php echo $_SESSION['MODULE']; ?></h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown"><i class="material-icons">more_vert</i></li>
            </ul>
          </div>
          <div class="body">
            <form action="<?php echo url('modules/save'); ?>" method="post">
              <?php $_SESSION['csrf_token_module']=md5(rand()); ?>
              <input type="hidden" name="csrf_token_module" value="<?php echo $_SESSION['csrf_token_module']; ?>">
              <div class="form-group form-float">
                <?php echo isset( $_SESSION['modules_name_session'] )?$_SESSION['modules_name_session']:''; $_SESSION['modules_name_session'] = "";?>
                <div class="form-line">
                  <input type="text" name="modules_name" id="modules_name" class="form-control">
                  <label class="form-label">Type a Module Name...</label>
                </div>
                <small class="form-text text-danger">
                  <?php echo isset( $_SESSION['modules_name'] )?$_SESSION['modules_name']:''; $_SESSION['modules_name'] = "";?>
                </small>
              </div>
              <div class="form-actions">
                <button class="btn btn-primary mx-2" type="submit">Submit form</button>
                <button class="btn btn-warning mx-2" type="reset">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>