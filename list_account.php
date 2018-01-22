<?php
	include('controllers/list_account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center">List of Accounts</h1>
		<h3><?php #echo $_SESSION['accID']; ?></h3>
		<table class="table table-hover">
			<thead>
				<th class="text-center">Account Owner</th>
				<th class="text-center">Position</th>
				<th class="text-center">Department</th>
				<th class="text-center">Account Status</th>
				<th class="text-center">Actions</th>
			</thead>
			<tbody>
				<tr>
					<?php
						if($rowCount <= 0)
						{
							echo "
								<tr>
									<td colspan='4' class='text-center'><h3>There are no accounts to display</h3></td>
								</tr>
							";
						}
						else 
						{
							echo $displayList;
						} 
					?>
				</tr>
			</tbody>
		</table>
	</div>
</div>