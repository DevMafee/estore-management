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
        <title><?php echo base_url('title'); ?> | Login</title>
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
                            <h2>SIGN IN</h2>
                        </div>
                        <!--  Multi Language    -->
                        <div class="multi-language-sec">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary button-green active">
                                  <input type="radio" name="lang" id="option1" autocomplete="off"> English </label>
                                <label class="btn btn-outline-secondary button-green">
                                  <input type="radio" name="lang" id="option2" autocomplete="off" checked> বাংলা </label>
                              </div>
                        </div>
                        
                        <div id="signin">
                            <h2>SIGN IN</h2>
                            <form class="card-body" id="sign_in" action="<?php echo base_url('site_link'); ?>login/run" method="post">
                            <?php $_SESSION['csrf_token_login']=md5(rand()); ?>
                                <input type="hidden" name="csrf_token_login" value="<?php echo $_SESSION['csrf_token_login']; ?>">      
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><img src="<?php echo base_url('site_link'); ?>assets/login_page/images/01.png" /></span>
                                    </div>
                                    <input type="text" name="username" class="form-control simec-pos-input-box" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                  </div>

                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><img src="<?php echo base_url('site_link'); ?>assets/login_page/images/02.png" /></span>
                                    </div>
                                    <input type="password" class="form-control simec-pos-input-box" name="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                                  </div>

                                <div class="simec-pos-input-group">
                                    <button type="submit" class="simec-pos-submit-bitton">Sign In</button>
                                </div>
                                <div class="simec-pos-input-group text-right" style="text-align:right;">
                                    <a href="<?php echo url('password_reset'); ?>" class="simec-pos-submit-bitton text-white">Forgot Password?</a>
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