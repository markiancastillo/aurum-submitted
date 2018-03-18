<?php
	$pageTitle = "Reimbursement Details";
	include('function.php');
	include(loadHeader());
	determineAccounting();

	$rID = $_GET['id'];
	$cID = $_GET['cid'];

	$sql_details = "SELECT a.accountFN, a.accountMN, a.accountLN, c.caseTitle, s.sfDate, s.sfAmount, s.sfRemarks, t.stypeName
					FROM servicefees s 
					INNER JOIN accounts a ON s.accountID = a.accountID 
					INNER JOIN cases c ON s.caseID = c.caseID
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID
					WHERE s.accountID = ? AND s.sfStatus = 'Approved' AND c.caseID = ?";
	$params_details = array($rID, $cID);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	$list_details = "";
	while($row = sqlsrv_fetch_array($stmt_details))
	{
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = htmlspecialchars($row['caseTitle'], ENT_QUOTES, 'UTF-8');
		$sfDate = $row['sfDate']->format('M d, Y');
		$sfAmount = htmlspecialchars($row['sfAmount'], ENT_QUOTES, 'UTF-8');
		$sfRemarks = htmlspecialchars($row['sfRemarks'], ENT_QUOTES, 'UTF-8');
		$stypeName = $row['stypeName'];

		$list_details .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-center'>$stypeName</td>
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

	if(isset($_POST['btnGenerate']))
	{
		header('location: controllers/generate_spdf.php?id=' . $rID . '&cid=' . $cID);
	}
?>