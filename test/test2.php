<?php
	include('function.php');
	#echo !extension_loaded('openssl')?"Not Available":"Available";
	ini_set('max_execution_time', '300');
	
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