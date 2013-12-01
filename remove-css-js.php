<?php
/*
Plugin Name: WP Remove Css-Js
Plugin URI: giub.it
Description: Remove styles and javascript from your template pages
Author: Daniele Covallero
Author URI: giub.it
Version: 1.0

WP Remove Css-Js Plugin
Copyright (C) 2013, Daniele Covallero - web@giub.it

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Doesn't work if PHP version is not 4.0.6 or higher
 */
if (version_compare(phpversion(), '4.0.6', '<')) {
  return;
}

global $wp_scripts, $wp_styles, $wp_handled_types, $wp_ex_frontend_handled, $tmp_template, $conditionals;
$wp_handled_types = array('style' => '', 'script' => '');
$wp_ex_plugin = plugin_basename( __FILE__ );
$conditionals = array('is_front_page' => 'Front Page', 'is_tag' => 'Archive Page', 'is_single' => 'Post Page');

define('WP_EXBASE', dirname(__FILE__));
include_once(WP_EXBASE.'/inc/configure.php');
defined('WP_EXGENERAL_FUNCTIONS')? include_once(WP_EXGENERAL_FUNCTIONS) : false;

register_activation_hook( __FILE__, 'wp_ex_install' );
register_activation_hook( __FILE__, 'wp_ex_version_check' );

//Esecuzione solo per test
if(!is_admin() && defined('WP_EXFRONTEND_APPLICATION')) {
    include_once(WP_EXFRONTEND_APPLICATION);
} else if(is_admin() && defined('WP_EXADMIN_CLASS')) {
    include_once(WP_EXADMIN_CLASS);
    $g_exclude = new g_Exclude;
}

//Add Settings link to plugin page
add_filter( "plugin_action_links_$wp_ex_plugin", 'wp_ex_add_settings_link' );