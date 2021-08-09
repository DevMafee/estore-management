<?php
//product_limit Controller
class product_limit extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'product_limit');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("1 GROUP BY product_limit_section, product_limit_year, product_limit_month", "*", "product_limit");
		$this->view->admin('product_limit/index', $data);
	}

	public function all()
	{
		$data = $this->base_model->query_out("1 GROUP BY product_limit_section, product_limit_year, product_limit_month", "*", "product_limit");
		$this->view->admin('product_limit/index', $data);
	}

	public function edit($product_limit_id)
	{
		$data = $this->model->fetch('section');
		$data_limit = $this->base_model->query_out("1 GROUP BY product_limit_section, product_limit_year, product_limit_month", "*", "product_limit");
		
		$data_all = $this->base_model->query_out("product_limit_id=$product_limit_id", "*", "product");
		$tdata = ceil(count($data_all)/2);
		$rest_data = (count($data_all)-$tdata);
		$data2 = $this->base_model->query_out("product_limit_id=$product_limit_id ORDER BY product_id ASC LIMIT 0,$tdata", "*", "product");
		$data3 = $this->base_model->query_out("product_limit_id=$product_limit_id ORDER BY product_id ASC LIMIT $rest_data OFFSET $tdata", "*", "product");
		
		$this->view->admin('product_limit/edit', $data, $data2, $data3, $data_limit);
	}

	public function create()
	{
		$data = $this->model->fetch('section');
		$data_all = $this->base_model->query_out("product_status=1", "*", "product");
		$tdata = ceil(count($data_all)/2);
		$rest_data = (count($data_all)-$tdata);
		$data2 = $this->base_model->query_out("product_status=1 ORDER BY product_id ASC LIMIT 0,$tdata", "*", "product");
		$data3 = $this->base_model->query_out("product_status=1 ORDER BY product_id ASC LIMIT $rest_data OFFSET $tdata", "*", "product");
		
		$this->view->admin('product_limit/create', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('product_limit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('product_limit');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}