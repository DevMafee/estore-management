<?php
//emp_class Controller
class emp_class extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'emp_class');
	}
	
	public function index()
	{
		$data = $this->model->fetch('emp_class');
		$this->view->admin('emp_class/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('emp_class');
		$this->view->admin('emp_class/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('emp_class');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'emp_class');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'emp_class');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}