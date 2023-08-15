<?php
require_once("db_conn.php");

if ( empty($_POST['task_id']) OR empty($_POST['status']) ) {
	exit;
}

$task_id = (int) $_POST['task_id'];
$status = filter_var( (string)$_POST['status'], FILTER_VALIDATE_BOOLEAN);

$table = get_table_name('task');
$subtable = get_table_name('sub_task');
$filetable = get_table_name('attachment');

if ( $status === true) {
	//Delete Task
	$stmt = $db->prepare("DELETE FROM `{$table}` WHERE task_id = :task_id");
	$stmt->execute(array(
		":task_id" => $task_id
	));

	//Delete File
	$stmt = $db->prepare("DELETE FROM `{$filetable}` WHERE task_id = :task_id");
	$stmt->execute(array(
		":task_id" => $task_id
	));

	//Delete Sub Task
	$stmt = $db->prepare("DELETE FROM `{$subtable}` WHERE task_id = :task_id");
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