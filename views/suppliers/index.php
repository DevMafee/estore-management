<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['SUPPLIERS']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#suppliers">
                    <i class="material-icons">control_point</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New':'নতুন যুক্ত করুন'; ?></b>
                  </a>
                </div>
                <div class="body">
                  <table class="table export-datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['SUPPLIERS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ADDRESS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['MOBILE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['PHOTO']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['suppliers_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> '.$_SESSION['ACTIVE'].' </span>';
                          $class = 'btn-danger';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> '.$_SESSION['INACTIVE'].' </span>';
                          $class = 'btn-success';
                        }
                        $suppliers = $_SESSION['LANGUAGE_SETTED']=='en'?$head['suppliers_en']:$head['suppliers_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $suppliers; ?></td>
                        <td><?php echo $head['suppliers_address']; ?></td>
                        <td><?php echo $head['suppliers_mobile_personal']; ?></td>
                        <td><img src="<?php echo url('assets/suppliers_photo/'.$head['suppliers_photo']); ?>" class="img-responsive" style="width:60px;"></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" title="Edit" data-target="#Edit_suppliers_<?php echo $head['suppliers_id']; ?>">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" class="btn <?php echo $class; ?> btn-circle waves-effect waves-circle waves-float" onclick="return change_suppliers_status(<?php echo $head['suppliers_id']; ?>,<?php echo $head['suppliers_status']; ?>)">
                            <i class="material-icons">cached</i>
                          </button>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_suppliers_<?php echo $head['suppliers_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Edit':'সম্পাদনা করুন'; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('suppliers/update/'.$head['suppliers_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_suppliers_'.$head['suppliers_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_suppliers_<?php echo $head['suppliers_id']; ?>" value="<?php echo $_SESSION['csrf_token_suppliers_'.$head['suppliers_id']]; ?>">
        <div class="modal-body mt-2">

          <div class="row clearfix">
            <div class="col-md-6">
              <label for="suppliers_en_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (English)':'সরবরাহকারীর নাম (ইংরেজি)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_en_<?php echo $head['suppliers_id']; ?>" name="suppliers_en_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_en']; ?>" required>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="suppliers_bn_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (Bangla)':'সরবরাহকারীর নাম (বাংলা)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_bn_<?php echo $head['suppliers_id']; ?>" name="suppliers_bn_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_bn']; ?>" required>
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="suppliers_photo_cng_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Photo':'সরবরাহকারীর ছবি'; ?> </label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" id="suppliers_photo_cng_<?php echo $head['suppliers_id']; ?>" name="suppliers_photo_cng_<?php echo $head['suppliers_id']; ?>" class="form-control">
                  <input type="hidden" id="suppliers_photo_<?php echo $head['suppliers_id']; ?>" name="suppliers_photo_<?php echo $head['suppliers_id']; ?>" value="<?php echo $head['suppliers_photo']; ?>">
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="suppliers_mobile_personal_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_mobile_personal_<?php echo $head['suppliers_id']; ?>" name="suppliers_mobile_personal_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_mobile_personal']; ?>">
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="suppliers_phone_business_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Business)':'মোবাইল (ব্যবসায়ীক)'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_phone_business_<?php echo $head['suppliers_id']; ?>" name="suppliers_phone_business_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_phone_business']; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="suppliers_fax_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'FAX':'ফ্যাক্স'; ?> </label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_fax_<?php echo $head['suppliers_id']; ?>" name="suppliers_fax_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_fax']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="suppliers_email_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="email" id="suppliers_email_<?php echo $head['suppliers_id']; ?>" name="suppliers_email_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_email']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="suppliers_address_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Address':'বর্তমান ঠিকানা'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" class="form-control" name="suppliers_address_<?php echo $head['suppliers_id']; ?>" id="suppliers_address_<?php echo $head['suppliers_id']; ?>" value="<?php echo $head['suppliers_address']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-6">
              <label for="suppliers_nid_no_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NID No':'এনআইডি নাম্বার'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_nid_no_<?php echo $head['suppliers_id']; ?>" name="suppliers_nid_no_<?php echo $head['suppliers_id']; ?>" class="form-control" value="<?php echo $head['suppliers_nid_no']; ?>">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="suppliers_nid_file_cng_<?php echo $head['suppliers_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NID File':'এনআইডি ছবি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" class="form-control" name="suppliers_nid_file_cng_<?php echo $head['suppliers_id']; ?>" id="suppliers_nid_file_cng_<?php echo $head['suppliers_id']; ?>" >
                  <input type="hidden" class="form-control" name="suppliers_nid_file_<?php echo $head['suppliers_id']; ?>" id="suppliers_nid_file_<?php echo $head['suppliers_nid_file']; ?>" >
                </div>
              </div>
            </div>
          </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
          <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="suppliers" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <form action="<?php echo url('suppliers/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_suppliers']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_suppliers" value="<?php echo $_SESSION['csrf_token_suppliers']; ?>">
        <div class="modal-body mt-2">

          <div class="row clearfix">
            <div class="col-md-6">
              <label for="suppliers_en"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (English)':'সরবরাহকারীর নাম (ইংরেজি)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_en" name="suppliers_en" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (English)':'সরবরাহকারীর নাম (ইংরেজি)'; ?>..." required>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="suppliers_bn"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (Bangla)':'সরবরাহকারীর নাম (বাংলা)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_bn" name="suppliers_bn" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Name (Bangla)':'সরবরাহকারীর নাম (বাংলা)'; ?> ..." required>
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-3">
              <label for="suppliers_photo"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Supplier\'s Photo':'সরবরাহকারীর ছবি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" id="suppliers_photo" name="suppliers_photo" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label for="suppliers_mobile_personal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_mobile_personal" name="suppliers_mobile_personal" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল'; ?> ..">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label for="suppliers_phone_business"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Business)':'মোবাইল (ব্যবসায়ীক)'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_phone_business" name="suppliers_phone_business" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Business)':'মোবাইল (ব্যবসায়ীক)'; ?> ..">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <label for="suppliers_fax"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'FAX':'ফ্যাক্স'; ?> </label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_fax" name="suppliers_fax" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'FAX':'ফ্যাক্স'; ?> ..">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-3">
              <label for="suppliers_email"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_email" name="suppliers_email" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?> ..">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <label for="suppliers_address"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Address':'বর্তমান ঠিকানা'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" class="form-control" name="suppliers_address" id="suppliers_address" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Address':'বর্তমান ঠিকানা'; ?> ..">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label for="suppliers_nid_no"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NID No':'এনআইডি নাম্বার'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="suppliers_nid_no" name="suppliers_nid_no" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NID No':'এনআইডি নাম্বার'; ?> ..">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label for="suppliers_nid_file"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NID File':'এনআইডি ছবি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" id="suppliers_nid_file" name="suppliers_nid_file" class="form-control">
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Close':'বন্ধ করুন'; ?></button>
          <button type="submit" class="btn btn-primary"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Save':'সংরক্ষণ করুন'; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function change_suppliers_status(id,status){
    if (confirm('Are you Sure?')==true) {
      $.ajax({
        url   : "<?php echo url('suppliers/update_status'); ?>",
        method: 'POST',
        data: {id,status},
        success:function(data){
          window.location.href="<?php echo url('suppliers/all'); ?>";
        }
      })
    }
  }
</script>