<?php
//Main_menu Controller
class Main_menu extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'main_menu');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("user_type_id!=1", "*", "user_type");
		$data_x = $this->model->fetch('main_menu');
		$data_3 = $this->model->fetch('user_type');
		$this->view->admin('menu/create_main_menu', $data_x, $data, $data_3);
	}

	public function all()
	{
		$data = $this->base_model->query_out("user_type_id!=1", "*", "user_type");
		$data_x = $this->model->fetch('main_menu');
		$data_3 = $this->model->fetch('user_type');
		$this->view->admin('menu/create_main_menu', $data_x, $data, $data_3);
	}
	
	public function save()
	{
		$data = $this->model->save('main_menu');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	function update($id)
	{
		$data = $this->model->update($id,'main_menu');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}