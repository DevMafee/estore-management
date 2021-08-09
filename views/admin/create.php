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
              <span class="h4">Create New</span>
              <a href="<?php echo url($form_action.'/all'); ?>" class="btn btn-default mt-2 mr-2 text-success" style="float: right;">View All</a>
            </div>
            <div class="card-body">
              <form action="<?php echo url($form_action.'/save'); ?>" method="post" enctype="multipart/form-data">
                <?php $_SESSION['csrf_token_form_builder']=md5(rand()); ?>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token_form_builder']; ?>">
<?php
	foreach($data as $dt):
		$field_type = $dt['field_type'];
		$field_label = $dt['field_label'];
		$field_name = $dt['field_name'];
		$field_required = $dt['field_required'];
		$field_style = $dt['field_style'];

		if ($field_required == 'YES') {
			$required = 'required';
		}else{
			$required = '';
		}

		if($field_type == 'TEXT'):
?>
				<div class="row mb-2">
                	<label for="<?php echo $field_name; ?>" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6"><?php echo $field_label; ?><?php echo $required==''?'':'<span class="text-danger"> *</span>'; ?></label>
                	<input type="text" class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-6 form-control" <?php echo $field_style; ?> id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" placeholder="<?php echo $field_label; ?> .." <?php echo $required; ?>>
                	<small id="<?php echo $field_name.'_error'; ?>" class="form-text text-danger"></small>
                </div>
<?php
		elseif($field_type == 'TEXTAREA'):
?>
				<div class="row mb-2">
                	<label for="<?php echo $field_name; ?>" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6"><?php echo $field_label; ?><?php echo $required==''?'':'<span class="text-danger"> *</span>'; ?></label>
                	<textarea type="text" class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-6 form-control" <?php echo $field_style; ?> id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" placeholder="<?php echo $field_label; ?> .." <?php echo $required; ?>></textarea>
                	<small id="<?php echo $field_name.'_error'; ?>" class="form-text text-danger"></small>
                </div>
<?php
		elseif($field_type == 'FILE'):
?>
				<div class="row mb-2">
                	<label for="<?php echo $field_name; ?>" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6"><?php echo $field_label; ?><?php echo $required==''?'':'<span class="text-danger"> *</span>'; ?></label>
                	<input type="file" class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-6 form-control" <?php echo $field_style; ?> id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" placeholder="<?php echo $field_label; ?> .." <?php echo $required; ?>>
                	<small id="<?php echo $field_name.'_error'; ?>" class="form-text text-danger"></small>
                </div>
<?php
		elseif($field_type == 'DROPDOWN'):
?>
				<div class="row mb-2">
                	<label for="<?php echo $field_name; ?>" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6"><?php echo $field_label; ?><?php echo $required==''?'':'<span class="text-danger"> *</span>'; ?></label>
                	<select <?php echo $field_style; ?> id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-6 form-control" <?php echo $required; ?>>
                		<option style="color: #CCC;" value=""> - Select - </option>
                		<option value="1">Active</option>
                		<option value="0">Inactive</option>
                	</select>
                	<small id="<?php echo $field_name.'_error'; ?>" class="form-text text-danger"></small>
                </div>
<?php
		endif;
	endforeach;
?>
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6"></div>
					<div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-6">
						<button type="reset" class="btn btn-warning">Reset</button>
        				<button type="submit" class="btn btn-success">Save changes</button>
					</div>
				</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>