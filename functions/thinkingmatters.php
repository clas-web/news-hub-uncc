<?php

add_filter( 'ns-featured-story', 'thinkingmatters_get_featured_story', 99, 2 );
add_filter( 'ns-listing-story', 'thinkingmatters_get_listing_story', 99, 2 );
add_filter( 'ns-single-story', 'thinkingmatters_get_single_story', 99, 2 );




// 	global $post;
// 
// 	$src = get_post_meta($post->ID, 'thumbnail', TRUE);
// 	if( $src !== '' )
// 		$excerpt = '<div class="fwp_uncc_thumbnail"><img src="'.$src.'" /></div><div class="fwp_uncc_excerpt">'.$excerpt."</div>";
// 
// 	if( has_excerpt() )
// 		return $excerpt.'<a href="'.get_permalink().'" class="continue-reading">'.__( 'More &rarr;', '2010-translucence' ).'</a>';;
// 		
// 	if( strlen($output) < strlen($post->post_content) )
// 		return $excerpt.'&hellip; <a href="'.get_permalink().'" class="continue-reading">'.__( 'More &rarr;', '2010-translucence' ).'</a>';
// 
// 	return $excerpt;


function thinkingmatters_get_featured_story(  $story, $post )
{
	$story['image'] = thinkingmatters_get_image( $post->ID );
	$story['description']['post_date'] = $post->post_modified;
	$story['description']['attribution_directory'] = 'attribution directory';
	
	uksort( $story['description'], 'thinkingmatters_sort_description' );
	
	return $story;
}


function thinkingmatters_get_listing_story(  $story, $post )
{
	$story['image'] = thinkingmatters_get_image( $post->ID );
	$story['description']['post_date'] = $post->post_modified;
	$story['description']['attribution_directory'] = 'attribution directory';
	
	uksort( $story['description'], 'thinkingmatters_sort_description' );
	
	return $story;
}


function thinkingmatters_get_single_story(  $story, $post )
{
	$story['image'] = thinkingmatters_get_image( $post->ID );
	$story['description']['post_date'] = $post->post_modified;
	$story['description']['attribution_directory'] = 'attribution directory';
	
	uksort( $story['description'], 'thinkingmatters_sort_description' );
	
	return $story;
}


function thinkingmatters_get_image( $post_id )
{
	$thumbnail = get_post_meta( $post_id, 'thumbnail', true );
	if( $thumbnail ) return $thumbnail;
	
	return null;
}

function thinkingmatters_sort_description( $a, $b )
{
	$array = array( $a => -1, $b => 1 );
	if( array_key_exists('post_date', $array) )
		return $array['post_date'];
	if( array_key_exists('attribution_directory', $array) )
		return $array['attribution_directory'];
	return 0;
}



