<?php
require_once("db_conn.php");

$output = '';

$table = get_table_name('category_user');
$cat_id = (int) secure_str( (string) $_POST['category_id'], 'dec' );

$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE cat_id = :cat_id");
$stmt->execute(array(
	":cat_id" => $cat_id
));

while ($user = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	if ( is_project_admin($cat_id, $user["user_id"]) ) {
		$badge = '<span class="badge badge-sm bg-green text-uppercase ms-2">Admin</span>';
	} else{
		$badge = null;
	}
	$output .= '<label class="form-selectgroup-item flex-fill">';
	$output .= '<input type="checkbox" class="form-selectgroup-input" id="'.$user["user_id"].'" onclick="deassignedUser('.$user["user_id"].')" checked>';
	$output .= '<div class="form-selectgroup-label d-flex align-items-center p-3">';
	$output .= '<div class="me-3"><span class="form-selectgroup-check"></span></div>';
	$output .= '<div class="form-selectgroup-label-content d-flex align-items-center"><span class="avatar me-3" style="background-image: url(\''. get_user_image( $user['user_id'] ) .'\'"></span></div>';
	$output .= '<div><div class="font-weight-medium">'. get_user_name($user['user_id']) . $badge .'</div><div class="text-muted">'. get_user_email($user['user_id']) .'</div></div>';
	$output .= '</div>';
	$output .= '</label>';
}

echo $output;

exit();