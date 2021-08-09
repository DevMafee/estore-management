<?php
  foreach($data as $dt){
    $form_action = $dt['field_table'];
  }
?>
<div class="content-wrapper">
  <br class="mb-2">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success">
            <div class="col-12 col-lg-12 col-xl-12 card-header">
              <span class="h4">List View</span>
              <a href="<?php echo url($form_action.'/create'); ?>" class="btn btn-default mt-2 mr-2 text-success" style="float: right;">Create New</a>
            </div>
            <div class="card-body">
              <table class="table datatable table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                  <?php
                    foreach($data as $c):
                      $dc = $c['field_view'];
                      $dcl = $c['field_label'];
                      if($dc == 'Active'):
                  ?>
                    <th scope="col"><?php echo $dcl; ?></th>
                  <?php
                      endif;
                    endforeach;
                  ?>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i = 0;
                  foreach($data2 as $d2):
                    $button = 'btn';
                ?>
                  <tr>
                    <td><?php echo ++$i; ?></td>
                  <?php
                    foreach($data as $d):
                      $dcv = $d['field_view'];
                      $field_name = $d['field_name'];
                      if($dcv == 'Active'):
                        $status = $d2[$field_name];
                        if ($status == 1) {
                          $status = '<label class="badge badge-success">Active</label>';
                        }else{
                          $status = '<label class="badge badge-danger">Inactive</label>';
                        }
                  ?>
                    <td><?php echo $field_name=='status'?$status:$d2["$field_name"]; ?></td>
                  <?php
                      endif;
                    endforeach;
                  ?>
                    <!-- <td><?php //echo $status; ?></td> -->
                    <td><?php echo $button; ?></td>
                  </tr>
                <?php
                  endforeach;
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