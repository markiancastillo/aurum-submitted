<?php
#	$plaintext = '11_20180131083028-Capture.PNG';
	$password = '3sc3RLrpd17';
	$method = 'aes-256-cbc';
	
	if(isset($_POST['submit']))
	{
		$plaintext = $_POST['pt'];
		// Must be exact 32 chars (256 bit)
		$password = substr(hash('sha256', $password, true), 0, 32);
		echo "Password: " . $password . "<br />";
		
		// IV must be exact 16 chars (128 bit)
		$iv = chr(0x74) . chr(0x68) . chr(0x69) . chr(0x73) . chr(0x49) . chr(0x73) . chr(0x41) . chr(0x53) . chr(0x65) . chr(0x63) . chr(0x72) . chr(0x65) . chr(0x74) . chr(0x4b) . chr(0x65) . chr(0x79);
	
		// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
		$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
		#$encrypted = "+R6H8qVnsAtS+4BjOylE6A==";
		
		// My secret message 1234
		$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
		
		echo 'cipher= ' . $method . "<br /><br />";
		echo 'plaintext= ' . $plaintext . "<br />";
		echo 'encrypted to: ' . $encrypted . "<br />";
		echo 'decrypted to: ' . $decrypted . "<br /><br />";
		echo 'encrypted string length: ' . strlen($encrypted) . "<br><br>";
	
		echo 'string compare: ' . strcasecmp("M", "M") . '<br>';
		if(strcasecmp("m", "M") == 0)
		{
			echo "MMMM";
		}
		else 
		{
			echo "WWWW";
		}

		$whereStmt = "";
		for($i=0; $i<=5; $i++)
		{
			$whereStmt .= " or id=" . $i;
		}
		echo $whereStmt;

	}

	if(isset($_REQUEST['name']))
	{
		$name = $_REQUEST['name'];
		echo '<br><br><br>Request name: ' . $name . '<br>';
	}

	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
		if($num == 1)
		{
			echo '<br><br><br>The num is 1';
		}
		else 
		{
			header('location: test2.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test encryption/decryption</title>
</head>
<body>
	<hr>
	<form method="POST">
		<p>Plain Text: <input type="text" name="pt" id="pt"></p>
		<p><input type="submit" name="submit" value="submit"></p>
	</form>
</body>
</html>