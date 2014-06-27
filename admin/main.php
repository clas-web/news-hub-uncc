<?php


if( is_admin() ):

//----------------------------------------------------------------------------------------
// Setup the plugin's admin pages.
//----------------------------------------------------------------------------------------
add_action( 'admin_init', 'nh_uncc_register_settings', 6 );

endif;


//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function nh_uncc_register_settings()
{
	add_action( 'nh-design-add-settings-sections', 'nh_uncc_design_add_settings_sections' );
	add_action( 'nh-design-add-settings-fields', 'nh_uncc_design_add_settings_fields' );
}


//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function nh_uncc_design_add_settings_sections()
{
	global $wp_settings_sections;
	unset( $wp_settings_sections['nh-design:header:image'] );
}


function nh_uncc_design_add_settings_fields()
{
	global $wp_settings_fields;
	unset( $wp_settings_fields['nh-design:header:title']['header-title']['image-title-position'] );
}

