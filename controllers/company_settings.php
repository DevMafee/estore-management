<?php
//Company_Settings Controller
class Company_Settings extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'company_settings');
	}
	
	public function index()
	{
		$data = $this->model->fetch('company_settings');
		$this->view->admin('company_settings/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('company_settings');
		$this->view->admin('company_settings/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('company_settings');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('company_settings');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	public function emailconfig(){
		$data = $this->model->fetch('company_settings');
		// print_r($data);
		// exit;
		$this->view->admin('company_settings/email', $data);
	}

	public function updateemailconfiguration(){
		$data = $this->model->updateemail('company_settings');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('emailconfig');
		}else{
			$this->redirect('emailconfig');
		}
	}

}