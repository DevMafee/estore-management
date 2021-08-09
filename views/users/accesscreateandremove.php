<main class="app-main">
    <div class="wrapper">
      <div class="page">
        <div class="page-inner">
          <div class="page-section">
            <br>
            <div class="row">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-success">
                  <div class="card-body">
                    <div class="accordion" id="accordionExample">
                      <div class="card" style="margin-bottom: 5px;">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h2 class="mb-0">Set Access</h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <form action="<?php echo url('users/access_set'); ?>" method="post" enctype="multipart/form-data">
                              <?php $_SESSION['csrf_token']=md5(rand()); ?>
                              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                              <fieldset>
                                <legend><h4>Create New User</h4> <small>You can not Remove Access from here. <span class="text-danger">Only you can Add Access</span>.</small></legend>
                                <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="user_name_select_set">User Name Select</label>
                                      <select class="custom-select custom-select-sm" id="user_name_select_set" name="user_name_select_set">
                                        <option value=""> -- Select User -- </option>
                                    <?php foreach($data as $user): ?>
                                        <option value="<?php echo $user['username'];?>"> <?php echo $user['full_name'];?> </option>
                                    <?php endforeach; ?>
                                      </select>
                                      <div id="LoadAccessMenus"></div>
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <fieldset style="max-height: 400px; padding: 10px; overflow: scroll;">
                                        <?php foreach($data2 as $menu): ?>
                                          <label style="padding: 10px; margin: 5px; width: 200px;" class="clsdflt_set <?php echo 'clsdflt_set_'.$menu['main_menu_id'];?> bg-warning"><input type="checkbox" class="chkbx_set" name="access_set[]" id="<?php echo 'access_set_check_'.$menu['main_menu_id'];?>" value="<?php echo $menu['main_menu_id'];?>">&nbsp;<?php echo $menu['main_menu_name'];?></label>
                                        <?php endforeach; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-actions">
                                    <button class="btn btn-primary mx-2" type="submit">Submit</button>
                                    <button class="btn btn-warning mx-2" type="reset">Reset</button>
                                  </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h2 class="mb-0">Remove Access</h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <form action="<?php echo url('users/access_remove'); ?>" method="post" enctype="multipart/form-data">
                              <?php $_SESSION['csrf_token']=md5(rand()); ?>
                              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                              <fieldset>
                                <legend><h4>Create New User</h4> <small>You can not Remove Access from here. <span class="text-danger">Only you can Add Access</span>.</small></legend>
                                <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="user_name_select_remove">User Name Select</label>
                                      <select class="custom-select custom-select-sm" id="user_name_select_remove" name="user_name_select_remove">
                                        <option value=""> -- Select User -- </option>
                                    <?php foreach($data as $user): ?>
                                        <option value="<?php echo $user['username'];?>"> <?php echo $user['full_name'];?> </option>
                                    <?php endforeach; ?>
                                      </select>
                                      <div id="LoadAccessMenus"></div>
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <fieldset style="max-height: 400px; padding: 10px; overflow: scroll;">
                                        <?php foreach($data2 as $menu): ?>
                                          <label style="padding: 10px; margin: 5px; width: 200px;" class="clsdflt_remove <?php echo 'clsdflt_remove_'.$menu['main_menu_id'];?> bg-warning"><input type="checkbox" class="chkbx_remove" name="access_remove[]" id="<?php echo 'access_remove_check_'.$menu['main_menu_id'];?>" value="<?php echo $menu['main_menu_id'];?>">&nbsp;<?php echo $menu['main_menu_name'];?></label>
                                        <?php endforeach; ?>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-actions">
                                    <button class="btn btn-primary mx-2" type="submit">Submit</button>
                                    <button class="btn btn-warning mx-2" type="reset">Reset</button>
                                  </div>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
<script>
  $("#user_name_select_set").change(function(){
    var url = <?php echo '"'.base_url('site_link').'"'?>;
    var user = $("#user_name_select_set").val();
    $(".chkbx_set").attr('checked',false);
    $('.clsdflt_set').removeClass('bg-info text-white');
    $('.clsdflt_set').addClass('bg-warning');
    $.ajax({
      url     : url+'users/checkoutaccess',
      method  : "POST",
      data    : {user:user},
      success : function(access) {
        var arr_data = access.split('-');
        var lengths = (arr_data.length -1);
        for(var i=0; i<lengths; i++){
          var id_set = "#access_set_check_"+arr_data[i];
          var classes_set = ".clsdflt_set_"+arr_data[i];
          $(id_set).attr('checked',true);
          $(classes_set).removeClass('bg-warning');
          $(classes_set).addClass('bg-info text-white');
        }
      }
    })
  })
  $("#user_name_select_remove").change(function(){
    var url = <?php echo '"'.base_url('site_link').'"'?>;
    var user = $("#user_name_select_remove").val();
    $(".chkbx_remove").attr('checked',false);
    $('.clsdflt_remove').removeClass('bg-info text-white');
    $('.clsdflt_remove').addClass('bg-warning');
    $.ajax({
      url     : url+'users/checkoutaccess',
      method  : "POST",
      data    : {user:user},
      success : function(access) {
        var arr_data = access.split('-');
        var lengths = (arr_data.length -1);
        for(var i=0; i<lengths; i++){
          var id_remove = "#access_remove_check_"+arr_data[i];
          var classes_remove = ".clsdflt_remove_"+arr_data[i];
          $(id_remove).attr('checked',true);
          $(classes_remove).removeClass('bg-warning');
          $(classes_remove).addClass('bg-info text-white');
        }
      }
    })
  })
</script>