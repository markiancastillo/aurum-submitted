<?php
include('controllers/view_account_controller.php');
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
					<div class="content-panel">
						<fieldset>
							<div class="col-lg-10 col-lg-offset-1">
								<h1 class="text-center"><?php echo $accountFN; ?>'s Account Details</h1>
								<br />
								<div class="col-lg-12">
									<ul class="nav nav-pills">
										<li class="active"><a data-toggle="pill" href="#pinfo">Personal Information</a></li>
										<li><a data-toggle="pill" href="#cinfo">Contact Information</a></li>
										<li><a data-toggle="pill" href="#linfo">Legal Information</a></li>	
									</ul>
									<form class="form-horizontal" method="POST">
										<div class="tab-content">
											<div id="pinfo" class="tab-pane fade in active">
												<h3>Personal Information</h3>
												<br />
												<div class="col-lg-6">
													<div class="form-group">
														<label class="control-label col-lg-3">Photo</label>
														<div class="col-lg-8">
															<img class="img-responsive" src='images/profile/<?php echo getPhoto($accountPhoto); ?>' width="40%" alt='<?php echo getPhoto($accountPhoto); ?>' />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">First Name</label>
														<div class="col-lg-8">
															<input type="text" id="inpFN" name="inpFN" class="form-control" maxlength="50" value='<?php echo $accountFN; ?>' required="true" <?php echo determineAccess(); ?> />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">Middle Name</label>
														<div class="col-lg-8">
															<input type="text" id="inpMN" name="inpMN" class="form-control" maxlength="50" value='<?php echo $accountMN; ?>' placeholder="optional" <?php echo determineAccess(); ?> />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">Last Name</label>
														<div class="col-lg-8">
															<input type="text" id="inpLN" name="inpLN" class="form-control" maxlength="50" value='<?php echo $accountLN; ?>' required="true" <?php echo determineAccess(); ?> />
														</div>
													</div>
												</div>
												<div class="col-lg-6">							
													<div class="form-group">
														<label class="control-label col-lg-3">Birth Date</label>
														<div class="col-lg-8">
															<input type="date" id="inpBDay" name="inpBDay" class="form-control" max="2017-01-01" value='<?php echo $accountBirthdate; ?>' <?php echo determineAccess(); ?> />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">Gender</label>
														<div class="col-lg-8">
															<select id="inpSex" name="inpSex" class="form-control" <?php echo determineAccess(); ?>>
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
													<div class="form-group">
														<label class="control-label col-lg-3">Account Status</label>
														<div class="col-lg-8">
															<p class="form-control-static"><?php echo $accountStatus; ?></p>
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
															<p class="form-control-static"><?php echo $accountEmail; ?></p>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">Contact Number(s)</label>
														<div class="col-lg-8">
															<p class="form-control-static"><?php echo $accountNumbers; ?></p>
														</div>
													</div>							
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="control-label col-lg-3">Address</label>
														<div class="col-lg-8">
															<p class="form-control-static"><?php echo $accountAddress; ?></p>
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
															<select id="inpCivilStatus" name="inpCivilStatus" class="form-control" <?php echo determineAccess(); ?>>
																<?php echo getSelectedCS($cs, $selectedcsID); ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">Base Rate</label>
														<div class="col-lg-8">
															<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step=".01" value='<?php echo $accountBaseRate; ?>' <?php echo determineAccess(); ?> />
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="control-label col-lg-3">SSS Number</label>
														<div class="col-lg-8">
															<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" value='<?php echo $accountSSSNo; ?>' placeholder="N/A" <?php echo determineAccess(); ?> />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">TIN</label>
														<div class="col-lg-8">
															<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" value='<?php echo $accountTINNo; ?>' placeholder="N/A" <?php echo determineAccess(); ?> />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-lg-3">HDMF Number</label>
														<div class="col-lg-8">
															<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" value='<?php echo $accountHDMFNo; ?>' placeholder="N/A" <?php echo determineAccess(); ?> />
														</div>
													</div>							
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="col-lg-4">
												<a href="list_account.php" class="btn btn-default btn-block">
													<span class="glyphicon glyphicon-chevron-left"></span>
													  Back to List
												</a>
											</div>
										</div>
									</form>
								</div>
								
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</section>				
</body>
</html>