<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];

	#update the service fee status
	#to "approved"
	$sfNote = "Approved " . date('m/d/Y');
	$sql_approve = "UPDATE servicefees SET sfStatus = 'Approved', sfReviewedBy = ?, sfNote = ? WHERE sfID = ?";
	$params_approve = array($accID, $sfNote, $reqID);
	$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

	$txtEvent = "User with ID # " . $accID . " approved service fee request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../list_servicefee.php?id=' . $reqID . '&approved=yes');
?>