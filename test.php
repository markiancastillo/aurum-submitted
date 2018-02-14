<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';

	if(isset($_POST['submit']))
	{
		$text = $_POST['somestring'];
	
		# codes and notes taken from:
		# fpdf.org
	
		# default values are: portrait orientation, millimeter measurement, A4 size
		# Other possible values:
		# P - portrait, L - landscape
		# For page sizes: A4, Letter, Legal, etc.
		# For units: mm, pt, cm, in, etc.
		$pdf = new FPDF('P', 'mm', 'A4');
	
		# creates a new page w/ origin at the upper left 
		# with the default position set at 1 cm from the borders
		# margins may be set using SetMargins()
		$pdf->AddPage();
	
		# mandatory inclusion
		# Other possible values:
		# B - Bold, I - Italicized, U - Underlined
		# For font face: Arial, Times, Courier, etc.
		$pdf->SetFont('Arial','B',16);
	
		/*
		Cell() prints the text
		Syntax: Cell(w, h, txt, border, ln, align, fill, link)
		Cell width (w) - if 0, cell extends up to right margin
		Cell height (h) - default value is 0
		String to print (txt) - default is an empty string
		Border (border) - indicates borders around a cell
			Border values may be:
			0 - no border	
			1 - frame
			L - left
			T - top
			R - right
			B - bottom
			Default is 0
		ln - indicates where the current position should go after Call()
			Values may be:
			0 - to the right
			1 - beginning of the next line
			2 - below
			Putting 1 is the same as 0 then putting Ln() for a break line
			Default value is 0
		Text alignment (align) - specifies the alignment of the text
			Values may be: 
			L or empty string - left align (default)
			C - center align
			R - right align
		Backgroud (fill) - indicates if background should be transparent
			true - painted background
			false - transparent background
			Default value is false
		URL (link) - URL or identifier returned by AddLink()
		*/
		$pdf->Cell(0, 10, $text, 0, 1, 'C');
	
		/*
		syntax: Output(dest, name, isUTF8)
		dest - destination where to send the document
			Values may be:
			I - send the file inline to the browser. PDF viewer is used if available
			D - send to the browser and force a download with the name defined by <name>
			F - save to a local file with the name given by <name> (may include a path)
			S - return the document as a string
			Default value is I
		name - name of the file (ignored if dest is S). Default is doc.pdf
		isUTF8 - indicates if name is encoded in ISO-8859-1 (false) or UTF8 (true). Only used for dest I and D. Default value is false.
		*/
	
		$pdf->Output('D', 'Sample.pdf');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<p>Input a string: <input type="text" name="somestring" id="somestring"></p>
		<input type="submit" name="submit" value="Save as PDF">
	</form>
</body>
</html>