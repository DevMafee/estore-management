<?php
//Logout Controller
class Logout extends BaseController
{
	
	function index()
	{
		Session::init();
		Session::destroy();
		$this->redirect('home');
		exit;
	}

}