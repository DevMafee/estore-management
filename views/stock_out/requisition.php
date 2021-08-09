<link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
<title><?php echo $_SESSION['COMPANY_NAME']??''; ?></title>
<link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<div class="row" style="width: 100%;margin: 15px auto;">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <input type="button" class="btn btn-warning" style="padding:5px; float:right;margin-right: 85px;" onclick="printDiv('printArea')" value="Print Now" />
        <a href="<?php echo $_SESSION['user_type']==4?url('stock_out/create'):url('requisitions/all'); ?>" class="btn btn-success" style="padding:5px; float:right;margin-right: 5px;">Back</a>
    </div>
</div>
<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
    padding: 1px 5px 1px 5px;
}
</style>
<?php

$search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
$replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
$s = $data[0]['requisitions_section'];
$sec = in_out_object("section_id=$s", "section_en,section_bn", "section");
?>
<div style="margin: 50px auto; width:90%;" id="printArea">
    <div style="width: 100%;">
        <div style="position:relative; float:left; width:50%;padding-right:10px; border-right: 1px dotted #CCC;">
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <td align="left" style="width:25%; text-align:left;">
                        <img src="<?php echo url('assets/images/glogo.png'); ?>" style="width:80px;float:left;" class="img-responsive">
                    </td>
                    <td align="center" style="width:50%; text-align:left;">
                        <center><b style="font-size: 16px;"><?php echo $_SESSION['COMPANY_NAME']??''; ?></b></center>
                        <center><b>বাংলাদেশ সচিবালয়, ঢাকা। </b></center>
                        <center><b><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn; ?> শাখা</b></center>
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                        <img src="<?php echo url('assets/images/m100.jpg'); ?>" style="width:120px;float:right;" class="img-responsive">
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <td align="left" style="width:25%; text-align:left;">
                        তারিখ : 
                    <?php
                        $date = date_create($data[0]['requisitions_date']);
                        echo str_replace( $search_array, $replace_array, date_format($date, 'd-m-Y') );
                    ?>
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                    <i>অফিস কপি</i>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>মালামালের বিবরণ</th>
                        <th align="right">চাহিদার পরিমান</th>
                        <th align="right">সরবরাহের পরিমান</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data2 as $dt) {
                        $p = $dt['requisitions_product'];
                        $product = in_out_object("product_id=$p", "product_name_en,product_name_bn", "product");
                        $p_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $product->product_name_en : $product->product_name_bn;
                    ?>
                        <tr>
                            <td><?php echo str_replace( $search_array, $replace_array, number_format(++$i) ); ?></td>
                            <td><?php echo $p_name; ?></td>
                            <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($dt['requisitions_product_qty']) ); ?></td>
                            <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($dt['requisitions_approve_product_qty']) ); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <table class="table">
                <tr style="border: none;">
                    <td style="border: none;">
                        <?php
                        $approver = in_out_object("user_type=5", "user_signature,user_emp_id", "users");
                        $sig_appr = $approver->user_signature;
                        $emp_id_app = $approver->user_emp_id;
                        $app_data = in_out_object("employee_information_id=" . $emp_id_app, "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                        $app_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_data->employee_name_en : $app_data->employee_name_bn;
                        $app_des = in_out_object("designation_id=" . $app_data->employee_designation, "designation_en,designation_bn", "designation");
                        $app_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_des->designation_en : $app_des->designation_bn;

                        $app_sec = in_out_object("section_id=" . $app_data->employee_section, "section_en,section_bn", "section");
                        $app_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_sec->section_en : $app_sec->section_bn;
                        if ($sig_appr != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_appr; ?>" width="120px" height="80px" />
                            <br>
                        <?php
                        }
                        ?>
                        স্বাক্ষরিত<br>
                        <?php echo $app_name; ?><br>
                        <?php echo $app_des_name; ?><br>
                        <?php echo $app_sec_name; ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        if(isset($data[0]['other_receiver']) && empty($data[0]['other_receiver'])){
                            if (isset($data[0]['requisitions_receiver']) && !empty($data[0]['requisitions_receiver'])) {
                                $receiver = in_out_object("user_emp_id=" . $data[0]['requisitions_receiver'], "user_signature", "users");
                                $sig_rcvr = $receiver->user_signature;
                                $receiver_data = in_out_object("employee_information_id=" . $data[0]['requisitions_receiver'], "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                                $r_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $receiver_data->employee_name_en : $receiver_data->employee_name_bn;
                                $r_des = in_out_object("designation_id=" . $receiver_data->employee_designation, "designation_en,designation_bn", "designation");
                                $r_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $r_des->designation_en : $r_des->designation_bn;

                                $r_sec = in_out_object("section_id=" . $receiver_data->employee_section, "section_en,section_bn", "section");
                                $r_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $r_sec->section_en : $r_sec->section_bn;
                                if ($sig_rcvr != '') {
                        ?>
                                <img src="<?php echo url('assets/user_photo/') . $sig_rcvr; ?>" width="120px" height="80px" />
                                <br>
                            <?php
                                }
                            ?>
                            স্বাক্ষরিত<br>
                            <?php echo $r_name; ?><br>
                            <?php echo $r_des_name; ?><br>
                            <?php echo $r_sec_name; ?>
                        <?php
                            }
                        }else{
                            echo $data[0]['other_receiver'];
                        }
                        ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        $submitter = in_out_object("user_emp_id=" . $data[0]['requisitions_employee'], "user_signature", "users");
                        $sig_apply = $submitter->user_signature;
                        $req_emp = in_out_object("employee_information_id=" . $data[0]['requisitions_employee'], "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                        $req_emp_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp->employee_name_en : $req_emp->employee_name_bn;
                        $req_emp_des = in_out_object("designation_id=" . $req_emp->employee_designation, "designation_en,designation_bn", "designation");
                        $req_emp_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp_des->designation_en : $req_emp_des->designation_bn;

                        $req_emp_sec = in_out_object("section_id=" . $req_emp->employee_section, "section_en,section_bn", "section");
                        $req_emp_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp_sec->section_en : $req_emp_sec->section_bn;
                        if ($sig_apply != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_apply; ?>" width="120px" height="80px" />
                            <br>
                        <?php
                        }
                        ?>
                        স্বাক্ষরিত<br>
                        <?php echo $req_emp_name; ?><br>
                        <?php echo $req_emp_des_name; ?><br>
                        <?php echo $req_emp_sec_name; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px;">অনুমোদনকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">গ্রহণকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">অধিযাচনকারীর স্বাক্ষর</td>
                </tr>
            </table>
        </div>
        <div style="position:relative; float:right; width:49%;">
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <td align="left" style="width:25%; text-align:left;">
                        <img src="<?php echo url('assets/images/glogo.png'); ?>" style="width:80px;float:left;" class="img-responsive">
                    </td>
                    <td align="center" style="width:50%; text-align:left;">
                        <center><b style="font-size: 16px;"><?php echo $_SESSION['COMPANY_NAME']??''; ?></b></center>
                        <center><b>বাংলাদেশ সচিবালয়, ঢাকা। </b></center>
                        <center><b><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn; ?> শাখা</b></center>
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                        <img src="<?php echo url('assets/images/m100.jpg'); ?>" style="width:120px;float:right;" class="img-responsive">
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <td align="left" style="width:25%; text-align:left;">
                        তারিখ : 
                    <?php
                        $date = date_create($data[0]['requisitions_date']);
                        echo str_replace( $search_array, $replace_array, date_format($date, 'd-m-Y') );
                    ?>
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                    <i>অধিযাচনকারীর কপি</i>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>মালামালের বিবরণ</th>
                        <th align="right">চাহিদার পরিমান</th>
                        <th align="right">সরবরাহের পরিমান</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data2 as $dt) {
                        $p = $dt['requisitions_product'];
                        $product = in_out_object("product_id=$p", "product_name_en,product_name_bn", "product");
                        $p_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $product->product_name_en : $product->product_name_bn;
                    ?>
                        <tr>
                            <td><?php echo str_replace( $search_array, $replace_array, number_format(++$i) ); ?></td>
                            <td><?php echo $p_name; ?></td>
                            <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($dt['requisitions_product_qty']) ); ?></td>
                            <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($dt['requisitions_approve_product_qty']) ); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <table class="table">
                <tr style="border: none;">
                    <td style="border: none;">
                        <?php
                        $approver = in_out_object("user_type=5", "user_signature,user_emp_id", "users");
                        $sig_appr = $approver->user_signature;
                        $emp_id_app = $approver->user_emp_id;
                        $app_data = in_out_object("employee_information_id=" . $emp_id_app, "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                        $app_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_data->employee_name_en : $app_data->employee_name_bn;
                        $app_des = in_out_object("designation_id=" . $app_data->employee_designation, "designation_en,designation_bn", "designation");
                        $app_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_des->designation_en : $app_des->designation_bn;

                        $app_sec = in_out_object("section_id=" . $app_data->employee_section, "section_en,section_bn", "section");
                        $app_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $app_sec->section_en : $app_sec->section_bn;
                        if ($sig_appr != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_appr; ?>" width="120px" height="80px" />
                            <br>
                        <?php
                        }
                        ?>
                        স্বাক্ষরিত<br>
                        <?php echo $app_name; ?><br>
                        <?php echo $app_des_name; ?><br>
                        <?php echo $app_sec_name; ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        if(isset($data[0]['other_receiver']) && empty($data[0]['other_receiver'])){
                            if (isset($data[0]['requisitions_receiver']) && !empty($data[0]['requisitions_receiver'])) {
                                $receiver = in_out_object("user_emp_id=" . $data[0]['requisitions_receiver'], "user_signature", "users");
                                $sig_rcvr = $receiver->user_signature;
                                $receiver_data = in_out_object("employee_information_id=" . $data[0]['requisitions_receiver'], "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                                $r_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $receiver_data->employee_name_en : $receiver_data->employee_name_bn;
                                $r_des = in_out_object("designation_id=" . $receiver_data->employee_designation, "designation_en,designation_bn", "designation");
                                $r_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $r_des->designation_en : $r_des->designation_bn;

                                $r_sec = in_out_object("section_id=" . $receiver_data->employee_section, "section_en,section_bn", "section");
                                $r_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $r_sec->section_en : $r_sec->section_bn;
                                if ($sig_rcvr != '') {
                        ?>
                                <img src="<?php echo url('assets/user_photo/') . $sig_rcvr; ?>" width="120px" height="80px" />
                                <br>
                            <?php
                                }
                            ?>
                            স্বাক্ষরিত<br>
                            <?php echo $r_name; ?><br>
                            <?php echo $r_des_name; ?><br>
                            <?php echo $r_sec_name; ?>
                        <?php
                            }
                        }else{
                            echo $data[0]['other_receiver'];
                        }
                        ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        $submitter = in_out_object("user_emp_id=" . $data[0]['requisitions_employee'], "user_signature", "users");
                        $sig_apply = $submitter->user_signature;
                        $req_emp = in_out_object("employee_information_id=" . $data[0]['requisitions_employee'], "employee_section,employee_designation,employee_name_en,employee_name_bn", "employee_information");
                        $req_emp_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp->employee_name_en : $req_emp->employee_name_bn;
                        $req_emp_des = in_out_object("designation_id=" . $req_emp->employee_designation, "designation_en,designation_bn", "designation");
                        $req_emp_des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp_des->designation_en : $req_emp_des->designation_bn;

                        $req_emp_sec = in_out_object("section_id=" . $req_emp->employee_section, "section_en,section_bn", "section");
                        $req_emp_sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $req_emp_sec->section_en : $req_emp_sec->section_bn;
                        if ($sig_apply != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_apply; ?>" width="120px" height="80px" />
                            <br>
                        <?php
                        }
                        ?>
                        স্বাক্ষরিত<br>
                        <?php echo $req_emp_name; ?><br>
                        <?php echo $req_emp_des_name; ?><br>
                        <?php echo $req_emp_sec_name; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px;">অনুমোদনকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">গ্রহণকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">অধিযাচনকারীর স্বাক্ষর</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>