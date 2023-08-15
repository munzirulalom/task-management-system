<?php
require_once("db_conn.php");

if ( empty($_POST['cat_id']) OR empty($_POST['task_id']) OR empty($_POST['status']) ) {
	exit;
}

$userID = (int) $_SESSION['id'];
$catID = (int) secure_str($_POST['cat_id'], 'dec');
$task_id = (int) $_POST['task_id'];
$status = filter_var( (string)$_POST['status'], FILTER_VALIDATE_BOOLEAN);

if( !is_project_admin($catID, $userID) AND !is_assigned($task_id) ){
	return false;
}

$table = get_table_name('task');

if ( $status === true) {

	$stmt = $db->prepare("UPDATE `{$table}` SET task_status = 1 WHERE task_id = :task_id");
	$stmt->execute(array(
		":task_id" => $task_id
	));

	exit;
} elseif ( $status === false ){
	$stmt = $db->prepare("UPDATE `{$table}` SET task_status = 0 WHERE task_id = :task_id");
	$stmt->execute(array(
		":task_id" => $task_id
	));

	exit;
} else{
	echo "No Update";
}