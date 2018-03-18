<?php
	$pageTitle = "My Account";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	#get account information
	$sql_account = "SELECT a.accountUsername, a.accountPhoto, a.accountFN, a.accountMN, a.accountLN, a.accountBirthdate, a.accountSex, a.accountSSSNo, a.accountTINNo, a.accountHDMFNo, a.accountEmail, a.accountBaseRate, c.cstatusID, p.positionID, d.departmentID 
	                FROM accounts a 
	                INNER JOIN civilstatuses c ON a.cstatusID = c.cstatusID 
	                INNER JOIN positions p ON a.positionID = p.positionID
	                INNER JOIN departments d ON a.departmentID = d.departmentID
	                WHERE a.accountID = ?";
	$params_account = array($accID);
	$options_account = array("Scrollable"=>'static');             
	$stmt_account = sqlsrv_query($con, $sql_account, $params_account, $options_account);
	while($row = sqlsrv_fetch_array($stmt_account))
	{
		$accountUsername = htmlspecialchars(openssl_decrypt(base64_decode($row['accountUsername']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountPhoto = openssl_decrypt(base64_decode($row['accountPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountBirthdate = $row['accountBirthdate']->format('Y-m-d');
		$accountSex = $row['accountSex'];
		$accountSSSNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountSSSNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountTINNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountTINNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountHDMFNo = htmlspecialchars(openssl_decrypt(base64_decode($row['accountHDMFNo']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountEmail = htmlspecialchars(openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountBaseRate = htmlspecialchars($row['accountBaseRate'], ENT_QUOTES, 'UTF-8');
		$selectedcsID = $row['cstatusID'];
		$selectedposID = $row['positionID'];
		$selecteddeptID = $row['departmentID'];
	}

	#get selected sex
	if(strcasecmp(trim($accountSex), "M") == 0)
	{
		$selectedM = "selected";
		$selectedF = "";
	}
	else 
	{
		$selectedM = "";
		$selectedF = "selected";
	}
	
	#get selected department
	$dept = getDepartments($con);

	#get selected position
	$pos = getPositions($con);

	#get selected civil status
	$cs = getCivilStatuses($con);
	

	$contactNumber = "";
	#get contact number information (main number only)
	$sql_getNumber = "SELECT TOP 1 contactID, contactNumber FROM contacts 
					  WHERE ctypeID = ? AND accountID = ?";
	$params_getNumber = array(1, $accID);
	$stmt_getNumber = sqlsrv_query($con, $sql_getNumber, $params_getNumber);
	while($rowNum = sqlsrv_fetch_array($stmt_getNumber))
	{
		$numberID = $rowNum['contactID'];
		$contactNumber = htmlspecialchars(openssl_decrypt(base64_decode($rowNum['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
	}

	#get adress
	$addressL1 = ""; $addressL2 = ""; $addressCity = ""; $addressZip = "";
	$sql_getAddress = "SELECT TOP 1 addressID, addressL1, addressL2, addressCity, addressZip FROM addresses 
					   WHERE accountID = ?";
	$params_getAddress = array($accID);
	$stmt_getAddress = sqlsrv_query($con, $sql_getAddress, $params_getAddress);
	while($rowAddress = sqlsrv_fetch_array($stmt_getAddress))
	{
		$addressID = $rowAddress['addressID'];
		$addressL1 = htmlspecialchars(openssl_decrypt(base64_decode($rowAddress['addressL1']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressL2 = htmlspecialchars(openssl_decrypt(base64_decode($rowAddress['addressL2']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressCity = htmlspecialchars(openssl_decrypt(base64_decode($rowAddress['addressCity']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$addressZip = htmlspecialchars(trim($rowAddress['addressZip']), ENT_QUOTES, 'UTF-8');
	}

	#validations:
	#username - at least 6 characters, not taken. Add tooltip
	#email - must be a valid email
	#SSS, TIN, HDMF - based on a valid number
	$msgDisplay = "";
	$msgSuccess = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Account information successfully updated.
					</div>";
	$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					That username already exists. Please choose a different one.
				</div>";
	if(isset($_POST['btnUpdate']))
	{
		#check if user uploaded a photo
		if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
		{
			#there is no new input for account photo
			#do not update it in the database
		}
		else
		{
			#validate if the uploaded file is a valid image
			#(accept it as valid if the type is a png, bmp, or jpg/jpeg)
			$imgType = mime_content_type($_FILES["inpPhoto"]["tmp_name"]);
			if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
			{
				#update the photo with the new input
				$imgName = $_FILES["inpPhoto"]["name"];
	    		uploadPhoto($con, $accID, $imgName);
			}
			else
			{
				#display an error prompt
	    		die(header('location: account.php?img=error'));
			}
		}

		#get the data from the form
		$inpUsername = base64_encode(openssl_encrypt($_POST['inpUN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpBDay = $_POST['inpBDay'];
		$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpNumber = base64_encode(openssl_encrypt($_POST['inpNumber'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpSex = $_POST['inpSex'];

		$inpAddressL1 = base64_encode(openssl_encrypt($_POST['inpAddressL1'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpAddressL2 = base64_encode(openssl_encrypt($_POST['inpAddressL2'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpCity = base64_encode(openssl_encrypt($_POST['inpCity'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpZip = $_POST['inpZip'];

		#check if the user has input on the email field
		if(!isset($inpEmail) || trim($inpEmail) == base64_encode(openssl_encrypt('', $method, $password, OPENSSL_RAW_DATA, $iv)))
		{
			#the email field is left empty
			#do not update
		}
		else 
		{
			#email has an input
			#validate if the input email is not taken
			$emailCount = validateEmail($con, $inpEmail);
			if($emailCount > 0)
			{
				#input emial already exists
				#display an error
				die(header('location: account.php?email=error'));
			}
			else 
			{
				#input email is unique; update the record
				$sql_updEmail = "UPDATE accounts SET accountEmail = ? WHERE accountID = ?";
				$params_updEmail = array($inpEmail, $accID);
				$stmt_updEmail = sqlsrv_query($con, $sql_updEmail, $params_updEmail);
			}
		}

		if(empty($inpUsername) || $inpUsername === base64_encode(openssl_encrypt('', $method, $password, OPENSSL_RAW_DATA, $iv)))
		{
			#if the username field is left blank
			#do not update the username
			$sql_update = "UPDATE accounts 
						   SET accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ?
						   WHERE accountID = ?";
			$params_update = array($inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $accID);
			$stmt_update = sqlsrv_query($con, $sql_update, $params_update);
			updMainNumber($con, $numberID, $inpNumber, $accID);

			updAddress($con, $accID, $addressID, $inpAddressL1, $inpAddressL2, $inpCity, $inpZip);

			$txtEvent = "User with ID # " . $accID . " updated their account information.";
			logEvent($con, $accID, $txtEvent);

			header('location: account.php?updated=yes');
		}
		else
		{
			#username field has an input - include it in the update
			#validate first if username is available or not
			if(strcmp(validateUsername($con, $inpUsername), "available") == 0)
			{
				#username is valid 
				$sql_update = "UPDATE accounts 
						   SET accountUsername = ?, accountFN = ?, accountMN = ?, accountLN = ?, accountBirthDate = ?, accountSex = ? 
						   WHERE accountID = ?";
				$params_update = array($inpUsername, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $accID);
				$stmt_update = sqlsrv_query($con, $sql_update, $params_update);
				updMainNumber($con, $numberID, $inpNumber, $accID);

				updAddress($con, $accID, $addressID, $inpAddressL1, $inpAddressL2, $inpCity, $inpZip);

				$txtEvent = "User with ID # " . $accID . " updated their account information.";
				logEvent($con, $accID, $txtEvent);

				header('location: account.php?updated=yes');
			}
			else 
			{
				#the input username already exists. display an eror message
				#$msgDisplay = $msgError;
				header('location: account.php?username=error');
			} 
		}
	}	
?>