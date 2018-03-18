<?php
	$pageTitle = "Client Details";
	include('function.php');
	include(loadHeader());

	if(isset($_GET['id']))
	{
		$reqID = $_GET['id'];
		$sql_details = "SELECT clientPhoto, clientFN, clientMN, clientLN, clientEmail 
				        FROM clients 
				        WHERE clientID = ?";
		$params_details = array($reqID);
		$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

		$list_client = "";
		while($row = sqlsrv_fetch_array($stmt_details))
		{
			$clientID = $row['clientID'];
			$accountPhoto = openssl_decrypt(base64_decode($row['clientPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$clientFN = htmlspecialchars(openssl_decrypt(base64_decode($row['clientFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$clientMN = htmlspecialchars(openssl_decrypt(base64_decode($row['clientMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$clientLN = htmlspecialchars(openssl_decrypt(base64_decode($row['clientLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$clientEmail = htmlspecialchars(openssl_decrypt(base64_decode($row['clientEmail']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');

			$image = getPhoto($accountPhoto);
		}

		$msgDisplay = "";
		if(isset($_POST['btnUpdate']))
		{
			#update the client data
			$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));

			$sql_update = "UPDATE clients SET clientFN = ?, clientMN = ?, clientLN = ?, clientEmail = ?
						   WHERE clientID = ?";
			$params_update = array($inpFN, $inpMN, $inpLN, $inpEmail, $reqID);
			$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

			if($stmt_update === false)
			{
				$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Failed to update client information. Please check your input and try again.
								</div>";
			}
			else
			{
				$txtEvent = "User with ID # " . $accID . " updated the details of client # " . $reqID . ".";
				logEvent($con, $accID, $txtEvent);

				header('location: list_client.php?update=success');
			}
		}
	}
	else
	{
		header('location: list_client.php');
	}
?>