<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

//Check URL
if ( !isset($_GET['action']) OR !isset($_GET['uid']) OR !isset($_GET['code']) OR !isset($_GET['token']) ) {
  echo 'Invalid URL';
  return;
}

//Destro all session
session_destroy();

$user_id = (string) $_GET['uid'];

//Check Auth token
$token = (string) $_GET['token'];
$token = secure_str( $token, "dec");
$now_time = date("Y-m-d H:i:s");

if ( strtotime($now_time) > strtotime($token) ) {
  echo 'Invalid token';
  return;
}

//Check auth code
$code = (string) $_GET['code'];

if ( !check_auth_code( $user_id, $code ) ) {
  echo 'Invalid Code';
  return;
}

$error_pass = null;

if (isset($_POST['submit'])) 
{
  $id = (string) $_POST['id'];
  $password = (string) $_POST['password'];
  $password2 = (string) $_POST['password2'];

  //Check Confirm Password
  if ( $password === $password2 ) {
    $pass = md5($password);

    update_password($user_id, $pass);
  } else {
    $error_pass = 1;
  }

}

?>


      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo SITE_URL ?>/static/logo.png" height="50" alt="Logo"></a>
      </div>
      <form class="card card-md" role="form" action="" method="POST">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Change password</h2>
            <div class="text-center mb-4">
              <span class="avatar avatar-xl mb-3" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <h3><?php echo get_user_name( secure_str( $user_id, "dec" ) ); ?></h3>
              <input type="hidden" class="form-control" name="id" value="<?php echo $user_id ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label class="form-label required">New Password</label>
              <input type="password" class="form-control" name="password" placeholder="New Password"  autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label class="form-label required">Re-Confirm New Password</label>
              <input type="password" class="form-control <?php echo isset($error_pass) ? 'is-invalid' : '' ?>" name="password2" placeholder="Confirm New Password"  autocomplete="off" required>
              <?php echo isset($error_pass) ? '<div class="invalid-feedback">Confirm password does not match</div>' : '' ?>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100" name="submit">Change password</button>
            </div>
          </div>
        </form>
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="?action=login" tabindex="-1">Sign in</a>
      </div>