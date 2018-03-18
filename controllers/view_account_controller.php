<?php
	$pageTitle = "View Account";
	include('function.php');
	include(loadHeader());

	$reqID = $_REQUEST['id'];

	#get data from accounts table
	$detAccount = getAccounts($con, $reqID);
	while($row = sqlsrv_fetch_array($detAccount))
	{
		$accountPhoto = openssl_decrypt(base64_decode($row['accountPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');

		$accountName = $accountFN . " " . $accountMN . " " . $accountLN;

		$accountBirthdate = $row['accountBirthdate']->format('Y-m-d');
		$accountSex = $row['accountSex'];
		$accountSSSNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountSSSNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountTINNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountTINNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountHDMFNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountHDMFNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountEmail = htmlspecialchars(openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountBaseRate = htmlspecialchars($row['accountBaseRate'], ENT_QUOTES, 'UTF-8');
		$accountStatus = $row['accountStatus'];
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
	$dept = getDepartments($con);

	#get selected position
	$pos = getPositions($con);

	#get selected civil status
	$cs = getCivilStatuses($con);

	#get data from addresses table 
	$detAddress = getAddress($con, $reqID);
	$accountAddress = "";
	while($row2 = sqlsrv_fetch_array($detAddress))
	{
		$addressL1 = htmlspecialchars(openssl_decrypt(base64_decode($row2['addressL1']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressL2 = htmlspecialchars(openssl_decrypt(base64_decode($row2['addressL2']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressCity = htmlspecialchars(openssl_decrypt(base64_decode($row2['addressCity']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressZip = htmlspecialchars($row2['addressZip'], ENT_QUOTES, 'UTF-8');

		$accountAddress = $addressL1 . "<br>" . $addressL2 . "<br>" . $addressCity . "<br>" . $addressZip;
	}

	#get data from contacts table
	$detContact = getContacts($con, $reqID);
	$accountNumbers = "";
	while($row = sqlsrv_fetch_array($detContact))
	{
		$contactNumber = htmlspecialchars(openssl_decrypt(base64_decode($row['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$ctypeName = $row['ctypeName'];
		$accountNumbers .= "$contactNumber ($ctypeName) <br/>";
	}
?>