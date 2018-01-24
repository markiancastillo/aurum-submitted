<?php

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
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 443; // or 587
		$mail->IsHTML(true);
		$mail->Username = "miac.11221127@gmail.com";
		$mail->Password = "damong_talahiban";
		$mail->SetFrom("noreply@aurum");
		$mail->FromName = "Aurum System";
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($email);
		$mail->Send();
	}
?>