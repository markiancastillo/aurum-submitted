<?php
	include('controllers/view_client_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Client Details</h1>
			<br>
			<div class="col-lg-8 col-lg-offset-2">
				<?php echo $msgDisplay; ?>
			</div>
			<form class="form-horizontal col-lg-8 col-lg-offset-2" method="POST" enctype="multipart/form-data">
				<div class="form-group">				
					<label class="control-label col-lg-3">First Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpFN" name="inpFN" class="form-control" value="<?php echo $clientFN; ?>">
					</div>
				</div>
				<div class="form-group">				
					<label class="control-label col-lg-3">Middle Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpMN" name="inpMN" class="form-control" value="<?php echo $clientMN; ?>" placeholder="optional">
					</div>
				</div>
				<div class="form-group">				
					<label class="control-label col-lg-3">Last Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpLN" name="inpLN" class="form-control" value="<?php echo $clientLN; ?>">
					</div>
				</div>
				<div class="form-group">				
					<label class="control-label col-lg-3">Email</label>
					<div class="col-lg-8">
						<input type="text" id="inpEmail" name="inpEmail" class="form-control" value="<?php echo $clientEmail; ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary btn-block pull-right">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>