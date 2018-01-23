<?php
	include('controllers/forgot_password_controller.php');
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
		<h1 class="text-center">Password Reset Request</h1>
		<div class="col-lg-6 col-lg-offset-3 well">
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label class="control-label col-lg-3">Email Address</label>
					<div class="col-lg-8">
						<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="50" placeholder="A valid email address" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Re-enter Email</label>
					<div class="col-lg-8">
						<input type="email" id="inpCEmail" name="inpCEmail" class="form-control" maxlength="50" placeholder="Enter your email again" required="true" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnReset" name="btnReset" class="btn btn-primary btn-block pull-right">Reset Password</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>