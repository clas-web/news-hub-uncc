<?php

//echo 'custom-post-types/connection/connection.php';

if( !class_exists('Connections_ConnectionCustomPostType') )
	return;
	

//echo 'NS_ConnectionCustomPostType';

add_filter( 'ns-connection-featured-story', array('NS_ConnectionCustomPostType','get_featured_story'), 99, 2 );
add_filter( 'ns-connection-listing-story', array('NS_ConnectionCustomPostType','get_listing_story'), 99, 2 );
add_filter( 'ns-connection-single-story', array('NS_ConnectionCustomPostType','get_single_story'), 99, 2 );


class NS_ConnectionCustomPostType extends Connections_ConnectionCustomPostType
{

	public static function get_featured_story( $story, $post )
	{
		$story['contact-info'] = get_post_meta( $post->ID, 'contact-info', true );
		$story['groups'] = self::get_groups( $post->ID );
		$story['links'] = self::get_links( $post->ID );
		$story['site-link'] = self::get_site_link( $post->ID );
	
		return $story;
	}


	public static function get_listing_story( $story, $post )
	{
		unset($story['description']['excerpt']);

		$story['contact-info'] = get_post_meta( $post->ID, 'contact-info', true );
		$story['groups'] = self::get_groups( $post->ID );
		$story['links'] = self::get_links( $post->ID );
		$story['site-link'] = self::get_site_link( $post->ID );
	
		return $story;
	}


	public static function get_single_story( $story, $post )
	{
		$story['contact-info'] = get_post_meta( $post->ID, 'contact-info', true );
		$story['groups'] = self::get_groups( $post->ID );
		$story['links'] = self::get_links( $post->ID );
		$story['site-link'] = self::get_site_link( $post->ID );
	
		return $story;
	}



	public static function get_groups( $post_id )
	{
		$connection_groups = array();

		$groups = wp_get_post_terms( $post_id, self::$_category_name );
		foreach( $groups as $group )
		{
			$connection_groups[] = array(
				'name' => $group->name,
				'link' => get_term_link( $group, self::$_category_name ),
			);
		}

		return $connection_groups;
	}
	
	public static function get_links( $post_id )
	{
		$connection_links = array();

		$links = wp_get_post_terms( $post_id, self::$_tag_name );
		foreach( $links as $link )
		{
			$connection_links[] = array(
				'name' => $link->name,
				'link' => get_term_link( $link, self::$_tag_name ),
			);
		}

		return $connection_links;
	}
	
	public static function get_site_link( $post_id )
	{
		$url = get_post_meta( $post->ID, 'url', true );
		
		if( filter_var($url, FILTER_VALIDATE_URL) === false )
			$url = null;

		return $url;
	}

}

