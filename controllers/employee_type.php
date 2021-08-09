<?php
//employee_type Controller
class employee_type extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'employee_type');
	}
	
	public function index()
	{
		$data = $this->model->fetch('employee_type');
		$this->view->admin('employee_type/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('employee_type');
		$this->view->admin('employee_type/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('employee_type');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'employee_type');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'employee_type');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}