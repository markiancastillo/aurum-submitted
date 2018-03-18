<?php
include('controllers/requestleave_controller.php');
?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<section id="main-content">
		<section class="wrapper">
			<div class="row mt">
				<div class="col-lg-12">
					<div class="form-panel">
						<fieldset>
							<legend>Leave Application</legend>
							<form class="form-horizontal" method="POST" enctype="multipart/form-data">
								<div class="col-lg-10 col-lg-offset-1">
									<?php echo $valMsg; ?>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label col-lg-3">Type of Leave</label>
										<div class="col-lg-8">
											<select id="ltypeName" name="ltypeName" class="form-control" required="true" onchange="myFunction()">
												<option disabled selected>Choose...</option>
												<?php echo $list_ltypes; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-3">Reason for leave</label>
										<div class="col-lg-8">
											<textarea class="form-control" rows="2" cols="25" id="leaveReason" name="leaveReason" required="true"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-3">Date Prepared</label>
										<div class="col-lg-8">
											<input type='date' class="form-control" id="leaveFileDate" name="leaveFileDate" value='<?php echo date('Y-m-d');?>' readonly >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-3">Duration</label>
										<div class="col-xs-4">
											<input type="date" id="leaveFrom" name="leaveFrom" class="form-control" required="true" />
										</div>
										<div class="col-xs-4">
											<input type="date" id="leaveTo" name="leaveTo" class="form-control"  required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-3">File upload</label>
										<div class="col-xs-4">
											<input type="file" id="inpProof" name="inpProof" />
										</div>

									</div>
									<div class="form-group">
										<div class="col-lg-3 col-lg-offset-8">
											<button type="submit" id="btnRequest" name="btnRequest" class="btn btn-primary btn-block pull-right">Request</button>
										</div>
									</div>
								</div>	
								<div class="col-lg-6">							
									<div class="form-group">
										<label class="control-label col-lg-4">Sick leave Consumed</label>
										<div class="col-lg-3">
											<input type="text" id="sickUnconsumed" name="sickLeave" class="form-control" value="<?php echo $sickUnconsumed; ?>" disabled />
										</div>
									</div>
									
									<div class="form-group" style="<?php echo $dispMaternity; ?>">
										<label class="control-label col-lg-4">Maternity Consumed</label>
										<div class="col-lg-3">
											<input type="text" id="vacationUnconsumed" name="vacation" class="form-control" value="<?php echo $maternityUnconsumed; ?>" disabled/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-lg-4">Vacation Consumed</label>
										<div class="col-lg-3">
											<input type="text" id="maternityUnconsumed" name="maternity" class="form-control" value="<?php echo $vacationUnconsumed; ?>" disabled />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-4">Emergency Consumed</label>
										<div class="col-lg-3">
											<input type="text" id="emergencyUnconsumed" name="emergency" class="form-control" value="<?php echo $emergencyUnconsumed; ?>" disabled />
										</div>
									</div>
									<div class="form-group" style="<?php echo $dispPaternity ?>">
										<label class="control-label col-lg-4">Paternity Consumed</label>
										<div class="col-lg-3">
											<input type="text" id="paternityUnconsumed" name="paternity" class="form-control" value="<?php echo $paternityUnconsumed; ?>" disabled />
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
				<div class="row col-lg-10 col-lg-offset-1">
					<?php echo $dispMsg; ?>
				</div>
			</div>
		</section>
	</section>
</body>
</html>