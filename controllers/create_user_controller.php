<?php
	$pageTitle = "Create New User";
	include('function.php');
	include(loadHeader());
	$accID = $_SESSION['accID'];
	#for new accounts, default username: firstname.lastname
	#for new accounts, default password: change.lastname
	#for new accounts, status is set to: "pending" - will require password change on first login. After first password change, status will be 'Active'

	$list_departments = "";
	$dept = getDepartments($con);
	while($row = sqlsrv_fetch_array($dept))
	{
		$departmentID = $row['departmentID'];
		$departmentName = $row['departmentName'];
		$list_departments .= "<option value='$departmentID'>$departmentName</option>";
	}

	$list_positions = "";
	$pos = getPositions($con);
	while($row = sqlsrv_fetch_array($pos))
	{
		$positionID = $row['positionID'];
		$positionName = $row['positionName'];
		$list_positions .= "<option value='$positionID'>$positionName</option>";
	}

	$list_cstatus = "";
	$cs = getCivilStatuses($con);
	while($row = sqlsrv_fetch_array($cs))
	{
		$cstatusID = $row['cstatusID'];
		$cstatusName = $row['cstatusName'];
		$list_cstatus .= "<option value='$cstatusID'>$cstatusName</option>";
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
		$inpPosition = $_POST['inpPosition'];
		$inpDepartment = $_POST['inpDepartment'];
		$inpBaseRate = $_POST['inpBaseRate'];

		$sql_insert = "INSERT INTO accounts (accountUsername, accountPassword, accountFN, accountMN, accountLN, accountBirthDate, accountSex, accountSSSNo, accountTINNo, accountBIRNo, accountHDMFNo, accountEmail, accountBaseRate, accountStatus, cstatusID, positionID, departmentID) 
					   VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($defUsername, $defPassword, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpBaseRate, "Pending", $inpCivilStatus, $inpPosition, $inpDepartment);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		$txtEvent = "User with ID #" . $accID . " created a new account for: " . trim($_POST['inpFN']) . " " . trim($_POST['inpMN']) . " " . trim($_POST['inpLN']) . ".";
		logEvent($con, $accID, $txtEvent);
	}
?>