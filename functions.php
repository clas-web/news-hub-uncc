<?php


require_once( dirname(__FILE__).'/custom-post-types/connection/connection.php' );
require_once( dirname(__FILE__).'/widgets/clas-buttons-widget.php' );

add_filter( 'ns-link-target', 'ns_clas_get_link_target', 9999, 3 );

add_filter( 'the_content_feed', 'ns_clas_format_content_for_rss' );
add_filter( 'the_excerpt_rss', 'ns_clas_format_excerpt_for_rss' );

add_filter( 'frm_add_entry_meta', 'ns_clas_create_datetime_field', 9999 );
add_filter( 'the_content', 'ns_clas_alter_formiable_content' );




function ns_clas_get_link_target( $target, $link, $post )
{
	if( strpos( $link, 'uncc.edu' ) === false )
		return 'target="_blank"';
	return '';
}


/**
 * Formats the content for the RSS fedd.
 */
function ns_clas_format_content_for_rss($content)
{
	return 'none';
}



/**
 * Formats the excerpt for the RSS fedd.
 */
function ns_clas_format_excerpt_for_rss($excerpt)
{
	global $post;
	global $ns_config;

	if( $post->post_type == 'event' )
	{
		$excerpt = '<div class="datetime">'.ns_event_get_datetime( $post->ID, true ).'</div>'.
		           '<div class="location">'.get_post_meta( $post->ID, 'location', true ).'</div>';
	}
	else
	{
		$category = get_category( get_cat_ID( single_cat_title('', false ) ) );
		if( !$category ) return $excerpt;
		
		if( $category->slug == 'news' )
		{		
			$type = get_post_type( get_the_ID() );
			$categories = ns_get_categories();
			$section = $ns_config->get_section( $type, $categories, null, false, array('news') );
			$story = $section->get_listing_story( get_post() );

			ob_start();
		
			global $ns_template_vars;
			$ns_template_vars['section'] = $section;
			$ns_template_vars['story'] = $story;
			ns_get_template_part( 'rss', 'story', 'news' );
			
			$excerpt = ob_get_contents();
			ob_end_clean();
		}
	}
	
	return $excerpt;
}

/**
 * Populates the datetime fields when submitting a Formidible Event form.
 */
function ns_clas_create_datetime_field( $values )
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


function ns_clas_alter_formiable_content( $content )
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


