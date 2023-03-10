<?php

/**
* 
* CSE 200 Lab [Task Management System]
* 
*/

$servername = "localhost";
$port = 10108; //Default is 3306
$dbname = "local";
$dbusername = "root";
$dbpassword = "root";

try{

	$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $dbusername, $dbpassword);

	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//echo "Connected successfully";

} catch( PDOException $e ){
	echo "Connection failed: " . $e->getMessage();
	exit();
}