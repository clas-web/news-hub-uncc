
<?php global $nh_config, $nh_mobile_support, $nh_template_vars, $wp_query; ?>

<?php
if( $wp_query->max_num_pages > 1 ):

	?>
	<div id="page-navigation" class="clearfix" role="navigation">
		<div class="nav-next">
			<?php next_posts_link( 'Next Page &raquo;' ); ?>
		</div>
		<div class="nav-prev">
			<?php previous_posts_link( '&laquo; Previous Page &raquo;' ); ?>
		</div>
	</div>
	<?php

endif; // if( $wp_query->max_num_pages > 1 )


