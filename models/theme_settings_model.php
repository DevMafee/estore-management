<?php
//Theme_settings Models
class Theme_settings_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function headersave($table)
	{
		$user_id = $_POST['user_id'];
		$target = $_POST['target'];
		$property = $_POST['property'];
		$value = $_POST['value'];
		
		$stmt = $this->db->prepare("SELECT * FROM `$table` WHERE user_id=$user_id AND target='$target' AND property='$property'");
		$stmt->execute();
		$data = $stmt->fetchAll();
		$count = count( $data );
		if ($count>0) {
			$id = $data[0]['id'];
			$upstmnt = $this->db->prepare("UPDATE $table SET value='$value' WHERE id=$id");
			if ($upstmnt->execute()) {
				return "SUCCESS";
			}else{
				return 'FAILED';
			}
		}else{
			$upstmnt = $this->db->prepare("INSERT INTO $table (`user_id`, `target`, `property`, `value`) VALUES ($user_id, '$target', '$property', '$value')");
			if ($upstmnt->execute()) {
				return "SUCCESS";
			}else{
				return 'FAILED';
			}
		}
	}
	
}