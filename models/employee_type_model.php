<?php
//employee_type Models
class employee_type_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_employee_type']==$_SESSION['csrf_token_employee_type']) {
			$employee_type_en = $_POST['employee_type_en'];
			$employee_type_bn = $_POST['employee_type_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(employee_type_en,employee_type_bn) VALUES ('$employee_type_en','$employee_type_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_employee_type']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_employee_type']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$employee_type_en = $_POST['employee_type_en_'.$id];
			$employee_type_bn = $_POST['employee_type_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET employee_type_en='$employee_type_en', employee_type_bn='$employee_type_bn' WHERE employee_type_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$employee_type_status = $_POST['employee_type_status_'.$id];
		if ($employee_type_status == 1) {
			$employee_type_status = 0;
		}else{
			$employee_type_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET employee_type_status=$employee_type_status WHERE employee_type_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}