<?php
	#include('function.php');
	#echo !extension_loaded('openssl')?"Not Available":"Available";
	ini_set('max_execution_time', '300');

	function sendEmail($email, $subject, $message)
	{
		require('phpmailer/PHPMailerAutoload.php');
		$mail = new PHPMailer;
		if(!$mail->validateAddress($email))
		{
			echo 'Invalid Email Address';
			exit;
		}
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 3; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // 587 for TLS, 465 for SSL, or 443
		$mail->IsHTML(true);
		#$mail->Username = "mailouwyzcourier@benilde.edu.ph";
		$mail->Username = "miac.11221127@gmail.com";
		#$mail->Password = "mailouwyz";
		$mail->Password = "damong_talahiban";
		$mail->SetFrom("miac.11221127@gmail.com");
		$mail->FromName = "The Administrator";
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($email);
		$mail->Send();
	}
	
	if(isset($_POST['submit']))
	{
		$email = "mark05ian95@gmail.com";
		$subject = "Change Password Request";
		$message = "This is your reset link: http://somelink.php?yes=yes";
		sendEmail($email, $subject, $message);
	}
?>
<html>
<head></head>
<body>
	<form method="POST">
		<input type="submit" name="submit" value="send email">
	</form>
</body>
</html>