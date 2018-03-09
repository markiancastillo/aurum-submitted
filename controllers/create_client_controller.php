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
	$imgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						The image you selected is not valid. Please upload a valid image file (jpg, bmp, or png formats only).
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
			#validate the image file first
			#check that it is a valid image
			$imgType = mime_content_type($_FILES["inpPhoto"]["tmp_name"]);
			if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
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
			else
			{
				#the image file is invalid
				$msgDisplay = $imgError;
			}
		}
	}
?>