<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <span class="h4">Main Menu</span>
            <a href="#" class="btn mt-2 mr-2 text-success bg-green" style="float: right;" data-toggle="modal" data-target="#MainMenu">Create New</a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Menu Title</th>
                  <th scope="col">Menu Icon</th>
                  <th scope="col">Menu Link</th>
                  <th scope="col">Rank</th>
                  <th scope="col" style="max-width: 100px !important;">Accessed By</th>
                  <th scope="col">Menu Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                foreach($data as $menu){
                  $button='<a href="#" data-toggle="modal" data-target="#EditMainMenu'.$menu['main_menu_id'].'"><i class="material-icons bg-grey text-warning">edit</i></a>';
                  $icon = '<i class="material-icons">'.$menu['main_menu_icon'].'</i>';
                  if ($menu['main_menu_status'] == 1) {
                    $status = '<i class="badge bg-green">Active</i>';
                  }else{
                    $status = '<i class="badge bg-orange">Inactive</i>';
                  }

                  if ($menu['main_menu_has_access'] != '') {
                    $users = explode(',', $menu['main_menu_has_access']);
                  }                        
              ?>
                <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $menu['main_menu_name']; ?></td>
                  <td><?php echo $icon; ?></td>
                  <td><?php echo $menu['main_menu_link']; ?></td>
                  <td><?php echo $menu['main_menu_rank']; ?></td>
                  <td><?php $j = 0; foreach($users as $user){ $j++; echo '<i class="badge bg-amber">'.$user.'</i>&nbsp;'; echo $j%3==0?'<br>':''; } ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $button; ?></td>
                </tr>
<div class="modal fade" id="EditMainMenu<?php echo $menu['main_menu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit Main Menu Item ( <?php echo $menu['main_menu_name']; ?> )</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('main_menu/update/'.$menu['main_menu_id']); ?>" method="post">
        <?php $_SESSION['csrf_token'.$menu['main_menu_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $_SESSION['csrf_token'.$menu['main_menu_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_name_<?php echo $menu['main_menu_id']; ?>"> Menu Name <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" id="main_menu_id_<?php echo $menu['main_menu_id']; ?>" name="main_menu_id_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $menu['main_menu_id']; ?>" required>
                <input type="text" class="form-control" id="main_menu_name_<?php echo $menu['main_menu_id']; ?>" name="main_menu_name_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $menu['main_menu_name']; ?>" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_icon_<?php echo $menu['main_menu_id']; ?>"> Menu Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_icon_<?php echo $menu['main_menu_id']; ?>" name="main_menu_icon_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $menu['main_menu_icon']; ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_link_<?php echo $menu['main_menu_id']; ?>"> Menu Link </label>
                <input type="text" class="form-control" id="main_menu_link_<?php echo $menu['main_menu_id']; ?>" name="main_menu_link_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $menu['main_menu_link']; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_rank_<?php echo $menu['main_menu_id']; ?>"> Menu Rank <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="main_menu_rank_<?php echo $menu['main_menu_id']; ?>" name="main_menu_rank_<?php echo $menu['main_menu_id']; ?>" value="<?php echo $menu['main_menu_rank']; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="main_menu_has_access_<?php echo $menu['main_menu_id']; ?>"> Menu Access (Click to Select Multiple User) <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="main_menu_has_access_<?php echo $menu['main_menu_id']; ?>" name="main_menu_has_access_<?php echo $menu['main_menu_id']; ?>[]" multiple="multiple" style="min-height: 100px;">
          <?php
            foreach($data2 as $user_ty){
              $selected='';
              $acc = explode(',', $menu['main_menu_has_access']);
              $username = $user_ty['user_type_id'];
              if (in_array($username, $acc)) {
                $selected = 'selected=""';
              }
          ?>
              <option value="<?php echo $user_ty['user_type_id']; ?>" <?php echo $selected; ?>><?php echo $user_ty['user_type_name']; ?></option>
          <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="main_menu_status_<?php echo $menu['main_menu_id']; ?>"> Menu Status <span class="text-danger">*</span></label>
            <select class="form-control" id="main_menu_status_<?php echo $menu['main_menu_id']; ?>" name="main_menu_status_<?php echo $menu['main_menu_id']; ?>" required>
              <option value="1" <?php echo $menu['main_menu_status']==1?'selected':''; ?>>Active</option>
              <option value="0" <?php echo $menu['main_menu_status']==0?'selected':''; ?>>Inactive</option>
            </select>
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
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Insertion Modal -->
<div class="modal fade" id="MainMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New Main Menu Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('main_menu/save'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_name"> Menu Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_name" name="main_menu_name" placeholder="Menu Name..." required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_icon" name="main_menu_icon" placeholder="fa fa-user" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_link"> Menu Link </label>
                <input type="text" class="form-control" id="main_menu_link" name="main_menu_link" placeholder="controller/method">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="main_menu_rank" name="main_menu_rank" placeholder="1 ... .." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="main_menu_has_access"> Menu Access (Press & Hold CRTL Button to Select Multiple User) <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="main_menu_has_access" name="main_menu_has_access[]" multiple style="min-height: 100px;">
          <?php foreach($data2 as $user_type): ?>
              <option value="<?php echo $user_type['user_type_id']; ?>"><?php echo $user_type['user_type_name']; ?></option>
          <?php endforeach; ?>
            </select>
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