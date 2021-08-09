<?php
// Users Controller
class Users extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'users');
	}

	function smscount(){
		if(isset($_POST['from_date']) && $_POST['from_date'] != ''){
            $from_date = $_POST['from_date'];
            if(isset($_POST['to_date']) && $_POST['to_date'] != ''){
                $to_date = $_POST['to_date'];
            }else{
                $to_date = date('Y-m-d');
            }
        }else{
            $from_date = date('Y-m-d');
			$to_date = date('Y-m-d');
        }
		
		$data = $this->base_model->query_out(" DATE(datetime_info) >= '$from_date' AND DATE(datetime_info) <= '$to_date'", "*", "smsinfo");
		$this->view->admin('users/smscount', $data, $from_date, $to_date);
	}

	function user_api(){
		$data = $this->base_model->query_out('users.user_type=user_type.user_type_id', 'users.*, user_type.user_type_name', 'users, user_type');
		return json_encode($data, true);
		
	}

	function index(){
		// $data = $this->model->fetch('users');
		$data = $this->base_model->query_out("users.user_type=user_type.user_type_id", "user_type.user_type_name, users.*", "users,user_type");
		$data2 = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/index', $data, $data2);
	}
	
	function all(){
		// $data = $this->model->fetch('users');
		$data = $this->base_model->query_out("users.user_type=user_type.user_type_id", "user_type.user_type_name, users.*", "users,user_type");
		$data2 = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/index', $data, $data2);
	}

	function create(){
		$data = $this->model->fetch('users');
		$data2 = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create', $data, $data2);
	}

	function create_usertype(){
		$data = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create_usertype', $data);
	}

	function all_usertype(){
		$data = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create_usertype', $data);
	}

	function save(){
		$data = $this->model->save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('create');
		}
	}

	function update(){
		$data = $this->model->update();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function delete(){
		$data = $this->model->delete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function undodelete(){
		$data = $this->model->undodelete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function active(){
		$data = $this->model->active();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function usertype_save(){
		$data = $this->model->usertype_save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function usertype_update(){
		$data = $this->model->usertype_update();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function usertype_delete(){
		$data = $this->model->usertype_delete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function accesscreate(){
		$data = $this->model->fetch('users');
		$menu = $this->model->fetch('main_menu');
		$this->view->admin('users/accesscreate', $data, $menu);
	}

	function access_save(){
		$data = $this->model->access_save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../main_menu/all');
		}else{
			$this->redirect('../main_menu/all');
		}
	}

	public function checkoutaccess()
	{
		$username = $_POST['user'];
		$data = $this->model->fetch_json_menu('main_menu_id,main_menu_has_access', 'main_menu', $username);
		return $data;
	}
}