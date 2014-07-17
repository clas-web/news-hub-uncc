<?php
/**
 * Displays the category archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

// nh_print( 'PAGE:mt-search.php' );
global $nh_config, $nh_template_vars;

$nh_template_vars = array();
$nh_template_vars['content-type'] = 'search';

$nh_template_vars['section'] = $nh_config->get_section( MultiTaxonomyBrowser_Api::GetPostTypes(), array() );

$nh_template_vars['page-title'] = ( mt_is_filtered_archive() ? 'Filtered Search' : 'Combined Search' );

$nh_template_vars['listing-name'] = '';
$nh_template_vars['description'] = '';

global $nh_clas_search_term;
$nh_clas_search_term = $nh_template_vars['page-title'];

nh_get_template_part( 'mt-archive-template' );

