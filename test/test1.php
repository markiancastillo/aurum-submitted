<?php
	include('../controllers/config.php');

	session_start();
	$inpAcc = $_SESSION['accID'];

	$sql_chkContact = "SELECT COUNT(contactID) AS contactCount FROM contacts 
						   WHERE ctypeID = ? AND accountID = ?";
	$params_chkContact = array(1, $inpAcc);
	$stmt_chkContact = sqlsrv_query($con, $sql_chkContact, $params_chkContact);

	while($row = sqlsrv_fetch_array($stmt_chkContact))
	{
		$contactCount = $row['contactCount'];
	}

	echo "contact count: " . $contactCount;

	if($contactCount == 0)
	{
		echo "<br> insert to db";
	}
	else
	{
		echo "<br> update db";	
	}
?>