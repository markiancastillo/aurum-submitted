<?php
	$pageTitle = "My Account";
	include('function.php');
	include(loadHeader());

	#get account information
	$sql_account = "SELECT a.accountUsername, a.accountFN, a.accountMN, a.accountLN, a.accountBirthdate, a.accountSex, a.accountSSSNo, a.accountTINNo, a.accountBIRNo, a.accountHDMFNo, a.accountEmail, a.accountBaseRate, c.cstatusID, p.positionID, d.departmentID 
	                FROM accounts a 
	                INNER JOIN civilstatuses c ON a.cstatusID = c.cstatusID 
	                INNER JOIN positions p ON a.positionID = p.positionID
	                INNER JOIN departments d ON a.departmentID = d.departmentID
	                WHERE a.accountID = ?";
	$params_account = array($_SESSION['accID']);
	$options_account = array("Scrollable"=>'static');             
	$stmt_account = sqlsrv_query($con, $sql_account, $params_account, $options_account);
	while($row = sqlsrv_fetch_array($stmt_account))
	{
		$accountUsername = openssl_decrypt(base64_decode($row['accountUsername']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountBirthdate = $row['accountBirthdate']->format('Y-m-d');
		$accountSex = $row['accountSex'];
		$accountSSSNo = openssl_decrypt(base64_decode($row['accountSSSNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountTINNo = openssl_decrypt(base64_decode($row['accountTINNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountBIRNo = openssl_decrypt(base64_decode($row['accountBIRNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountHDMFNo = openssl_decrypt(base64_decode($row['accountHDMFNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountEmail = openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountBaseRate = $row['accountBaseRate'];
		$selectedcsID = $row['cstatusID'];
		$selectedposID = $row['positionID'];
		$selecteddeptID = $row['departmentID'];
	}

	#get selected sex
	if(strcasecmp(trim($accountSex), "M") == 0)
	{
		$selectedM = "selected";
		$selectedF = "";
	}
	else 
	{
		$selectedM = "";
		$selectedF = "selected";
	}
	
	#get selected department
	$list_departments = "";
	$dept = getDepartments($con);
	while($row = sqlsrv_fetch_array($dept))
	{
		$departmentID = $row['departmentID'];
		$departmentName = $row['departmentName'];
		$selectedVal = $selecteddeptID === $departmentID ? 'selected' : '';
		$list_departments .= "<option value='$departmentID' $selectedVal>$departmentName</option>";
	}

	#get selected position
	$list_positions = "";
	$pos = getPositions($con);
	while($row = sqlsrv_fetch_array($pos))
	{
		$positionID = $row['positionID'];
		$positionName = $row['positionName'];
		$selectedVal = $selectedposID === $positionID ? 'selected' : '';
		$list_positions .= "<option value='$positionID' $selectedVal>$positionName</option>";
	}

	#get selected civil status
	$list_cstatus = "";
	$cs = getCivilStatuses($con);
	while($row = sqlsrv_fetch_array($cs))
	{
		$cstatusID = $row['cstatusID'];
		$cstatusName = $row['cstatusName'];
		$selectedVal = $selectedcsID === $cstatusID ? 'selected' : '';
		$list_cstatus .= "<option value='$cstatusID' $selectedVal>$cstatusName</option>";
	}

	$contactNumber = "";
	#get contact number information (main number only)
	$sql_getNumber = "SELECT TOP 1 (contactNumber) FROM contacts 
					  WHERE ctypeID = ? AND accountID = ?";
	$params_getNumber = array(1, $_SESSION['accID']);
	$stmt_getNumber = sqlsrv_query($con, $sql_getNumber, $params_getNumber);
	while($rowNum = sqlsrv_fetch_array($stmt_getNumber))
	{
		$contactNumber = openssl_decrypt(base64_decode($rowNum['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv);
	}

	#validations:
	#username - at least 6 characters, not taken. Add tooltip
	#email - must be a valid email
	#SSS, TIN, BIR, HDMF - based on a valid number

	if(isset($_POST['btnUpdate']))
	{
		#pass the current account ID for updating
		$inpAcc = $_SESSION['accID'];

		#get the data from the form
		$inpUsername = base64_encode(openssl_encrypt($_POST['inpUN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpBDay = $_POST['inpBDay'];
		$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpNumber = base64_encode(openssl_encrypt($_POST['inpNumber'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpSex = $_POST['inpSex'];
		$inpSSS = base64_encode(openssl_encrypt($_POST['inpSSS'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpTIN = base64_encode(openssl_encrypt($_POST['inpTIN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpBIR = base64_encode(openssl_encrypt($_POST['inpBIR'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpHDMF = base64_encode(openssl_encrypt($_POST['inpHDMF'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpCivilStatus = $_POST['inpCivilStatus'];
		
		#if position, department, and base rate is read-only
		#for the current user, exclude from update
		#otherwise, include them
		$msgDisplay = "";
		$msgSuccess = "<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Account information successfully updated.
						</div>";
		$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						That username already exists. Please choose a different one.
					</div>";

		if(determineAccess() === "disabled")
		{
			#user is not an admin -- has disabled fields in the form
			#do not include position, department, and base rate in update
			if(empty($inpUsername) || $inpUsername === base64_encode(openssl_encrypt('', $method, $password, OPENSSL_RAW_DATA, $iv)))
			{
				#username field is left blank
				#do not update the username
				$sql_update = "UPDATE accounts 
							   SET accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ?, accountSSSNo = ?, accountTINNo = ?, accountBIRNo = ?, accountHDMFNo = ?, accountEmail = ?, cstatusID = ?
							   WHERE accountID = ?";
				$params_update = array($inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpCivilStatus, $inpAcc);
				$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

				updateNumber($con, $inpNumber, $inpAcc);

				header('location: account.php?updated=yes');
			}
			else
			{
				#username field has an input - include it in the update
				#validate first if username is available or not
				if(strcmp(validateUsername($con, $inpUsername), "available") == 0)
				{
					#username is valid 
					$sql_update = "UPDATE accounts 
							   SET accountUsername = ?, accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ?, accountSSSNo = ?, accountTINNo = ?, accountBIRNo = ?, accountHDMFNo = ?, accountEmail = ?, cstatusID = ?
							   WHERE accountID = ?";
					$params_update = array($inpUsername, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpCivilStatus, $inpAcc);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					updateNumber($con, $inpNumber, $inpAcc);

					header('location: account.php?updated=yes');
				}
				else 
				{
					#the input username already exists. display an eror message
					$msgDisplay = $msgError;
				}
			}
		}
		else
		{
			#user is an admin -- no fields disabled
			#include position, department, and base rate in update
			$inpPosition = $_POST['inpPosition'];
		 	$inpDepartment = $_POST['inpDepartment'];
		 	$inpBaseRate = $_POST['inpBaseRate'];

			if(empty($inpUsername) || $inpUsername === base64_encode(openssl_encrypt('', $method, $password, OPENSSL_RAW_DATA, $iv)))
			{
				$sql_update = "UPDATE accounts 
							   SET accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ?, accountSSSNo = ?, accountTINNo = ?, accountBIRNo = ?, accountHDMFNo = ?, accountEmail = ?, accountBaseRate = ?, cstatusID = ?, positionID = ?, departmentID = ? 
							   WHERE accountID = ?";
				$params_update = array($inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpBaseRate, $inpCivilStatus, $inpPosition, $inpDepartment, $inpAcc);
				$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

				updateNumber($con, $inpNumber, $inpAcc);

				header('location: account.php?updated=yes');
			}
			else
			{	
				#username field has an input
				#validate if the username is available		 		
		 		if(strcmp(validateUsername($con, $inpUsername), "available") == 0)
				{
					#username is available
					$sql_update = "UPDATE accounts 
							   SET accountUsername = ?, accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ?, accountSSSNo = ?, accountTINNo = ?, accountBIRNo = ?, accountHDMFNo = ?, accountEmail = ?, accountBaseRate = ?, cstatusID = ?, positionID = ?, departmentID = ? 
							   WHERE accountID = ?";
					$params_update = array($inpUsername, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpBaseRate, $inpCivilStatus, $inpPosition, $inpDepartment, $inpAcc);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					updateNumber($con, $inpNumber, $inpAcc);

					header('location: account.php?updated=yes');
				}
				else 
				{
					#username already exists
					$msgDisplay = $msgError;
				}
			}
		}
	}
?>