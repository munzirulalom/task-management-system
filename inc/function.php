<?php
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

//Databse Connection
$db = $GLOBALS['conn'];

function get_header( $name = null ) {

	$name      = (string) $name;
	$templates = "header.php";

	if ( '' !== $name ) {
		$templates = "header-{$name}.php";
	}

	require($templates);
}

function get_footer( $name = null ) {

	$name      = (string) $name;
	$templates = "footer.php";

	if ( '' !== $name ) {
		$templates = "footer-{$name}.php";
	}

	require($templates);
}

//Get Database Table Name
function get_table_name( $arg ) {
	switch ($arg) {
		case 'user':
			$table = 'user';
			break;
		case 'category':
			$table = 'task_categories';
			break;
		case 'category_user':
			$table = 'user_task';
			break;
		case 'task':
			$table = 'task_list';
			break;
		case 'sub_task':
			$table = 'sub_task_list';
			break;
		case 'file':
			$table = 'attachment';
			break;
		case 'auth':
			$table = 'authentication';
			break;
		case 'notification':
			$table = 'notification';
			break;
		case 'attachment':
			$table = 'attachment';
			break;
		
		default:
			$table = null;
			break;
	}

	return $table;
}

//Get Page title
function get_page_title(){

	$title[] = '';
	switch ( $_GET['page'] ) {

		case 'dashbord' :
		$title['main'] = "Dashboard";
		$title['sub'] = '';
		break;

		case 'task' :
		$title['main'] = get_project_title();
		$title['sub'] = 'Task List';
		break;

		case 'assigned' :
		$title['main'] = "Assigned Task";
		$title['sub'] = 'Task assigned to you';
		break;

		case 'chat' :
		$title['main'] = "Chat";
		$title['sub'] = 'Communicate with other user';
		break;

		case 'profile' :
		$title['main'] = get_user_name( (int) $_SESSION['id'] );
		$title['sub'] = 'Profile';
		break;

		default:
		$title['main'] = '';
		$title['sub'] = '';
		break;
	}
	return $title;
}

//Check Duplicate Valus
function check_duplicate($table,$field,$value) { //$tab: table name; $fild: table field
	global $db;
	$table = get_table_name( $table );

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE {$field} = '{$value}'");
	$stmt->execute();
	$result = $stmt->rowCount();

	if ( $result > 0) {
		return true;
	}else{
		return false;
	}
}

function secure_str( $string, $action = 'def', $valid = 60 ) {
    // you may change these values to your own
	$secret_key = 'Kjs_&a$ua#ljn:Ys#%';
	$secret_iv = '?9aGHs#i_Sh$/aFs';

	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash( 'sha256', $secret_key );
	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	if( $action == 'enc' ) {
    	$date1=strtotime($string) + $valid;//15*60=900 seconds
    	$string1=date("Y-m-d H:i:s",$date1);
    	$output = base64_encode( openssl_encrypt( $string1, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'dec' ){
    	$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    else if( $action == 'def'){ //by default set normal
    	$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );

    }

    return $output;
}

//Send email
function send_mail($to, $subject, $message){
	//mail($to, $subject, $message);

	$url = 'https://www.inovoex.com/api/mail.php';
	$data = array('to' => $to, 'subject' => $subject, 'message' => $message, 'key' => 'tS{36l|&PV(4rLoN( V!/WhTRZ/nL^!DV{9~kIT%5dM63K9;{mHbflV9>.<!!fYo');

	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
		),
		'ssl' =>array(
			'verify_peer'	=> false,
			'verify_peer_name' =>false,
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ echo "ERROR"; }

}
//Get single field value from DB
function get_single_value( $table, $columns, $value ) {
	global $db;
	$table = get_table_name( $table );
	$field = (string) $columns;
	$value = (string) $value;

	$stmt = $db->prepare("SELECT `{$field}` FROM `{$table}` WHERE `{$field}` = '{$value}'");
	$stmt->execute();

	return $stmt->fetchColumn();
}

/************************************************************* USER ******************************************************************/

//Reegister New User
function register_user( $name, $email, $pass, $org_code ) {
	global $db;
	$table = get_table_name('user');

	$stmt = $db->prepare("INSERT INTO `{$table}` (user_name, user_email, user_password, org_code) VALUES('{$name}', '{$email}', '{$pass}', '{$org_code}')");
	$stmt->execute();

	header('Location: '.SITE_URL);
	exit;
}
//Update User
function update_user( $name, $pass = false ) {
	global $db;
	$id = $_SESSION['id'];
	$table = get_table_name('user');

	if ($pass == false) {
		$stmt = $db->prepare("UPDATE `{$table}` SET user_name = '{$name}' WHERE user_id = '{$id}'");
		$stmt->execute();
	} else {
		$stmt = $db->prepare("UPDATE `{$table}` SET user_name = '{$name}', user_password = '{$pass}' WHERE user_id = '{$id}'");
		$stmt->execute();
	}
	return;
}

//Update User Password
function update_password( $id, $pass ){
	global $db;
	$table = get_table_name('user');

	if($id == false)
	{
		$id = $_SESSION['id'];
	}else{
		$id = secure_str( $id, "dec");
		$id = (int) $id;
	}

	//Update User Password
	$stmt = $db->prepare("UPDATE `{$table}` SET user_password = '$pass' WHERE user_id = '{$id}'");
	$stmt->execute();

	//Delete Previous Auth Code
	$table = get_table_name('auth');
	$stmt = $db->prepare("DELETE FROM `{$table}` WHERE user_id = '{$id}'");
	$stmt->execute();

	header('Location: '.SITE_URL);
  	exit;
}

//Delete Information
function delete_user_info($id) {
	global $db;
	$stmt = $db->prepare("DELETE FROM user WHERE id = '{$id}'");
	$stmt->execute();

	echo("<script>location.href = '".SITE_URL."';</script>");
	die();
}

//Generate Auth code
function generate_auth_code( $id ){
	global $db;
	$table = get_table_name('auth');
	$code = md5( mt_rand(100000,999999) );

	//Delete Previous Auth Code
	$stmt = $db->prepare("DELETE FROM `{$table}` WHERE user_id = '{$id}'");
	$stmt->execute();

	$stmt = $db->prepare("INSERT INTO `{$table}` (user_id, code) VALUES('{$id}', '{$code}')");
	$stmt->execute();

	return $code;	
}

//Get single field value from DB
function check_auth_code( $id, $code ) {
	global $db;
	$table = get_table_name( 'auth' );
	$id = (string) $id;
	$id = secure_str( $id, "dec");
	$code = (string) $code;

	$stmt = $db->prepare("SELECT code FROM `{$table}` WHERE user_id = '{$id}'");
	$stmt->execute();
	$result = $stmt->fetchColumn();

	if ( $result === $code ) {
		return true;
	}

	return false;
}

//Send Password Reset Link
function send_password_recovery( $email ){
	$id = get_user_id( $email );
	$code = generate_auth_code( $id );
	$token = secure_str( date("Y-m-d H:i:s"), 'enc', 30);

	$link = SITE_URL."?action=new-password";
	$link .= "&uid=".secure_str($id);
	$link .= "&code=".$code;
	$link .= "&token=".$token;


	$to = (string) $email;
	$subject = "Task Management: Password Recovery";
	$message = "
	Hi ".get_user_name( $id ).",\n
	There was a request to change your password!\n
	If you did not make this request then please ignore this email.
	Otherwise, please click this link to change your password:\n";

	$message .= $link;

	send_mail($to, $subject, $message);

	echo $message;
}

//Check Login
function check_login( $email, $pass ) {
	global $db;
	$table = get_table_name('user');

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_email=:email AND user_password=:password");
	$stmt->execute(['email'	=> $email, 'password' => $pass]);
	$result = $stmt->rowCount();

	if ( $result == 1 ) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
		{
			$_SESSION['id'] = (int)$row['user_id'];

			//Change user active status
			$query = $db->prepare("UPDATE `{$table}` SET status = 'Active now' WHERE user_id = '{$row['user_id']}'");
			$query->execute();
		}
		header('Location: '.SITE_URL);
		exit;
	}
	return false;
}

//Check User
function is_user( $value ) {
	global $db;
	$table = get_table_name( 'user' );

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_email = '{$value}'");
	$stmt->execute();
	$result = $stmt->rowCount();

	if ( $result > 0) {
		return true;
	}else{
		return false;
	}
}

//Check current user role
function is_admin() {
	$id = $_SESSION['id'];

	if ($id == 1) {
		return true;
	}

	return false;
}

//Get Current User Name
function get_user_id( $email ) {
	global $db;
	$table = get_table_name('user');

	$stmt = $db->prepare("SELECT user_id FROM `{$table}` WHERE user_email = '{$email}'");
	$stmt->execute();

	return $stmt->fetchColumn();
}
//Get Current User Name
function get_user_name( $id = false ) {
	global $db;
	$table = get_table_name('user');

	if($id == false)
	{
		$id = (int) $_SESSION['id'];
	}else{
		$id = (int) $id;
	}

	$stmt = $db->prepare("SELECT user_name FROM `{$table}` WHERE user_id = $id");
	$stmt->execute();

	return $stmt->fetchColumn();
}
//Get Current User Name
function get_user_email( $id = false ) {
	global $db;
	$table = get_table_name('user');

	if($id == false)
	{
		$id = (int) $_SESSION['id'];
	}else{
		$id = (int) $id;
	}

	$stmt = $db->prepare("SELECT user_email FROM `{$table}` WHERE user_id = $id");
	$stmt->execute();

	return $stmt->fetchColumn();
}

//Get Current User Image
function get_user_image( $userID ){
	if (!isset($userID)) return;

	global $db;
	$table = get_table_name('user');

	$stmt = $db->prepare("SELECT img FROM `user` WHERE user_id = '{$userID}'");
	$stmt->execute();
	$file_name = $stmt->fetchColumn();
	$result = SITE_URL ."/upload/" . $file_name;

	return $result;
}

//Get user meta
function get_user_meta($id = false) {
	if($id == false)
	{
		$id = (int) $_SESSION['id'];
	}else{
		$id = (int) $id;
	}
	
	global $db;
	$table = get_table_name('user');

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_id = '{$id}'");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$result = array_shift($result);

	return $result;
}

//Get all user meta list
function get_user_list() {	
	global $db;
	$stmt = $db->prepare("SELECT * FROM user");
	$stmt->execute();	
	return $stmt;
}

//Get all user meta list
function get_cat_user_list( $arg=null ) {	
	global $db;

	if($arg == null)
	{
		$cat_id = (int) $_REQUEST['category'];
	}else{
		$cat_id = (int) $arg;
	}

	$user = get_table_name('user');
	$user_task = get_table_name('category_user');
	$user_id = (int) $_SESSION['id'];

	$outputHtml = '<datalist id="users">';

	$stmt = $db->prepare("SELECT user.user_email, user.user_name FROM `{$user_task}` AS ut LEFT JOIN `{$user}` AS user ON ut.user_id=user.user_id WHERE ut.cat_id={$cat_id}");
	$stmt->execute();

	while ($user = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$outputHtml .='<option value="'. $user['user_email'] .'">'. $user['user_name'] .'</option>';
	}

	$outputHtml .='</datalist>';
	return $outputHtml;
}

//Check current user can access the task group or catagory
function can_access() {	
	global $db;
	$cat_id = (int) $_REQUEST['category'];
	$table = get_table_name('category_user');
	$user_id = (int) $_SESSION['id'];

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE user_id = '{$user_id}' AND cat_id= '{$cat_id}'");
	$stmt->execute();
	$result = $stmt->rowCount();

	if ( $result > 0) {
		return true;
	}

	return false;
}

//Count total user
function get_total_user_count() {	
	global $db;
	$stmt = $db->prepare("SELECT id FROM user");
	$stmt->execute();
	$count = $stmt->rowCount();

	echo sprintf($count);
}

//Check Project or Catagory Admin
function is_project_admin( $arg = null, $id = null){
	global $db;
	$table = get_table_name('category');

	if ( isset($id) ) {
		$user_id = (int) $id;
	} else{
		$user_id = (int) $_SESSION['id'];
	}
	
	if (isset($_REQUEST['category'])) {
		$cat_id = (int) $_REQUEST['category'];
	}else{
		$cat_id = (int) $arg;
	}

	$stmt = $db->prepare("SELECT created_by FROM `{$table}` WHERE cat_id = '{$cat_id}'");
	$stmt->execute();
	$result = (int)$stmt->fetchColumn();

	if ( $result == $user_id ) {
		return true;
	}

	return false;
}

//Check Task Assigned User
function is_assigned( $taskID, $userID=null ){
	global $db;

	$taskID = (int) $taskID;

	if ( isset($userID) ) {
		$userID = (int) $user_id;
	} else {
		$userID = (int) $_SESSION['id'];
	}

	$table = get_table_name('task');

	$stmt = $db->prepare("SELECT COUNT(task_id) FROM `{$table}` WHERE task_id = :taskID AND assigned_to = :assignedID");
	$stmt->execute([
		'taskID'		=> $taskID,
		'assignedID'	=> $userID
	]);
	$result = (int)$stmt->fetchColumn();

	if ( $result === 1 ) {
		return true;
	}

	return false;
}

function get_project_title( $arg=null ){
	global $db;
	$table = get_table_name('category');

	if($arg == null)
	{
		$arg = (int) $_REQUEST['category'];
	}else{
		$arg = (int) $arg;
	}

	$stmt = $db->prepare("SELECT cat_title FROM `{$table}` WHERE cat_id = '{$arg}'");
	$stmt->execute();

	return $stmt->fetchColumn();
}

//Check Project Type
function check_project_type( $arg =null ){

	if ( !is_project_admin() ) {
		return false;
	}

	global $db;
	$table = get_table_name('category');

	if($arg == null)
	{
		$id = (int) $_REQUEST['category'];
	}else{
		$id = (int) $arg;
	}

	$stmt = $db->prepare("SELECT cat_type FROM `{$table}` WHERE cat_id = '{$id}'");
	$stmt->execute();
	$result = (int)$stmt->fetchColumn();

	if ( $result === 2 ) {
		return true;
	}

	return false;
}

//Get single task informations
function get_task_info( $arg ){
	global $db;
	$table = get_table_name('task');
	$task_id = (int) $arg;

	$stmt = $db->prepare("SELECT * FROM `{$table}` WHERE task_id = $task_id");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$result = array_shift($result);

	return $result;
}

//Add new notification
function add_notification($title, $user_id, $cat_id){
	global $db;
	$table = get_table_name('notification');

	$stmt = $db->prepare("INSERT INTO `{$table}` (title, user_id, cat_id) VALUES('{$title}', '{$user_id}', '{$cat_id}')");
	$stmt->execute();

	return;
}

function add_attachment($inputname,$filename){
	if ($_FILES[$inputname]["error"] > 0){
		echo "Return Code: CV was not uploaded.try again. File size may be greater than 2 MB. Please upload less than 2MB<br />";
	} else{
		$msg = "ERROR: ";
		$itemimageload="true";

		if($itemimageload=="true")
		{
			/*$fileNameCmps = explode(".", $_FILES[$inputname]['name']);
			$fileExtension = strtolower(end($fileNameCmps));
			$fileName = strtolower(start($fileNameCmps));*/

			$info = pathinfo( $_FILES[$inputname]['name'] );
			$file_name =  $filename. '-' .$info['filename'].'.'.$info['extension'];

			$newname = dirname(__DIR__,1) ."/upload/" . $file_name;
			if( move_uploaded_file($_FILES[$inputname]["tmp_name"],$newname)){
				return $file_name;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	return;
}