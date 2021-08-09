<?php
//Dashboard Model
class Dashboard_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function changeAndUploadAndDelete(){
		$user_photo_pre	= $_POST['user_photo_pre'];
		$user_id 		= $_POST['user_id'];
		$file_tmp_name 	= $_FILES['user_photo']['tmp_name'];
		$name 			= $_FILES['user_photo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$file_name		= md5(rand()).'.'.$file_ext;

		$stmt = $this->db->prepare("UPDATE `users` SET `user_photo`='$file_name' WHERE `user_id`=$user_id");
		if ($stmt->execute()) {
			move_uploaded_file($file_tmp_name, 'assets/user_photo/'.$file_name);
			$pre_file_link = 'assets/user_photo/'.$user_photo_pre;
			if (file_exists($pre_file_link)) {
				if (unlink($pre_file_link)) {
					$_SESSION['user_photo'] = $file_name;
					$data = "SUCCESS";
				}else{
					$data = "FAILED";
				}
			}else{
				$_SESSION['user_photo'] = $file_name;
				$data = "SUCCESS";
			}
		}else{
			$_SESSION['user_photo'] = $file_name;
			$data = "SUCCESS";
		}
		return $data;
	}

	public function changeAndUploadAndDeleteSignature(){
		$user_photo_pre	= $_POST['user_signature_pre'];
		$user_id 		= $_POST['user_id'];
		$file_tmp_name 	= $_FILES['user_signature']['tmp_name'];
		$name 			= $_FILES['user_signature']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$file_name		= md5(rand()).'.'.$file_ext;

		$stmt = $this->db->prepare("UPDATE `users` SET `user_signature`='$file_name' WHERE `user_id`=$user_id");
		if ($stmt->execute()) {
			move_uploaded_file($file_tmp_name, 'assets/user_photo/'.$file_name);
			$pre_file_link = 'assets/user_photo/'.$user_photo_pre;
			if ($user_photo_pre != '' && file_exists($pre_file_link)) {
				if (unlink($pre_file_link)) {
					$data = "SUCCESS";
				}else{
					$data = "FAILED";
				}
			}else{
				$data = "SUCCESS";
			}
		}else{
			$data = "SUCCESS";
		}
		return $data;
	}

	public function changepassword_action(){
		$user_id_md5	= $_POST['user_id'];
		$old_password	= md5($_POST['old_password']);
		$new_password	= $_POST['new_password'];
		$retype_new_password	= $_POST['retype_new_password'];

		$stmt_find = $this->db->prepare("SELECT * FROM `users` WHERE `user_id_md5`='$user_id_md5' AND password='$old_password'");
		$stmt_find->execute();
		$pw_data = $stmt_find->fetchAll();
		
		if (count($pw_data) == 1 && $new_password == $retype_new_password) {
			$password = md5($new_password);
			$stmt = $this->db->prepare("UPDATE `users` SET `password`='$password' WHERE `user_id_md5`='$user_id_md5'");
			if ($stmt->execute()) {
				$data = "SUCCESS";
			}else{
				$data = "FAILED";
			}
		}		
		return $data;
	}

	public function change_username_action(){
		$user_id_md5	= $_POST['user_id_md5'];
		$user_id	= $_POST['user_id'];
		$old_username	= $_POST['old_username'];
		$new_username	= $_POST['new_username'];
		$employee_id	= $_POST['employee_id'];

		$stmt_find = $this->db->prepare("SELECT * FROM `users` WHERE user_id=$user_id AND  user_id_md5='$user_id_md5' AND username='$old_username'");
		$stmt_find->execute();
		$pw_data = $stmt_find->fetchAll();
		
		if (count($pw_data) == 1 && $new_username) {
			$username = $new_username;
			$stmt = $this->db->prepare("UPDATE `users` SET `username`='$username' WHERE user_id=$user_id AND  user_id_md5='$user_id_md5'");
			if ($stmt->execute()) {
				$user_emp_id = $pw_data[0]['user_emp_id'];
				if ($employee_id == 'YES') {
					$stmt_emp = $this->db->prepare("UPDATE `employee_information` SET `employee_id`='$username' WHERE employee_information_id=$user_emp_id");
					$stmt_emp->execute();
				}
				$data = "SUCCESS";
			}else{
				$data = "FAILED";
			}
		}else{
			$data = "FAILED";
		}		
		return $data;
	}



	
}