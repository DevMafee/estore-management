<?php
//product_ledger Models
class product_ledger_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}

	function load_ledger_report(){
		$csrf = $_POST['csrf_token_search_ledger'];
		if ($csrf == $_SESSION['csrf_token_search_ledger']) {
			$product = $_POST['product'];
			$from_date = $_POST['from_date'];
			$to_date = $_POST['to_date'];
			$ret_data['opening'] = array();
			$ret_data['data'] = array();
			$stmnt_before = $this->db->prepare("SELECT * FROM `stocks` WHERE `stocks_product_id`=$product AND DATE(`stocks_date`)<'$from_date' ORDER BY `stocks_id` DESC LIMIT 0,1");
			$stmnt_before->execute();
			$data_before = $stmnt_before->fetchAll();
			if ( count($data_before) > 0 ) {
				$opening_stock['stock'] = $data_before[0]['stocks_current_stock'];
				$opening_stock['product'] = $product;
				$opening_stock['from_date'] = $from_date;
				$opening_stock['to_date'] = $to_date;
			}else{
				$opening_stock['stock'] = 0;
				$opening_stock['product'] = $product;
				$opening_stock['from_date'] = $from_date;
				$opening_stock['to_date'] = $to_date;
			}
			array_push($ret_data['opening'], $opening_stock);
			$stmnt = $this->db->prepare("SELECT DATE(`stocks_date`) as stocks_date, `stocks_trng_qty_in`, `stocks_trng_qty_out`, `stocks_section` FROM `stocks` WHERE `stocks_product_id`=$product AND DATE(`stocks_date`) BETWEEN '$from_date' AND '$to_date' ORDER BY DATE(`stocks_date`),`stocks_id` ASC");
			$stmnt ->execute();
			$data = $stmnt->fetchAll();
			if (count($data) > 0) {
				for($i=0; $i<count($data); $i++){
					$dat = array();
					$dat['stocks_date'] = $data[$i]['stocks_date'];
					$dat['stocks_trng_qty_in'] = $data[$i]['stocks_trng_qty_in'];
					$dat['stocks_trng_qty_out'] = $data[$i]['stocks_trng_qty_out'];
					$dat['stocks_section'] = $data[$i]['stocks_section'];
					array_push($ret_data['data'], $dat);
				}
			}
			// print_r($ret_data);die;
			return $ret_data;
		}
	}
}