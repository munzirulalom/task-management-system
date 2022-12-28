<?php
if ( empty($_POST['search']) ) {
	return;
}

$search_term = (string) $_POST['search'];
$output = '';

//Database and function connection
require_once("db_conn.php");

$table = get_table_name('user');

$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_name LIKE '%{$search_term}%' OR user_email LIKE '{$search_term}%'");
$stmt->execute();

while ($user = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	$output .= '<label class="form-selectgroup-item flex-fill">';
	$output .= '<input type="checkbox" class="form-selectgroup-input" id="'.$user["user_id"].'" onclick="assignedUser('.$user["user_id"].')">';
	$output .= '<div class="form-selectgroup-label d-flex align-items-center p-3">';
	$output .= '<div class="me-3"><span class="form-selectgroup-check"></span></div>';
	$output .= '<div class="form-selectgroup-label-content d-flex align-items-center"><span class="avatar me-3" style="background-image: url(./static/avatars/000m.jpg)"></span></div>';
	$output .= '<div><div class="font-weight-medium">'. $user['user_name'] .'</div><div class="text-muted">'. $user['user_email'] .'</div></div>';
	$output .= '</div>';
	$output .= '</label>';
}

echo $output;

exit();