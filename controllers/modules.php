<?php
//Modules Coltroller
class Modules extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'modules');
	}

	function index(){
		$data = $this->model->fetchData();
		$data2 = $this->base_model->query_out('user_type_id!=1', '*', 'user_type');
		$this->view->admin('modules/view', $data, $data2);
	}

	function all(){
		$data = $this->model->fetchData();
		$data2 = $this->base_model->query_out('user_type_id!=1', '*', 'user_type');
		$this->view->admin('modules/view', $data, $data2);
	}

	function create(){
		$this->view->admin('modules/create');
	}

	function save(){
		$data = $this->model->saveData();
		if ( $data == 'SUCCESS' ) {
			$this->createTable(strtolower($_SESSION['module_model']));
			$this->createController($_SESSION['module'], $_SESSION['module_model']);
			$this->createModel($_SESSION['module'], $_SESSION['module_model']);
			$this->createView($_SESSION['module_model']);
			$_SESSION['module']='';
			$this->redirect('all');
		}else{
			$this->redirect('create');
		}
	}

	function access_controll_save(){
		$data = $this->model->access_controll_save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../users/create_usertype');
		}else{
			$this->redirect('all');
		}
	}

	function dalete(){
		$data = $this->model->dalete();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}