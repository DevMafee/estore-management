<?php
//Company_Settings Models
class Company_Settings_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$company_settings_name = $_POST['company_settings_name'];
		$company_settings_address = $_POST['company_settings_address'];
		$company_settings_email = $_POST['company_settings_email'];
		$company_settings_phone = $_POST['company_settings_phone'];
		$company_settings_website = $_POST['company_settings_website'];
		$company_settings_fb = $_POST['company_settings_fb'];
		$company_settings_twitter = $_POST['company_settings_twitter'];
		$company_settings_youtube = $_POST['company_settings_youtube'];

		//For_Image_Files
		$file_tmp_name 	= $_FILES['company_settings_logo']['tmp_name'];
		$name 			= $_FILES['company_settings_logo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$company_settings_logo= md5(rand()).'.'.$file_ext;

		if ($name == '') {
			$company_settings_logo = 'demo.png';
		}
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(`company_settings_name`, `company_settings_logo`, `company_settings_address`, `company_settings_phone`, `company_settings_email`, `company_settings_website`, `company_settings_fb`, `company_settings_twitter`, `company_settings_youtube`) VALUES ('$company_settings_name', '$company_settings_logo', '$company_settings_address', '$company_settings_phone', '$company_settings_email', '$company_settings_website', '$company_settings_fb', '$company_settings_twitter', '$company_settings_youtube')");
		if ( $stmt->execute() === TRUE ) {
			move_uploaded_file($file_tmp_name, 'assets/company_settings_logo/'.$company_settings_logo);
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$company_settings_id = $_POST['company_settings_id'];
		$company_settings_name = $_POST['company_settings_name'];
		$company_settings_address = $_POST['company_settings_address'];
		$company_settings_email = $_POST['company_settings_email'];
		$company_settings_phone = $_POST['company_settings_phone'];
		$company_settings_website = $_POST['company_settings_website'];
		$company_settings_status = $_POST['company_settings_status'];
		$company_settings_logo_pre = $_POST['company_settings_logo_pre'];
		$company_settings_fb = $_POST['company_settings_fb'];
		$company_settings_twitter = $_POST['company_settings_twitter'];
		$company_settings_youtube = $_POST['company_settings_youtube'];

		//For_Image_Files
		$file_tmp_name 	= $_FILES['company_settings_logo']['tmp_name'];
		$name 			= $_FILES['company_settings_logo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$company_settings_logo= md5(rand()).'.'.$file_ext;

		if ($name == '') {
			$company_settings_logo = $company_settings_logo_pre;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET `company_settings_name`='$company_settings_name', `company_settings_logo`='$company_settings_logo', `company_settings_address`='$company_settings_address', `company_settings_phone`='$company_settings_phone', `company_settings_email`='$company_settings_email', `company_settings_website`='$company_settings_website', `company_settings_fb`='$company_settings_fb', `company_settings_twitter`='$company_settings_twitter', `company_settings_youtube`='$company_settings_youtube', `company_settings_status`='$company_settings_status' WHERE `company_settings_id`=$company_settings_id");
		if ( $stmt->execute() === TRUE ) {
			if ($name != '') {
				move_uploaded_file($file_tmp_name, 'assets/company_settings_logo/'.$company_settings_logo);
				$pre_file_link = 'assets/company_settings_logo/'.$company_settings_logo_pre;
				if (file_exists($pre_file_link) && $company_settings_logo_pre != 'logo.png') {
					if (unlink($pre_file_link)) {
						$data = "SUCCESS";
					}else{
						$data = "FAILED1";
					}
				}else{
					$data = "SUCCESS";
				}
			}else{
				$data = "SUCCESS";
			}
		}else{
			$data = 'FAILED2';
		}
		return $data;
	}


	public function updateemail($table)
	{
		//Fields_name_of_Carrying_fields
		$company_settings_id = $_POST['company_settings_id'];
		$hostname = $_POST['hostname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sentfrom = $_POST['sentfrom'];
		$senttitle = $_POST['senttitle'];
		$replyto = $_POST['replyto'];

		$stmt = $this->db->prepare("UPDATE `$table` SET `hostname`='$hostname', `username`='$username', `password`='$password', `sentfrom`='$sentfrom', `senttitle`='$senttitle', `replyto`='$replyto' WHERE `company_settings_id`=$company_settings_id");
		if ( $stmt->execute() === TRUE ) {
			$data = "SUCCESS";
		}else{
			$data = 'FAILED2';
		}
		return $data;
	}
	
}