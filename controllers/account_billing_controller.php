<?php
	$pageTitle = "My Billing Records";
	include('function.php');
	include(loadHeader());

	$sql_count = "SELECT COUNT(receiptID) AS recordCount FROM receipts 
				  WHERE accountID = ?";
	$params_count = array($accID);
	$stmt_list = sqlsrv_query($con, $sql_count, $params_count);

	while($rc = sqlsrv_fetch_array($stmt_list))
	{
		$rowCount = $rc['recordCount'];
	}

	$sql_list = "SELECT receiptFile, receiptDate, receiptRemarks FROM receipts 
				 WHERE accountID = ? 
				 ORDER BY receiptDate DESC";
	$params_list = array($accID);
	$stmt_list = sqlsrv_query($con, $sql_list, $params_list);

	$list_billing = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$receiptFile = openssl_decrypt(base64_decode($row['receiptFile']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$receiptDate = $row['receiptDate']->format('m/d/Y');
		$receiptRemarks = $row['receiptRemarks'];

		$list_billing .= "
			<tr>
				<td class='text-center'>$receiptDate</td>
				<td class='text-center'>$receiptFile</td>
				<td class='text-center'>$receiptRemarks</td>
			</tr>
		";
	}
?>	