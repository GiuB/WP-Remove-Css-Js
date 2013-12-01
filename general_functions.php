<?php
/*
 * WP Exclude Css-Js - General Functions
 */

function wp_tab_to_handled_types($tab) {
	$wp_tab_to_handled = array('css' => 'style', 'js' => 'script');
	return $wp_tab_to_handled[$tab];
}

function wp_ex_sync_handle($type) {
	global $styles, $wp_styles, $wp_script;

	if(count($wp_styles->queue) > 0 && get_option(WP_EXFRONTEND_SPIDERS) == 'true') {
		wp_ex_handle_db_sync($type);
	}
}

function wp_ex_prepare_insert($handler, $type) {
	global $wp_scripts;

	$construct_handlers = array();
	if(strlen(get_page_template()) > 0) {
		foreach($handler as $h) {
			$conditional = wp_ex_conditionals();
			$wp_scripts->get_data( $handle, 'data' );
			$construct_handlers[] = array(
				'handle_type' => $type,
				'handle_name' => $h,
				'handle_src'  => '',
				'handle_template' => basename(get_page_template()),
				'handle_conditional_page' => $conditional,
				'handle_status' => 1,
				'handle_visible' => 1,
				'handle_insert_time' => current_time('mysql'),
				'handle_update_time' => current_time('mysql')
			);
		}
	}
	return $construct_handlers;
}

function wp_ex_insert($handle) {
	global $wpdb;
	$wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

	foreach($handle as $h) {
		$wpdb->insert( $wp_ex_tb, $h );
	}
}

function wp_ex_stored($type, $template = '', $exception = '') {
	global $wpdb;
	$wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME; $tmpl_exception = '';

	if(!empty($template)) {
		$tmpl_exception = " AND handle_template = '".$template."'";
	}

	$handled = $wpdb->get_results("SELECT * FROM $wp_ex_tb WHERE handle_type = '$type'".$tmpl_exception.$exception);

	return $handled;
}

function wp_ex_conditionals_stored($type) {
	global $wpdb;
	$wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

	$handled = $wpdb->get_results("SELECT handle_conditional_page FROM $wp_ex_tb WHERE handle_type = '$type' AND handle_conditional_page != '' GROUP BY handle_conditional_page");

	return $handled;
}

function wp_ex_stored_update_visible($update_handled, $visible = '1') {
	global $wpdb;
	$wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

	foreach($update_handled as $handle) {
		$wpdb->query("UPDATE $wp_ex_tb SET handle_visible = '$visible', handle_update_time = '".current_time('mysql')."' WHERE handle_id = '$handle->handle_id'");
	}
}

function wp_ex_deregister_stored($type, $template) {
	global $wpdb, $tmp_template;

	$tmp_template = $template;
	$wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

	//Check Conditionals
	$cond = wp_ex_is_conditionals();
	if(!empty($cond)) {
		$cond = " AND handle_conditional_page = '".$cond."'";
	}

	$handled = $wpdb->get_results("SELECT * FROM $wp_ex_tb WHERE handle_type = '$type' AND handle_template = '".$template."' AND handle_status = 0 ".$cond);
	return $handled;
}

function wp_ex_conditionals($return_type = 'function_name') {
	global $conditionals;

	//Return like $conditionals keys
	foreach($conditionals as $func => $name) {
		$function = $func;
		if(function_exists($function) && $function()) {
			if($return_type == 'function_name') { return $func; }
			else { return $conditionals[$func]; }
		}
	}
	return '';
}

function wp_ex_handle_db_sync($type = 'style') {
	global $styles, $wp_styles, $wp_scripts, $wp_handled_types, $wpdb;

	//Major variables
	$wp_ex_preapre_sync = array(); $handle_toInsert = array(); $handle_toNotVisible = array(); $handle_toVisible = array();
	$template = basename(get_page_template());

	wp_ex_conditionals();

	if(!empty($template)) {
		foreach($wp_handled_types as $handled_type => $handled) {
			if($handled_type == 'style' && $type == 'style')
				$wp_ex_preapre_sync[$handled_type] = $wp_styles->queue;
			else if($handled_type == 'script' && $type == 'script')
				$wp_ex_preapre_sync[$handled_type] = $wp_scripts->queue;
		}

		$handle = wp_ex_prepare_insert($wp_ex_preapre_sync[$type], $type);
		$handled = wp_ex_stored($type, $template);

		//Check handle not stored
		foreach($handle as $h) {
			$can_insert = true;
			foreach($handled as $obj) {
				if($h['handle_name'] == $obj->handle_name && $h['handle_conditional_page'] == $obj->handle_conditional_page) {
					$can_insert = false;
				}
			}
			if($can_insert) {
				$handle_toInsert[] = $h;
			}
		}
		wp_ex_insert($handle_toInsert); //Insert handle

		//Check deleted / reactivated handle type from template
		foreach($handled as $obj) {
			$not_visible = true;
			foreach($handle as $h) {
				if($h['handle_name'] == $obj->handle_name) {
					$not_visible = false;
				}
			}

			//Check deted
			if($not_visible && $obj->handle_visible == 1) {
				$handle_toNotVisible[] = $obj;
			}

			//Check reativated
			if(!$not_visible && $obj->handle_visible == 0) {
				$handle_toVisible[] = $obj;
			}
		}
		wp_ex_stored_update_visible($handle_toNotVisible, '0');
		wp_ex_stored_update_visible($handle_toVisible, '1');
	}
}
