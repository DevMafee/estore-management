<?php
// Dashboard Controller
class Dashboard extends BaseController
{
	
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'dashboard');
	}

	public function getRequisitions(){
		$data = $this->base_model->query_out("requisitions_status=1 AND requisitions.requisitions_employee=employee_information.employee_information_id AND requisitions.requisitions_section=section.section_id ORDER BY requisitions.requisitions_date ASC", "requisitions.*, employee_information.employee_name_bn, section.section_bn", "requisitions,employee_information,section");
		return json_encode($data, true);
	}

	public function getRequisitionsPending(){
		$data = $this->base_model->query_out("requisitions_status=1 AND requisitions_employee=".$_SESSION['emp_id']." ORDER BY requisitions_date DESC LIMIT 0,10", "*", "requisitions");
		return json_encode($data, true);
	}

	public function getRequisitionsreceived(){
		$data = $this->base_model->query_out("requisitions_status IN (2,3) AND requisitions_employee=".$_SESSION['emp_id']." ORDER BY requisitions_date DESC LIMIT 0,10", "*", "requisitions");
		return json_encode($data, true);
	}

	public function index(){
		$data['pro_photo'] = $this->model->findProfilephoto('users', 'user_id', $_SESSION['user_id'], 'user_photo');
		$data2 = $this->base_model->in_out($_SESSION['user_id'], 'user_id', '*', 'users');
		$data2 = json_encode( $data2 );
		$data3 = $this->dashboard_data();
		$data7 = $this->gridData();
		$data8 = $this->category_product_stock();
// 		$products = $this->base_model->query_out("`product_status`=1", "product_id", "`product`");
// 		echo "<pre>";
// 		foreach($products as $product){
// 		    if($this->base_model->full_query($product['product_id']) != "SUCCESS"){
// 		        echo "Failed";
// 		        exit;
// 		    }
// 		}
// 		echo "WOW, Done";
// 		exit;
		
		// $data5 = $this->base_model->query_out("section_status=1 ORDER BY section_id ASC LIMIT 0,12", "section_en, section_bn", "section");
		if(isset($_SESSION['LANGUAGE_SETTED']) && $_SESSION['LANGUAGE_SETTED']=='en'){
			$dt_stock_main = $this->base_model->query_out("MONTH(`so`.`stock_out_date`) = MONTH(CURRENT_DATE()) AND YEAR(`so`.`stock_out_date`) = YEAR(CURRENT_DATE()) AND `so`.`stock_out_status`=1 AND `so`.`stock_out_section`=`s`.`section_id` GROUP BY `so`.`stock_out_section` ORDER BY `total_requisition` DESC LIMIT 0,12", "COUNT(`so`.`stock_out_section`) as `total_requisition`, `so`.`stock_out_section`, `s`.`section_en` as `section_name`", "`stock_out` as `so`, `section` as `s`");
		}else{
			$dt_stock_main = $this->base_model->query_out("MONTH(`so`.`stock_out_date`) = MONTH(CURRENT_DATE()) AND YEAR(`so`.`stock_out_date`) = YEAR(CURRENT_DATE()) AND `so`.`stock_out_status`=1 AND `so`.`stock_out_section`=`s`.`section_id` GROUP BY `so`.`stock_out_section` ORDER BY `total_requisition` DESC LIMIT 0,12", "COUNT(`so`.`stock_out_section`) as `total_requisition`, `so`.`stock_out_section`, `s`.`section_bn` as `section_name`", "`stock_out` as `so`, `section` as `s`");
		}

		$data4 = '[';
		$data5 = '[';
		$data6 = count($dt_stock_main);
		foreach($dt_stock_main as $row){
			$data4 .= '"'.$row['section_name'].'",';
			$data5 .= '"'.$row['total_requisition'].'",';
		}
		$data4 = rtrim($data4, ", ");
		$data5 = rtrim($data5, ", ");
		$data4 .= ']';
		$data5 .= ']';

		$this->view->admin('admin/dashboard', $data, $data2, $data3, $data4, $data5, $data6, $data7, $data8);
	}

	public function category_product_stock()
	{
		$data['category_count'] = count($this->base_model->query_out("`product_category_status`=1", "*", "`product_category`"));
		$data['categories'] = '[';
		$data['stocks'] = '[';
		$categories = $this->base_model->query_out("`product_category_status`=1", "*", "`product_category`");
		foreach($categories as $category){
			$products = $this->base_model->query_out("`product_status`=1 AND `product_category`=".$category['product_category_id'], "*", "`product`");
			$category_name = isset($_SESSION['LANGUAGE_SETTED'])&&$_SESSION['LANGUAGE_SETTED']=='en'?$category['product_category_en']:$category['product_category_bn'];
			$data['categories'] .='"'.$category_name.'", ';
			$stock_by_cat = 0;
			foreach($products as $product){
				$stock = $this->base_model->query_out("`stocks_product_id`=".$product['product_id']." ORDER BY `stocks_id` DESC LIMIT 0,1", "*", "`stocks`");
				$stock_by_cat = ($stock_by_cat+(isset($stock[0]['stocks_current_stock'])?$stock[0]['stocks_current_stock']:0));
			}
			$data['stocks'] .='"'.$stock_by_cat.'", ';
		}
		$data['categories'] = rtrim($data['categories'], ", ");
		$data['categories'] .= ']';
		$data['stocks'] = rtrim($data['stocks'], ", ");
		$data['stocks'] .= ']';
		
		return $data;
	}

	public function gridData(){
		if ($_SESSION['user_type'] != 6) {
			$data['total_requisitions'] = $this->base_model->query_out("1", "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['approved_requisitions'] = $this->base_model->query_out("1", "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['delivered_requisitions'] = $this->base_model->query_out("requisitions_status=3", "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['pending_requisitions'] = $this->base_model->query_out("requisitions_status=1", "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['pending_delivery_requisitions'] = $this->base_model->query_out("requisitions_status=2", "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['rejected_requisitions'] = $this->base_model->query_out("requisitions_status=0", "COUNT(`requisitions_id`) as `data`", "requisitions");
		}else{
			$emp_section = $this->base_model->query_out("`employee_information_id`=".$_SESSION['emp_id'], "`employee_section`", "employee_information");
			$section = $emp_section[0]['employee_section'];
			$data['total_requisitions'] = $this->base_model->query_out("`requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['approved_requisitions'] = $this->base_model->query_out("`requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['delivered_requisitions'] = $this->base_model->query_out("requisitions_status=3 AND `requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['pending_requisitions'] = $this->base_model->query_out("requisitions_status=1 AND `requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['pending_delivery_requisitions'] = $this->base_model->query_out("requisitions_status=2 AND `requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
			$data['rejected_requisitions'] = $this->base_model->query_out("requisitions_status=0 AND `requisitions_section`=".$section, "COUNT(`requisitions_id`) as `data`", "requisitions");
		}
		return $data;
	}

	public function dashboard_data()
	{
		$data['users'] = $this->model->fetchAndCount('users');
		$data['main_menu'] = $this->model->fetchAndCount('main_menu');
		$data['sub_menu'] = $this->model->fetchAndCount('sub_menu');
		$data['product'] = $this->model->fetchAndCount('product');
		$data['product_stocks'] = $this->base_model->query_out("1", "*", "product");
		return json_encode( $data );
	}

	public function topMenu()
	{
		$data = $this->model->fetch('top_menu');
		return json_encode( $data );
	}

	public function changepassword($id){
		$id = substr($id,32);
		$data = $this->base_model->query_out("user_id_md5='$id'", "*", "users");
		$this->view->admin('admin/changepassword',$data);
	}

	public function changepassword_action(){
		$data = $this->model->changepassword_action("users");
		$this->redirect('../dashboard/');
	}

	public function change_username_action(){
		$data = $this->model->change_username_action("users");
		$this->redirect('../dashboard/');
	}

	public function profile($id){
		$id = substr($id,32);
		$data = $this->base_model->query_out("user_id_md5='$id'", "*", "users");
		$this->view->admin('admin/profile',$data);
	}

	public function changePhoto(){
		$data = $this->model->changeAndUploadAndDelete();
		$this->redirect('profile/'.md5(rand()).md5($_SESSION['user_id']));
	}

	public function changeSignature(){
		$data = $this->model->changeAndUploadAndDeleteSignature();
		$this->redirect('profile/'.md5(rand()).md5($_SESSION['user_id']));
	}
}