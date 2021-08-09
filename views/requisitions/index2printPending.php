<!dOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon-->
        <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/x-icon">
        <title>বেসামরিক বিমান পরিবহন ও পর্যটন মন্ত্রণালয়</title>
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
                    <h4>বেসামরিক বিমান পরিবহন ও পর্যটন মন্ত্রণালয়</h4>
                    <h4>প্রশাসন - ২</h4>
                    <h5>www.mocat.gov.bd</h5>
                </center>
            </div>

            <table class="table table-hover export-datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                  <?php if ($_SESSION['user_type'] == 1) { ?>
                    <th scope="col"><?php echo $_SESSION['DEMANDER']; ?></th>
                  <?php } ?>
                  <th scope="col"><?php echo $_SESSION['DATE_REQUISITION']; ?></th>
                  <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $head) {
                    if ($head['requisitions_status'] == 1) {
                        $status = $_SESSION['PENDING'];
                    } elseif ($head['requisitions_status'] == 2) {
                        $status = $_SESSION['APPROVED'];
                    } elseif ($head['requisitions_status'] == 3) {
                        $status = $_SESSION['RECEIVEDQTY'];
                    } else {
                        $status = $_SESSION['REJECTED'];
                    }
                    $s = $head['requisitions_section'];
                    $sec = in_out_object("section_id=$s", "section_en,section_bn", "section");
                    $section = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $sec->section_en : $sec->section_bn;

                    $emp = in_out_object("employee_information_id=" . $head['requisitions_employee'], "employee_name_en,employee_name_bn", "employee_information");
                    $employee = $_SESSION['LANGUAGE_SETTED'] == 'en' ? $emp->employee_name_en : $emp->employee_name_bn;
                ?>
                  <tr>
                    <td><?php echo str_replace( $search_array, $replace_array, ++$i); ?></td>
                    <td><?php echo $section; ?></td>
                    <?php if ($_SESSION['user_type'] == 1) { ?>
                      <td><?php echo $employee; ?></td>
                    <?php } ?>
                    <td><?php echo $head['requisitions_date']!=''?str_replace( $search_array, $replace_array, date_format(date_create($head['requisitions_date']),"d-m-Y") ):''; ?></td>
                    <td><?php echo $status; ?></td>
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