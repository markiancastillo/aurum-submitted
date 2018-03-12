<?php
	include('function.php');
	include('config.php');
	$accID = $_SESSION['accID'];

	#mark all notifications as read
	$sql_dismiss = "UPDATE notifications SET notificationStatus = ? 
					WHERE accountID = ?";
	$params_dismiss = array('Read', $accID);
	$stmt_dismiss = sqlsrv_query($con, $sql_dismiss, $params_dismiss);

	if($stmt_dismiss === false)
	{
		echo 'Unable to dismiss notifications.';
	}
	else
	{
		header('location: ../index.php');
	}
?>