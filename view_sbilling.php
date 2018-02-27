<?php
	include('controllers/view_sbilling_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Outstanding Balance Details</h1>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-lg-3 text-right">Account Name</label>
					<div class="col-lg-6">
						<p class="form-control-static"><?php echo $accountName; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3 text-right">Case Title</label>
					<div class="col-lg-6">
						<p class="form-control-static"><?php echo $caseTitle; ?></p>
					</div>
				</div>
			</form>
			
			<table id="listTable" name="listTable" class="table table-hover">
				<thead>
					<th class="text-center">Date</th>
					<th class="text-center">Remarks</th>
					<th class="text-center">Amount (PHP)</th>
				</thead>
				<tbody>
					<tr>
						<?php echo $list_details; ?>
					</tr>
					<tr>
						<td class="text-right" colspan="2"><h4>TOTAL</h4></td>
						<td class="text-center"><h4><?php echo $sfTotal; ?></h4></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="form-group">
			<div class="col-lg-2 col-lg-offset-6">
				<a href="process_billing.php" id="btnBack" name="btnBack" class="btn btn-default btn-block">Back</a>
			</div>
			<div class="col-lg-4">
				<button type="submit" id="btnGenerate" name="btnGenerate" class="btn btn-primary btn-block pull-right">Generate Billing</button>
			</div>
		</div>
	</div>
</body>
</html>