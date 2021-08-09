<?php
//department Controller
class department extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'department');
	}
	
	public function index()
	{
		$data = $this->model->fetch('department');
		$this->view->admin('department/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('department');
		$this->view->admin('department/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('department');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id, 'department');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}
	
	public function update_status($id){
		$data = $this->model->update_status($id, 'department');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}