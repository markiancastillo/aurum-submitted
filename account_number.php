<?php
	include('controllers/account_number_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="container">
			<div class="row">
				<h1 class="text-center">Contact Information</h1>
				<hr />
				<?php
					if(isset($_REQUEST['updated']))
					{
						echo "<div class='alert alert-success alert-dismissable fade in'>
								<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Account information successfully updated.
							</div>";
					}
				?>
				<div class="col-lg-7">
					<h3>My Numbers</h3>
					<br />
					<div class="col-lg-10 col-lg-offset-1">
						<table class="table table-hover table-responsive">
							<thead>
								<th class="text-center">Number</th>
								<th class="text-center">Type</th>
							</thead>
							<tbody>
								<?php echo $displayList; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-5">
					<h3>Add a New Number</h3>
					<br />
					<div class="col-lg-10 col-lg-offset-1">
						<form class="form-horizontal" method="POST">
							<div class="form-group">
								<label class="control-label col-lg-3">Number</label>
								<div class="col-lg-9">
									<input type="text" id="inpNumber" name="inpNumber" class="form-control" maxlength="25" required="true" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3">Type</label>
								<div class="col-lg-9">
									<select id="inpType" name="inpType" class="form-control" required="true">
										<option selected disabled>Select one...</option>
										<?php echo $list_cTypes; ?>
									</select>
								</div>
							</div>
							<br />
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" id="btnAdd" name="btnAdd" class="btn btn-primary pull-right">Add New</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-12">
					<a href="account.php" class="btn btn-default">Back to My Account</a>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>