

<?php //nh_print('single-connections.php'); ?>
<?php global $nh_config, $nh_mobile_support, $nh_template_vars, $post; ?>
<?php
$section = $nh_template_vars['section'];
$story = $section->get_single_story( $post );
$settings = Connections_ConnectionCustomPostType::get_settings();
$connection_links_name = $settings['name']['link']['full_plural'];

$links = $story['links'];
if( !$nh_mobile_support->use_mobile_site )
{
	$links = array(
		 array_slice( $links, 0, ceil(count($links) / 2) ),
		 array_slice( $links, ceil(count($links) / 2) )
	);
}
else
{
	$links = array( $links );
}

// nh_print($story);
?>

<div class="story <?php echo $section->key; ?>-section <?php echo $section->thumbnail_image; ?>-image clearfix">

	<h3><?php echo $story['title']; ?></h3>
	
	<div class="connection-groups">
		<?php foreach( $story['groups'] as $group ): ?>
		<div><?php echo nh_get_anchor( $group['link'], $group['class'], null, $group['name'] ); ?></div>
		<?php endforeach; ?>
	</div><!-- .connection-groups -->
	
	<div class="details clearfix">
	
		<div class="column column-1">
		
			<div class="links">
				<?php echo nh_get_anchor( $story['link'], 'View Summary', 'view-summary', 'Summary' ); ?>
				<?php if( $story['site-link'] !== null ): ?>
				|
				<?php echo nh_get_anchor( $story['site-link'], 'View Full Profile', 'view-full-profile', 'Full Profile' ); ?>
				<?php endif; ?>
			</div><!-- .links -->
			
			<div class="contact-info">
				<?php echo $story['contact-info']; ?>
			</div><!-- .contact-info -->
		
		</div><!-- .column-1 -->
		
		<div class="column column-2">
		
			<?php $count = 1; ?>
			<div class="connection-links columns-<?php echo count($links); ?> clearfix">
				<h5><?php echo $connection_links_name; ?></h5>
				<?php foreach( $links as $link_column ): ?>
				<div class="column column-<?php echo $count; ?>">
				<?php foreach( $link_column as $link ): ?>
				<div><?php echo nh_get_anchor( $link['link'], $link['class'], null, $link['name'] ); ?></div>
				<?php endforeach; ?>
				</div>
				<?php $count++; ?>
				<?php endforeach; ?>
			</div><!-- .connection-links -->
		
		</div><!-- .column-2 -->
	
	</div><!-- .details -->
	
	<div class="post-contents">
	
		<?php echo $story['description']['text']; ?>
	
	</div>
	
</a>
</div><!-- .story -->

