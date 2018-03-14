<?php
	include('controllers/create_project_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5iyso3f5zg58ld5wqj8dw0ctl2a13x98zgwx1urb7hgtc415"></script> 
  	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
<section id="main-content">
   <section class="wrapper">
	<div class="row">
		<h1 class="text-center">Create project</h1>
		<hr />
		<?php 
			if(isset($_POST['btnSubmit']))
			{
				if($stmt_insert === false)
				{
					echo "
						<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							die( print_r( sqlsrv_errors(), true));
						</div>
					";
					die( print_r( sqlsrv_errors(), true));
				}
				else 
				{
					echo "
						<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Successfully created project!
						</div>
					";
				}
			}
		?>
		<form class="form-horizontal" method="POST">
			<div class="col-lg-6">
				
				<div class="form-group">
							<label class="control-label col-lg-3">Project Name</label>
							<div class="col-lg-8">
							<input type="text" name="cTitle" class="form-control" required>
						</div>
					</div>
				<div class="form-group">
							<label class="control-label col-lg-3">Project Description</label>	
							<div class="col-lg-8">
							<textarea type="text" name="cRemarks" class="form-control">
							</textarea>
						</div>
				</div>
				<div class="form-group">
							<label class="control-label col-lg-3 ">Project Client</label>
							<div class="col-lg-8">

								<select id="cClient" name="cClient" class="form-control" required="true">
								<option disabled selected>Choose...</option>
								
								<?php echo $list_clients; ?>
								</select>
							</div>
				</div>	
				<div class="form-group">
							<label class="control-label col-lg-3">Employee Assigned</label>
							<div class="col-lg-8">
								<select id="cEmpAssigned" name="cEmpAssigned" class="form-control" required="true">
								<option disabled selected>Choose...</option>
								<?php echo $list_employees; ?>
								</select>
							</div>
						</div>	
					<div class="form-group">
							<label class="control-label col-lg-3">Start Date</label>
							<div class="col-lg-8">
							<input type="date" name="cSDate" class="form-control" required="true">
						</div>
					</div>
						<div class="form-group">
						<label class="control-label col-lg-3">End Date</label>
						<div class="col-lg-8">
							<input type="date" name="cEDate" class="form-control" required="true">
						</div>
					</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Project Remarks</label>
							<div class="col-lg-8">
							<input type="text" name="cRemarks" class="form-control" required="true">
						</div>
					</div>
						<div class="form-group">
							<label class="control-label col-lg-3">Project Status</label>
							<div class="col-lg-8">
							<select id="cStatus" name="cStatus" class="form-control">
								<option disabled selected>Choose...</option>
								<option value="Closed">Closed</option>
								<option value="On-going">On-going</option>
								<option value="Pending">Pending</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-lg-offset-1">
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-block btn-success">Add</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>