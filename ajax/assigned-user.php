<?php

if ( empty($_POST) ) {
	return;
}

require_once("db_conn.php");

$table = get_table_name('category_user');
$cat_id = (int) secure_str( (string) $_POST['category_id'], 'dec' );
$user_id = (int) $_POST['user_id'];
$status = filter_var( $_POST['status'], FILTER_VALIDATE_BOOLEAN);
$notification_title = get_project_title($cat_id)." Share with you";

if ( $status === true ) {
	//Inster Data Into User Task Table
	$stmt = $db->prepare("INSERT INTO `{$table}` (user_id, cat_id) VALUES('{$user_id}', '{$cat_id}')");
	$stmt->execute();

	add_notification($notification_title, $user_id, $cat_id);
	
} elseif ( $status === false AND !is_project_admin($cat_id, $user_id) ) {
	//Delete Data From User Task Table
	$stmt = $db->prepare("DELETE FROM `{$table}` WHERE user_id = '{$user_id}' AND cat_id = '{$cat_id}'");
	$stmt->execute();
}

exit;