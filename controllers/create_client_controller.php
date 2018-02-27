<?php
	$pageTitle = "Create a Client";
	include('function.php');
	include(loadHeader());

	$msgDisplay = "";
	$msgSuccess = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Client data successfully created.
					</div>";
	$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to create client data. Please check your inputs and try again.
					</div>";

	if(isset($_POST['btnSubmit']))
	{
		$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));

		if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
		{
			#no input for photo; do not include in insert
			$sql_insert = "INSERT INTO clients (clientPhoto, clientFN, clientMN, clientLN, clientEmail) 
						   VALUES (?, ?, ?, ?)";
			$params_insert = array($inpFN, $inpMN, $inpLN, $inpEmail);
		}
		else
		{
			$imgName = $_FILES["inpPhoto"]["name"];
			$imgDir = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/profile/";				
			$imgNew = "cl-" . $_POST['inpFN'] . "-" . basename($imgName);
			$imgFile = $imgDir . $imgNew;

			move_uploaded_file($_FILES["inpPhoto"]["tmp_name"], $imgFile);

			$inpPhoto = base64_encode(openssl_encrypt($imgNew, $method, $password, OPENSSL_RAW_DATA, $iv));

			$sql_insert = "INSERT INTO clients (clientPhoto, clientFN, clientMN, clientLN, clientEmail) 
						   VALUES (?, ?, ?, ?, ?)";
			$params_insert = array($inpPhoto, $inpFN, $inpMN, $inpLN, $inpEmail);
		}

		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		if($stmt_insert === false)
		{
			$msgDisplay = $msgError;
		}
		else 
		{
			$msgDisplay = $msgSuccess;
		}
	}
?>