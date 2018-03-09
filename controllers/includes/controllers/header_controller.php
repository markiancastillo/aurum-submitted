<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/aurum/controllers/config.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/aurum/controllers/security.php');

	ob_start(); # Quick fix to 'Warning: Cannot modify header information - headers already sent by...'
    
    ini_set('file_uploads', 'on'); #changes a setting in php.ini
    # sets path of application folder
    $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $port      = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
    $domain    = $_SERVER['SERVER_NAME'];

    define('app_path', "${protocol}://${domain}${disp_port}" . '/aurum/');
	
#	session_start();
	if(isset($_SESSION['accID']))
	{
		$accID = $_SESSION['accID'];

		$sql_account = "SELECT accountPhoto, accountFN, accountLN, positionID  FROM accounts WHERE accountID=?";
		$params_account = array($accID);
		$stmt_account = sqlsrv_query($con, $sql_account, $params_account);

		while($row = sqlsrv_fetch_array($stmt_account))
		{
			$accountPhoto = openssl_decrypt(base64_decode($row['accountPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
			$accPos = $row['positionID'];
		}

		$displayName = $accLN . ', ' . $accFN;
		$displayPhoto = $accountPhoto;

		$displayBilling = "style='display: none'";
		if($accPos == 9)
		{
			$displayBilling = "";
		}
	}
	else 
	{
		header('location: ' . app_path . 'login.php');
	}
?>