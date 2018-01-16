<?php
	include('controllers/header_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<!-- CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Local files -->
	<link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>js/bootstrap.min.js" />
	<link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>js/jquery.min.js" />
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
    		<a class="navbar-brand">AURUM System</a>
		</div>
		<ul class="nav navbar-nav">
    		<li><a href="<?php echo app_path?>index.php">Dashboard</a></li>
    		<li class="dropdown">
    		  	<a class="dropdown-toggle" data-toggle="dropdown">User Management <span class="caret"></span></a>
    		  	<ul class="dropdown-menu">
    		      	<li><a href="<?php echo app_path?>create_user.php">Create an Account</a></li>
    		      	<li><a href="">Page 1-2</a></li>
    		      	<li><a href="">Page 1-3</a></li>
    		  	</ul>
    		</li>
    		<li><a href="">Page 2</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
    		<li class="dropdown">
    		  	<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $displayName; ?> <span class="caret"></span></a>
    		  	<ul class="dropdown-menu">
    		      	<li><a href="">My Account</a></li>
    		      	<li><a href="<?php echo app_path?>controllers/logout.php">Logout</a></li>
    		  	</ul>
    		</li>
		</ul>
	</div>
</nav>
</body>
</html>
