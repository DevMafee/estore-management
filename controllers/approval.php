<?php
//approval Controller
class approval extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'approval');
	}

	public function loadSectionWise($section='')
	{
		$data = $this->base_model->query_out("employee_section=$section", "*", "employee_information");
		echo json_encode($data, true);
	}

	public function loadTempEmployee($section='')
	{
		$data = $this->base_model->query_out("employee_section=$section", "*", "employee_information");
		echo json_encode($data, true);
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("approval.approval_officer=employee_information.employee_information_id AND employee_information.employee_designation=designation.designation_id", "approval.*,employee_information.employee_name_en,employee_information.employee_name_bn,designation.designation_en,designation.designation_bn", "approval,employee_information,designation");
		$data2 = $this->base_model->query_out("1", "section_id,section_en,section_bn", "section");
		$data3 = $this->base_model->query_out("1", "*", "employee_information");
		$this->view->admin('approval/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->base_model->query_out("approval.approval_officer=employee_information.employee_information_id AND employee_information.employee_designation=designation.designation_id", "approval.*,employee_information.employee_name_en,employee_information.employee_name_bn,designation.designation_en,designation.designation_bn", "approval,employee_information,designation");
		$data2 = $this->base_model->query_out("1", "section_id,section_en,section_bn", "section");
		$data3 = $this->base_model->query_out("1", "*", "employee_information");
		$this->view->admin('approval/index', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('approval');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
}