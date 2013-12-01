<?php

//Require admin functions
(defined('WP_EXADMIN_FUNCTIONS')? include_once(WP_EXADMIN_FUNCTIONS) : false);

class g_Exclude {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu')); //Callback creazione Menu (*1)
		add_action( 'admin_init', array( $this, 'register_mysettings' )); //Callback salvataggio variabili (*2)
	}
	public function admin_menu () {
		add_options_page(WP_EXPLUGIN_NAME,WP_EXPLUGIN_NAME,'manage_options',WP_EXPLUGIN_URL,array($this, 'settings_page'));
	}
	public function register_mysettings() { //(*1) Salvataggio variabili
        global $tab;

	 	//(*3) SALVATAGGIO VARIABILI TRAMITE CALLBACK
		register_setting('g_Exclude_group', 'wp_ex_Opt', array($this, 'save_settings'));
        $this->populate_form($tab);
    }

    ## --- START - (*3) SALVATAGGIO VARIABILI TRAMITE CALLBACK -- ##
    #
    public function save_settings( $input ) {
        global $wpdb;
        $wp_ex_tb = $wpdb->prefix . WP_EXPLUGIN_DB_NAME;

        //$cks = has all id of checkboxes, then unset id of true checks
        $cks = array();
        foreach (explode(',', $_POST['wp_ex_ck_opts']) as $ck_id) {
            $cks[$ck_id] = $ck_id;
        }

        $update_on_array = array(); $update_on = ''; $update_off = '';
        foreach($input as $key => $value) {
            if(stristr($key, 'wp_ex_handle_') != false && $value == true) {
                $id = str_replace('wp_ex_handle_', '', $key);
                $update_on_array[] = $id;
                unset($cks[$id]);
            }
        }

        ## -- UPDATE STATUS 1 FOR TRUES CHECK -- ##
        if(count($update_on_array) > 0) {
            foreach ($update_on_array as $id) {
                $update_on .= " OR handle_id = '".$id."'";
            }
            $update_on = substr($update_on, 4);
            $wpdb->query("UPDATE $wp_ex_tb SET handle_status = '1', handle_update_time = '".current_time('mysql')."' WHERE ".$update_on);
        }
        ## END UPDATE STATUS 1 ##

        ## -- UPDATE STATUS 0 FOR $cks ARRAY -- ##
        if(count($cks) > 0) {
            foreach ($cks as $id) {
                $update_off .= " OR handle_id = '".$id."'";
            }
            $update_off = substr($update_off, 4);
            $wpdb->query("UPDATE $wp_ex_tb SET handle_status = '0', handle_update_time = '".current_time('mysql')."' WHERE ".$update_off);
        }
        ## END UPDATE STATUS 0 ##
    }
    #
    ## --- END - (*3) SALVATAGGIO VARIABILI TRAMITE CALLBACK -- ##

    ## --- START - (*4) AGGIUNTA DELLE FIELDS PER LA FORM + CREAZIONE TRAMITE CALLBACK -- ##
    #

    //Create field
    public function create_exclude_opt($h) {
        global $ck_opts_id;
        $ck_opts_id[] = $h['handle_id'];
        echo '<input type="checkbox" name="wp_ex_Opt[wp_ex_handle_'.$h['handle_id'].']" id="'.$h['handle_id'].'" '.(($h['handle_status'] == 1)? 'checked' : '').' value="test" /> ';
        echo '<label class="wp_ex_label" for="'.$h['handle_id'].'">'.basename($h['handle_name']).'</label>'.((!empty($h['handle_src']))? ' (<a target="_blank" href="'.$h['handle_src'].'" style="">link</a>)' : '');
    }

    #
    ## --- END - (*4) AGGIUNTA DELLE FIELDS PER LA FORM + CREAZIONE TRAMITE CALLBACK -- ##
    
    public function print_submit_button() {
        submit_button();
    }

    //Creazione degli elementi della form
    public function populate_form($tab) {
        global $conditionals;

        //Conditionals Page handle admin
        $type = wp_tab_to_handled_types($tab); $out = ''; $prefix = '_conditional';
        $handleds_conditionals  = wp_ex_conditionals_stored($type);
        if(count($handleds_conditionals) > 0) {
            foreach($handleds_conditionals as $conditional) {
                $this_conditional = wp_ex_stored($type, $template_filename, " AND handle_conditional_page = '".$conditional->handle_conditional_page."'");

                if(count($this_conditional) > 0) {
                    $conditional_url = wp_ex_get_conditionals_url(array($conditional->handle_conditional_page => 'conditional'));
                    $section = $conditionals[$conditional->handle_conditional_page].((!empty($conditional_url[0]))? ' <span class="wp_ex_min">(<a target="_blank" href="'.$conditional_url[0].'">'.$conditionals[$conditional->handle_conditional_page].' url</a>)</span>' : '');

                    //Add Section
                    add_settings_section(
                        $conditionals[$conditional->handle_conditional_page].$prefix,
                        $section,
                        '',
                        'wp_ex_Opt'
                    );

                    foreach($this_conditional as $h) {
                        $h_id = 'wp_ex_ck_'.$h->handle_id;

                        //Add Field
                        add_settings_field(
                            $h_id,
                            $this->handled_interprete_status($h),
                            array( $this, 'create_exclude_opt' ),
                            'wp_ex_Opt',
                            $conditionals[$conditional->handle_conditional_page].$prefix,
                            (array)$h
                        );
                    }

                    //Add Submit Button
                    add_settings_section(
                        $conditionals[$conditional->handle_conditional_page].'_submit',
                        '',
                        array( $this, 'print_submit_button'),
                        'wp_ex_Opt'
                    );
                }
            }
        }

        //Template Box handle admin
        $templates = get_page_templates(); $prefix = '_tmpl';
        foreach ( $templates as $template_name => $template_filename ) {
            $handleds_template = wp_ex_stored($type, $template_filename, " AND handle_conditional_page = ''");

            if(count($handleds_template) > 0) {
                //Detect template URL
                $tmpl_url = wp_ex_get_template_url(array($template_filename));
                $section = $template_name.' <span class="wp_ex_min">('.((!empty($tmpl_url[$template_filename]))? '<a target="_blank" href="'.$tmpl_url[$template_filename].'">'.$template_filename.'</a>' : $template_filename).')</span>';

                //Add Section
                add_settings_section(
                    $template_name.$prefix,
                    $section,
                    '',
                    'wp_ex_Opt'
                );

                foreach($handleds_template as $h) {
                    $h_id = 'wp_ex_ck_'.$h->handle_id;

                    //Add Field
                    add_settings_field(
                        $h_id,
                        $this->handled_interprete_status($h),
                        array( $this, 'create_exclude_opt' ),
                        'wp_ex_Opt',
                        $template_name.$prefix,
                        (array)$h
                    );
                }

                //Add Submit Button
                add_settings_section(
                    $template_name.'_submit',
                    '',
                    array( $this, 'print_submit_button'),
                    'wp_ex_Opt'
                );
            }
        }
    }

	//Creazione della form + input type submit (form submit -> option.php see /options.php to see all your WP options saved)
	public function settings_page () {
        global $tab, $ck_opts_id;

        //Check if last update > 1 day
        $last_sync = get_option(WP_EXDATE_LAST_SYNC);
        if(!empty($last_sync)) {
            $dt = new DateTime($last_sync);
            $dt2 = new DateTime(current_time('mysql'));
            $last_sync_date = $dt->format('Y-m-d');
            $now_date = $dt2->format('Y-m-d');
        }

        //Controllo se bisogna resyncronizzare gli handle
        if($_GET['refresh'] == 'true' || (!empty($last_sync_date) && $last_sync_date != $now_date) || get_option(WP_EXFIRST_SCAN) == 'true') {
            spider_handle_detection();
        }

        //Controllo se bisogna resettare il plugin
        if($_GET['reset'] == 'true') {
            wp_ex_reset_plugin();
        }

        //Cambio l'abilitazione del Detect Navigation
        if($_GET['detect'] == 'change') {
            wp_ex_change_navigation_detect();
        }

        ?>
		<div class="wrap">
		    <h2><?php echo WP_EXPLUGIN_NAME ?></h2>
            <?php
                //Creazione delle tabs
                $current = ((empty($_GET['tab']))? 'css' : $_GET['tab']);
                $tabs = array('css' => 'Styles', 'js' => 'Scripts' );
                screen_icon('options-general');
                echo '<h2 class="nav-tab-wrapper">';
                foreach( $tabs as $tab => $name ){
                    $class = ( $tab == $current ) ? ' nav-tab-active' : '';
                    echo "<a class='nav-tab$class' href='?page=".WP_EXPLUGIN_URL."&tab=$tab'>$name</a>";
                }
                echo '</h2>';
                $tab = $current;
            ?>
            <table id="wp_ex_wrap" style="width: 100%; margin-top: 9px;">
                <tr>
                <td valign="top" style="padding-right: 5px;">
                    <?php (defined('WP_EXEXPLAIN_TOP')? include_once(WP_EXEXPLAIN_TOP) : false); ?>
                    <?php (defined('WP_EXEXPLAIN_TOP')? include_once(WP_EXREFRESH_EXPLAIN_TOP) : false); ?>
        		    <form id="wp_ex_form" method="post" action="options.php">
        		        <?php
                            settings_fields( 'g_Exclude_group' );
                            do_settings_sections( 'wp_ex_Opt' );
                        ?>
                        <input type="hidden" name="wp_ex_ck_opts" value="<?php echo implode(',', $ck_opts_id); ?>">
        		    </form>
                </td>
                <td valign="top" style="width: 300px">
                    <?php (defined('WP_EXEXPLAIN_TD')? include_once(WP_EXEXPLAIN_TD) : false); ?>
                </td>
                </tr>
            </table>
		</div>
		<?php
	}

    public function handled_interprete_status($handle) {
        $status = '';
        if($handle->handle_status == 1 && $handle->handle_visible != 0) {
            $status .= '<span class="wp_ex_status_active">[Active]</span>';
        } else if($handle->handle_status == 0) {
            $status .= '<span class="wp_ex_status_disabled">[Disabled]</span>';
        }
        if($handle->handle_visible == 0) {
            $status .= '<span class="wp_ex_status_old">[Probably OLD]</span>';
        }
        return $status;
    }
}