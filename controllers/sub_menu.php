<?php
//Sub_menu Controller
class Sub_menu extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'sub_menu');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out('sub_menu.sub_menu_main=main_menu.main_menu_id', 'main_menu.main_menu_name as sub_menu_parent, sub_menu.*', 'sub_menu,main_menu');
		$data2 = $this->model->fetch('main_menu');
		$this->view->admin('menu/create_sub_menu', $data);
	}

	public function all()
	{
		$data = $this->base_model->query_out('sub_menu.sub_menu_main=main_menu.main_menu_id', 'main_menu.main_menu_name as sub_menu_parent, sub_menu.*', 'sub_menu,main_menu');
		$data2 = $this->model->fetch('main_menu');
		$this->view->admin('menu/create_sub_menu', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('sub_menu');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	function update(){
		$data = $this->model->update('sub_menu');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}