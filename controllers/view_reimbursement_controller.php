<?php
	$pageTitle = "Reimbursement Details";
	include('function.php');
	include(loadHeader());

	$reqID = $_REQUEST['id'];
	
	#get the data for the form
	$sql_details = "SELECT a.accountLN, a.accountFN, a.accountMN, c.caseTitle, e.expenseDate, e.expenseProof, e.expenseAmount, t.etypeName, e.expenseRemarks 
					FROM expenses e 
					INNER JOIN accounts a ON e.accountID = a.accountID 
					INNER JOIN cases c ON e.caseID = c.caseID 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID 
					WHERE e.expenseID = ?";
	$params_details = array($_REQUEST['id']);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	while($row = sqlsrv_fetch_array($stmt_details))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = $row['caseTitle'];
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = $row['expenseAmount'];
		$etypeName = $row['etypeName'];
		$expenseRemarks = $row['expenseRemarks'];

		#assign expenseProof to variable accountPhoto for reuse of function
		$accountPhoto = openssl_decrypt(base64_decode($row['expenseProof']), $method, $password, OPENSSL_RAW_DATA, $iv);
	}

	if(isset($_POST['btnApprove']))
	{
		#update the status of the reimbursement
		#request to "approved"
		$expenseNote = "Approved " . date('m/d/Y');
		$sql_approve = "UPDATE expenses SET expenseStatus = 'Approved', expenseReviewedBy = ?, expenseNote = ? WHERE expenseID = ?";
		$params_approve = array($accID, $expenseNote, $reqID);
		$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

		$txtEvent = "User with ID # " . $accID . " approved reimbursement request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);
	
		header('location: list_reimbursement.php?id=' . $reqID . '&approved=yes');
	}

	$setRequired = "";
	if(isset($_POST['btnDeny']))
	{	
		$inpNote = $_POST['inpNote'];

		if($inpNote != null || !empty($inpNote))
		{
			#update the status of the reimbursement
			#request to "denied"
			$sql_disapprove = "UPDATE expenses SET expenseStatus = 'Disapproved', expenseReviewedBy = ?, expenseNote = ? WHERE expenseID = ?";
			$params_disapprove = array($accID, $inpNote, $reqID);
			$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);
	
			$txtEvent = "User with ID # " . $accID . " denied reimbursement request # " . $reqID . ".";
			logEvent($con, $accID, $txtEvent);
	
			header('location: list_reimbursement.php?id=' . $reqID . '&approved=no');
		}
		else 
		{
			echo 'Please enter a reason for disapproval.';
		}
	}
?>