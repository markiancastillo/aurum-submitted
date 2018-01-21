<?php
	include('controllers/change_password_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<!-- CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Local files -->
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="js/bootstrap.min.js" />
	<link rel="stylesheet" href="js/jquery.min.js" />

	<style>
		h1 {
			padding-top: 10%;
			padding-bottom: 10px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center">Change Password</h1>

		<div class="col-lg-6 col-lg-offset-3">
			<div class="well">
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="control-label col-lg-3">Current Password</label>
						<div class="col-lg-8">
							<input type="password" id="inpCurrent" name="inpCurrent" class="form-control" maxlength="50" required="true" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-3">New Password</label>
						<div class="col-lg-8">
							<input type="password" id="inpNew" name="inpNew" class="form-control" maxlength="50" required="true" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-3">Confirm Password</label>
						<div class="col-lg-8">
							<input type="password" id="inpConfirm" name="inpConfirm" class="form-control" maxlength="50" required="true" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-4 col-lg-offset-7">
							<button type="submit" id="btnChange" name="btnChange" class="btn btn-primary btn-block pull-right">Update Password</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>