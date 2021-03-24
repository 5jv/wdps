<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CFC_Registration_Activation_Init class responsable to load all the scripts and styles.
 */
class CFC_Registration_Activation_Init {

    public function __construct() {
        
        $this->cfc_check_woocommerce_is_active_callback();
        $this->cfc_check_woocommerce_currency_support_callback();
        $this->cfc_carbonclick_config_callback();
        
        if( get_option('cfc_call_create_shop_api_on_activate', 'true') == 'true' ){
            $this->cfc_create_shop_callback();    
        }else{
            $this->cfc_shop_status_callback();    
        }
        
        $this->cfc_onboarding_process_status_callback();
        $this->cfc_settings_update_options_callback();
        $this->cfc_look_and_feel_update_options_callback();
        $this->cfc_create_carbon_offset_product_callback();
        add_action( 'activated_plugin', array( $this, 'cfc_redirect_on_activation_callback' ) );

    }

    public function cfc_countries(){
        
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

        $response       = wp_remote_get( CFC_API_LARAVEL_URL."api/countries", $args );

        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        return $responseBody;
    }

    /*
    * Check woocommerce is active or not.
    */
    public function cfc_check_woocommerce_is_active_callback(){
        if ( !class_exists( 'WooCommerce' ) ) {
           die( 'Plugin not activated: ' . $error );
        }
    }


    /*
    * check woocommerce currency support. If currency is not from the globally defined currency then don't activate plugin and show message to use the currency from listed one
    */
    public function cfc_check_woocommerce_currency_support_callback(){
        global $topup_currency_code;
        if ( class_exists( 'WooCommerce' ) ) {
           if( !in_array( get_woocommerce_currency(), $topup_currency_code ) ){
                
                $error = 'Your store currency is '.get_woocommerce_currency();
                $error .= '<p>supported currency are <b>'.implode(', ', $topup_currency_code).'</b></p>';
                
                die( $error );
            }
        }
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
                    "type"          => "woocommerce"
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
        $responseBody   = json_decode( $responseBody, true );

        
        $response_code = get_option('cfc_laravel_api_response_code' );

        $response_code['config_api'] = wp_remote_retrieve_response_code( $response );

        update_option('cfc_laravel_api_response_code', $response_code );

        update_option('cfc_carbonclick_config', $responseBody);

    }


    /*
    *Create Shop API Callback
    */
    public function cfc_create_shop_callback( $args = array() ) {
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

        if( !empty( $responseBody['success'] ) && ($responseBody['success'] == true || $responseBody['success'] == 1 ) ){
            update_option( 'cfc_call_create_shop_api_on_activate', 'false' );
        }

        return $responseBody;
    }


    public function cfc_shop_status_callback(){

        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
        $cfc_settings_options      = get_option( 'cfc_settings_options' );

        $CFC_ACCESS_TOKEN       = $cfc_onboarding_status['stripe_data']['access_token'];

        $body = array(
                    "status"   => "activate",
                    'setup'    => ( $cfc_settings_options['cfc_enable_widget_on_cart'] == 1 ) ? true : false
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
    }

    /*
    * Updating default status of onboarding process to complete.
    */
    public function cfc_onboarding_process_status_callback(){
        
        
        //Remove comment when you go live
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );

        if( isset( $cfc_onboarding_status['status'] ) &&  $cfc_onboarding_status['status'] == 'complete' ){
            return true;
        }
        
            
        $cfc_onboarding_status = array();

        $cfc_onboarding_status['status'] = 'pending';
        
        $cfc_onboarding_status['onboarding_current_step'] = '1';
        
        $cfc_onboarding_status['steps'] = array(
                                            'step-1' => 'pending',
                                            'step-2' => 'pending',
                                        );
        
        $cfc_onboarding_status['dashboard_installation_instruction']    = '0';
        $cfc_onboarding_status['dashboard_settings_page']               = '0';
        $cfc_onboarding_status['dashboard_get_started']                 = '0';
        $cfc_onboarding_status['dashboard_guide']                       = '0';
        $cfc_onboarding_status['dashboard_head_over']                   = '0';
        $cfc_onboarding_status['dashboard_template_to_use']             = '0';
        $cfc_onboarding_status['dashboard_badge_here']                  = '0';
        $cfc_onboarding_status['dashboard_social_post_ideas']           = '0';
        $cfc_onboarding_status['dashboard_look_and_feel']               = '0';

        update_option( 'cfc-onboarding-status', $cfc_onboarding_status );
    }


    /*
    * Updating default option for settings tab
    */
    public function cfc_settings_update_options_callback(){

        $cfc_settings = get_option( 'cfc_settings_options' );
        if( isset( $cfc_settings['cfc_offset_amount'] ) && !empty($cfc_settings['cfc_offset_amount']) ){
            return true;
        }

        $cfc_settings  = array(
            'cfc_enable_widget_on_cart'         => 0,
            'cfc_widget_location_on_cart'       => 1,
            'cfc_widget_location_on_mini_cart'  => 0,
            'cfc_widget_location_on_checkout'   => 1,
            'cfc_offset_amount'                 => 2,
            'cfc_card_management_prefered_topup' => 20,
        );

        update_option( 'cfc_settings_options', $cfc_settings );
    }
    

    /*
    * Updating default option for look and feel tab
    */
    public function cfc_look_and_feel_update_options_callback(){

        $cfc_look_and_feel = get_option( 'cfc_look_and_feel_options' );
        if(!empty($cfc_look_and_feel)){
            return true;
        }

        $cfc_look_and_feel  = array(
            'plugin_border_color'               => "#2AA43C",
            'plugin_background_color'           => "#ffffff",
            'plugin_background_color_expanded'  => "#EAF9EC",
            'plugin_icons_color'                => "#2AA43C",
            'plugin_text_colour_top_section'    => "#000000",
            'plugin_large_text_colour_expanded' => "#000000",
            'plugin_small_text_colour_expanded' => "#000000",
            'button_border_colour'              => "#2AA43C",
            'button_background_colour'          => "#2AA43C",
            'button_text_colour'                => "#ffffff",
            'button_plus_icon_colour'           => "#ffffff",
            'button_background_colour_selected' => "#ffffff",
            'button_text_colour_selected'       => "#000",
            'button_checkmark_icon_selected'    => "#2AA43C",
            'carbonclick_logo'                  => 'standard',
            'carbonclick_product_image'         => 'standard',
        );

        update_option( 'cfc_look_and_feel_options', $cfc_look_and_feel ); 
    }


    /*
    * Creating carbon offset product on plugin activation
    */
    public function cfc_create_carbon_offset_product_callback(){
        
        /*get the onboarding status on plugin activation and add the product id to this array below*/
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );

        //if(!isset($cfc_onboarding_status['carbon_offset_product_id'])){
            
            $id = "";

            /*get the price from the cfc setting options*/
            $cfc_settings_options = get_option( 'cfc_settings_options' );
            $product_price = $cfc_settings_options['cfc_offset_amount'];

            /*
                check whether product exists or not. If product exists then update the details
            */
            $args = array(
                'post_type'     => "product",
                'post_status'   => "publish",
                'meta_query' => array(
                    array(
                        'key'     => 'cfc_is_offset_product',
                        'value'   => true,
                        'compare' => '=',
                    ),
                ),
            );

            $the_query = new WP_Query( $args );
        
            // The Loop
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                   $id =  get_the_ID();
                endwhile;
            endif;

            // Reset Post Data
            wp_reset_postdata();

            if($id){
                /*Update existing offset*/
                wp_update_post(
                    array(
                        'ID'           => $id,
                        'post_title'    => "Carbon Offset", 
                        'post_content'  => "<p>CarbonClick's carbon offsets help neutralize the carbon emissions from your purchase.</p><p>Your contribution helps funds forest restoration, tree planting, and clean energy projects that fight climate change.</p><p>All it takes is a single click at the checkout.</p>",
                        'post_status'   => "publish"
                    ) 
                );
            }else{
                /*Insert new offset*/
                $id = wp_insert_post(
                        array(
                                'post_title'    => "Carbon Offset", 
                                'post_name'     => "carbon-offset",
                                'post_content'  => "<p>CarbonClick's carbon offsets help neutralize the carbon emissions from your purchase.</p><p>Your contribution helps funds forest restoration, tree planting, and clean energy projects that fight climate change.</p><p>All it takes is a single click at the checkout.</p>",
                                'post_type'     => "product",
                                'post_status'   => "publish"
                            )
                    );
            }
            
            $sku='cfc-carbon-offset';

            /*Taxable Offset Logic Start Here*/
            $response_array = array();
            // The country/state
            $store_raw_country = get_option( 'woocommerce_default_country' );

            // Split the country/state
            $split_country = explode( ":", $store_raw_country );

            // Country and state separated:
            $store_country = $split_country[0];
            $store_state   = $split_country[1];

            $cfc_countries = $this->cfc_countries();
            foreach ($cfc_countries['data'] as $key => $data)
            {
                if ( $data['country_alpha2'] == $store_country ){
                    $response_array = $data;
                }
            }
            
            if( !empty( $response_array ) ){
                if( !$response_array['taxable'] ){
                    update_post_meta( $id,'_tax_status','none' );
                    update_post_meta( $id,'_tax_class','zero-rate' );        
                }
            }
            /*Taxable Offset Logic End Here*/

            update_post_meta( $id,'_sku',$sku );
            update_post_meta( $id, '_visibility', 'hidden' );
            update_post_meta( $id, '_regular_price', 0 );
            update_post_meta( $id, '_price', $product_price );
            update_post_meta( $id, 'cfc_is_offset_product', true );
            
            $cfc_onboarding_status['carbon_offset_product_id'] = $id;

            /*Update onboarding option with the product id*/
            update_option( 'cfc-onboarding-status', $cfc_onboarding_status );

            $terms = array( 'exclude-from-catalog', 'exclude-from-search' );
            wp_set_object_terms( $id, $terms, 'product_visibility' );
            
            $this->cfc_generate_featured_image( CFC_PLUGIN_URL.'/assets/images/carbon-offset-thumbnail.png',$id );
        //}
    }


    /*
    * Redirect to onboarding process on plugin activation
    */
    public function cfc_redirect_on_activation_callback(){
        
        /*
        * If the onboarding status is complete then redirect to dashboard page. If the status is pending then redirect to onboarding page
        */
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );

        $redirect_url =  get_admin_url().'admin.php?page=cfc-dashboard&tab=cfc-onboarding';
        
        if( isset( $cfc_onboarding_status['status'] ) &&  $cfc_onboarding_status['status'] == 'complete' ){
            $redirect_url =  get_admin_url().'admin.php?page=cfc-dashboard';
        }

        wp_redirect($redirect_url);
        exit();

    }


    /*
    * This function is used to generate the featured image for the product that we are generating on activation
    */
    public function cfc_generate_featured_image( $image_url, $post_id  ){
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($image_url);
        $filename   = basename($image_url);
        
        if(wp_mkdir_p($upload_dir['path'])){
            $file   = $upload_dir['path'] . '/' . $filename;
        }else{
            $file   = $upload_dir['basedir'] . '/' . $filename;
        }

        file_put_contents( $file, $image_data );

        $wp_filetype = wp_check_filetype( $filename, null );
        
        $attachment = array(
            'post_mime_type'    => $wp_filetype['type'],
            'post_title'        => sanitize_file_name( $filename ),
            'post_content'      => '',
            'post_status'       => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        
        $attach_data    = wp_generate_attachment_metadata( $attach_id, $file );
        
        /*default black image is getting uploaded*/
        update_post_meta( $post_id, 'cfc_carbon_product_image_as_featured', 'black' );

        set_post_thumbnail( $post_id, $attach_id );
    }
} // end of class CFC_Registration_Activation_Init

$cfc_registration_activation_init = new CFC_Registration_Activation_Init;