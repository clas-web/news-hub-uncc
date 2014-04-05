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
		self::get_story_data( $story, $post );
		return $story;
	}


	public static function get_listing_story( $story, $post )
	{
		unset($story['description']['excerpt']);

		self::get_story_data( $story, $post );
		
		if( is_search() )
		{
			$search_term = ns_clas_connections_get_search_term( null, false );
// 			ns_print( $search_term, 'term' );
			
			self::highlight_term( $story['title'], $search_term );

			foreach( $story['groups'] as &$group )
			{
				self::highlight_term( $group['name'], $search_term );
			}
			
			foreach( $story['links'] as &$link )
			{
// 				ns_print($link);
// 				ns_print( $link['name'] );
				self::highlight_term( $link['name'], $search_term );
// 				ns_print($link);
			}
			
			$search_content = get_post_meta( $post->ID, 'search-content', true );
			$search_content = ( $search_content ? $search_content : '' );
			$search_content = explode( "\n", $search_content );
			
			for( $i = 0; $i < count($search_content); $i++ )
			{
				if( !self::contains_term( $search_content[$i], $search_term ) )
				{
					array_splice( $search_content, $i, 1 ); $i--;
				}
			}
			
			if( count($search_content) > 3 ) array_splice( $search_content, 3 );
			
			foreach( $search_content as &$content )
			{
				if( strlen($content) > strlen($search_term) + 100 )
				{
					$matches = array();
					$num_matches = preg_match_all(
						"/\\b(.{0,50})".$search_term.".(.{0,50})\\b/i",
						$content,
						$matches
					);
			
					if( $num_matches > 0 )
					{
						$content = trim( $matches[0][0] );
					}
				}

				self::highlight_term( $content, $search_term );
			}
			
			if( count($search_content) > 0 )
				$story['search-content'] = '...' . implode( '...', $search_content ) . '...';
			else
				$story['search-content'] = '';
		}
	
		return $story;
	}
	
	private static function contains_term( &$text, $highlight_text )
	{
		if( preg_match( '/'.$highlight_text.'/i', $text ) === 1 ) return true;
		return false;
	}
	
	private static function highlight_term( &$text, $highlight_text )
	{
//  		ns_print( $text.' :::: '.$highlight_text, 'text and highlight' );
		$count = 0;
        $text = preg_replace( '/'.$highlight_text.'/i', '<strong>$0</strong>', $text, -1, $count );
//  		ns_print( $text, 'after preg' );
//  		ns_print( $count );
        return $count;
	}


	public static function get_single_story( $story, $post )
	{
		self::get_story_data( $story, $post );
		return $story;
	}



	public static function get_groups( $post_id )
	{
		$connection_groups = array();

		$groups = wp_get_post_terms( $post_id, 'connection-group' );
		foreach( $groups as $group )
		{
			$connection_groups[] = array(
				'name'  => $group->name,
				'class' => $group->name,
				'link'  => get_term_link( $group, 'connection-group' ),
			);
		}

		return $connection_groups;
	}
	
	public static function get_links( $post_id )
	{
		$connection_links = array();

		$links = wp_get_post_terms( $post_id, 'connection-link' );
		foreach( $links as $link )
		{
			$connection_links[] = array(
				'name'  => $link->name,
				'class' => $link->name,
				'link'  => get_term_link( $link, 'connection-link' ),
			);
		}

		return $connection_links;
	}
	
	public static function get_site_link( $post_id )
	{
		$url = get_post_meta( $post_id, 'url', true );
		
		if( filter_var($url, FILTER_VALIDATE_URL) === false )
			$url = null;

		return $url;
	}
	
	
	private static function get_story_data( &$story, $post )
	{
		$entry_method = get_post_meta( $post->ID, 'entry-method', true );
		
		switch( $entry_method )
		{
			case( 'synch' ):
				$story['contact-info'] = get_post_meta( $post->ID, 'contact-info', true );
				$story['site-link'] = self::get_site_link( $post->ID );
				break;
				
			case( 'manual' ):
			default:
				$story['contact-info'] = '';
				$story['contact-info'] .= '<div class="location">Office: '.get_post_meta( $post->ID, 'contact-location', true ).'</div>';
				$story['contact-info'] .= '<div class="phone">Phone: '.get_post_meta( $post->ID, 'contact-phone', true ).'</div>';
				$story['contact-info'] .= '<div class="email">Email: '.get_post_meta( $post->ID, 'contact-email', true ).'</div>';
				$story['site-link'] = null;
				break;
		}
		
		$story['groups'] = self::get_groups( $post->ID );
		$story['links'] = self::get_links( $post->ID );
	}
}

