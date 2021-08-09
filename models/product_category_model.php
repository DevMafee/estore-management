<?php
//product_category Models
class product_category_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_product_category']==$_SESSION['csrf_token_product_category']) {
			$product_category_en = $_POST['product_category_en'];
			$product_category_bn = $_POST['product_category_bn'];
			
			$stmt = $this->db->prepare("INSERT INTO `$table`(product_category_en,product_category_bn) VALUES ('$product_category_en','$product_category_bn')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_product_category']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_product_category']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$product_category_en = $_POST['product_category_en_'.$id];
			$product_category_bn = $_POST['product_category_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET product_category_en='$product_category_en', product_category_bn='$product_category_bn' WHERE product_category_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$product_category_status = $_POST['product_category_status_'.$id];
		if ($product_category_status == 1) {
			$product_category_status = 0;
		}else{
			$product_category_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET product_category_status=$product_category_status WHERE product_category_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}