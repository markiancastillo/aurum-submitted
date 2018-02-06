<?php
	$pageTitle = "My Reimbursement Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(expenseID) AS 'rowCount' FROM expenses 
					  WHERE accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_getList = "SELECT e.expenseID, c.caseTitle, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName, e.expenseStatus
					FROM expenses e 
					INNER JOIN cases c ON e.caseID = c.caseID 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ?
					ORDER BY expenseDate DESC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_reimbursements = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$expenseID = $row['expenseID'];
		$caseTitle = $row['caseTitle'];
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = $row['expenseAmount'];
		$expenseRemarks = $row['expenseRemarks'];
		$etypeName = $row['etypeName'];
		$expenseStatus = $row['expenseStatus'];
		
		$list_reimbursements .= "
			<tr>
				<td class='text-center'>$expenseDate</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>$expenseAmount</td>
				<td class='text-center'>$etypeName</td>
				<td class='text-center'>$expenseRemarks</td>
				<td class='text-center'>$expenseStatus</td>
			</tr>
		";
	}
?>