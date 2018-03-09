<?php
	include('controllers/application_reimbursement_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Reimbursement Application Form</h1>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="col-lg-8 col-lg-offset-2 well">
					<?php 
						echo $dispMsg; 

						if(isset($_GET['img']))
						{
							echo "<div class='alert alert-danger alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									The image you selected is not valid. Please upload a valid image file (jpg, bmp, or png formats only).
								</div>";
						}
					?>
					<div class="form-group">
						<label class="control-label col-lg-4">Date</label>
						<div class="col-lg-6">
							<input type="date" id="inpDate" name="inpDate" class="form-control" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Expense Type</label>
						<div class="col-lg-6">
							<select name="inpType" id="inpType" class="form-control" required>
								<option selected disabled>Choose...</option>
								<?php echo $list_etypes; ?>			
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Related Case</label>
						<div class="col-lg-6">
							<select name="inpCase" id="inpCase" class="form-control" required>
								<option selected disabled>Choose...</option>
								<?php echo $list_cases; ?>				
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Amount</label>
						<div class="col-lg-6">
							<input type="number" id="inpAmount" name="inpAmount" class="form-control" min="1" step=".01" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Receipt (Photo)</label>
						<div class="col-lg-6">
							<input type="file" name="inpReceipt" id="inpReceipt" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Remarks</label>
						<div class="col-lg-6">
							<textarea rows="3" class="form-control" id="inpRemarks" name="inpRemarks" placeholder="Optional remarks"></textarea>
						</div>
					</div>				
					<div class="form-group">
						<div class="col-lg-3 col-lg-offset-7">
							<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block pull-right">Submit</button>
						</div>
					</div>
				
			</div>	
		</form>
		
	</div>
</div>
</body>
</html>