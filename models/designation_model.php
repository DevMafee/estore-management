<?php
//designation Models
class designation_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_designation']==$_SESSION['csrf_token_designation']) {
			$designation_en = $_POST['designation_en'];
			$designation_bn = $_POST['designation_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(designation_en,designation_bn) VALUES ('$designation_en','$designation_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_designation']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_designation']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$designation_en = $_POST['designation_en_'.$id];
			$designation_bn = $_POST['designation_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET designation_en='$designation_en', designation_bn='$designation_bn' WHERE designation_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$designation_status = $_POST['designation_status_'.$id];
		if ($designation_status == 1) {
			$designation_status = 0;
		}else{
			$designation_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET designation_status=$designation_status WHERE designation_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}