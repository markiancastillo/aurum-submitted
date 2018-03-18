<?php
	$pageTitle = "List of Accounts";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$selfID = $_SESSION['accID'];

	#get the list of accounts excluding self
	#display them in a table format
	$sql_listAccounts = "SELECT a.accountID, a.accountPhoto, a.accountFN, a.accountMN, a.accountLN, a.accountStatus, p.positionName, d.departmentName 
						FROM accounts a 
						INNER JOIN positions p ON a.positionID = p.positionID 
						INNER JOIN departments d ON a.departmentID = d.departmentID
						WHERE a.accountID != ? 
						ORDER BY a.accountID";
	$params_listAccounts = array($selfID);
	$stmt_listAccounts = sqlsrv_query($con, $sql_listAccounts, $params_listAccounts);

	$displayList = "";
	while($row = sqlsrv_fetch_array($stmt_listAccounts))
	{
		$accountID = $row['accountID'];
		$accountPhoto = openssl_decrypt(base64_decode($row['accountPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountStatus = $row['accountStatus'];
		$positionName = $row['positionName'];
		$departmentName = $row['departmentName'];

		$accountName = $accountLN . ", " . $accountFN . " " . $accountMN;

		$disableButton = strcasecmp(trim($accountStatus), "Archived") == 0 ? "disabled" : "href='archive_account.php?id=$accountID'";
		
		$image = getPhoto($accountPhoto);

		$displayList .= "
			<tr>
				<td class='text-center'><img src='images/profile/$image' width='50px' alt='img'></td>
				<td class='text-center'>$accountID</td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$positionName</td>
				<td class='text-center'>$departmentName</td>
				<td class='text-center'>
					<a href='view_account.php?id=$accountID' class='btn btn-sm btn-default'>View Details</a>
					<a class='btn btn-sm btn-danger' $disableButton>Archive</a>
				</td>
			</tr>
		";
	}

	$sql_countAccounts = "SELECT COUNT(accountID) AS 'rowCount'
						  FROM accounts 
						  WHERE accountID != ?";
	$params_countAccounts = array($selfID);
	$stmt_countAccounts = sqlsrv_query($con, $sql_countAccounts, $params_countAccounts);

	while($row2 = sqlsrv_fetch_array($stmt_countAccounts))
	{
		$rowCount = $row2['rowCount'];
	}
?>