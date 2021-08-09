<nav class="navbar" style="height: 70px !important;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars" style="display: none;"></a>
            <a class="navbar-brand" href="<?php echo url('dashboard'); ?>" style="padding: 5px !important;">
            <?php
                $logo = in_out_object("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "company_settings_logo,company_settings_name", "company_settings");
                    if($logo != null):
            ?>
                <img src="<?php echo url('assets/company_settings_logo/').$logo->company_settings_logo; ?>"  class="brand-image elevation-3" style="width:356px !important;margin-top: -5px !important; height:45px;">
            <?php else: ?>
                <img src="<?php echo url('assets/company_settings_logo/').'logo.png'; ?>" style="width:225px; height:50px;">
            <?php endif; ?>
            </a>
        </div>
<?php
    $emp_name = isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['employee_name_en']:($_SESSION['employee_name_bn']??$_SESSION['employee_name_en']);
    $section = isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['section_en']:($_SESSION['section_bn']??$_SESSION['section_en']);
    $designation = isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['designation_en']:($_SESSION['designation_bn']??$_SESSION['designation_en']);
?>
        <div class="navbar-collapse collapse" id="navbar-collapse" style="background-color: #055a1c !important; max-height: 70px;">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true" style="display: inline-block;">
                        <span style="float: left; width: 70px;">
                        <?php if(isset($_SESSION['user_photo']) && $_SESSION['user_photo'] != ''): ?>
                            <img src="<?php echo url('assets/user_photo/').$_SESSION['user_photo']; ?>" alt="<?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>" class="img-circle" style="width:55px;height: 55px;">
                        <?php endif; ?>
                        </span>
                        <span style="float: left;min-width: 180px;position: relative;top: -5px;">
                            <span style="font-size: 14px; display:block;">
                                <?php echo isset($_SESSION['user_id'])&&$_SESSION['user_id']!=''?$emp_name:''; ?>
                            </span>
                            <span style="font-size: 10px; display:block;">
                                <?php echo $designation.' ('.$section.')'; ?>
                            </span>
                            <span style="font-size: 12px; display:block;font-family: Nikosh;"><?php echo $_SESSION['COMPANY_NAME']??''; ?></span>
                            <span style="position: absolute;top: 5px; right: 0;">
                                <i class="material-icons" style="position: relative; left: -5px; top: 5px;">arrow_drop_down</i>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu" style="max-height: 220px; padding: 5px; position: absolute; right: -15px; text-align: center;">
                        <li class="header">
                            <?php if(isset($_SESSION['user_photo']) && $_SESSION['user_photo'] != ''): ?>
                                <img src="<?php echo url('assets/user_photo/').$_SESSION['user_photo']; ?>" alt="<?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>" class="img-circle" style="width:80px;height: 80px;">
                            <?php endif; ?>
                            <br>
                            <b style="font-size: 14px;"><?php echo isset($_SESSION['user_id'])&&$_SESSION['user_id']!=''?$emp_name:''; ?></b>
                            <br>
                            <?php echo isset($_SESSION['user_id'])&&$_SESSION['user_id']!=''?'<i style="font-size: 10px;">'.$designation.' ('.$section.')'.'</i>':''; ?>
                            <br>
                            <span style="font-size: 12px; display:block;"><?php echo $_SESSION['COMPANY_NAME']??''; ?></span>
                        </li>
                        <li class="body">
                            <ul class="menu" style="max-height: 100px !important;">
                                <li>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group" style="height: 60px;">
                                        <a href="<?php echo url('dashboard/profile/').md5(rand()).md5($_SESSION['user_id']??''); ?>" title="View Profile" class="btn waves-effect" style="border-right:1px solid #CCC;" role="button">
                                            <img src="<?php echo url('assets/images/profile.png'); ?>" style="width: 50%">
                                            <span style="display:block;">Profile</span>
                                        </a>
                                        <a href="<?php echo url('dashboard/changepassword/').md5(rand()).md5($_SESSION['user_id']??''); ?>" title="Password Change" class="btn waves-effect" style="border-right:1px solid #CCC;" role="button">
                                            <img src="<?php echo url('assets/images/cng_pwd.png'); ?>" style="width: 50%">
                                            <span style="display:block;">Password</span>
                                        </a>
                                        <a href="<?php echo url('logout'); ?>" class="btn waves-effect" role="button" title="Logout">
                                            <img src="<?php echo url('assets/images/log_out.png'); ?>" style="width: 50%">
                                            <span style="display:block;">Logout</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--Top Bar -->
