<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CFC_Admin_Enqueue_Scripts class responsable to load all the scripts and styles.
 */
class CFC_Admin_Enqueue_Scripts {

    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'admin_head', array( $this, 'admin_internal_css' ) );
    }

    public function admin_enqueue_scripts( $hook ) {
        if ( $this->is_cfc_admin_page( $hook ) !== true ) {
            return;
        }
        
        // Load thickbox
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');

        // Add the color picker css file   
        wp_enqueue_script( 'wp-color-picker' ); 
        wp_enqueue_style( 'wp-color-picker' ); 
        
        // Load admin scripts
        wp_enqueue_style( 'cfc-jquery-ui', 'https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css', array(), CFC_PLUGIN_VER );

        wp_enqueue_style( 'cfc-admin-style', CFC_PLUGIN_URL . 'assets/css/cfc-admin-style.css', array(), CFC_PLUGIN_VER );
        wp_enqueue_script( 'cfc-admin-script', CFC_PLUGIN_URL . 'assets/js/cfc-admin-script.js', array(), CFC_PLUGIN_VER, true );
        wp_localize_script( 'cfc-admin-script', 'cfcAdminObj', array(
            'admin_url'          => admin_url( 'admin-ajax.php?ver=' . uniqid() ),
            'look_and_feel_path' => CFC_PLUGIN_URL."assets/images/look-and-feel/",
        ) );

        wp_enqueue_script( 'cfc-stripe-js', 'https://js.stripe.com/v3/', array(), CFC_PLUGIN_VER );
    }


    public function admin_internal_css() {
        echo '<style>
            #adminmenu li.toplevel_page_cfc-dashboard .wp-menu-image img {
                height: 25px;
                padding: 5px;
            }
        </style>';
    }

    /**
     * Check current admin page is plugin admin page or not.
     * @param  string  $hook
     * @return boolean
     */
    public function is_cfc_admin_page( $hook ) {

        if ( $hook == 'toplevel_page_cfc-dashboard' ) {
            return true;
        }

        return false;
    }

} // end of class CFC_Admin_Enqueue_Scripts

$cfc_admin_enqueue_scripts = new CFC_Admin_Enqueue_Scripts;