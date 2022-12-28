<?php

$errors = [];
$data = [];

if (empty($_POST['project_name']) or empty($_POST['project_type'])) {
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

$table = get_table_name('category');
$name = (string) $_POST['project_name'];
$type = (int) $_POST['project_type'];
$created_by = (int) $_SESSION['id'];

//Inster Data Into Task Catagory Table
$stmt = $db->prepare("INSERT INTO `{$table}` (cat_title, cat_type, created_by) VALUES('{$name}', '{$type}', '{$created_by}')");
$stmt->execute();
$category_id = $db->lastInsertId();

//Insert Data To User and Catagory Relations Table
$table = get_table_name('category_user');
$stmt = $db->prepare("INSERT INTO `{$table}` (user_id, cat_id) VALUES('{$created_by}', '{$category_id}')");
$stmt->execute();

exit;