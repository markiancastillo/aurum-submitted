<?php
	include('controllers/account_servicefee_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
   <section class="wrapper">
        <div class="container">
			<div class="row">
				<h1 class="text-center">My Service Fee Applications</h1>
				<br />
				<table id="listTable" name="listTable" class="table table-hover">
					<thead>
						<th class="text-center">Date</th>
						<th class="text-center">Amount (Php)</th>
						<th class="text-center">Service Type</th>
						<th class="text-center">Reviewed By</th>
						<th class="text-center">Status</th>
						<th class="text-center">Remarks</th>
					</thead>
					<tbody>
						<tr>
							<?php
								if($rowCount <= 0)
								{
									echo "
										<tr>
											<td colspan='6' class='text-center'><h3>No Pending Requests</h3></td>
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
	</section>
</section>
</body>
</html>