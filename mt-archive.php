<?php
/**
 * Displays the category archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

// nh_print( 'PAGE:mt-archive.php' );
global $nh_config, $nh_template_vars;

$nh_template_vars = array();
$nh_template_vars['content-type'] = 'listing';

$nh_template_vars['section'] = $nh_config->get_section( MultiTaxonomyBrowser_Api::GetPostTypes(), array() );

switch( $nh_template_vars['section']->key )
{
	case 'none':
		$nh_template_vars['page-title'] = '';
		break;
	default:
		$nh_template_vars['page-title'] = $nh_template_vars['section']->name;
		break;
}

$nh_template_vars['listing-name'] = ( mt_is_filtered_archive() ? 'Filtered Archive' : 'Combined Archive' );
$nh_template_vars['description'] = '';

global $nh_clas_search_term;
$nh_clas_search_term = $nh_template_vars['page-title'];

nh_get_template_part( 'standard-template' );

