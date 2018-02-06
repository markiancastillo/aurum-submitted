<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];

	#update the status of the reimbursement
	#request to "approved"
	$sql_approve = "UPDATE expenses SET expenseStatus = 'Approved' where expenseID = ?";
	$params_approve = array($reqID);
	$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

	$txtEvent = "User with ID # " . $accID . " approved reimbursement request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../list_reimbursement.php?id=' . $reqID . '&approved=yes');
?>