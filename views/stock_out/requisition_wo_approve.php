<link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
<title><?php echo $_SESSION['COMPANY_NAME']??''; ?></title>
<link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<div class="row" style="width: 100%;margin: 15px auto;">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <input type="button" class="btn btn-success" style="padding:5px; float:right;margin-right: 85px;" onclick="printDiv('printArea')" value="Print Now" />
    </div>
</div>
<?php
$search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
$replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");

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
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                        <img src="<?php echo url('assets/images/m100.jpg'); ?>" style="width:120px;float:right;" class="img-responsive">
                    </td>
                </tr>
            </table>
            <span style="display: inline-block;">
                <span style="padding: 20px; display:block; float:left;">
                    <?php
                    $s = $data[0]['requisitions_section'];
                    $sec = in_out_object("section_id=$s", "section_en,section_bn", "section");
                    echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn;
                    ?> শাখা</span>
                <span style="padding: 20px; display:block; float:right;">তারিখ :
                    <?php
                        $date = date_create($data[0]['requisitions_date']);
                        echo str_replace( $search_array, $replace_array, date_format($date, 'd-m-Y') );
                    ?>
                </span>
            </span>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>মালামালের বিবরণ</th>
                        <th>চাহিদার পরিমান</th>
                        <th>সরবরাহের পরিমান</th>
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
                        &nbsp;
                    </td>
                    <td style="border: none;">
                        &nbsp;
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
                            স্বাক্ষরিত
                            <br>
                            <?php echo $req_emp_name; ?><br>
                            <?php echo $req_emp_des_name; ?><br>
                            <?php echo $req_emp_sec_name; ?>
                        <?php
                        } else {
                        ?>
                            স্বাক্ষরিত
                            <br>
                            <?php echo $req_emp_name; ?><br>
                            <?php echo $req_emp_des_name; ?><br>
                            <?php echo $req_emp_sec_name; ?>
                        <?php } ?>
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
                    </td>
                    <td align="right" style="width:25%; text-align:right;">
                        <img src="<?php echo url('assets/images/m100.jpg'); ?>" style="width:120px;float:right;" class="img-responsive">
                    </td>
                </tr>
            </table>
            <span style="display: inline-block;">
                <span style="padding: 20px; display:block; float:left;"><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn; ?> শাখা</span>
                <span style="padding: 20px; display:block; float:right;">তারিখ :
                    <?php
                        $date = date_create($data[0]['requisitions_date']);
                        echo str_replace( $search_array, $replace_array, date_format($date, 'd-m-Y') );
                    ?>
                </span>
            </span>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>মালামালের বিবরণ</th>
                        <th>চাহিদার পরিমান</th>
                        <th>সরবরাহের পরিমান</th>
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
                        &nbsp;
                    </td>
                    <td style="border: none;">
                        &nbsp;
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
                            স্বাক্ষরিত
                            <br>
                            <?php echo $req_emp_name; ?><br>
                            <?php echo $req_emp_des_name; ?><br>
                            <?php echo $req_emp_sec_name; ?>
                        <?php
                        } else {
                        ?>
                            স্বাক্ষরিত
                            <br>
                            <?php echo $req_emp_name; ?><br>
                            <?php echo $req_emp_des_name; ?><br>
                            <?php echo $req_emp_sec_name; ?>
                        <?php } ?>
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