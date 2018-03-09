<?php
	$pageTitle = "Request leave Details";
	include('function.php');
	include(loadHeader());

	$reqID = $_REQUEST['id'];
	
	#get the data for the form
	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM leaves 
					  WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_listRequest= "SELECT leaveID, leaveFileDate, leaveFrom, leaveTo, leaveReason, leaveStatus FROM leaves"; 
	
	$stmt_listRequest = sqlsrv_query($con, $sql_listRequest);

	$listRequest = "";
	while($row = sqlsrv_fetch_array($stmt_listRequest))
	{
		$leaveID = $row['leaveID'];
		
		$leaveFileDate = $row['leaveFileDate']->format('Y/m/d');
		$leaveFrom = $row['leaveFrom']->format('Y/m/d');
		$leaveTo = $row['leaveTo']->format('Y/m/d');
		$leaveReason = $row['leaveReason'];
		$leaveStatus = $row['leaveStatus'];
	}

	if(isset($_POST['btnApprove']))
	{
		#update the leave request status
		#to "approved"
		$sql_approve = "UPDATE leaves SET leaveStatus = 'Approved' where leaveID = ?";
		$params_approve = array($reqID);
		$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

		$txtEvent = "User with ID # " . $accID . " approved leave request request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=yes');
	}

	if(isset($_POST['btnDeny']))
	{
		#update the leave status request
		#set status to "disapproved"
		$sql_disapprove = "UPDATE leaves SET leaveStatus = 'Disapproved' where leaveID = ?";
		$params_disapprove = array($reqID);
		$stmt_approve = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

		$txtEvent = "User with ID # " . $accID . " denied leave request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=no');
	}
?>