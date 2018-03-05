<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';
	include('function.php');
	include('config.php');
	include('security.php');

	$rID = $_GET['id'];
	$cID = $_GET['cid'];
	$accID = $_SESSION['accID'];

	$sql_details = "SELECT e.expenseID, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName
					FROM expenses e 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ? AND e.expenseStatus = 'Approved' AND e.caseID = ?";
	$params_details = array($rID, $cID);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	$sql_account = "SELECT accountFN, accountMN, accountLN, accountEmail FROM accounts WHERE accountID = ?";
	$params_account = array($rID);
	$stmt_account = sqlsrv_query($con, $sql_account, $params_account);

	$sql_cases = "SELECT caseTitle FROM cases WHERE caseID = ?";
	$params_cases = array($cID);
	$stmt_cases = sqlsrv_query($con, $sql_cases, $params_cases);

	$sql_rtotal = "SELECT SUM(expenseAmount) AS expenseTotal 
				   FROM expenses 
				   WHERE accountID = ? AND expenseStatus = 'Approved' AND caseID = ?";
	$params_rtotal = array($rID, $cID);
	$stmt_rtotal = sqlsrv_query($con, $sql_rtotal, $params_rtotal);

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
	$OR = "R-" . date('ymd') . "-" . $rID;
	$pdf->Cell(0, 5, 'OR# ' . $OR, 0, 1, 'R');	

	while($row = sqlsrv_fetch_array($stmt_account))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountEmail = openssl_decrypt(base64_decode($row['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;

		$pdf->Cell(0, 5, 'Account: ' . $accountName, 0, 1, 'L');
	}

	while($row = sqlsrv_fetch_array($stmt_cases))
	{
		$caseTitle = $row['caseTitle'];
		$pdf->Cell(0, 5, 'Case: ' . $caseTitle, 0, 1, 'L');
	}

	$billType = "Out of Pocket Expense Reimbursement";
	$pdf->Cell(0, 5, 'Type: ' . $billType, 0, 1, 'L');

	$pdf->Line(10,90,215.9-10,90);
	$pdf->Ln(20);

	$pdf->Cell(0, 5, 'BREAKDOWN OF EXPENSES', 0, 1, 'L');
	$pdf->Ln(5);

	#breakdown in table format
	#headers
	$pdf->Cell(40, 5, 'DATE', 1, 0, 'C');
	$pdf->Cell(40, 5, 'TYPE', 1, 0, 'C');
	$pdf->Cell(80.9, 5, 'REMARKS', 1, 0, 'C');
	$pdf->Cell(35, 5, 'AMOUNT', 1, 1, 'C');

	while($row = sqlsrv_fetch_array($stmt_details))
	{
		$expenseID = $row['expenseID'];
		$expenseDate = $row['expenseDate']->format('M d, Y');
		$expenseAmount = $row['expenseAmount'];
		$expenseRemarks = $row['expenseRemarks'];
		$etypeName = $row['etypeName'];

		#table body
		$pdf->Cell(40, 5, $expenseDate, 1, 0, 'C');
		$pdf->Cell(40, 5, $etypeName, 1, 0, 'C');
		$pdf->Cell(80.9, 5, $expenseRemarks, 1, 0, 'C');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $expenseAmount, 'TRB', 1, 'R');

		#update the record in the database as "Billed"
		#as the record is being generated into the file
		$sql_update = "UPDATE expenses SET expenseStatus = 'Billed' 
					   WHERE expenseID = ?";
		$params_update = array($expenseID);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);
	}

	#compute for the total
	$pdf->Cell(160.9, 8, 'TOTAL', 0, 0, 'R');
	$pdf->Cell(10, 8, 'Php', 0, 0, 'L');
	$pdf->SetFont('Arial', 'BU', 12);

	while($row = sqlsrv_fetch_array($stmt_rtotal))
	{
		$expenseTotal = $row['expenseTotal'];
		$pdf->Cell(25, 8, $expenseTotal, 0, 1, 'R');
	}

	#Generate the PDF and save it in a local directory
	$saveName = $OR . date('Hi');
	$saveDir = $_SERVER['DOCUMENT_ROOT'] . '/aurum/files/billing/' . $saveName . '.pdf';
	$pdf->Output('F', $saveDir);

	#Insert the PDF in the receipts table
	uploadReceipt($con, $accID, $saveName, $rID);

	#Log the event 
	$accID = $_SESSION['accID'];
	$txtEvent = "User with ID # " . $accID . " processed the reimbursement billing for " . $accountName . ".";
	logEvent($con, $accID, $txtEvent);

	#Create a notification for the employee that filed the billing
	#(In-system notification)
	$notifText = "Your reimbursement billing has been processed (OR # " . $OR . ").";
	insertNotification($con, $rID, $notifText);

	#Send an email notification as well
	sendNotificationEmail($accountEmail, $OR, $accountName, $caseTitle, $billType);

	header('location: ../process_billing.php?generated=success&file=' . $saveName);
?>	