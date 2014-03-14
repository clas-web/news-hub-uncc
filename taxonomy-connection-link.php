<?php
/**
 * Displays the tag archive page.
 *
 * @package WordPress
 * @subpackage clas-exchange
 */

ns_print('page:taxonomy-connection-link.php');
global $ns_config, $ns_template_vars;

$ns_template_vars = array();
$ns_template_vars['content-type'] = 'listing';
$ns_template_vars['page-title'] = single_term_title( '', false );
$ns_template_vars['section'] = $ns_config->get_section( 'connection' );

ns_get_template_part( 'standard-template' );

