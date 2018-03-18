<?php
	$pageTitle = "Leave Request Details";
	include('function.php');
	include(loadHeader());

	$reqID = $_GET['id'];
	$lID = $_GET['type'];
	$l = $_GET['l'];

	#get the data for the form
	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM leaves 
					  WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_listRequest= "SELECT leaveID, ltypeID, leaveFileDate, leaveFrom, leaveTo, leaveReason, leaveStatus FROM leaves WHERE accountID = ? AND ltypeID =?";
	$params_listRequest = array($reqID, $lID);
	$stmt_listRequest = sqlsrv_query($con, $sql_listRequest, $params_listRequest);

	$listRequest = "";
	while($row = sqlsrv_fetch_array($stmt_listRequest))
	{
		$leaveID = $row['leaveID'];
		$ltypeID = $row['ltypeID'];
		$leaveFileDate = $row['leaveFileDate']->format('Y/m/d');
		$leaveFrom = $row['leaveFrom']->format('Y/m/d');
		$leaveTo = $row['leaveTo']->format('Y/m/d');
		$leaveReason = htmlspecialchars($row['leaveReason'], ENT_QUOTES, 'UTF-8');
		$leaveStatus = $row['leaveStatus'];	
	}

	if(isset($_POST['btnApprove']))
	{
		#update the leave request status
		#to "approved"
		$sql_approve = "UPDATE leaves SET leaveStatus = 'Approved' where leaveID = ? AND accountID = ?";
		$params_approve = array($l, $reqID);
		$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

		$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount +1 WHERE accountID = ? AND ltypeID = ? AND lcAmount < 15";
		$params_update = array($reqID, $lID);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

		$txtEvent = "User with ID # " . $accID . " approved leave request request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=yes');
	}

	if(isset($_POST['btnDeny']))
	{
		#update the leave status request
		#set status to "disapproved"
		$sql_disapprove = "UPDATE leaves SET leaveStatus = 'Disapproved' WHERE leaveID = ? AND accountID = ?";
		$params_disapprove = array($l, $reqID);
		$stmt_disapprove = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

		$txtEvent = "User with ID # " . $accID . " denied leave request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=no');
	}
?>