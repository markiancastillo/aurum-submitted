<?php
	#determine which header to load based on
	#the logged in account's positionID
	function loadHeader()
	{
		session_start();
		if(isset($_SESSION['accID']))
		{
			$accID = $_SESSION['accID'];
			$posID = $_SESSION['posID'];

			if($posID == 1 || $posID == 6 || $posID == 8)
			{
				#load header_admin when account's position is either:
				#1 - managing partner
				#6 - executive assistant
				#8 - HR assistant
				$header = "includes/header_admin.php";
			}
			else
			{
				#account does not have adminstrative powers
				$header = "includes/header.php";
			}
			return $header;
		}
	}

	#determine if the account has administrative access
	function determineAccess()
	{
		$posID = $_SESSION['posID'];
		if($posID == 1 || $posID == 6 || $posID == 8)
		{
			#account has administrative access
			$access = "";
		}
		else
		{
			$access = "disabled";
		}
		return $access;

	}

	#get the list of departments
	function getDepartments($con)
	{
		$sql_departments = "SELECT departmentID, departmentName FROM departments ORDER BY departmentName";
		$stmt_departments = sqlsrv_query($con, $sql_departments);
		return $stmt_departments;
	}

	#get the list of positions
	function getPositions($con)
	{
		$sql_positions = "SELECT positionID, positionName FROM positions ORDER BY positionName";
		$stmt_positions = sqlsrv_query($con, $sql_positions);
		return $stmt_positions;
	}

	#get the list of civil statuses
	function getCivilStatuses($con)
	{
		$sql_cstatus = "SELECT cstatusID, cstatusName FROM civilstatuses";
		$stmt_cstatus = sqlsrv_query($con, $sql_cstatus);
		return $stmt_cstatus;
	}

	#check for the validity of the input username
	#(if it is available or is taken)
	function validateUsername($con, $inpUsername)
	{
		$sql_valUsername = "SELECT accountID, accountUsername FROM accounts 
							WHERE accountUsername = ?";
		$params_valUsername = array($inpUsername);				
		$options_valUsername = array('Scrollable'=>'static');
		$stmt_valUsername = sqlsrv_query($con, $sql_valUsername, $params_valUsername, $options_valUsername);
		$username_row_count = sqlsrv_num_rows($stmt_valUsername);

		$valUsername = ($username_row_count > 0) ? "existing" : "available";
		return $valUsername;
	}
?>