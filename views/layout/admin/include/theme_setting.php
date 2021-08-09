<button style="position: fixed; top: 52px; right: 0; display: block !important; color: #fff!important; background-color: #009688!important; border:none; font-size: 16px!important; padding: 5px; vertical-align: middle; overflow: hidden; z-index: 1;" onclick="GetThisDisplayed()"><i class="fas fa-chevron-circle-left"></i></button>
<div class="MyClass" style="position:absolute !important; display:none; box-shadow:0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12); height:auto; background-color:#FFF; z-index:2; top:52px; right:0; overflow:auto; width:200px; transition: all 500ms ease;" id="mySidebar">

  <div class="card" style="margin-bottom: 0 !important; border:none;">
    <div class="card-header text-center p-2" style="cursor: pointer; background-color: #5c048f; color: #FFF;" onclick="GetThisHidden()">
      Hide Menu? <i class="fas fa-chevron-circle-right"></i>
    </div>
    <div class="card-body" style="padding: 0 !important; border:none;">
      <div class="accordion" id="accordionExample">
        <div class="card" style="margin-bottom: 0 !important;">
          <div class="card-header app-header-dark text-white" style="padding: 0 !important; border: none !important; border-radius: 0 !important; cursor: pointer;" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <h6 style="padding: 0 10px 0 10px;">
              Color Settings
            </h6>
          </div>
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne2" data-parent="#accordionExampleOne">
            <div class="card-body bg-white text-dark" style="padding: 3px !important;">
              <div class="accordion" id="accordionExampleOne">
                <div class="card" style="margin-bottom: 0 !important;">
                  <div class="card-header" id="headingOne2" style="padding: 0 !important; border: none !important; border-radius: 0 !important; cursor: pointer;" data-toggle="collapse" data-target="#collapseOneOne" aria-expanded="true" aria-controls="collapseOneOne">
                    <h6 style="padding: 0 10px 0 10px;">Header Color</h6>
                  </div>

                  <div id="collapseOneOne" class="collapse" aria-labelledby="headingOne2" data-parent="#accordionExampleOne">
                    <div class="card-body" style="padding: 5px !important;">
                      <div class="form-group">
                        <label for="header_bg_color" class="publisher-label">Background Color</label>
                        <div class="publisher row">
                          <div class="publisher-input col-md-8">
                            <input id="header_bg_color" type="text" class="form-control colorpicker-element" data-toggle="colorpicker" value="#9474a9" data-colorpicker-id="1" data-original-title="" title="Pick Color">
                          </div>
                          <div class="publisher-actions col-md-3">
                            <button type="button" class="btn btn-sm btn-primary" onclick="saveThemeSetting(<?php echo $_SESSION['user_id']; ?>, 'header', 'background-color', 'header_bg_color')">Save</button>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="header_txt_Color" class="publisher-label">Text Color</label>
                        <div class="publisher">
                          <div class="publisher-input">
                            <input id="header_txt_Color" type="text" class="form-control colorpicker-element" data-toggle="colorpicker" value="#9474a9" data-colorpicker-id="1" data-original-title="" title="Pick Color">
                          </div>
                          <div class="publisher-actions">
                            <button type="button" class="btn btn-sm btn-primary" onclick="saveThemeSetting(<?php echo $_SESSION['user_id']; ?>, 'header', 'color', 'header_txt_Color')">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card" style="margin-bottom: 0 !important;">
                  <div class="card-header" id="headingTwo" style="padding: 0 !important; border: none !important; border-radius: 0 !important; cursor: pointer;" data-toggle="collapse" data-target="#collapseOneTwo" aria-expanded="true" aria-controls="collapseOneTwo">
                    <h6 style="padding: 0 10px 0 10px;">Grid Color Setting</h6>
                  </div>
                  <div id="collapseOneTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExampleOne">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="grid_bg_color" class="publisher-label">Background Color</label>
                        <div class="publisher row">
                          <div class="publisher-input col-md-8">
                            <input id="grid_bg_color" type="text" class="form-control colorpicker-element" data-toggle="colorpicker" value="#9474a9" data-colorpicker-id="1" data-original-title="" title="Pick Color">
                          </div>
                          <div class="publisher-actions col-md-3">
                            <button type="button" class="btn btn-sm btn-primary" onclick="saveThemeSetting(<?php echo $_SESSION['user_id']; ?>, 'grid', 'background-color', 'grid_bg_color')">Save</button>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="grid_txt_color" class="publisher-label">Text Color</label>
                        <div class="publisher row">
                          <div class="publisher-input col-md-8">
                            <input id="grid_txt_color" type="text" class="form-control colorpicker-element" data-toggle="colorpicker" value="#9474a9" data-colorpicker-id="1" data-original-title="" title="Pick Color">
                          </div>
                          <div class="publisher-actions col-md-3">
                            <button type="button" class="btn btn-sm btn-primary" onclick="saveThemeSetting(<?php echo $_SESSION['user_id']; ?>, 'grid', 'color', 'grid_txt_color')">Save</button>
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
        <div class="card" style="margin-bottom: 0 !important;">
          <div class="card-header app-header-dark text-white" style="padding: 0 !important; border: none !important; border-radius: 0 !important; cursor: pointer;" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <h6 style="padding: 0 10px 0 10px;">
              View Settings
            </h6>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body text-dark" style="padding: 3px !important;">
              <div class="form-group">
                <label class="d-block">Sidebar Show</label>
                <div class="custom-control custom-control-inline custom-radio">
                  <input type="radio" class="custom-control-input" name="sidebarShow" id="rd1" value="on"> <label class="custom-control-label" for="rd1">Yes.</label>
                </div>
                <div class="custom-control custom-control-inline custom-radio">
                  <input type="radio" class="custom-control-input" name="sidebarShow" id="rd2" value="off"> <label class="custom-control-label" for="rd2">No.</label>
                </div>
              </div>
              <button type="button" class="btn btn-sm btn-primary" onclick="saveThemeSettingRadio(<?php echo $_SESSION['user_id']; ?>, 'sidebar', 'show', 'sidebarShow')">Save</button>
            </div>
          </div>
        </div>
        <div class="card" style="margin-bottom: 0 !important;">
          <div class="card-header app-header-dark text-white" style="padding: 0 !important; border: none !important; border-radius: 0 !important; cursor: pointer;" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <h6 style="padding: 0 10px 0 10px;">
              Dashboard Settings
            </h6>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body bg-white text-dark" style="padding: 3px !important;">
              Ad vegan excepteur butcher vice lomo
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .rsideclass{
    background-color: #5c048f;
    color: #FFF;
  }
  .rsideclass:hover{
    background-color: #454047;
    color: #FFF;
  }
  .MyClass {
    opacity: 0;
    display:none;
    transition: opacity 0.5s linear;
    -webkit-transition: opacity 0.5s linear;
    -moz-transition: opacity 0.5s linear;
    -o-transition: opacity 0.5s linear;
    -ms-transition: opacity 0.5s linear;
  }
</style>
<script>
  loadRadioAction()
  function loadRadioAction(){
    var sidebarValue = "<?php echo theme_options_sidebar( $_SESSION['user_id'], "sidebar" ); ?>";
    switch (sidebarValue) {
      case "on": 
        $("#rd1").attr('checked', true);
        break;

      case "off":
        $("#rd2").attr('checked', true);
        break;

      default:
        $("#rd1").attr('checked', true);
        break;
    }
  }
  function GetThisHidden(){
    $(".MyClass").css("opacity", "0").on('transitionend webkitTransitionEnd oTransitionEnd otransitionend', HideTheElementAfterAnimation);
  }

  function GetThisDisplayed(){
    $(".MyClass").css("display", "block").css("opacity", "1").unbind("transitionend webkitTransitionEnd oTransitionEnd otransitionend");
  }

  function HideTheElementAfterAnimation(){
    $(".MyClass").css("display", "none");
  }

  function saveThemeSetting(user_id, target, property, value){
    var value=$("#"+value).val();
    $.ajax({
      url   : "<?php echo url('theme_settings/headersave'); ?>",
      method: "POST",
      data  : {user_id:user_id, target:target, property:property, value:value},
      success:function(data){
        if (data == 'SUCCESS') {
          window.location.href = "<?php echo url('dashboard'); ?>";
        }else{
          console.log(data);
        }
      }
    })
  }

  function saveThemeSettingRadio(user_id, target, property, value){
    var value=$("input[name='"+value+"']:checked").val();
    $.ajax({
      url   : "<?php echo url('theme_settings/headersave'); ?>",
      method: "POST",
      data  : {user_id:user_id, target:target, property:property, value:value},
      success:function(data){
        if (data == 'SUCCESS') {
          window.location.href = "<?php echo url('dashboard'); ?>";
        }else{
          console.log(data);
        }
      }
    })
  }
</script>