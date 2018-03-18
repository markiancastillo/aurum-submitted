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
			$accountPhoto = htmlspecialchars(openssl_decrypt(base64_decode($row['accountPhoto']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accPos = htmlspecialchars($row['positionID'], ENT_QUOTES, 'UTF-8');
		}

		$displayName = $accLN . ', ' . $accFN;
		$displayPhoto = $accountPhoto;

		$displayBilling = "style='display: none'";
		$displayPayroll = "style='display: none'";
		if($accPos == 9)
		{
			#user is in accounting
			$displayBilling = "";
			$displayPayroll = "";
		}

		#get the count of new notifications
		$sql_notifCount = "SELECT COUNT(notificationID) AS 'notifCount' FROM notifications
						   WHERE notificationStatus = 'Unread' AND accountID = ?";
		$params_notifCount = array($accID);
		$stmt_notifCount = sqlsrv_query($con, $sql_notifCount, $params_notifCount);

		while($nCount = sqlsrv_fetch_array($stmt_notifCount))
		{
			$notifCount = $nCount['notifCount'];
		}

		$btnDismiss = "<a href='' class='text-center'>DISMISS ALL</a>";
		$list_notif = "";
		if($notifCount == 0)
		{
			$btnDismiss = "";
			$list_notif = "
					<a>
	                    <div class='task-info'>
	                        <div class='desc'>No new notifications.</div>
	                    </div>   
	                </a>
			";
		}
		else
		{
			#get the top 5 latest notifications
			$sql_notification = "SELECT TOP 5 notificationMessage, notificationDate FROM notifications
								 WHERE notificationStatus = 'Unread' AND accountID = ? 
								 ORDER BY notificationDate DESC";
			$params_notification = array($accID);
			$stmt_notification = sqlsrv_query($con, $sql_notification, $params_notification);
	
			while($nrow = sqlsrv_fetch_array($stmt_notification))
			{
				$notificationMessage = $nrow['notificationMessage'];
				$notificationDate = $nrow['notificationDate']->format('m/d/Y');
	
				$list_notif .= "
					<a>
	                    <div class='task-info'>
	                        <div class='desc'>$notificationMessage</div>
	                        <div class='percent'>$notificationDate</div>
	                    </div>   
	                </a>
				";
			}
		}
	}
	else 
	{
		header('location: ' . app_path . 'login.php');
	}
?>