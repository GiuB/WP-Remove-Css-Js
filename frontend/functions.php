<?php
/*
 * WP Exclude Css-Js - Frontend Functions
 */

function wp_ex_register_frontend_tmpl() {
    global $tmp_template;
    $tmp_basename = basename(get_page_template());
    $tmp_template = ((!empty($tmp_basename))? basename(get_page_template()) : $tmp_template);
}

//Check conditionals
function wp_ex_is_conditionals() {
    global $conditionals, $post;

    foreach($conditionals as $func => $f_name) {
        if($func()) {
            return $func;
        }
    }
    return null;
}

function wp_ex_frontend_deregister_styles() {
    global $tmp_template;
	wp_ex_sync_handle('style');
	$deregister_styles = wp_ex_deregister_stored('style', $tmp_template);
	foreach($deregister_styles as $handle) {
		wp_deregister_style($handle);
	}
}

function wp_ex_frontend_deregister_script() {
    global $tmp_template;
	wp_ex_sync_handle('script');
	$deregister_script = wp_ex_deregister_stored('script', $tmp_template);
	foreach($deregister_script as $handle) {
		wp_deregister_script($handle);
	}
}

//Find handle urls on frontend
function wp_ex_find_handled_src() {
    global $wp_scripts, $wp_styles, $wp_ex_frontend_handled, $tmp_template;

    if(!empty($tmp_template)) {
        //Scripts
        foreach ($wp_scripts->registered as $registered) {
            if(in_array($registered->handle, $wp_scripts->queue)) { //removed: !$wp_scripts->in_default_dir($registered->src)
                $wp_ex_frontend_handled[$tmp_template]['script'][] = array($registered->handle => $registered->src);
            }
        }

        //Styles
        foreach ($wp_styles->registered as $registered) {
            if(in_array($registered->handle, $wp_styles->queue)) { //removed: !$wp_scripts->in_default_dir($registered->src)
                $wp_ex_frontend_handled[$tmp_template]['style'][] = array($registered->handle => $registered->src);
            }
        }

        //Store src in DB
        wp_ex_register_handled_src($wp_ex_frontend_handled[$tmp_template], $tmp_template);
    }
}

//Prepare update handle urls
function wp_ex_register_handled_src($handleds, $template) {
    global $wp_handled_types;
    $h_stored = array();

    //Update template pages
    foreach($wp_handled_types as $type => $value) {
        $h_stored = wp_ex_stored($type, $template, " AND handle_conditional_page = ''");
        foreach($h_stored as $stored) {
            foreach($handleds[$type] as $value) {
                foreach($value as $h_name => $src) {
                    if($stored->handle_name == $h_name && ($stored->handle_src != $src)) {
                        wp_ex_stored_update_src($stored, $src);
                    }
                }
            }
        }
    }

    //Update conditional pages
    foreach($wp_handled_types as $type => $value) {
        $conditional = wp_ex_conditionals();
        $h_stored = wp_ex_stored($type, $template, " AND handle_conditional_page = '".$conditional."'");
        foreach($h_stored as $stored) {
            foreach($handleds[$type] as $value) {
                foreach($value as $h_name => $src) {
                    if($stored->handle_name == $h_name && ($stored->handle_src != $src || $stored->handle_conditional_page != wp_ex_conditionals())) {
                        wp_ex_stored_update_src($stored, $src);
                    }
                }
            }
        }
    }
}

//Store updated urls in DB
function wp_ex_stored_update_src($handle, $src) {
    global $wpdb;
    $wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

    $wpdb->query("UPDATE $wp_ex_tb SET handle_src = '$src', handle_update_time = '".current_time('mysql')."', handle_conditional_page = '".wp_ex_conditionals()."' WHERE handle_id = '$handle->handle_id'");
}

function wp_ex_sign() {
	echo '<!-- '.WP_EXSIGN.' -->';
}
