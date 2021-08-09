<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <span class="h4">Sub Menu</span>
            <a href="#" class="btn bg-green mt-2 mr-2 text-success" style="float: right;" data-toggle="modal" data-target="#SubMenu">
              Create New
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sub Menu Title</th>
                  <th scope="col">Parent Menu</th>
                  <th scope="col">Sub Menu Icon</th>
                  <th scope="col">Sub Menu Link</th>
                  <th scope="col">Rank</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                foreach($data as $menu){
                  $button = '<a href="#" data-toggle="modal" data-target="#EditMainMenu'.$menu['sub_menu_id'].'"><i class="material-icons bg-grey text-warning">edit</i></a>';
                  $icon = '<i class="material-icons">'.$menu['sub_menu_icon'].'</i>';
                  if ($menu['sub_menu_status'] == 1) {
                    $status = '<i class="badge bg-green">Active</i>';
                  }else{
                    $status = '<i class="badge bg-orange">Inactive</i>';
                  }
                  
              ?>
                <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $menu['sub_menu_name']; ?></td>
                  <td><?php echo $menu['sub_menu_parent']; ?></td>
                  <td><?php echo $icon; ?></td>
                  <td><?php echo $menu['sub_menu_link']; ?></td>
                  <td><?php echo $menu['sub_menu_rank']; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $button; ?></td>
                </tr>
<div class="modal fade" id="EditMainMenu<?php echo $menu['sub_menu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit Sub Menu Item ( <?php echo $menu['sub_menu_name']; ?> )</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('sub_menu/update'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="sub_menu_main"> Menu Parent <span class="text-danger">*</span></label>
            <select class="form-control" id="sub_menu_main" name="sub_menu_main" required>
              <option value="<?php echo $menu['sub_menu_main']; ?>"> - <?php echo $menu['sub_menu_parent']; ?> - </option>
            <?php foreach($data2 as $main_menu){?>
              <option value="<?php echo $main_menu['main_menu_id']; ?>"><?php echo $main_menu['main_menu_name']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="sub_menu_name"> Menu Name <span class="text-danger">*</span></label>
            <input type="hidden" class="form-control" id="sub_menu_id" name="sub_menu_id" value="<?php echo $menu['sub_menu_id']; ?>" required>
            <input type="text" class="form-control" id="sub_menu_name" name="sub_menu_name" value="<?php echo $menu['sub_menu_name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="sub_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="sub_menu_icon" name="sub_menu_icon" value="<?php echo $menu['sub_menu_icon']; ?>" required>
          </div>
          <div class="form-group">
            <label for="sub_menu_link"> Menu Link </label>
            <input type="text" class="form-control" id="sub_menu_link" name="sub_menu_link" value="<?php echo $menu['sub_menu_link']; ?>">
          </div>
          <div class="form-group">
            <label for="sub_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="sub_menu_rank" name="sub_menu_rank" value="<?php echo $menu['sub_menu_rank']; ?>" required>
          </div>
          <div class="form-group">
            <label for="sub_menu_status"> Menu Status <span class="text-danger">*</span></label>
            <select class="form-control" id="sub_menu_status" name="sub_menu_status" required>
              <option value="<?php echo $menu['sub_menu_status']; ?>"> - Select - </option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
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
<div class="modal fade" id="SubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create Sub Menu Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('sub_menu/save'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <select class="form-control" id="sub_menu_main" name="sub_menu_main" required>
              <option value=""> - Please Select One - </option>
            <?php foreach($data2 as $main_menu){?>
              <option value="<?php echo $main_menu['main_menu_id']; ?>"><?php echo $main_menu['main_menu_name']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="sub_menu_name" name="sub_menu_name" placeholder="Sub Menu Name..." required>
          </div>
          <div class="form-group">
            <label for="sub_menu_icon"> Sub Menu Icon <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="sub_menu_icon" name="sub_menu_icon" placeholder="fa fa-user" required>
          </div>
          <div class="form-group">
            <label for="sub_menu_link"> Sub Menu Link </label>
            <input type="text" class="form-control" id="sub_menu_link" name="sub_menu_link" placeholder="controller/method">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="sub_menu_rank" name="sub_menu_rank" placeholder=" Sub Menu Rank ... .." required>
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