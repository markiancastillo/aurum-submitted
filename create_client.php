<?php
include('controllers/create_client_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<section id="main-content">
		<section class="wrapper">
			<div class="container">
				<div class="row mt">
					<div class="form-panel">
						<fieldset>
							<div class="col-lg-10 col-lg-offset-1">
								<form class="form-horizontal" method="POST" enctype="multipart/form-data">
									<div class="col-lg-8 col-lg-offset-2">
										<h1 class="text-center">Create Client Data</h1>
										<br /><br />
										<?php echo $msgDisplay; ?>
										<div class="form-group">
											<label class="control-label col-lg-3">Photo</label>
											<div class="col-lg-8">
												<img class="img-responsive" src='images/profile/placeholder.png' width="40%" alt='placeholder-img' />
												<input type="file" name="inpPhoto" id="inpPhoto">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3">First Name</label>
											<div class="col-lg-8">
												<input type="text" id="inpFN" name="inpFN" class="form-control" maxlength="50" required="true" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3">Middle Name</label>
											<div class="col-lg-8">
												<input type="text" id="inpMN" name="inpMN" class="form-control" maxlength="50" placeholder="optional" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3">Last Name</label>
											<div class="col-lg-8">
												<input type="text" id="inpLN" name="inpLN" class="form-control" maxlength="50" required="true" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3">Email Address</label>
											<div class="col-lg-8">
												<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" placeholder='optional' />
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-4 col-lg-offset-7">
												<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block pull-right">Create</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>