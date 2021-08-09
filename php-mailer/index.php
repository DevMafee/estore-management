<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$email = $_POST['email'];
	require 'PHPMailer/PHPMailerAutoload.php';
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
	//$mail->Username = 'username@email.com'; // SMTP username
	$mail->Username = 'salmansajibro@gmail.com'; // SMTP username
	// $mail->Password = 'thisissecret'; // SMTP password
	$mail->Password = '21042013mafee'; // SMTP password
	$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587; // TCP port to connect to

	$mail->setFrom( 'dev@mobarok.com', 'Sent From' );
	$mail->addReplyTo( 'dev@mobarok.com', 'Reply To' );
	$mail->addAddress( $email ); // Add a recipient
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	$mail->isHTML( true ); // Set email format to HTML

	$bodyContent = '<h1>How to Send HTML Email using PHPMailer</h1>';
	$bodyContent .= '<p>This is an html template email.</p>';

	$mail->Subject = 'Email using PHPMailer';
	$mail->Body = $bodyContent;

	if( !$mail->send() ) {
		exit( 'Error! Message could not be sent.' . $mail->ErrorInfo );
	}
	else {
		exit( 'Success! mail sent.' );
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHPMailer - Test Project</title>
</head>
<body>
	<form action="" method="POST">
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" placeholder="Enter email">
		<p><input type="submit" value="Send email" /></p>
	</form>
</body>
</html>