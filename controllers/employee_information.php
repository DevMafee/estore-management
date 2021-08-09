<?php
//employee_information Controller
class employee_information extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'employee_information');
	}

	public function index()
	{
		$data = $this->base_model->query_out("e.employee_section=s.section_id AND e.employee_designation=d.designation_id ORDER BY e.employee_designation ASC", "e.*,s.section_en,s.section_bn,d.designation_en,d.designation_bn", "employee_information as e, section as s, designation as d");
		$data2 = $this->model->fetch('section');
		$data3 = $this->model->fetch('designation');
		$this->view->admin('employee_information/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->base_model->query_out("e.employee_section=s.section_id AND e.employee_designation=d.designation_id ORDER BY e.employee_designation ASC", "e.*,s.section_en,s.section_bn,d.designation_en,d.designation_bn", "employee_information as e, section as s, designation as d");
		$data2 = $this->model->fetch('section');
		$data3 = $this->model->fetch('designation');
		$this->view->admin('employee_information/index', $data, $data2, $data3);
	}

	public function active()
	{
		$data = $this->base_model->query_out("e.employee_section=s.section_id AND e.employee_designation=d.designation_id AND e.employee_information_status=1 ORDER BY e.employee_designation ASC", "e.*,s.section_en,s.section_bn,d.designation_en,d.designation_bn", "employee_information as e, section as s, designation as d");
		$data2 = $this->model->fetch('section');
		$data3 = $this->model->fetch('designation');
		$this->view->admin('employee_information/active', $data, $data2, $data3);
	}

	public function inactive()
	{
		$data = $this->base_model->query_out("e.employee_section=s.section_id AND e.employee_designation=d.designation_id AND e.employee_information_status=0 ORDER BY e.employee_designation ASC", "e.*,s.section_en,s.section_bn,d.designation_en,d.designation_bn", "employee_information as e, section as s, designation as d");
		$data2 = $this->model->fetch('section');
		$data3 = $this->model->fetch('designation');
		$this->view->admin('employee_information/inactive', $data, $data2, $data3);
	}

	function view_all()
	{
		$data = $this->base_model->query_out("users.user_type=user_type.user_type_id AND users.user_id!=1", "user_type.user_type_name, users.*", "users,user_type");
		$data2 = $this->base_model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('employee_information/view_all', $data, $data2);
	}

	public function save()
	{
		$data = $this->model->save('employee_information');
		if ($data == 'SUCCESS') {
			$this->redirect('all');
		} else {
			$this->redirect('all');
		}
	}

	public function update($id)
	{
		$data = $this->model->update($id, 'employee_information');
		if ($data == 'SUCCESS') {
			$this->redirect('../all');
		} else {
			$this->redirect('../all');
		}
	}

	public function update_status()
	{
		$data = $this->model->update_status('employee_information');
		if ($data == 'SUCCESS') {
			$this->redirect('../all');
		} else {
			$this->redirect('../all');
		}
	}

	function update_user()
	{
		$data = $this->model->update_user();

		if ($data == 'SUCCESS') {
			$this->redirect('view_all');
		} else {
			$this->redirect('view_all');
		}
	}

	function update_password()
	{
		$data = $this->model->update_password();
		if ($data == 'SUCCESS') {
			$this->redirect('view_all');
		} else {
			$this->redirect('view_all');
		}
	}

	function delete_user()
	{
		$data = $this->model->delete_user();

		if ($data == 'SUCCESS') {
			$this->redirect('view_all');
		} else {
			$this->redirect('view_all');
		}
	}

	function undodelete_user()
	{
		$data = $this->model->undodelete_user();

		if ($data == 'SUCCESS') {
			$this->redirect('view_all');
		} else {
			$this->redirect('view_all');
		}
	}

	function active_user()
	{
		$data = $this->model->active_user();

		if ($data == 'SUCCESS') {
			$this->redirect('view_all');
		} else {
			$this->redirect('view_all');
		}
	}
}
