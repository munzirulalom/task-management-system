<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

 ?>
<div class="col-xl-3 col-md-4 col-sm-12">
	<div class="card">
		<div class="card-content">
			<a href="<?php echo $link; ?>">
				<img src="<?php echo $post->featured_image_src_large[0]; ?>" class="card-img-top img-fluid" alt="<?php echo $post->title->rendered ; ?>, BUSSID Mod">
			</a>
			<div class="card-body">
				<a href="<?php echo $link; ?>">
					<h5 class="card-title"><?php echo $post->title->rendered ; ?></h5>
				</a>
				<small>
					<i class="icon dripicons-calendar me-2"></i><time datetime="<?php echo $post->modified ?>"><?php echo date( 'F j, Y, g:i a T', strtotime( $post->modified ) ); ?></time>
				</small>
			</div>
		</div>
	</div>
</div>