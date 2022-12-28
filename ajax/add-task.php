<?php

$errors = [];
$data = [];

if ( !empty( $_POST['action'] ) AND $_POST['action'] === "add" ) {

    if ( empty($_POST['task_name']) or empty($_POST['cat_id']) ) {
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

    $table = get_table_name('task');

    $task_title = (string) $_POST['task_name'];
    $task_remainder = (string) $_POST['remainder_date'];
    $task_due = (string) $_POST['due_date'];
    $task_note = (string) $_POST['note'];
    $task_priority = (int) $_POST['task_priority'];
    $assigned_to = (int) get_user_id ( (string) $_POST['assigned_to'] );
    $cat_id = (int) secure_str( (string) $_POST['cat_id'], 'dec' );
    $created_by = (int) $_SESSION['id'];
    $notification_title = "You have been given a new task on ".get_project_title($cat_id);

    //Inster Data Into Task List Table
    $stmt = $db->prepare("INSERT INTO `{$table}` (task_title, task_remainder, task_due, task_note, task_priority, assigned_to, cat_id, created_by) VALUES('{$task_title}', '{$task_remainder}', '{$task_due}', '{$task_note}', '{$task_priority}', '{$assigned_to}', '{$cat_id}', '{$created_by}')");
    $stmt->execute();

    add_notification( $notification_title, $assigned_to, $cat_id);

    exit;
}elseif ( !empty( $_POST['action'] ) AND $_POST['action'] === "update" ) {

    if ( empty($_POST['update_task_name']) ) {
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

    $table = get_table_name('task');

    $task_id = (int) $_POST['update_task_id'];
    $task_title = (string) $_POST['update_task_name'];
    $task_remainder = (string) $_POST['update_remainder_date'];
    $task_due = (string) $_POST['update_due_date'];
    $task_note = (string) $_POST['update_note'];
    $task_priority = (int) $_POST['update_task_priority'];
    $assigned_to = (int) get_user_id ( (string) $_POST['update_assigned_to'] );

    $redirect_to = secure_str( (string) $_POST['rdir_to'], 'dec' );

    //Inster Data Into Task List Table
    $stmt = $db->prepare("UPDATE `{$table}` SET task_title = '{$task_title}', task_remainder = '{$task_remainder}', task_due = '{$task_due}', task_note = '{$task_note}', task_priority = '{$task_priority}', assigned_to = '{$assigned_to}' WHERE task_id = '{$task_id}'");
    $stmt->execute();

    exit;
}

exit;