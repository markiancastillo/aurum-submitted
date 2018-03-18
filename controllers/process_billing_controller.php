<?php
	$pageTitle = "Process Billing";
	include('function.php');
	include(loadHeader());

	determineAccounting();

	#get the number of valid reimbursement requests
	$sql_rcount = "SELECT COUNT (DISTINCT e.accountID) AS 'rCount'
				  FROM expenses e
				  INNER JOIN cases c ON e.caseID = c.caseID
				  WHERE e.expenseStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_rcount = sqlsrv_query($con, $sql_rcount);

	while($rc = sqlsrv_fetch_array($stmt_rcount))
	{
		$rCount = $rc['rCount'];
	}

	#get the number of valid service fee requests
	$sql_sfcount = "SELECT COUNT (DISTINCT s.accountID) AS 'sfCount'
					FROM servicefees s 
					INNER JOIN cases c ON s.caseID = c.caseID
				  	WHERE s.sfStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_sfcount = sqlsrv_query($con, $sql_sfcount);

	while($sfc = sqlsrv_fetch_array($stmt_sfcount))
	{
		$sCount = $sfc['sfCount'];
	}

	#total of both = rowCount
	#if rowCount == 0, display 'no records found' message
	$rowCount = $rCount + $sCount;

	#list the accounts with active cases & approved reimbursement requests
	$sql_rbilling = "SELECT DISTINCT a.accountID, a.accountFN, a.accountMN, a.accountLN, c.caseID, c.caseTitle
					FROM expenses e
					INNER JOIN accounts a ON e.accountID = a.accountID 
					INNER JOIN cases c ON e.caseID = c.caseID
					WHERE e.expenseStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_rbilling = sqlsrv_query($con, $sql_rbilling);

	$list_rbilling = "";
	while($row = sqlsrv_fetch_array($stmt_rbilling))
	{
		$accountID = $row['accountID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseID = $row['caseID'];
		$caseTitle = htmlspecialchars($row['caseTitle'], ENT_QUOTES, 'UTF-8');
		$list_rbilling .= "
			<tr>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>Reimbursement</td>			
				<td class='text-center'>
					<a href='view_rbilling.php?id=$accountID&cid=$caseID' class='btn btn-default'>View Details</a>
				</td>
			</tr>
		";
	}

	#list the accounts with active cases & approved service fee requests
	$sql_sbilling = "SELECT DISTINCT a.accountID, a.accountFN, a.accountMN, a.accountLN, c.caseID, c.caseTitle
					FROM servicefees s
					INNER JOIN accounts a ON s.accountID = a.accountID 
					INNER JOIN cases c ON s.caseID = c.caseID
					WHERE s.sfStatus = 'Approved' AND c.caseStatus = 'Active'";
	$stmt_sbilling = sqlsrv_query($con, $sql_sbilling);

	$list_sbilling = "";
	while($row = sqlsrv_fetch_array($stmt_sbilling))
	{
		$accountID = $row['accountID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseID = $row['caseID'];
		$caseTitle = htmlspecialchars($row['caseTitle'], ENT_QUOTES, 'UTF-8');
		$list_sbilling .= "
			<tr>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>Service Fee</td>			
				<td class='text-center'>
					<a href='view_sbilling.php?id=$accountID&cid=$caseID' class='btn btn-default'>View Details</a>
				</td>
			</tr>
		";
	}

	$msgDisplay = "";
	if(isset($_GET['generated']))
	{
		$msgDisplay = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Billing PDF file successfully saved to " . $_SERVER['DOCUMENT_ROOT'] . "/aurum/files/billing/" . $_GET['file'] . ".pdf
					</div>";
	}
?>