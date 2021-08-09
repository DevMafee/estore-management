<?php
include('config/db_info.php');
include('include/functions.php');
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo base_url('title'); ?> | <?php $sub_title = $_SESSION['title']; echo $_SESSION["$sub_title"]; ?></title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('site_link'); ?>assets/fonts/Nikosh.ttf" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!-- <link href="<?php //echo base_url('site_link'); ?>assets/backend/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" /> -->
    
    <!-- Data Tables -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Select2 Css -->
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery/jquery.min.js"></script>
    <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="<?php //echo base_url('site_link'); ?>assets/js/jquery/dist/jquery.min.js"></script> -->
    <script>
        function change_language(lang){
            $.ajax({
                url : <?php echo '"'.url('languages/load_language/').'"'; ?>,
                method : "POST",
                data : {lang},
                success : function(data){
                    location.reload(true);
                }
            })
        }
        
        function sidebar_select(){
            var path = window.location;
            if ( path == '' || path == 'Home/dashboard' || path == 'Home') {
                path = './';
            }
            var target = $('ul li a[href="'+path+'"]');
            target.addClass('toggled active');
            target.parent().addClass('active');
            target.parent().parent().siblings().addClass('toggled');
            target.parent().parent().css("display", "block");
            target.parent().parent().parent().addClass('active');
            target.parent().parent().parent().parent().siblings().addClass('toggled');
        }
    </script>
    <!-- Select Plugin Js -->
    <!-- <script src="<?php //echo base_url('site_link'); ?>assets/backend/plugins/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2({
                minimumInputLength: 3
            });
        });
    </script> -->
    <style>
    @font-face {
        font-family: Nikosh;
        src: url(<?php echo base_url('site_link'); ?>assets/fonts/Nikosh.ttf);
    }
    div {
        font-family:  Nikosh !important;
    }
    span {
        font-family:  Nikosh !important;
    }
    p {
        font-family:  Nikosh !important;
    }
    ul {
        font-family:  Nikosh !important;
    }
    li {
        font-family:  Nikosh !important;
    }
    a {
        font-family:  Nikosh !important;
    }
    </style>

</head>

<body class="theme-red" onload="sidebar_select()" style="font-family: Nikosh !important;">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?"Please wait ...":"অনুগ্রহ করে অপেক্ষা করুন ..."; ?></p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <!-- <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div> -->
    <!-- #END# Search Bar -->