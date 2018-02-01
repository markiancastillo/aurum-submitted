<?php
	$pageTitle = "Reimbursement Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

		$sql_countRows = "SELECT COUNT(expenseID) AS 'rowCount' FROM expenses 
						  WHERE expenseStatus != 'Approved'";
		$stmt_countRows = sqlsrv_query($con, $sql_countRows);
		while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
		{
			$rowCount = $rowC['rowCount'];
		}

		$sql_getList = "SELECT e.expenseID, a.accountLN, a.accountFN, a.accountMN, c.caseTitle, e.expenseDate, e.expenseAmount, t.etypeName 
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
			$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
			$caseTitle = $row['caseTitle'];
			$expenseDate = $row['expenseDate']->format('m/d/Y');
			$expenseAmount = $row['expenseAmount'];
			$etypeName = $row['etypeName'];
			
			$list_reimbursements .= "
				<tr>
					<td class='text-center'>$expenseDate</td>
					<td class='text-center'>$accountName</td>
					<td class='text-center'>$caseTitle</td>
					<td class='text-center'>$expenseAmount</td>
					<td class='text-center'>$etypeName</td>
					<td class='text-center'>
						<a href='view_reimbursement.php?id=$expenseID' class='btn btn-default' data-toggle='tooltip' data-position='top' title='tiptip'>Details</a>
						<a href='' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a>
						<a href='' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></a>
					</td>
				</tr>
			";
		}

?>