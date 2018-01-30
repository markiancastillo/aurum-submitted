<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/controllers/config.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/controllers/function.php');

	$addressID = 1;
	$inpAddressL1 = 'WEBkAzIMFWoSVUuxK9W+fMgo67bAhH/z21unLN/23t4=';
	$inpAddressL2 = 'Tower IV';
	$inpCity = 'HiXFJQo6oFMj9P4/jjzEwA==';
	$inpZip = '15250';
	$accID = 5;

	if(isset($_POST['submit']))
	{
/*		$sql_countAddress = "SELECT COUNT(addressID) AS addressCount FROM addresses 
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
			echo 'insert the address';
			$sql_address = "INSERT INTO addresses (addressL1, addressL2, addressCity, addressZip, accountID) VALUES (?, ?, ?, ?, ?)";
			$params_address = array($inpAddressL1, $inpAddressL2, $inpCity, $inpZip, $accID);
		}
		else
		{
			#address existing; update address
			echo 'update the address';
			$sql_address = "UPDATE addresses SET addressL1 = ?, addressL2 = ?, addressCity = ?, addressZip = ? WHERE addressID = ? AND accountID = ?";
			$params_address = array($inpAddressL1, $inpAddressL2, $inpCity, $inpZip, $addressID, $accID);
		}
		$stmt_address = sqlsrv_query($con, $sql_address, $params_address);

		if( $stmt_address === false ) {
     		die( print_r( sqlsrv_errors(), true));
		}*/
		updAddress($con, $accID, $addressID, $inpAddressL1, $inpAddressL2, $inpCity, $inpZip);

	}
?>
<html>
<head></head>
<body>
	<form method="POST">
		<input type="submit" id="submit" name="submit" value="submit">
	</form>
</body>
</html>