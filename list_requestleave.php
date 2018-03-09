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
	<div class="row">
		<h1 class="text-center">Your Request</h1>
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
					<?php
						
							echo $listRequest;
							
					?>
				</tr>
			</tbody>
</div>