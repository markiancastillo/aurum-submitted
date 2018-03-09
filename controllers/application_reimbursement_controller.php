<?php
	$pageTitle = "Reimbursement Application";
	include('function.php');
	include(loadHeader());

	#get list of expense types
	$list_etypes = getExpenseTypes($con);

	#get list of cases where the (current) account is enrolled
	$list_cases = getCases($con, $accID);
	
	$dispMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully filed a reimbursement request.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to submit reimbursement request! Please check your input and try again.
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
			#validate if the uploaded file is a valid image
			#(accept it as valid if the type is a png, bmp, or jpg/jpeg)
			$imgType = mime_content_type($_FILES["inpReceipt"]["tmp_name"]);
			if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
			{
				$imgName = $_FILES["inpReceipt"]["name"];
				$imgProof = uploadProof($con, $accID, $inpCase, $imgName);
			}
			else 
			{
				die(header('location: application_reimbursement.php?img=error'));
			}
		}

		#insert the data into expenses table with status 'Pending for Approval'
		$sql_insert = "INSERT INTO expenses (expenseAmount, expenseDate, expenseProof, expenseRemarks, expenseStatus, etypeID, accountID, caseID) 
					   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($inpAmount, $inpDate, $imgProof, $inpRemarks, 'Pending for Approval', $inpType, $accID, $inpCase);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		$txtEvent = "User with ID # " . $accID . " filed a reimbursement request.";
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