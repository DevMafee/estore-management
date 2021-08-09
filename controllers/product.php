<?php
//product Controller
class product extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'product');
	}

	public function index()
	{
		$data = $this->base_model->query_out("product.product_category=product_category.product_category_id AND product.product_unit=unit.unit_id", "product.*, product_category.product_category_en,product_category.product_category_bn,unit.unit_en,unit.unit_bn", "product,product_category,unit");
		$data2 = $this->model->fetch('product_category');
		$data3 = $this->model->fetch('unit');
		$this->view->admin('product/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->base_model->query_out("product.product_category=product_category.product_category_id AND product.product_unit=unit.unit_id", "product.*, product_category.product_category_en,product_category.product_category_bn,unit.unit_en,unit.unit_bn", "product,product_category,unit");
		$data2 = $this->model->fetch('product_category');
		$data3 = $this->model->fetch('unit');
		$this->view->admin('product/index', $data, $data2, $data3);
	}

	public function jsondata($product=1)
	{
		$data = $this->base_model->query_out("product_status=$product", "*", "product");
		echo json_encode($data);
	}

	public function save()
	{
		$data = $this->model->save('product');
		if ($data == 'SUCCESS') {
			$this->redirect('all');
		} else {
			$this->redirect('all');
		}
	}

	public function update($id)
	{
		$data = $this->model->update($id, 'product');
		if ($data == 'SUCCESS') {
			$this->redirect('../all');
		} else {
			$this->redirect('../all');
		}
	}

	public function update_status($id)
	{
		$data = $this->model->update_status($id, 'product');
		if ($data == 'SUCCESS') {
			$this->redirect('../all');
		} else {
			$this->redirect('../all');
		}
	}
}
