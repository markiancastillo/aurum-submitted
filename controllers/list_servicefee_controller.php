<?php
	$pageTitle = "Service Fee Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(sfID) AS 'rowCount' FROM servicefees 
					  WHERE sfStatus != 'Approved' AND sfStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_getList = "SELECT s.sfID, s.sfAmount, s.sfDate, s.sfRemarks, s.stypeID, t.stypeName, a.accountFN, a.accountMN, a.accountLN, s.caseID, c.caseTitle 
					FROM servicefees s 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID 
					INNER JOIN accounts a ON s.accountID = a.accountID 
					INNER JOIN cases c ON s.caseID = c.caseID 
					WHERE s.sfStatus != 'Approved' AND s.sfStatus != 'Disapproved' AND s.accountID != ? 
					ORDER BY s.sfDate ASC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_servicefees = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$sfID = $row['sfID'];
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		$caseTitle = $row['caseTitle'];
		$sfDate = $row['sfDate']->format('m/d/Y');
		$sfAmount = $row['sfAmount'];
		$sfRemarks = $row['sfRemarks'];
		$stypeName = $row['stypeName'];
		
		$list_servicefees .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>$sfAmount</td>
				<td class='text-center'>$stypeName</td>
				<td class='text-center'>$sfRemarks</td>
				<td class='text-center'>
					<a href='view_servicefee.php?id=$sfID' class='btn btn-default' data-toggle='tooltip' data-position='top' title='tiptip'>Details</a>
					<a href='controllers/approve_servicefee.php?id=$sfID' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a>
					<a href='controllers/disapprove_servicefee.php?id=$sfID' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></a>
				</td>
			</tr>
		";
	}
?>