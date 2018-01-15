<?php
	#include 'header.php';
	include 'config.php';
	include 'security.php';

	#for new accounts, default username: firstname.lastname
	#for new accounts, default password: change.lastname
	#for new accounts, status is set to: "pending" - will require password change on first login. After first password change, status will be 'Active'

	#display list of departments
	$sql_departments = "SELECT departmentID, departmentName FROM departments";
	$stmt_departments = sqlsrv_query($con, $sql_departments);
	$list_departments = "";
	while($row = sqlsrv_fetch_array($stmt_departments))
	{
		$departmentID = $row['departmentID'];
		$departmentName = $row['departmentName'];
		$list_departments .= "<option value='$departmentID'>$departmentName</option>";
	}

	if(isset($_POST['btnSubmit']))
	{
		#get data from the input form
		#photo uploading to be added
		$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));

		#convert all letters to lower case & remove spaces. This will be used as a default username
		$UN = strtolower(str_replace(' ', '', $_POST['inpFN']) . '.' . str_replace(' ', '', $_POST['inpLN']));
		$defUsername = base64_encode(openssl_encrypt($UN, $method, $password, OPENSSL_RAW_DATA, $iv));
		#do the same for password:
		$defPassword = base64_encode(openssl_encrypt(strtolower('change' . '.' . str_replace(' ', '', $_POST['inpLN'])), $method, $password, OPENSSL_RAW_DATA, $iv));

		$inpBDay = $_POST['inpBDay'];
		$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpSex = $_POST['inpSex'];
		$inpSSS = base64_encode(openssl_encrypt($_POST['inpSSS'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpTIN = base64_encode(openssl_encrypt($_POST['inpTIN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpBIR = base64_encode(openssl_encrypt($_POST['inpBIR'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpHDMF = base64_encode(openssl_encrypt($_POST['inpHDMF'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpCivilStatus = $_POST['inpCivilStatus'];
		$inpPosition = base64_encode(openssl_encrypt($_POST['inpPosition'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpDepartment = $_POST['inpDepartment'];
		$inpBaseRate = $_POST['inpBaseRate'];

		$sql_insert = "INSERT INTO accounts (accountUsername, accountPassword, accountFN, accountMN, accountLN, accountBirthDate, accountSex, accountSSSNo, accountTINNo, accountBIRNo, accountHDMFNo, accountCivilStatus, accountEmail, accountPosition, accountBaseRate, accountStatus, departmentID) 
					   VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($defUsername, $defPassword, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpCivilStatus, $inpEmail, $inpPosition, $inpBaseRate, "Pending", $inpDepartment);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		if($stmt_insert === false)
		{
			#die(print_r(sqlsrv_errors(), true));
			echo "Record creation failed! Please check your input and try again.";
		}
		else 
		{
			#insert successful!
			echo "Successfully created a new record!";
		}
	}
?>