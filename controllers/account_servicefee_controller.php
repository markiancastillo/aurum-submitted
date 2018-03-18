<?php
	$pageTitle = "My Service Fee Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(sfID) AS 'rowCount' FROM servicefees 
					  WHERE accountID = ?";
	$params_countRows = array($accID);
	$stmt_countRows = sqlsrv_query($con, $sql_countRows, $params_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_getList = "SELECT s.sfID, s.sfAmount, s.sfDate, s.sfRemarks, s.sfReviewedBy, s.sfNote, s.stypeID, t.stypeName, s.sfStatus
					FROM servicefees s 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID 
					WHERE s.accountID = ? 
					ORDER BY s.sfDate ASC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_servicefees = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$sfID = $row['sfID'];
		$sfDate = $row['sfDate']->format('m/d/Y');
		$sfAmount = htmlspecialchars($row['sfAmount'], ENT_QUOTES, 'UTF-8');
		$sfRemarks = htmlspecialchars($row['sfRemarks'], ENT_QUOTES, 'UTF-8');
		$stypeName = $row['stypeName'];
		$sfStatus = $row['sfStatus'];
		$sfNote = htmlspecialchars($row['sfNote'], ENT_QUOTES, 'UTF-8');
		
		$list_servicefees .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-right'>$sfAmount</td>
				<td class='text-center'>$stypeName</td>
				<td class='text-center'>$sfStatus</td>
				<td class='text-center'>$sfNote</td>
			</tr>
		";
	}
?>