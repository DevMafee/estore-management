<?php
//gender Controller
class gender extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'gender');
	}
	
	public function index()
	{
		$data = $this->model->fetch('gender');
		$this->view->admin('gender/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('gender');
		$this->view->admin('gender/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('gender');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'gender');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'gender');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}