<?php
	$pageTitle = "My Payroll Receipts";
	include('function.php');
	include(loadHeader());

	$sql_count = "SELECT COUNT(pID) as 'rowCount' FROM payrolls 
				  WHERE accountID = ?";
	$params_count = array($accID);
	$stmt_count = sqlsrv_query($con, $sql_count, $params_count);
	while($rowC = sqlsrv_fetch_array($stmt_count))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_list = "SELECT receiptFile, receiptDate, receiptRemarks, receiptStatus FROM receipts
				 WHERE receiptRemarks LIKE 'Payroll%'
				 ORDER BY receiptDate DESC";
	$stmt_list = sqlsrv_query($con, $sql_list);

	$list_payrolll = "";
	while($rowL = sqlsrv_fetch_array($stmt_list))
	{
		$receiptFile = htmlspecialchars(openssl_decrypt(base64_decode($rowL['receiptFile']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$receiptDate = $rowL['receiptDate']->format('m/d/Y');
		$receiptRemarks = $rowL['receiptRemarks'];
		$receiptStatus = $rowL['receiptStatus'];

		$list_payroll .= "
			<tr>
				<td class='text-center'>$receiptDate</td>
				<td class='text-center'>$receiptFile</td>
				<td class='text-center'>$receiptRemarks</td>
				<td class='text-center'>$receiptStatus</td>
			</tr>
		";
	}

?>