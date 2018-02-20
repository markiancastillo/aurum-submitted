<?php
	$pageTitle = "Process Billing";
	include('function.php');
	include(loadHeader());

	$sql_count = "SELECT COUNT (DISTINCT e.accountID) AS 'rowCount'
				  FROM expenses e
				  INNER JOIN cases c ON e.caseID = c.caseID
				  WHERE e.expenseStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_count = sqlsrv_query($con, $sql_count);

	while($rcount = sqlsrv_fetch_array($stmt_count))
	{
		$rowCount = $rcount['rowCount'];
	}


	#list the accounts with active cases & approved reimbursement requests
	$sql_billing = "SELECT DISTINCT a.accountID, a.accountFN, a.accountMN, a.accountLN, c.caseTitle
					FROM expenses e
					INNER JOIN accounts a ON e.accountID = a.accountID 
					INNER JOIN cases c ON e.caseID = c.caseID
					WHERE e.expenseStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_billing = sqlsrv_query($con, $sql_billing);


	$list_billing = "";
	while($row = sqlsrv_fetch_array($stmt_billing))
	{
		$accountID = $row['accountID'];
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = $row['caseTitle'];
		$list_billing .= "
			<tr>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>
					<a href='' class='btn btn-default btn-block'>View Details</a>
				</td>
			</tr>
		";
	}
?>