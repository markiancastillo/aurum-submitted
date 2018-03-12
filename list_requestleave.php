<?php
include('controllers/list_requestleave_controller.php');
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
					<div class="form-panel">
						<form class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
							<fieldset>
								<legend>Your Request</legend>
								<table class="table table-hover">
									<thead>
										<th class="text-center">Leave File Date</th>
										<th class="text-center">Leave From</th>
										<th class="text-center">Leave To</th>	
										<th class="text-center">Days acquired</th>
										<th class="text-center">Leave Reason</th>
										<th class="text-center">Status</th>
										<th class="text-center">Remarks</th>	
									</thead>
									<tbody>
										<tr>
											<?php echo $listRequest; ?>
										</tr>
									</tbody>
								</table>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>
