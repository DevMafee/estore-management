<?php
//Top_menu Controller
class Top_menu extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'top_menu');
	}
	
	public function index()
	{
		$data = $this->model->fetch('top_menu');
		$this->view->admin('menu/create_top_menu', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('top_menu');
		$this->view->admin('menu/create_top_menu', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('top_menu');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	function update(){
		print_r($_POST); die;
		$data = $this->model->update('top_menu');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}