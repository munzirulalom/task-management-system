<?php 

/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

//Project Add Form Modal
require_once("template-parts/_add-project-modal.php");

?>
		</div>
			<footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
          <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item"><a href="https://github.com/munzirulalom/" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  Copyright &copy; 2023
                  <a href="" class="link-secondary">Trodev</a>.
                  All rights reserved.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

    <!-- Bootstrap Core -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="<?php echo SITE_URL ?>/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo SITE_URL ?>/dist/js/bootstrap-demo.min.js"></script>

  <!-- Custom -->
  <script src="<?php echo SITE_URL ?>/dist/js/form.js"></script>
  <?php 
  if ( isset($_REQUEST['category']) ) {
    echo '<script src="'. SITE_URL .'/dist/js/task.js"></script>';
  }
   ?>
  
</body>
</html>