

<?php global $ns_config, $ns_mobile_support, $ns_template_vars; ?>
<?php
$options = $ns_config->get_admin_options( 'sidebar' );

function ns_clas_buttons()
{
	global $ns_config;
	
	?>
	<div id="clas-buttons">
		<?php ns_image( $ns_config->get_value('sidebar', 'clas-connections') ); ?>
		<?php ns_image( $ns_config->get_value('sidebar', 'thinking-matters') ); ?>
		<?php ns_image( $ns_config->get_value('sidebar', 'exchange-online') ); ?>
	</div>

	<?php
}
?>


<div id="sidebar-wrapper" class="clearfix">

	<div id="sidebar" class="clearfix">
	<?php ns_use_widget( 'sidebar', 'top' ); ?>

	<?php foreach( $options['sections'] as $column_name => $sections ): ?>

		<div class="column <?php echo 'front-page-'.$column_name; ?>">

		<?php if( !$ns_mobile_support->use_mobile_site ): ns_clas_buttons(); endif; ?>

		<?php
		
			foreach( $sections as $section_key ):
		
				$section = $ns_config->get_section_by_key( $section_key, true );
				if( $section == null ) continue;
			
				$stories = $section->get_stories( 'sidebar' );
				?>
				<div class="section-box <?php $section_key; ?>-section <?php echo $section->thumbnail_image; ?>-image">

					<h2><?php echo $section->title; ?></h2>
			
					<?php
					global $ns_story;
					foreach( $stories as $story ):
			
						$ns_template_vars['story'] = $story;
						$ns_template_vars['section'] = $section;
						ns_get_template_part( 'featured', 'story', $section->key );
			
					endforeach;
					?>
			
					<div class="more">
						<?php echo ns_get_anchor( 
							$section->get_section_link(), 
							$section->name.' Archives', 
							null,
							'More <em>'.$section->name.'</em> &raquo;' ); ?>
					</div><!-- .more -->

				</div><!-- .section-box -->
				<?php

			endforeach; // foreach( $current_column as $section_key )
		?>
	
		<?php if( $mobile_support->use_mobile_site ): exchange_clas_buttons(); endif; ?>

		</div><!-- .column -->

	<?php endforeach; // foreach( $options['sections'] as $column_name => $sections ) ?>
	
	<?php ns_use_widget( 'sidebar', 'bottom' ); ?>
	</div><!-- #sidebar -->
	
</div><!-- #sidebar-wrapper -->

