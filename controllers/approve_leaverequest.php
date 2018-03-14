<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_GET['id'];
	$lID = $_GET['type'];
	$l = $_GET['l'];

	#update the service fee status
	#to "approved"
	$sql_approve = "UPDATE leaves SET leaveStatus = 'Approved' where leaveID = ? and accountID = ?";
	$params_approve = array($l, $reqID);
	$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount +1 WHERE accountID = ? AND ltypeID = ? AND lcAmount < 15";
	$params_update = array($reqID, $lID);
	$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

	$txtEvent = "User with ID # " . $accID . " approved leave request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../requestto_admin.php?id=' . $reqID . '&approved=yes');
?>