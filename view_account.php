<?php
	include('controllers/view_account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center"><?php echo $accountFN; ?>'s Account Details</h1>
		<br />
		<form class="form-horizontal" method="POST">
			<div class="col-lg-4" id="one">
				<h3 class="text-center">Account Information</h3>
				<div class="form-group">
					<label class="control-label col-lg-3">Name</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Birth Date</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountBirthdate; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Sex</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountSex; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Position</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $positionName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Department</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $departmentName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Account Status</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountStatus; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<h3 class="text-center">Legal Information</h3>
				<div class="form-group">
					<label class="control-label col-lg-3">SSS</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountSSSNo; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">TIN</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountTINNo; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">BIR</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountBIRNo; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">HDMF</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountHDMFNo; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Civil Status</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $cstatusName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Base Rate</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountBaseRate; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<h3 class="text-center">Contact Information</h3>
				<div class="form-group">
					<label class="control-label col-lg-3">Email Address</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountEmail; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Address</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountAddress; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Contact No(s).</label>
					<div class="col-lg-8">
						<p class="form-control-static"><?php echo $accountNumbers; ?></p>
					</div>
				</div>
			</div>
		</form>
		<hr />
		<div class="col-lg-12">
			<a href="list_account.php" class="btn btn-primary">Back to List</a>
		</div>
	</div>
</div>
</body>
</html>