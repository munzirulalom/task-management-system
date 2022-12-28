<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="navbar-nav flex-row d-lg-none">
  <div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
      <span class="avatar avatar-sm" style="background-image: url(<?php echo SITE_URL ?>/static/avatars/000m.jpg)"></span>
      <div class="d-xl-block ps-2">
        <div><?php echo get_user_name(); ?></div>
        <div class="mt-1 small text-muted">UI Designer</div>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <a href="<?php echo SITE_URL.'/profile' ?>" class="dropdown-item">Profile & account</a>
      <div class="dropdown-divider"></div>
      <a href="<?php echo SITE_URL.'/logout' ?>" class="dropdown-item">Logout</a>
    </div>
  </div>
</div>