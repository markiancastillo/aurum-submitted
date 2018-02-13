<?php
	echo '<b>encoded: </b>';
	echo $url = 'somepage.com/test.php?var=' . urlencode("mark+ian");
	echo '<br>';
	echo '<b>decoded: </b>';
	echo urldecode($url);
	echo '<br><br>';

	$var = $_GET['var'];
	echo $var;
?>
<html>
<head></head>
<body>
	<!--<form method="POST">
		<input type="text" name="text" id="text">
		<input type="submit" name="submit" value="send email">
	</form>-->
</body>
</html>