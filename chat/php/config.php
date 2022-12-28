<?php
define('ABSPATH', TRUE);

/* Define SITE HOME url */
if (($_SERVER['HTTP_HOST']) == 'cse328.local') {
	define('SITE_URL', 'http://cse328.local');
}else{
	define('SITE_URL', '#');
}

require_once( dirname(__DIR__,2) . "/db/connection.php" );
require_once( dirname(__DIR__,2) . "/inc/function.php" );
?>