

<?php global $ns_config, $ns_mobile_support, $ns_template_vars; ?>
<?php
$section = $ns_template_vars['section'];
$story = $ns_template_vars['story'];
?>

<div class="story <?php echo $section->key; ?>-section <?php echo $section->thumbnail_image; ?>-image clearfix">

	<div class="details">

		<?php if( $section->thumbnail_image !== 'none' ): ?>
	
			<div class="image">
		
				<?php if( $story['image'] ): ?>
					<img src="<?php echo $story['image']; ?>" alt="Featured Image" />
				<?php endif; ?>
			
				<?php if( $story['embed'] ): ?>
					<?php echo $story['embed']; ?>
				<?php endif; ?>

			</div><!-- .image -->
	
		<?php endif; ?>
	
		<h3><?php echo ns_get_anchor( $story['link'], $story['title'], null, $story['title'] ); ?></h3>
		
		<div class="byline"><?php echo $story['byline']; ?></div>
				
		<?php if( count($story['description']) > 0 ): ?>

			<div class="description">
			<?php echo ns_get_anchor( $story['link'], $story['title'] ); ?>

			<?php 
			foreach( $story['description'] as $key => $value ):
				if( is_array($value) ):
					
					?><div class="<?php echo $key; ?>"><?php
					
					foreach( $value as $k => $v ):
						?><div class="<?php echo $k; ?>"><?php echo $v; ?></div><?php
					endforeach;
				
					?></div><?php
					
				else:

					?><div class="<?php echo $key; ?>"><?php echo $value; ?></div><?php
					
				endif;
			endforeach;
			?>
	
			</a>
			</div><!-- .description -->

		<?php endif; ?>		
	
	</div><!-- .details -->
	
</div><!-- .story -->

