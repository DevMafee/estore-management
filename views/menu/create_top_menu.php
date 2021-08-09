<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card card-success">
          <div class="header">
            <span class="h4">Top Menu</span>
            <a href="#" class="btn bg-green mt-2 mr-2 text-success" style="float: right;" data-toggle="modal" data-target="#topMenu">
              Create New
            </a>
          </div>
          <div class="body">
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Menu Title</th>
                  <th scope="col">Menu Icon</th>
                  <th scope="col">Menu Link</th>
                  <th scope="col">Menu Rank</th>
                  <th scope="col">Menu Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                foreach($data as $menu){
                  $button = '<a href="#" data-toggle="modal" data-target="#EdittopMenu'.$menu['top_menu_id'].'"><i class="material-icons bg-grey text-warning">edit</i></a>';
                  $icon = '<i class="material-icons">'.$menu['top_menu_icon'].'</i>';
                  if ($menu['top_menu_status'] == 1) {
                    $status = '<i class="badge bg-green">Active</i>';
                  }else{
                    $status = '<i class="badge bg-orange">Inactive</i>';
                  }
                  
              ?>
                <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $menu['top_menu_name']; ?></td>
                  <td><?php echo $icon; ?></td>
                  <td><?php echo $menu['top_menu_link']; ?></td>
                  <td><?php echo $menu['top_menu_rank']; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $button; ?></td>
                </tr>
<div class="modal fade" id="EdittopMenu<?php echo $menu['top_menu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit top Menu Item ( <?php echo $menu['top_menu_name']; ?> )</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('top_menu/update'); ?>" method="POST">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="top_menu_name"> Menu Name <span class="text-danger">*</span></label>
            <input type="hidden" class="form-control" id="top_menu_id" name="top_menu_id" value="<?php echo $menu['top_menu_id']; ?>" required>
            <input type="text" class="form-control" id="top_menu_name" name="top_menu_name" value="<?php echo $menu['top_menu_name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="top_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="top_menu_icon" name="top_menu_icon" value="<?php echo $menu['top_menu_icon']; ?>" required>
          </div>
          <div class="form-group">
            <label for="top_menu_link"> Menu Link </label>
            <input type="text" class="form-control" id="top_menu_link" name="top_menu_link" value="<?php echo $menu['top_menu_link']; ?>">
          </div>
          <div class="form-group">
            <label for="top_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="top_menu_rank" name="top_menu_rank" value="<?php echo $menu['top_menu_rank']; ?>" required>
          </div>
          <div class="form-group">
            <label for="top_menu_status"> Menu Status <span class="text-danger">*</span></label>
            <select class="form-control" id="top_menu_status" name="top_menu_status" required>
              <option value="<?php echo $menu['top_menu_status']; ?>"> - Select - </option>
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
</div>

<!-- Insertion Modal -->
<div class="modal fade" id="topMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New top Menu Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('top_menu/save'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="top_menu_name"> Menu Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="top_menu_name" name="top_menu_name" placeholder="Menu Name..." required>
          </div>
          <div class="form-group">
            <label for="top_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="top_menu_icon" name="top_menu_icon" placeholder="fa fa-user" required>
          </div>
          <div class="form-group">
            <label for="top_menu_link"> Menu Link </label>
            <input type="text" class="form-control" id="top_menu_link" name="top_menu_link" placeholder="controller/method">
          </div>
          <div class="form-group">
            <label for="top_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="top_menu_rank" name="top_menu_rank" placeholder="1 ... .." required>
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