<?php
//========================================================================================
// 
//
// @package WordPress
// @subpackage news-site-clas
//========================================================================================


//========================================================================================
//====================================================== Default filters and actions =====

require_once( __DIR__.'/widgets/clas-buttons-widget.php' );
require_once( __DIR__.'/widgets/search-widget.php' );

add_filter( 'nh-link-target', 'nh_clas_get_link_target', 9999, 3 );

add_filter( 'the_content_feed', 'nh_clas_format_content_for_rss' );
add_filter( 'the_excerpt_rss', 'nh_clas_format_excerpt_for_rss' );

add_filter( 'frm_add_entry_meta', 'nh_clas_create_datetime_field', 9999 );
add_filter( 'the_content', 'nh_clas_alter_formiable_content' );

add_filter( 'section-link', 'nh_get_section_link', 9999, 2 );


// Modify Admin bar.
add_action( 'admin_bar_menu', 'uncc_add_uncc_logo', 1 );
add_action( 'wp_before_admin_bar_render', 'uncc_remove_wp_logo' );


/**
 * Add the UNCC logo to admin bar.
 * @param  WP_Admin_Bar  $wp_admin_bar  WordPress Toolbar API controller.
 */
if( !function_exists('uncc_add_uncc_logo') ):
function uncc_add_uncc_logo( $wp_admin_bar )
{
	$wp_admin_bar->add_menu(
		array(
			'id'	=> 'uncc-logo',
			'href'	=> '#',
			'meta'	=> array(
				'class'	=> 'uncc-icon',
			),
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'id'	=> 'clas-link',
			'href'	=> 'http://clas.uncc.edu',
			'title'	=> 'College of Liberal Arts & Sciences',
		)
	);
}
endif;


/**
 * Remove the default WP logo from the admin bar.
 * @param  WP_Admin_Bar  $wp_admin_bar  WordPress Toolbar API controller.
 */
if( !function_exists('uncc_remove_wp_logo') ):
function uncc_remove_wp_logo( $wp_admin_bar )
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
endif;



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function nh_clas_get_link_target( $target, $link, $post )
{
	if( strpos( $link, 'uncc.edu' ) === false )
		return 'target="_blank"';
	return '';
}



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
/**
 * Formats the content for the RSS fedd.
 */
function nh_clas_format_content_for_rss($content)
{
	return 'none';
}



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
/**
 * Formats the excerpt for the RSS fedd.
 */
function nh_clas_format_excerpt_for_rss($excerpt)
{
	global $post;
	global $nh_config;

	if( $post->post_type == 'event' )
	{
		$excerpt = '<div class="datetime">'.nh_event_get_datetime( $post->ID, true ).'</div>'.
		           '<div class="location">'.get_post_meta( $post->ID, 'location', true ).'</div>';
	}
	else
	{
		$category = get_category( get_cat_ID( single_cat_title('', false ) ) );
		if( !$category ) return $excerpt;
		
		if( $category->slug == 'news' )
		{		
			$taxonomies = nh_get_taxonomies( get_the_ID() );
			$section = $nh_config->get_section( $type, $taxonomies, false, array('news') );
			$story = $section->get_listing_story( get_post() );

			ob_start();
		
			global $nh_template_vars;
			$nh_template_vars['section'] = $section;
			$nh_template_vars['story'] = $story;
			nh_get_template_part( 'rss', 'story', 'news' );
			
			$excerpt = ob_get_contents();
			ob_end_clean();
		}
	}
	
	return $excerpt;
}



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
/**
 * Populates the datetime fields when submitting a Formidible Event form.
 */
function nh_clas_create_datetime_field( $values )
{
	if( $values['field_id'] == 271 ) // datetime
	{
		$datetime = DateTime::createFromFormat( 'm/d/Y h:i A', $_POST['item_meta'][100].' '.$_POST['item_meta'][101] );
		$values['meta_value'] = $datetime->format('Y-m-d H:i:s');
		$_POST['item_meta'][271] = $datetime->format('Y-m-d H:i:s');
		$_POST['frm_wp_post_custom']['271=datetime'] = $datetime->format('Y-m-d H:i:s');
	}
	
	if( $values['field_id'] == 278 ) // formatted datetime
	{	
		$datetime = DateTime::createFromFormat( 'm/d/Y h:i A', $_POST['item_meta'][100].' '.$_POST['item_meta'][101] );
		$values['meta_value'] = $datetime->format('F d, Y, g:i A');
		$_POST['item_meta'][278] = $datetime->format('F d, Y, g:i A');
		$_POST['frm_wp_post_custom']['278=formatted-datetime'] = $datetime->format('F d, Y, g:i A');
	}

	return $values;
}



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function nh_clas_alter_formiable_content( $content )
{
	if( strpos( $content, '[formidable' ) !== FALSE )
	{
		$content = '
			<div class="confidential-warning-message">
				Confidential, sensitive or data which is personally identifiable should never be collected or stored on publicly available websites.  See <a href="http://legal.uncc.edu/policies/up-311" alt="University Policy 311">University Policy 311</a>.
			</div>
			'.$content;
	}
	return $content;
}



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
if( !function_exists('nh_get_anchor') ):
function nh_get_anchor( $url, $title, $class = null, $contents = null )
{
	if( $url === null ) return $contents;
	
	$anchor = '<a href="'.$url.'" title="'.htmlentities($title).'"';
	if( strpos( $url, 'uncc.edu' ) === false ) $anchor .= ' target="_blank"';
	if( $class ) $anchor .= ' class="'.$class.'"';
	$anchor .= '>';

	if( $contents !== null )
		$anchor .= $contents.'</a>';

	return $anchor;
}
endif;



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function nh_get_section_link( $link, $section )
{
	if( $link !== null ) return $link;
	
	if( function_exists('mt_get_url') )
	{
		$link = mt_get_url(
			MTType::CombinedArchive,
			$section->post_types,
			array_keys($section->taxonomies),
			false,
			$section->taxonomies
		);
	}

	return $link;
}


