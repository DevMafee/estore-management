<style>
    .select2-container{
      /*width:200px !important;*/
      width:100% !important;
  }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="header">
                        <span class="h4 mt-2"><?php echo $_SESSION['REQUISITIONS_REPORTS']; ?></span>
                    </div>
                    <div class="body">
                        <form action="<?php echo url('requisitions/load_requisitions_report'); ?>" target="_blank" method="post" enctype="multipart/form-data">
                            <?php $_SESSION['csrf_token_search_requisitions'] = md5(rand()); ?>
                            <input type="hidden" name="csrf_token_search_requisitions" value="<?php echo $_SESSION['csrf_token_search_requisitions']; ?>">
                            <div class="modal-body mt-2">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <label for="section"><?php echo $_SESSION['SECTION']; ?></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="section" name="section" class="form-control select2">
                                                    <option value=""><?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'All Sections' : 'সব গুলো সেকশন'; ?></option>
                                                    <?php foreach ($data as $section) { ?>
                                                        <option value="<?php echo $section['section_id']; ?>">
                                                            <?php echo $_SESSION['LANGUAGE_SETTED'] == 'en' ? $section['section_en'] : $section['section_bn'];
                                                            echo ' [ ' . $section['section_id'] . ' ]'; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="from_date"><?php echo $_SESSION['DATE_FROM']; ?></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to_date"><?php echo $_SESSION['DATE_TO']; ?></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label></label>
                                        <div class="form-group">
                                            <input type="submit" class="btn bg-green" value="SEARCH">
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