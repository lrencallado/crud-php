<?php
	date_default_timezone_set('Asia/Manila');
	
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root123');
	define('DB_NAME', 'exam_encallado');

	/* Attempt to connect to MySQL database */
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
	// Check connection
	if(!$conn){
	    die("ERROR: Could not connect. " . $conn->connect_error);
	}

	//echo "Connected successfully";

?>