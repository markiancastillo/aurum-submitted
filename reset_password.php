<?php
	include('controllers/reset_password_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
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
		<h1 class="text-center">Reset Your Password</h1>
		<div class="col-lg-6 col-lg-offset-3 well">
			<?php echo $msgDisplay; ?>
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label class="control-label col-lg-3">New Password</label>
					<div class="col-lg-8">
						<input type="password" id="inpPW" name="inpPW" class="form-control" maxlength="50" placeholder="Enter a strong password" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Confirm Password</label>
					<div class="col-lg-8">
						<input type="password" id="inpCPW" name="inpCPW" class="form-control" maxlength="50" placeholder="Enter your password again" required="true" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-3 col-lg-offset-3">
						<a href="login.php" id="btnBack" name="btnBack" class="btn btn-default btn-block pull-left">Cancel</a>
					</div>
					<div class="col-lg-5">
						<button type="submit" id="btnChange" name="btnChange" class="btn btn-success btn-block pull-right">Update Password</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>