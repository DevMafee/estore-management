<?php
//password_reset Models
class password_reset_Model extends Model
{
	function __construct()
	{
		parent::__construct();
		require 'php-mailer/PHPMailer/PHPMailerAutoload.php';
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
			$fEmail = $this->db->prepare("SELECT employee_email,employee_name_en FROM employee_information WHERE employee_information_id=$auth");
			$fEmail->execute();
			$dts = $fEmail->fetchObject();
			$name = $dts->employee_name_en;
			$email = $dts->employee_email;
			$from = 'salmansajibro@gmail.com';
			$from_name = 'System Admin of MOTJ';
			$subject = 'Password reset request';
			$password = substr(md5(microtime()),rand(0,26),6);

			//return $password;
			//return $this->smtpmailer($email, $from, $from_name, $subject, $name, $password);
			$passwordmd5 = md5($password);
			$stmt = $this->db->prepare("UPDATE `users` SET `password`='$passwordmd5' WHERE `user_id`=$user_id");

			if ( $this->smtpmailer( $email, $from, $from_name, $subject, $name, $password ) === TRUE && $stmt->execute() === TRUE ) {
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

	function smtpmailer($to, $from, $from_name, $subject, $name, $password) {
		$mail = new PHPMailer;

		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		$mail->Username = 'salmansajibro@gmail.com'; // SMTP username
		$mail->Password = '21042013mafee'; // SMTP password
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to

		$mail->setFrom( 'admin@motjdigitalstore.gov.bd', 'Sent From' );
		$mail->addReplyTo( 'admin@motjdigitalstore.gov.bd', 'Reply To' );
		$mail->addAddress( $to ); // Add a recipient
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		$mail->isHTML( true ); // Set email format to HTML

		$bodyContent = '<h1>Request to change your password?</h1>';
		$bodyContent = '<h3>We received a request to change your password</h3>';
		$bodyContent .= '<p>Hello, '.$name.'</p>';
		$bodyContent .= '<p>Here is your New Password - <b>'.$password.'</b></p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= '<p></p>';
		$bodyContent .= '<p>Please Do not Share this mail or Password with anyone.</p>';
		$bodyContent .= '<p>Yours\'</p>';
		$bodyContent .= '<p>System Admin<br>MOTJ Digital Store.</p>';

		$mail->Subject = $subject;
		$mail->Body = $bodyContent;

		if( !$mail->send() ) {
			//exit( 'Error! Message could not be sent.' . $mail->ErrorInfo );
			$error = 'Mail error: '.$mail->ErrorInfo;
			return FALSE;
		}
		else {
			//exit( 'Success! mail sent.' );
			$error = 'Message sent!';
			return TRUE;
		}
	}
}