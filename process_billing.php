<?php
	include('controllers/process_billing_controller.php');
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
			<h1 class="text-center">Process Billing</h1>
			<div class="col-lg-12">
				<?php echo $msgDisplay; ?>
				<table id="listTable" name="listTable" class="table table-hover">
					<thead>
						<th class="text-center">Account Name</th>
						<th class="text-center">Case Title</th>
						<th class="text-center">Billing Type</th>
						<th class="text-center">Actions</th>
					</thead>
					<tbody>
						<tr>
							<?php
								if($rowCount <= 0)
								{
									echo "
										<tr>
											<td colspan='4' class='text-center'><h3>There are no legal billing requests to display</h3></td>
										</tr>
									";
								}
								else 
								{
									echo $list_rbilling;
									echo $list_sbilling;
								} 
							?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>