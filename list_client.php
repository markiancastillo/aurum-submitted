<?php
	include('controllers/list_client_controller.php');
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
					<div class="content-panel">
						<h1 class="text-center">List of Clients</h1>
						<br>
						<div class="col-lg-8 col-lg-offset-2">
							<?php
							if(isset($_GET['update']))
							{
								echo "<div class='alert alert-success alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Client information successfully updated.
									</div>";
							}
							?>
						</div>
						<table class="table table-hover">
							<thead>
								<th class="text-center"></th>
								<th class="text-center">Name</th>
								<th class="text-center">Email</th>
								<th class="text-center"></th>
							</thead>
							<tbody>
								<?php echo $list_client; ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>