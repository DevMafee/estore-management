<?php
  foreach ($data as $dt) {
    $name = $dt['company_settings_name'];
    $logo = $dt['company_settings_logo'];
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo base_url('title'); ?> | Login</title>
    <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/css/style.css" rel="stylesheet">
</head>

<body class="login-page" style="background-image: url(<?php echo base_url('site_link'); ?>/assets/images/pat.jpg);background-size: cover; height:100%;">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);" class="h1"><?php echo $name; ?></a>
        </div>
        <div class="card">
            <div class="body">
<?php
    echo isset($_SESSION['login_failed'])?'<div id="hideMe" class="alert alert-warning alert-dismissible" role="alert"><strong>Warning!</strong>'.$_SESSION['login_failed'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':'';
    unset($_SESSION['login_failed']);
?>
                <form id="sign_in" action="<?php echo base_url('site_link'); ?>login/run" method="post">
                <?php $_SESSION['csrf_token_login']=md5(rand()); ?>
                    <input type="hidden" name="csrf_token_login" value="<?php echo $_SESSION['csrf_token_login']; ?>">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-inline">
                                <input name="lang" value="en" type="radio" id="radio_8" class="radio-col-green">
                                <label for="radio_8">English</label>
                                <input name="lang" value="bn" type="radio" id="radio_7" class="radio-col-green" checked="">
                                <label for="radio_7">বাংলা</label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <!-- <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            $('#hideMe').fadeOut('slow');
        }, 5000);
    </script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/js/admin.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/js/pages/examples/sign-in.js"></script>
</body>

</html>