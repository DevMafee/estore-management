<?php
//password_reset Controller
class password_reset extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "*", "company_settings");
		$this->view->login('login/reset', $data);
	}

	public function send_mail()
	{
		$data = $this->model->find_mail();
		if ($data == 'SUCCESS') {
			$data2 = $this->base_model->query_out("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "*", "company_settings");
			$this->view->login('login/reset_success', $data2);
		}else{
			$data2 = $this->base_model->query_out("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "*", "company_settings");
			$this->view->login('login/reset_failed', $data2);
		}
	}

}