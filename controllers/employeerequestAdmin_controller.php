<?php
	$pageTitle = "Your request";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');
	
	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM requestLeave 
					  WHERE statusLeave != 'Approved' AND statusLeave != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}
	
	$sql_employeeRequest= "SELECT l.leaveID, firstName, lastName, typeLeave, reasonLeave, datePrepared, durationfromLeave, durationtoLeave 
			FROM requestleave 
			INNER JOIN accounts a ON l.accountID = a.accountID 
			WHERE l.statusLeave != 'Approved' AND l.statusLeave != 'Disapproved' AND l.accountID != ? "; 
						
	$params_employeeRequest = array($accID);
	$stmt_employeeRequest = sqlsrv_query($con, $sql_employeeRequest);

	$displayemployeeRequest = "";
	while($row = sqlsrv_fetch_array($stmt_employeeRequest))
	{
		$leaveID = $row['leaveID'];
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		$typeLeave = $row['typeLeave'];
		$reasonLeave = $row['reasonLeave'];
		$datePrepared = $row['datePrepared']->format('d/m/Y');
		$durationfromLeave = $row['durationfromLeave']->format('d/m/Y');
		$durationtoLeave = $row['durationtoLeave']->format('d/m/Y');
		$reasonLeave = $row['reasonLeave'];
		
		$displayemployeeRequest .= "
			<tr>
				<td class='text-center'>$firstName</td>
				<td class='text-center'>$lastName</td>
				<td class='text-center'>$typeLeave</td>
				<td class='text-center'>$reasonLeave</td>
				<td class='text-center'>$datePrepared</td>
				<td class='text-center'>$durationfromLeave</td>
				<td class='text-center'>$durationtoLeave</td>
				
				<a href='requestto_admin.php?id=$leaveID' class='btn btn-default' data-toggle='tooltip' data-position='top' title='tiptip'>Details</a>
					<a href='controllers/approve_leaveRequest.php?id=$leaveID' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a>
					<a href='controllers/disapprove_leaveRequest.php?id=$leaveID' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></a>
					

				</td>
			</tr>";
	}


?>