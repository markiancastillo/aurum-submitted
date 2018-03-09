<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];
	
	#update the status of the reimbursement
	#request to "denied"
	$sql_disapprove = "UPDATE requestleave SET statusLeave = 'Disapproved' WHERE leaveID = ?";
	$params_disapprove = array($reqID);
	$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

	$txtEvent = "User with ID # " . $accID . " denied leave request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../requestto_admin.php?id=' . $reqID . '&approved=no');
?>