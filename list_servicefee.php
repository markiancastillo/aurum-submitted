<?php
	include('controllers/list_servicefee_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Service Fee Applications</h1>

			<div class="form-group">
				<div class="input-group col-lg-8 col-lg-offset-2">
					<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
					<input type="text" name="keySearch" id="keySearch" class="form-control" onkeyup="searchList()" placeholder="Search by name...">
				</div>
			</div>
			<br />
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
			<table id="listTable" name="listTable" class="table table-hover">
				<thead>
					<th class="text-center">Date Requested</th>
					<th class="text-center">Requestor Name</th>
					<th class="text-center">Case</th>
					<th class="text-center">Amount</th>
					<th class="text-center">Service Type</th>
					<th class="text-center">Remarks</th>
					<th class="text-center">Actions</th>
				</thead>
				<tbody>
					<tr>
						<?php
							if($rowCount <= 0)
							{
								echo "
									<tr>
										<td colspan='7' class='text-center'><h3>No Pending Requests</h3></td>
									</tr>
								";
							}
							else 
							{
								echo $list_servicefees;
							}
						?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>