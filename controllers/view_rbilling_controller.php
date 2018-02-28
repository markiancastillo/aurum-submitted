<?php
	$pageTitle = "Reimbursement Details";
	include('function.php');
	include(loadHeader());
	determineAccounting();

	$rID = $_GET['id'];
	$cID = $_GET['cid'];

	$sql_details = "SELECT a.accountFN, a.accountMN, a.accountLN, c.caseTitle, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName
					FROM expenses e 
					INNER JOIN accounts a ON e.accountID = a.accountID 
					INNER JOIN cases c ON e.caseID = c.caseID
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ? AND e.expenseStatus = 'Approved' AND c.caseID = ?";
	$params_details = array($rID, $cID);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	$list_details = "";
	while($row = sqlsrv_fetch_array($stmt_details))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = $row['caseTitle'];
		$expenseDate = $row['expenseDate']->format('M d, Y');
		$expenseAmount = $row['expenseAmount'];
		$expenseRemarks = $row['expenseRemarks'];
		$etypeName = $row['etypeName'];

		$list_details .= "
			<tr>
				<td class='text-center'>$expenseDate</td>
				<td class='text-center'>$etypeName</td>
				<td class='text-center'>$expenseRemarks</td>
				<td class='text-center'>$expenseAmount</td>
			</tr>
		";
	}

	$sql_rtotal = "SELECT SUM(expenseAmount) AS expenseTotal 
				   FROM expenses 
				   WHERE accountID = ? AND expenseStatus = 'Approved' AND caseID = ?";
	$params_rtotal = array($rID, $cID);
	$stmt_rtotal = sqlsrv_query($con, $sql_rtotal, $params_rtotal);

	while($rowtot = sqlsrv_fetch_array($stmt_rtotal))
	{
		$expenseTotal = $rowtot['expenseTotal'];
	}

	if(isset($_POST['btnGenerate']))
	{
		header('location: controllers/generate_rpdf.php?id=' . $rID . '&cid=' . $cID);
	}
?>