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
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);

		$accountName = $accountFN . " " . $accountMN . " " . $accountLN;

		$accountBirthdate = $row['accountBirthdate']->format('Y-m-d');
		$accountSex = $row['accountSex'];
		$accountSSSNo = openssl_decrypt(base64_decode($row['accountSSSNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountTINNo = openssl_decrypt(base64_decode($row['accountTINNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountBIRNo = openssl_decrypt(base64_decode($row['accountBIRNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountHDMFNo = openssl_decrypt(base64_decode($row['accountHDMFNo']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountEmail = openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountBaseRate = $row['accountBaseRate'];
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
		$addressL1 = openssl_decrypt(base64_decode($row2['addressL1']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$addressL2 = openssl_decrypt(base64_decode($row2['addressL2']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$addressCity = openssl_decrypt(base64_decode($row2['addressCity']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$addressZip = $row2['addressZip'];

		$accountAddress = $addressL1 . "<br>" . $addressL2 . "<br>" . $addressCity . "<br>" . $addressZip;
	}

	#get data from contacts table
	$detContact = getContacts($con, $reqID);
	$accountNumbers = "";
	while($row = sqlsrv_fetch_array($detContact))
	{
		$contactNumber = openssl_decrypt(base64_decode($row['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$ctypeName = $row['ctypeName'];
		$accountNumbers .= "$contactNumber ($ctypeName) <br/>";
	}
?>