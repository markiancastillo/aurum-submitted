<?php
	$pageTitle = "Manage Services List";
	include('function.php');
	include(loadHeader());
	$accID = $_SESSION['accID'];

	$list_employees = "";
	$employees = getEmployees($con);
	while($row = sqlsrv_fetch_array($employees))
	{
		$accountID = $row['accountID'];
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$employeeName = $accountFN . ' ' . $accountLN;
		$list_employees .= "<option value='$accountID'>$employeeName</option>";
	}

	$list_clients = "";
	$clients = getClients($con);
	while($row = sqlsrv_fetch_array($clients))
	{
		$clientID = $row['clientID'];
		$clientFN = openssl_decrypt(base64_decode($row['clientFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientLN = openssl_decrypt(base64_decode($row['clientLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientFullName = $clientFN . ' ' . $clientLN;
		$list_clients .= "<option value='$clientID'>$clientFullName</option>";
	}

	if(isset($_POST['btnSubmit']))
	{
		$cTitle = $_POST['cTitle'];
		$cDescription = $_POST['cDescription'];
		$cClient = $_POST['cClient'];
		$cEmpAssigned = $_POST['cEmpAssigned'];
		$cSDate = $_POST['cSDate'];
		$cEDate = $_POST['cEDate'];
		$cRemarks = $_POST['cRemarks'];
		$cStatus = $_POST['cStatus'];
		

		$sql_insert = "INSERT INTO cases (caseTitle, caseDescription, clientID, accountID, caseStartDate, caseEndDate, caseRemarks, caseStatus) 
					   VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($cTitle, $cDescription, $cClient, $cEmpAssigned, $cSDate, $cEDate, $cRemarks, $cStatus);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
	}
?>