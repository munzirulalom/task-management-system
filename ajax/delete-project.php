<?php
require_once("db_conn.php");

if (empty($_POST['project_id']) or empty($_POST['status'])) {
	exit;
}

$project_id = (int) $_POST['project_id'];
$status = filter_var((string)$_POST['status'], FILTER_VALIDATE_BOOLEAN);

if ($status != true) {
	return;
}

$table = get_table_name('category');
$tasktable = get_table_name('task');
$subtasktable = get_table_name('sub_task');
$usertable = get_table_name('category_user');
$filetable = get_table_name('attachment');


//Delete From Task Catagory Table
$stmt = $db->prepare("DELETE FROM `{$table}` WHERE cat_id = :project_id");
$stmt->execute(array(
	":project_id" => $project_id
));

//Delete Sub Task
$stmt = $db->prepare("SELECT task_id FROM `{$tasktable}` WHERE cat_id = :project_id");
$stmt->execute(array(
	":project_id" => $project_id
));
while ($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$substmt = $db->prepare("DELETE FROM `{$subtasktable}` WHERE task_id = :task");
	$substmt->execute(array(
		":task" => $task['task_id']
	));

	$substmt = $db->prepare("DELETE FROM `{$filetable}` WHERE task_id = :task");
	$substmt->execute(array(
		":task" => $task['task_id']
	));
}

//Delete Task
$stmt = $db->prepare("DELETE FROM `{$tasktable}` WHERE cat_id = :project_id");
$stmt->execute(array(
	":project_id" => $project_id
));

//Delete From User Task Catagory Table
$stmt = $db->prepare("DELETE FROM `{$usertable}` WHERE cat_id = :project_id");
$stmt->execute(array(
	":project_id" => $project_id
));

exit;
