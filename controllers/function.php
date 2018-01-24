<?php
	#determine which header to load based on
	#the logged in account's positionID
	function loadHeader()
	{
		session_start();
		if(isset($_SESSION['accID']))
		{
			$accID = $_SESSION['accID'];
			$posID = $_SESSION['posID'];

			if($posID == 1 || $posID == 6 || $posID == 8)
			{
				#load header_admin when account's position is either:
				#1 - managing partner
				#6 - executive assistant
				#8 - HR assistant
				$header = "includes/header_admin.php";
			}
			else
			{
				#account does not have adminstrative powers
				$header = "includes/header.php";
			}
			return $header;
		}
	}

	#determine if the account has administrative access
	function determineAccess()
	{
		$posID = $_SESSION['posID'];
		if($posID == 8)
		{
			#if the user is from HR, grant them access to edit the fields
			$access = "";
		}
		else
		{
			$access = "disabled";
		}
		return $access;

	}

	#get account details 
	function getAccounts($con, $reqID)
	{
		$sql_account = "SELECT a.accountFN, a.accountMN, a.accountLN, a.accountBirthdate, a.accountSex, a.accountSSSNo, a.accountTINNo, a.accountBIRNo, a.accountHDMFNo, a.accountEmail, a.accountBaseRate, a.accountStatus, c.cstatusName, p.positionName, d.departmentName 
	                	FROM accounts a 
	                	INNER JOIN civilstatuses c ON a.cstatusID = c.cstatusID 
	                	INNER JOIN positions p ON a.positionID = p.positionID
	                	INNER JOIN departments d ON a.departmentID = d.departmentID 
	                	WHERE accountID = ?";
		$params_account = array($reqID);
		$stmt_account = sqlsrv_query($con, $sql_account, $params_account);
		return $stmt_account;	                	
	}

	function getAddress($con, $reqID)
	{
		$sql_address = "SELECT addressL1, addressL2, addressCity, addressZip FROM addresses 
						WHERE accountID = ?";
		$params_address = array($reqID);
		$stmt_address = sqlsrv_query($con, $sql_address, $params_address);
		return $stmt_address;
	}

	#get the list of civil statuses
	function getCivilStatuses($con)
	{
		$sql_cstatus = "SELECT cstatusID, cstatusName FROM civilstatuses";
		$stmt_cstatus = sqlsrv_query($con, $sql_cstatus);
		return $stmt_cstatus;
	}

	function getContacts($con, $reqID)
	{
		$sql_contacts = "SELECT n.contactNumber, t.ctypeName FROM contacts n 
						 INNER JOIN contacttypes t ON n.ctypeID = t.ctypeID 
						 WHERE accountID = ?";
		$params_contacts = array($reqID);
		$stmt_contacts = sqlsrv_query($con, $sql_contacts, $params_contacts);
		return $stmt_contacts;
	}

	function getContactTypes($con)
	{
		$sql_cTypes = "SELECT ctypeID, ctypeName FROM contacttypes";
		$stmt_cTypes = sqlsrv_query($con, $sql_cTypes);
		return $stmt_cTypes;
	}

	#get the list of departments
	function getDepartments($con)
	{
		$sql_departments = "SELECT departmentID, departmentName FROM departments ORDER BY departmentName";
		$stmt_departments = sqlsrv_query($con, $sql_departments);
		return $stmt_departments;
	}

	#get the user's photo
	function getPhoto($accountPhoto)
	{
		include ('security.php');
		$displayPhoto = ($accountPhoto === NULL || $accountPhoto === openssl_decrypt(base64_decode(''), $method, $password, OPENSSL_RAW_DATA, $iv)) ? "placeholder.png" : $accountPhoto;
		return $displayPhoto;
	}

	#get the list of positions
	function getPositions($con)
	{
		$sql_positions = "SELECT positionID, positionName FROM positions ORDER BY positionName";
		$stmt_positions = sqlsrv_query($con, $sql_positions);
		return $stmt_positions;
	}

	function updMainNumber($con, $numberID, $inpNumber, $inpAcc)
	{
		#if contact number field in 'my account' page is getting an input for the first time,
		#insert number instead and set its type as 'Main'

		#check first if input from form doesnt exist yet
		#if so, insert the input and set its type to 'Primary' 
		$sql_chkContact = "SELECT COUNT(contactID) AS contactCount FROM contacts 
						   WHERE ctypeID = ? AND accountID = ?";
		$params_chkContact = array(1, $inpAcc);
		$stmt_chkContact = sqlsrv_query($con, $sql_chkContact, $params_chkContact);

		while($row = sqlsrv_fetch_array($stmt_chkContact))
		{
			$contactCount = $row['contactCount'];
		}

		if($contactCount <= 0)
		{
			#insert a new record
			$sql_insContact = "INSERT INTO contacts (contactNumber, ctypeID, accountID) 
							   VALUES (?, ?, ?)";
			$params_insContact = array($inpNumber, 1, $inpAcc);
			$stmt_insContact = sqlsrv_query($con, $sql_insContact, $params_insContact);
			return $stmt_insContact;
		}
		else
		{
			#update data
			$sql_updContact = "UPDATE contacts SET contactNumber = ? WHERE contactID = ? AND accountID = ?";
			$params_updContact = array($inpNumber, $numberID, $inpAcc);
			$stmt_updContact = sqlsrv_query($con, $sql_updContact, $params_updContact);
			return $stmt_updContact;
		}
	}

	function uploadPhoto($con, $accID, $imgName)
	{
		include('security.php');
		#directory where the image will be stored
		$imgDir = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/";
		#filename will be uploader's ID + image name
		#e.g. 1_photo.png
		#this makes them unique for each user and prevents
		#overwriting of files with the same name
		$imgNew = $accID . "_" . basename($imgName);
		$imgFile = $imgDir . $imgNew;

		move_uploaded_file($_FILES["inpPhoto"]["tmp_name"], $imgFile);

		$encrypt_img = base64_encode(openssl_encrypt($imgNew, $method, $password, OPENSSL_RAW_DATA, $iv));
		$sql_upload = "UPDATE accounts SET accountPhoto = ? WHERE accountID = ?";
		$params_upload = array($encrypt_img, $accID);
		$stmt_upload = sqlsrv_query($con, $sql_upload, $params_upload);
	}

	#check for the validity of the input username
	#(if it is available or is taken)
	function validateUsername($con, $inpUsername)
	{
		$sql_valUsername = "SELECT accountID, accountUsername FROM accounts 
							WHERE accountUsername = ?";
		$params_valUsername = array($inpUsername);				
		$options_valUsername = array('Scrollable'=>'static');
		$stmt_valUsername = sqlsrv_query($con, $sql_valUsername, $params_valUsername, $options_valUsername);
		$username_row_count = sqlsrv_num_rows($stmt_valUsername);

		$valUsername = ($username_row_count > 0) ? "existing" : "available";
		return $valUsername;
	}

	function logEvent($con, $accID, $txtEvent)
	{
		$sql_log = "INSERT INTO logs(logAccount, logEvent, logDate) 
					VALUES (?, ?, CURRENT_TIMESTAMP)";
		#$timestamp = date('Y-m-d H:i:s');
		$params_log = array($accID, $txtEvent);
		$stmt_log = sqlsrv_query($con, $sql_log, $params_log);
	}
?>