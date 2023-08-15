<?php
require_once("db_conn.php");

if ( empty($_POST['subtask_id']) OR empty($_POST['status']) ) {
	exit;
}

$subtask_id = (int) $_POST['subtask_id'];
$status = filter_var( (string)$_POST['status'], FILTER_VALIDATE_BOOLEAN);

$table = get_table_name('sub_task');

if ( $status === true) {

	$stmt = $db->prepare("UPDATE `{$table}` SET sub_task_status = 1 WHERE sub_task_id = :subtask_id");
	$stmt->execute(array(
		":subtask_id" => $subtask_id
	));

	exit;
} elseif ( $status === false ){
	$stmt = $db->prepare("UPDATE `{$table}` SET sub_task_status = 0 WHERE sub_task_id = :subtask_id");
	$stmt->execute(array(
		":subtask_id" => $subtask_id
	));

	exit;
} else{
	echo "No Update";
}