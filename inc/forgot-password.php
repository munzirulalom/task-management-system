<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

$error = null;

if ( isset($_SESSION['id']) )
{
  header('Location: '.SITE_URL.'/dashbord');
  exit;
}

elseif (isset($_POST['forgot-password']))
{
  $email = (string) $_POST['email'];

  if ( is_user( $email ) ) {
    send_password_recovery( $email );

    //Redirect User
    header('Location: '.SITE_URL.'?action=forgot-password-next');
    exit;

  }else{
    $error = 1;
  }

}

?>


      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo SITE_URL ?>/static/logo.png" height="50" alt="Logo"></a>
      </div>

      <?php 
      // Login ERROR
      if ( isset( $error ) ) {
        echo '<div class="alert alert-danger" role="alert">Invalid Email address</div>';
      }

      ?>

      <form class="card card-md" action="#" method="POST">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Forgot password</h2>
          <p class="text-muted mb-4">Enter your email address and your password recovery link will be send to your email.</p>
          <div class="mb-3">
            <label class="form-label required">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100" name="forgot-password">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
              Send me recovery link
            </button>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        Forget it, <a href="?action=login">send me back</a> to the sign in screen.
      </div>
    