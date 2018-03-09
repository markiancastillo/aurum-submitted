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
	$sickeerrorMsg ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 3 days.
					</div>";
	
	$maternityerrorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Duration should be less or within 60 days.
					</div>";

	$unconsumederrorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
	<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	You have already maximized the certain leave.
	</div>";
	

	//View leave unconsumed
	$query = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID =1";
	$params1 = array($accID);
	$stmt = sqlsrv_query($con, $query, $params1);
	while($row1 = sqlsrv_fetch_array($stmt)){
		$sickUnconsumed = $row1['lcAmount'];
		
	}

	$query1 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID =2";
	$params2 = array($accID);
	$stmt1 = sqlsrv_query($con, $query1, $params2);
	while($row2 = sqlsrv_fetch_array($stmt1)){
		
		$vacationUnconsumed = $row2['lcAmount'];
		
	
	}
	$query2 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID =3";
	$params3 = array($accID);
	$stmt2 = sqlsrv_query($con, $query2, $params3);
	while($row3 = sqlsrv_fetch_array($stmt2)){
		
		$maternityUnconsumed = $row3['lcAmount'];
		
	
	}
	$query3 = "SELECT lcAmount FROM leavecounts WHERE accountID = ? and ltypeID =4";
	$params4 = array($accID);
	$stmt3 = sqlsrv_query($con, $query3, $params4);
	while($row4 = sqlsrv_fetch_array($stmt3)){
		
		$emergencyUnconsumed = $row4['lcAmount'];
	
	}


if(isset($_POST['btnRequest']))
{
	
	$leaveReason = $_POST['leaveReason'];
	$leaveFileDate = $_POST['leaveFileDate'];
	$leaveFrom = date_create($_POST['leaveFrom']);
    $leaveTo =  date_create($_POST['leaveTo']);

    $ltypeID = $_POST['ltypeName'];


      
	

	//If maximized certain leave
	//if(sickUnconsumed == "0")
	//{
	//	$dispMsg = $unconsumederrorMsg;
	//}

	//Validation for sick leave
	//if($ltypeName = "Sick"){
//
	//}

	//Validation for Paternity
	//Validation for Maternity

	//Validation for sick leave
	



	//Subtract chosen leave when submitted
	$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount -1 WHERE accountID = ? AND ltypeID = ? AND lcAmount > 0";
	$params_update = array($accID, $ltypeID);
	$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

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
					$sql_insert = "INSERT INTO leaves (leaveReason, leaveFileDate, leaveFrom, leaveTo, leaveStatus, accountID, ltypeID) VALUES(?, ?, ?, ?, ?, ?, ?)";
					$params_insert = array($leaveReason, $leaveFileDate, $leaveFrom, $leaveTo, 'Pending for Approval', $accID, $ltypeID);
		
	
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
					$dispMsg = $sickerrorMsg;
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






												
?>