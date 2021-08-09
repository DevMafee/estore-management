<?php
//department Models
class department_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$department_en = $_POST['department_en'];
		$department_bn = $_POST['department_bn'];
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(department_en, department_bn) VALUES ('$department_en', '$department_bn')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($id, $table)
	{
		$department_id = $_POST['department_id_'.$id];
		$department_en = $_POST['department_en_'.$id];
		$department_bn = $_POST['department_bn_'.$id];

		$stmt = $this->db->prepare("UPDATE `$table` SET department_en='$department_en', department_bn='$department_bn' WHERE department_id=$department_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update_status($id, $table)
	{
		$department_status = $_POST['department_status_'.$id];

		if ($department_status == 1) {
			$department_status = 0;
		}else{
			$department_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET department_status=$department_status WHERE department_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}