<?php
	$pageTitle = "List of Clients";
	include('function.php');
	include(loadHeader());

	$sql_list = "SELECT clientID, clientPhoto, clientFN, clientMN, clientLN, clientEmail FROM clients";
	$stmt_list = sqlsrv_query($con, $sql_list);

	$list_client = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$clientID = $row['clientID'];
		$accountPhoto = openssl_decrypt(base64_decode($row['clientPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientFN = openssl_decrypt(base64_decode($row['clientFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientMN = openssl_decrypt(base64_decode($row['clientMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientLN = openssl_decrypt(base64_decode($row['clientLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$clientName = $clientLN . ", " . $clientFN . " " . $clientMN;
		$clientEmail = openssl_decrypt(base64_decode($row['clientEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
		#$path = $_SERVER['DOCUMENT_ROOT'] . '/aurum/images/profile/' . $clientPhoto;

		$image = getPhoto($accountPhoto);

		$list_client .= "
			<tr>
				<td class='text-center'><img src='images/profile/$image' width='50px' alt='img' /></td>
				<td class='text-center'>$clientName</td>
				<td class='text-center'>$clientEmail</td>
				<td class='text-center'>
					<a href='view_client.php?id=$clientID' class='btn btn-default'>View</a>
				</td>
			</tr>
		";
	}
?>