<?php
	include('controllers/list_client_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">List of Clients</h1>
			<br>
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
</body>
</html>