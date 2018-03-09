<?php
	include('controllers/requestleave_controller.php');
?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<section id="main-content">
   <section class="wrapper">

	<div class="row">
		<form class="form-horizontal" method="POST">
			<div class="col-lg-6">
				
				<div class="form-group">
					<label class="control-label col-lg-3">Type of Leave</label>
					<div class="col-lg-8">
						<select id="ltypeName" name="ltypeName" class="form-control" required="true">
							<option disabled selected>Choose...</option>
							<?php echo $list_ltypes; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Reason for leave</label>
					<div class="col-lg-8">
						<textarea rows="2" cols="25" id="leaveReason" name="leaveReason" required="true"></textarea>
					</div>
				</div>
				


			
				<div class="form-group">
					<label class="control-label col-lg-3">Date Prepared</label>
					<div class="col-lg-8">
						<input type='date' id="leaveFileDate" name="leaveFileDate" value='<?php echo date('Y-m-d');?>' readonly>
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
						<div class="col-lg-3 col-lg-offset-8">
							<button type="submit" id="btnRequest" name="btnRequest" class="btn btn-primary btn-block pull-right">Request</button>
						</div>
					</div>


				
			</div>	

			<div class="col-lg-6">							
							<div class="form-group">
								<label class="control-label col-lg-4">Sick leave unconsumed</label>
								<div class="col-lg-3">
									<input type="text" id="sickUnconsumed" name="sickLeave" class="form-control" value="<?php echo $sickUnconsumed; ?>" readonly />
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4">Maternity uncomsumed</label>
								<div class="col-lg-3">
									<input type="text" id="vacationUnconsumed" name="vacation" class="form-control" value="<?php echo $vacationUnconsumed; ?>" readonly/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4">Vacation uncomsumed</label>
								<div class="col-lg-3">
									<input type="text" id="maternityUnconsumed" name="maternity" class="form-control" value="<?php echo $maternityUnconsumed; ?>" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-4">Emergency uncomsumed</label>
								<div class="col-lg-3">
									<input type="text" id="emergencyUnconsumed" name="inpUN" class="form-control" value="<?php echo $emergencyUnconsumed; ?>" readonly />
								</div>
							</div>


		</form>
		
	</div>
	
</div>
<?php
						
							
							echo $dispMsg;
					?>

</body>
</html>

