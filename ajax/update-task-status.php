<?php
require_once("db_conn.php");

if ( empty($_POST['task_id']) OR empty($_POST['status']) ) {
	exit;
}

$task_id = (int) $_POST['task_id'];
$status = filter_var( (string)$_POST['status'], FILTER_VALIDATE_BOOLEAN);

$table = get_table_name('task');

if ( $status === true) {

	$stmt = $db->prepare("UPDATE `{$table}` SET task_status = 1 WHERE task_id = '{$task_id}'");
	$stmt->execute();

	exit;
} elseif ( $status === false ){
	$stmt = $db->prepare("UPDATE `{$table}` SET task_status = 0 WHERE task_id = '{$task_id}'");
	$stmt->execute();

	exit;
} else{
	echo "No Update";
}