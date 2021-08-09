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
        <title><?php echo base_url('title'); ?> | Success</title>
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
                    <h1 class="en">Ministry of Civil Aviation and Tourism</h1>
                    <h1 class="bn">বেসামরিক বিমান ও পর্যটন মন্ত্রণালয়
                </div>
                
                <div class="authentication-layout-right">
    <?php
        echo isset($_SESSION['login_failed'])?'<div id="hideMe" class="alert alert-warning alert-dismissible" role="alert"><strong>Warning!</strong>'.$_SESSION['login_failed'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':'';
        unset($_SESSION['login_failed']);
    ?>
                    <div class="authentication-layout-tab-area">
                        <div id="signin">
                            <h2 class="text-success">Successful!</h2>
                            <h4 class="text-white">Please Check your Email or SMS to get the New Password.</h4>
                            
                            <div class="simec-pos-input-group text-right" style="text-align:right;">
                                <a href="<?php echo url('login'); ?>" class="simec-pos-submit-bitton text-white">Login</a>
                            </div>
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