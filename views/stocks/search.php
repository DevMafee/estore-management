<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">
              	    <div class="header">
              		    <span class="h4 mt-2"><?php echo $_SESSION['STOCK_REPORT']; ?></span>
              	    </div>
                    <div class="body">
                        <form action="<?php echo url('stocks/all'); ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php $_SESSION['csrf_token_search_requisitions'] = md5(rand()); ?>
                            <input type="hidden" name="csrf_token_search_requisitions" value="<?php echo $_SESSION['csrf_token_search_requisitions']; ?>">
                            <div class="modal-body mt-2">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="from_date"><?php echo $_SESSION['DATE_FROM']; ?></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="to_date"><?php echo $_SESSION['DATE_TO']; ?></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label></label>
                                        <div class="form-group">
                                            <input type="submit" class="btn bg-green" value="<?php echo $_SESSION['SEARCH']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>