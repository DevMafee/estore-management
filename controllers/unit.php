<?php
//unit Controller
class unit extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'unit');
	}
	
	public function index()
	{
		$data = $this->model->fetch('unit');
		$this->view->admin('unit/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('unit');
		$this->view->admin('unit/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}