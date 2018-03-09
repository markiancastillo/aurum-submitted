<?php
	include('controllers/account_billing_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Billing Records</h1>
			<br />
			<table id="listTable" name="listTable" class="table table-hover">
				<thead>
					<th class="text-center">Date Processed</th>
					<th class="text-center">File Name</th>
					<th class="text-center">Remarks</th>
				</thead>
				<tbody>
					<?php
						if($rowCount == 0)
						{
							echo "
								<tr>
									<td colspan='3' class='text-center'><h3>There are no records to display.</h3></td>
								</tr>
							";
						}
						else
						{
							echo $list_billing;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>