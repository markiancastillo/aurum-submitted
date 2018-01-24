<?php
	$serverName = "localhost";

#	$connectionInfo  = array("Database"=>"database name", "UID"=>"db username", "PWD"=>"db password");
#	If password is not specified, connection will be attempted through windows authentication
	$connectionInfo = array("Database" => "aurum");
	$con = sqlsrv_connect($serverName, $connectionInfo);

	ini_set('file_uploads', 'on'); #changes a setting in php.ini

	if(isset($_FILES['image']))
	{
	/*	$errors= array();
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	    
	    $expensions= array("jpeg","jpg","png");
	    
	    if(in_array($file_ext,$expensions)=== false)
	    {
	       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	    }
	    
	    if($file_size > 2097152)
	    {
	       $errors[]='File size must be excately 2 MB';
	    }
	    
	    if(empty($errors)==true)
	    {
	       move_uploaded_file($file_tmp,"images/".$file_name);
	       echo "Success";
	    }
	    else
	    {
	       print_r($errors);
	    }*/

	    $upload = $_SERVER["DOCUMENT_ROOT"] . "/aurum/test/images/"; # location where to upload the image
		$image = $_FILES["image"]["name"]; # gets the file from file upload
		$newImage = date('YmdHis-') . basename($image); # eg. 20170322051234-sample.jpg
		$file = $upload . $newImage;

		move_uploaded_file($_FILES["image"]["tmp_name"], $file);

		$sql_insert = "UPDATE accounts SET accountPhoto = ? WHERE accountID = ?";
		$params_insert = array($newImage, 1);
		$stmt_insert = sqlsrv_query($con, $stmt_insert);

		echo $stmt_insert;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity=	"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Optional theme -->	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" 	integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="	sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image">
    <input type="submit" value="Upload Image" name="submit">

    <ul>
       <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
       <li>File size: <?php echo $_FILES['image']['size'];  ?>
       <li>File type: <?php echo $_FILES['image']['type']   ?>
       	<li>Upload Location: <?php echo $upload; ?></li>
       	<li>Image File: <?php echo $image;  ?></li>
       	<li>New Image Filename: <?php echo $newImage; ?></li>
       	<li>File: <?php echo $file; ?></li>
    </ul>

    <p>display image: <img src='images/<?php echo $newImage; ?>' alt='images/<?php echo $newImage; ?>' width="300px" /><?php echo $newImage; ?></p>
</form>

</body>
</html>
