<?php 

/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

?>
    </div>
  </div>
  <!-- Libs JS -->
  <!-- bootstrap Core -->
  <script src="<?php echo SITE_URL ?>/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo SITE_URL ?>/dist/js/bootstrap-demo.min.js"></script>

  <?php 

  if ( isset($_GET['action']) AND $_GET['action'] === 'register') {
    echo '<script src="'. SITE_URL . '/dist/js/register.js"></script>';
  }

   ?>
  
</body>
</html>