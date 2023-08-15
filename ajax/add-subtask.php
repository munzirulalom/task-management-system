<?php

$errors = [];
$data = [];

if ( empty($_POST['subtask_title']) or empty($_POST['task_id']) ) {
    $errors['log'] = 'Form not submit.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;

    echo json_encode($data);
    die();
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
    echo json_encode($data);
}

require_once("db_conn.php");

$table = get_table_name('sub_task');

$task_id = (string) $_POST['task_id'];
$sub_task_title = (string) $_POST['subtask_title'];
$created_by = (int) $_SESSION['id'];

//Inster Data Into Sub Task List Table
$stmt = $db->prepare("INSERT INTO `{$table}` (sub_task_title, task_id, created_by) VALUES(:sub_task_title, :task_id, :created_by)");
$stmt->execute(array(
    ":sub_task_title" => $sub_task_title,
    ":task_id" => $task_id,
    ":created_by" => $created_by
));

exit;