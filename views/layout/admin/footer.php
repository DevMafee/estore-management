    <hr>
    <section class="content" style="margin: 0 !important;">
        <div class="container-fluid" style="position: fixed;bottom: -30px;left: 0;width: 100%; padding-right: 0 !important; padding-left: 0 !important; max-height: 70px !important;">
            <div class="row clearfix">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="row" style="position: relative;bottom: -10px;">
                            <div class="col-lg-3 col-xl-3" style="width: 100%;max-width: 250px;"></div>
                            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 col-xs-12" style="text-align: left;">
                                <span style="margin-left: 35px;">
                                   &copy; <?php echo date('Y'); ?> &nbsp;&nbsp;<img src="<?php echo url('assets/images/favicon.png'); ?>" style="width:20px !important;margin-top: -10px !important;">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0);" style="text-decoration: none;">
                                        <?php echo $_SESSION['COMPANY_NAME']??''; ?>
                                    </a>
                                </span>
                            </div>
                            <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
                                <span style="margin-right: 20px !important;">
<?php echo isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='bn'?'প্রস্তুত করেছেন':'Developed By'; ?>
                                     - 
                                    <a href="http://www.simecsystem.com/" target="_blank" style="text-decoration: none;">
                                        <img src="<?php echo url('assets/images/logo.png'); ?>" style="width:60px !important;margin-top: -10px !important;">
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DATA TABLE -->
    <script>
        setTimeout(function(){
            $(".alert-dismissible").hide();
        }, 10000);
        $(document).ready(function () {
            $('.export-datatable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('.datatable').DataTable({
                responsive: true
            });
            $('.dataTables_length').addClass('bs-select');

        });
    </script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    
    <!-- <script src="<?php //echo base_url('site_link'); ?>assets/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-countto/jquery.countTo.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/js/admin.js"></script>
    <script type="text/javascript">

        //date Picker
        // $('.datepicker').bootstrapMaterialDatePicker({
        //     format: 'dddd DD MMMM YYYY',
        //     clearButton: true,
        //     weekStart: 1,
        //     time: false
        // });

        // $('.timepicker').bootstrapMaterialDatePicker({
        //     format: 'HH:mm',
        //     clearButton: true,
        //     date: false
        // });
    </script>
    <!-- <script src="<?php //echo base_url('site_link'); ?>assets/backend/js/pages/index.js"></script> -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url('site_link'); ?>assets/backend/js/demo.js"></script>

    <script>
        $('.select2').select2({ width: 'resolve' });
        $('.count-to').countTo();
        // function sidebar_select(){
        //     var path = window.location;
        //     if ( path == '' || path == 'Home/dashboard' || path == 'Home') {
        //       path = './';
        //     }
        //     var target = $('ul li a[href="'+path+'"]');
        //     target.addClass('toggled active');
        //     target.parent().addClass('active');
        //     target.parent().parent().siblings().addClass('toggled');
        //     target.parent().parent().css("display", "block");
        //     target.parent().parent().parent().addClass('active');
        //     target.parent().parent().parent().parent().siblings().addClass('toggled');
        // }
    </script>
</body>

</html>