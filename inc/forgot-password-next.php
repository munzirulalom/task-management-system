<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

$error = null;

if ( isset($_SESSION['id']) )
{
  header('Location: '.SITE_URL.'/dashbord');
  exit;
}

?>


      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo SITE_URL ?>/static/logo.png" height="50" alt="Logo"></a>
      </div>

      <div class="card card-md">
        <div class="card-body text-center">
          <h2 class="card-title text-center mb-4">Forgot password</h2>
          <p class="text-muted mb-4">Please check your email address. We send a password recovery link to your email address. The link will be work for <strong>24 hours</strong>.</p>
          <a href="?action=login" class="btn btn-primary">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="5" y1="12" x2="19" y2="12"></line><line x1="5" y1="12" x2="11" y2="18"></line><line x1="5" y1="12" x2="11" y2="6"></line></svg>
              Take me home
            </a>
        </div>
      </div>
      <div class="text-center text-muted mt-3">
        Forget it, <a href="?action=login">send me back</a> to the sign in screen.
      </div>
    