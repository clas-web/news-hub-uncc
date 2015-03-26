<?php
//========================================================================================
// 
//
// @package WordPress
// @subpackage news-site
//----------------------------------------------------------------------------------------
// Main setup at bottom of file.
//========================================================================================


//========================================================================================
//====================================================== Default filters and actions =====

add_filter( 'the_posts', 'nh_alter_events_feed_posts', 20, 2 );
add_filter( 'the_posts', 'nh_alter_news_feed_posts', 20, 2 );
add_action( 'admin_menu' , 'nh_remove_events_taxonomies' );



//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
if( !function_exists('nh_alter_news_feed_posts') ):
function nh_alter_news_feed_posts( $posts, $wp_query )
{
	if( is_admin() || !$wp_query->is_main_query() || !is_feed() ) return $posts;

	$section = nh_get_section( $wp_query );
	if( $section->key !== 'news' ) return $posts;

	for( $i = 0; $i < count($posts); $i++ )
	{
		$publication_date = date( 'Y-m-d H:i:s', time() - ($i * 86400) );
		$posts[$i]->post_date = $posts[$i]->post_date_gmt = $posts[$i]->post_modified = $posts[$i]->post_modified_gmt = $publication_date;
	}
	
	return $posts;
}
endif;




//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
if( !function_exists('nh_alter_events_feed_posts') ):
function nh_alter_events_feed_posts( $posts, $wp_query )
{
	if( is_admin() || !$wp_query->is_main_query() || !is_feed() ) return $posts;

	$section = nh_get_section( $wp_query );
	if( $section->key !== 'events' ) return $posts;

	$posts = $section->get_stories( 'sidebar', $posts, false );

	return $posts;
}
endif;


//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
if( !function_exists('nh_remove_events_taxonomies') ):
function nh_remove_events_taxonomies()
{
	remove_meta_box( 'categorydiv', 'event', 'normal' );
	remove_meta_box( 'tagsdiv-post_tag', 'event', 'normal' );
}
endif;


