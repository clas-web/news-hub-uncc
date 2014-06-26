<?php
/**
 * Displays the category archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

// nh_print( 'PAGE:taxonomy-connection-group.php' );
global $nh_config, $nh_template_vars;

$nh_template_vars = array();
$nh_template_vars['content-type'] = 'listing';
$nh_template_vars['page-title'] = single_term_title( '', false );
$nh_template_vars['section'] = $nh_config->get_section( 'connection' );

$settings = Connections_ConnectionCustomPostType::get_settings();
$nh_template_vars['listing-name'] = $settings['name']['group']['full_plural'];
$nh_template_vars['description'] = '';

global $nh_clas_search_term;
$nh_clas_search_term = $nh_template_vars['page-title'];

if( class_exists('MultiTaxonomyBrowser') )
{
	$nh_template_vars['mt'] = array();
	$nh_template_vars['mt']['type'] = MTType::FilteredArchive;
	$nh_template_vars['mt']['post-types'] = array( 'connection' );
	$nh_template_vars['mt']['taxonomies'] = array( 'connection-group', 'connection-link' );
	$nh_template_vars['content-type'] = 'listing';
}

nh_get_template_part( 'standard-template' );

