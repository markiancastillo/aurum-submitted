<?php
	$pageTitle = "Reimbursement Details";
	include('function.php');
	include(loadHeader());

	determineAccounting();

	$rID = $_GET['id'];
	$cID = $_GET['cid'];

	$sql_details = "SELECT a.accountFN, a.accountMN, a.accountLN, c.caseTitle, s.sfDate, s.sfAmount, s.sfRemarks 
					FROM servicefees s 
					INNER JOIN accounts a ON s.accountID = a.accountID 
					INNER JOIN cases c ON s.caseID = c.caseID
					WHERE s.accountID = ? AND s.sfStatus = 'Approved' AND c.caseID = ?";
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
		$sfDate = $row['sfDate']->format('M d, Y');
		$sfAmount = $row['sfAmount'];
		$sfRemarks = $row['sfRemarks'];

		$list_details .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-center'>$sfRemarks</td>
				<td class='text-center'>$sfAmount</td>
			</tr>
		";
	}

	$sql_stotal = "SELECT SUM(sfAmount) AS sfTotal 
				   FROM servicefees 
				   WHERE accountID = ? AND sfStatus = 'Approved' AND caseID = ?";
	$params_stotal = array($rID, $cID);
	$stmt_stotal = sqlsrv_query($con, $sql_stotal, $params_stotal);

	while($rowtot = sqlsrv_fetch_array($stmt_stotal))
	{
		$sfTotal = $rowtot['sfTotal'];
	}
?>