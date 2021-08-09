<!--Top Bar -->
<nav class="navbar" style="height: 70px !important;">
    <div class="container-fluid">
        <div class="navbar-header" style="padding: 0 !important;padding-left: 20px !important;">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars" style="position: absolute; left: 10px; margin-top: -10px !important;"></a>
            <a class="navbar-brand" href="<?php echo url('dashboard'); ?>" style="padding: 5px !important;">
            <?php
              $logo = in_out_object("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "company_settings_logo,company_settings_name", "company_settings");
                    if($logo != null):
            ?>
                    <img src="<?php echo url('assets/company_settings_logo/').$logo->company_settings_logo; ?>"  class="brand-image elevation-3" style="width:210px !important;margin-top: -10px !important;">
            <?php else: ?>
                    <img src="<?php echo url('assets/company_settings_logo/').'logo.png'; ?>" style="width:225px; height:50px;">
            <?php endif; ?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse" style="background-color: #055a1c !important;">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-right">
                    <?php if(isset($_SESSION['user_photo']) && $_SESSION['user_photo'] != ''): ?>
                      <img src="<?php echo url('assets/user_photo/').$_SESSION['user_photo']; ?>" alt="<?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>" class="img-circle" style="width:35px;height: 35px;">
                    <?php endif; ?>
                </li>
                <li class="dropdown pull-right">
                    <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle" data-toggle="dropdown" role="button" style="margin-top: -1px;">
            <?php
                $emp_name = $_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['employee_name_en']:$_SESSION['employee_name_bn'];
                $section = $_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['section_en']:$_SESSION['section_bn'];
                $designation = $_SESSION['LANGUAGE_SETTED']=='en'?$_SESSION['designation_en']:$_SESSION['designation_bn'];
            ?>
                    <?php if(isset($_SESSION['user_photo']) && $_SESSION['user_photo'] != ''): ?>
                      <img src="<?php echo url('assets/user_photo/').$_SESSION['user_photo']; ?>" alt="<?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>" class="img-circle" style="width:35px;height: 35px;">
                    <?php endif; ?>
                        <div style="font-size: 12px; height: 70px;">
                            <?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>
                            <i style="font-size: 8px;"><?php echo $designation.' ('.$section.')'; ?></i>
                        </div>
                        <b><i class="material-icons" style="position: relative; left: -5px; top: 5px;">arrow_drop_down</i></b>
                    </a>
                    <ul class="dropdown-menu" style="max-height: 300px;">
                        <li class="header">
                            <?php if(isset($_SESSION['user_photo']) && $_SESSION['user_photo'] != ''): ?>
                              <img src="<?php echo url('assets/user_photo/').$_SESSION['user_photo']; ?>" alt="<?php echo $_SESSION['user_id']!=''?$emp_name:''; ?>" class="img-circle" style="width:80px;height: 80px;">
                            <?php endif; ?>
                            <br>
                            <b style="font-size: 16px;"><?php echo $_SESSION['user_id']!=''?$emp_name:''; ?></b>
                            <br>
                            <?php echo $_SESSION['user_id']!=''?'<i style="font-size: 10px;">'.$designation.' ('.$section.')'.'</i>':''; ?>
                        </li>
                        <li class="body">
                            <ul class="menu" style="max-height: 250px !important;">
                                <li>
                                    <a href="<?php echo url('dashboard/profile/').md5(rand()).md5($_SESSION['user_id']); ?>">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">assignment_ind</i>
                                        </div>
                                        <div class="menu-info" style="top: -5px !important;">
                                            <h5>View Profile</h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo url('dashboard/changepassword/').md5(rand()).md5($_SESSION['user_id']); ?>">
                                        <div class="icon-circle bg-orange">
                                            <i class="material-icons">mode_edit</i>
                                        </div>
                                        <div class="menu-info" style="top: -5px !important;">
                                            <h5>Change Password</h5>
                                        </div>
                                    </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo url('logout'); ?>">
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">assignment_return</i>
                                        </div>
                                        <div class="menu-info" style="top: -5px !important;">
                                            <h5>Logout</h5>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Right Sidebar Setting -->
                <!-- <li class="pull-right">
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true" style="margin-top: 5px;">
                        <i class="material-icons">more_vert</i>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<!-- <li style="margin-top: -5px !important;">
    <a href="" onclick=" return change_language('en');">
        <img src="<?php //echo url('assets/images/eng.png'); ?>"<?php //echo isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?' style="width:30px !important;margin-top: -5px !important;"':' style="width:15px !important;"'; ?>>
    </a>
</li>
<li style="margin-top: -5px !important;">
    <a href="" onclick=" return change_language('bn');">
        <img src="<?php //echo url('assets/images/bng.png'); ?>"<?php //echo isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='bn'?' style="width:30px !important;margin-top: -5px !important;"':' style="width:20px !important;"'; ?>>
    </a>
</li> -->