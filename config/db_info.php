<?php

	$dbtype = 'mysql';
	$host = 'localhost';

	// Local Server
// 	$dbname = 'mocat_store';
// 	$dbuser = 'root';
// 	$dbpassword = 'simecdev123';

	// Online Server
	$dbname = 'simec_estore';
	$dbuser = 'root';
	$dbpassword = 'simecdev123';
	
	$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

?>