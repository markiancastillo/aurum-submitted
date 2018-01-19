<?php
include('test1.php');
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/controllers/function.php');
	loadHeader();
	$plaintext = 'change.akyatpanaog';
	$password = '3sc3RLrpd17';
	$method = 'aes-256-cbc';
	
	// Must be exact 32 chars (256 bit)
	$password = substr(hash('sha256', $password, true), 0, 32);
	echo "Password: " . $password . "<br />";
	
	// IV must be exact 16 chars (128 bit)
	$iv = chr(0x74) . chr(0x68) . chr(0x69) . chr(0x73) . chr(0x49) . chr(0x73) . chr(0x41) . chr(0x53) . chr(0x65) . chr(0x63) . chr(0x72) . chr(0x65) . chr(0x74) . chr(0x4b) . chr(0x65) . chr(0x79);
	
	// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
	$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
	
	// My secret message 1234
	$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
	
	echo 'plaintext= ' . $plaintext . "<br />";
	echo 'cipher= ' . $method . "<br />";
	echo 'encrypted to: ' . $encrypted . "<br />";
	echo 'decrypted to: ' . $decrypted . "<br />";

	#$string_test = "pending";
	$num_test = $_SESSION['posID'];
	if($num_test == 1 || $num_test == 6 || $num_test == 8)
	{
		echo "true";
	}
	else 
	{
		echo "false";
	}

	echo "<br />" . $_SESSION['posID'];
?>