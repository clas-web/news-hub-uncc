<?php


add_filter( 'posts_join',     'ns_clas_connections_alter_search_join',     9999, 2 );
add_filter( 'posts_where',    'ns_clas_connections_alter_search_where',    9999, 2 );
add_filter( 'posts_distinct', 'ns_clas_connections_alter_search_distinct', 9999, 2 );
add_filter( 'posts_orderby',  'ns_clas_connections_alter_search_orderby',  9999, 2 );


add_action( 'pre_get_posts', 'ns_clas_connections_alter_archive_order' );




function ns_clas_connections_alter_archive_order( $wp_query )
{
    if( (!is_admin()) &&
    	(is_post_type_archive('connection') || 
		 is_tax( 'connection-group' ) || 
		 is_tax( 'connection-link' ) ) &&
    	($wp_query->is_main_query()) )
	{
		$wp_query->set( 'orderby', 'meta_value' );
		$wp_query->set( 'meta_key', 'sort-title' );
		$wp_query->set( 'order', 'asc' );
    }

    return $order_by;
}



/**
 * 
 */
function ns_clas_connections_get_search_term( $search_term = null, $sql = true )
{
	if( $search_term == null )
	{
		$search_term = get_search_query();
	}
	
	if( $sql )
		$search_term = preg_replace("/[^A-Za-z0-9]/", '_', $search_term);
		
	return $search_term;	
}



/**
 * 
 */
function ns_clas_connections_alter_search_join( $join, $wp_query )
{
	global $wpdb;

	if( $wp_query->is_search )
	{
		$join .= "
			JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
			INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) 
			INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			INNER JOIN $wpdb->terms ON ($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id) 
		";
	}

	return $join;
}



/**
 * 
 */
function ns_clas_connections_alter_search_where( $where, $wp_query )
{
	global $wpdb;

	if( $wp_query->is_search )
	{
		$search_term = ns_clas_connections_get_search_term( $wp_query->query_vars['s'] );
		$where = "
		  AND ($wpdb->posts.post_type = 'connection' AND $wpdb->posts.post_status = 'publish')
		  AND (
			$wpdb->posts.post_title LIKE '%".$search_term."%'
			OR
			($wpdb->postmeta.meta_key IN ('username','search_content') AND $wpdb->postmeta.meta_value LIKE '%".$search_term."%')
			OR
			$wpdb->terms.name LIKE '%".$search_term."%'
		  )";
	}

	return $where;
}



/**
 * 
 */
function ns_clas_connections_alter_search_orderby( $order_by, $wp_query )
{
	global $wpdb;

	if( $wp_query->is_search )
	{
		$search_term = ns_clas_connections_get_search_term( $wp_query->query_vars['s'] );
		$order_by = "
			CASE WHEN $wpdb->posts.post_title LIKE '%".$search_term."%' THEN 1000 ELSE 0 END +
			CASE WHEN $wpdb->terms.name LIKE '%".$search_term."%' THEN 100 ELSE 0 END +
			CASE WHEN $wpdb->postmeta.meta_value LIKE '%".$search_term."%' THEN 10 ELSE 0 END
			DESC
    	";
    }

    return $order_by;
}



/**
 * 
 */
function ns_clas_connections_alter_search_distinct()
{
	global $wp_query;
	$distinct = '';
	
	if( $wp_query->is_search )
	{
		$distinct = 'DISTINCT';
	}

	return $distinct;
}




