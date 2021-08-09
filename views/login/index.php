<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Ministry of Primary and Mass Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/assets/images/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url('site_link'); ?>assets/assets/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('site_link'); ?>assets/assets/owl/assets/owl.carousel.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('site_link'); ?>assets/assets/owl/assets/owl.theme.default.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('site_link'); ?>assets/assets/css/main.css">
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery/jquery.min.js"></script>
</head>
 
<body class="login-page">
    <!-- Header -->
     <main class="main-body">
         <div class="login-body">
             <div class="login-inner-container">
                 <div class="left-box">
                     <div class="login-title-info">
                        <h4 class="en">eStore Management System</h4>
                        <h4 class="bn">ই - স্টোর ব্যবস্থাপনা</h4>
                        <img src="<?php echo base_url('site_link'); ?>assets/assets/logo/bangladesh-govt-logo.png">

                        <h1 class="en">Ministry of Primary and Mass Education</h1>
                        <h1 class="bn">প্রাথমিক ও গণশিক্ষা মন্ত্রণালয়</h1>
                     </div> 
                 </div>
                 <div class="right-box">
                    <?php
                    echo isset($_SESSION['login_failed']) ? '<div id="hideMe" class="alert alert-warning alert-dismissible" role="alert"><strong>Warning!</strong>' . $_SESSION['login_failed'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : '';
                    unset($_SESSION['login_failed']);
                    ?>
                    <form id="sign_in" action="<?php echo base_url('site_link'); ?>login/run" method="post">
                        <?php $_SESSION['csrf_token_login'] = md5(rand()); ?>
                        <input type="hidden" name="csrf_token_login" value="<?php echo $_SESSION['csrf_token_login']; ?>">
                        <div class="form-title">
                            <h1 class="en">Sign In</h1>
                            <h1 class="bn">সাইন ইন করুন</h1>
                        </div>
                        <div class="input-box">
                            <img src="<?php echo base_url('site_link'); ?>assets/assets/icon/username-icon.png">
                            <input class="input-item userid" type="text" name="username" placeholder="User ID">
                        </div>
                        <div class="input-box">
                            <img src="<?php echo base_url('site_link'); ?>assets/assets/icon/password-icon.png">
                            <input class="input-item userpass" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="submit-box">
                            <button class="submit-btn en">Sign In</button>
                            <button class="submit-btn bn">সাইন ইন করুন</button>
                            <a class="forgot-pass en" href="<?php echo url('password_reset'); ?>" >Forgot Password?</a>
                            <a class="forgot-pass bn" href="<?php echo url('password_reset'); ?>" >পাসওয়ার্ড ভুলে গেছেন?</a>
                        </div>
                    </form>
                    <div class="language-btn-sec">
                         <button class="language-btn" id="en" onclick="changeLanguage('en')">English</button>
                         <button class="language-btn selected" id="bn" onclick="changeLanguage('bn')">Bangla</button>
                    </div>
                </div>
            </div>
            <div class="copyright-sec">
                <p>
                    Copyright © Ministry of Primary and Mass Education. Developed By <a href="http://www.simecsystem.com/" target="_blank"><b>SIMEC System Ltd.</b></a>
                </p>
            </div>
        </div>
    </main>
      
    
    <script src="<?php echo base_url('site_link'); ?>assets/assets/js/vendor/modernizr-3.8.0.min.js"></script>
    <script>
        changeLanguage('en');
        function changeLanguage(lang){
            if (lang == 'en') {
                $('.language-btn').removeClass('selected');
                $('#en').addClass('selected');
                $('.bn').css('display','none');
                $('.en').css('display','block');
                $('.userid').attr("placeholder", "User ID");
                $('.userpass').attr("placeholder", "Password");
            }else{
                $('.language-btn').removeClass('selected');
                $('#bn').addClass('selected');
                $('.en').css('display','none');
                $('.bn').css('display','block');
                $('.userid').attr("placeholder", "ইউজার আইডি");
                $('.userpass').attr("placeholder", "পাসওয়ার্ড");
            }
        }
        setTimeout(function() {
            $('#hideMe').fadeOut('slow');
        }, 5000);
    </script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script> -->
    <!-- <script src="assets/owl/owl.carousel.js"></script>  -->
    <!-- <script src="assets/js/main.js"></script> -->
     
</body>

</html>