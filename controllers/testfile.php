<?php
	include('config.php');
	include('security.php');

	ini_set('file_uploads', 'on'); #changes a setting in php.ini

	$accID = '1';
	
	#if(isset($_POST['submit']))
	if(isset($_POST['submit']))
	{
		if(!isset($_FILES['image']) || $_FILES['image']['error'])
		{
			echo 'empty';
		}
		else
		{
			echo 'not empty';
		}
	    #directory where the image will be stored
		$upload = $_SERVER["DOCUMENT_ROOT"] . "/aurum/images/";
		#gets the original name of the file
		$image = $_FILES["image"]["name"];
		#filename will be uploader's ID + image name
		#e.g. 1photo.png
		$newImage = $accID . "_" . basename($image);
		$file = $upload . $newImage;

		move_uploaded_file($_FILES["image"]["tmp_name"], $file);

		$encrypt_img = base64_encode(openssl_encrypt($image, $method, $password, OPENSSL_RAW_DATA, $iv));
		$sql_insert = "UPDATE accounts SET accountPhoto = ? WHERE accountID = ?";
		$params_insert = array($encrypt_img, 1);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
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
       <li>Encrypted filename: <?php echo $encrypt_img; ?> 
    </ul>

    <p>display image: <img src='../images/<?php echo $image; ?>' alt='placeholder/<?php echo $image; ?>' width="300px" /><?php echo $image; ?></p>
</form>

</body>
</html>
