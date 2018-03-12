<?php
	include('controllers/view_reimbursement_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<section id="main-content">
		<section class="wrapper">
			<div class="container">
				<div class="row">
					<div class="form-panel">
						<fieldset>
							<div class="col-lg-12">
								<h1 class="text-center">Reimbursement #<?php echo $_REQUEST['id']; ?> Details</h1>
								<br />
								<div class="col-lg-10 col-lg-offset-1">
									<?php echo $msgDisplay; ?>
								</div>
								<div class="col-lg-5">
									<form class="form-horizontal">
										<div class="form-group">	
											<label class="control-label col-lg-4">Date Requested</label>
											<div class="col-lg-8">
												<p class="form-control-static"><?php echo $expenseDate; ?></p>
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
												<p class="form-control-static"><?php echo $expenseAmount; ?></p>
											</div>
										</div>
										<div class="form-group">	
											<label class="control-label col-lg-4">Expense Type</label>
											<div class="col-lg-8">
												<p class="form-control-static"><?php echo $etypeName; ?></p>
											</div>
										</div>
										<div class="form-group">	
											<label class="control-label col-lg-4">Remarks</label>
											<div class="col-lg-8">
												<p class="form-control-static"><?php echo $expenseRemarks; ?></p>
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
									<div class="col-lg-6">
										<form method="POST">
											<div class="col-lg-7">
												<button class="btn btn-block btn-success" id="btnApprove" name="btnApprove" onclick="return confirm('Confirm approval of reimbursement request #<?php echo $_REQUEST['id']; ?>?');">
													<span class='glyphicon glyphicon-ok'></span> Approve
												</button>
											</div>
										</form>
										<div class="col-lg-5">
											<button class="btn btn-block btn-danger" data-toggle="modal" data-target="#disapproveModal">
												<span class='glyphicon glyphicon-remove'></span> Disapprove
											</button>
										</div>
									</div>
									<div id="disapproveModal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Disapprove Request</h4>
												</div>
												<form class="form-horizontal" method="POST" role="form">
													<div class="modal-body">
														<div class="form-group">	
															<label class="control-label col-lg-3">Disapproval Note</label>
															<div class="col-lg-9">
																<textarea class="form-control" rows="3" id="inpNote" name="inpNote" placeholder="Reason for disapproval" required="true"></textarea>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-danger" id="btnDeny" name="btnDeny">
															<span class='glyphicon glyphicon-remove'></span> Disapprove
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>