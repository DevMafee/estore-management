<?php
//emp_class Models
class emp_class_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_emp_class']==$_SESSION['csrf_token_emp_class']) {
			$emp_class_en = $_POST['emp_class_en'];
			$emp_class_bn = $_POST['emp_class_bn'];
			$emp_class_rank = $_POST['emp_class_rank'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(emp_class_en,emp_class_bn,emp_class_rank) VALUES ('$emp_class_en','$emp_class_bn',$emp_class_rank)");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_emp_class']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_emp_class']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$emp_class_en = $_POST['emp_class_en_'.$id];
			$emp_class_bn = $_POST['emp_class_bn_'.$id];
			$emp_class_rank = $_POST['emp_class_rank_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET emp_class_en='$emp_class_en', emp_class_bn='$emp_class_bn', emp_class_rank='$emp_class_rank' WHERE emp_class_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$emp_class_status = $_POST['emp_class_status_'.$id];
		if ($emp_class_status == 1) {
			$emp_class_status = 0;
		}else{
			$emp_class_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET emp_class_status=$emp_class_status WHERE emp_class_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}