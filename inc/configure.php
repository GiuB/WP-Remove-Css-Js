<?php
/*
 * Configuration List
 */

$wp_ex = 'WP_EX';
define($wp_ex.'PLUGIN_PATH', 'wp-remove-css-js');
define($wp_ex.'PLUGIN_NAME', 'WP Remove Css-Js');
define($wp_ex.'PLUGIN_URL', 'wperemove');
define($wp_ex.'PLUGIN_VERSION', '1.0');
define($wp_ex.'PLUGIN_VERSION_KEY', 'wp_ex35i9jvf90al404');
define($wp_ex.'PLUGIN_DB_NAME', 'remove_handled');
define($wp_ex.'PLUGIN_WP_URL', 'http://github.com/GiuB/WP-Remove-Css-Js');
define($wp_ex.'PLUGIN_WP_URL_INSTALL', '#');
define($wp_ex.'PLUGIN_WP_URL_FAQ', '#');
define($wp_ex.'GENERAL_FUNCTIONS', WP_EXBASE.'/general_functions.php');
define($wp_ex.'ADMIN_PATH', WP_EXBASE.'/admin');
define($wp_ex.'FRONTEND_PATH', WP_EXBASE.'/frontend');
define($wp_ex.'AUTHOR_NAME', 'Daniele');
define($wp_ex.'AUTHOR_SURNAME', 'Covallero');
define($wp_ex.'AUTHOR_FULLNAME', WP_EXAUTHOR_NAME.' '.WP_EXAUTHOR_SURNAME);
define($wp_ex.'AUTHOR_SITE_NAME', 'giub.it');
define($wp_ex.'AUTHOR_SITE_URL', 'http://giub.it');
define($wp_ex.'AUTHOR_TWITTER', 'http://twitter.com/Giub_bass');
define($wp_ex.'GITHUB_URL', '#');
define($wp_ex.'THANKYOU_TWEET', 'http://twitter.com/intent/tweet?text=Thanks+%40Giub_bass+to+help+me+speed+up+my+%23Wordpress+with+%23WP-Remove-Css-Js');
define($wp_ex.'GRAZIE_TWEET', 'http://twitter.com/intent/tweet?text=Grazie+%40GiuB_bass+per+aver+velocizzato+il+mio+%23Wordpress+con+%23WP-Remove-Css-Js');
define($wp_ex.'SIGN', 'site performed by: '.WP_EXPLUGIN_NAME.((strlen(WP_EXPLUGIN_WP_URL) > 1)? ' see: '.WP_EXPLUGIN_WP_URL : '').((defined('WP_EXAUTHOR_SITE_URL'))? ' | Author: '.WP_EXAUTHOR_SITE_URL : ''));

/* Admin File names */
define($wp_ex.'ADMIN_CLASS', WP_EXADMIN_PATH.'/g_exclude.php');
define($wp_ex.'ADMIN_FUNCTIONS', WP_EXADMIN_PATH.'/functions.php');
define($wp_ex.'EXPLAIN_TD', WP_EXADMIN_PATH.'/right_explain.php');
define($wp_ex.'EXPLAIN_TOP', WP_EXADMIN_PATH.'/top_explain.php');
define($wp_ex.'REFRESH_EXPLAIN_TOP', WP_EXADMIN_PATH.'/top_refresh_explain.php');

/* Frontend File names */
define($wp_ex.'FRONTEND_APPLICATION', WP_EXFRONTEND_PATH.'/application.php');
define($wp_ex.'FRONTEND_FUNCTIONS', WP_EXFRONTEND_PATH.'/functions.php');

/* Images / Css / Js */
define($wp_ex.'CSS', plugins_url(WP_EXPLUGIN_PATH).'/inc/style.css');
define($wp_ex.'JS', plugins_url(WP_EXPLUGIN_PATH).'/inc/all.js');
define($wp_ex.'REFRESH_PNG', plugins_url(WP_EXPLUGIN_PATH).'/inc/reload.png');
define($wp_ex.'NAGIGATION_ENABLE', plugins_url(WP_EXPLUGIN_PATH).'/inc/switch-enabled.png');
define($wp_ex.'NERD_BEER', plugins_url(WP_EXPLUGIN_PATH).'/inc/nerd-beer.png');
define($wp_ex.'DELETE_ICO', plugins_url(WP_EXPLUGIN_PATH).'/inc/delete-ico.png');

/* Wp Options */
define($wp_ex.'FRONTEND_SPIDERS', 'wp_ex_opt_frontend_spider');
define($wp_ex.'DATE_LAST_SYNC', 'wp_ex_opt_date_last_sync');
define($wp_ex.'FIRST_SCAN', 'wp_ex_opt_first_scan');
define($wp_ex.'NAVIGATION_DETECT', 'wp_ex_opt_navigation_detect');
define($wp_ex.'NAVIGATION_DETECT', 'wp_ex_opt_navigation_detect');

/* Codex wp_register URLS */
define($wp_ex.'CODEX_URL_REGISTER_STYLE', 'http://codex.wordpress.org/Function_Reference/wp_register_style');
define($wp_ex.'CODEX_URL_ENQUEUE_STYLE', 'http://codex.wordpress.org/Function_Reference/wp_enqueue_style');
define($wp_ex.'CODEX_URL_REGISTER_SCRIPT', 'http://codex.wordpress.org/Function_Reference/wp_register_script');
define($wp_ex.'CODEX_URL_ENQUEUE_SCRIPT', 'http://codex.wordpress.org/Function_Reference/wp_enqueue_script');

?>
