<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];

	#update the service fee status
	#to "approved"
	$sql_approve = "UPDATE requestLeave SET statusLeave = 'Approved' where leaveID = ?";
	$params_approve = array($reqID);
	$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

	$txtEvent = "User with ID # " . $accID . " approved leave request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../requestto_admin.php?id=' . $reqID . '&approved=yes');
?>