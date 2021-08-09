<?php
//section Models
class section_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_section']==$_SESSION['csrf_token_section']) {
			$section_office = $_POST['section_office'];
			$section_en = $_POST['section_en'];
			$section_bn = $_POST['section_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(section_office,section_en,section_bn) VALUES ($section_office,'$section_en','$section_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_section']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_section']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$section_office = $_POST['section_office_'.$id];
			$section_en = $_POST['section_en_'.$id];
			$section_bn = $_POST['section_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET section_office=$section_office, section_en='$section_en', section_bn='$section_bn' WHERE section_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$section_status = $_POST['section_status_'.$id];
		if ($section_status == 1) {
			$section_status = 0;
		}else{
			$section_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET section_status=$section_status WHERE section_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}