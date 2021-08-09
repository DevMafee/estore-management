<?php
//product_category Controller
class product_category extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'product_category');
	}
	
	public function index()
	{
		$data = $this->model->fetch('product_category');
		$this->view->admin('product_category/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('product_category');
		$this->view->admin('product_category/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('product_category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'product_category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'product_category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}