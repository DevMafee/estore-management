<?php
//stocks Controller
class stocks extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'stocks');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("product_status=1 ORDER BY product_name_en ASC", "*", "product");
		$this->view->admin('stocks/search', $data);
	}

	public function all()
	{
		// $data = $this->base_model->query_out("product_status=1 ORDER BY product_name_en ASC", "*", "product");
		// $this->view->admin('stocks/index', $data);
		$products = $this->base_model->query_out("product_status=1 ORDER BY product_name_en ASC", "*", "product");
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$data = [];
		foreach($products as $key=>$product){
			$pid = $product['product_id'];
			$opening_query = $this->base_model->query_out("`stocks_status`=1 AND DATE(`stocks_date`)<'$from_date' AND `stocks_product_id`=$pid ORDER BY `stocks_id` DESC LIMIT 0,1", "`stocks_current_stock`", "`stocks`");
			if(!empty($opening_query)){
				$opening_qty = $opening_query[0]['stocks_current_stock']??0;
			}else{
				$opening_qty = 0;
			}

			$product_in_query = $this->base_model->query_out("`stocks_status`=1 AND DATE(`stocks_date`) BETWEEN '$from_date' AND '$to_date' AND `stocks_product_id`=$pid AND `stocks_trng_type`='IN'", "SUM(`stocks_trng_qty_in`) as `total_in`", "`stocks`");
			if(!empty($product_in_query)){
				$opening_in_qty = $product_in_query[0]['total_in']??0;
			}else{
				$opening_in_qty = 0;
			}

			$product_out_query = $this->base_model->query_out("`stocks_status`=1 AND DATE(`stocks_date`) BETWEEN '$from_date' AND '$to_date' AND `stocks_product_id`=$pid AND `stocks_trng_type`='OUT'", "SUM(`stocks_trng_qty_out`) as `total_out`", "`stocks`");
			if(!empty($product_out_query)){
				$opening_out_qty = $product_out_query[0]['total_out']??0;
			}else{
				$opening_out_qty = 0;
			}
			
			$data[$key] = [
				'id' => $pid,
				'name' => $product['product_name_en'],
				'name_bn' => $product['product_name_bn'],
				'opening' => $opening_qty,
				'in' => $opening_in_qty,
				'out' => $opening_out_qty,
				'closing' => ( ( $opening_qty + $opening_in_qty ) - $opening_out_qty )
			];
		}
		$data2 = [
			'from_date' => $from_date,
			'to_date' => $to_date
		];
		$this->view->prints('stocks/index', $data, $data2);
	}

	public function monthly_stock_in_report()
	{
		$this->view->admin('reports/monthly_stock_in');
	}

	public function monthly_stock_in_report_view()
	{
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$data = $this->base_model->query_out("`sr`.`store_receive_date` BETWEEN '$from_date' AND '$to_date' AND `sr`.`store_receive_status`=1 AND `sr`.`store_receive_id`=`srd`.`store_receive_details_rcv_id` AND `sr`.`store_receive_section`=`section`.`section_id` AND `sr`.`store_receive_supplier`=`suppliers`.`suppliers_id`", "*", "`store_receive` as `sr`, `store_receive_details` as `srd`, section, suppliers");
		$this->view->prints('reports/monthly_stock_in_view', $data, $from_date, $to_date);
	}

	public function monthly_stock_out_report()
	{
		$this->view->admin('reports/monthly_stock_out');
	}

	public function monthly_stock_out_report_view()
	{
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$data = $this->base_model->query_out("`so`.`stock_out_date` BETWEEN '$from_date' AND '$to_date' AND `so`.`stock_out_status`=1 AND `so`.`stock_out_id`=`sod`.`stock_out_details_stock_out_id`", "*", "`stock_out` as `so`, `stock_out_details` as `sod`");
		$this->view->prints('reports/monthly_stock_out_view', $data, $from_date, $to_date);
	}

	public function atsection()
	{
		$data = $this->base_model->query_out("section_status=1 ORDER BY section_id ASC", "*", "section");
		$this->view->admin('stocks/search_section', $data);
	}

	public function section_wise_report()
	{
		$item=[];
		$products = $this->base_model->query_out("product_status=1 ORDER BY product_name_en ASC", "*", "product");
		$section = $_POST['section'];
		if($section != ''){
			$finding_section = $this->base_model->query_out("`section_id`=$section", "*", "section");
			$sec_name = $finding_section[0]['section_bn'];
		}else{
			$sec_name = '';
		}
		$sections = $this->base_model->query_out("section_status=1 ORDER BY section_id ASC", "*", "section");
		foreach($products as $product){
			if($section == ''){
				foreach($sections as $sec){
					$item[$product['product_id']][$sec['section_id']] = 0;
				}
			}else{
				$item[$product['product_id']][$section] = 0;
			}
		}
		
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		if($section != ''){
			$stockOuts = $this->base_model->query_out("`so`.`stock_out_status`=1 AND `so`.`stock_out_date` BETWEEN '$from_date' AND '$to_date' AND `so`.`stock_out_section`='$section' AND `so`.`stock_out_id`=`sod`.`stock_out_details_stock_out_id`", "`sod`.*, `so`.`stock_out_section`, `so`.`stock_out_date`", "`stock_out` as `so`, `stock_out_details` as `sod`");
		}else{
			$stockOuts = $this->base_model->query_out("`so`.`stock_out_status`=1 AND `so`.`stock_out_date` BETWEEN '$from_date' AND '$to_date' AND `so`.`stock_out_id`=`sod`.`stock_out_details_stock_out_id`", "`sod`.*, `so`.`stock_out_section`, `so`.`stock_out_date`", "`stock_out` as `so`, `stock_out_details` as `sod`");
		}
		
		$data = [];
		foreach($stockOuts as $key=>$stockOut){
			$sid = $stockOut['stock_out_section'];
			$pid = $stockOut['stock_out_details_product'];
			$pradhikar = $this->base_model->query_out("`product_limit_status`=1 AND `product_limit_section`='$sid' AND `product_limit_product`='$pid' ORDER BY `product_limit_id` DESC LIMIT 0,1", "`product_limit_requisition_limit`", "`product_limit`");
			if(!empty($pradhikar)){
				$limit = $pradhikar[0]['product_limit_requisition_limit']??0;
			}else{
				$limit = 0;
			}

			$product = $this->base_model->query_out("`product_status`=1 AND `product_id`='$pid'", "*", "`product`");
			if(!empty($product)){
				$name = $product[0]['product_name_bn']??0;
			}else{
				$name = "No Product Found";
			}
			$sosection = $stockOut['stock_out_section'];
			$sectionfind = $this->base_model->query_out("`section_id`=$sosection", "*", "section");
			$item[$pid][$sosection] = $item[$pid][$sosection]+$stockOut['stock_out_details_product_qty'];
			$data[$key] = [
				'section_name' => $sectionfind[0]['section_bn'],
				'product_name' => $name,
				'limit' => $limit,
				'receive' => $stockOut['stock_out_details_product_qty'],
				'receive_date' => $stockOut['stock_out_details_date'],
				'total_receive' => ($limit - $item[$pid][$sosection]),
			];
		}
		
		$data2 = [
			'from_date' => $from_date,
			'to_date' => $to_date
		];
		$data3 = $sec_name;
		$this->view->prints('stocks/section_wise_report', $data, $data2, $data3);
	}
}