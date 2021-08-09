<?php
//languages Controller
class languages extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'languages');
	}

	public function index()
	{
		$data = $this->base_model->query_out("1 ORDER BY languages_id DESC", "*", "languages");
		$this->view->admin('languages/index', $data);
	}

	public function all()
	{
		$data = $this->base_model->query_out("1 ORDER BY languages_id DESC", "*", "languages");
		$this->view->admin('languages/index', $data);
	}

	public function save()
	{
		$data = $this->model->save('languages');
		if ($data == 'SUCCESS') {
			$this->redirect('all');
		} else {
			$this->redirect('all');
		}
	}

	public function update($id)
	{
		$data = $this->model->update('languages', $id);
		if ($data == 'SUCCESS') {
			$this->redirect('../all');
		} else {
			$this->redirect('../all');
		}
	}

	public function load_language()
	{
		$data = $this->base_model->languages_load();
		return $data;
	}
}
