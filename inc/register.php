<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( isset($_SESSION['id']) )
{
  header('Location: '.SITE_URL.'/dashbord');
  exit;
}

$error_email = $error_pass = null;

if (isset($_POST['submit'])) 
{
  $name = (string) $_POST['name'];
  $email = (string) $_POST['email'];
  $password = (string) $_POST['password'];
  $password2 = (string) $_POST['password2'];

  //Check Confirm Password
  if ( $password === $password2 ) {
    $pass = md5($password);

    //Check Email
    if (check_duplicate('user','user_email',$email) == false) {
      register_user( $name, $email, $pass );
    } else {
      $error_email = 1;
    }
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
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label required">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name" required>
            </div>
            <div class="mb-3">
              <label class="form-label required">Email address</label>
              <input type="email" class="form-control <?php echo isset($error_email) ? 'is-invalid' : '' ?>" name="email" placeholder="Enter email" required>
              <?php echo isset($error_email) ? '<div class="invalid-feedback">Email address already exists</div>' : '' ?>
            </div>
            <div class="mb-3">
              <label class="form-label required">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password"  autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label class="form-label required">Confirm Password</label>
              <input type="password" class="form-control <?php echo isset($error_pass) ? 'is-invalid' : '' ?>" name="password2" placeholder="Confirm Password"  autocomplete="off" required>
              <?php echo isset($error_pass) ? '<div class="invalid-feedback">Confirm password does not match</div>' : '' ?>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100" name="submit">Create new account</button>
            </div>
          </div>
        </form>
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="?action=login" tabindex="-1">Sign in</a>
      </div>
    