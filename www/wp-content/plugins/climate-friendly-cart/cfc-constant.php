<?php
	$cfc_settings           = get_option( 'cfc_settings_options' );
    $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
    $cfc_carbonclick_config = get_option( 'cfc_carbonclick_config' );
 
    if ( ! defined( 'CFC_PLUGIN_PATH' ) ) {
        define( 'CFC_PLUGIN_PATH', plugin_dir_path( CFC_PLUGIN_FILE ) );
    }

    if ( ! defined( 'CFC_PLUGIN_URL' ) ) {
        define( 'CFC_PLUGIN_URL', plugin_dir_url( CFC_PLUGIN_FILE ) );
    }

    if ( ! defined( 'CFC_PLUGIN_VER' ) ) {
        define( 'CFC_PLUGIN_VER', '1.0.0' );
    }

    if ( ! defined( 'CFC_LOOK_AND_FEEL_URL' ) ) {
        define( 'CFC_LOOK_AND_FEEL_URL', get_admin_url().'admin.php?page=cfc-dashboard&tab=cfc-look-and-feel' );
    }

    if ( ! defined( 'CFC_SETTINGS_URL' ) ) {
        define( 'CFC_SETTINGS_URL', get_admin_url().'admin.php?page=cfc-dashboard&tab=cfc-settings' );
    }

    if ( ! defined( 'CFC_FRIENDLY_REWARD_URL' ) ) {
        define( 'CFC_FRIENDLY_REWARD_URL', get_admin_url().'admin.php?page=cfc-dashboard&tab=climate-friendly-rewards' );
    }

    
    /*
    * Define laravel access token to access API
    */
    if ( ! defined( 'CFC_ACCESS_TOKEN' ) ) {
        if( !empty( $cfc_onboarding_status['stripe_data']['access_token'] ) ){
            define( 'CFC_ACCESS_TOKEN', $cfc_onboarding_status['stripe_data']['access_token'] );
        }else{
            define( 'CFC_ACCESS_TOKEN', "" );
        }
    }

    /*
    *Define T and C, Privacy links
    */
    if ( ! defined( 'CFC_T_C_LINK' ) ) {
        define( 'CFC_T_C_LINK', $cfc_carbonclick_config['links']['terms'] );
    }

    if ( ! defined( 'CFC_REFUND_LINK' ) ) {
        define( 'CFC_REFUND_LINK', $cfc_carbonclick_config['links']['refund'] );
    }

    if ( ! defined( 'CFC_PRIVACY_LINK' ) ) {
        define( 'CFC_PRIVACY_LINK', $cfc_carbonclick_config['links']['privacy'] );
    }

    if ( ! defined( 'CFC_OPEN_INSTRUCTIONS_LINK' ) ) {
        define( 'CFC_OPEN_INSTRUCTIONS_LINK', $cfc_carbonclick_config['plugin']['instruction'] );
    }


    /*
    *Define Carbon Click Laravel API Details
    */
    if ( ! defined( 'CFC_API_LARAVEL_URL' ) ) {
        /* *NB* DO NOT modify the line below - our automated build searches for and replaces this line with an environment specific value */
        define( 'CFC_API_LARAVEL_URL', 'https://extmagewoo.carbon.click/' );
        //define( 'CFC_API_LARAVEL_URL', 'http://dashboard.brightness-demo.com/' );
    }


    /*
    *Define Carbon Click API Details
    */
    if ( ! defined( 'CFC_TRANSIENT' ) ) {
        define( 'CFC_TRANSIENT', 'cfc_carbonclick_api_expiration_check' );
    }

    if ( ! defined( 'CFC_IMPACT_ON_CART_TRANSIENT' ) ) {
        define( 'CFC_IMPACT_ON_CART_TRANSIENT', 'cfc_carbonclick_api_impact_data_on_cart' );
    }

    if ( ! defined( 'CFC_STRIPE_PUBLIC_KEY' ) ) {
        define( 'CFC_STRIPE_PUBLIC_KEY', $cfc_carbonclick_config['stripe']['public'] );
    }
    

    /*1 kg to LB conversion rate*/
    if ( ! defined( 'CFC_KG_TO_LB' ) ) {
        define( 'CFC_KG_TO_LB', '0.45359237' ); 
    }

    /*1 kg to OZ conversion rate*/
    if ( ! defined( 'CFC_KG_TO_OZ' ) ) {
        define( 'CFC_KG_TO_OZ', '0.02834952' ); 
    }

    /*Weight unit set in woocommerce*/
    if ( ! defined( 'CFC_WEIGHT_UNIT_IN_WOO' ) ) {
        define( 'CFC_WEIGHT_UNIT_IN_WOO', get_option('woocommerce_weight_unit') );
    }

    /*Minimum top up amount*/
    if ( ! defined( 'CFC_MINIMUM_TOP_UP_AMOUNT' ) ) {
        if($cfc_settings['cfc_card_management_prefered_topup']){
            define( 'CFC_MINIMUM_TOP_UP_AMOUNT', $cfc_settings['cfc_card_management_prefered_topup'] );
        }else{
            define( 'CFC_MINIMUM_TOP_UP_AMOUNT', 20 );
        }
    }
    
    $topup_currency_code = array( 'EUR', 'NZD', 'CAD', 'USD', 'GBP', 'AUD', 'TBC' );
?>