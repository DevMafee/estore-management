<?php
//store_receive Controller
class store_receive extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'store_receive');
	}
	
	public function index()
	{
// 		$data = $this->base_model->query_out("1 AND `store_receive`.`store_receive_section`=`section`.`section_id` GROUP BY `store_receive_indent` ORDER BY store_receive_date DESC LIMIT 0,100", "store_receive.*,section.section_en,section.section_bn", "store_receive, section");
        $data = $this->base_model->query_out("1 AND `store_receive`.`store_receive_section`=`section`.`section_id` AND `store_receive`.`store_receive_supplier`=`suppliers`.`suppliers_id` GROUP BY `store_receive_indent` ORDER BY store_receive_date DESC LIMIT 0,100", "store_receive.*,section.section_en,section.section_bn, suppliers.suppliers_en, suppliers.suppliers_bn", "store_receive, section, suppliers");
		$this->view->admin('store_receive/index', $data);
	}

	public function all()
	{
		$data = $this->base_model->query_out("1 AND `store_receive`.`store_receive_section`=`section`.`section_id` AND `store_receive`.`store_receive_supplier`=`suppliers`.`suppliers_id` GROUP BY `store_receive_indent` ORDER BY store_receive_date DESC LIMIT 0,100", "store_receive.*,section.section_en,section.section_bn, suppliers.suppliers_en, suppliers.suppliers_bn", "store_receive, section, suppliers");
		$this->view->admin('store_receive/index', $data);
	}

	public function create()
	{
		$data = $this->model->fetch('section');
		$data2 = $this->model->fetch('suppliers');
		$this->view->admin('store_receive/create', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('store_receive');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update($id){
		$data = $this->model->update($id,'store_receive');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

	public function update_status($id){
		$data = $this->model->update_status($id, 'store_receive');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('../all');
		}else{
			$this->redirect('../all');
		}
	}

}