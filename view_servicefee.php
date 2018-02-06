<?php
	include('controllers/view_servicefee_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Service Fee #<?php echo $_REQUEST['id']; ?> Details</h1>
			<hr />
			<div class="col-lg-5">
				<form class="form-horizontal">
					<div class="form-group">	
						<label class="control-label col-lg-4">Date Requested</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $sfDate; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Requestor</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $accountName; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Case</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $caseTitle; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Amount</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $sfAmount; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Service Type</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $stypeName; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Remarks</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $sfRemarks; ?></p>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-7">
				<div class="form-group">
					<label class="control-label col-lg-4">Proof of Expense</label>
					<div class="col-lg-8">
						<img class="img-responsive" src='images/proof/<?php echo getPhoto($accountPhoto); ?>' width="70%" alt='<?php echo getPhoto($accountPhoto); ?>' />
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					<div class="col-lg-5 ">
						<a href='list_reimbursement.php' class="btn btn-block btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back to List</a>
					</div>
				</div>
				<form class="col-lg-6 " method="POST">
					<div class="col-lg-7">
						<button class="btn btn-block btn-success" id="btnApprove" name="btnApprove" onclick="return confirm('Confirm approval of service fee request #<?php echo $_REQUEST['id']; ?>?');">
							<span class='glyphicon glyphicon-ok'></span> Approve</button>
						</button>
					</div>
					<div class="col-lg-5">
						<button class="btn btn-block btn-danger" id="btnDeny" name="btnDeny" onclick="return confirm('Confirm disapproval of service fee request #<?php echo $_REQUEST['id']; ?>?');">
							<span class='glyphicon glyphicon-remove'></span> Disapprove
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>