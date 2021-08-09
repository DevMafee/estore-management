<?php
//requisitions Controller
class requisitions extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'requisitions');
	}

    public function pradhikar()
	{
        echo '<script language="javascript">window.location.href ="'.base_url('site_link').'views/pradhikar.pdf"</script>';
	}

	public function reports()
	{
		$data = $this->base_model->query_out("1", "*", "section");
		$this->view->admin('reports/requisition_report', $data);
	}

	public function load_requisitions_report()
	{
		$data = $this->model->requisitions_report();
		$date = array();
		$date['start'] = $_POST['from_date'];
		$date['end'] = $_POST['to_date'];
		$section = $this->base_model->query_out("section_id=" . $_POST['section'], "section_en,section_bn", "section");
		$this->view->prints('reports/requisition_report_view', $data, $section, $date);
	}

	public function prints($id)
	{
		$id = substr($id, 32, -32);
		$data = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions");
		$data2 = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions_details");
		$this->view->prints('stock_out/requisition', $data, $data2, $id);
	}

	public function prints_woa($id)
	{
		$id = substr($id, 32, -32);
		$data = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions");
		$data2 = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions_details");
		$this->view->prints('stock_out/requisition_wo_approve', $data, $data2, $id);
	}
	
	public function approval()
	{
		$data = $this->base_model->query_out("requisitions_status=1", "*", "requisitions");
		$this->view->admin('requisitions/approval', $data);
	}

	public function pendingListPrint()
	{
		$data = $this->base_model->query_out("`requisitions_status`=1", "*", "`requisitions`");
		$this->view->prints('requisitions/index2printPending', $data);
	}

	public function approve_requisitions($requisitions_id)
	{
		$data = $this->model->requisition_status_set('requisitions', $requisitions_id);
		if ($data == 'SUCCESS') {
			$_SESSION['message'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Operation Successfull!
                            </div>';
		} else {
			$_SESSION['message'] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Operation Failed!
                            </div>';
		}
		return $data;
	}

	public function reject_requisitions($requisitions_id)
	{
		$data = $this->model->requisition_status_update('requisitions', $requisitions_id, 0);
		return $data;
	}

	public function jsondata($products)
	{
		
		$products = explode(',', $products);
		if(count($products) > 0){
			$data = array();
			$name = $_SESSION['LANGUAGE_SETTED'] == 'en' ? 'product_name_en' : 'product_name_bn';
			$items = '';
			foreach ($products as $product) {
				$item = $this->base_model->query_out("`product_id`=$product", "product_id, $name", "product");
				$item_name = $item[0][$name];
				$item_id = $item[0]['product_id'];

				$data = $this->base_model->query_out("`stocks_product_id`=$product ORDER BY stocks_id DESC LIMIT 0,1", "stocks_current_stock", "stocks");
				if (count($data) > 0) {
					$stock = $data[0]['stocks_current_stock'];
				} else {
					$stock = 0;
				}
				$sec = $_SESSION['section_id'];
				$limit = $this->base_model->query_out("`product_limit_section`=$sec AND `product_limit_product`=$product ORDER BY product_limit_id DESC LIMIT 0,1", "product_limit_status", "product_limit");

				$limited = isset($limit[0]['product_limit_status']) ? $limit[0]['product_limit_status'] : '1';

				$pradhikar = $this->base_model->query_out("`product_limit_section`=$sec AND `product_limit_product`=$product ORDER BY product_limit_id DESC LIMIT 0,1", "product_limit_requisition_limit", "product_limit");
				if($pradhikar){
					$pradhikar_pabe = $pradhikar[0]['product_limit_requisition_limit'] > 0 ? $pradhikar[0]['product_limit_requisition_limit'] : '5';
				}else{
					$pradhikar_pabe = 5;
				}
				

				$ym = date('Y-m');
				$f_date = $ym . '-01';
				$l_date = $ym . '-31';
				$rcv_this_month = $this->base_model->query_out("`requisitions`.`requisitions_id`=`requisitions_details`.`requisitions_id` AND `requisitions`.`requisitions_section`=" . $sec . " AND `requisitions_details`.`requisitions_product`=" . $product . " AND `requisitions`.`requisitions_date` BETWEEN '$f_date' AND '$l_date'", "SUM(`requisitions_details`.`requisitions_approve_product_qty`) AS approved_qty", "`requisitions`,`requisitions_details`");
				$rcv = $rcv_this_month[0]['approved_qty'] > 0 ? $rcv_this_month[0]['approved_qty'] : '0';
				$rest_quantity = $pradhikar_pabe - $rcv;

				$items .= $item_id . ' - ' . $item_name . ' - ' . $pradhikar_pabe . ' - ' . $rcv . ' - ' . $rest_quantity . '-4x0-';
			}
			$dd = substr($items, 0, -5);
			$dd = explode('-4x0-', $dd);
			return json_encode($dd);
		}else{
			return "NO_DATA";
		}
	}

	public function jsondata_category($category_id)
	{
		$data = $this->base_model->query_out("`product_category`=$category_id ORDER BY product_name_en ASC", "*", "product");
		if (count($data) > 0) {
			echo json_encode($data, true);
		} else {
			echo 0;
		}
	}

	public function jsondataMystocklimit($data)
	{
		$data = explode('-', $data);
		$product = $data[0];
		$section = $data[1];
		$year = $data[2];
		$month = $data[3];
		$data2 = $this->base_model->query_out("`product_limit_section`=$section AND `product_limit_product`=$product ORDER BY product_limit_id DESC LIMIT 0,1", "product_limit_requisition_limit", "product_limit");

		if (count($data2) > 0) {
			echo $data2[0]['product_limit_requisition_limit'];
		} else {
			echo 0;
		}
	}

	public function jsondataMystocklimitYesNo($data)
	{
		$data = explode('-', $data);
		$product = $data[0];
		$section = $data[1];
		$data2 = $this->base_model->query_out("`product_limit_section`=$section AND `product_limit_product`=$product ORDER BY product_limit_id DESC LIMIT 0,1", "product_limit_status", "product_limit");

		if (count($data2) > 0) {
			echo $data2[0]['product_limit_status'];
		} else {
			echo 1;
		}
	}

	public function jsondataMystockReceived($data)
	{
		$data = explode('-', $data);
		$product = $data[0];
		$section = $data[1];
		$year = $data[2];
		$month = $data[3] < 10 ? '0' . $data[3] : $data[3];
		$year_month = $year . '-' . $month;
		$data2 = $this->base_model->query_out("`stocks_section`=$section AND `stocks_trng_type`='OUT' AND `stocks_product_id`=$product AND SUBSTRING(DATE(`stocks_date`),1,7)='$year_month'", "SUM(`stocks_trng_qty_out`) as stocks_trng_qty_out", "stocks");

		if (count($data2) > 0) {
			echo $data2[0]['stocks_trng_qty_out'];
		} else {
			echo 0;
		}
	}

	public function approveListPrint()
	{
		if ($_SESSION['user_type'] != 1) {
			$data = $this->base_model->query_out("`requisitions_employee`=" . $_SESSION['emp_id'] . " OR `requisitions_receiver`=" . $_SESSION['emp_id'], "*", "`requisitions`");
		} else {
			$data = $this->base_model->query_out("`requisitions_status`>1", "*", "`requisitions`");
		}
		$data = $this->base_model->query_out("`requisitions_status`>1", "*", "`requisitions`");
		$this->view->prints('requisitions/index2print', $data);
	}

	public function approved()
	{
		if ($_SESSION['user_type'] != 1) {
			$data = $this->base_model->query_out("`requisitions_employee`=" . $_SESSION['emp_id'] . " OR `requisitions_receiver`=" . $_SESSION['emp_id'], "*", "`requisitions`");
		} else {
			$data = $this->base_model->query_out("`requisitions_status`>1", "*", "`requisitions`");
		}
		$data = $this->base_model->query_out("`requisitions_status`>1", "*", "`requisitions`");
		$this->view->admin('requisitions/index2', $data);
	}

	public function all()
	{
		if ($_SESSION['user_type'] != 1) {
			$data = $this->base_model->query_out("`requisitions_employee`=" . $_SESSION['emp_id'] . " OR `requisitions_receiver`=" . $_SESSION['emp_id'], "*", "requisitions");
		} else {
			$data = $this->base_model->query_out("1", "*", "requisitions");
		}
		$this->view->admin('requisitions/index', $data);
	}

	public function create()
	{
		$data3 = $this->base_model->query_out("product_category_status=1", "*", "product_category");
		$data = $this->base_model->query_out("employee_information_id=" . $_SESSION['emp_id'], "*", "employee_information");
		foreach ($data as $dt) {
			$section_emp = $dt['employee_section'];
		}
		$section = isset($section_emp) && $section_emp != '' ? $section_emp : 8;
		$sec_name = $this->base_model->in_out_result("$section", "section_id", "section_bn", "section");
		$this->view->admin('requisitions/create', $section, $sec_name, $data3);
	}

	public function save()
	{
		$data = $this->model->save('requisitions', 'requisitions_details');
		if ($data == 'SUCCESS') {
			$_SESSION['message'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Successfully Created Your Requisition !
                            </div>';
			return $data;
		} else {
			$_SESSION['message'] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Failed to Create Your Requisition !
                            </div>';
			return $data;
		}
	}

	public function update()
	{
		$data = $this->model->update('requisitions');

		if ($data == 'SUCCESS') {
			$this->redirect('all');
		} else {
			$this->redirect('all');
		}
	}
}
