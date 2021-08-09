<?php
//employee_information Models
class employee_information_Model extends Model
{
	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
		require 'sms-gateway/sms.php';
	}

	public function save($table)
	{
		if ($_POST['csrf_token_employee_information'] == $_SESSION['csrf_token_employee_information']) {
			$employee_id = $_POST['employee_id'];
			$employee_section = $_POST['employee_section'];
			$employee_designation = $_POST['employee_designation'];
			$employee_name_en = $_POST['employee_name_en'];
			$employee_name_bn = $_POST['employee_name_bn'];

			$employee_photo_pre = $_FILES['employee_photo']['name'];
			$tmp_name_emp_photo = $_FILES['employee_photo']['tmp_name'];
			if ($employee_photo_pre != '') {
				$file_ext = explode('.', $employee_photo_pre);
				$file_ext = strtolower(end($file_ext));
				$employee_photo = md5(rand()) . '.' . $file_ext;
				move_uploaded_file($tmp_name_emp_photo, 'assets/user_photo/' . $employee_photo);
			} else {
				$employee_photo = '';
			}

			$employee_mobile_personal = $_POST['employee_mobile_personal'];
			$employee_phone_office = $_POST['employee_phone_office'];
			$employee_email = $_POST['employee_email'];

			$stmt = $this->db->prepare("INSERT INTO `$table`(employee_id, employee_section, employee_designation, employee_name_en, employee_name_bn, employee_photo, employee_mobile_personal, employee_phone_office, employee_email) VALUES ('$employee_id', $employee_section, $employee_designation, '$employee_name_en', '$employee_name_bn', '$employee_photo', '$employee_mobile_personal', '$employee_phone_office', '$employee_email')");
			
			if ($stmt->execute() === TRUE) {
				$user_emp_id = $this->db->lastInsertId();
				$full_name = $employee_name_en;
				// $username = $employee_mobile_personal == '' ? $employee_email : $employee_mobile_personal;
				$username = $employee_mobile_personal;
				$password = md5('mopme123456');
				$user_type = 6;
				$user_photo = $employee_photo;
				$stmt_user = $this->db->prepare("INSERT INTO `users`( `full_name`, `username`, `password`, `user_type`, `user_photo`, `user_emp_id`) VALUES ('$full_name', '$username', '$password', $user_type, '$user_photo',$user_emp_id)");
				$name = $employee_name_en;
				$email = $employee_email;
				$subject = 'Your Account Has been Created!';
				$pass = 'mopme123456';
				if ($stmt_user->execute() === TRUE) {
					$user_id = $this->db->lastInsertId();
					$user_id_md5 = md5($user_id);
					$upstmt = $this->db->prepare("UPDATE `users` SET `user_id_md5`='$user_id_md5' WHERE `user_id`=$user_id");
					if ($upstmt->execute() === TRUE) {
					    // SMS Send
					    // আপনার ই-স্টোর অ্যাকাউন্ট তৈরি করা হয়েছে। ই-স্টোর অ্যাকাউন্ট পাসওয়ার্ডটি "mocat123456"। লগইন করার পরে আপনার পাসওয়ার্ড পরিবর্তন করুন।
    				// 	$messageBody = "Your MOCAT e-Store Account Has been Created. Password is ". $pass ." Please Change Your Password after Login.";
    				    $messageBody = "আপনার ই-স্টোর অ্যাকাউন্ট তৈরি সম্পন্ন হয়েছে। পাসওয়ার্ড: ".$pass." প্রথমবার লগইন করার পরে পাসওয়ার্ড পরিবর্তন করে নিন।";
    					$msisdn = $employee_mobile_personal;
    					$csmsId = mt_rand(100000, 999999);
    					if($msisdn != ''){
    						$dd = singleSms($msisdn, $messageBody, $csmsId);
    						$return = json_decode($dd, true);
    						if(isset($return['status']) && $return['status'] == 'SUCCESS'){
    							$sms_status = $return['smsinfo'][0]['sms_status'];
    							$number_msisdn = $return['smsinfo'][0]['msisdn'];
    							$sms_body = $return['smsinfo'][0]['sms_body'];
    							$csms_id = $return['smsinfo'][0]['csms_id'];
    							$reference_id = $return['smsinfo'][0]['reference_id'];
    							
    							$stmt_sms = $this->db->prepare("INSERT INTO `smsinfo` SET `sms_status`='$sms_status', `number_msisdn`='$number_msisdn', `sms_body`='$sms_body', `csms_id`='$csms_id', `reference_id`='$reference_id'");
    							$stmt_sms->execute();
    						}
    					}
    					// SMS Send
                        if($email != ''){
    					    // $this->smtpmailer($email, $subject, $name, $pass);
                        }
						return 'SUCCESS';
					} else {
						$delstmt = $this->db->prepare("DELETE * FROM `users` WHERE `user_id`=$user_id");
						$delstmt->execute();
						return 'FAILED';
					}
				} else {
					unset($_SESSION['csrf_token_employee_information']);
					return 'FAILED_USER';
				}
			} else {
				unset($_SESSION['csrf_token_employee_information']);
				return 'FAILED_INSERT';
			}
		} else {
			unset($_SESSION['csrf_token_employee_information']);
			return 'FAILED_SESSION';
		}
	}

	function smtpmailer($to, $subject, $name, $otp)
	{
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'mail.motjdigitalstore.gov.bd';
		$mail->SMTPAuth = true;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->Username = 'info@motjdigitalstore.gov.bd';
		$mail->Password = 'mqMffWPPRLjo';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 26;

		$mail->setFrom('estore@mocat.gov.bd', 'MOCAT eStore');
		$mail->addReplyTo('estore@mocat.gov.bd', 'Reply To');
		$mail->addAddress($to);

		$mail->isHTML(true);

		$bodyContent = '<p>Hello, ' . $name . '</p>';
		$bodyContent .= '<h1>Your Account has been Created.</h1>';
		$bodyContent .= '<p><b>We approve that Account. Now you Can Make Requisitions and Collect Product(s) from our Store Department.</b></p>';
		$bodyContent .= '<p>Your Password is : <strong> <b>' . $otp . '</b></strong></p>';
		$bodyContent .= '<p>Please Login and Change Your Password First.</p>';
		$bodyContent .= '<p>Yours\'</p>';
		$bodyContent .= '<p>System Admin<br>MOCAT eStore.</p>';

		$mail->Subject = $subject;
		$mail->Body = $bodyContent;

		if (!$mail->send()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function update($id, $table)
	{
		$csrf_token = $_POST['csrf_token_' . $id];
		if ($csrf_token == $_SESSION['csrf_token_' . $id]) {
			$employee_id = $_POST['employee_id_' . $id];
			$employee_section = $_POST['employee_section_' . $id];
			$employee_designation = $_POST['employee_designation_' . $id];
			$employee_name_en = $_POST['employee_name_en_' . $id];
			$employee_name_bn = $_POST['employee_name_bn_' . $id];

			$employee_photo_pre = $_FILES['employee_photo_cng_' . $id]['name'];
			$tmp_name_emp_photo = $_FILES['employee_photo_cng_' . $id]['tmp_name'];
			if ($employee_photo_pre != '') {
				$file_ext = explode('.', $employee_photo_pre);
				$file_ext = strtolower(end($file_ext));
				$employee_photo = md5(rand()) . '.' . $file_ext;

				if (move_uploaded_file($tmp_name_emp_photo, 'assets/user_photo/' . $employee_photo)) {
					$employee_photo_old = $_POST['employee_photo_' . $id];
					if($employee_photo_old != ''){
						$photo_file = 'assets/user_photo/' . $employee_photo_old;
						if (file_exists($photo_file)) {
							unlink($photo_file);
						}
					}
				}
			} else {
				$employee_photo = $_POST['employee_photo_' . $id];
			}

			$employee_mobile_personal = $_POST['employee_mobile_personal_' . $id];
			$employee_phone_office = $_POST['employee_phone_office_' . $id];
			$employee_email = $_POST['employee_email_' . $id];

			$stmt = $this->db->prepare("UPDATE `$table` SET employee_id='$employee_id', employee_section=$employee_section, employee_designation=$employee_designation, employee_name_en='$employee_name_en', employee_name_bn='$employee_name_bn', employee_photo='$employee_photo', employee_mobile_personal='$employee_mobile_personal', employee_phone_office='$employee_phone_office', employee_email='$employee_email' WHERE employee_information_id=$id");
			if ($stmt->execute() === TRUE) {
				$full_name = $employee_name_en;
				$username = $employee_mobile_personal == '' ? $employee_email : $employee_mobile_personal;
				$user_photo = $employee_photo;
				$find_user = $this->db->prepare("SELECT * FROM `users` WHERE `user_emp_id`=$id");
				$find_user->execute();
				$dt_find = $find_user->fetchAll();
				if (count($dt_find) > 0) {
					$stmt_user = $this->db->prepare("UPDATE `users` SET full_name='$full_name', username='$username', user_photo='$user_photo' WHERE user_emp_id=$id");
					if ($stmt_user->execute() === TRUE) {
						unset($_SESSION['csrf_token_' . $id]);
						return 'SUCCESS';
					} else {
						unset($_SESSION['csrf_token_' . $id]);
						return 'FAILED_USER_UPDATE';
					}
				} else {
					$user_emp_id = $id;
					$password = md5('motj12345');
					$user_type = 6;
					$stmt_user = $this->db->prepare("INSERT INTO `users`( `full_name`, `username`, `password`, `user_type`, `user_photo`, `user_emp_id`) VALUES ('$full_name', '$username', '$password', $user_type, '$user_photo',$user_emp_id)");
					if ($stmt_user->execute() === TRUE) {
						$user_id = $this->db->lastInsertId();
						$user_id_md5 = md5($user_id);
						$upstmt = $this->db->prepare("UPDATE `users` SET `user_id_md5`='$user_id_md5' WHERE `user_id`=$user_id");
						if ($upstmt->execute() === TRUE) {
							return 'SUCCESS';
						} else {
							$delstmt = $this->db->prepare("DELETE * FROM `users` WHERE `user_id`=$user_id");
							$delstmt->execute();
							return 'FAILED';
						}
					}
				}
			} else {
				unset($_SESSION['csrf_token_' . $id]);
				return 'FAILED_UPDATE';
			}
		} else {
			unset($_SESSION['csrf_token_' . $id]);
			return 'FAILED_SESSION';
		}
	}

	public function update_status($table)
	{
		$id = $_POST['id'];
		$employee_information_status = $_POST['status'];
		if ($employee_information_status == 1) {
			$employee_information_status = 0;
		} else {
			$employee_information_status = 1;
		}

		$stmt = $this->db->prepare("UPDATE `$table` SET employee_information_status=$employee_information_status WHERE employee_information_id=$id");
		if ($stmt->execute() === TRUE) {
			return 'SUCCESS';
		} else {
			return 'FAILED';
		}
	}

	public function update_password()
	{
		$user_id = $_POST['user_id'];
		$user_id_md5 = $_POST['user_id_md5'];
		$username = $_POST['username'];
		$new_password = md5($_POST['new_password']);
		$stmt = $this->db->prepare("UPDATE `users` SET `password`='$new_password' WHERE `user_id`=$user_id AND `user_id_md5`='$user_id_md5' AND `username`='$username'");
		if ($stmt->execute() === TRUE) {
			return 'SUCCESS';
		} else {
			return 'FAILED';
		}
	}



	function update_user()
	{
		$user_id_md5 = $_POST['user_id'];

		if ($_POST['full_name'] != '' && $_POST['username'] != '' && $_POST['user_type'] != '') {
			$upstmt = $this->db->prepare("UPDATE `users` SET `full_name`='" . $_POST['full_name'] . "', `username`='" . $_POST['username'] . "', `user_type`='" . $_POST['user_type'] . "' WHERE `user_id_md5`='$user_id_md5'");
			if ($upstmt->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED01';
			}
		} elseif ($_POST['full_name'] == '' &&  $_POST['username'] == '') {
			$_SESSION['full_name'] = "Full Name Can not Empty";
			$_SESSION['username'] = "User Name Can not Empty";
			return 'FA ILED';
		} elseif ($_POST['full_name'] == '') {
			$_SESSION['full_name'] = "Full Name Can not Empty";
			return 'FAI LED';
		} elseif ($_POST['username'] == '') {
			$_SESSION['username'] = "User Name Can not Empty";
			return 'FAIL ED';
		} else {
			return 'FAILE D';
		}
	}

	function delete_user()
	{
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token' . $user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='3' WHERE `user_id_md5`='$user_id_md5'");
			if ($upstmt->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED';
			}
		} else {
			return 'FAILED';
		}
	}

	function undodelete_user()
	{
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token' . $user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='0' WHERE `user_id_md5`='$user_id_md5'");
			if ($upstmt->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED';
			}
		} else {
			return 'FAILED';
		}
	}

	function active_user()
	{
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token' . $user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='1' WHERE `user_id_md5`='$user_id_md5'");
			if ($upstmt->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED';
			}
		} else {
			return 'FAILED';
		}
	}
}
