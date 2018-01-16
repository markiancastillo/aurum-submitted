<?php
	include('config.php');
	include('security.php');

	if(isset($_POST['btnLogin']))
	{
		$inpUsername = base64_encode(openssl_encrypt($_POST['inpUsername'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpPassword = base64_encode(openssl_encrypt($_POST['inpPassword'], $method, $password, OPENSSL_RAW_DATA, $iv));

		$sql_login = "SELECT accountID, departmentID FROM accounts WHERE accountUsername = ? AND accountPassword = ?";
		$params_login = array($inpUsername, $inpPassword);
		$options_login = array("Scrollable"=>'static');
		$stmt_login = sqlsrv_query($con, $sql_login, $params_login, $options_login);
		
		$login_row_count = sqlsrv_num_rows($stmt_login);

		if($login_row_count > 0)
		{
			#login was successful
			session_start();
			#bind the accountID and departmentID into the sesison
			#accountID will identify the user that is logged in
			#departmentID will determine the user's access 
			while($row = sqlsrv_fetch_array($stmt_login))
			{
				$accID = $row['accountID'];
				$depID = $row['departmentID'];
	
				$_SESSION['accID'] = $accID;
				$_SESSION['depID'] = $depID;

				header('location: index.php');
			}
		}
		else
		{
			#unsuccessful login
			echo "Error! Incorrrect username or password.";
		}
	}
?>