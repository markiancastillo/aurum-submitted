<?php
	$pageTitle = "Manage Payroll";
	include('function.php');
	include(loadHeader());

	//view list of accounts eligible for payroll generation - Active statuses
	$sql_listAccounts = "SELECT a.accountID, a.accountFN, a.accountMN, a.accountLN, a.accountStatus, p.positionName, d.departmentName 
						FROM accounts a 
						INNER JOIN positions p ON a.positionID = p.positionID 
						INNER JOIN departments d ON a.departmentID = d.departmentID
						WHERE a.accountStatus = 'Active'
						ORDER BY a.accountID";
	$stmt_listAccounts = sqlsrv_query($con, $sql_listAccounts);

	$displayList = "";
	while($row = sqlsrv_fetch_array($stmt_listAccounts))
	{
		$accountID = $row['accountID'];
		$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountMN = openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
		$accountStatus = $row['accountStatus'];
		$positionName = $row['positionName'];
		$departmentName = $row['departmentName'];

		$accountName = $accountLN . ", " . $accountFN . " " . $accountMN;

		$displayList .= "
			<tr>
				<td></td>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$positionName</td>
				<td class='text-center'>$departmentName</td>
			</tr>
		";
	}

	# code for counting rows
	$sql_countAccounts = "SELECT COUNT(accountID) AS 'rowCount'
						  FROM accounts";
	$stmt_countAccounts = sqlsrv_query($con, $sql_countAccounts);
	while($row2 = sqlsrv_fetch_array($stmt_countAccounts))
	{
		$rowCount = $row2['rowCount'];
	}

	$msgDisplay = "";
	#generate the payroll for each account listed
    if(isset($_POST['btnGenerate']))
	{	
		#get the input period data 
		$payStartingDate = $_POST['payStartingDate'];
		$payEndingDate = $_POST['payEndingDate'];

		#validate that the input date coverage is valid
		if($payStartingDate >= $payEndingDate)
		{
			#invalid coverage
			$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Please enter a valid coverage date.
							</div>";
		}
		else
		{
			#get the accounts that are eligible for payroll generation
			$sql_active = "SELECT accountID, accountBaseRate 
							  FROM accounts 
							  WHERE accountStatus = 'Active'";
			$stmt_active = sqlsrv_query($con, $sql_active);
	
			while($rowgen = sqlsrv_fetch_array($stmt_active))
			{
				#bind the account values
				$accountID = $rowgen['accountID'];
				$accountBaseRate = $rowgen['accountBaseRate'];
	
				#compute for SSS deduction
				$sql_dedSSS = "SELECT sssTotal 
							   FROM ssscontributions 
							   WHERE sssMinimum <= ? AND sssMaximum >= ?";
				$params_dedSSS = array($accountBaseRate, $accountBaseRate);
				$stmt_dedSSS = sqlsrv_query($con, $sql_dedSSS, $params_dedSSS);
	
				while($rowsss = sqlsrv_fetch_array($stmt_dedSSS))
				{
					#sss deduction based on bracket
					#insert this
					$sssTotal = $rowsss['sssTotal'];
				}
	
				#compute PhilHealth deduction
				$sql_dedPH = "SELECT phPremium 
							  FROM philhealthcontributions 
							  WHERE phMinimum <= ? AND phMaximum >= ?";
				$params_dedPH = array($accountBaseRate, $accountBaseRate);
				$stmt_dedPH = sqlsrv_query($con, $sql_dedPH, $params_dedPH);
	
				while($rowded = sqlsrv_fetch_array($stmt_dedPH))
				{
					#premium contribution based on bracket
					#this is inserted into the deductions table
					$phPremium = $rowded['phPremium'];
				}
	
				#get the HDMF deduction
				$sql_dedhdmf = "SELECT hdmfAmount FROM hdmfs";
				$stmt_dedhdmf = sqlsrv_query($con, $sql_dedhdmf);
	
				while($rowhdmf = sqlsrv_fetch_array($stmt_dedhdmf))
				{
					$hdmfAmount = $rowhdmf['hdmfAmount'];
				}
	
				#compute tax deduction
				$sql_dedTax = "SELECT whtMinValue, whtMaxValue, whtPercentageOver, whtBaseTax
							   FROM withholdingtaxes 
							   WHERE whtMinValue <= ? AND whtMaxValue >= ?";
				$params_dedTax = array($accountBaseRate, $accountBaseRate);
				$stmt_dedTax = sqlsrv_query($con, $sql_dedTax, $params_dedTax);
	
				while($rowtax = sqlsrv_fetch_array($stmt_dedTax))
				{
					$whtMinValue = $rowtax['whtMinValue'];
					$whtPercentageOver = $rowtax['whtPercentageOver'];
					$whtBaseTax = $rowtax['whtBaseTax'];
	
					#tax deduction computation
					#this will be inserted into the database
					$dedIT = (($accountBaseRate - $whtMinValue) * $whtPercentageOver) + $whtBaseTax;
				}
	
				#compute for the gross pay
				#get the allowances first 
				$sql_allowance = "SELECT allowanceMobile, allowanceEcola, allowanceMed 
								  FROM allowances";
				$stmt_allowance = sqlsrv_query($con, $sql_allowance);
			    while($rowAll = sqlsrv_fetch_array($stmt_allowance))
				{
				    $allowanceMobile = $rowAll['allowanceMobile'];
				    $allowanceEcola = $rowAll['allowanceEcola'];
				    $allowanceMed = $rowAll['allowanceMed'];
				}
	
				#each allowance is a fixed value
				#divided between the 2 pay terms
				$allowanceTotal = ($allowanceMobile/2) + ($allowanceEcola/2) + ($allowanceMed/2);
	
				#final computation for the gross pay
				$grossPay = $accountBaseRate + $allowanceTotal;
	
				#compute for the net pay
				#formula: gross pay - deductions - (absences) = netpay
	
				#get the attendance data for deductions:
				#count the number of days logged in the record for the employee
				$sql_att = "SELECT COUNT(attendanceID) AS attendanceCount
									  FROM attendances 
									  WHERE accountID = ? AND attendanceDate >= ? AND attendanceDate <= ?";
				$params_att = array($accountID, $payStartingDate, $payEndingDate);
				$stmt_att = sqlsrv_query($con, $sql_att, $params_att);
			  	while($rowatt = sqlsrv_fetch_array($stmt_att))
			    {
			    	#this is the amount of days the employee was
			    	#present within the selected time frame
				    $attendanceCount = $rowatt['attendanceCount'];
				}
	
				#total number of days in the selected time frame
				$intervalStart = new DateTime($payStartingDate);
				$intervalEnd = new DateTime($payEndingDate);
				$payInterval = $intervalStart->diff($intervalEnd);
				$payDateCoverage = $payInterval->format('%a');
	
				#compute attendance deductions
				$dedAttendance = ($payDateCoverage - $attendanceCount) * 150;
	
				#compute for the total deductions
				#by adding the values computed previously
				$deductionsTotal = $sssTotal + $phPremium + $hdmfAmount + $dedIT; 
				$netPay = $grossPay - $deductionsTotal;
	
				#insert the computations performed
				#1. insert them into the deductions table
				$sql_insDeductions = "INSERT INTO deductions (dedSSS, dedPhilhealth, dedPagIbig, dedIncTax, accountID)
									  VALUES (?, ?, ?, ?, ?)";
				$params_insDeductions = array($sssTotal, $phPremium, $hdmfAmount, $dedIT, $accountID);
				$stmt_insDeductions = sqlsrv_query($con, $sql_insDeductions, $params_insDeductions);
	
				#2. insert into the payrolls table
				$sql_insPayroll = "INSERT INTO payrolls (pDateFiled, pBasicPay, pEcola, pWTax, pSSS, pMedical, pHDMF, pCPAllowance, pMedAllowance, pNetPay, accountID)
									VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$params_insPayroll = array($accountBaseRate, $allowanceEcola, $dedIT, $sssTotal, $allowanceMed, $hdmfAmount, $allowanceMobile, $allowanceMed, $netPay, $accountID);
				$stmt_insPayroll = sqlsrv_query($con, $sql_insPayroll, $params_insPayroll);
	
				if($stmt_insPayroll === false)
				{
					$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Failed to generate payroll.
								</div>";
				}
				else
				{
					$msgDisplay = "<div class='alert alert-success alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Successfully generated the payroll for the period " . $payStartingDate . " to " . $payEndingDate . "
								</div>";
				}
			}
		}	
	}
?>