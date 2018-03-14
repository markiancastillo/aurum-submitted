<?php
	$pageTitle = "Your request";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM leaves 
					  WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_listRequest= "SELECT leaveID, leaveFileDate, leaveFrom, leaveTo, leaveReason, leaveStatus 
					   FROM leaves"; 
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

		$nr_work_days = getWorkingDays($leaveFrom, $leaveTo);

		$listRequest .= "
			<tr>
				<td class='text-center'>$leaveFileDate</td>
				<td class='text-center'>$leaveFrom</td>
				<td class='text-center'>$leaveTo</td>
				<td class='text-center'>$nr_work_days</td>
				<td class='text-center'>$leaveReason</td>
				<td class='text-center'>$leaveStatus</td>	
			</tr>";
	}
?>