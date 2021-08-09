<?php
//employee_grade Models
class employee_grade_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_employee_grade']==$_SESSION['csrf_token_employee_grade']) {
			$employee_grade_en = $_POST['employee_grade_en'];
			$employee_grade_bn = $_POST['employee_grade_bn'];
			$employee_grade_rank = $_POST['employee_grade_rank'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(employee_grade_en,employee_grade_bn,employee_grade_rank) VALUES ('$employee_grade_en','$employee_grade_bn',$employee_grade_rank)");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_employee_grade']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_employee_grade']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$employee_grade_en = $_POST['employee_grade_en_'.$id];
			$employee_grade_bn = $_POST['employee_grade_bn_'.$id];
			$employee_grade_rank = $_POST['employee_grade_rank_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET employee_grade_en='$employee_grade_en', employee_grade_bn='$employee_grade_bn', employee_grade_rank='$employee_grade_rank' WHERE employee_grade_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$employee_grade_status = $_POST['employee_grade_status_'.$id];
		if ($employee_grade_status == 1) {
			$employee_grade_status = 0;
		}else{
			$employee_grade_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET employee_grade_status=$employee_grade_status WHERE employee_grade_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}