<?php
	$pageTitle = "Reimbursement Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(expenseID) AS 'rowCount' FROM expenses 
					  WHERE expenseStatus != 'Approved' AND expenseStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}
	
	$sql_getList = "SELECT e.expenseID, a.accountLN, a.accountFN, a.accountMN, c.caseTitle, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName 
					FROM expenses e 
					INNER JOIN accounts a ON e.accountID = a.accountID 
					INNER JOIN cases c ON e.caseID = c.caseID 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.expenseStatus != 'Approved' AND e.expenseStatus != 'Disapproved' AND e.accountID != ?
					ORDER BY expenseDate ASC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);
	
	$list_reimbursements = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$expenseID = $row['expenseID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = htmlspecialchars($row['caseTitle'], ENT_QUOTES, 'UTF-8');
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = $row['expenseAmount'];
		#$expenseRemarks = $row['expenseRemarks'];
		$expenseRemarks = htmlspecialchars($row['expenseRemarks'], ENT_QUOTES, 'UTF-8');
		$etypeName = $row['etypeName'];
		
		$list_reimbursements .= "
			<tr>
				<td class='text-center'>$expenseDate</td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>$expenseAmount</td>
				<td class='text-center'>$etypeName</td>
				<td class='text-center'>$expenseRemarks</td>
				<td class='text-center'>
					<a href='view_reimbursement.php?id=$expenseID' class='btn btn-default'>
						Details
					</a>
					<a href='controllers/approve_reimbursement.php?id=$expenseID' class='btn btn-success' data-toggle='tooltip' data-position='right' title='Approve Request'>
						<span class='glyphicon glyphicon-ok'></span>
					</a>
				</td>
			</tr>
		";
	}

?>