<link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<div style="margin: 50px auto; width:90%;">
    <?php //print_r($data) 
    ?>
    <div style="width: 100%;">
        <div style="position:relative; float:left; width:50%;padding-right:10px; border-right: 1px dotted #CCC;">
            <center>বস্ত্র ও পাট মন্ত্রণালয়</center>
            <center>বাংলাদেশ সচিবালয়, ঢাকা। </center>
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
                    echo date_format($date, 'd-m-Y');
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
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $p_name; ?></td>
                            <td><?php echo $dt['requisitions_product_qty']; ?></td>
                            <td><?php echo $dt['requisitions_approve_product_qty']; ?></td>
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
                        $approver = in_out_object("user_type=5", "user_signature", "users");
                        $sig_appr = $approver->user_signature;
                        if ($sig_appr != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_appr; ?>" width="120px" height="80px" />
                        <?php } ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        if (isset($data[0]['requisitions_receiver']) && !empty($data[0]['requisitions_receiver'])) {
                            $receiver = in_out_object("user_emp_id=" . $data[0]['requisitions_receiver'], "user_signature", "users");
                            $sig_rcvr = $receiver->user_signature;
                            if ($sig_rcvr != '') {
                        ?>
                                <img src="<?php echo url('assets/user_photo/') . $sig_rcvr; ?>" width="120px" height="80px" />
                        <?php
                            }
                        }
                        ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        $submitter = in_out_object("user_emp_id=" . $data[0]['requisitions_employee'], "user_signature", "users");
                        $sig_apply = $submitter->user_signature;
                        if ($sig_apply != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_apply; ?>" width="120px" height="80px" />
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px;">সহকারী সচিব (প্রশাসন ২ )</td>
                    <td style="padding:5px;">গ্রহণকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">চাহিদাকারীর স্বাক্ষর</td>
                </tr>
            </table>
        </div>
        <div style="position:relative; float:right; width:49%;">
            <center>বস্ত্র ও পাট মন্ত্রণালয়</center>
            <center>বাংলাদেশ সচিবালয়, ঢাকা। </center>
            <span style="display: inline-block;">
                <span style="padding: 20px; display:block; float:left;"><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn; ?> শাখা</span>
                <span style="padding: 20px; display:block; float:right;">তারিখ :
                    <?php
                    $date = date_create($data[0]['requisitions_date']);
                    echo date_format($date, 'd-m-Y');
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
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $p_name; ?></td>
                            <td><?php echo $dt['requisitions_product_qty']; ?></td>
                            <td><?php echo $dt['requisitions_approve_product_qty']; ?></td>
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
                        $approver = in_out_object("user_type=5", "user_signature", "users");
                        $sig_appr = $approver->user_signature;
                        if ($sig_appr != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_appr; ?>" width="120px" height="80px" />
                        <?php } ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        if (isset($data[0]['requisitions_receiver']) && !empty($data[0]['requisitions_receiver'])) {
                            $receiver = in_out_object("user_emp_id=" . $data[0]['requisitions_receiver'], "user_signature", "users");
                            $sig_rcvr = $receiver->user_signature;
                            if ($sig_rcvr != '') {
                        ?>
                                <img src="<?php echo url('assets/user_photo/') . $sig_rcvr; ?>" width="120px" height="80px" />
                        <?php
                            }
                        }
                        ?>
                    </td>
                    <td style="border: none;">
                        <?php
                        $submitter = in_out_object("user_emp_id=" . $data[0]['requisitions_employee'], "user_signature", "users");
                        $sig_apply = $submitter->user_signature;
                        if ($sig_apply != '') {
                        ?>
                            <img src="<?php echo url('assets/user_photo/') . $sig_apply; ?>" width="120px" height="80px" />
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px;">সহকারী সচিব (প্রশাসন ২ )</td>
                    <td style="padding:5px;">গ্রহণকারীর স্বাক্ষর</td>
                    <td style="padding:5px;">চাহিদাকারীর স্বাক্ষর</td>
                </tr>
            </table>
        </div>
    </div>
</div>