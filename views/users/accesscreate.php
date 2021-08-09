<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <h3 class="title"><h4>USER ACCESS CREATE</h4></h3>
          </div>
          <div class="body">
            <form action="<?php echo url('users/access_save'); ?>" method="post" enctype="multipart/form-data">
              <?php $_SESSION['csrf_token']=md5(rand()); ?>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

              <legend><small>You can not Remove Access from here. <span class="text-danger">Only you can Add Access</span>.</small></legend>
              <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                    <label for="user_name_select">User Type</label>
                    <select class="form-control" id="user_name_select" name="user_name_select">
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
                    
                    
                    <fieldset style="min-height: 100px; padding: 10px;">
                      <?php foreach($data2 as $menu): ?>
                        <input type="checkbox" id="<?php echo $menu['main_menu_id'];?>" name="access[]" class="filled-in chkbx <?php echo 'chkbx_'.$menu['main_menu_id'];?>" value="<?php echo $menu['main_menu_id'];?>">
                        <label for="<?php echo $menu['main_menu_id'];?>"><?php echo $menu['main_menu_name'];?></label>
                      <?php endforeach; ?>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <button class="btn btn-primary mx-2" type="submit">Submit</button>
                <button class="btn btn-warning mx-2" type="reset">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $("#user_name_select").change(function(){
    var user = $("#user_name_select").val();
    $(".chkbx").removeAttr('checked');
    $.ajax({
      url     : <?php echo '"'.url('users/checkoutaccess').'"'; ?>,
      method  : "POST",
      data    : {user:user},
      success : function(access) {
        var arr_data = access.split('-');
        var lengths = (arr_data.length -1);
        $(".chkbx").attr("checked",true);
        for(var i=0; i<lengths; i++){
          // var id = $("'#"+arr_data[i]+"'");
          // $('".chkbx_'+arr_data[i]+'"').attr("checked", "checked");// = true;
          // var classes = document.getElementById(arr_data[i]);
          // classes.attr("checked", "checked");
          console.log(arr_data[i]);
        }
      }
    })
  })
</script>