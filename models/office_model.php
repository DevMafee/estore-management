<?php
//office Models
class office_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$office_department = $_POST['office_department'];
		$office_en = $_POST['office_en'];
		$office_bn = $_POST['office_bn'];
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(office_department,office_en,office_bn) VALUES ($office_department,'$office_en','$office_bn')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			// print_r($_POST);print_r($id);die;
			$office_department = $_POST['office_department_'.$id];
			$office_id = $_POST['office_id_'.$id];
			$office_en = $_POST['office_en_'.$id];
			$office_bn = $_POST['office_bn_'.$id];
			$stmt = $this->db->prepare("UPDATE `$table` SET office_department=$office_department, office_en='$office_en', office_bn='$office_bn' WHERE office_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$office_status = $_POST['office_status_'.$id];

		if ($office_status == 1) {
			$office_status = 0;
		}else{
			$office_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET office_status=$office_status WHERE office_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}