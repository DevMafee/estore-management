<?php
//gender Models
class gender_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_gender']==$_SESSION['csrf_token_gender']) {
			$gender_en = $_POST['gender_en'];
			$gender_bn = $_POST['gender_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(gender_en,gender_bn) VALUES ('$gender_en','$gender_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_gender']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_gender']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$gender_en = $_POST['gender_en_'.$id];
			$gender_bn = $_POST['gender_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET gender_en='$gender_en', gender_bn='$gender_bn' WHERE gender_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$gender_status = $_POST['gender_status_'.$id];
		if ($gender_status == 1) {
			$gender_status = 0;
		}else{
			$gender_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET gender_status=$gender_status WHERE gender_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}