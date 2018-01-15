<?php
	include 'controllers/login_controller.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>User Login</h1>
	<form method="POST">
		<p>Username: <input type="text" id="inpUsername" name="inpUsername" maxlength="150" required="true"></p>
		<p>Password: <input type="password" id="inpPassword" name="inpPassword" maxlength="120" required="true"></p>
		<p><input type="submit" id="btnSubmit" name="btnSubmit" value="Submit"></p>
	</form>
</body>
</html>