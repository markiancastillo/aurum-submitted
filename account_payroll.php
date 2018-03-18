<?php
	include('controllers/account_payroll_controller.php');
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
			<div class="row mt">
				<div class="form-panel">
					<h1 class="text-center">My Payroll Receipts</h1>
					<br />
					<fieldset>
						<table id="listTable" name="listTable" class="table table-hover">
							<thead>
								<th class="text-center">Date</th>
								<th class="text-center">File</th>
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
												<td colspan='4' class='text-center'><h3>No Receipts Found</h3></td>
											</tr>
										";
									}
									else 
									{
										echo $list_payroll;
									}
									?>
								</tr>
							</tbody>
						</table>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>