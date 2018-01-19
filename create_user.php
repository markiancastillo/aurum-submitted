<?php
	include('controllers/create_user_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="container">
	<div class="row">
<<<<<<< HEAD
		<h1 class="text-center">Create a New User Account</h1>
		<hr />
		<?php 
			if(isset($_POST['btnSubmit']))
			{
				if($stmt_insert === false)
				{
					echo "
						<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Failed to create a new account! Please check your input and try again.
						</div>
					";
				}
				else 
				{
					echo "
						<div class='alert alert-success alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Successfully created a new account!
						</div>
					";
				}
			}
		?>
		<form class="form-horizontal" method="POST">
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label col-lg-3">First Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpFN" name="inpFN" class="form-control" maxlength="50" required="true" />
=======
		<div class="col-lg-8 col-lg-offset-2">
			<form class="form-horizontal" method="POST">
				<?php 
					if(isset($_POST['btnSubmit']))
					{
						if($stmt_insert === false)
						{
							echo "<div class='alert alert-danger'>
							      		Error creating a new user. Please check your inputs and try again.
							      </div>";
						}
						else 
						{
							#insert successful!
							echo "<div class='alert alert-success'>
										Successfully created a new user.
							      </div>";
						}
					}
				?>
				<div class="form-group">
					<label class="control-label col-lg-3">First Name</label>
					<div class="col-lg-8">
						<input type="text" id="inpFN" name="inpFN" class="form-control" maxlength="50" required="	true" />
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Middle Name</label>
					<div class="col-lg-8">
<<<<<<< HEAD
						<input type="text" id="inpMN" name="inpMN" class="form-control" maxlength="50" placeholder="optional" />
=======
						<input type="text" id="inpMN" name="inpMN" class="form-control" maxlength="50" placeholder	="optional" />
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Last Name</label>
					<div class="col-lg-8">
<<<<<<< HEAD
						<input type="text" id="inpLN" name="inpLN" class="form-control" maxlength="50" required="true" />
=======
						<input type="text" id="inpLN" name="inpLN" class="form-control" maxlength="50" required="	true" />
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Birth Date</label>
					<div class="col-lg-8">
						<input type="date" id="inpBDay" name="inpBDay" class="form-control" max="2017-01-01" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Email Address</label>
					<div class="col-lg-8">
<<<<<<< HEAD
						<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" />
=======
						<input type="email" id="inpEmail" name="inpEmail" class="form-control" maxlength="100" 	placeholder="optional" />
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Sex</label>
					<div class="col-lg-8">
						<select id="inpSex" name="inpSex" class="form-control">
<<<<<<< HEAD
							<option disabled selected>Choose...</option>
=======
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
							<option value="M">Male</option>
							<option value="F">Female</option>
						</select>
					</div>
				</div>
				<div class="form-group">
<<<<<<< HEAD
					<label class="control-label col-lg-3">Position</label>
					<div class="col-lg-8">
						<select id="inpPosition" name="inpPosition" class="form-control" required="true">
							<option disabled selected>Choose...</option>
							<?php echo $list_positions; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Department</label>
					<div class="col-lg-8">
						<select id="inpDepartment" name="inpDepartment" class="form-control" required="true">
							<option disabled selected>Choose...</option>
							<?php echo $list_departments; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label class="control-label col-lg-3">SSS Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">TIN</label>
					<div class="col-lg-8">
						<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">BIR Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpBIR" name="inpBIR" class="form-control" maxlength="25" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">HDMF Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Civil Status</label>
					<div class="col-lg-8">
						<select id="inpCivilStatus" name="inpCivilStatus" class="form-control">
							<option disabled selected>Choose...</option>
							<?php echo $list_cstatus; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Base Rate</label>
					<div class="col-lg-8">
						<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step=".01" required="true" />
					</div>
				</div>	
			</div>
			<div class="col-lg-6 col-lg-offset-6">
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-success btn-block pull-right">Create Account</button>
=======
					<label class="control-label col-lg-3">SSS Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpSSS" name="inpSSS" class="form-control" maxlength="25" required=	"true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">TIN</label>
					<div class="col-lg-8">
						<input type="text" id="inpTIN" name="inpTIN" class="form-control" maxlength="25" required=	"true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">BIR Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpBIR" name="inpBIR" class="form-control" maxlength="25" required=	"true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">HDMF Number</label>
					<div class="col-lg-8">
						<input type="text" id="inpHDMF" name="inpHDMF" class="form-control" maxlength="25" 	required="true" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Civil Status</label>
					<div class="col-lg-8">
						<select id="inpCivilStatus" name="inpCivilStatus" class="form-control">
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Separated/Divorced">Separated/Divorced</option>
							<option value="Widowed">Widowed</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Position</label>
					<div class="col-lg-8">
						<input type="text" id="inpPosition" name="inpPosition" class="form-control" maxlength="50"	 placeholder="optional" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Department</label>
					<div class="col-lg-8">
						<select id="inpDepartment" name="inpDepartment" class="form-control">
							<option value="">Choose department...</option>
							<?php echo $list_departments; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Base Rate</label>
					<div class="col-lg-8">
						<input type="number" id="inpBaseRate" name="inpBaseRate" class="form-control" min=1 step="	.01" required="true" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-3 col-lg-offset-8">
						<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-success btn-block 	pull-right">Create</button>
>>>>>>> 23d19e135cf5ff6a790ff86b24291c388c48499e
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>