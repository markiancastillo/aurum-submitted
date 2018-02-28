<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';
	include('function.php');
	include('config.php');
	include('security.php');

	$rID = $_GET['id'];
	$cID = $_GET['cid'];

	$sql_details = "SELECT s.sfDate, s.sfAmount, s.sfRemarks, t.stypeName
					FROM servicefees s 
					INNER JOIN servicetypes t ON s.stypeID = t.stypeID
					WHERE s.accountID = ? AND s.sfStatus = 'Approved' AND s.caseID = ?";
	$params_details = array($rID, $cID);
	$stmt_details = sqlsrv_query($con, $sql_details, $params_details);

	$sql_account = "SELECT accountFN, accountMN, accountLN FROM accounts WHERE accountID = ?";
	$params_account = array($rID);
	$stmt_account = sqlsrv_query($con, $sql_account, $params_account);

	$sql_cases = "SELECT caseTitle FROM cases WHERE caseID = ?";
	$params_cases = array($cID);
	$stmt_cases = sqlsrv_query($con, $sql_cases, $params_cases);

	$sql_stotal = "SELECT SUM(sfAmount) AS sfTotal 
				   FROM servicefees 
				   WHERE accountID = ? AND sfStatus = 'Approved' AND caseID = ?";
	$params_stotal = array($rID, $cID);
	$stmt_stotal = sqlsrv_query($con, $sql_stotal, $params_stotal);

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
	$OR = "SF-" . date('ymd') . "-" . $rID;
	$pdf->Cell(0, 5, 'OR# ' . $OR, 0, 1, 'R');

	while($row = sqlsrv_fetch_array($stmt_account))
	{
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;

		$pdf->Cell(0, 5, 'Account: ' . $accountName, 0, 1, 'L');
	}

	while($row = sqlsrv_fetch_array($stmt_cases))
	{
		$caseTitle = $row['caseTitle'];
		$pdf->Cell(0, 5, 'Case: ' . $caseTitle, 0, 1, 'L');
	}

	$pdf->Cell(0, 5, 'Type: Service Fee', 0, 1, 'L');

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
		$sfDate = $row['sfDate']->format('M d, Y');
		$sfAmount = $row['sfAmount'];
		$sfRemarks = $row['sfRemarks'];
		$stypeName = $row['stypeName'];

		#table body
		$pdf->Cell(40, 5, $sfDate, 1, 0, 'C');
		$pdf->Cell(40, 5, $stypeName, 1, 0, 'C');
		$pdf->Cell(80.9, 5, $sfRemarks, 1, 0, 'C');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $sfAmount, 'TRB', 1, 'R');
	}

	#compute for the total
	$pdf->Cell(160.9, 8, 'TOTAL', 0, 0, 'R');
	$pdf->Cell(10, 8, 'Php', 0, 0, 'L');
	$pdf->SetFont('Arial', 'BU', 12);

	while($row = sqlsrv_fetch_array($stmt_stotal))
	{
		$sfTotal = $row['sfTotal'];
		$pdf->Cell(25, 8, $sfTotal, 0, 1, 'R');
	}

	$saveDir = $_SERVER['DOCUMENT_ROOT'] . '/aurum/images/files/' . $OR . date('Hi') . '.pdf';
	$pdf->Output('F', $saveDir);

	header('location: ../process_billing.php?sbilling=success');
?>