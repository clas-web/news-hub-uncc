

<?php global $nh_config, $nh_mobile_support, $nh_template_vars;?> 

<?php
$widgets = wp_get_sidebars_widgets();
if( is_array($widgets["left-sidebar-top"]) || is_array($widgets["left-sidebar-bottom"]) ):
?>
<div id="sidebar-wrapper" class="clearfix">

	<div id="left-sidebar" class="clearfix">
	<?php nh_use_widget( 'left-sidebar', 'top' ); ?>

	</div><!-- #sidebar -->	
</div><!-- #sidebar-wrapper -->

<?php endif; ?>