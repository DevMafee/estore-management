<?php
//product Models
class product_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if (isset($_POST['csrf_token_product']) && $_POST['csrf_token_product']==$_SESSION['csrf_token_product']) {
			$product_name_en = $_POST['product_name_en'];
			$product_name_bn = $_POST['product_name_bn'];
			$product_category = $_POST['product_category'];
			$product_unit = $_POST['product_unit'];
			$product_stock_limit = $_POST['product_stock_limit'];

			$stmt = $this->db->prepare("INSERT INTO `$table`(product_category,product_unit,product_name_en,product_name_bn,product_stock_limit) VALUES ($product_category,$product_unit,'$product_name_en','$product_name_bn',$product_stock_limit)");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_product']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_product']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$product_name_en = $_POST['product_name_en_'.$id];
			$product_name_bn = $_POST['product_name_bn_'.$id];
			$product_category = $_POST['product_category_'.$id];
			$product_unit = $_POST['product_unit_'.$id];
			$product_stock_limit = $_POST['product_stock_limit_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET product_category=$product_category, product_unit=$product_unit, product_name_en='$product_name_en', product_name_bn='$product_name_bn', product_stock_limit=$product_stock_limit WHERE product_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}else{
			return 'FAILED2';
		}
	}


	public function update_status($id, $table)
	{
		$product_status = $_POST['product_status_'.$id];
		if ($product_status == 1) {
			$product_status = 0;
		}else{
			$product_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET product_status=$product_status WHERE product_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}