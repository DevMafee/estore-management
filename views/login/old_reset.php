<?php
  foreach ($data as $dt) {
    $name = $dt['company_settings_name'];
    $logo = $dt['company_settings_logo'];
  }
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo base_url('title'); ?> | Password Reset</title>
        <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">

        <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/login_page/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/login_page/style.css">

    </head>

    <body>
        <div class="authentication-layout">
            <div class="authentication-layout-inner">
                <div class="authentication-layout-left">
                    <div class="authentication-layout-logo">
                        <img src="<?php echo base_url('site_link'); ?>assets/login_page/images/logo.png" style="width: 150px;">
                    </div>
                    <div class="authentication-layout-head">
                        <h3>Digital Store Management System</h3>
                        <h1>বস্ত্র ও পাট মন্ত্রণালয়</h1>
                        <h1 style="font-size: 33px !important;">Ministry of Textiles & Jute</h1>
                    </div>
                </div>
                
                <div class="authentication-layout-right">
    <?php
        echo isset($_SESSION['login_failed'])?'<div id="hideMe" class="alert alert-warning alert-dismissible" role="alert"><strong>Warning!</strong>'.$_SESSION['login_failed'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':'';
        unset($_SESSION['login_failed']);
    ?>
                    <div class="authentication-layout-tab-area">
                        <div class="mobile_heading">
                            <h2>Reset Password</h2>
                        </div>
                        
                        <div id="signin">
                            <h2>Reset Password</h2>
                            <form class="card-body" id="sign_in" action="<?php echo url('password_reset/send_mail'); ?>" method="post">
                            <?php $_SESSION['csrf_token_reset']=md5(rand()); ?>
                                <input type="hidden" name="csrf_token_reset" value="<?php echo $_SESSION['csrf_token_reset']; ?>">      
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><img src="<?php echo base_url('site_link'); ?>assets/login_page/images/01.png" /></span>
                                    </div>
                                    <input type="text" name="username" class="form-control simec-pos-input-box" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                  </div>

                                <div class="simec-pos-input-group">
                                    <button type="submit" class="simec-pos-submit-bitton">Reset Password</button>
                                </div>
                                <div class="simec-pos-input-group text-right" style="text-align:right;">
                                    <a href="<?php echo url('login'); ?>" class="simec-pos-submit-bitton text-white">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Jquery Core Js -->
        <script src="<?php echo base_url('site_link'); ?>assets/login_page/jquery.min.js"></script>
        <script>
            setTimeout(function() {
                $('#hideMe').fadeOut('slow');
            }, 5000);
        </script>
        <!-- Bootstrap Core Js -->
        <script src="<?php echo base_url('site_link'); ?>assets/login_page/bootstrap.min.js"></script>
    </body>
</html>