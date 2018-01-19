<?php
	#encryption syntax: base64_encode(openssl_encrypt($text_to_be_encrypted, $method, $password, OPENSSL_RAW_DATA, $iv));
	#decryption syntax: openssl_decrypt(base64_decode($$text_to_be_decrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
	
	$password = '3sc3RLrpd17';
	$method = 'aes-256-cbc';

	# Must be exact 32 chars (256 bit)
	$password = substr(hash('sha256', $password, true), 0, 32);
	
	# IV must be exact 16 chars (128 bit)
	$iv = chr(0x74) . chr(0x68) . chr(0x69) . chr(0x73) . chr(0x49) . chr(0x73) . chr(0x41) . chr(0x53) . chr(0x65) . chr(0x63) . chr(0x72) . chr(0x65) . chr(0x74) . chr(0x4b) . chr(0x65) . chr(0x79);
	
	/*
	#for testing
	$plaintext = 'changeme.akyatpanaog';

	#$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
	$encrypted = "";
	$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
	
	#display test values
	echo 'plaintext= ' . $plaintext . "<br />";
	echo 'cipher= ' . $method . "<br />";
	echo 'encrypted to: ' . $encrypted . "<br />";
	echo 'length: ' . strlen($encrypted) . "<br />";
	echo 'decrypted to: ' . $decrypted . "<br />";
	*/
?>