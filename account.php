<?php
	include('controllers/account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center">My Account</h1>
		<hr />
		<?php
			if(isset($_POST['btnUpdate']))
			{
				#echo validateUsername($inpAcc, $con, $inpUsername);
				#echo updateAccount($con, $inpAcc, $inpUsername, $inpFN, $inpMN, $inpLN, $inpBDay, $inpEmail, $inpSex, $inpSSS, $inpTIN, $inpBIR, $inpHDMF, $inpCivilStatus, $inpPosition, $inpDepartment, $inpBaseRate);
			}
		?>
		<form class="form-horizontal" method="POST">
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label col-lg-3">Username</label>
					<div class="col-lg-8">
						<input type="text" id="inpUN" name="inpUN" class="form-control" minlength="6" maxlength="50" placeholder='<?php echo $accountUsername; ?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Password</label>
					<div class="col-lg-8">
						<a href="change_password.php" class="btn btn-default btn-block">Change Password</a>
					</div>
				</div>
				<hr />
				<div class="form-group">
					<label class="control-label col-lg-3">First Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpFN" name="inpFN" class="form-control" maxlength="50" value='<?php echo $accountFN; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Middle Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpMN" name="inpMN" class="form-control" maxlength="50" value='<?php echo $accountMN; ?>' placeholder="optional" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Last Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpLN" name="inpLN" class="form-control" maxlength="50" value='<?php echo $accountLN; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Birth Date</label>
					<div class="col-lg-8">
						<input type="date" id="inpBDay" name="inpBDay" class="form-control" max="2017-01-01" value='<?php echo $accountBirthdate; ?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Email Address</label>
					<div class="col-lg-8">
						<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" value='<?php echo $accountEmail; ?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Sex</label>
					<div class="col-lg-8">
						<select id="inpSex" name="inpSex" class="form-control">
							<option value="M" <?php echo $accountSex == 'M' ? 'selected' : '' ?>>Male</option>
							<option value="F" <?php echo $accountSex == 'F' ? 'selected' : '' ?>>Female</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label col-lg-3">Position</label>
					<div class="col-lg-8">
						<select id="inpPosition" name="inpPosition" class="form-control" required="true" <?php echo determineAccess(); ?>>
							<?php echo $list_positions; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Department</label>
					<div class="col-lg-8">
						<select id="inpDepartment" name="inpDepartment" class="form-control" required="true" <?php echo determineAccess(); ?>>
							<?php echo $list_departments; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">SSS Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" value='<?php echo $accountSSSNo; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">TIN</label>
					<div class="col-lg-8">
						<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" value='<?php echo $accountTINNo; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">BIR Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpBIR" name="inpBIR" class="form-control" maxlength="25" value='<?php echo $accountBIRNo; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">HDMF Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" value='<?php echo $accountHDMFNo; ?>' required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Civil Status</label>
					<div class="col-lg-8">
						<select id="inpCivilStatus" name="inpCivilStatus" class="form-control">
							<?php echo $list_cstatus; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Base Rate</label>
					<div class="col-lg-8">
						<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step=".01" value='<?php echo $accountBaseRate; ?>' disabled="true" />
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-lg-offset-6">
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary btn-block pull-right">Save Changes</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>