<?php
//Modules Model
class Modules_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function saveData(){
		if ($_POST['csrf_token_module']==$_SESSION['csrf_token_module']) {
			if ( $_POST['modules_name'] != '' ) {
				$modules_table= strtolower(str_replace(' ', '_', $_POST['modules_name']));
				$modules_name = $_POST['modules_name'];
				$stmt = $this->db->prepare("INSERT INTO `modules`(`modules_name`,`modules_table`) VALUES ('$modules_name','$modules_table')");
				$stmt->execute();
				$_SESSION['module']= strtolower(str_replace(' ', '_', $_POST['modules_name']));
				$_SESSION['module_model']= $modules_table;
				$_SESSION['modules_success']="Successfully Added!";
				return 'SUCCESS';
			}else{
				$_SESSION['modules_name']="Module Name Can not Empty";
				return 'FAILED';
			}
		}else{
			$_SESSION['modules_name_session']="Session Does not Matched!";
			return 'FAILED';
		}
		
	}

	public function fetchData(){
		$stmt = $this->db->prepare("SELECT * FROM `modules` ORDER BY `modules_id` DESC");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function create($query){
		$stmt = $this->db->prepare($query);
		if ( $stmt->execute() ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function dalete(){
		if ($_POST['modules_status'] == 1) {
			$status = 0;
		}else{
			$status = 1;
		}
		$query = "UPDATE `modules` SET `modules_status`=".$status." WHERE `modules_id`=".$_POST['modules_id'];
		$stmt = $this->db->prepare($query);
		if ( $stmt->execute() ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function access_controll_save(){
		$full_access = 'dashboard';
		$user_type_id = $_POST['user_type_id'];
		$user_type_access = $_POST['user_type_access'];
		foreach ($user_type_access as $access) {
			$full_access .= ','.$access;
		}
		$stmt = $this->db->prepare("UPDATE `user_type` SET `user_type_access` = '$full_access' WHERE `user_type_id` = $user_type_id");
		if ($stmt->execute()) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

}