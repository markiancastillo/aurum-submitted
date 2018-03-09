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

	$sql_getList = "SELECT e.expenseID, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName, e.expenseStatus, e.expenseReviewedBy, e.expenseNote, a.accountFN, a.accountLN
					FROM expenses e 
					INNER JOIN accounts a ON e.expenseReviewedBy = a.accountID 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ?
					ORDER BY expenseDate DESC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_reimbursements = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN;
		$expenseID = $row['expenseID'];
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = $row['expenseAmount'];
		$expenseRemarks = $row['expenseRemarks'];
		$etypeName = $row['etypeName'];
		$expenseStatus = $row['expenseStatus'];
		$expenseReviewedBy = $row['expenseReviewedBy'];
		$expenseNote = $row['expenseNote'];
		
		$list_reimbursements .= "
			<tr>
				<td class='text-center'>$expenseDate</td>
				<td class='text-right'>$expenseAmount</td>
				<td class='text-center'>$etypeName</td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$expenseStatus</td>
				<td class='text-center'>$expenseNote</td>
				<td class='text-center'>
					<a href='' class='btn btn-default'>Review</a>
				</td>
			</tr>
		";
	}
?>