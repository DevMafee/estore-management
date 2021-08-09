<?php
//Login Controller
class Login extends BaseController
{
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == true) {
			$this->redirect("./dashboard");
			exit;
		}
	}
	public function index()
	{
		$data = $this->base_model->query_out("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "*", "company_settings");
		$this->view->login('login/index', $data);
	}

	public function run()
	{
		$data = $this->model->login('users', 'username', 'password');
		if ( $data == 'SUCCESS') {
			$_SESSION['message'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Successfully Logged in!
                            </div>';
			$data = $this->base_model->languages_load();
			$this->redirect("../dashboard");
		}else{
			Session::set('login_failed', "Please Check your Username or Password!");
			$this->redirect("../login");
		}
	}

}