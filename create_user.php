<?php
	include('controllers/create_user_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section id="main-content">
   <section class="wrapper">
   		<div class="container">
			<div class="row mt">
				<div class="form-panel">
					<fieldset>
						<legend>Create User</legend>
						<?php 
							echo $msgDisplay;
						?>
						<form class="form-horizontal" method="POST">
							<div class="col-lg-6">
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
									<label class="control-label col-lg-3">Birth Date</label>
									<div class="col-lg-8">
										<input type="date" id="inpBDay" name="inpBDay" class="form-control" max="2017-01-01" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Email Address</label>
									<div class="col-lg-8">
										<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Gender</label>
									<div class="col-lg-8">
										<select id="inpSex" name="inpSex" class="form-control">
											<option disabled selected>Choose...</option>
											<option value="M">Male</option>
											<option value="F">Female</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Position</label>
									<div class="col-lg-8">
										<select id="inpPosition" name="inpPosition" class="form-control" required="true">
											<option disabled selected>Choose...</option>
											<?php echo $list_positions; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Department</label>
									<div class="col-lg-8">
										<select id="inpDepartment" name="inpDepartment" class="form-control" required="true">
											<option disabled selected>Choose...</option>
											<?php echo $list_departments; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="control-label col-lg-3">SSS Number</label>
									<div class="col-lg-8">
										<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">TIN</label>
									<div class="col-lg-8">
										<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">HDMF Number</label>
									<div class="col-lg-8">
										<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Civil Status</label>
									<div class="col-lg-8">
										<select id="inpCivilStatus" name="inpCivilStatus" class="form-control">
											<option disabled selected>Choose...</option>
											<?php echo $list_cstatus; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">Base Rate</label>
									<div class="col-lg-8">
										<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step=".01" required="true" />
									</div>
								</div>	
							</div>
							<div class="col-lg-6 col-lg-offset-6">
								<div class="form-group">
									<div class="col-lg-4 col-lg-offset-7">
										<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block pull-right">Create Account</button>
									</div>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>