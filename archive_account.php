<?php
	include('controllers/archive_account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#one {
			
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center"><?php echo $accountLN . ", " . $accountFN; ?></h1>
		<br />
		<div class="form-horizontal">
			<h3 class="text-center">Account Summary</h3>
			<hr />
			<div class="col-lg-5 col-lg-offset-1" id="one">
				<div class="form-group">
					<label class="control-label col-lg-5">Complete Name</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $accountName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-5">Position</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $positionName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-5">Department</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $departmentName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-5">Account Status</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $accountStatus; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-5">Email Address</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $accountEmail; ?></p>
					</div>
				</div>	
				<div class="form-group">
					<label class="control-label col-lg-5">Contact No(s).</label>
					<div class="col-lg-7">
						<p class="form-control-static"><?php echo $accountNumbers; ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 well">
			<?php 
			if(isset($_POST['btnArchive'])) 
			{
				echo $msgDisplay;
			} 
			?>
			<form class="form-horizontal" autocomplete="off" method="POST">
				<h4 class="text-center">Input your password to proceed</h4>
				<br />
				<input id="password" style="display:none" type="password" name="autofillpasswordfiller">
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-1">
						<input type="password" id="inpPW" name="inpPW" class="form-control" maxlength="50" required="true" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-3">
						<button type="submit" id="btnArchive" name="btnArchive" class="btn btn-danger btn-block pull-right">Archive Account</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-8 col-lg-offset-2">
			<br />
			<a href="list_account.php" class="btn btn-primary">Back to List</a>
		</div>
	</div>
</div>
</body>
</html>