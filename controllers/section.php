<?php
//section Controller
class section extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'section');
	}
	
	public function index()
	{
		$data = $this->base_model->query_out("section.section_office=office.office_id ORDER BY section.section_id DESC", "section.*,office.office_en,office.office_bn", "section,office");
		$data2 = $this->model->fetch('office');
		$this->view->admin('section/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->base_model->query_out("section.section_office=office.office_id ORDER BY section.section_id DESC", "section.*,office.office_en,office.office_bn", "section,office");
		$data2 = $this->model->fetch('office');
		$this->view->admin('section/index', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('section');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'section');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'section');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}