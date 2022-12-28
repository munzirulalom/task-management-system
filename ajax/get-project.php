<?php
require_once("db_conn.php");

$outputPersonal = '';
$outputProject = '';

$categories = get_table_name('category');
$user_task = get_table_name('category_user');
$user_id = (int) $_SESSION['id'];

$stmt = $db->prepare("SELECT ct.* FROM `{$user_task}` AS ut LEFT JOIN `{$categories}` AS ct ON ut.cat_id= ct.cat_id WHERE ut.user_id = {$user_id}");
$stmt->execute();

while ($project = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	if ( $project['cat_type'] == 1) {
		$outputPersonal .= '<a href="'.SITE_URL.'/task/'. $project['cat_id'] .'" class="dropdown-item">
		<span class="nav-link-icon d-md-none d-lg-inline-block">
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" />
		</svg>
		</span>'. $project['cat_title'] .'</a>';
	}
	elseif ( $project['cat_type'] == 2) {
		$outputProject .= '<a href="'.SITE_URL.'/task/'. $project['cat_id'] .'" class="dropdown-item"><span class="avatar avatar-xs rounded me-2">'. substr($project['cat_title'],0,3) .'</span>'. $project['cat_title'] .'</a>';
	}
}

echo '<h6 class="dropdown-header">Personal</h6>';
echo $outputPersonal;
echo '<div class="dropdown-divider"></div>';
echo '<h6 class="dropdown-header">Project</h6>';
echo $outputProject;