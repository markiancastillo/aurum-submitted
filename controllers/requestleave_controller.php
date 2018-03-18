<?php
	$pageTitle = "Request Leave";
	include('function.php');
	include(loadHeader());
	
	$list_ltypes = getltypes($con, $accID);

	$dispMsg = "";
	$valMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully filed a leave request.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to submit leave request! Please check your input and try again.
					</div>";
	$imageerrorMsg="<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Image error.
					</div>";
	$sickerrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 3 days.
					</div>";
	$maternityerrorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					mDuration should be less or within 60 days.
					</div>";
	$vacationerrorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					vDuration should be less or within 60 days.
					</div>";
	$emergencyerrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 5 days.
					</div>";
	$paternityerrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 7 days.
					</div>";
	$sickunconsumederrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					You have already maximized 'sick' leave.
					</div>";
	$maternityunconsumederrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					You have already maximized 'maternity' leave.
					</div>";
	$vacationunconsumederrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					You have already maximized 'vacation' leave.
					</div>";
	$emergencyconsumederrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					You have already maximized 'emergency' leave.
					</div>";
	$paternityconsumederrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					You have already maximized 'paternity' leave.
					</div>";
	$requiredPhotoError ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					For a sick/maternity leave, please upload an image as proof of the stated reason.
					</div>";
	$photoFileError = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please make sure that you are uploading a valid image file.
					</div>";
	
	//View leave unconsumed
	$query = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 1";
	$params1 = array($accID);
	$stmt = sqlsrv_query($con, $query, $params1);
	while($row1 = sqlsrv_fetch_array($stmt))
	{
		$sickUnconsumed = $row1['lcAmount'];
	}

	$query1 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 2";
	$params2 = array($accID);
	$stmt1 = sqlsrv_query($con, $query1, $params2);
	while($row2 = sqlsrv_fetch_array($stmt1))
	{
		$maternityUnconsumed = $row2['lcAmount'];
	}

	$query2 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 3";
	$params3 = array($accID);
	$stmt2 = sqlsrv_query($con, $query2, $params3);
	while($row3 = sqlsrv_fetch_array($stmt2))
	{
		$vacationUnconsumed = $row3['lcAmount'];
	}

	$query3 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 4";
	$params4 = array($accID);
	$stmt3 = sqlsrv_query($con, $query3, $params4);
	while($row4 = sqlsrv_fetch_array($stmt3))
	{
		$emergencyUnconsumed = $row4['lcAmount'];
	}

	$query4 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 5";
	$params5 = array($accID);
	$stmt4 = sqlsrv_query($con, $query4, $params5);
	while($row5 = sqlsrv_fetch_array($stmt4))
	{
		$paternityUnconsumed = $row5['lcAmount'];
	}

	$sql_account = "SELECT accountSex FROM accounts WHERE accountID = ?";
	$params_account = array($accID);
	$stmt_account = sqlsrv_query($con, $sql_account, $params_account);
	while($racc = sqlsrv_fetch_array($stmt_account))
	{
		$accountSex = $racc['accountSex'];
	}

	$dispMaternity = "";
	$dispPaternity = "";
	if(strcasecmp(trim($accountSex), "M") == 0)
	{
		$dispMaternity = "display:none";
	}
	else if(strcasecmp(trim($accountSex), "F") == 0)
	{
		$dispPaternity = "display:none";
	}

if(isset($_POST['btnRequest']))
{
	$leaveReason = $_POST['leaveReason'];
	$leaveFileDate = date_create($_POST['leaveFileDate']);
	$leaveFrom = date_create($_POST['leaveFrom']);
    $leaveTo =  date_create($_POST['leaveTo']);

    $ltypeID = $_POST['ltypeName'];    
					
	//If maximized certain leave
	if($ltypeID == 1 && $sickUnconsumed == 15)
	{
		$dispMsg = $sickunconsumederrorMsg;
	}
	else if($ltypeID == 2 && $maternityUnconsumed == 15)
	{
		$dispMsg = $maternityunconsumederrorMsg;
	}
	else if($ltypeID == 3 && $vacationUnconsumed == 15)
	{
		$dispMsg = $vacationunconsumederrorMsg;
	}
	else if($ltypeID == 4 && $emergencyUnconsumed == 15)
	{
		$dispMsg = $emergencyunconsumederrorMsg;
	}
	else if($ltypeID == 5 && $paternityUnconsumed == 15)
	{
		$dispMsg = $paternityunconsumederrorMsg;
	}
	else 
	{ 
	//If Sick Leave is chosen
	if($ltypeID == 1)
	{
		//Validation for date	 
		$dayDifference = date_diff($leaveFrom, $leaveTo)->format('%d');
	    $yearDifference = date_diff($leaveFrom, $leaveTo)->format('%y');
	    $monthDifference = date_diff($leaveFrom, $leaveTo)->format('%m');
		if($yearDifference==0)
	   	{
	        if($monthDifference==0)
	        {
	            if($dayDifference>=1)
	  			{
	  				//photo proof of medical certificate required
	  				if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
					{
						#display an error message
						$valMsg = $requiredPhotoError;
					}
					else
					{
						#validate if the uploaded file is a valid image
						#(accept it as valid if the type is a png, bmp, or jpg/jpeg)
						$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
						if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
						{
							#update the photo with the new input
							$imgName = $_FILES["inpProof"]["name"];
				    		$imgProof = uploadLeaveProof($con, $accID, $imgName);

				    		$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) 
								   VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
							$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);	
							$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
				
							if($stmt_insert === false) 
							{
								#die(print_r(sqlsrv_errors(), true));
								$dispMsg = $errorMsg;
							}
							else 
							{
								$dispMsg = $successMsg;
							}
						}
						else
						{
							#display an error prompt
				    		$valMsg = $photoFileError;
						}
					}
				}	
				else 
				{
					$dispMsg = $successMsg;
				}
			}
			else
			{
				$dispMsg = $sickerrorMsg;
			}
		}	
		else
		{
			$dispMsg = $sickerrorMsg;
		}
	}

	//If Maternity Leave is chosen
	if($ltypeID == 2)
	{
		//Validation for date	 
		$dayDifference = date_diff($leaveFrom, $leaveTo)->format('%d');
	    $yearDifference = date_diff($leaveFrom, $leaveTo)->format('%y');
	    $monthDifference = date_diff($leaveFrom, $leaveTo)->format('%m');

    	if($yearDifference==0)
    	{
    	    if($monthDifference==0)
    	    {
    	        if($dayDifference<=61 && $dayDifference>=1)
  			    {
  			    	//photo proof of medical certificate required
	  				if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
					{
						#display an error message
						$valMsg = $requiredPhotoError;
					}
					else
					{
						#validate if the uploaded file is a valid image
						#(accept it as valid if the type is a png, bmp, or jpg/jpeg)
						$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
						if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
						{
							#update the photo with the new input
							$imgName = $_FILES["inpProof"]["name"];
				    		$imgProof = uploadLeaveProof($con, $accID, $imgName);

				    		$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
							$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
							$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
		
							if($stmt_insert === false) 
							{
								$dispMsg = $maternityerrorMsg;
							}
							else 
							{
								$dispMsg = $successMsg;
							}
				    	}
				    	else
						{
							#display an error prompt
				    		$valMsg = $photoFileError;
						}
				    }	
				}
			}
			else
			{
				$dispMsg = $maternityerrorMsg;
			}
		}
		else
		{
			$dispMsg = $maternityerrorMsg;
		}
	}
			
	//If Vacation Leave is chosen
	if($ltypeID == 3)
	{
		//Validation for date	 
		$dayDifference = date_diff($leaveFrom, $leaveTo)->format('%d');
	    $yearDifference = date_diff($leaveFrom, $leaveTo)->format('%y');
	    $monthDifference = date_diff($leaveFrom, $leaveTo)->format('%m');
		if($yearDifference==0)
	   	{
	        if($monthDifference==0)
	        {
	            if($dayDifference>=1)
	  			{
					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) 
								   VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
	
					if($stmt_insert === false) 
					{
						$dispMsg = $errorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}
				}
				else 
				{
					$dispMsg = $successMsg;
				}
			}
			else
			{
				$dispMsg = $sickerrorMsg;
			}
		}			
		else
		{
			$dispMsg = $sickerrorMsg;
		}
	}
	
	//If Emergency Leave is chosen
	if($ltypeID == 4)
	{
	//Validation for date	 
	$dayDifference = date_diff($leaveFrom, $leaveTo)->format('%d');
    $yearDifference = date_diff($leaveFrom, $leaveTo)->format('%y');
    $monthDifference = date_diff($leaveFrom, $leaveTo)->format('%m');

    if($yearDifference==0)
    {
        if($monthDifference==0)
        {
            if($dayDifference<=6 && $dayDifference>=1)
  			{
				$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) 
							   VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
				$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
				$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

				if($stmt_insert === false) 
				{
					$dispMsg = $emergencyerrorMsg;
				}
				else 
				{
					$dispMsg = $successMsg;
				}
			}
			else
			{
				$dispMsg = $emergencyerrorMsg;
			}
		}
		else
		{
			$dispMsg = $emergencyerrorMsg;
		}
	}
	else
	{
		$dispMsg = $emergencyerrorMsg;
	}

	//If Paternity Leave is chosen
	if($ltypeID == 5)
	{
		//Validation for date	 
		$dayDifference = date_diff($leaveFrom, $leaveTo)->format('%d');
    	$yearDifference = date_diff($leaveFrom, $leaveTo)->format('%y');
    	$monthDifference = date_diff($leaveFrom, $leaveTo)->format('%m');

    	if($yearDifference==0)
    	{
    	    if($monthDifference==0)
    	    {
    	        if($dayDifference<=8 && $dayDifference>1)
  				{
					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) 
								   VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

					if($stmt_insert === false) 
					{
						$dispMsg = $errorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}
				}
				else
				{
					$dispMsg = $paternityerrorMsg;
				}
			}
			else
			{
				$dispMsg = $paternityerrorMsg;
			}
		}
		else
		{
			$dispMsg = $paternityerrorMsg;
		}
	}
}
}
}										
?>