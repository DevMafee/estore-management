<?php
//Login Model
class Login_Model extends Model
{

	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
		require 'sms-gateway/sms.php';
	}

	public function login($table, $un_field, $up_field)
	{
		if (isset($_SESSION['csrf_token_login']) && $_SESSION['csrf_token_login'] == $_POST['csrf_token_login']) {
			$stmt = $this->db->prepare("SELECT * FROM `$table` WHERE `$un_field`=:username AND `$up_field`=:password");

			$stmt->execute(array(
				':username'	=>	$_POST['username'],
				':password'	=>	md5($_POST['password'])
			));
			$data = $stmt->fetchAll();

			$count = $stmt->rowCount();
			if ($count > 0) {
			    
			    
			 //   $otp = mt_rand(1000, 9999);
    // 			// SMS Send
    // 			$messageBody = "Your Requisition has been Approved. OTP is ". $otp .". Please collect your Product using this OTP.";
    // 			$msisdn = '01711033730';
    // 			$csmsId = mt_rand(100000, 999999);
    // 			if($msisdn != ''){
    // 				$dd = singleSms($msisdn, $messageBody, $csmsId);
    // 				$return = json_decode($dd, true);
    // 				if(isset($return['status']) && $return['status'] == 'SUCCESS'){
    // 					$sms_status = $return['smsinfo'][0]['sms_status'];
    // 					$number_msisdn = $return['smsinfo'][0]['msisdn'];
    // 					$sms_body = $return['smsinfo'][0]['sms_body'];
    // 					$csms_id = $return['smsinfo'][0]['csms_id'];
    // 					$reference_id = $return['smsinfo'][0]['reference_id'];
    					
    // 					$stmt_sms = $this->db->prepare("INSERT INTO `smsinfo` SET `sms_status`='$sms_status', `number_msisdn`='$number_msisdn', `sms_body`='$sms_body', `csms_id`='$csms_id', `reference_id`='$reference_id'");
    // 					$stmt_sms->execute();
    // 				}
    // 			}
    // 			// SMS Send
			    
			    
			    
				Session::set('loggedIn', true);
				$data = json_encode($data);
				$data = json_decode($data);
				Session::set('section_en', 'DEVELOPMENT');
				Session::set('section_bn', 'DEVELOPMENT');
				Session::set('designation_en', 'SUPER ADMIN');
				Session::set('designation_bn', 'SUPER ADMIN');
				Session::set('employee_name_en', 'Md Salman Sajib');
				Session::set('employee_name_bn', 'Md Salman Sajib');
				foreach ($data as $user) {
					$empInfo = $this->db->prepare("SELECT * FROM `employee_information` WHERE `employee_information_id`=" . $user->user_emp_id);
					$empInfo->execute();
					$info = $empInfo->fetchAll();
					if (count($info) > 0) {
						foreach ($info as $em) {
							Session::set('section_id', $em['employee_section']);
							$secInfo = $this->db->prepare("SELECT section_en,section_bn FROM `section` WHERE `section_id`=" . $em['employee_section']);
							$secInfo->execute();
							$sec = $secInfo->fetchAll();
							foreach ($sec as $s) {
								Session::set('section_en', $s['section_en']);
								Session::set('section_bn', $s['section_bn']);
							}

							$desInfo = $this->db->prepare("SELECT designation_en, designation_bn FROM `designation` WHERE `designation_id`=" . $em['employee_designation']);
							$desInfo->execute();
							$des = $desInfo->fetchAll();
							foreach ($des as $d) {
								Session::set('designation_en', $d['designation_en']);
								Session::set('designation_bn', $d['designation_bn']);
							}

							Session::set('employee_name_en', $em['employee_name_en'] != '' ? $em['employee_name_en'] : '');
							Session::set('employee_name_bn', $em['employee_name_bn'] != '' ? $em['employee_name_bn'] : '');
						}
					}
					Session::set('emp_id', $user->user_emp_id);
					Session::set('user_id', $user->user_id);
					Session::set('username', $user->username);
					Session::set('user_type', $user->user_type);
					Session::set('user_photo', $user->user_photo);
					Session::set('lang', 'bn');
				}
				return 'SUCCESS';
			} else {
				return 'FAILRD';
			}
		}
	}
}
