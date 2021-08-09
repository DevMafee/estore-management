<?php
//office Controller
class office extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'office');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("office.office_department=department.department_id","office.*,department.department_en,department_bn", "office,department");
		$data2 = $this->model->fetch('department');
		$this->view->admin('office/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->base_model->query_out("office.office_department=department.department_id","office.*,department.department_en,department_bn", "office,department");
		$data2 = $this->model->fetch('department');
		$this->view->admin('office/index', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('office');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id, 'office');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}
	
	public function update_status($id){
		$data = $this->model->update_status($id, 'office');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}