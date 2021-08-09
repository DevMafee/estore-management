<?php
//unit Models
class unit_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_unit']==$_SESSION['csrf_token_unit']) {
			$unit_en = $_POST['unit_en'];
			$unit_bn = $_POST['unit_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(unit_en,unit_bn) VALUES ('$unit_en','$unit_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_unit']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_unit']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$unit_en = $_POST['unit_en_'.$id];
			$unit_bn = $_POST['unit_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET unit_en='$unit_en', unit_bn='$unit_bn' WHERE unit_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$unit_status = $_POST['unit_status_'.$id];
		if ($unit_status == 1) {
			$unit_status = 0;
		}else{
			$unit_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET unit_status=$unit_status WHERE unit_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}