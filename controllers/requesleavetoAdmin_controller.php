<?php
	$pageTitle = "Your request";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$list_ltypes = getltypes($con, $accID);
	$ltypeID = $_POST['ltypeName'];

	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM leaves 
					  WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_lc = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = ?";
	$params_lc = array($accID, $ltypeID);
	$stmt_lc = sqlsrv_query($con, $sql_lc, $params_lc);
	while($row = sqlsrv_fetch_array($stmt_lc))
	{
		$ltypeID = $row['ltypeID'];
	}
	
	$sql_lt = "SELECT ltypeName FROM leavetypes WHERE ltypeID = ?";
	$params_lt = array($ltypeID);
	$stmt_lt = sqlsrv_query($con, $sql_lt, $params_lt);
	while($row = sqlsrv_fetch_array($stmt_lt))
	{
		$ltypeID = $row['ltypeID'];
	}

	$sql_listRequest = "SELECT leaveID, ltypeID, leaveFileDate, leaveFrom, leaveTo, leaveReason, leaveStatus, accountID 
						FROM leaves 
						WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID"; 
	$params_listRequest = array($accID);
	$stmt_listRequest = sqlsrv_query($con, $sql_listRequest);

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
		$accountID = $row['accountID'];
		
		$nr_work_days = getWorkingDays($leaveFrom,$leaveTo);

		$listRequest .= "
			<tr>
				<td class='text-center'>$leaveFileDate</td>
				<td class='text-center'>$leaveFrom</td>
				<td class='text-center'>$leaveTo</td>
				<td class='text-center'>$nr_work_days</td>
				<td class='text-center'>$leaveReason</td>
				<td class='text-center'>$leaveStatus</td>

				<td class='text-center'>
					<a href='view_requestleave.php?id=$accountID&type=$ltypeID' class='btn btn-default' data-toggle='tooltip' data-position='top' title='tiptip'>Details</a>
					<a href='controllers/approve_leaverequest.php?id=$accountID&type=$ltypeID&l=$leaveID' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a>
				</td>			
			</tr>";
	}
?>