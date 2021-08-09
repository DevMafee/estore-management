<link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
<title><?php echo $_SESSION['COMPANY_NAME']??''; ?></title>
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
<?php
    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
?>
<div style="margin: 50px auto; width:90%;">
    <div style="width: 100%;">
        <center><img src="<?php echo url('assets/images/glogo.png'); ?>" style="width:80px;" class="img-responsive"></center>
        <br>
        <center><b class="h3"><?php echo $_SESSION['COMPANY_NAME']??''; ?></b></center>
        <center><b class="h4">বাংলাদেশ সচিবালয়, ঢাকা। </b></center>
        <center><b class="h5">স্টোর ইন রিপোর্ট </b></center>
        <center class="h5">
            তারিখ :
            <?php
            $date2 = date_create($data2);
            $date3 = date_create($data3);
            echo str_replace($search_array, $replace_array, date_format($date2, 'd-m-Y')) . ' - হতে -' . str_replace($search_array, $replace_array, date_format($date3, 'd-m-Y')) . '<hr>';
            ?>
        </center>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>ইন্ডেন্ট নং</th>
                    <th>সরবরাহকারী</th>
                    <th>ক্রয়ের তারিখ</th>
                    <th>পণ্যের নাম</th>
                    <th>ক্রয়ের পরিমান</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($data as $dt) {
                    $product_id = $dt['store_receive_details_product_id'];
                    $pro = in_out_object("product_id=$product_id", "product_name_en,product_name_bn", "product");
                    $product = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $pro->product_name_en : $pro->product_name_bn;
                ?>
                    <tr>
                        <td><?php echo str_replace($search_array, $replace_array, ++$i ); ?></td>
                        <td><?php echo $dt['store_receive_indent']; ?></td>
                        <td><?php echo $dt['suppliers_bn']; ?></td>
                        <td>
                            <?php
                            $date_req = date_create($dt['store_receive_date']);
                            echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? date_format($date_req, 'd-m-Y'): str_replace($search_array, $replace_array, date_format($date_req, 'd-m-Y') );
                            ?>
                        </td>
                        <td><?php echo $product; ?></td>
                        <td align="right"><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $dt['store_receive_details_quantity']: str_replace($search_array, $replace_array, $dt['store_receive_details_quantity'] ); ?> <?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'PCS':'টি'; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    
</div>