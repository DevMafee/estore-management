<?php
//store_receive Models
class store_receive_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		// print_r($_POST);die;
		if ($_POST['csrf_token_store_rcv']==$_SESSION['csrf_token_store_rcv']) {
			$store_receive_section = $_POST['store_receive_section'];
			$store_receive_indent = $_POST['store_receive_indent'];
			$store_receive_supplier = $_POST['store_receive_supplier'];
			$store_receive_comments = $_POST['store_receive_comments'];
			$store_receive_details_product_id_array = $_POST['store_receive_details_product_id'];
			$store_receive_details_quantity_array = $_POST['store_receive_details_quantity'];

			$stmt = $this->db->prepare("INSERT INTO `$table`(store_receive_section,store_receive_indent,store_receive_supplier,store_receive_comments) VALUES ($store_receive_section,'$store_receive_indent',$store_receive_supplier,'$store_receive_comments')");
			if ( $stmt->execute() === TRUE ) {
				$store_receive_id = $this->db->lastInsertId();

				foreach($store_receive_details_product_id_array as $k => $value){
					$store_receive_details_product_id = $value;
					$store_receive_details_quantity = $store_receive_details_quantity_array[$k];

					$stmt_details = $this->db->prepare("INSERT INTO `store_receive_details`(store_receive_details_rcv_id,store_receive_details_section,store_receive_details_product_id,store_receive_details_quantity) VALUES ($store_receive_id,$store_receive_section,$store_receive_details_product_id,$store_receive_details_quantity)");
					if ($stmt_details->execute()) {
						$stmt_details = $this->db->prepare("SELECT * FROM stocks WHERE stocks_product_id=$store_receive_details_product_id ORDER BY stocks_id DESC LIMIT 0,1");
						$stmt_details->execute();
						$data = $stmt_details->fetchAll();

						if (count($data)>0) {
							$stocks_pre_stock = $data[0]['stocks_current_stock'];
							$stocks_trng_qty_in = $store_receive_details_quantity;
							$stocks_current_stock = $stocks_pre_stock+$stocks_trng_qty_in;
							$stmt_stock = $this->db->prepare("INSERT INTO `stocks`(stocks_product_id,stocks_pre_stock,stocks_trng_qty_in,stocks_current_stock,stocks_trng_type,stocks_section) VALUES ($store_receive_details_product_id,$stocks_pre_stock,$stocks_trng_qty_in,$stocks_current_stock,'IN',$store_receive_section)");
							$stmt_stock->execute();
						}else{
							$stocks_pre_stock = 0;
							$stocks_trng_qty_in = $store_receive_details_quantity;
							$stocks_current_stock = $stocks_pre_stock+$stocks_trng_qty_in;
							$stmt_stock = $this->db->prepare("INSERT INTO `stocks`(stocks_product_id,stocks_pre_stock,stocks_trng_qty_in,stocks_current_stock,stocks_trng_type,stocks_section) VALUES ($store_receive_details_product_id,$stocks_pre_stock,$stocks_trng_qty_in,$stocks_current_stock,'IN',$store_receive_section)");
							$stmt_stock->execute();
						}
						
					}
				}
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_store_rcv']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_store_rcv']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_'.$id]) {
			$store_receive_office = $_POST['store_receive_office_'.$id];
			$store_receive_en = $_POST['store_receive_en_'.$id];
			$store_receive_bn = $_POST['store_receive_bn_'.$id];

			$stmt = $this->db->prepare("UPDATE `$table` SET store_receive_office=$store_receive_office, store_receive_en='$store_receive_en', store_receive_bn='$store_receive_bn' WHERE store_receive_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}
	}


	public function update_status($id, $table)
	{
		$store_receive_status = $_POST['store_receive_status_'.$id];
		if ($store_receive_status == 1) {
			$store_receive_status = 0;
		}else{
			$store_receive_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET store_receive_status=$store_receive_status WHERE store_receive_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}