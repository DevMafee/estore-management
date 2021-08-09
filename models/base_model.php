<?php
//BaseModel Model
class Base_model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function languages_load(){
		$lang = $_POST['lang']??'bn';
		if ($lang == null) {
			$lang = 'bn';
		}else{
			$lang = $lang;
		}

		if ($lang != '') {
			Session::set("LANGUAGE_SETTED", "$lang");
			$stmt = $this->db->prepare("SELECT * FROM languages WHERE languages_status=1 AND languages_type='$lang'");
			$stmt->execute();
			$data = $stmt->fetchAll();
			foreach ($data as $ln) {
				$lan_code = $ln['languages_code'];
				$lan_text = $ln['languages_text'];
				Session::set("$lan_code", "$lan_text");
			}
		}else{
			Session::set("LANGUAGE_SETTED", "en");
			$stmt = $this->db->prepare("SELECT * FROM languages WHERE languages_status=1 AND languages_type='en'");
			$stmt->execute();
			$data = $stmt->fetchAll();
			foreach ($data as $ln) {
				$lan_code = $ln['languages_code'];
				$lan_text = $ln['languages_text'];
				Session::set("$lan_code", "$lan_text");
			}
		}
	}
	
	public function full_query($product){
	    $stmt = $this->db->prepare("INSERT INTO `store_receive_details` (`store_receive_details_rcv_id`, `store_receive_details_section`, `store_receive_details_product_id`, `store_receive_details_quantity`) VALUES (1, 2, $product, 10)");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function in_out($value=null, $compare=null, $target=null, $table=null)
	{
		$stmt = $this->db->prepare("SELECT ".$target." FROM ".$table." WHERE ".$compare."=".$value);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function in_out_result($value=null, $compare=null, $target=null, $table=null)
	{
		$stmt = $this->db->prepare("SELECT ".$target." FROM ".$table." WHERE ".$compare."=".$value);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $value) {
			$value = $value[$target];
		}
		return $value;
	}

	public function query_out($where=null, $targets=null, $tables=null)
	{
		$stmt = $this->db->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	public function save($tables=null)
	{
		$stmt_fields = $this->db->prepare("SELECT * FROM form_fields WHERE field_table='$tables' AND field_status='Active'");
		$stmt_fields->execute();
		$fields = $stmt_fields->fetchAll();
		$insert_query = '';
		foreach($fields as $field):
			$field_name = $field['field_name'];
			$insert_query .= "`$field_name`='$_POST[$field_name]',";
		endforeach;

		$insert_query = substr($insert_query, 0,-1);
		$stmt = $this->db->prepare("INSERT INTO $tables SET $insert_query");
		if ($stmt->execute()) {
			return "SUCCESS";
		}else{
			return "FAILED";
		}
	}

}