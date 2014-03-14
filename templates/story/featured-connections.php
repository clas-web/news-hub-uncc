

<?php global $ns_config, $ns_mobile_support, $ns_template_vars; ?>
<?php
$section = $ns_template_vars['section'];
$story = $ns_template_vars['story'];

$links = $story['links'];
if( !$ns_mobile_support->use_mobile_site )
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

//ns_print($story);
?>

<div class="story <?php echo $section->key; ?>-section <?php echo $section->thumbnail_image; ?>-image clearfix">

	<h3><?php echo $story['title']; ?></h3>
	
	<div class="connection-groups">
		<?php foreach( $story['groups'] as $group ): ?>
		<div><?php echo ns_get_anchor( $group['link'], $group['name'], null, $group['name'] ); ?></div>
		<?php endforeach; ?>
	</div><!-- .connection-groups -->
	
	<div class="details">
	
		<div class="column column-1">
		
			<div class="links">
				<?php echo ns_get_anchor( $story['link'], 'View Summary', 'view-summary', 'Summary' ); ?>
				|
				<?php echo ns_get_anchor( $story['site-link'], 'View Full Profile', 'view-full-profile', 'Full Profile' ); ?>
			</div><!-- .links -->
			
			<div class="contact-info">
				<?php echo $story['contact-info']; ?>
			</div><!-- .contact-info -->
		
		</div><!-- .column-1 -->
		
		<div class="column column-2">
		
			<div class="connection-links clearfix">
				<?php foreach( $links as $link_column ): ?>
				<?php foreach( $link_column as $link ): ?>
				<div><?php echo ns_get_anchor( $link['link'], $link['name'], null, $link['name'] ); ?></div>
				<?php endforeach; ?>
				<?php endforeach; ?>
			</div><!-- .connection-links -->
		
		</div><!-- .column-2 -->
	
	</div><!-- .details -->
	
</a>
</div><!-- .story -->

