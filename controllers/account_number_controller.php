<?php
	$pageTitle = "My Contact Numbers";
	include('function.php');
	include(loadHeader());

	$activeAcc = $_SESSION['accID'];
	$sql_listNumbers = "SELECT c.contactNumber, c.ctypeID, t.ctypeName FROM contacts c 
						INNER JOIN contacttypes t ON c.ctypeID = t.ctypeID
						WHERE accountID = ?";
	$params_listNumbers = array($activeAcc);
	$stmt_listNumbers = sqlsrv_query($con, $sql_listNumbers, $params_listNumbers);

	$displayList = "";
	while($row = sqlsrv_fetch_array($stmt_listNumbers))
	{
		$contactNumber = openssl_decrypt(base64_decode($row['contactNumber']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$selectedTypeID = $row['ctypeID'];
		$selectedTypeName = $row['ctypeName'];

		$displayList .= "
		<tr>
			<td class='text-center'>
				<div class='form-group'>
					<input type='text' class='form-control' value='$contactNumber'>
				</div>
			</td>
			<td class='text-center'>
				<div class='form-group'>
					<select class='form-control'>
						<option>$selectedTypeName</option>
					</select>
				</div>
			</td>
		</tr>
		";

	#	$displayList .= "
	#	<tr>
	#		<td class='text-center'>$contactNumber</td>
	#		<td class='text-center'>$selectedTypeName</td>
	#	</tr>
	#	";
	}

	$list_cTypes = "";
	$listTypes = getContactTypes($con);
	while($row = sqlsrv_fetch_array($listTypes))
	{
		$ctypeID = $row['ctypeID'];
		$ctypeName = $row['ctypeName'];
		$list_cTypes .= "<option value='$ctypeID'>$ctypeName</option>";
	}

	if(isset($_POST['btnAdd']))
	{
		$inpNumber = base64_encode(openssl_encrypt($_POST['inpNumber'], $method, $password, OPENSSL_RAW_DATA, $iv));
		$inpType = $_POST['inpType'];

		$sql_insNumber = "INSERT INTO contacts (contactNumber, ctypeID, accountID) 
						  VALUES (?, ?, ?)";
		$params_insNumber = array($inpNumber, $inpType, $activeAcc);
		$stmt_insNumber = sqlsrv_query($con, $sql_insNumber, $params_insNumber);

		$accID = $activeAcc;
		$txtEvent = "User with ID # " . $accID . " added a number in their contact information.";
		logEvent($con, $accID, $txtEvent);

		header('location: account_number.php?updated=yes');
	}
?>