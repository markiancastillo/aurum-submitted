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
		#$encrypted = "D3q2n08uyWwgdrfBUFuYZp132iMVRnXq7tpEUwNjzGc=";
		
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
	echo $_SERVER['DOCUMENT_ROOT'] . '/css/bootstrap.css';

	$date1 = new DateTime("2018-03-30");
	$date2 = new DateTime("2018-03-13");

	$diff = $date2->diff($date1)->format("%a");

	echo '<br><BR>date difference: ' . $diff;

	if($date1 >= $date2)
	{
		echo '<br>invalid coverage';
	}
	else
	{
		echo '<br>date valid';
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
	<table width="50%">
		<tr>
			<td>OR #</td>
			<td></td>
		</tr>
		<tr>
			<td>Date</td>
			<td>03/01/2018</td>
		</tr>
		<tr>
			<td>Account</td>
			<td>Jane Lilith Doe</td>
		</tr>
			<td>Case</td>
			<td>Sample Case 001</td>
		</tr>
		<tr>
			<td>Type</td>
			<td>Out of Pocket Expense Reimbursement</td>
		</tr>
	</table>
</body>
</html>