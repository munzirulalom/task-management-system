<?php
require_once("db_conn.php");

$output = '';

$table = get_table_name('notification');
$user_id = (int)$_SESSION['id'];

$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_id = :user_id ORDER BY created_on DESC LIMIT 5");
$stmt->execute(array(
    ":user_id" => $user_id
));

while ( $notification = $stmt->fetch(PDO::FETCH_ASSOC) ) {
$output .= '<div class="list-group-item">';
$output .= '<div class="row align-items-center">';
$output .= '<div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>';
$output .= '<div class="col text-truncate">';
$output .= '<a href="'. SITE_URL.'/task/'. $notification['cat_id'] .'" class="text-body d-block me-5">'. $notification['title'] .'</a>';
$output .= '<div class="d-block text-muted text-truncate mt-n1">'. date("F j, Y, g:i a", strtotime( $notification['created_on'] )) .'</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
}

echo $output;

exit();