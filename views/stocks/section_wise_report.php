<!dOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon-->
        <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
        <title><?php echo $_SESSION['COMPANY_NAME']??''; ?></title>
        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
            padding: 4px 10px 1px 10px;
        }
        </style>
    </head>
<?php

$search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
$replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");

?>
    <body class="container" style="margin-top: 20px !important;">
        <div class="row" style="width: 100%;margin: 15px auto;">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <input type="button" class="btn btn-success" style="padding:5px; float:right;margin-right: 85px;" onclick="printDiv('printArea')" value="Print Now" />
            </div>
        </div>
        <div id="printArea">
            <div class="row">
                <center>
                    <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                    <h4><?php echo $_SESSION['COMPANY_NAME']??''; ?></h4>
                    <h4>প্রশাসন - ২</h4>
                    <h6><?php if($data3 != ''){echo $data3.' - এ ';} ?> সরবরাহ কৃত মালামালের বিবরণী - <?php echo 'তারিখ : '.str_replace( $search_array, $replace_array, date_format(date_create($data2['from_date']),"d-m-Y") ).' হইতে '.str_replace( $search_array, $replace_array, date_format(date_create($data2['to_date']),"d-m-Y") ).' পর্যন্ত'; ?></h6>
                </center>
            </div>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo $_SESSION['PRODUCTS']; ?></th>
                    <?php if($data3 == ''){ ?>
                    <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                    <?php } ?>
                    <th scope="col" style="text-align:right !important;"><?php echo $_SESSION['IN_PRADHIKAR']; ?></th>
                    <th scope="col" style="text-align:right !important;"><?php echo $_SESSION['RECEIVED']; ?></th>
                    <th scope="col" style="text-align:right !important;"><?php echo $_SESSION['DATE']; ?></th>
                    <th scope="col" style="text-align:right !important;"><?php echo $_SESSION['IN_STOCK']; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach($data as $head){
                ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['product_name']; ?></td>
                        <?php if($data3 == ''){ ?>
                        <td><?php echo $head['section_name']; ?></td>
                        <?php } ?>
                        <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($head['limit']) ); ?></td>
                        <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($head['receive']) ); ?></td>
                        <td align="right"><?php echo str_replace( $search_array, $replace_array, date_format(date_create($head['receive_date']),"d-m-Y") ); ?></td>
                        <td align="right"><?php echo str_replace( $search_array, $replace_array, number_format($head['total_receive']) ); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>