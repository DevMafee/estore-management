<?php
//password_reset Models
class password_reset_Model extends Model
{
	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
		require 'sms-gateway/sms.php';
	}
	
	public function find_mail()
	{
		if ($_POST['csrf_token_reset']==$_SESSION['csrf_token_reset']) {
			$username = $_POST['username'];
			$findUser = $this->db->prepare("SELECT user_emp_id,user_id FROM users WHERE username='$username'");
			$findUser->execute();
			$dts = $findUser->fetchObject();
			$user_id = $dts->user_id;
			$auth = $dts->user_emp_id;
			$fEmail = $this->db->prepare("SELECT employee_email, employee_name_en, employee_mobile_personal FROM employee_information WHERE employee_information_id=$auth");
			$fEmail->execute();
			$dts = $fEmail->fetchObject();
			$name = $dts->employee_name_en;
			$email = $dts->employee_email;
			$subject = 'Password reset request';
			$password = substr(md5(microtime()),rand(0,26),6);

			$passwordmd5 = md5($password);

			// SMS Send
			$messageBody = "Your MOCAT e-Store Account Password has Been Changed! New Password is ". $password ." Please do not Share.";
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

			$stmt = $this->db->prepare("UPDATE `users` SET `password`='$passwordmd5' WHERE `user_id`=$user_id");

			if ( $this->smtpmailer( $email, $subject, $name, $password ) === TRUE && $stmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				unset($_SESSION['csrf_token_reset']);
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_reset']);
			return 'FAILED2';
		}
	}

	function smtpmailer($to, $subject, $name, $password) {
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

		$bodyContent = '<h1>Request to change your password?</h1>';
		$bodyContent = '<h3>We received a request to change your password</h3>';
		$bodyContent .= '<p>Hello, '.$name.'</p>';
		$bodyContent .= '<p>Here is your New Password - <b>'.$password.'</b></p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= '<p>Please Do not Share this mail or Password with anyone.</p>';
		$bodyContent .= '<p>Yours\'</p>';
		$bodyContent .= '<p>System Admin<br>MOCAT eStore.</p>';

		$mail->Subject = $subject;
		$mail->Body = $bodyContent;

		if( !$mail->send() ) {
			//exit( 'Error! Message could not be sent.' . $mail->ErrorInfo );
			// $error = 'Mail error: '.$mail->ErrorInfo;
			return FALSE;
		}
		else {
			//exit( 'Success! mail sent.' );
			// $error = 'Message sent!';
			return TRUE;
		}
	}
}