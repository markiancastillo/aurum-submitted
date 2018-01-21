<?php
	include('config.php');
	include('security.php');
	session_start();

	if(isset($_POST['btnChange']))
	{
		$accID = $_SESSION['accID'];
		$inpCurrent = base64_encode(openssl_encrypt($_POST['inpCurrent'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpNew = base64_encode(openssl_encrypt($_POST['inpNew'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpConfirm = base64_encode(openssl_encrypt($_POST['inpConfirm'], $method, $password, OPENSSL_RAW_DATA, $iv));

		#check if input from current password matches password from db
		$sql_checkpw = "SELECT accountPassword FROM accounts WHERE accountID = ?";
		$params_checkpw = array($accID);
		$options_checkpw = array('Scrollable'=>'static');
		$stmt_checkpw = sqlsrv_query($con, $sql_checkpw, $params_checkpw, $options_checkpw);

		while($row = sqlsrv_fetch_array($stmt_checkpw))
		{
			$currentPW = $row['accountPassword'];
		
			if(strcasecmp(trim($inpCurrent), trim($currentPW)) == 0)
				{
					echo "current password input matches with record in db <br>";
	
				#check if input in new and confirm match
				if(strcasecmp(trim($inpNew), trim($inpConfirm)) == 0)
				{
					echo "password input matches <br>";
				}
				else
				{
					echo "password input mismatch. Please check your input and try again <br>";
				}
			}
			else
			{
				echo "current password input and record mismatch. Please check your input <br>";
			}
		}
	}
?>