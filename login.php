<?php
	include('controllers/login_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Aurum System Login</title>
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
		<h1 class="text-center">User Login</h1>
		
		<div class="col-lg-6 col-lg-offset-3">
			<div class="well">
				<?php
					if(isset($_POST['btnLogin']))
					{
						if($login_row_count == 0)
						{
							#username/password combination is invalid
							echo "
								<div class='alert alert-danger alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Login failed. Incorrect username and/or password.
								</div>
							";
						}
					}
					echo $msgDisplay;
				?>
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="control-label col-lg-3">Username</label>
						<div class="col-lg-8">
							<input type="text" id="inpUsername" name="inpUsername" class="form-control" maxlength="100" required="true" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-3">Password</label>
						<div class="col-lg-8">
							<input type="password" id="inpPassword" name="inpPassword" class="form-control" maxlength="100" required="true" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-7 col-lg-offset-1">
							<a href="forgot_password.php" class="pull-left">Forgot Password?</a>
						</div>
						<div class="col-lg-3">
							<button type="submit" id="btnLogin" name="btnLogin" class="btn btn-success btn-block pull-right">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>