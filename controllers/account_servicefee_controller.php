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

	$sql_getList = "SELECT s.sfID, s.sfAmount, s.sfDate, s.sfRemarks, s.stypeID, t.stypeName, s.caseID, c.caseTitle, s.sfStatus
					FROM servicefees s 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID 
					INNER JOIN cases c ON s.caseID = c.caseID 
					WHERE s.accountID = ? 
					ORDER BY s.sfDate ASC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_servicefees = "";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$sfID = $row['sfID'];
		$caseTitle = $row['caseTitle'];
		$sfDate = $row['sfDate']->format('m/d/Y');
		$sfAmount = $row['sfAmount'];
		$sfRemarks = $row['sfRemarks'];
		$stypeName = $row['stypeName'];
		$sfStatus = $row['sfStatus'];
		
		$list_servicefees .= "
			<tr>
				<td class='text-center'>$sfDate</td>
				<td class='text-center'>$caseTitle</td>
				<td class='text-center'>$sfAmount</td>
				<td class='text-center'>$stypeName</td>
				<td class='text-center'>$sfRemarks</td>
				<td class='text-center'>$sfStatus</td>
			</tr>
		";
	}
?>