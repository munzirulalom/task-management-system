<?php
require_once("db_conn.php");

$outputToDo = '';
$outputDone = '';

$table = get_table_name('task');
$cat_id = (int) secure_str( (string) $_POST['category_id'], 'dec' );
$user_id = (int) $_SESSION['id'];

$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE cat_id = {$cat_id} ORDER BY task_priority DESC, task_start DESC");
$stmt->execute();

while ($task = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	//Check Task Priority
	if( $task["task_priority"] == '3'){
		$priorityBadge = '<span class="badge bg-red-lt ms-2">High</span>';
	}
	elseif( $task["task_priority"] == '2'){
		$priorityBadge = '<span class="badge bg-yellow-lt ms-2">Medium</span>';
	}
	else{
		$priorityBadge = '<span class="badge bg-azure-lt ms-2">Low</span>';
	}

	//Check assigned user and set badge CSS class
	if( $task["assigned_to"] == $user_id){
		$isAssignedUser = "badge badge-outline text-cyan";
	} else{
		$isAssignedUser = "";
	}
	
	if ( $task["task_status"] == 0) {
		$outputToDo .= '<div class="input-group form-selectgroup-label d-flex align-items-center mb-2 p-3">';
		$outputToDo .= '<span class="me-3"><input class="form-check-input m-0" type="checkbox" id="'.$task["task_id"].'" onclick="checkTask('.$task["task_id"].')"></span>';
		$outputToDo .= '<div class="form-selectgroup-label-content d-flex flex-fill align-items-center" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" onclick="getSubtaskList('.$task["task_id"].')" aria-controls="offcanvasEnd">';
		$outputToDo .= '<span class="avatar me-3">'. substr($task['task_title'],0,3) .'</span>';
		$outputToDo .= '<div>';
		$outputToDo .= '<div class="font-weight-medium">'. $task["task_title"] . $priorityBadge .'</div>';
		$outputToDo .= '<div class="text-muted">';
		$outputToDo .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="10" y1="16" x2="14" y2="16"></line></svg></span> <span class="text-orange">'. date("F j, Y", strtotime( $task['task_due'] )) .'</span></label> ';
		$outputToDo .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg></span> <span>'. date("F j, Y", strtotime( $task['task_remainder'] )) .'</span></label> ';
		$outputToDo .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg></span> <span class="'. $isAssignedUser .'">'. get_user_name( $task["assigned_to"] ) .'</span></label>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
	}
	elseif ( $task["task_status"] == 1) {
		$outputDone .= '<div class="input-group form-selectgroup-label d-flex align-items-center mb-2 p-3 was-validated border-success">';
		$outputDone .= '<span class="me-3"><input class="form-check-input m-0" type="checkbox" id="'.$task["task_id"].'" onclick="checkTask('.$task["task_id"].')" checked></span>';
		$outputDone .= '<div class="form-selectgroup-label-content d-flex flex-fill align-items-center" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" onclick="getSubtaskList('.$task["task_id"].')" aria-controls="offcanvasEnd">';
		$outputDone .= '<span class="avatar me-3">'. substr($task['task_title'],0,3) .'</span>';
		$outputDone .= '<div>';
		$outputDone .= '<div class="font-weight-medium">'. $task["task_title"] . $priorityBadge .'</div>';
		$outputDone .= '<div class="text-muted">';
		$outputDone .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="10" y1="16" x2="14" y2="16"></line></svg></span> <span class="text-orange">'. date("F j, Y, g:i a", strtotime( $task['task_due'] )) .'</span></label> ';
		$outputDone .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg></span> <span>'. date("F j, Y, g:i a", strtotime( $task['task_remainder'] )) .'</span></label> ';
		$outputDone .= '<label class="me-1"><span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg></span> <span class="'. $isAssignedUser .'">'. get_user_name( $task["assigned_to"] ) .'</span></label>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
	}
}

echo '<h6 class="dropdown-header">ToDo</h6>';
if ( $outputToDo != '') {
	echo $outputToDo;
}else{
	echo '<div class="text-muted">Nothing ToDo, Enjoy Today!!</div>';
}
echo '<div class="dropdown-divider"></div>';
echo '<h6 class="dropdown-header">Done</h6>';
echo $outputDone;