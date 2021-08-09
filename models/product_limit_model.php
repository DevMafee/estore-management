<?php
//product_limit Models
class product_limit_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$product_limit_section = $_POST['product_limit_section'];
		$product_limit_date = $_POST['product_limit_date'];
		$product_limit_product_array = $_POST['product_limit_product'];
		$product_limit_requisition_limit_array = $_POST['product_limit_requisition_limit'];
		$product_limit_status_array = $_POST['product_limit_status'];

		$ff = explode('-',$product_limit_date);
		$product_limit_year = $ff[0];
		$product_limit_month = $ff[1];

		for($k=0; $k<count($product_limit_product_array); $k++){
			$product_limit_product = $product_limit_product_array[$k];
			$product_limit_requisition_limit = $product_limit_requisition_limit_array[$k];
			$product_limit_status = $product_limit_status_array[$k];

			$check = $this->db->prepare("SELECT * FROM $table WHERE product_limit_section=$product_limit_section AND product_limit_product=$product_limit_product");
			$check->execute();
			$data_fetch = $check->fetchAll();
			if (count($data_fetch)>0) {
				$stmt = $this->db->prepare("UPDATE `$table` SET product_limit_requisition_limit=$product_limit_requisition_limit, product_limit_status=$product_limit_status, product_limit_date='$product_limit_date', product_limit_year='$product_limit_year', product_limit_month='$product_limit_month' WHERE product_limit_section=$product_limit_section AND product_limit_product=$product_limit_product");
			}else{
				$stmt = $this->db->prepare("INSERT INTO `$table`(product_limit_year,product_limit_month,product_limit_section,product_limit_date,product_limit_product,product_limit_requisition_limit,product_limit_status) VALUES ('$product_limit_year','$product_limit_month',$product_limit_section,'$product_limit_date',$product_limit_product,$product_limit_requisition_limit,$product_limit_status)");
			}
			if ( $stmt->execute() === TRUE ) {
				$return = 'SUCCESS';
			}else{
				$return = 'FAILED';
			}
		}
		return $return;
	}
	
}