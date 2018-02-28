<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';

	$currentDate = date('m/d/Y');
	$account = "Jane Lilith Doe";
	$case = "Sample Case 001";
	$OR = "R-" . date('ymd') . "-" . "1006";

	if(isset($_POST['submit']))
	{
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
		$pdf->Cell(0, 5, 'Date: ' . $currentDate, 0, 1, 'R');
		$pdf->Cell(0, 5, 'OR# ' . $OR, 0, 1, 'R');	

		$pdf->Cell(0, 5, 'Account: ' . $account, 0, 1, 'L');
		$pdf->Cell(0, 5, 'Case: ' . $case, 0, 1, 'L');
		$pdf->Cell(0, 5, 'Type: Out of Pocket Expense Reimbursement', 0, 1, 'L');

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
		#table body
		$pdf->Cell(40, 5, 'Feb 30, 2016', 1, 0, 'C');
		$pdf->Cell(40, 5, 'Postage/Courier', 1, 0, 'C');
		$pdf->Cell(80.9, 5, 'Lorem ipsum dolor', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '350.00', 'TRB', 1, 'R');

		$pdf->Cell(40, 5, 'Feb 30, 2016', 1, 0, 'C');
		$pdf->Cell(40, 5, 'Transportation', 1, 0, 'C');
		$pdf->Cell(80.9, 5, 'Quisque dictum, orci', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '125.00', 'TRB', 1, 'R');

		#display the total amount
		$pdf->Cell(160.9, 8, 'TOTAL', 0, 0, 'R');
		$pdf->Cell(10, 8, 'Php', 0, 0, 'L');
		$pdf->SetFont('Arial', 'BU', 12);
		$pdf->Cell(25, 8, '99,999.00', 0, 1, 'R');

		$pdf->Output('D', 'Sample.pdf');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PDF Generation Prototype</title>
</head>
<body>
	<form method="POST">
		<p>Input a string: <input type="text" name="somestring" id="somestring"></p>
		<input type="submit" name="submit" value="Generate PDF">
	</form>
</body>
</html>