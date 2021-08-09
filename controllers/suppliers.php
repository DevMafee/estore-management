<?php
//suppliers Controller
class suppliers extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'suppliers');
	}
	
	public function index()
	{
		$data = $this->model->fetch('suppliers');
		$this->view->admin('suppliers/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('suppliers');
		$this->view->admin('suppliers/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('suppliers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'suppliers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status(){
		$data = $this->model->update_status('suppliers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}