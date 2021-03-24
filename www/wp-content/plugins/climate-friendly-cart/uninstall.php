<?php
    /**
    * CarbonClick Uninstall
    *
    */

    // if uninstall.php is not called by WordPress, die
    if (!defined('WP_UNINSTALL_PLUGIN')) {
        die;
    }
    
    global $wpdb, $wp_version;
    
    require_once 'cfc-constant.php';

    function cfc_uninstall_callback(){
        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
    
        /*
        DELETE SHOP START HERE
        */
        $CFC_ACCESS_TOKEN       = $cfc_onboarding_status['stripe_data']['access_token'];

        $body = array(
                        "status"          => "uninstall"
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
        /*DELETE SHOP END HERE*/

        /*
        *Delete all the option related to the carbon click plugin
        */
        delete_option( 'cfc-onboarding-status' );
        delete_option( 'cfc_settings_options' );
        delete_option( 'cfc_look_and_feel_options' );
        delete_option( 'cfc-global-notice' );
        delete_option( 'cfc-charge-status' );
        delete_option( 'cfc_carbonclick_config' );
        delete_transient( 'cfc_carbonclick_api_expiration_check' );
        delete_transient( 'cfc_carbonclick_api_impact_data_on_cart' );
        delete_option( 'cfc_laravel_api_response_code' );
    }

    if(is_multisite()){
        $site_ids = get_site_transient( 'wordpoints_all_site_ids' );

        if ( ! $site_ids ) {

            global $wpdb;

            $site_ids = $wpdb->get_col(
                "
                    SELECT `blog_id`
                    FROM `{$wpdb->blogs}`
                    WHERE `site_id` = {$wpdb->siteid}
                "
            ); // WPCS: cache OK.

            set_site_transient( 'wordpoints_all_site_ids', $site_ids, 2 * MINUTE_IN_SECONDS );
        }

        foreach ($site_ids as $key => $site_id) {
            switch_to_blog( $site_id );
                
                cfc_uninstall_callback();

            restore_current_blog();
        }
    }else{
        cfc_uninstall_callback();
    }
?>    