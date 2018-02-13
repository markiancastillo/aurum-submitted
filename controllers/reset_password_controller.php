<?php
	include('config.php');
	include('security.php');

	$msgDisplay = "";
	$msgMismatch = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Password mismatch. Please make sure that the password and confirm password match.
					</div>";
	$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						There was an error updating your password.
					</div>";					

	if(isset($_POST['btnChange']))
	{
		$inpPW = base64_encode(openssl_encrypt($_POST['inpPW'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpCPW = base64_encode(openssl_encrypt($_POST['inpCPW'], $method, $password, OPENSSL_RAW_DATA, $iv));

		#input and confirm password must match
		if(strcmp(trim($inpPW), trim($inpCPW)) == 0)
		{
			#match; get data from reset url
			$accountID = openssl_decrypt(base64_decode($_GET['id']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountEmail = $_GET['request'];

			#update the password in the database
			$sql_change = "UPDATE accounts SET accountPassword = ? 
						   WHERE accountID = ? AND accountEmail = ?";
			$params_change = array($inpPW, $accountID, $accountEmail);
			$stmt_change = sqlsrv_query($con, $sql_change, $params_change);

			if($stmt_change === false)
			{
				$msgDisplay = $msgError;
			}
			else 
			{
				header('location: login.php?reset=success');
			}
		}
		else
		{
			#mismatch
			$msgDisplay = $msgMismatch;
		}
	}
?>