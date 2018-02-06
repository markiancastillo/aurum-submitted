<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];
	
	#update the status of the reimbursement
	#request to "denied"
	$sql_disapprove = "UPDATE expenses SET expenseStatus = 'Disapproved' WHERE expenseID = ?";
	$params_disapprove = array($reqID);
	$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

	$txtEvent = "User with ID # " . $accID . " denied reimbursement request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../list_reimbursement.php?id=' . $reqID . '&approved=no');
?>