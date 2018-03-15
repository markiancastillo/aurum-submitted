<?php
	#determine if session is set
	#if not, redirect to login page
	session_start();
	if(!isset($_SESSION['accID']))
	{
		#there is no session active: redirect to login
		header('location: login.php');
	}

	#determine which header to load based on
	#the logged in account's positionID
	function loadHeader()
	{
		#session_start();
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

	function determineAccounting()
	{
		$posID = $_SESSION['posID'];

		#if the user is not from accounting, 
		#deny access to the process biling pages
		if($posID == 9)
		{
			
		}
		else
		{
			header('location: index.php');
		}
	}

	#get account details 
	function getAccounts($con, $reqID)
	{
		$sql_account = "SELECT a.accountPhoto, a.accountFN, a.accountMN, a.accountLN, a.accountBirthdate, a.accountSex, a.accountSSSNo, a.accountTINNo, a.accountHDMFNo, a.accountEmail, a.accountBaseRate, a.accountStatus, a.cstatusID, c.cstatusName, a.positionID, p.positionName, a.departmentID, d.departmentName 
	                	FROM accounts a 
	                	INNER JOIN civilstatuses c ON a.cstatusID = c.cstatusID 
	                	INNER JOIN positions p ON a.positionID = p.positionID
	                	INNER JOIN departments d ON a.departmentID = d.departmentID 
	                	WHERE accountID = ?";
		$params_account = array($reqID);
		$stmt_account = sqlsrv_query($con, $sql_account, $params_account);
		return $stmt_account;	                	
	}

	function getlUnconsumed($con)
	{
		$sql_ltypes = "SELECT lcAmount FROM leavecounts WHERE ltypeID = 1";
		$stmt_ltypes = sqlsrv_query($con, $sql_ltypes);
		return $stmt_ltypes;
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

	function getSelectedCS($cs, $selectedcsID)
	{
		$list_cstatus = "";
		while($row = sqlsrv_fetch_array($cs))
		{
			$cstatusID = $row['cstatusID'];
			$cstatusName = $row['cstatusName'];
			$selectedVal = $selectedcsID === $cstatusID ? 'selected' : '';
			$list_cstatus .= "<option value='$cstatusID' $selectedVal>$cstatusName</option>";
		}
		return $list_cstatus;
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

	function getSelectedDepartment($dept, $selecteddeptID)
	{
		$list_departments = "";
		while($row = sqlsrv_fetch_array($dept))
		{
			$departmentID = $row['departmentID'];
			$departmentName = $row['departmentName'];
			$selectedVal = $selecteddeptID === $departmentID ? 'selected' : '';
			$list_departments .= "<option value='$departmentID' $selectedVal>$departmentName</option>";
		}
		return $list_departments;
	}

	#get the list of expense types
	function getExpenseTypes($con)
	{
		$sql_etypes = "SELECT etypeID, etypeName FROM expensetypes";
		$stmt_etypes = sqlsrv_query($con, $sql_etypes);
		
		$list_etypes = "";
		while($rowTypes = sqlsrv_fetch_array($stmt_etypes))
		{
			$etypeID = $rowTypes['etypeID'];
			$etypeName = $rowTypes['etypeName'];
			$list_etypes .= "<option value='$etypeID'>$etypeName</option>";
		}

		return $list_etypes;
	}

	#get the list of service types
	function getServiceTypes($con)
	{
		$sql_stypes = "SELECT stypeID, stypeName FROM servicetypes";
		$stmt_stypes = sqlsrv_query($con, $sql_stypes);

		$list_stypes = "";
		while($rowSTypes = sqlsrv_fetch_array($stmt_stypes))
		{
			$stypeID = $rowSTypes['stypeID'];
			$stypeName = $rowSTypes['stypeName'];
			$list_stypes .= "<option value='$stypeID'>$stypeName</option>";
		}
		return $list_stypes;
	}

	#get the list of cases 
	function getCases($con, $accID)
	{
		$sql_cases = "SELECT caseID, caseTitle FROM cases 
					  WHERE accountID = ?";
		$params_cases = array($accID);
		$stmt_cases = sqlsrv_query($con, $sql_cases, $params_cases);

		$list_cases = "";
		while($rowCases = sqlsrv_fetch_array($stmt_cases))
		{
			$caseID = $rowCases['caseID'];
			$caseTitle = $rowCases['caseTitle'];
			$list_cases .= "<option value='$caseID'>$caseTitle</option>";
		}

		return $list_cases;
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

	function getSelectedPosition($pos, $selectedposID)
	{
		$list_positions = "";
		while($row = sqlsrv_fetch_array($pos))
		{
			$positionID = $row['positionID'];
			$positionName = $row['positionName'];
			$selectedVal = $selectedposID === $positionID ? 'selected' : '';
			$list_positions .= "<option value='$positionID' $selectedVal>$positionName</option>";
		}
		return $list_positions;
	}

	function insertNotification($con, $rID, $notifText)
	{
		$sql_notif = "INSERT INTO notifications (notificationMessage, notificationDate, notificationStatus, accountID) 
					VALUES (?, CURRENT_TIMESTAMP, ?, ?)";
		$accID = $rID;
		$params_notif = array($notifText, 'Unread', $accID);
		$stmt_notif = sqlsrv_query($con, $sql_notif, $params_notif);
	}

	#function to send emails
	function sendNotificationEmail($accountEmail, $OR, $accountName, $caseTitle, $billType)
	{
		require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/PHPMailer/PHPMailerAutoload.php';

		# source:
		# https://github.com/PHPMailer/PHPMailer/tree/5.2-stable
		$mail = new PHPMailer;
	
		# 0 - disable (default)
		# 1 - output client messages
		# 2 - output messages sent by client + from server
		# 3 - as 2, + information about the initial connection - can help with STARTTLS failures
		# 4 - as 3, plus even lower level information
		$mail->SMTPDebug = 0; 
	
		$mail->isSMTP();                                      		# Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					    	# Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                                		# Enable SMTP authentication
		$mail->Username = 'miac.11221127@gmail.com';           		# SMTP username
		$mail->Password = 'damong_talahiban';                       # SMTP password
		$mail->SMTPSecure = 'tls';                            		# Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    		# TCP port to connect to
	
		$mail->setFrom('notification@aurum.com', 'Aurum System'); 	# sender email that will appear, sender name that will be displayed
		#$mail->addAddress($accountEmail, $accountName);				# the address to which the email will be sent, name is optional
		$mail->addAddress($accountEmail, $accountName);

		$mail->isHTML(true);
		$mail->Subject = 'Billing Notification'; 
		$mail->Body = '
			<p>Your billing has been processed.</p>

			<p>Details: </p>
			<table width="50%">
				<tr>
					<td><strong>OR #</strong></td>
					<td>' . $OR . '</td>
				</tr>
				<tr>
					<td><strong>Date</strong></td>
					<td>' . date('m/d/Y') . '</td>
				</tr>
				<tr>
					<td><strong>Account</strong></td>
					<td>' . $accountName . '</td>
				</tr>
					<td><strong>Case</strong></td>
					<td>' . $caseTitle . '</td>
				</tr>
				<tr>
					<td><strong>Type</strong></td>
					<td>' . $billType . '</td>
				</tr>
			</table>
		';
		$mail->AltBody = '
			Your billing for out of pocket expenses reimburemsent has been processed - OR# ' . $OR . ', processed on ' . date('m/d/Y') . '.';
	
		# allows insecure connections by using the SMTPOptions property
		# taken from:
		# https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#php-56-certificate-verification-failure
		$mail->SMTPOptions = array(
	    	'ssl' => array(
	    	    'verify_peer' => false,
	    	    'verify_peer_name' => false,
	    	    'allow_self_signed' => true
	    	)
		);
	
		if(!$mail->send()) {
			echo 'Message was not sent.';
			echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent.';
		}
	}

	function updAddress($con, $accID, $addressID, $inpAddressL1, $inpAddressL2, $inpCity, $inpZip)
	{
		$sql_countAddress = "SELECT COUNT(addressID) AS addressCount FROM addresses 
							 WHERE accountID = ?";
		$params_countAddress = array($accID);
		$stmt_countAddress = sqlsrv_query($con, $sql_countAddress, $params_countAddress);
		while($row = sqlsrv_fetch_array($stmt_countAddress))
		{
			$addressCount = $row['addressCount'];
		}

		if($addressCount == 0)
		{
			#address doesnt exist yet; insert address
			$sql_address = "INSERT INTO addresses (addressL1, addressL2, addressCity, addressZip, accountID) VALUES (?, ?, ?, ?, ?)";
			$params_address = array($inpAddressL1, $inpAddressL2, $inpCity, $inpZip, $accID);
		}
		else
		{
			#address existing; update address 
			$sql_address = "UPDATE addresses SET addressL1 = ?, addressL2 = ?, addressCity = ?, addressZip = ? WHERE addressID = ? AND accountID = ?";
			$params_address = array($inpAddressL1, $inpAddressL2, $inpCity, $inpZip, $addressID, $accID);
		}
		$stmt_address = sqlsrv_query($con, $sql_address, $params_address);
		return $stmt_address;
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

	function uploadLeaveProof($con, $accID, $imgName)
	{
		include('security.php');
		#directory where the image will be stored
		$imgDir = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/leaveproof/";
		#filename will be uploader's ID + image name
		#e.g. 1_photo.png
		#this makes them unique for each user and prevents
		#overwriting of files with the same name
		$imgNew = $accID . "-" . date('YmdHis') . "-" . basename($imgName);
		$imgFile = $imgDir . $imgNew;

		move_uploaded_file($_FILES["inpProof"]["tmp_name"], $imgFile);

		$encrypt_img = base64_encode(openssl_encrypt($imgNew, $method, $password, OPENSSL_RAW_DATA, $iv));
		return $encrypt_img;
	}

	function uploadPhoto($con, $accID, $imgName)
	{
		include('security.php');
		#directory where the image will be stored
		$imgDir = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/profile/";
		#filename will be uploader's ID + image name
		#e.g. 1_photo.png
		#this makes them unique for each user and prevents
		#overwriting of files with the same name

		$imgNew = $accID . "-" . basename($imgName);
		$imgFile = $imgDir . $imgNew;

		move_uploaded_file($_FILES["inpPhoto"]["tmp_name"], $imgFile);

		$encrypt_img = base64_encode(openssl_encrypt($imgNew, $method, $password, OPENSSL_RAW_DATA, $iv));
		$sql_upload = "UPDATE accounts SET accountPhoto = ? WHERE accountID = ?";
		$params_upload = array($encrypt_img, $accID);
		$stmt_upload = sqlsrv_query($con, $sql_upload, $params_upload);
	}

	function uploadProof($con, $accID, $inpCase, $imgName)
	{
		include('security.php');
		#directory where the image will be stored
		$imgDir = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/proof/";
		#filename will be uploader's ID + image name
		#e.g. 1_photo.png
		#this makes them unique for each user and prevents
		#overwriting of files with the same name
		$imgNew = $accID . "-" . $inpCase . "-" . date('YmdHis') . "-" . basename($imgName);
		$imgFile = $imgDir . $imgNew;

		move_uploaded_file($_FILES["inpReceipt"]["tmp_name"], $imgFile);

		$encrypt_img = base64_encode(openssl_encrypt($imgNew, $method, $password, OPENSSL_RAW_DATA, $iv));
		return $encrypt_img;
	}

	#upload a receipt file into the database
	function uploadReceipt($con, $accID, $saveName, $rID)
	{
		include ('security.php');

		#get the name of the account that uploaded the receipt
		$sql_uploader = "SELECT accountFN, accountLN FROM accounts WHERE accountID = ?";
		$params_uploader = array($accID);
		$stmt_uploader = sqlsrv_query($con, $sql_uploader, $params_uploader);
		while($row = sqlsrv_fetch_array($stmt_uploader))
		{
			$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accountName = $accountLN . ', ' . $accountFN;
		}

		$receiptRemarks = "Billing generated by " . $accountName;
		$receiptFile = base64_encode(openssl_encrypt($saveName . ".pdf", $method, $password, OPENSSL_RAW_DATA, $iv));

		$sql_receipt = "INSERT INTO receipts (receiptFile, receiptDate, receiptRemarks, receiptStatus, accountID) 
						VALUES (?, CURRENT_TIMESTAMP, ?, ?, ?)";
		$params_receipt = array($receiptFile, $receiptRemarks, 'Generated', $rID);
		$stmt_receipt = sqlsrv_query($con, $sql_receipt, $params_receipt);
	}

	#get the count of email input to check if it is valid
	function validateEmail($con, $inpEmail)
	{
		$sql_valEmail = "SELECT COUNT(accountID) AS emailCount FROM accounts 
						 WHERE accountEmail = ?";
		$params_valEmail = array($inpEmail);
		$stmt_valEmail = sqlsrv_query($con, $sql_valEmail, $params_valEmail);

		while($row = sqlsrv_fetch_array($stmt_valEmail))
		{
			$emailCount = $row['emailCount'];
		}
		return $emailCount;
	}

	#check if there is a session active
	function validateSession()
	{
		session_start();
		if(!isset($_SESSION['accID']))
		{
			#there is no session active: redirect to login
			header('location: login.php');
		}
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

	function getEmployees($con)
	{
		$sql_employees = "SELECT accountID, accountFN, accountLN FROM accounts";
		$stmt_employees = sqlsrv_query($con, $sql_employees);
		return $stmt_employees;
	}

	function getClients($con)
	{
		$sql_clients = "SELECT clientID, clientFN, clientLN FROM clients";
		$stmt_clients = sqlsrv_query($con, $sql_clients);
		return $stmt_clients;
	}

	function getltypes($con)
	{
		$sql_account = "SELECT accountSex FROM accounts 
						WHERE accountID = ?";
		$params_account = array($accID);
		$stmt_account = sqlsrv_query($con, $sql_account, $params_account);
		while($racc = sqlsrv_fetch_array($stmt_account))
		{
			$accountSex = $racc['accountSex'];
		}

		$sql_ltypes = "SELECT ltypeID, ltypeName FROM leavetypes";
		$stmt_ltypes = sqlsrv_query($con, $sql_ltypes);			
		$list_ltypes = "";
		while($row = sqlsrv_fetch_array($stmt_ltypes))
		{
			$ltypeID = $row['ltypeID'];
			$ltypeName = $row['ltypeName'];
			
			$opMaternity = "";
			$opPaternity = "";
			if($ltypeID == 2 && strcasecmp(trim($accountSex), "M") == 0)
			{
				$opMaternity = "display:none";
			}
			else if($ltypeID == 5 && strcasecmp(trim($accountSex), "F") == 0)
			{
				$opPaternity = "display:none";
			}

			$list_ltypes .= "<option value='$ltypeID' style='$opMaternity $opPaternity'>$ltypeName</option>";
		}
		return $list_ltypes;
	}

	function getWorkingDays($startDate, $endDate)
	{
		$leaveFrom = strtotime($startDate);
		$leaveTo = strtotime($endDate);
		if($leaveFrom > $leaveTo)
		{
			return 0;
		}
		else
		{
			$no_days = 0;
			$weekends = 0;
			
			while($leaveFrom <= $leaveTo)
			{
				#no of days in the given interval
				$no_days++; 
				$what_day = date("N", $leaveFrom);
				
				if($what_day > 5) 
				{ 
					#6 and 7 are weekend days
		     		$weekends++;
				};
				
				#+1 day
				$leaveFrom += 86400; 
			};
			
			$working_days = $no_days - $weekends;
			return $working_days;
		}
	}

	function generatePayrollPDF($accID, $accountName, $accountBaseRate, $allowanceMobile, $allowanceEcola, $allowanceMed, $grossPay, $sssTotal, $phPremium, $hdmfAmount, $dedIT, $dedAttendance, $netPay)
	{
		#format the inputs
		$dispBaseRate = number_format($accountBaseRate, 2, '.', ',');
		$dispMobile = number_format($allowanceMobile, 2, '.', ',');
		$dispEcola = number_format($allowanceEcola, 2, '.', ',');
		$dispMed = number_format($allowanceMed, 2, '.', ',');
		$dispGross = number_format($grossPay, 2, '.', ',');
		$dispSSS = number_format($sssTotal, 2, '.', ',');
		$dispPH = number_format($phPremium, 2, '.', ',');
		$dispHDMF = number_format($hdmfAmount, 2, '.', ',');
		$dispIT = number_format($dedIT, 2, '.', ',');
		$dispAtt = number_format($dedAttendance, 2, '.', ',');
		$dispNet = number_format($netPay, 2, '.', ',');

		$pdf = new FPDF('P', 'mm', 'Letter');
		$pdf->AddPage();
		#$pdf->SetMargins(25.4, 25.4, 25.4);
	
		$pdf->SetFont('Times','B',20);
		$pdf->Cell(0, 10, 'Reyes Francisco Tecson & Associates Law Office', 0, 1, 'C');
		$pdf->SetFont('Arial', '', 12);

		#page header (company name and info)
		$pdf->Cell(0, 5, 'Unit 1710 Cityland 10 Tower 1, H.V. dela Costa Street, Salcedo Village, Makati City', 0, 1, 'C');
		$pdf->Cell(0, 5, 'Telephone Nos. 892-4360 / 813-1553 / 892-4435 / 892-1872   Fax: 812-6026', 0, 1, 'C');
		$pdf->Cell(0, 5, 'Website: www.rflaw.com     E-mail: info@rflaw.com', 0, 1, 'C');
		$pdf->Ln(20);

		#start of billing details
		$pdf->Cell(0, 5, 'Date: ' . date('m/d/Y'), 0, 1, 'R');
		$OR = "P-" . date('ymd') . "-" . $accID;
		$pdf->Cell(0, 5, 'OR# ' . $OR, 0, 1, 'R');
		$pdf->Cell(0, 5, 'Account: ' . $accountName, 0, 1, 'L');
		$billType = "Payroll";
		$pdf->Cell(0, 5, 'Type: ' . $billType, 0, 1, 'L');

		#horizontal line (divider)
		$pdf->Line(10,90,215.9-10,90);
		$pdf->Ln(20);

		$pdf->Cell(0, 5, 'BREAKDOWN', 0, 1, 'L');
		$pdf->Ln(5);

		#table body
		#row 1 -- basic pay display
		$pdf->Cell(40, 5, 'Basic Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispBaseRate, 'TRB', 1, 'R');

		#row 2 -- Add:
		$pdf->Cell(40, 5, 'Add:', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#rows 3-5 --  allowances breakdown
		#row 3
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Mobile Allowance', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispMobile, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 4
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'ECOLA', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispEcola, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 5
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Medical Allowance', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispMed, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 6 -- gross pay
		$pdf->Cell(40, 5, 'Gross Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispGross, 'TRB', 1, 'R');

		#row 7 -- Less:
		$pdf->Cell(40, 5, 'Less:', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#rows 8-11 --  deductions breakdown
		#row 8
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'SSS Contribution', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispSSS, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 9
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'PhilHealth Contribution', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispPH, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 10
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Pag-IBIG', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispHDMF, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 11
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Income Tax', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispIT, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 12 -- attendance deduction
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Absences', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispAtt, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 13 -- net pay
		$pdf->Cell(40, 5, 'Net Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $dispNet, 'TRB', 1, 'R');

		#save the file on the local disk
		$saveName = $OR . date('Hi');
		$saveDir = $_SERVER['DOCUMENT_ROOT'] . '/aurum/files/payroll/' . $saveName . '.pdf';
		$pdf->Output('F', $saveDir);

		return $saveName;
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