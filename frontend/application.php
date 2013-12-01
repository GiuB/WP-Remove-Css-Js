<?php
/*
 * WP Exclude Css-Js - Fontend sequence
 */

//Require general frontend functions
(defined('WP_EXFRONTEND_FUNCTIONS')? include_once(WP_EXFRONTEND_FUNCTIONS) : false);

global $styles, $wp_scripts, $wp_styles;
$styles = array();

if(function_exists('wp_ex_register_frontend_tmpl')) {
	add_action('wp_print_styles', 'wp_ex_register_frontend_tmpl', 10);
	add_action('wp_print_scripts', 'wp_ex_register_frontend_tmpl', 10);
}

if(function_exists('wp_ex_frontend_deregister_styles')) {
	add_action('wp_print_styles', 'wp_ex_frontend_deregister_styles', 100);
}

if(function_exists('wp_ex_frontend_deregister_script')) {
	add_action('wp_print_scripts', 'wp_ex_frontend_deregister_script', 100);
}

if(function_exists('wp_ex_find_handled_src')) {
	add_action('wp_head', 'wp_ex_find_handled_src');
	add_action('wp_footer', 'wp_ex_find_handled_src');
}

if(function_exists('wp_ex_sign')) {
	add_action('wp_footer', 'wp_ex_sign');
}