<?php

class Home extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'home');
	}
	public function index()
	{
		// $this->view->load('home/main');
		$this->redirect('dashboard');
	}

	public function about()
	{
		$this->view->data = "I AM SALMAN";
		$this->view->load('home/main2');
	}
}