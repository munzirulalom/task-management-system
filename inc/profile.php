<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !isset($_SESSION['id']) )
{
  header('Location: '.SITE_URL.'/dashbord');
  exit;
}

if ( !isset($_REQUEST['page']) ) {
	header('Location: '.SITE_URL);
	exit;
}

//Get user imformation
$user = get_user_meta();

$error_email = $error_pass = null;

if (isset($_POST['submit'])) {

  $name = (string) $_POST['name'];
  //$email = (string) $_POST['email'];
  $password = (string) $_POST['password'];
  $password2 = (string) $_POST['password2'];

  if ( isset( $_FILES['profile_img']) AND $_FILES['profile_img']['size'] > 0 ) {
	//Remove previous profile image if any
	if ( !empty($user['img']) AND $user['img'] != 'user.png' ) {
		unlink(dirname(__DIR__,1) ."/upload/" . $user['img'] );
	}

	//update user profile image
	$newFileName = pathinfo( $_FILES['profile_img']['tmp_name'], PATHINFO_FILENAME );
	$profile_img_id = add_attachment( 'profile_img', $newFileName );
	$table = get_table_name('user');

	$stmt = $db->prepare("UPDATE `{$table}` SET img = '{$profile_img_id}' WHERE user_id = '{$user['user_id']}'");
	$stmt->execute();
  }

  //Check Confirm Password
  if ( !empty($password) AND !empty($password2) ) {
  	if ( $password === $password2 ) {
  		$pass = md5($password);
    	update_user( $name, $pass );
  	}else{
  		$error_pass = 1;
  	}
    
  } else {
    update_user( $name );
  }

}

get_header();
$user = get_user_meta();
?>

<div class="container-xl">
	<div class="row row-deck row-cards">
<form class="card card-md" method="POST" enctype="multipart/form-data">
	<div class="card-body">
		<h2 class="card-title text-center mb-4">Edit profile</h2>
		<div class="mb-3">
			<label class="form-label required">Name</label>
			<input type="text" class="form-control" name="name" value="<?php echo $user['user_name'] ?>" placeholder="Enter name" required>
		</div>
		<div class="mb-3">
			<label class="form-label required">Email address</label>
			<input type="email" class="form-control <?php echo isset($error_email) ? 'is-invalid' : '' ?>" name="email" value="<?php echo $user['user_email'] ?>" placeholder="Enter email" disabled>
			<?php echo isset($error_email) ? '<div class="invalid-feedback">Email address already exists</div>' : '' ?>
		</div>
		<div class="mb-3">
			<label class="form-label required">Profile Image</label>
			<input class="form-control" type="file" name="profile_img">
		</div>
		<div class="mb-3">
			<label class="form-label">Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password"  autocomplete="off">
		</div>
		<div class="mb-3">
			<label class="form-label">Confirm Password</label>
			<input type="password" class="form-control <?php echo isset($error_pass) ? 'is-invalid' : '' ?>" name="password2" placeholder="Confirm Password"  autocomplete="off">
			<?php echo isset($error_pass) ? '<div class="invalid-feedback">Confirm password does not match</div>' : '' ?>
		</div>
		<div class="form-footer">
			<button type="submit" class="btn btn-primary w-100" name="submit">Update profile</button>
		</div>
	</div>
</form>
</div>
</div>

<?php
get_footer();