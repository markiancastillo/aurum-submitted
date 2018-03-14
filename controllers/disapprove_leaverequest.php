<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_GET['id'];
	$lID = $_GET['type'];
	$l = $_GET['l'];
	
	#update the status of the reimbursement
	#request to "denied"
	$sql_disapprove = "UPDATE leaves SET leaveStatus = 'Disapproved' WHERE leaveID = ? AND accountID = ?";
	$params_disapprove = array($l, $reqID);
	$stmt_disapprove = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

	$txtEvent = "User with ID # " . $accID . " denied leave request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../requestto_admin.php?id=' . $reqID . '&approved=no');
?>