<?php
	$pageTitle = "My Service Fee Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(sfID) AS 'rowCount' FROM servicefees 
					  WHERE accountID = $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_getList = "SELECT s.sfID, s.sfAmount, s.sfDate, s.sfRemarks, s.sfReviewedBy, s.sfNote, s.stypeID, t.stypeName, s.sfStatus, a.accountFN, a.accountLN
					FROM servicefees s 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID 
					INNER JOIN accounts a ON s.sfReviewedBy = a.accountID 
					WHERE s.accountID = ? 
					ORDER BY s.sfDate ASC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_servicefees = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN;
		$sfID = $row['sfID'];
		$sfDate = $row['sfDate']->format('m/d/Y');
		$sfAmount = $row['sfAmount'];
		$sfRemarks = $row['sfRemarks'];
		$stypeName = $row['stypeName'];
		$sfStatus = $row['sfStatus'];
		$sfReviewedBy = $row['sfReviewedBy'];
		$sfNote = $row['sfNote'];
		
		$list_servicefees .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-right'>$sfAmount</td>
				<td class='text-center'>$stypeName</td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$sfStatus</td>
				<td class='text-center'>$sfNote</td>
				<td class='text-center'>
					<a href='' class='btn btn-default'>Review</a>
				</td>
			</tr>
		";
	}
?>