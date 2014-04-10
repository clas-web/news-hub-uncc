<?php

add_filter( 'ns-featured-story', 'thinkingmatters_get_featured_story', 99, 2 );
add_filter( 'ns-listing-story', 'thinkingmatters_get_listing_story', 99, 2 );
add_filter( 'ns-single-story', 'thinkingmatters_get_single_story', 99, 2 );


function thinkingmatters_get_featured_story( $story, $post )
{
	thinkingmatters_get_story_data( $story, $post );
	return $story;
}


function thinkingmatters_get_listing_story( $story, $post )
{
	thinkingmatters_get_story_data( $story, $post );
	return $story;
}


function thinkingmatters_get_single_story( $story, $post )
{
	thinkingmatters_get_story_data( $story, $post );
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
	if( array_key_exists('by_line', $array) ) return $array['by_line'];
	return 0;
}

function thinkingmatters_get_story_data( &$story, $post )
{
	$story['image'] = thinkingmatters_get_image( $post->ID );
	$story['byline'] = thinkingmatters_get_byline( $post );
	
	uksort( $story['description'], 'thinkingmatters_sort_description' );
}

function thinkingmatters_get_byline( $post )
{
	$date = date( 'F d, Y', strtotime($post->post_modified) );
	$author = get_the_author_meta( 'display_name', $post->post_author );
	$url = get_the_author_meta( 'user_url', $post->post_author );
	
//	return $date.' by '.$author;
	return $date.' by <a href="'.$url.'" title="Posts by '.$author.'">'.$author.'</a>';
}

