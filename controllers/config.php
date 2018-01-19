<?php
#	Follows the syntax: $servername = "serverName/instanceName";
	$serverName = "localhost";

#	$connectionInfo  = array("Database"=>"database name", "UID"=>"db username", "PWD"=>"db password");
#	If password is not specified, connection will be attempted through windows authentication
	$connectionInfo = array("Database" => "aurum");
	$con = sqlsrv_connect($serverName, $connectionInfo);
?>