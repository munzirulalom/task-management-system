<?php
require_once("db_conn.php");

$table = get_table_name('attachment');

$task_id = (int) $_POST['task_id_file'];
$cat_id = (int) $_POST['redir_to'];
$user_id = (int) $_SESSION['id'];

$filename = $_FILES['file']['name'].'-'. secure_str( date("Y-m-d-H:i:s") );

$stmt = $db->prepare("INSERT INTO `{$table}` (attachment_name, task_id, user_id) VALUES('{$filename}', '{$task_id}', '{$user_id}')");
$stmt->execute();
$id = $db->lastInsertId();

$filename = add_attachment('file', $id);

$stmt = $db->prepare("UPDATE `{$table}` SET attachment_name = '{$filename}' WHERE attachment_id = '{$id}'");
$stmt->execute();

header("Location: ".SITE_URL."/task/".$cat_id);
exit();