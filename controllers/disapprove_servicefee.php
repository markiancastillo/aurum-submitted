<?php
	include('config.php');
	include('function.php');

	$accID = $_SESSION['accID'];
	$reqID = $_REQUEST['id'];

	#update the service fee request
	#set status to "disapproved"
	$sql_disapprove = "UPDATE servicefees SET sfStatus = 'Disapproved' where sfID = ?";
	$params_disapprove = array($reqID);
	$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

	$txtEvent = "User with ID # " . $accID . " denied service fee request # " . $reqID . ".";
	logEvent($con, $accID, $txtEvent);

	header('location: ../list_servicefee.php?id=' . $reqID . '&approved=no');
?>