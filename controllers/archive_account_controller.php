<?php
	$pageTitle = "Archive an Account";
	include('function.php');
	include(loadHeader());

	$reqID = $_REQUEST['id'];

	$detAccount = getAccounts($con, $reqID);

	while($row = sqlsrv_fetch_array($detAccount))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);

		$accountName = $accountFN . " " . $accountMN . " " . $accountLN;

		$accountEmail = openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountStatus = $row['accountStatus'];
		$positionName = $row['positionName'];
		$departmentName = $row['departmentName'];
	}

	$detContact = getContacts($con, $reqID);
	$accountNumbers = "";
	while($row = sqlsrv_fetch_array($detContact))
	{
		$contactNumber = openssl_decrypt(base64_decode($row['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$ctypeName = $row['ctypeName'];
		$accountNumbers .= "$contactNumber ($ctypeName) <br/>";
	}

	if(isset($_POST['btnArchive']))
	{
		$msgDisplay = "";

		#verify that the input password matches user's password
		$inpPW = base64_encode(openssl_encrypt($_POST['inpPW'], $method, $password, OPENSSL_RAW_DATA, $iv));

		$sql_chkPW = "SELECT accountPassword FROM accounts WHERE accountID = ?";
		$params_chkPW = array($_SESSION['accID']);
		$stmt_checkPW = sqlsrv_query($con, $sql_chkPW, $params_chkPW);
		while($row = sqlsrv_fetch_array($stmt_checkPW))
		{
			$accountPW = $row['accountPassword'];
		}

		if(strcasecmp(trim($inpPW), trim($accountPW)) == 0)
		{
			echo "passwords match. archive the account";

			$sql_archive = "UPDATE accounts SET accountStatus = ? WHERE accountID = ?";
			$params_archive = array("Archived", $reqID);
			$stmt_archive = sqlsrv_query($con, $sql_archive, $params_archive);

			$txtEvent = "User with ID #" . $accID . " archived the account with ID #" . $reqID . ".";
			logEvent($con, $accID, $txtEvent);

			header('location: list_account.php');
		}
		else 
		{
			$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Password mismatch. Archive operation aborted.
						</div>";
		}
	}
?>