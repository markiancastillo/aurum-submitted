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

		<div class="form-group">
			<div class="input-group col-lg-8 col-lg-offset-2">
				<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
				<input type="text" name="keySearch" id="keySearch" class="form-control" onkeyup="searchList()" placeholder="Search for a name...">
			</div>
		</div>
		<br />
		<table id="listTable" name="listTable" class="table table-hover">
			<thead>
				<th class="text-center"></th>
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
									<td colspan='5' class='text-center'><h3>There are no accounts to display</h3></td>
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