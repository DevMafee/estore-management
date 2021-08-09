<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <a href="<?php echo url('dashboard'); ?>">
                        <i class="material-icons">home</i>
                        <span><?php echo $_SESSION['DASHBOARD'];?></span>
                    </a>
                </li>
            <?php if ($_SESSION['user_type']=='1') { ?>
                <li class="">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block ">
                        <i class="material-icons">all_out</i>
                        <span><?php echo $_SESSION['MODULE_SETTING'];?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="">
                            <a href="<?php echo url('modules/create'); ?>" class="waves-effect waves-block"><?php echo $_SESSION['NEW_MODULE'];?></a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('modules/all'); ?>" class="waves-effect waves-block "><?php echo $_SESSION['ALL_MODULE'];?></a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('languages/all'); ?>" class="waves-effect waves-block "><?php echo $_SESSION['LANG_SET'];?></a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('users/smscount'); ?>" class="waves-effect waves-block ">SMS Info</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">list</i>
                        <span><?php echo $_SESSION['MENU_SETTING'];?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="">
                            <a href="<?php echo url('main_menu/all'); ?>" class="waves-effect waves-block"><?php echo $_SESSION['MAIN_MENU'];?></a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('sub_menu/all'); ?>" class="waves-effect waves-block"><?php echo $_SESSION['SUB_MENU'];?></a>
                        </li>
                        <!-- <li class="">
                            <a href="<?php //echo url('top_menu/all'); ?>" class="waves-effect waves-block">Top Menu</a>
                        </li> -->
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">https</i>
                        <span><?php echo $_SESSION['USER_SETTING_ADMIN'];?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="">
                            <a href="<?php echo url('users/create_usertype'); ?>" class="waves-effect waves-block">
                                <?php echo $_SESSION['CREATE_USER_TYPE'];?>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('users/create'); ?>" class="waves-effect waves-block">
                                <?php echo $_SESSION['CREATE_USER'];?>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('users/all'); ?>" class="waves-effect waves-block">
                                <?php echo $_SESSION['VIEW_ALL_USER'];?>
                            </a>
                        </li>
                        <!-- <li class="">
                            <a href="<?php //echo url('users/accesscreate'); ?>"class=" waves-effect waves-block">
                                <?php //echo $_SESSION['USER_ACCESS_SETTING'];?>
                            </a>
                        </li> -->
                    </ul>
                </li>
            <?php } ?>
<?php
    
    $userFromSession = $_SESSION['user_type'];
    $con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
    $sql = "SELECT * FROM main_menu WHERE main_menu_status=1 ORDER BY main_menu_rank ASC";
    $run_sql = mysqli_query($con, $sql);
    while ($main = mysqli_fetch_assoc($run_sql)) {
        $main_menu_name = $main['main_menu_name'];
        $main_menu_icon = $main['main_menu_icon'];
        $main_menu_link = $main['main_menu_link'];
        $main_menu_id = $main['main_menu_id'];
        $main_menu_has_access = $main['main_menu_has_access'];
        $access = explode(',', $main_menu_has_access);
        if (in_array($userFromSession, $access)) {
            $sub_sql = "SELECT * FROM sub_menu WHERE sub_menu_main=$main_menu_id AND sub_menu_status=1 ORDER BY sub_menu_rank ASC";
            $run_sub_sql = mysqli_query($con, $sub_sql);
            $dropdown = mysqli_num_rows($run_sub_sql);
            if ($dropdown > 0) {
?>
    <li class="">
<?php
            }else{
?>
    <li class="">
<?php
            }
?>
        <a href="<?php echo ($main_menu_link=='#' || $main_menu_link=='')?'#':url($main_menu_link); ?>" class="<?php echo $dropdown>0?'menu-toggle':''; ?> waves-effect waves-block ">
            <i class="material-icons"><?php echo $main_menu_icon; ?></i>
            <span><?php echo isset($_SESSION["$main_menu_name"])?$_SESSION["$main_menu_name"]:$main_menu_name; ?></span>
        </a>
        <ul class="ml-menu">
<?php
            while ($sub = mysqli_fetch_assoc($run_sub_sql)) {
                $sub_menu_name = $sub['sub_menu_name'];
                $sub_menu_link = $sub['sub_menu_link'];
                $sub_menu_icon = $sub['sub_menu_icon'];
?>
            <li class="">
                <a href="<?php echo url($sub_menu_link); ?>" class="waves-effect waves-block ">
                    <i class="material-icons"><?php echo $sub_menu_icon; ?></i>
                    <span><?php echo isset($_SESSION["$sub_menu_name"])?$_SESSION["$sub_menu_name"]:$sub_menu_name; ?></span>
                </a>
            </li>
<?php
            }
?>
        </ul>
    </li>
<?php
        }
    }
?>
                <li>
                    <a href="<?php echo url('assets/').'Employee_Manual.pdf'; ?>">
                        <i class="material-icons">import_contacts</i>
                        <span><?php echo $_SESSION['LANGUAGE_SETTED']=='bn'?'ব্যবহার বিধি':'User Manual';?></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="legal" style="background-color: #055a1c !important; color: white; padding: 5px !important; text-align: center; margin-bottom: 10px;">
            <div class="copyright">
                <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                    <button type="button" onclick="return change_language('bn');"<?php echo isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='bn'?' class="btn bg-green waves-effect" style="padding:5px 15px !important;"':' class="btn bg-pink waves-effect" style="padding:5px 15px !important;"'; ?>>বাংলা</button>
                    <button type="button" onclick="return change_language('en');"<?php echo isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?' class="btn bg-green waves-effect" style="padding:5px 15px !important;"':' class="btn bg-pink waves-effect" style="padding:5px 15px !important;"'; ?>>English</button>
                </div>
            </div>
        </div>
    </aside>
    <aside id="rightsidebar" class="right-sidebar" style="height: calc(100vh - 50px) !important; top: 50px !important;">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <b style="font-size: 20px;"><?php //echo $_SESSION['user_id']!=''?$_SESSION['fullname']:''; ?></b>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</section>