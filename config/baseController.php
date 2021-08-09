<?php
class BaseController
{
	
	function __construct()
	{
		$this->view = new View();
	}
	public function loadModel($name=null){
		$file = 'models/'.$name.'_model.php';
		if (file_exists($file)) {
			require 'models/'.$name.'_model.php';
			$modelName = $name.'_Model';
			$this->model = new $modelName();
		}
		require 'models/base_model.php';
		$this->base_model = new Base_model();
	}

	public function redirect($where){
		header('location: '.$where);
	}

	public function in_out($id, $compare, $output, $table)
	{
		$stmnt = $this->db->prepare("SELECT `'$output'` FROM `'$table'` WHERE `'$compare'`='$id'");
		$stmt->execute();
		$data = $stmt->fetchAll();
		$data = json_encode($data);
		$data = json_decode($data);
		foreach ($data as $value) {
			return $value->$output;
		}
	}

	public function createTable($table){
		$tbl_create = "CREATE TABLE IF NOT EXISTS `$table` (
		  `$table"."_id` int(11) NOT NULL AUTO_INCREMENT,
		  `$table"."_status` int(2) NOT NULL DEFAULT 1,
		  `$table"."_date` datetime NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`$table"."_id`)
		)";
		$stmt = $this->model->create($tbl_create);
		if ($stmt === 'SUCCESS') {
			return 'SUCCESS';
		} else {
			return 'FAILED'; 
		}
	}

	public function createController($table, $model_name){
		$file = fopen("controllers/".$table.".php", "w") or die("Unable to open file!");
		$content = "<?php
//".$table." Controller
class ".$table." extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check(\$_SESSION['user_type'], '".$model_name."');
	}
	
	public function index()
	{
		\$data = \$this->model->fetch('".$model_name."');
		\$this->view->admin('".$model_name."/index', \$data);
	}

	public function all()
	{
		\$data = \$this->model->fetch('".$model_name."');
		\$this->view->admin('".$model_name."/index', \$data);
	}
	
	public function save()
	{
		\$data = \$this->model->save('".$model_name."');
		if ( \$data == 'SUCCESS' ) {
			\$this->redirect('all');
		}else{
			\$this->redirect('all');
		}
	}
	
	public function update(){
		\$data = \$this->model->update('".$model_name."');

		if ( \$data == 'SUCCESS' ) {
			\$this->redirect('all');
		}else{
			\$this->redirect('all');
		}
	}

}";
		fwrite($file, $content);
		fclose($file);
		$file_location = "controllers/".$table.".php";

		if (file_exists($file_location)) {
			return 'SUCCESS';
		} else {
			return 'FAILED'; 
		}
	}

	public function createModel($table,$model_name){
		$file = fopen("models/".$model_name."_model.php", "w") or die("Unable to open file!");
		$content = "<?php
//".$table." Models
class ".$table."_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save(\$table)
	{
		//Fields_name_of_Carrying_fields

		//For_Image_Files
		
		\$stmt = \$this->db->prepare(\"INSERT INTO `\$table`() VALUES ()\");
		if ( \$stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}";
		fwrite($file, $content);
		fclose($file);
		$file_location = "controllers/".$model_name.".php";

		if (file_exists($file_location)) {
			return 'SUCCESS';
		} else {
			return 'FAILED'; 
		}
	}

	public function createView($view_folder){
		$folder = mkdir("views/".$view_folder) or die("Unable to Create Folder!");

		$file = fopen("views/".$view_folder."/index.php", "w") or die("Unable to open file!");
		$content = '<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2">'.$view_folder.' <span class="text-danger">Please Change This Title !</span></span>
              		<a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#'.$view_folder.'">
              			<i class="material-icons">control_point</i> <b>Create New</b>
              		</a>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head[\''.$view_folder.'_status\']; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_'.$view_folder.'"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_'.$view_folder.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url(\''.$view_folder.'/update\'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION[\'csrf_token\']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION[\'csrf_token\']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="'.$view_folder.'_title">'.$view_folder.' <span class="text-danger">Please Change This Title !</span></label>
            <input type="text" class="form-control" id="'.$view_folder.'_title" name="'.$view_folder.'_title" placeholder="..........." required>
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
<div class="modal fade" id="'.$view_folder.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url(\''.$view_folder.'/save\'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION[\'csrf_token\']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION[\'csrf_token\']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="'.$view_folder.'_name">'.$view_folder.' <span class="text-danger">Please Change This Title !</span></label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="'.$view_folder.'_name" name="'.$view_folder.'_name" class="form-control" placeholder="'.$view_folder.'..." required>
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
</div>';
		fwrite($file, $content);
		fclose($file);
		$file_location = "views/".$view_folder."/index.php";
		if ( file_exists($file_location) ) {
			return 'SUCCESS';
		} else {
			return 'FAILED'; 
		}
	}

}