<?php
//suppliers Models
class suppliers_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_suppliers']==$_SESSION['csrf_token_suppliers']) {
			$suppliers_en = $_POST['suppliers_en'];
			$suppliers_bn = $_POST['suppliers_bn'];

			$suppliers_photo_pre = $_FILES['suppliers_photo']['name'];
			$tmp_name_sup_photo = $_FILES['suppliers_photo']['tmp_name'];
			if ($suppliers_photo_pre != '') {
				$file_ext = explode('.', $suppliers_photo_pre);
				$file_ext = strtolower(end($file_ext));
				$suppliers_photo = md5(rand()).'.'.$file_ext;
				move_uploaded_file($tmp_name_sup_photo, 'assets/suppliers_photo/'.$suppliers_photo);
			}else{
				$suppliers_photo = '';
			}

			$suppliers_mobile_personal = $_POST['suppliers_mobile_personal'];
			$suppliers_phone_business = $_POST['suppliers_phone_business'];
			$suppliers_fax = $_POST['suppliers_fax'];
			$suppliers_email = $_POST['suppliers_email'];
			$suppliers_address = $_POST['suppliers_address'];
			$suppliers_nid_no = $_POST['suppliers_nid_no'];

			$employee_nid_pre = $_FILES['suppliers_nid_file']['name'];
			$tmp_name_sup_nid = $_FILES['suppliers_nid_file']['tmp_name'];
			if ($employee_nid_pre != '') {
				$file_ext = explode('.', $employee_nid_pre);
				$file_ext = strtolower(end($file_ext));
				$suppliers_nid_file = md5(rand()).'.'.$file_ext;
				move_uploaded_file($tmp_name_sup_nid, 'assets/suppliers_photo/'.$suppliers_nid_file);
			}else{
				$suppliers_nid_file = '';
			}

			$stmt = $this->db->prepare("INSERT INTO `$table`(`suppliers_en`, `suppliers_bn`, `suppliers_mobile_personal`, `suppliers_phone_business`, `suppliers_fax`, `suppliers_email`, `suppliers_address`, `suppliers_nid_no`, `suppliers_nid_file`, `suppliers_photo`) VALUES ('$suppliers_en','$suppliers_bn','$suppliers_mobile_personal','$suppliers_phone_business','$suppliers_fax','$suppliers_email','$suppliers_address','$suppliers_nid_no','$suppliers_nid_file','$suppliers_photo')");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_suppliers']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_suppliers']);
			return 'FAILED2';
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_suppliers_'.$id];
		if ($csrf_token == $_SESSION['csrf_token_suppliers_'.$id]) {
			unset($_SESSION['csrf_token_suppliers_'.$id]);
			$suppliers_en = $_POST['suppliers_en_'.$id];
			$suppliers_bn = $_POST['suppliers_bn_'.$id];
			$suppliers_mobile_personal = $_POST['suppliers_mobile_personal_'.$id];
			$suppliers_phone_business = $_POST['suppliers_phone_business_'.$id];

			$suppliers_photo_pre = $_FILES['suppliers_photo_cng_'.$id]['name'];
			$tmp_name_sup_photo = $_FILES['suppliers_photo_cng_'.$id]['tmp_name'];
			if ($suppliers_photo_pre != '') {
				$file_ext = explode('.', $suppliers_photo_pre);
				$file_ext = strtolower(end($file_ext));
				$suppliers_photo = md5(rand()).'.'.$file_ext;

				if(move_uploaded_file($tmp_name_sup_photo, 'assets/suppliers_photo/'.$suppliers_photo)){
					$suppliers_photo_old = $_POST['suppliers_photo_'.$id];
					$photo_file = 'assets/suppliers_photo/'.$suppliers_photo_old;
					if (file_exists($photo_file)) {
						unlink($photo_file);
					}
				}
			}else{
				$suppliers_photo = $_POST['suppliers_photo_'.$id];
			}

			$suppliers_fax = $_POST['suppliers_fax_'.$id];
			$suppliers_email = $_POST['suppliers_email_'.$id];
			$suppliers_address = $_POST['suppliers_address_'.$id];
			$suppliers_nid_no = $_POST['suppliers_nid_no_'.$id];


			$employee_nid_pre = $_FILES['suppliers_nid_file_cng_'.$id]['name'];
			$tmp_name_sup_nid = $_FILES['suppliers_nid_file_cng_'.$id]['tmp_name'];
			if ($employee_nid_pre != '') {
				$file_ext = explode('.', $employee_nid_pre);
				$file_ext = strtolower(end($file_ext));
				$suppliers_nid_file = md5(rand()).'.'.$file_ext;
				if(move_uploaded_file($tmp_name_sup_nid, 'assets/suppliers_photo/'.$suppliers_nid_file)){
					$suppliers_nid_file_old = $_POST['suppliers_nid_file_'.$id];
					$nid_file = 'assets/suppliers_photo/'.$suppliers_nid_file_old;
					if (file_exists($nid_file)) {
						unlink($nid_file);
					}
				}
			}else{
				$suppliers_nid_file = $_POST['suppliers_nid_file_'.$id];
			}

			$stmt = $this->db->prepare("UPDATE `$table` SET suppliers_en='$suppliers_en', suppliers_bn='$suppliers_bn', suppliers_mobile_personal='$suppliers_mobile_personal', suppliers_phone_business='$suppliers_phone_business', suppliers_photo='$suppliers_photo', suppliers_fax='$suppliers_fax', suppliers_email='$suppliers_email', suppliers_address='$suppliers_address', suppliers_nid_no='$suppliers_nid_no', suppliers_nid_file='$suppliers_nid_file' WHERE suppliers_id=$id");
			if ( $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_suppliers_'.$id]);
			return 'FAILED2';
		}
	}

	public function update_status($table)
	{
		$id = $_POST['id'];
		$suppliers_status = $_POST['status'];
		if ($suppliers_status == 1) {
			$suppliers_status = 0;
		}else{
			$suppliers_status = 1;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET suppliers_status=$suppliers_status WHERE suppliers_id=$id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}