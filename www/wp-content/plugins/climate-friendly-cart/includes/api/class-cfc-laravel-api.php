<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CFC_Carbonclick_Laravel_API class responsable to load all the scripts and styles.
 */
class CFC_Carbonclick_Laravel_API {

    public function __construct() {
        
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );
    }


    public function cfc_laravel_api_response_code( $key = "", $value = "" ){
        
        $response_code = get_option('cfc_laravel_api_response_code' );

        $response_code[$key] = $value;

        update_option('cfc_laravel_api_response_code', $response_code );
    }

    /*
    *Get Stripe Intent Client Secret from Laravel
    */
    public function cfc_get_stripe_intent_client_secret( $args = array() ) {
        /*
            Required Parameters
            type        : woocommerce or magento
            domain      : example.com
        */

        $keys = array(
                    'type',
                    'domain'
                );    

 
        $body = array(
                    "type"          => "woocommerce",
                    "domain"        => get_site_url()
                );
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json"
                        );
        
        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/stripe/setup-intent", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }

    /*
    *CarbonClick Config
    */
    public function cfc_carbonclick_config_callback( $args = array() ) {
        /*
            Required Parameters

            type            : woocommerce or magento
            server          : staging or production
        */

        $body = array(
                    "type"          => "woocommerce",
                );
        

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/carbonclick/config", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $response_code  = wp_remote_retrieve_response_code( $response );
        $this->cfc_laravel_api_response_code('config_api', $response_code);
        
        $responseBody   = json_decode( $responseBody, true );

        update_option('cfc_carbonclick_config', $responseBody);

    }

    /*
    *Create Shop API Callback
    */
    public function cfc_create_shop( $args = array() ) {
        /*
            Required Parameters

            type        : woocommerce or magento
            domain      : example.com
            name        : Nitesh Chauhan
            shop_owner  : Nitesh
            email       : hi@example.com
            currency    : USD
            merchant_code : Unique code provided by CarbonClick
            description : Desription of bloginfo
            setupintent_id  : tok_1HuEPNLxxxxxxxx
        */

        $keys = array(
                    'type',
                    'domain',
                    'name',
                    'shop_owner',
                    'email',
                    'currency',
                    'merchant_code',
                    'description',
                    'setupintent_id'
                );    

        $woocommerce_currency       = get_woocommerce_currency();
        $base_country               = (new WC_Countries)->get_base_country();
        $name                       = get_bloginfo('name');
        $email                      = get_option( 'admin_email' );
        
        $body = array(
                    "type"          => "woocommerce",
                    "domain"        => get_site_url(),
                    "name"          => $name,
                    "shop_owner"    => $name,
                    "email"         => $email,
                    "currency"      => $woocommerce_currency,
                    "description"   => get_bloginfo('description'),
                    "country_code"  => $base_country,
                    "timezone"      => get_option('timezone_string'),
                    "weight_unit"   => get_option('woocommerce_weight_unit'),
                    "mode"          => "prepaid",
                );
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json"
                        );
        
        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/shops", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }

    /*
    *Retrieve Card details
    */
    public function cfc_fetch_customer(){
        
        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                    );

        $response       = wp_remote_get( CFC_API_LARAVEL_URL."api/shops/details", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        $response_code = wp_remote_retrieve_response_code( $response );
        $this->cfc_laravel_api_response_code('fetch_customer', $response_code);
        
        return $responseBody;
    }


    /*
    *Update Card details
    */
    public function cfc_update_card( $args = array() ){
        
        /*
            Required Parameters
            setupintent_id  : tok_1HuEPNLxxxxxxxx
        */

        $keys = array(
                    'setupintent_id'
                );    

        $body = array();
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'method'        => 'PUT',
                        'body'          => json_encode($body)
                    );
        
        $response       = wp_remote_request( CFC_API_LARAVEL_URL."api/shops/card", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }


    /*
    *Save Purchase API Callback
    */
    public function cfc_save_purchase( $args = array() ) {
        /*
            Required Parameters

            email           : Buyer email
            price           : Price of carbon offset
            currency        : USD
            quantity         : Total offset quantity
            preferred_topup : Preferred topup amount of merchant
            number          : Platform generated order ID
        */

        $keys = array(
                    'email',
                    'name',
                    'number',
                    'phone',
                    'price',
                    'currency',
                    'quantity',
                    'order_status_url',
                    'gateway',
                    'city',
                    'tax',
                    'total_price',
                    'country',
                    'state',
                    'preferred_topup',
                    'billing_address' => array(
                                            'zip',
                                            'city',
                                            'name',
                                            'phone',
                                            'company',
                                            'country',
                                            'address1',
                                            'address2',
                                            'latitude',
                                            'province',
                                            'last_name',
                                            'longitude',
                                            'first_name',
                                            'country_code',
                                            'province_code',
                                        )

                );

        $woocommerce_currency       = get_woocommerce_currency();
        $base_country               = (new WC_Countries)->get_base_country();
        $name                       = get_bloginfo('name');
        $email                      = get_option( 'admin_email' );
        
        $body = array();
        

        foreach ( $keys as $key ) {
            if( is_array($key) ){
                foreach ( $key as $inner_key ) {
                    if (  isset( $args['billing_address'][ $inner_key ] )  && !empty( $args['billing_address'][ $inner_key ] ) ) {
                        $body['billing_address'][ $inner_key ] = $args['billing_address'][ $inner_key ];
                    }
                }                
            }else if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/purchases", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }



    /*
    *Update Card details
    */
    public function cfc_refund( $args = array() ){
        
        /*
            Required Parameters

            type          : woocommerce or magento
            merchant_code : Unique code provided by CarbonClick
            number: Order number on which refund performed
        */

        $keys = array(
                    'cancel_reason',
                    'number'
                );    

        $body = array();
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'method'        => 'PUT',
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_request( CFC_API_LARAVEL_URL."api/purchases/refund", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }

    /*
    *redeem reward api - reset the rewards point
    */
    public function cfc_redeem_rewards( $args = array() ){
        
        $keys = array(
                    'redeem_method'
                );    

        $body = array();
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] )  && !empty( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'method'        => 'PUT',
                        'body'          => json_encode($body)
                    );
        
        $response       = wp_remote_request( CFC_API_LARAVEL_URL."api/rewards/redeem", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );
        
        return $responseBody;
    }


    /*
    *Retrieve Impact All Data
    */
    public function cfc_carbonclick_impact_all(){

        
        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                    );

        $response = wp_remote_get(CFC_API_LARAVEL_URL."api/carbonclick/impacts/all/woocommerce", $args );
        $responseBody = wp_remote_retrieve_body( $response );
        $response_code = wp_remote_retrieve_response_code( $response );
        $this->cfc_laravel_api_response_code('impact_all', $response_code);
        return $responseBody;
    }


    /*
    *Retrieve Impact Data for specific merchant
    */
    public function cfc_carbonclick_impact_merchant(){
        
        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                            "Authorization" =>  "Bearer ".CFC_ACCESS_TOKEN
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                    );

        $response = wp_remote_get(CFC_API_LARAVEL_URL."api/carbonclick/impacts/merchant", $args );
        $responseBody = wp_remote_retrieve_body( $response );

        $response_code = wp_remote_retrieve_response_code( $response );
        $this->cfc_laravel_api_response_code('impact_merchant', $response_code);
        
        return $responseBody;
    }

    /*
    * Get Order count that take place when widget is enable
    */
    public function woo_order_count_when_widget_enable(){
        $args = array(
            'post_status'       => 'any',
            'post_type'         => 'shop_order',
            'posts_per_page'    => -1,
        );

        /*Get Count of Orders having is_cfc_enable yes*/
        $args['meta_query'] =   array(
                                    'relation'        => 'AND',
                                        array(
                                            'key'     => '_is_cfc_enable',
                                            'value'   => 'yes',
                                            'compare' => '='
                                        )
                                );


        $orders  = new WP_Query($args);
        $total_orders = $orders->found_posts;
        return $total_orders;
    }
    /*
    *Update Shop info
    *This function will be called on setting page, checkout page and install help required submission button
    */
    public function cfc_update_shop_info( $args = array(), $acccess_token = false ){
        
        $keys = array(
                    'orders_count',
                    'version',
                    'last_impression',
                    'install_help_required',
                    'setup',
                    'preferred_topup',
                );    

        $cfc_settings = get_option( 'cfc_settings_options' );
        $preferred_topup = (isset($cfc_settings['cfc_card_management_prefered_topup']) && $cfc_settings['cfc_card_management_prefered_topup'] >= '20' ) ? $cfc_settings['cfc_card_management_prefered_topup'] : '20';
        
        $body = array(
                        'orders_count' => $this->woo_order_count_when_widget_enable(),
                        'preferred_topup' => $preferred_topup
                    );
        
        foreach ( $keys as $key ) {
            if (  isset( $args[ $key ] ) ) {
                $body[ $key ] = $args[ $key ];
            }
        }


        $CFC_ACCESS_TOKEN = CFC_ACCESS_TOKEN; 
        if( $acccess_token ){
            $CFC_ACCESS_TOKEN = $acccess_token; 
        }

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
                        'method'        => 'PUT',
                        'body'          => json_encode($body)
                    );
        

        $response       = wp_remote_request( CFC_API_LARAVEL_URL."api/shops/edit", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );
        
        return $responseBody;
    }

} // end of class CFC_Carbonclick_Laravel_API