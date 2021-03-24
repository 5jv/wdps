<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CFC_Init class responsable to load all the scripts and styles.
 */
class CFC_Init {

    public function __construct() {
        $this->init_hooks();
        $this->includes();
    }

    public function init_hooks() {
        // Plugin page setting link on "Install plugin page"
        add_action( 'admin_head', array( $this, 'hotjar_tracker_callback' ) );
        add_filter( 'plugin_action_links_'.plugin_basename( CFC_PLUGIN_FILE ), array( $this, 'plugin_page_settings_link' ) );
        //add_action( 'init', array( $this, 'check_charge_status_callback' ) );
    }

    /*
    *Hotjar tracking code on admin dashboard and frontend
    */
    public function hotjar_tracker_callback(){
        if( is_admin() ){
            if(isset($_GET['page']) && $_GET['page'] == "cfc-dashboard"){
                ?>
                <!-- Hotjar Tracking Code for https://woo.carbon.click -->
                <script>
                    (function(h,o,t,j,a,r){
                        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                        h._hjSettings={hjid:2159205,hjsv:6};
                        a=o.getElementsByTagName('head')[0];
                        r=o.createElement('script');r.async=1;
                        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                        a.appendChild(r);
                    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
                </script>
                <?php
            }
        }
    }

    /**
    * Includes plugin files.
    */
    public function includes() {
        require_once CFC_PLUGIN_PATH . 'includes/api/class-cfc-laravel-api.php';
        require_once CFC_PLUGIN_PATH . 'includes/class-cfc-enqueue-scripts.php';
        require_once CFC_PLUGIN_PATH . 'includes/woo/class-cfc-woo-init.php';
        require_once CFC_PLUGIN_PATH . 'includes/woo/class-cfc-woo-retry-mechanism-init.php';
        require_once CFC_PLUGIN_PATH . 'includes/class-cfc-rewards-endpoint.php';
        
        if ( ! is_admin() ) {
            $cfc_settings_options   = get_option( 'cfc_settings_options' );
            $enable_widget          = $cfc_settings_options['cfc_enable_widget_on_cart'];
            $cfc_widget_location_on_mini_cart = $cfc_settings_options['cfc_widget_location_on_mini_cart'];
            
            if( $enable_widget && $cfc_widget_location_on_mini_cart ){
                require_once CFC_PLUGIN_PATH . 'includes/woo/avada-functions-override.php';
            }    
        }
        
        // Admin classes
        if ( is_admin() ) {
            require_once CFC_PLUGIN_PATH . 'includes/admin/class-cfc-admin-enqueue-scripts.php';
            require_once CFC_PLUGIN_PATH . 'includes/admin/class-cfc-admin-init.php';
            require_once CFC_PLUGIN_PATH . 'includes/admin/class-cfc-admin-save-settings.php';
        }
    }
    
    /**
    * Adding a Settings link to plugin
    */
    public function plugin_page_settings_link( $links ) {
        $links[] = '<a href="' . admin_url( 'admin.php?page=cfc-dashboard' ) .'">' . esc_html__( 'Settings' ) . '</a>';
        return $links;
    }

    /*
    * This function is used to check the stripe charge status. It the stripe charge status is fail then disable the widget
    */
    public function check_charge_status_callback(){

        /*if charge status is failed, disable the widget on load*/
        $cfc_charge_status = get_option( 'cfc-charge-status' );
        if($cfc_charge_status != "paid"){

            $cfc_settings = get_option( 'cfc_settings_options' );
            $cfc_settings['cfc_enable_widget_on_cart']  = 0;
            update_option( 'cfc_settings_options', $cfc_settings );

        }
    }
} // end of class CFC_Init

$cfc_init = new CFC_Init;