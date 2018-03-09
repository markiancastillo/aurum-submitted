<?php
	include('controllers/view_requestleave_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
   <section class="wrapper">
           
		<div class="row">
			<h1 class="text-center">Request Leave #<?php echo $_REQUEST['id']; ?> Details</h1>
			<hr />
			<div class="col-lg-5">
				<form class="form-horizontal">
					<div class="form-group">	
						<label class="control-label col-lg-4">Leave File Date</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveFileDate; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">Requestor</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $displayName; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">leaveFrom</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveFrom; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">leaveTo</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveTo; ?></p>
						</div>
					</div>
					<div class="form-group">	
						<label class="control-label col-lg-4">leaveReason</label>
						<div class="col-lg-8">
							<p class="form-control-static"><?php echo $leaveReason; ?></p>
						</div>
					</div>
					
				</form>
			</div>
			
						<a href='requestto_admin.php' class="btn btn-block btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back to List</a>
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