<?php
/*
 * WP Exclude css-js - Admin Functions
 */

global $tab, $ck_opts_id, $this_conditional, $section_id;
$ck_opts_id = array();
$tab = ((empty($_GET['tab']))? 'css' : $_GET['tab']);

function wp_ex_codex_references($tab) {
    switch($tab) {
        case 'css': echo '<a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_REGISTER_STYLE.'">wp_register_style()</a>, <a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_ENQUEUE_STYLE.'">wp_enqueue_style()</a>'; break;
        case 'js': echo '<a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_REGISTER_SCRIPT.'">wp_register_script()</a>, <a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_ENQUEUE_SCRIPT.'">wp_enqueue_script()</a>'; break;
        default: echo '<a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_REGISTER_STYLE.'">wp_register_style()</a>, <a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_ENQUEUE_STYLE.'">wp_enqueue_style()</a>, <a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_REGISTER_SCRIPT.'">wp_register_script()</a>, <a target="_blank" style="color: #D54E21;" href="'.WP_EXCODEX_URL_ENQUEUE_SCRIPT.'">wp_enqueue_script()</a>)'; break;
    }
}

//Setting plugin URL to page
function wp_ex_add_settings_link( $links ) {
    $settings_link = sprintf( '<a href="options-general.php?page=%s">%s</a>', WP_EXPLUGIN_URL, __('Settings') );
    array_unshift($links, $settings_link);
    return $links;
}

//Check status plugin
function wp_ex_version_check() {
    if(!get_option(WP_EXPLUGIN_VERSION_KEY) && defined('WP_EXPLUGIN_VERSION_KEY')) {
        wp_ex_install();
    }
    else if(defined('WP_EXPLUGIN_VERSION_KEY') && strlen(WP_EXPLUGIN_VERSION_KEY) > 0) {
        if (get_option(WP_EXPLUGIN_VERSION_KEY) != $new_version) {
            update_option(WP_EXPLUGIN_VERSION_KEY, $new_version);
        }
    }
}

//Spider refresh handled
function refresh_handled($urls = array()) {
    try {
        foreach($urls as $tpl_name => $url) {
            file_get_contents($url);
        }
    } catch (Exception $e) { }
}

//Get template url
function wp_ex_get_template_url($templates = array()) {
    global $post;

    $urls = array();
    foreach ( $templates as $template_name => $template_filename ) {
        if(!empty($template_filename)) {
            $tmpl_args = array(
                'post_type'  => 'any',
                'meta_query' => array(
                    array(
                        'key'   => '_wp_page_template',
                        'value' => $template_filename
                    )
                ),
                'post_status' => array('publish'),
                'posts_per_page' => 1
            );
            $tmpl = new WP_Query($tmpl_args);

            if ($tmpl->have_posts()) {
                while ($tmpl->have_posts()) : $tmpl->the_post();
                    $urls[$template_filename] = get_permalink($post->ID);
                endwhile;
            }
            wp_reset_postdata();
        }
    }
    return $urls;
}

//Get conditionals url
function wp_ex_get_conditionals_url($conditionals_page = array()) {
    global $conditionals, $wp_query, $post;
    $urls = array();

    $conditionals_page = $conditionals;
    foreach($conditionals_page as $func => $f_name) {
        switch($func) {
            case 'is_front_page':
                $urls[] = get_home_url();
                break;
            case 'is_tag':
                $tags = get_tags();
                foreach ( $tags as $tag ) {
                    $tag_link = get_tag_link( $tag->term_id );
                    break;
                }
                $urls[] = $tag_link;
                break;
            case 'is_single':
                $args = array(
                    'post_type'  => 'any',
                    'post_status' => array('publish'),
                    'posts_per_page' => 1
                );
                $post_page = new WP_Query($args);

                if ($post_page->have_posts()) {
                    while ($post_page->have_posts()) : $post_page->the_post();
                        $urls[] = get_permalink($post->ID);
                    endwhile;
                }
                wp_reset_postdata();
                break;
        }
    }
    return $urls;
}

//Spider detect frontend handle
function spider_handle_detection() {
    update_option(WP_EXFRONTEND_SPIDERS, 'true');

    $templates = get_page_templates();

    //Detect frontend conditionals url
    $urls_cond = wp_ex_get_conditionals_url();

    //Detect frontend template url
    $urls_tpl = wp_ex_get_template_url($templates);

    $urls = array_merge($urls_cond, $urls_tpl);

    //Start Spider detection
    refresh_handled($urls);

    //Refresh last sync date
    update_option(WP_EXDATE_LAST_SYNC, current_time('mysql'));
    update_option(WP_EXFIRST_SCAN, 'false');

    //Redirect & Refresh list page
    wp_ex_plugin_redirect_home();

    if(get_option(WP_EXNAVIGATION_DETECT) == 'false') {
        update_option(WP_EXFRONTEND_SPIDERS, 'false');
    }
}

function wp_ex_change_navigation_detect() {
    if(get_option(WP_EXNAVIGATION_DETECT) == 'false') {
        update_option(WP_EXNAVIGATION_DETECT, 'true');
        update_option(WP_EXFRONTEND_SPIDERS, 'true');
    } else {
        update_option(WP_EXNAVIGATION_DETECT, 'false');
        update_option(WP_EXFRONTEND_SPIDERS, 'false');
    }

    //Redirect & Refresh list page
    wp_ex_plugin_redirect_home();
}

function wp_ex_plugin_redirect_home() {

    //Redirect & Refresh list page
    $redirect = admin_url('/options-general.php?page='.WP_EXPLUGIN_URL.'&tab='.((!empty($_GET['tab']))? $_GET['tab'] : 'css'), 'http');
    if(!empty($redirect)) { ?>
    <script>
        window.location.replace('<?php echo $redirect; ?>');
    </script>
    <?php }
}

function wp_ex_reset_plugin() {
    global $wpdb;

    $wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

    if(!$wpdb->query("TRUNCATE TABLE $wp_ex_tb")){
        $wpdb->query("DELETE FROM $wp_ex_tb");
    }

    //Redirect & Refresh list page
    wp_ex_plugin_redirect_home();
}

//Install DB
function wp_ex_install() {
    global $wpdb;
    $installed_ver = get_option(WP_EXPLUGIN_VERSION_KEY);
    $table_name = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

    $sql = "CREATE TABLE $table_name (
        handle_id mediumint(9) NOT NULL AUTO_INCREMENT,
        handle_type VARCHAR(32) NOT NULL,
        handle_name tinytext NOT NULL,
        handle_template VARCHAR(100) NOT NULL,
        handle_conditional_page VARCHAR(100) NOT NULL,
        handle_src VARCHAR(2000) NOT NULL,
        handle_status mediumint(2) DEFAULT 1,
        handle_visible mediumint(2) DEFAULT 1,
        handle_insert_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        handle_update_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        UNIQUE KEY handle_id (handle_id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option('wp_ex_show', 'show_all');
    if(defined('WP_EXPLUGIN_VERSION_KEY') && strlen(WP_EXPLUGIN_VERSION_KEY) > 0 && defined('WP_EXPLUGIN_VERSION') || (get_option(WP_EXPLUGIN_VERSION_KEY) != WP_EXPLUGIN_VERSION))
        update_option(WP_EXPLUGIN_VERSION_KEY, WP_EXPLUGIN_VERSION) || add_option(WP_EXPLUGIN_VERSION_KEY, WP_EXPLUGIN_VERSION);

    //Add Wp_opt spider detection
    update_option(WP_EXFRONTEND_SPIDERS, 'false') || add_option(WP_EXFRONTEND_SPIDERS, 'false');

    //Add Wp-opt date last detection for automatic sync
    update_option(WP_EXDATE_LAST_SYNC, current_time( 'mysql' )) || add_option(WP_EXDATE_LAST_SYNC, current_time( 'mysql' ));

    //Add Wp-opt date install for first auto sync
    update_option(WP_EXFIRST_SCAN, 'true') || add_option(WP_EXFIRST_SCAN, 'true');

    //Add Wp-opt enable navigation detecting
    update_option(WP_EXNAVIGATION_DETECT, 'false') || add_option(WP_EXNAVIGATION_DETECT, 'false');
}

//Include Css
wp_register_style(WP_EXPLUGIN_NAME, WP_EXCSS);
wp_enqueue_style(WP_EXPLUGIN_NAME);

//Include Js
wp_register_script(WP_EXPLUGIN_NAME, WP_EXJS);
wp_enqueue_script(WP_EXPLUGIN_NAME);

