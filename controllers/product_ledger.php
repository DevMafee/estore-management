<?php
//product_ledger Controller
class product_ledger extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'stocks');
	}
	
	public function ledger()
	{
		$data = $this->base_model->query_out("product_status=1 ORDER BY product_name_en ASC", "*", "product");
		$this->view->admin('reports/ledger', $data);
	}
	
	public function load_ledger_report()
	{
		$data = $this->model->load_ledger_report();
		$this->view->admin('reports/ledger_view', $data);
	}
}