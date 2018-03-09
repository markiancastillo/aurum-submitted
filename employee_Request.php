<?php
	include('controllers/employeeRequest_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center">Your Request</h1>
		<table class="table table-hover">
			<thead>
				<th class="text-center">First Name</th>
				<th class="text-center">Last Name</th>
				<th class="text-center">Type of leave</th>
				<th class="text-center">Reason of leave</th>
				<th class="text-center">Date prepared</th>
				<th class="text-center">Duration From</th>
				<th class="text-center">Duration To</th>
				<th class="text-center">Status</th>
				<th class="text-center">Action</th>
				<th class="text-center">Remarks</th>
			</thead>
			<tbody>
				<tr>
					<?php
						
							echo $displayemployeeRequest;
						
					?>
				</tr>
			</tbody>
</div>