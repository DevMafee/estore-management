<section class="content">
  <div class="container-fluid">
      <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="header">
                  <span class="h4 mt-2"><?php echo $_SESSION['APPROVAL']; ?></span>
                  <a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#approval">
                    <i class="material-icons">control_point</i> <b>Create New</b>
                  </a>
                </div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['APPROVAL']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ALTERNATIVE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['TEMP_OFFICER']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        $section_id = in_out_object("employee_information_id=".$head['approval_officer'], "employee_section", "employee_information");
                        $emp_name = in_out_object("employee_information_id=".$head['approval_officer'], "employee_name_bn,employee_name_en", "employee_information");
                        if (isset($head['approval_temp_officer'])) {
                          $temp_emp_name = in_out_object("employee_information_id=".$head['approval_temp_officer'], "employee_name_bn,employee_name_en", "employee_information");
                          $tmp_emp = $temp_emp_name!=''?$_SESSION['LANGUAGE_SETTED']=='en'?$temp_emp_name->employee_name_en:$temp_emp_name->employee_name_bn:'';
                        }else{
                          $tmp_emp = '';
                        }
                        
                        if ($head['approval_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }

                        if ($head['approval_temp']==1) {
                          $temp_status = '<span class="btn bg-green waves-effect"> YES </span>';
                        }else{
                          $temp_status = '<span class="btn bg-orange waves-effect"> NO </span>';
                        }

                        $approval = $_SESSION['LANGUAGE_SETTED']=='en'?$head['employee_name_en'].' ['.$head['designation_en'].']':$head['employee_name_bn'].' ['.$head['designation_bn'].']';
                        if($head['approval_temp_officer'] != 0){
                          foreach ($data3 as $aof) {
                            $eid = $aof['employee_information_id'];
                            $employee_aof_en = $aof['employee_name_en'];
                            $employee_aof_bn = $aof['employee_name_bn'];
                            if ($head['approval_temp_officer'] == $eid) {
                              $alternative = $_SESSION['LANGUAGE_SETTED']=='en'?$employee_aof_en:$employee_aof_bn;
                            }
                          }
                        }else{
                          $alternative = '';
                        }

                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $approval; ?></td>
                        <td><?php echo $temp_status; ?></td>
                        <td><?php echo $alternative; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_approval_<?php echo $head['approval_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_approval_<?php echo $head['approval_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_approval_<?php echo $head['approval_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('approval/update/'.$head['approval_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['approval_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['approval_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['approval_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="approval_section">SECTION <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_section" id="approval_section" onchange="return loadSectionWiseEmployee(this.value)" required>
                <option value=""> - Select -</option>
              <?php foreach($data2 as $sec):?>
                <option value="<?php echo $sec['section_id']; ?>" <?php echo $sec['section_id']==$section_id->employee_section?'selected':''; ?>><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$sec['section_en']:$sec['section_bn']; ?></option>
              <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_officer">OFFICER <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_officer" id="approval_officer" required>
                <option value="<?php echo $head['approval_officer']; ?>">
                  <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$emp_name->employee_name_en:$emp_name->employee_name_bn; ?>
                </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_temp">TEMP <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_temp" id="approval_temp" onchange="return loadTempEmployee(this.value)">
                <option value="0"<?php echo $head['approval_temp']==0?'selected':''; ?>>
                  <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NOT ALLOWED':'অনুমতি নেই'; ?>
                </option>
                <option value="1"<?php echo $head['approval_temp']==1?'selected':''; ?>>
                  <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'ALLOWED':'অনুমোদিত'; ?>
                </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_temp_officer">TEMP OFFICER <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_temp_officer" id="approval_temp_officer">
                <option value="<?php echo $head['approval_temp_officer']; ?>">
                  <?php echo $tmp_emp; ?>
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="Status_approval_<?php echo $head['approval_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('approval/update_status/'.$head['approval_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="approval_status_<?php echo $head['approval_id']; ?>" value="<?php echo $head['approval_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['approval_status']==1) {
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-orange waves-effect"> Inactive </span></center>';
            }else{
              echo $status = '<center><span class="h4">Make </span><span class="btn bg-green waves-effect"> Active </span></center>';
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
<div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('approval/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_approval']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_approval" value="<?php echo $_SESSION['csrf_token_approval']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="approval_section">SECTION <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_section" id="approval_section" onchange="return loadSectionWiseEmployee(this.value)" required>
                <option value=""> - Select -</option>
              <?php foreach($data2 as $sec):?>
                <option value="<?php echo $sec['section_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$sec['section_en']:$sec['section_bn']; ?></option>
              <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_officer">OFFICER <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_officer" id="approval_officer" required>
                <option value=""> - Select -</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_temp">TEMP <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_temp" id="approval_temp" onchange="return loadTempEmployee(this.value)">
                <option value="0"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'NOT ALLOWED':'অনুমতি নেই'; ?></option>
                <option value="1"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?'ALLOWED':'অনুমোদিত'; ?></option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="approval_temp_officer">TEMP OFFICER <span class="text-danger">*</span></label>
            <div class="form-group">
              <select class="form-control" name="approval_temp_officer" id="approval_temp_officer">
                <option value=""> - Select -</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function loadSectionWiseEmployee(section){
    var url = "<?php echo url('approval/loadSectionWise/')?>"+section;
    $.getJSON( url, function( data ) {
      $("#approval_officer").html('<option value=""> - No Employee -</option>');
      var options = '';
      $.each( data, function( key, val ) {
        options += '<option value="'+val.employee_information_id+'">'+val.employee_name_bn+'</option>';
      });
      $("#approval_officer").append(options);
    });
  }

  function loadTempEmployee(status){
    if (status == 1) {
      var section = $("#approval_section").val();
      var url = "<?php echo url('approval/loadTempEmployee/')?>"+section;
      $.getJSON( url, function( data ) {
        $("#approval_temp_officer").html('<option value=""> - NO Employee -</option>');
        var options = '';
        $.each( data, function( key, val ) {
          var per = $("#approval_officer").val();
          if (per !== val.employee_information_id) {
            options += '<option value="'+val.employee_information_id+'">'+val.employee_name_bn+'</option>';
          }
        });
        $("#approval_temp_officer").append(options);
      });
    }else{
      $("#approval_temp_officer").html('<option value=""> - NO Employee -</option>');
    }
    
  }
</script>