<?php
/*
Plugin Name: Climate Friendly Cart
Plugin URI: https://wordpress.org/plugins/climate-friendly-cart/
Description: We make sustainable business easy
Author: CarbonClick
Version: 1.2.96
Author URI: https://www.carbonclick.com/
*/

    // Preventing to direct access
    defined( 'ABSPATH' ) OR die( 'Direct access not acceptable!' );

    global $topup_currency_code, $wpdb;
    
    if ( ! defined( 'CFC_PLUGIN_FILE' ) ) {
        define( 'CFC_PLUGIN_FILE', __FILE__ );
    }
    
    require_once 'cfc-constant.php';
    
    // Load plugin with plugins_load
    function cfc_init() {
        require_once CFC_PLUGIN_PATH . 'includes/class-cfc-init.php';
        require_once CFC_PLUGIN_PATH . 'debug.php';
    }
    add_action( 'plugins_loaded', 'cfc_init', 20 );


    function cfc_registration_activation_init_callback(){
    	require_once CFC_PLUGIN_PATH . 'includes/class-registration-activation-init.php';
    }	
    register_activation_hook( __FILE__, 'cfc_registration_activation_init_callback' );

    /*
    *This is for testing purpose only. we will remove "cfc_registration_deactivation_init_callback" at the end. This functinality will be handle when plugin get uninstalled
    */
    function cfc_registration_deactivation_init_callback(){
        global $wpdb, $wp_version;
        
        require_once 'cfc-constant.php';

        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
        
        /*
        DELETE SHOP START HERE
        */
        $CFC_ACCESS_TOKEN       = $cfc_onboarding_status['stripe_data']['access_token'];

        $body = array(
                    "status"          => "deactivate"
                );

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".$CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/shops/status", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );


        $timestamp = wp_next_scheduled( 'cfc_cron_hook_1min' );
        wp_unschedule_event( $timestamp, 'cfc_cron_hook_1min' );

        $timestamp = wp_next_scheduled( 'cfc_cron_hook_5min' );
        wp_unschedule_event( $timestamp, 'cfc_cron_hook_5min' );

        $timestamp = wp_next_scheduled( 'cfc_cron_hook_hourly' );
        wp_unschedule_event( $timestamp, 'cfc_cron_hook_hourly' );

        $timestamp = wp_next_scheduled( 'cfc_cron_hook_weekly' );
        wp_unschedule_event( $timestamp, 'cfc_cron_hook_weekly' );


        /*DELETE SHOP END HERE*/

        /*
        *Delete all the option related to the carbon click plugin
        */

        //delete_option( 'cfc-onboarding-status' );
        //delete_option( 'cfc_settings_options' );
        //delete_option( 'cfc_look_and_feel_options' );
        //delete_option( 'cfc-global-notice' );
        //delete_option( 'cfc-charge-status' );
        //delete_option( 'cfc_carbonclick_config' );
        
        //delete_transient( 'cfc_carbonclick_api_expiration_check' );
        //delete_transient( 'cfc_carbonclick_api_impact_data_on_cart' );
        //delete_option( 'cfc_laravel_api_response_code' );
    }
    register_deactivation_hook( __FILE__, 'cfc_registration_deactivation_init_callback' );


    function cfc_upgrade_woo_callback( $upgrader_object, $options ) {

        $current_plugin_path_name = plugin_basename( __FILE__ );

        if ($options['action'] == 'update' && $options['type'] == 'plugin' ) {

            foreach($options['plugins'] as $each_plugin) {

                if ( $each_plugin==$current_plugin_path_name ) {
                 
                    if( class_exists('CFC_Carbonclick_Laravel_API')){

                        if( ! function_exists( 'get_plugin_data' ) ) {
                            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                        }
                        
                        $plugin_data = get_plugin_data( __FILE__ );

                        $shop_info = array(
                                'version' => $plugin_data['Version'],
                            );

                        $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();

                        $response = $CFC_Carbonclick_Laravel_API->cfc_update_shop_info( $shop_info );   
                    }
                }
            }
        }
    }
    add_action( 'upgrader_process_complete', 'cfc_upgrade_woo_callback',10, 2);
?>