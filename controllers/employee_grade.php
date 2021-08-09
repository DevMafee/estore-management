<?php
//employee_grade Controller
class employee_grade extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'employee_grade');
	}
	
	public function index()
	{
		$data = $this->model->fetch('employee_grade');
		$this->view->admin('employee_grade/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('employee_grade');
		$this->view->admin('employee_grade/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('employee_grade');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'employee_grade');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'employee_grade');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}