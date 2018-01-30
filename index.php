<?php
	include('controllers/index_controller.php');

	$dispSuccess = "";
	if(isset($_REQUEST['success']))
	{
		$dispSuccess = "<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							You have successfully changed your password.
						</div>";
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h1 class="text-center">Index Page</h1>
	<div class="col-lg-6 col-lg-offset-3">
		<?php echo $dispSuccess; ?>
	</div>
</body>
</html>