<?php
	$pageTitle = "Request Leave";
	include('function.php');
	include(loadHeader());

	
	$list_ltypes = getltypes($con, $accID);


	$dispMsg = "";
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
					Duration should be less or within 60 days.
					</div>";
	$vacationerrorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 60 days.
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
	

	

	
	

	//View leave unconsumed
	$query = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 1";
	$params1 = array($accID);
	$stmt = sqlsrv_query($con, $query, $params1);
	while($row1 = sqlsrv_fetch_array($stmt)){
		$sickUnconsumed = $row1['lcAmount'];
		
	}
	echo 'sick unconsumed: ' . $sickUnconsumed;

	$query1 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 2";
	$params2 = array($accID);
	$stmt1 = sqlsrv_query($con, $query1, $params2);
	while($row2 = sqlsrv_fetch_array($stmt1)){
		
		$maternityUnconsumed = $row2['lcAmount'];
		
	
	}
	$query2 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 3";
	$params3 = array($accID);
	$stmt2 = sqlsrv_query($con, $query2, $params3);
	while($row3 = sqlsrv_fetch_array($stmt2)){
		
		$vacationUnconsumed = $row3['lcAmount'];
		
	
	}
	$query3 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 4";
	$params4 = array($accID);
	$stmt3 = sqlsrv_query($con, $query3, $params4);
	while($row4 = sqlsrv_fetch_array($stmt3)){
		
		$emergencyUnconsumed = $row4['lcAmount'];
	
	}
	$query4 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID = 5";
	$params5 = array($accID);
	$stmt4 = sqlsrv_query($con, $query4, $params5);
	while($row5 = sqlsrv_fetch_array($stmt4)){
		
		$paternityUnconsumed = $row5['lcAmount'];
	
	}


	




if(isset($_POST['btnRequest']))
{
	
	

	$leaveReason = $_POST['leaveReason'];
	$leaveFileDate = date_create($_POST['leaveFileDate']);
	$leaveFrom = date_create($_POST['leaveFrom']);
    $leaveTo =  date_create($_POST['leaveTo']);

    $ltypeID = $_POST['ltypeName'];

    

	
						
		//If maximized certain leave
		if($ltypeID == 1 && $maternityUnconsumed < 1)
		{
			$dispMsg = $sickunconsumederrorMsg;
		}
	
		else if($ltypeID == 2 && $maternityUnconsumed < 1)
		{
			$dispMsg = $maternityunconsumederrorMsg;
		}
		else if($ltypeID == 3 && $vacationUnconsumed < 1)
		{
			$dispMsg = $vacationunconsumederrorMsg;
		}
		else if($ltypeID == 4 && $emergencyUnconsumed < 1)
		{
			$dispMsg = $emergencyunconsumederrorMsg;
		}
		else if($ltypeID == 5 && $paternityUnconsumed < 1)
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
            if($dayDifference<=4 && $dayDifference>0)
  				  {

  				  	if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
	{
		$imgProof = NULL;
	}
	else{
		$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
		if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
		{
			#update the photo with the new input
			$imgName = $_FILES["inpProof"]["name"];
			$imgProof = uploadLeaveProof($con, $accID, $imgName);
		}
		
		else{
			$dispMsg = $imageerrorMsg;
		}
	}
  				  	//Subtract chosen leave when submitted
					//lcAmount > 0 so that it won't reach negative

				
  				  	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
					$params_update = array($accID, $ltypeID);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					if($stmt_update === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $sickerrorMsg;
					}


					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
		
	
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

					if($stmt_insert === false) {
						die(print_r(sqlsrv_errors(), true));
						$dispMsg = $sickerrorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}
				}

			else{
					$dispMsg = $sickerrorMsg;
				}
			}
			
		else
		{
			$dispMsg = $sickerrorMsg;
		}
	}
	else {
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
            if($dayDifference<=61 && $dayDifference>0)
  				  {
  				  	//Subtract chosen leave when submitted
					//lcAmount > 0 so that it won't reach negative

					if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
	{
		$imgProof = NULL;
	}
	else{
		$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
		if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
		{
			#update the photo with the new input
			$imgName = $_FILES["inpProof"]["name"];
			$imgProof = uploadleaveProof($con, $accID, $imgName);
		}
		
		else{
			$dispMsg = $imageerrorMsg;
		}
	}
				
  				  	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
					$params_update = array($accID, $ltypeID);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					if($stmt_update === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $maternityerrorMsg;
					}

					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
		
	
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

					if($stmt_insert === false) {
						die(print_r(sqlsrv_errors(), true));
						$dispMsg = $maternityerrorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}

				}

			else{
					$dispMsg = $maternityerrorMsg;
				}
		}
			
		else
		{
			$dispMsg = $maternityerrorMsg;
		}
	}
	else {
	$dispMsg = $maternityerrorMsg;
	}
	
	}	




	//If Vacation Leave is chosen
	if($ltypeID == 3)
	{

	if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
	{
		$imgProof = NULL;
	}
	else{
		$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
		if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
		{
			#update the photo with the new input
			$imgName = $_FILES["inpProof"]["name"];
			$imgProof = uploadleaveProof($con, $accID, $imgName);
		}
		
		else{
			$dispMsg = $imageerrorMsg;
		}
	}
	
    
     
  		//Subtract chosen leave when submitted
		//lcAmount > 0 so that it won't reach negative
  		$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
		$params_update = array($accID, $ltypeID);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

		if($stmt_update === false) {
		die(print_r(sqlsrv_errors(), true));
		$dispMsg = $errorMsg;
		}	

		$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
		
		
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		if($stmt_insert === false) {
		die(print_r(sqlsrv_errors(), true));
		$dispMsg = $errorMsg;
		}
		else 
		{
			$dispMsg = $successMsg;
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
            if($dayDifference<=6 && $dayDifference>0)
  				  {


		if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
	{
		$imgProof = NULL;
	}
	else{
		$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
		if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
		{
			#update the photo with the new input
			$imgName = $_FILES["inpProof"]["name"];
			$imgProof = uploadleaveProof($con, $accID, $imgName);
		}
		
		else{
			$dispMsg = $imageerrorMsg;
		}
	}
  				  	//Subtract chosen leave when submitted
					//lcAmount > 0 so that it won't reach negative
				
  				  	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
					$params_update = array($accID, $ltypeID);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					if($stmt_update === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $emergencyerrorMsg;
					}	

					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
		
	
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

					if($stmt_insert === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $emergencyerrorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}
					}

			else{
					$dispMsg = $emergencyerrorMsg;
				}
			}
			
		else
		{
			$dispMsg = $emergencyerrorMsg;
		}
	}
	else{
			$dispMsg = $emergencyerrorMsg;
		}
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
            if($dayDifference<=8 && $dayDifference>0)
  				  {

  				  	if(!isset($_FILES['inpProof']) || $_FILES['inpProof']['error'])
	{
		$imgProof = NULL;
	}
	else{
		$imgType = mime_content_type($_FILES["inpProof"]["tmp_name"]);
		if($imgType == 'image/png' || $imgType == 'image/jpeg' || $imgType == 'image/bmp')
		{
			#update the photo with the new input
			$imgName = $_FILES["inpProof"]["name"];
			$imgProof = uploadleaveProof($con, $accID, $imgName);
		}
		
		else{
			$dispMsg = $imageerrorMsg;
		}
	}
  				  	//Subtract chosen leave when submitted
					//lcAmount > 0 so that it won't reach negative
				
  				  	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
					$params_update = array($accID, $ltypeID);
					$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

					if($stmt_update === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $errorMsg;
					}	

					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveProof, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom,  $leaveTo, $imgProof, 'Pending for Approval', $accID, $ltypeID);
		
	
					$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
					if($stmt_insert === false) {
					die(print_r(sqlsrv_errors(), true));
					$dispMsg = $errorMsg;
					}
					else 
					{
						$dispMsg = $successMsg;
					}
				}

			else{
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
											
?>