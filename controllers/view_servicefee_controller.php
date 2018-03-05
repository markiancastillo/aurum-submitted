<?php
	$pageTitle = "Service Fee Details";
	include('function.php');
	include(loadHeader());

	$reqID = $_REQUEST['id'];
	
	#get the data for the form
	$sql_details = "SELECT a.accountLN, a.accountFN, a.accountMN, c.caseTitle, s.sfDate, s.sfProof, s.sfAmount, t.stypeName, s.sfRemarks 
					FROM servicefees s 
					INNER JOIN accounts a ON s.accountID = a.accountID 
					INNER JOIN cases c ON s.caseID = c.caseID 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID 
					WHERE s.sfID = ?";
	$params_details = array($_REQUEST['id']);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	while($row = sqlsrv_fetch_array($stmt_details))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = $row['caseTitle'];
		$sfDate = $row['sfDate']->format('m/d/Y');
		$sfAmount = $row['sfAmount'];
		$stypeName = $row['stypeName'];
		$sfRemarks = $row['sfRemarks'];

		#assign expenseProof to variable accountPhoto for reuse of function
		$accountPhoto = openssl_decrypt(base64_decode($row['sfProof']), $method, $password, OPENSSL_RAW_DATA, $iv);
	}

	if(isset($_POST['btnApprove']))
	{
		#update the service fee status
		#to "approved"
		$sfNote = "Approved " . date('m/d/Y');
		$sql_approve = "UPDATE servicefees SET sfStatus = 'Approved', sfReviewedBy = ?, sfNote = ? WHERE sfID = ?";
		$params_approve = array($accID, $sfNote, $reqID);
		$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);
	
		$txtEvent = "User with ID # " . $accID . " approved service fee request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);
	
		header('location: list_servicefee.php?id=' . $reqID . '&approved=yes');
	}

	if(isset($_POST['btnDeny']))
	{
		$inpNote = $_POST['inpNote'];

		if($inpNote != null || !empty($inpNote))
		{
			#update the service fee request
			#set status to "disapproved"
			$sql_disapprove = "UPDATE servicefees SET sfStatus = 'Disapproved', sfReviewedBy = ?, sfNote = ? WHERE sfID = ?";
			$params_disapprove = array($accID, $inpNote, $reqID);
			$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);
	
			$txtEvent = "User with ID # " . $accID . " denied service fee request # " . $reqID . ".";
			logEvent($con, $accID, $txtEvent);
	
			header('location: list_servicefee.php?id=' . $reqID . '&approved=no');
		}
		else 
		{
			echo 'Please enter a reason for disapproval.';
		}
	}
?>