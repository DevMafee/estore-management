<?php
//stock_out Models
class stock_out_Model extends Model
{
	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
		require 'sms-gateway/sms.php';
	}

	function smtpmailer($to, $subject, $name)
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
		$bodyContent .= '<h1>Your Requisition has been Delivered.</h1>';
		$bodyContent .= '<h3>You Just received your Required products.</h3>';
		$bodyContent .= '<p>Thank you</p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= "<p>Yours\'</p>";
		$bodyContent .= '<p>System Admin<br>MOCAT eStore.</p>';

		$mail->Subject = $subject;
		$mail->Body = $bodyContent;

		if (!$mail->send()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function save($table)
	{
		// $csrf_token_stock_out_store_admin = $_POST['csrf_token_stock_out_store_admin'];
		// if ($csrf_token_stock_out_store_admin == $_SESSION['csrf_token_stock_out_store_admin']) {
		$stock_out_section = $_POST['stock_out_section'];
		$stock_out_requisition = $_POST['stock_out_requisition'];
		$stock_out_receiver = $_POST['stock_out_receiver'];
		if($stock_out_receiver == 'other_emp'){
			$stock_out_receiver = null;
			$other_receiver = $_POST['other_receiver'];
		}else{
			$other_receiver = null;
		}
		$stock_out_date = $_POST['stock_out_date'];
		$otp = $_POST['otp_'.$stock_out_requisition];
		
		$stock_out_entry = $_SESSION['emp_id'];
		$stock_out_details_product_array = $_POST['stock_out_details_product'];
		$stock_out_details_product_qty_array = $_POST['stock_out_details_product_qty'];
		$chk_query = $this->db->prepare("SELECT * FROM `requisitions` WHERE `otp`='$otp' AND `requisitions_id`=$stock_out_requisition");
		$chk_query->execute();
		$found_one = $chk_query->fetchAll();
		
		if(count($stock_out_details_product_qty_array)>0 && count($found_one)>0){
			$stmt = $this->db->prepare("INSERT INTO `$table`(stock_out_section,stock_out_requisition,stock_out_receiver,other_receiver,stock_out_entry,stock_out_date) VALUES ('$stock_out_section','$stock_out_requisition','$stock_out_receiver','$other_receiver','$stock_out_entry','$stock_out_date')");

			if ( $stmt->execute() === TRUE ) {
				$stock_out_details_stock_out_id = $this->db->lastInsertId();

				for($i=0; $i<count($stock_out_details_product_qty_array); $i++){
					$stock_out_details_product = $stock_out_details_product_array[$i];
					$stock_out_details_product_qty = $stock_out_details_product_qty_array[$i];
					$select_stock = $this->db->prepare("SELECT * FROM `stocks` WHERE stocks_product_id=$stock_out_details_product ORDER BY stocks_id DESC LIMIT 0,1");
					$select_stock->execute();
					$data_stock = $select_stock->fetchAll();
					if (count($data_stock)>0) {
						$stocks_pre_stock = $data_stock[0]['stocks_current_stock'];
						$stocks_trng_qty_out = $stock_out_details_product_qty;
						$stocks_current_stock = $stocks_pre_stock-$stocks_trng_qty_out;
						$stmt_stock = $this->db->prepare("INSERT INTO `stocks`(stocks_product_id,stocks_pre_stock,stocks_trng_qty_out,stocks_current_stock,stocks_trng_type,stocks_section) VALUES ($stock_out_details_product,'$stocks_pre_stock','$stocks_trng_qty_out','$stocks_current_stock','OUT',$stock_out_section)");
						$stmt_stock->execute();
					}else{
						$stocks_pre_stock = 0;
						$stocks_trng_qty_out = $stock_out_details_product_qty;
						$stocks_current_stock = $stocks_pre_stock-$stocks_trng_qty_out;
						$stmt_stock = $this->db->prepare("INSERT INTO `stocks`(stocks_product_id,stocks_pre_stock,stocks_trng_qty_out,stocks_current_stock,stocks_trng_type,stocks_section) VALUES ($stock_out_details_product,'$stocks_pre_stock','$stocks_trng_qty_out','$stocks_current_stock','OUT',$stock_out_section)");
						$stmt_stock->execute();
					}

					$stmt_details = $this->db->prepare("INSERT INTO `stock_out_details`(stock_out_details_stock_out_id,stock_out_details_product,stock_out_details_product_qty) VALUES ($stock_out_details_stock_out_id,$stock_out_details_product,$stock_out_details_product_qty)");
					$stmt_details->execute();
				}
				$requisitions_delivery_date = date("Y-m-d");
				$updt_stmnt = $this->db->prepare("UPDATE `requisitions` SET `requisitions_status`=3, `requisitions_receiver`='$stock_out_receiver', `other_receiver`='$other_receiver', `requisitions_delivery_date`='$requisitions_delivery_date' WHERE requisitions_id=$stock_out_requisition");
				
				if($updt_stmnt->execute()){
					// Send Email 
					$authdt = $this->db->prepare("SELECT requisitions_employee FROM requisitions WHERE requisitions_id=$stock_out_requisition");
					$authdt->execute();
					$authdts = $authdt->fetchObject();
					$auth = $authdts->requisitions_employee;
					$fEmail = $this->db->prepare("SELECT employee_email, employee_name_en, employee_mobile_personal FROM employee_information WHERE employee_information_id=$auth");
					$fEmail->execute();
					$dts = $fEmail->fetchObject();
					$name = $dts->employee_name_en;
					$email = $dts->employee_email;
					$subject = 'Requisition Has been Delivered!';
					// $this->smtpmailer($email, $subject, $name);
					// SMS Send
					$messageBody = "আপনার চাহিত পণ্যসমূহ সফলভাবে সরবরাহ করা হয়েছে। ই-স্টোর ম্যানেজমেন্ট সিস্টেম ব্যবহার করার জন্য আপনাকে ধন্যবাদ।";
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
					return "SUCCESS";
				}
			}else{
				return "FAILED2";
			}
		}else{
			return "FAILED";
		}
		// }else{
		// 	return "FAILED_MAIN";
		// }
	}
	
}