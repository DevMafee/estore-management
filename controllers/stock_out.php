<?php
//stock_out Controller
class stock_out extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'stock_out');
	}

	public function prints($id)
	{
		$id = substr($id, 32, -32);
		$data = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions");
		$data2 = $this->base_model->query_out("requisitions_id=$id", "*", "requisitions_details");
		$this->view->prints('stock_out/requisition', $data, $data2, $id);
	}

	public function index()
	{
		if ($_SESSION['user_type'] == 6) {
			$data = $this->base_model->query_out("stock_out_entry=" . $_SESSION['emp_id'] . " ORDER BY stock_out_date DESC ", "*", "stock_out");
		} else {
			$data = $this->base_model->query_out("1 ORDER BY stock_out_date DESC ", "*", "stock_out");
		}
		$this->view->admin('stock_out/index', $data);
	}

	public function all()
	{
		if ($_SESSION['user_type'] == 6) {
			$data = $this->base_model->query_out("stock_out_entry=" . $_SESSION['emp_id'] . " ORDER BY stock_out_date DESC ", "*", "stock_out");
		} else {
			$data = $this->base_model->query_out("1 ORDER BY stock_out_date DESC ", "*", "stock_out");
		}
		$this->view->admin('stock_out/index', $data);
	}

	public function loadRequisitions($section)
	{
		$data = $this->base_model->query_out("requisitions_status=2 AND requisitions_section=" . $section, "*", "requisitions");
		return json_encode($data);
	}

	public function loadReceiver($section)
	{
		$data = $this->base_model->query_out("employee_section=" . $section, "*", "employee_information");
		return json_encode($data);
	}

	public function loadProducts($requisitions_id)
	{
		$data = $this->base_model->query_out("requisitions_details.requisitions_id=" . $requisitions_id . " AND product.product_id=requisitions_details.requisitions_product AND product.product_unit=unit.unit_id", "requisitions_details.*, product.product_name_bn, unit.unit_bn", "requisitions_details, product, unit");
		return json_encode($data);
	}

	public function create()
	{
		// $data = $this->model->fetch('section');
		$data = $this->base_model->query_out("`requisitions_status`=2 ORDER BY `requisitions_id` DESC ", "*", "`requisitions`");
		$this->view->admin('stock_out/create', $data);
	}

	public function save($requisitions_id)
	{
		$data = $this->model->save('stock_out');
		if ($data == 'SUCCESS') {
			$_SESSION['message'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Successfully Created Your Stock Out Request!
                            </div>';
		} else {
			$_SESSION['message'] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Failed to Create Your Stock Out Request!
                            </div>';
		}
		return $data;
	}

	public function update()
	{
		$data = $this->model->update('stock_out');

		if ($data == 'SUCCESS') {
			$this->redirect('all');
		} else {
			$this->redirect('all');
		}
	}
}
