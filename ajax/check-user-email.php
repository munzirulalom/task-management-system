<?php

if (!isset($_GET['email'])) {
	return;
}

require_once("db_conn.php");

$email = (string) $_GET['email'];

$result = check_duplicate('user','user_email',$email);

if ($result == true) {
	echo 1;
} else{
	echo 0;
}

return;