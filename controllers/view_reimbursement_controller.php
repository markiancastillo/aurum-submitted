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
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = htmlspecialchars($row['caseTitle'], ENT_QUOTES, 'UTF-8');
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = htmlspecialchars($row['expenseAmount'], ENT_QUOTES, 'UTF-8');
		$etypeName = $row['etypeName'];
		$expenseRemarks = htmlspecialchars($row['expenseRemarks'], ENT_QUOTES, 'UTF-8');

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

	$msgDisplay = "";
	$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please enter a valid disapproval reason.
				</div>";

	if(isset($_POST['btnDeny']))
	{	
		$inpNote = trim($_POST['inpNote']);

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
			$msgDisplay = $msgError;
		}
	}
?>