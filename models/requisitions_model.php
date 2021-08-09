<?php
//requisitions Models
class requisitions_Model extends Model
{
	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
		require 'sms-gateway/sms.php';
	}

	public function save($table, $table_details)
	{
		$csrf_token_req_by_emp = $_POST['csrf_token_req_by_emp'];
		if ($csrf_token_req_by_emp == $_SESSION['csrf_token_req_by_emp']) {
			$requisitions_section = $_POST['requisitions_section'];
			$requisitions_employee = $_SESSION['emp_id'];
			$requisitions_date = $_POST['requisitions_date'];
			$requisitions_product_array = $_POST['requisitions_product'];
			$requisitions_product_qty_array = $_POST['requisitions_product_qty'];
			if (count($requisitions_product_array) > 0) {
				$stmt = $this->db->prepare("INSERT INTO `$table`(requisitions_section,requisitions_employee,requisitions_status,requisitions_date) VALUES ($requisitions_section,$requisitions_employee,1,'$requisitions_date')");
				if ($stmt->execute() === TRUE) {
					$requisitions_id = $this->db->lastInsertId();
					for ($i = 0; $i < count($requisitions_product_array); $i++) {
						$requisitions_product = $requisitions_product_array[$i];
						$requisitions_product_qty = $requisitions_product_qty_array[$i];
						$stmt_details = $this->db->prepare("INSERT INTO `$table_details`(requisitions_id,requisitions_product,requisitions_product_qty) VALUES ($requisitions_id,$requisitions_product,$requisitions_product_qty)");
						$stmt_details->execute();
					}
					return "SUCCESS";
				} else {
					return "FAILED";
				}
			} else {
				return "FAILED";
			}
		} else {
			return "FAILED_MAIN";
		}
	}

	function requisition_status_set($table, $requisitions_id)
	{
		$error = 0;
		$requisitions_id = $requisitions_id;
		$requisitions_product = $_POST['product_id_' . $requisitions_id];
		$requisitions_approve_product_qty = $_POST['product_qty_' . $requisitions_id];
		for ($i = 0; $i < count($requisitions_approve_product_qty); $i++) {
			$stmt_sub = $this->db->prepare("UPDATE `requisitions_details` SET requisitions_approve_product_qty=$requisitions_approve_product_qty[$i] WHERE requisitions_id=$requisitions_id AND requisitions_product=$requisitions_product[$i]");
			if ($stmt_sub->execute()) {
				$error = $error;
			} else {
				$error++;
			}
		}
		if ($error == 0) {
			$authdt = $this->db->prepare("SELECT requisitions_employee FROM requisitions WHERE requisitions_id=$requisitions_id");
			$authdt->execute();
			$authdts = $authdt->fetchObject();
			$auth = $authdts->requisitions_employee;

			$fEmail = $this->db->prepare("SELECT employee_email, employee_name_en, employee_mobile_personal FROM employee_information WHERE employee_information_id=$auth");
			$fEmail->execute();
			$dts = $fEmail->fetchObject();
			$name = $dts->employee_name_en;
			$email = $dts->employee_email; //"salmansajibro@gmail.com";
			$subject = 'Requisition Has been Approved!';
			$otp = mt_rand(1000, 9999);

			// SMS Send
// 			$messageBody = "Your Requisition has been Approved. OTP is ". $otp .". Please collect your Product using this OTP.";
            $messageBody = "আপনার চাহিদা পত্র অনুমোদিত হয়েছে। ওটিপি ".$otp." । ওটিপি ব্যবহার করে আপনার পণ্য সংগ্রহ করার জন্য অনুরোধ করা হলো।";
			$msisdn = $dts->employee_mobile_personal;
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
			$requisitions_approve_date = date("Y-m-d");
			$stmt_main = $this->db->prepare("UPDATE `$table` SET `requisitions_status`=2, `otp`='$otp', `requisitions_approve_date`='$requisitions_approve_date' WHERE `requisitions_id`=$requisitions_id");
			// $this->smtpmailer($email, $subject, $name, $otp);
			if ($stmt_main->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				unset($_SESSION['csrf_token_reset']);
				return 'FAILED1';
			}
		} else {
			return "FAILED2";
		}
	}

	function smtpmailer($to, $subject, $name, $otp)
	{
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'mail.mocatestore.gov.bd';
		$mail->SMTPAuth = true;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->Username = 'info@mocatestore.gov.bd';
		$mail->Password = 'Mehedi@1123';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		$mail->setFrom('info@mocatestore.gov.bd', 'MOCAT eStore');
		$mail->addReplyTo('info@mocatestore.gov.bd', 'Reply To');
		$mail->addAddress($to);

		$mail->isHTML(true);

		$bodyContent = '<p>Hello, ' . $name . '</p>';
		$bodyContent .= '<h1>Your Requisition has been Approved.</h1>';
		$bodyContent .= '<h3>We received a request for some products.</h3>';
		$bodyContent .= '<p><b>We approve that requisition. Now you Can Collect Product(s) from our Store Department.</b></p>';
		$bodyContent .= '<p>Your Product Receiving OTP : <strong> <b>' . $otp . '</b></strong></p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= '<p>Yours\'</p>';
		$bodyContent .= '<p>System Admin<br>MOPME eStore.</p>';

		$mail->Subject = $subject;
		$mail->Body = $bodyContent;

		if (!$mail->send()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function requisition_status_update($table, $requisitions_id, $status)
	{
		$stmt = $this->db->prepare("UPDATE `$table` SET requisitions_status=$status WHERE requisitions_id=$requisitions_id");
		if ($stmt->execute() === TRUE) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	function requisitions_report()
	{
		$csrf_token_search_requisitions = $_POST['csrf_token_search_requisitions'];
		if ($csrf_token_search_requisitions == $_SESSION['csrf_token_search_requisitions']) {
			$section = $_POST['section'];
			$from_date = $_POST['from_date'];
			$to_date = $_POST['to_date'];
			$return = array();
			if (isset($section) && $section != '') {
				$stmt = $this->db->prepare("SELECT `requisitions`.* FROM `requisitions` WHERE `requisitions_section`=$section AND `requisitions_date` BETWEEN '$from_date' AND '$to_date' ORDER BY `requisitions_section`");
			} else {
				$stmt = $this->db->prepare("SELECT `requisitions`.* FROM `requisitions` WHERE `requisitions_date` BETWEEN '$from_date' AND '$to_date' ORDER BY `requisitions_section`");
			}
			$stmt->execute();
			$data_main = $stmt->fetchAll();
			foreach ($data_main as $dls) {
				$data = array();
				$data['requisitions_id'] = $dls['requisitions_id'];
				$data['requisitions_section'] = $dls['requisitions_section'];
				$data['requisitions_employee'] = $dls['requisitions_employee'];
				$data['requisitions_receiver'] = $dls['requisitions_receiver'];
				$data['requisitions_status'] = $dls['requisitions_status'];
				$data['requisitions_date'] = $dls['requisitions_date'];
				$stmt_dls = $this->db->prepare("SELECT * FROM `requisitions_details` WHERE `requisitions_id`=" . $dls['requisitions_id']);
				$stmt_dls->execute();
				$data['details'] = $stmt_dls->fetchAll();
				array_push($return, $data);
			}
			return $return;
		} else {
			return "TOKEN";
		}
	}
}
