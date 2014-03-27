<?php
/**
 * Displays the category archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

//ns_print('page:taxonomy-connection-group.php');
global $ns_config, $ns_template_vars;

$ns_template_vars = array();
$ns_template_vars['content-type'] = 'listing';
$ns_template_vars['page-title'] = single_term_title( '', false );
$ns_template_vars['section'] = $ns_config->get_section( 'connection' );

$settings = Connections_ConnectionCustomPostType::get_settings();
$ns_template_vars['listing-name'] = $settings['name']['group']['full_plural'];
$ns_template_vars['description'] = '';

global $ns_clas_search_term;
$ns_clas_search_term = $ns_template_vars['page-title'];

ns_get_template_part( 'standard-template' );

