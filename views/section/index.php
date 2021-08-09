<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['SECTION']; ?></span>
              		<a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#section">
              			<i class="material-icons">control_point</i> <b>Create New</b>
              		</a>
              	</div>
                <div class="body">
                  <table class="table export-datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['OFFICE']; ?></th>
                        <th scope="col"><?php echo $_SESSION['SECTION']; ?></th>
                        <th scope="col" class="hideonprint"><?php echo $_SESSION['STATUS']; ?></th>
                        <th scope="col" class="hideonprint"><?php echo $_SESSION['ACTION']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['section_status']==1) {
                          $status = '<span class="btn bg-green waves-effect"> Active </span>';
                        }else{
                          $status = '<span class="btn bg-orange waves-effect"> Inactive </span>';
                        }
                        $office = $_SESSION['LANGUAGE_SETTED']=='en'?$head['office_en']:$head['office_bn'];
                        $section = $_SESSION['LANGUAGE_SETTED']=='en'?$head['section_en']:$head['section_bn'];
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $office; ?></td>
                        <td><?php echo $section; ?></td>
                        <td class="hideonprint"><?php echo $status; ?></td>
                      	<td class="hideonprint">
                          <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_section_<?php echo $head['section_id']; ?>">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="#" data-toggle="modal" title="Status Change" data-target="#Status_section_<?php echo $head['section_id']; ?>">
                            <i class="material-icons">cached</i>
                          </a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_section_<?php echo $head['section_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('section/update/'.$head['section_id']); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_'.$head['section_id']]=md5(rand()); ?>
        <input type="hidden" name="csrf_token_<?php echo $head['section_id']; ?>" value="<?php echo $_SESSION['csrf_token_'.$head['section_id']]; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="section_office_<?php echo $head['section_id']; ?>"><?php echo $_SESSION['OFFICE']; ?> <span class="text-danger">*</span></label>
            <div class="form-line">
              <select class="form-control" id="section_office_<?php echo $head['section_id']; ?>" name="section_office_<?php echo $head['section_id']; ?>" required>
                <option value="">- Select -</option>
              <?php foreach($data2 as $office2){ ?>
                <option value="<?php echo $office2['office_id']; ?>" <?php echo $head['section_office']==$office2['office_id']?'selected':''; ?>>
                  <?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$office2['office_en']:$office2['office_bn']; ?>
                </option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="section_en_<?php echo $head['section_id']; ?>">Section Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="section_en_<?php echo $head['section_id']; ?>" name="section_en_<?php echo $head['section_id']; ?>" class="form-control" value="<?php echo $head['section_en']; ?>" required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="section_bn_<?php echo $head['section_id']; ?>">অফিস এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="section_bn_<?php echo $head['section_id']; ?>" name="section_bn_<?php echo $head['section_id']; ?>" class="form-control" value="<?php echo $head['section_bn']; ?>" required>
                </div>
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
<div class="modal fade" id="Status_section_<?php echo $head['section_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">CHANGE STATUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('section/update_status/'.$head['section_id']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_status_<?php echo $head['section_id']; ?>" value="<?php echo $head['section_status']; ?>">
        <div class="modal-body mt-2">
          <?php
            if ($head['section_status']==1) {
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
<div class="modal fade" id="section" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('section/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token_section']=md5(rand()); ?>
        <input type="hidden" name="csrf_token_section" value="<?php echo $_SESSION['csrf_token_section']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="section_office"><?php echo $_SESSION['OFFICE']; ?> <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                  <select class="form-control" name="section_office" id="section_office">
                    <option value="">- Select -</option>
                  <?php foreach($data2 as $office): ?>
                    <option value="<?php echo $office['office_id']; ?>"><?php echo $_SESSION['LANGUAGE_SETTED']=='en'?$office['office_en']:$office['office_bn']; ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="section_en">Section Name <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="section_en" name="section_en" class="form-control" placeholder="Section Name..." required>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="section_bn">দপ্তর এর নাম <span class="text-danger">*</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="section_bn" name="section_bn" class="form-control" placeholder="দপ্তর এর নাম ..." required>
                </div>
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