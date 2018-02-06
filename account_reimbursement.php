<?php
	include('controllers/account_reimbursement_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">My Reimbursement Applications</h1>
			<br />
			<table id="listTable" name="listTable" class="table table-hover">
				<thead>
					<th class="text-center">Date Requested</th>
					<th class="text-center">Case</th>
					<th class="text-center">Amount</th>
					<th class="text-center">Expense Type</th>
					<th class="text-center">Remarks</th>
					<th class="text-center">Status</th>
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
								echo $list_reimbursements;
							}
						?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>