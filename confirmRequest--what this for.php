<?php
	include('controllers/requestleave_controller.php');
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
		<form class="form-horizontal" method="POST">
			<label class="control-label col-lg-3">Edit Request</label>
			<div class="col-lg-2">
				<div class="form-group">
					
					<form>
 						 <input type="radio" name="gender" value="Approve" checked> Approve<br>
 						 <input type="radio" name="gender" value="Disapprove"> Disapprove<br>
 						 <input type="radio" name="gender" value="other"> Other <br>
					</form> 
					
				<div class="form-group">
					<label class="control-label">Remarks</label>
					<div class="remarks">
						<textarea rows="2" cols="25" id="remarks" name="inpremarks"></textarea>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block pull-right">Submit</button>
				</div>
			</div>

		</form>
	</div>
</div>





</body>

</html>