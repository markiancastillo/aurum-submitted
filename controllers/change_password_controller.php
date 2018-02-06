<?php
	include('function.php');
	include('config.php');
	include('security.php');

	$msgDisplay = "";
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

		$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Please make sure that the new password and confirm password match.
					</div>";
		$msgPWError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Your input for current password is incorrect. Please try again.
					</div>";		

		while($row = sqlsrv_fetch_array($stmt_checkpw))
		{
			$currentPW = $row['accountPassword'];
		
			if(strcasecmp(trim($inpCurrent), trim($currentPW)) == 0)
			{
				#current password input matches with record in db
				#check if input in new and confirm match
				if(strcasecmp(trim($inpNew), trim($inpConfirm)) == 0)
				{
					#password input matches; 
					#update the password with the new one
					$sql_updpw = "UPDATE accounts SET accountPassword = ? WHERE accountID = ?";
					$params_updpw = array($inpNew, $accID);
					$stmt_updpw = sqlsrv_query($con, $sql_updpw, $params_updpw);

					$txtEvent = "User with ID # " . $accID . " updated their password.";
					logEvent($con, $accID, $txtEvent);

					header('location: index.php?success=yes');
				}
				else
				{
					$msgDisplay = $msgError;
				}
			}
			else
			{
				$msgDisplay = $msgPWError;
			}
		}
	}
?>