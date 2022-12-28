<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title><?php $title = get_page_title(); echo $title['main'] ?></title>
  <link rel="icon" href="<?php echo SITE_URL ?>/static/fav.ico" sizes="64x64">
  <!-- Bootstrape core files -->
  <link href="<?php echo SITE_URL ?>/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo SITE_URL ?>/dist/css/bootstrap-vendors.min.css" rel="stylesheet"/>
  <!-- Custom Css -->
  <link href="<?php echo SITE_URL ?>/dist/css/demo.min.css" rel="stylesheet"/>
  <link href="<?php echo SITE_URL ?>/dist/css/style.css" rel="stylesheet"/>
</head>
<body>
  <div class="page">

    <?php 
    //Main Menu Left SideBar
    require_once("sidebar.php");
    ?>

    <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
          <div class="d-none d-md-flex">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
            </a>
            <div class="nav-item dropdown d-none d-md-flex me-3">
              <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                <span class="badge bg-red"></span>
              </a>

              <?php 
              //Notifications Panal
              require_once("template-parts/_notifications.php");
              ?>
              
            </div>
          </div>

          <?php 
          //Login User Information and Top Menu
          require_once("template-parts/_user-menu.php");
          ?>

        </div>

        <?php 
        //Top Naavebar Search Form
        require_once("template-parts/_search.php");
        ?>
        
      </div>
    </header>
    <div class="page-wrapper">
      <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
          <div class="row align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle"><?php echo $title['sub']; ?></div>
              <h2 class="page-title"><?php echo $title['main']; ?></h2>
            </div>
            <!-- Page title actions -->

            <?php if ( isset( $_REQUEST['category']) ) { ?>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">

                  <?php if ( check_project_type() ) { ?>

                    <span class="d-none d-sm-inline">
                      <a href="#" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#modal-options">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                        Share
                      </a>
                    </span>

                  <?php } ?>

                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-task">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Create new task
                  </a>

                  <!-- Display on Small Device -->
                  <?php if ( check_project_type() ) { ?>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-options" aria-label="Share with team member">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                    </a>
                  <?php } else{ ?>
                    <?php if ( is_project_admin( $_REQUEST['category'] ) ) {
                      echo '<button class="btn btn-danger" onclick="deleteProject('. $_REQUEST['category'] .')">Delete Project</button>';
                    }
                  } ?>

                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-task" aria-label="Create new task">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>

                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>
      <div class="page-body">
