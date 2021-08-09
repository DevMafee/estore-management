<?php
//designation Controller
class designation extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'designation');
	}
	
	public function index()
	{
		$data = $this->model->fetch('designation');
		$this->view->admin('designation/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('designation');
		$this->view->admin('designation/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('designation');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'designation');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'designation');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}