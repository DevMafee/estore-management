<?php
//Main Model
class Model
{
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function fetch($table){
		$stmt = $this->db->prepare("SELECT * FROM `$table` ");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}
	
	public function fetch_json_menu($fields, $table, $username){
		$stmt = $this->db->prepare("SELECT $fields FROM `$table`");
		$stmt->execute();
		$data = $stmt->fetchAll();
		$data_ret = '';
		foreach ($data as $value) {
			$data_id = $value['main_menu_id'];
			$data_access = $value['main_menu_has_access'];

			$data_access = explode(',', $data_access);
			if (in_array($username, $data_access)) {
				$data_ret .= $data_id.'-';
			}
		}
		return $data_ret;
	}
	
	public function fetchAndCount($table){
		$stmt = $this->db->prepare("SELECT * FROM `$table` ");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return count($data);
	}

	public function twotable_json_data($table1, $table2, $relation_t1, $relation_t2, $order_by, $order_type){
		$stmt = $this->db->prepare("SELECT ".$table1.".*, ".$table2.".* FROM ".$table1.", ".$table2." WHERE 
			".$table1.".".$relation_t1."=".$table2.".".$relation_t2." ORDER BY ".$order_by." ".$order_type);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function all($table){
		$stmt = $this->db->prepare("SELECT * FROM `$table` ");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function findProfile($table, $compare, $value){
		$exp = substr($value, -64);
		$value = substr($exp, 32);
		$stmt = $this->db->prepare("SELECT * FROM `$table` WHERE `$compare`='$value'");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function findProfilephoto($table, $compare, $value, $return){
		$exp = substr($value, -64);
		$value = substr($exp, 32);
		$stmt = $this->db->prepare("SELECT `$return` FROM `$table` WHERE `$compare`='$value'");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function validate($value1,$value2,$value3){
		empty_check();
		email_check();
		length_check();
	}

	public function empty_check(){
		
	}

	public function email_check(){
		
	}

	public function length_check(){
		
	}

}