<link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<style>
    .details_product_span {
        position: relative;
        width: 800px;
        display: inline-block;
    }

    .details_product_span span {
        position: relative;
        display: inline-block;
        width: 200px !important;
        text-align: center;
    }
</style>
<link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
<title><?php echo $_SESSION['COMPANY_NAME']??''; ?></title>
<div style="margin: 50px auto; width:90%;">
    <?php
    if (!empty($data2)) :
    ?>
        <div style="width: 100%;">
            <center><b class="h2"><?php echo $_SESSION['COMPANY_NAME']??''; ?></b></center>
            <center><b class="h3">বাংলাদেশ সচিবালয়, ঢাকা। </b></center>
            <center><b class="h4">চাহিদা পত্রের রিপোর্ট </b></center>
            <center class="h4">
                <?php
                echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $data2[0]['section_en'] : $data2[0]['section_bn'];
                ?> শাখা</center>
            <center class="h5">
                তারিখ :
                <?php
                $date = date_create($data3['start']);
                $date2 = date_create($data3['end']);
                echo date_format($date, 'd-m-Y') . ' - হতে -' . date_format($date2, 'd-m-Y') . '<hr>';
                ?>
            </center>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">ক্রমিক নং</th>
                        <th rowspan="2">চাহিদার তারিখ</th>
                        <th rowspan="2">কর্মকর্তার নাম</th>
                        <th colspan="4" style="width: 800px;text-align:center;">মালামালের বিবরণ</th>
                        <th rowspan="2">স্ট্যাটাস</th>
                    </tr>
                    <tr>
                        <th style="width: 200px;">পণ্যের নাম</th>
                        <th style="width: 200px;">চাহিদার পরিমান</th>
                        <th style="width: 200px;">অনুমোদন কৃত পরিমান</th>
                        <th style="width: 200px;">সরবরাহের পরিমান</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data as $dt) {
                        $e = $dt['requisitions_employee'];
                        $emp = in_out_object("employee_information_id=$e", "employee_name_en,employee_name_bn,employee_designation", "employee_information");
                        $emp_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;

                        $des = in_out_object("designation_id=" . $emp->employee_designation, "designation_en,designation_bn", "designation");
                        $des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $des->designation_en : $des->designation_bn;

                        if ($dt['requisitions_status'] == 1) {
                            $status = '<button type="button" class="btn btn-warning">Pending</button>';
                        } elseif ($dt['requisitions_status'] == 2) {
                            $status = '<button type="button" class="btn btn-primary">Approved</button>';
                        } elseif ($dt['requisitions_status'] == 3) {
                            $status = '<button type="button" class="btn btn-success">Received</button>';
                        } else {
                            $status = '<button type="button" class="btn btn-danger">Rejected</button>';
                        }
                    ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <?php
                                $date_req = date_create($dt['requisitions_date']);
                                echo date_format($date_req, 'd-m-Y');
                                ?>
                            </td>
                            <td><?php echo '<b>' . $emp_name . ',</b><br><i style="font-size:14px;">' . $des_name . '</i>'; ?></td>
                            <td colspan="4" style="width: 800px;">
                                <?php
                                $dtls = $dt['details'];
                                $dts_table = '';
                                if (count($dtls) > 1) {
                                    $hr = '<hr>';
                                } else {
                                    $hr = '';
                                }
                                foreach ($dtls as $dls) {
                                    $product = $dls['requisitions_product'];
                                    $prd = in_out_object("product_id=$product", "product_name_en,product_name_bn", "product");
                                    $prd_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $prd->product_name_en : $prd->product_name_bn;
                                    if ($dt['requisitions_status'] == 3) {
                                        $supply = $dls['requisitions_approve_product_qty'];
                                    } else {
                                        $supply = 0;
                                    }
                                    $dts_table .= '<span class="details_product_span"><span>' . $prd_name . '</span><span>' . $dls['requisitions_product_qty'] . '</span><span>' . $dls['requisitions_approve_product_qty'] . '</span><span>' . $supply . '</span></span>' . $hr;
                                }
                                echo $dts_table;
                                ?>
                            </td>
                            <td><?php echo $status; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    else :
    ?>
        <div style="width: 100%;">
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <td align="left" style="width:33%; text-align:left;">
                        <img src="<?php echo url('assets/images/glogo.png'); ?>" style="width:80px;float:left;" class="img-responsive">
                    </td>
                    <td align="center" style="width:33%; text-align:left;">
                        <center><b style="font-size: 16px;"><?php echo $_SESSION['COMPANY_NAME']??''; ?></b></center>
                        <center><b>বাংলাদেশ সচিবালয়, ঢাকা। </b></center>
                    </td>
                    <td align="right" style="width:33%; text-align:right;">
                        <img src="<?php echo url('assets/images/m100.jpg'); ?>" style="width:120px;float:right;" class="img-responsive">
                    </td>
                </tr>
            </table>
            <center><b class="h4">চাহিদা পত্রের রিপোর্ট </b></center>
            <center class="h5">
                তারিখ :
                <?php
                $date = date_create($data3['start']);
                $date2 = date_create($data3['end']);
                echo date_format($date, 'd-m-Y') . ' - হতে -' . date_format($date2, 'd-m-Y') . '<hr>';
                ?>
            </center>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">ক্রমিক নং</th>
                        <th rowspan="2">চাহিদার তারিখ</th>
                        <th rowspan="2">দপ্তর</th>
                        <th rowspan="2">কর্মকর্তার নাম</th>
                        <th colspan="4" align="center" style="width: 800px;">মালামালের বিবরণ</th>
                        <th rowspan="2">স্ট্যাটাস</th>
                    </tr>
                    <tr>
                        <th style="width: 200px;">পণ্যের নাম</th>
                        <th style="width: 200px;">চাহিদার পরিমান</th>
                        <th style="width: 200px;">অনুমোদন কৃত পরিমান</th>
                        <th style="width: 200px;">সরবরাহের পরিমান</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if(isset($data)){
                        if($data !='TOKEN'){
                            foreach ($data as $dt) {
                                $e = $dt['requisitions_employee'];
                                $emp = in_out_object("employee_information_id=$e", "employee_name_en,employee_name_bn,employee_designation", "employee_information");
                                $emp_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;

                                $s = $dt['requisitions_section'];
                                $sec = in_out_object("section_id=$s", "section_en,section_bn", "section");
                                $sec_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn;

                                $des = in_out_object("designation_id=" . $emp->employee_designation, "designation_en,designation_bn", "designation");
                                $des_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $des->designation_en : $des->designation_bn;

                                if ($dt['requisitions_status'] == 1) {
                                    $status = '<button type="button" class="btn btn-warning">Pending</button>';
                                } elseif ($dt['requisitions_status'] == 2) {
                                    $status = '<button type="button" class="btn btn-primary">Approved</button>';
                                } elseif ($dt['requisitions_status'] == 3) {
                                    $status = '<button type="button" class="btn btn-success">Received</button>';
                                } else {
                                    $status = '<button type="button" class="btn btn-danger">Rejected</button>';
                                }
                            ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        <?php
                                        $date_req = date_create($dt['requisitions_date']);
                                        echo date_format($date_req, 'd-m-Y');
                                        ?>
                                    </td>
                                    <td><?php echo '<b>' . $sec_name . '</b>'; ?></td>
                                    <td><?php echo '<b>' . $emp_name . ',</b><br><i style="font-size:14px;">' . $des_name . '</i>'; ?></td>
                                    <td colspan="4" style="width: 800px;">
                                        <?php
                                        $dtls = $dt['details'];
                                        $dts_table = '';
                                        if (count($dtls) > 1) {
                                            $hr = '<hr>';
                                        } else {
                                            $hr = '';
                                        }
                                        foreach ($dtls as $dls) {
                                            $product = $dls['requisitions_product'];
                                            $prd = in_out_object("product_id=$product", "product_name_en,product_name_bn", "product");
                                            $prd_name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $prd->product_name_en : $prd->product_name_bn;
                                            if ($dt['requisitions_status'] == 3) {
                                                $supply = $dls['requisitions_approve_product_qty'];
                                            } else {
                                                $supply = 0;
                                            }
                                            $dts_table .= '<span class="details_product_span"><span>' . $prd_name . '</span><span>' . $dls['requisitions_product_qty'] . '</span><span>' . $dls['requisitions_approve_product_qty'] . '</span><span>' . $supply . '</span></span>' . $hr;
                                        }
                                        echo $dts_table;
                                        ?>
                                    </td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                            <?php
                            }
                        }else{
                        ?>
                            <tr>
                                <td colspan="6">No Data Found Token Problem!</td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    endif;
    ?>
</div>