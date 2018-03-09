<?php
	include('controllers/account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section id="main-content">
   	<section class="wrapper">
	<div class="row">
		<h1 class="text-center">My Account</h1>
		<?php
			if(isset($_GET['updated']))
			{
				echo "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Account information successfully updated.
					</div>";
			}

			if(isset($_GET['username']))
			{
				echo "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						That username already exists. Please choose a different one.
					</div>";
			}

			if(isset($_GET['email']))
			{
				echo "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						That email address already exists. Please choose a different one.
					</div>";
			}

			if(isset($_GET['img']))
			{
				echo "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						The image you selected is not valid. Please upload a valid image file.
					</div>";
			}
		?>
		<div class="col-lg-12">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="pill" href="#pinfo">Personal Information</a></li>
				<li><a data-toggle="pill" href="#cinfo">Contact Information</a></li>
				<li><a data-toggle="pill" href="#linfo">Legal Information</a></li>	
			</ul>
	  		<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="tab-content">
					<div id="pinfo" class="tab-pane fade in active">
						<h3>Personal Information</h3>
						<br />
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label col-lg-3">Photo</label>
								<div class="col-lg-8">
									<img class="img-responsive" src='images/profile/<?php echo getPhoto($accountPhoto); ?>' width="40%" alt='<?php echo getPhoto($accountPhoto); ?>' />
									<input type="file" name="inpPhoto" id="inpPhoto">
								</div>
							</div>
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
						</div>
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
									<a href="change_password.php" class="btn btn-default btn-block" target="_blank">Change Password</a>
								</div>
							</div>
							<hr />
							<div class="form-group">
								<label class="control-label col-lg-3">Birth Date</label>
								<div class="col-lg-8">
									<input type="date" id="inpBDay" name="inpBDay" class="form-control" max="2017-01-01" value='<?php echo $accountBirthdate; ?>' />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Sex</label>
								<div class="col-lg-8">
									<select id="inpSex" name="inpSex" class="form-control">
										<option value="M" <?php echo $selectedM; ?>>Male</option>
										<option value="F" <?php echo $selectedF; ?>>Female</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Position</label>
								<div class="col-lg-8">
									<select id="inpPosition" name="inpPosition" class="form-control" required="true" <?php echo determineAccess(); ?>>
										<?php echo getSelectedPosition($pos, $selectedposID); ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Department</label>
								<div class="col-lg-8">
									<select id="inpDepartment" name="inpDepartment" class="form-control" required="true" <?php echo determineAccess(); ?>>
										<?php echo getSelectedDepartment($dept, $selecteddeptID); ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div id="cinfo" class="tab-pane fade">
						<h3>Contact Information</h3>
						<br />
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label col-lg-3">Email Address</label>
								<div class="col-lg-8">
									<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" placeholder='<?php echo $accountEmail; ?>' />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Primary Contact Number</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="inpNumber" name="inpNumber" class="form-control" maxlength="25" placeholder="Set a primary contact number" value='<?php echo $contactNumber; ?>' />
										<div class="input-group-btn">
											<a href="account_number.php" class="btn btn-default">Manage</a>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label col-lg-3">Address</label>
								<div class="col-lg-8">
									<input type="text" id="inpAddressL1" name="inpAddressL1" class="form-control" maxlength="80" placeholder="Address Line 1" value='<?php echo $addressL1; ?>' />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3"></label>
								<div class="col-lg-8">
									<input type="text" id="inpAddressL2" name="inpAddressL2" class="form-control" maxlength="80" placeholder="Address Line 2" value='<?php echo $addressL2; ?>' />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3"></label>
								<div class="col-lg-8">
									<input type="text" id="inpCity" name="inpCity" class="form-control" maxlength="30" placeholder="City" value='<?php echo $addressCity; ?>' />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3"></label>
								<div class="col-lg-8">
									<input type="text" id="inpZip" name="inpZip" class="form-control" maxlength="15" placeholder="Zip/Area Code" value='<?php echo $addressZip; ?>' />
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-8 col-lg-offset-3">
									<a href="account_address.php" class="btn btn-default btn-block">Manage Address</a>
								</div>
							</div>
						</div>
					</div>
					<div id="linfo" class="tab-pane fade">
						<h3>Legal Information</h3>
						<br />
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label col-lg-3">Civil Status</label>
								<div class="col-lg-8">
									<select id="inpCivilStatus" name="inpCivilStatus" class="form-control" disabled>
										<?php echo getSelectedCS($cs, $selectedcsID); ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Base Rate</label>
								<div class="col-lg-8">
									<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step=".01" value='<?php echo $accountBaseRate; ?>' disabled />
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label col-lg-3">SSS Number</label>
								<div class="col-lg-8">
									<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" value='<?php echo $accountSSSNo; ?>' placeholder="N/A" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">TIN</label>
								<div class="col-lg-8">
									<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" value='<?php echo $accountTINNo; ?>' placeholder="N/A" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">HDMF Number</label>
								<div class="col-lg-8">
									<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" value='<?php echo $accountHDMFNo; ?>' placeholder="N/A" disabled />
								</div>
							</div>							
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
</div>
</body>
</html>