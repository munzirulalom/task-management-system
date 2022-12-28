<?php
session_start();
//$_SESSION['id'] = 1;
/* Define ABSPATH */
define('ABSPATH', TRUE);

/* Define SITE HOME url */
if (($_SERVER['HTTP_HOST']) == 'cse328.local') {
	define('SITE_URL', 'http://cse328.local');
}else{
	define('SITE_URL', '#');
}

require_once("db/connection.php");
require_once('inc/function.php');

if ( isset($_SESSION['id']) == 1 AND isset( $_GET['page'] ) ) {

	switch ( $_GET['page'] ) {
		case 'dashboard' :
		require_once('inc/home.php');
		break;
		
		case 'task' :
		require_once('inc/tasks.php');
		break;
		
		case 'assigned' :
		require_once('inc/assigned_to_me.php');
		break;
		
		case 'chat' :
		require_once('chat/users.php');
		break;
		
		case 'profile' :
		require_once('inc/profile.php');
		break;

		default:
		require_once('inc/home.php');
		break;
	}
	
} else {
	get_header('login');

	if ( isset($_GET['action']) ) {

		switch ( $_GET['action'] ) {
			case 'register' :
			require_once("inc/register.php");
			break;
			case 'forgot-password' :
			require_once("inc/forgot-password.php");
			break;
			case 'forgot-password-next' :
			require_once("inc/forgot-password-next.php");
			break;
			case 'new-password' :
			require_once("inc/new-password.php");
			break;

			default:
			require_once("inc/login.php");
			break;
		}
		
	}else {
		require_once("inc/login.php");
	}

	get_footer('login');
}