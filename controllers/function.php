<?php
	function loadHeader()
	{
		session_start();
		if(isset($_SESSION['accID']))
		{
			$accID = $_SESSION['accID'];
			$posID = $_SESSION['posID'];

			if($posID == 1 || $posID == 6 || $posID == 8)
			{
				#load header_admin when account's position is either:
				#1 - managing partner
				#6 - executive assistant
				#8 - HR assistant
				$header = "includes/header_admin.php";
			}
			else
			{
				#account does not have adminstrative powers
				$header = "includes/header.php";
			}
			return $header;
		}
	}
?>