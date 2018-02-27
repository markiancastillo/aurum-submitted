<?php
	$pageTitle = "Create New User";
	include('function.php');
	include(loadHeader());
	$accID = $_SESSION['accID'];
	#for new accounts, default username: firstname.lastname
	#for new accounts, default password: change.lastname
	#for new accounts, status is set to: "pending" - will require password change on first login. After first password change, status will be 'Active'

	#validate that the user is in the HR department
	#deny access if user is not HR
	$sql_validate = "SELECT positionID FROM accounts WHERE accountID = ?";
	$params_validate = array($accID);
	$stmt_validate = sqlsrv_query($con, $sql_validate, $params_validate);
	while($valrow = sqlsrv_fetch_array($stmt_validate))
	{
		$accPos = $valrow['positionID'];
	}

	if($accPos == 8)
	{
		$list_departments = "";
		$dept = getDepartments($con);
		while($row = sqlsrv_fetch_array($dept))
		{
			$departmentID = $row['departmentID'];
			$departmentName = $row['departmentName'];
			$list_departments .= "<option value='$departmentID'>$departmentName</option>";
		}
	
		$list_positions = "";
		$pos = getPositions($con);
		while($row = sqlsrv_fetch_array($pos))
		{
			$positionID = $row['positionID'];
			$positionName = $row['positionName'];
			$list_positions .= "<option value='$positionID'>$positionName</option>";
		}
	
		$list_cstatus = "";
		$cs = getCivilStatuses($con);
		while($row = sqlsrv_fetch_array($cs))
		{
			$cstatusID = $row['cstatusID'];
			$cstatusName = $row['cstatusName'];
			$list_cstatus .= "<option value='$cstatusID'>$cstatusName</option>";
		}
	
		$msgDisplay = "";
		$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to create a new account! Please check your input and try again.
					</div>";
		$msgSuccess = "<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Successfully created a new account!
						</div>";
		$errEmail = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Email address already exists. Please input a valid email address.
					</div>";
	
		if(isset($_POST['btnSubmit']))
		{
			#get data from the input form
			#photo uploading to be added
			$inpFN = base64_encode(openssl_encrypt($_POST['inpFN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpMN = base64_encode(openssl_encrypt($_POST['inpMN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpLN = base64_encode(openssl_encrypt($_POST['inpLN'], $method, $password, OPENSSL_RAW_DATA, $iv));
	
			#convert all letters to lower case & remove spaces. This will be used as a default username
			$UN = strtolower(str_replace(' ', '', $_POST['inpFN']) . '.' . str_replace(' ', '', $_POST['inpLN']));
			$defUsername = base64_encode(openssl_encrypt($UN, $method, $password, OPENSSL_RAW_DATA, $iv));
			#do the same for password:
			$defPassword = base64_encode(openssl_encrypt(strtolower('change' . '.' . str_replace(' ', '', $_POST['inpLN'])), $method, $password, OPENSSL_RAW_DATA, $iv));
	
			$inpBDay = $_POST['inpBDay'];
			$inpEmail = base64_encode(openssl_encrypt($_POST['inpEmail'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpSex = $_POST['inpSex'];
			$inpSSS = base64_encode(openssl_encrypt($_POST['inpSSS'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpTIN = base64_encode(openssl_encrypt($_POST['inpTIN'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpBIR = base64_encode(openssl_encrypt($_POST['inpBIR'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpHDMF = base64_encode(openssl_encrypt($_POST['inpHDMF'], $method, $password, OPENSSL_RAW_DATA, $iv));
			$inpCivilStatus = $_POST['inpCivilStatus'];
			$inpPosition = $_POST['inpPosition'];
			$inpDepartment = $_POST['inpDepartment'];
			$inpBaseRate = $_POST['inpBaseRate'];
	
			$sql_insert = "INSERT INTO accounts (accountUsername, accountPassword, accountFN, accountMN, accountLN, accountBirthDate, accountSex, accountSSSNo, accountTINNo, accountBIRNo, accountHDMFNo, accountEmail, accountBaseRate, accountStatus, cstatusID, positionID, departmentID) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$params_insert = array($defUsername, $defPassword, $inpFN, $inpMN, $inpLN, $inpBDay, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpEmail, $inpBaseRate, "Pending", $inpCivilStatus, $inpPosition, $inpDepartment);
	
			if(isset($inpEmail))
			{
				#email address field has an input
				#check to see if it is valid
	
				$emailCount = validateEmail($con, $inpEmail);
				if($emailCount > 0)
				{
					#input email already exists
					#do not update; show an error message
					$msgDisplay = $errEmail;
				}
				else
				{
					#input email is unique
					#update it in the database
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
	
					if($stmt_insert === false)
					{
						$msgDisplay = $msgError;
					}
					else 
					{
						$msgDisplay = $msgSuccess;
						$txtEvent = "User with ID #" . $accID . " created a new account for: " . trim($_POST['inpFN']) . " " . trim($_POST['inpMN']) . " " . trim($_POST['inpLN']) . ".";
						logEvent($con, $accID, $txtEvent);
					}
				}
			}
			else 
			{
				#email address field has no input
				#update in the database
				$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
	
				if($stmt_insert === false)
				{
					$msgDisplay = $msgError;
				}
				else 
				{
					$msgDisplay = $msgSuccess;
					$txtEvent = "User with ID #" . $accID . " created a new account for: " . trim($_POST['inpFN']) . " " . trim($_POST['inpMN']) . " " . trim($_POST['inpLN']) . ".";
					logEvent($con, $accID, $txtEvent);
				}
			}
		}
	}
	else
	{
		#deny access to page by redirecting
		header('location: index.php');
	}
?>