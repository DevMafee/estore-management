<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['ACTIVE_EMPLOYEE']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#employee_information">
                    <i class="material-icons">control_point</i> <b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New Employee':'নতুন কর্মকর্তা যুক্ত করুন'; ?></b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover"><!--  export-datatable -->
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['PHOTO']; ?></th>
                        <th scope="col"><?php echo $_SESSION['EMPLOYEE_INFORMATION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['DESIGNATION']; ?></th>
                        <th scope="col"><?php echo $_SESSION['MOBILE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['EMP_ID']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['employee_information_status']==1) {
                          $active = $_SESSION['LANGUAGE_SETTED']=='en'?'Actice':'সক্রিয়';
                          $status = '<span class="btn bg-green waves-effect"> '.$active.' </span>';
                          $class = 'btn-danger';
                        }else{
                          $inactive = $_SESSION['LANGUAGE_SETTED']=='en'?'Inactive':'নিষ্ক্রিয়';
                          $status = '<span class="btn bg-orange waves-effect">'.$inactive.'</span>';
                          $class = 'btn-success';
                        }
                        $employee_information = $_SESSION['LANGUAGE_SETTED']=='en'?$head['employee_name_en']:$head['employee_name_bn'];
                        $section = $_SESSION['LANGUAGE_SETTED']=='en'?$head['section_en']:$head['section_bn'];
                        $designation = $_SESSION['LANGUAGE_SETTED']=='en'?$head['designation_en']:$head['designation_bn'];
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['employee_photo']!=''?'<img class="img-responsive" style="width:70px;" src="'.url('assets/user_photo/').$head['employee_photo'].'" />':''; ?></td>
                        <td><?php echo $employee_information; ?></td>
                        <td><?php echo $section; ?></td>
                        <td><?php echo $designation; ?></td>
                        <td><?php echo $head['employee_mobile_personal']; ?></td>
                        <td><?php echo $head['employee_id']; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="width: 30px !important; height: 30px !important; line-height: 1.5em !important;padding: 5px 7px !important;" data-toggle="modal" title="Edit" data-target="#Edit_employee_information_<?php echo $head['employee_information_id']; ?>">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" class="btn <?php echo $class; ?> btn-circle waves-effect waves-circle waves-float" style="width: 30px !important; height: 30px !important; line-height: 1.5em !important;padding: 5px 7px !important;" onclick="return change_employee_status(<?php echo $head['employee_information_id']; ?>,<?php echo $head['employee_information_status']; ?>)">
                            <i class="material-icons">cached</i>
                          </button>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_employee_information_<?php echo $head['employee_information_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Edit':'সম্পাদনা করুন'; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_information/update/'.$head['employee_information_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['employee_information_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['employee_information_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['employee_information_id']]; ?>">
        <div class="modal-body mt-2">

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_section_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['SECTION']; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="employee_section_<?php echo $head['employee_information_id']; ?>" id="employee_section_<?php echo $head['employee_information_id']; ?>" required>
                    <option value=""> - <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> - </option>
                  <?php foreach($data2 as $section): ?>
                    <option value="<?php echo $section['section_id']; ?>" <?php echo $section['section_id']==$head['employee_section']?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$section['section_en']:$section['section_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="employee_designation_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['DESIGNATION']; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="employee_designation_<?php echo $head['employee_information_id']; ?>" id="employee_designation_<?php echo $head['employee_information_id']; ?>" required>
                    <option value=""> - <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> - </option>
                  <?php foreach($data3 as $designation): ?>
                    <option value="<?php echo $designation['designation_id']; ?>" <?php echo $designation['designation_id']==$head['employee_designation']?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$designation['designation_en']:$designation['designation_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_id_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'E-Nothi ID':'ই - নথি আইডি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_id_<?php echo $head['employee_information_id']; ?>" name="employee_id_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_id']; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_name_en_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (English)':'কর্মকর্তার নাম (ইংরেজি)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_name_en_<?php echo $head['employee_information_id']; ?>" name="employee_name_en_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_name_en']; ?>" required>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="employee_name_bn_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (Bengali)':'কর্মকর্তার নাম (বাংলা)'; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_name_bn_<?php echo $head['employee_information_id']; ?>" name="employee_name_bn_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_name_bn']; ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_photo_cng_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Photo ':'কর্মকর্তার ছবি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" id="employee_photo_cng_<?php echo $head['employee_information_id']; ?>" name="employee_photo_cng_<?php echo $head['employee_information_id']; ?>" class="form-control">
                  <input type="hidden" id="employee_photo_<?php echo $head['employee_information_id']; ?>" name="employee_photo_<?php echo $head['employee_information_id']; ?>" value="<?php echo $head['employee_photo']; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_mobile_personal_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল (ব্যক্তিগত)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_mobile_personal_<?php echo $head['employee_information_id']; ?>" name="employee_mobile_personal_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_mobile_personal']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_phone_office_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Office)':'ফোন (অফিস)'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_phone_office_<?php echo $head['employee_information_id']; ?>" name="employee_phone_office_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_phone_office']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_email_<?php echo $head['employee_information_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="email" id="employee_email_<?php echo $head['employee_information_id']; ?>" name="employee_email_<?php echo $head['employee_information_id']; ?>" class="form-control" value="<?php echo $head['employee_email']; ?>" required>
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
<div class="modal fade" id="employee_information" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Add New Employee':'নতুন কর্মকর্তা যুক্ত করুন'; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('employee_information/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_employee_information']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_employee_information" value="<?php echo $_SESSION['csrf_token_employee_information']; ?>">
        <div class="modal-body mt-2">

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_section"><?php echo $_SESSION['SECTION']; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="employee_section" id="employee_section" required>
                    <option value=""> -<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> - </option>
                  <?php foreach($data2 as $section): ?>
                    <option value="<?php echo $section['section_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$section['section_en']:$section['section_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="employee_designation"><?php echo $_SESSION['DESIGNATION']; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="employee_designation" id="employee_designation" required>
                    <option value=""> -<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Select':'নির্বাচন করুন'; ?> - </option>
                  <?php foreach($data3 as $designation): ?>
                    <option value="<?php echo $designation['designation_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$designation['designation_en']:$designation['designation_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_id"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'E-Nothi ID':'ই - নথি আইডি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_id" name="employee_id" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'E-Nothi ID':'ই - নথি আইডি'; ?>...">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_name_en"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (English)':'কর্মকর্তার নাম (ইংরেজি)'; ?><span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_name_en" name="employee_name_en" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (English)':'কর্মকর্তার নাম (ইংরেজি)'; ?>..." required>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="employee_name_bn"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (Bengali)':'কর্মকর্তার নাম (বাংলা)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_name_bn" name="employee_name_bn" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Name (Bengali)':'কর্মকর্তার নাম (বাংলা)'; ?> ..." required>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_photo"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Officers Photo ':'কর্মকর্তার ছবি'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="file" id="employee_photo" name="employee_photo" class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-4">
              <label for="employee_mobile_personal"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল (ব্যক্তিগত)'; ?> <span class="text-danger">*</span></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_mobile_personal" name="employee_mobile_personal" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Mobile (Personal)':'মোবাইল (ব্যক্তিগত)'; ?> .." required>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_phone_office"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Office)':'ফোন (অফিস)'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="employee_phone_office" name="employee_phone_office" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Phone (Office)':'ফোন (অফিস)'; ?> ..">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="employee_email"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?></label>
              <div class="form-group">
                <div class="form-line">
                  <input type="email" id="employee_email" name="employee_email" class="form-control" placeholder="<?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'Email':'ইমেইল'; ?> .." >
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
  function change_employee_status(id,status){
    if (confirm('Are you Sure?')==true) {
      $.ajax({
        url   : "<?php echo url('employee_information/update_status'); ?>",
        method: 'POST',
        data: {id,status},
        success:function(data){
          window.location.href="<?php echo url('employee_information/active'); ?>";
        }
      })
    }
  }
</script>