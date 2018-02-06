<?php
	$pageTitle = "Service Fee Application";
	include('function.php');
	include(loadHeader());

	#get list of expense types
	$list_stypes = getServiceTypes($con);

	#get list of cases where the (current) account is enrolled
	$list_cases = getCases($con, $accID);

	$dispMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully filed a service fee request.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to submit service fee request! Please check your input and try again.
					</div>";

	if(isset($_POST['btnSubmit']))
	{
		#collect the data from the form
		$inpDate = $_POST['inpDate'];
		$inpType = $_POST['inpType'];
		$inpCase = $_POST['inpCase'];
		$inpAmount = $_POST['inpAmount'];
		#$inpReceipt = $_POST['inpReceipt'];
		$inpRemarks = $_POST['inpRemarks'];

		if(!isset($_FILES['inpReceipt']) || $_FILES['inpReceipt']['error'])
		{
			#there is no photo uploaded
			#insert the data without the photo
			$imgProof = NULL;
		}
		else
		{
			$imgName = $_FILES["inpReceipt"]["name"];
			$imgProof = uploadProof($con, $accID, $inpCase, $imgName);
		}

		#insert the data intopop
		$sql_insert = "INSERT INTO servicefees (sfAmount, sfDate, sfProof, sfRemarks, sfStatus, stypeID, accountID, caseID) 
					   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($inpAmount, $inpDate, $imgProof, $inpRemarks, 'Pending for Approval', $inpType, $accID, $inpCase);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		$txtEvent = "User with ID # " . $accID . " filed a service fee request.";
		logEvent($con, $accID, $txtEvent);

		if($stmt_insert === false)
		{
			#print_r(sqlsrv_error(), true);
			$dispMsg = $errorMsg;
		}
		else 
		{
			$dispMsg = $successMsg;
		}
	}
?>