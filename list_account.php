<?php
	include('controllers/list_account_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="container">
			<div class="row mt">
				<div class="content-panel">
					<fieldset>
						<div class="col-lg-10 col-lg-offset-1">
							<h1 class="text-center">List of Accounts</h1>
							<br />
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
									<th class="text-center">ID</th>
									<th class="text-center">Name</th>
									<th class="text-center">Position</th>
									<th class="text-center">Department</th>
									<th class="text-center">Actions</th>
								</thead>
								<tbody>
									<tr>
										<?php
										if($rowCount <= 0)
										{
											echo "
											<tr>
											<td colspan='6' class='text-center'><h3>There are no accounts to display</h3></td>
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
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>   
