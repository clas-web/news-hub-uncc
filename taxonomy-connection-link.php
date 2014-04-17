<?php
/**
 * Displays the tag archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

//nh_print('page:taxonomy-connection-link.php');
global $nh_config, $nh_template_vars;

$nh_template_vars = array();
$nh_template_vars['content-type'] = 'listing';
$nh_template_vars['page-title'] = single_term_title( '', false );
$nh_template_vars['section'] = $nh_config->get_section( 'connection' );

$settings = Connections_ConnectionCustomPostType::get_settings();
$nh_template_vars['listing-name'] = $settings['name']['link']['full_plural'];
//$nh_template_vars['description'] = 'Click <a href="'.get_search_link( single_term_title( '', false ) ).'">here</a> to perform a search.';
$nh_template_vars['description'] = '';

global $nh_clas_search_term;
$nh_clas_search_term = $nh_template_vars['page-title'];

nh_get_template_part( 'standard-template' );

