<?php
	include 'controllers/create_user_controller.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create User</title>
</head>
<body>
	<h1>Create a New User</h1>
	<form method="POST">
		<p>Photo: (To be added)</p>
		<p>First Name: <input type="text" id="inpFN" name="inpFN" maxlength="150" required /></p>
		<p>Middle Name: <input type="text" id="inpMN" name="inpMN" maxlength="100" placeholder="optional" /></p>
		<p>Last Name: <input type="text" id="inpLN" name="inpLN" maxlength="150" required /></p>
		<p>Birth Date: <input type="date" id="inpBDay" name="inpBDay" max="2018-01-01" /></p>
		<p>Email Addess: <input type="email" id="inpEmail" name="inpEmail" maxlength="100" placeholder="optional" /></p>
		<p>Sex: 
			<select id="inpSex" name="inpSex">
				<option value="M">Male</option>
				<option value="F">Female</option>
			</select>
		</p>
		<p>SSS Number: <input type="text" id="inpSSS" name="inpSSS" maxlength="25" placeholder="optional" /></p>
		<p>TIN Number: <input type="text" id="inpTIN" name="inpTIN" maxlength="25" placeholder="optional" /></p>
		<p>BIR Number: <input type="text" id="inpBIR" name="inpBIR" maxlength="25" placeholder="optional" /></p>
		<p>HDMF Number: <input type="text" id="inpHDMF" name="inpHDMF" maxlength="25" placeholder="optional" /></p>
		<p>Civil Status: 
			<select id="inpCivilStatus" name="inpCivilStatus">
				<option value="Single">Single</option>
				<option value="Married">Married</option>
				<option value="Separated/Divorced">Separated/Divorced</option>
				<option value="Widowed">Widowed</option>
			</select>
		</p>
		<p>Position: <input type="text" id="inpPosition" name="inpPosition" maxlength="50" placeholder="optional" />
		<p>Department: 
			<select id="inpDepartment" name="inpDepartment">
				<?php echo $list_departments; ?>
			</select>
		</p>
		<p>Base Rate: <input type="number" id="inpBaseRate" name="inpBaseRate" min=1 step=".01" required="true" /></p>
		<p><input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" /></p>
	</form>
</body>
</html>