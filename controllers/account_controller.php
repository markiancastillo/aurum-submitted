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
		$inpSex = $_POST['inpSex'];
		$inpSSS = base64_encode(openssl_encrypt($_POST['inpSSS'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpTIN = base64_encode(openssl_encrypt($_POST['inpTIN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpBIR = base64_encode(openssl_encrypt($_POST['inpBIR'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpHDMF = base64_encode(openssl_encrypt($_POST['inpHDMF'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpCivilStatus = $_POST['inpCivilStatus'];
		
		#if position, department, and base rate is read-only
		#for the current user, exclude from update
		#otherwise, include them
		if(determineAccess() === "disabled") 
		{

		}
		else
		{
			$inpPosition = $_POST['inpPosition'];
		 	$inpDepartment = $_POST['inpDepartment'];
		 	$inpBaseRate = $_POST['inpBaseRate'];
		}	
	}
?>