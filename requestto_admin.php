<?php
	include('controllers/requesleavetoAdmin_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	
<section id="main-content">
   <section class="wrapper">

   	<?php 
				if(isset($_REQUEST['approved']))
				{
					$msgApprove = $_REQUEST['approved'];
					if(strcasecmp($msgApprove, "yes") == 0)
					{
						echo "
						<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Successfully approved the service fee request!
						</div>";
					}
					else if(strcasecmp($msgApprove, "no") == 0)
					{
						echo "
						<div class='alert alert-warning alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Successfully disapproved the service fee request.
						</div>";
					}
				}
			?>

	<div class="row">
		<h1 class="text-center">Requests</h1>
		<table class="table table-hover">
			<thead>
				<th class="text-center">Leave File Date</th>
				<th class="text-center">Leave From</th>
				<th class="text-center">Leave To</th>
				<th class="text-center">Days acquired</th>
				<th class="text-center">Status</th>
				<th class="text-center">Leave Reason</th>
				<th class="text-center">Remarks</th>
				
			</thead>
			<tbody>
				<tr>
					<?php

					if($rowCount <= 0)
							{
								echo "
									<tr>
										<td colspan='12' class='text-center'><h3>No Pending Requests</h3></td>
									</tr>
								";
							}
							else 
							{
						
							echo $listRequest;

							}
						
					?>
				</tr>
			</tbody>
</div>