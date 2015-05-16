

<?php global $nh_config, $nh_mobile_support, $nh_template_vars; ?>

<?php 
$class = '';
$sidebar_count = 0;
$use_left_sidebar = false;
$use_right_sidebar = false;

$widgets = wp_get_sidebars_widgets();

//nh_print(count($widgets["left-sidebar-top"]));

if( count($widgets["left-sidebar-top"]) > 0 || count($widgets["left-sidebar-bottom"]) > 0 ) {
	$use_left_sidebar = true;
	$sidebar_count++;
	$class .= ' left-sidebar';
}

if( count($widgets["sidebar-top"]) > 0  || count($widgets["sidebar-bottom"]) > 0  ) {
	$use_right_sidebar = true;
	$sidebar_count++;
	$class .= ' right-sidebar';
}


switch( $sidebar_count )
{
	case 0:
		$class = 'full-width' . $class;
		break;
	case 1:
		$class = 'one-sidebar-width' . $class;
		break;
	case 2:
		$class = 'two-sidebars-width' . $class;
		break;
}
?>


<div id="content-wrapper" class="clearfix">
	
	<?php
	$section = $nh_template_vars['section'];
	$key = $section->key;
	$thumbnail = $section->thumbnail_image;
	$featured = $section->featured_image;

	$num_columns = 1;
	if( !$nh_mobile_support->use_mobile_site )
		$num_columns = $section->get_number_of_columns( $nh_template_vars['content-type'] );
	?>

	<div id="content" class="<?php echo $class; ?> <?php echo $key ?>-section num-columns-<?php echo $num_columns; ?> <?php echo $thumbnail; ?>-thumbnail-image <?php echo $featured; ?>-featured-image clearfix">
	<?php nh_use_widget( 'content', 'top' ); ?>

	
	<?php
// 	nh_print( $nh_template_vars['content-type'].' : content : '.$key );
	nh_get_template_part( $nh_template_vars['content-type'], 'content', $key );
	?>

	
	<?php nh_use_widget( 'content', 'bottom' ); ?>
	</div><!-- #content -->

</div><!-- #content-wrapper -->

