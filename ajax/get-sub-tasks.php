<?php
require_once("db_conn.php");

$outputToDo = '';
$outputDone = '';

$table = get_table_name('sub_task');
$task_id = (int) $_POST['task_id'];
$cat_id = (int) secure_str( (string) $_POST['category_id'], 'dec' );
$user_id = (int) $_SESSION['id'];

if ( $task_id == null ) {
	return;
}

$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE task_id = :task_id");
$stmt->execute(array(
	":task_id" => $task_id
));

while ($task = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	if ( $task["sub_task_status"] == 0) {
		$outputToDo .= '<label class="form-selectgroup-item flex-fill">';
		$outputToDo .= '<input type="checkbox" class="form-selectgroup-input" id="subtask'.$task["sub_task_id"].'" onclick="checkSubTask('.$task["sub_task_id"].','.$task["task_id"].')">';
		$outputToDo .= '<div class="form-selectgroup-label d-flex align-items-center p-3">';
		$outputToDo .= '<div class="me-3"><span class="form-selectgroup-check"></span></div>';
		$outputToDo .= '<div class="form-selectgroup-label-content d-flex align-items-center">';
		$outputToDo .= '<div>';
		$outputToDo .= '<div class="font-weight-medium">'. $task['sub_task_title'] .'</div>';
		$outputToDo .= '<div class="text-muted">';
		$outputToDo .= '<span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="4" y="5" width="16" height="16" rx="2"></rect> <line x1="16" y1="3" x2="16" y2="7"></line> <line x1="8" y1="3" x2="8" y2="7"></line> <line x1="4" y1="11" x2="20" y2="11"></line> <line x1="10" y1="16" x2="14" y2="16"></line> </svg></span> ';
		$outputToDo .= '<span>'. date("F j, Y, g:i a", strtotime( $task['created_on'] )) .'</span>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
		$outputToDo .= '</div>';
		$outputToDo .= '</label>';
	}
	elseif ( $task["sub_task_status"] == 1) {
		$outputDone .= '<label class="form-selectgroup-item flex-fill was-validated border-success">';
		$outputDone .= '<input type="checkbox" class="form-selectgroup-input" id="subtask'.$task["sub_task_id"].'" onclick="checkSubTask('.$task["sub_task_id"].','.$task["task_id"].')" checked>';
		$outputDone .= '<div class="form-selectgroup-label d-flex align-items-center p-3">';
		$outputDone .= '<div class="me-3"><span class="form-selectgroup-check"></span></div>';
		$outputDone .= '<div class="form-selectgroup-label-content d-flex align-items-center">';
		$outputDone .= '<div>';
		$outputDone .= '<div class="font-weight-medium">'. $task['sub_task_title'] .'</div>';
		$outputDone .= '<div class="text-muted">';
		$outputDone .= '<span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="4" y="5" width="16" height="16" rx="2"></rect> <line x1="16" y1="3" x2="16" y2="7"></line> <line x1="8" y1="3" x2="8" y2="7"></line> <line x1="4" y1="11" x2="20" y2="11"></line> <line x1="10" y1="16" x2="14" y2="16"></line> </svg></span> ';
		$outputDone .= '<span>'. date("F j, Y, g:i a", strtotime( $task['created_on'] )) .'</span>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
		$outputDone .= '</div>';
		$outputDone .= '</label>';
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

echo '<div class="my-5 dropdown-divider"></div>';

//Attachment Listing
$table = get_table_name('attachment');
$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE task_id = :task_id");
$stmt->execute(array(
	":task_id" => $task_id
));

echo '<h5 class="card-title">Attachment</h5>';
echo '<ul>';
while ($file = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	echo'<li><a href="'. SITE_URL .'/upload/'. $file['attachment_name'] .'" target="_blank">'. $file['attachment_name'] .'</a></li>';
}
echo '</ul>';

//Attachment form
echo '<form id="add-file" action="'. SITE_URL . '/ajax/add-file.php" method="post" enctype="multipart/form-data">';
echo '<div class="input-group mb-2">';
echo '<input type="hidden" name="task_id_file" value="'. $task_id .'">';
echo '<input type="hidden" id="redir_to" name="redir_to" value="'. $cat_id.'">';
echo '<input type="file" name="file" class="form-control">';
echo '<button class="btn btn-primary" type="submit" name="file_submit">Upload</button>';
echo '</div>';
echo '</form>';

echo '<div class="my-5 dropdown-divider"></div>';

if ( !is_project_admin($cat_id) ) {
	//Does not display task edit form if the user are not admin
	return;
}

//Edit task informations
$task = get_task_info( $task_id );

if ( $task == null ) {
	//Does not display tast edit form if the $task have no value
	return;
}
echo '<form id="update-task" method="POST"><div class="modal-content modal-body"><h5 class="card-title">Task Informations</h5>';
echo '<input type="hidden" name="update_task_id" value="'. $task['task_id'] .'" required>';
echo '<input type="hidden" name="action" value="update" required>';
echo '<div class="mb-3"><label class="form-label">Name</label><input type="text" class="form-control" name="update_task_name" value="'. $task['task_title'] .'" placeholder="Task name" required autocomplete="off"></div>';
echo '<div class="row">';
echo '<div class="col-lg-8"><div class="mb-3"><label class="form-label">Assigned to</label><input class="form-control" list="users" name="update_assigned_to" value="'. get_user_email( $task['assigned_to'] ) .'" placeholder="Type to search..." required autocomplete="off">'. get_cat_user_list( $cat_id ) .'</div></div>';
echo '<div class="col-lg-4"> <div class="mb-3"> <label class="form-label">Priority</label> <select class="form-select" name="update_task_priority" required> <option value="1" selected>Low</option> <option value="2">Medium</option> <option value="3">High</option> </select> </div> </div>';
echo '</div>';
echo '<div class="row">';
echo '<div class="col-lg-6"> <div class="mb-3"> <label class="form-label">Remainder date</label> <input type="date" class="form-control" name="update_remainder_date" value="'. date("Y-m-d", strtotime($task['task_remainder'])) .'"> </div> </div>';
echo '<div class="col-lg-6"> <div class="mb-3"> <label class="form-label">Due date</label> <input type="date" class="form-control" name="update_due_date" value="'. date("Y-m-d", strtotime($task['task_due'])) .'"> </div> </div>';
echo '<div class="col-lg-12"> <div> <label class="form-label">Additional information</label> <textarea class="form-control" rows="3" name="update_note">'. $task['task_note'] .'</textarea> </div> </div>';
echo '</div>';
echo '<button type="submit" class="btn btn-primary m-auto mt-3">Save</button>';
echo '</div></form>';

if ( is_project_admin($cat_id) ) {
	echo '<button class="btn btn-danger w-100 my-3" onclick="deleteTask('. $task_id .')">Delete Task</button>';
}

?>

