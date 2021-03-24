<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
* CFC_WooCommerce_Init class responsable to load all the scripts and styles.
*/
class CFC_WooCommerce_Init {

    public function __construct() {
        $this->init_hooks();
    }

    /*
    *Initialize woocommerce hooks
    */
    public function init_hooks() {
        
        $cfc_settings_options   = get_option( 'cfc_settings_options' );
        $enable_widget          = $cfc_settings_options['cfc_enable_widget_on_cart'];
        
        $cfc_widget_location_on_cart        = $cfc_settings_options['cfc_widget_location_on_cart'];
        $cfc_widget_location_on_mini_cart   = $cfc_settings_options['cfc_widget_location_on_mini_cart'];
        $cfc_widget_location_on_checkout    = $cfc_settings_options['cfc_widget_location_on_checkout'];

        $cfc_offset_amount      = $cfc_settings_options['cfc_offset_amount'];
        
        if( isset( $_GET['carbonclick'] ) && $_GET['carbonclick'] == true ){
            $enable_widget = true;   
        }
        
        if( $enable_widget ){
            
            add_action( 'pre_get_posts', array( $this, 'cfc_hide_carbon_offset_from_external_access_callback' ) );
            
            add_action( 'wp', array( $this, 'cfc_add_carbon_offset_to_cart_on_btn_click_callback' ) );
            add_action( 'wp', array( $this, 'cfc_remove_carbon_offset_from_cart_on_btn_click_callback' ) );
            
            if( $cfc_widget_location_on_cart ){
                add_action( 'woocommerce_after_cart_table', array( $this, 'cfc_add_carbon_offset_btn_on_cart_page_callback' ) );
            }

            if( $cfc_widget_location_on_checkout ){
                add_action( 'woocommerce_before_checkout_form', array( $this, 'cfc_add_carbon_offset_btn_on_cart_page_callback' ) );
            }
            
            if( $cfc_widget_location_on_mini_cart ){
                //add_action( 'woocommerce_before_mini_cart_contents', array( $this, 'cfc_add_carbon_offset_btn_on_mini_cart_callback' ) );
                add_action( 'woocommerce_mini_cart_contents', array( $this, 'cfc_add_carbon_offset_btn_on_mini_cart_callback' ) );

            }
            
            add_action( 'woocommerce_thankyou', array( $this, 'cfc_check_order_and_manage_offset_callback' ) );

            add_action( 'woocommerce_quantity_input_max', array( $this, 'cfc_woocommerce_quantity_max_100_callback' ), 9999, 2 );
            add_filter( 'woocommerce_cart_item_quantity', array( $this, 'cfc_woocommerce_quantity_max_100_in_cart_callback' ), 9999, 3 );
            add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'cfc_zero_discount_for_offset_callback' ), 12, 5 );

        }else{
            add_action( 'wp', array( $this, 'remove_offset_if_widget_disable_callback' ) );
        }
        
        add_filter( 'manage_edit-shop_order_columns', array( $this, 'cfc_admin_order_has_offset_column_callback' ) );
        add_action( 'manage_shop_order_posts_custom_column', array( $this, 'cfc_admin_order_has_offset_column_content_callback' ) );
        add_action( 'woocommerce_order_refunded', array( $this, 'cfc_order_with_offset_refunded_callback' ), 10, 2 ); 

    }


    /*
    * Remove offset from the cart if widget is disable
    */
    public function remove_offset_if_widget_disable_callback(){
        
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );

        if( isset( $cfc_onboarding_status['carbon_offset_product_id'] ) ){
            if(!is_admin()){

                $cartId = WC()->cart->generate_cart_id( $cfc_onboarding_status['carbon_offset_product_id'] );
            
                $cartItemKey = WC()->cart->find_product_in_cart( $cartId );
            
                WC()->cart->remove_cart_item( $cartItemKey ); 
            }
        }
    }
    
    /*
    *logic implementation for order refunded having offset value
    */
    public function cfc_order_with_offset_refunded_callback( $order_id, $refund_id ){

        global $wpdb;

        $order_has_offset = get_post_meta( $order_id, '_order_has_offset', true );

        if( $order_has_offset && $order_has_offset== "yes"  ){

            $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
            $carbon_offset_product_id   = get_post_meta( $order_id, '_carbon_offset_product_id', true );

            $order = wc_get_order( $order_id );

            // Get the Order refunds (array of refunds)
            $order_refunds = $order->get_refunds();
            
            $total_offset_amount_refunded   = $refund_reason = "Order cancelled";
            $current_refund_amount_bool     = true;
            $offset_amount = $current_refund_amount = 0;

            // Loop through the order refunds array
            foreach( $order_refunds as $refund ){
                // Loop through the order refund line items
                foreach( $refund->get_items() as $item_id => $item ){


                    $refunded_quantity      = $item->get_quantity(); // Quantity: zero or negative integer
                    $refunded_line_subtotal = $item->get_subtotal(); // line subtotal: zero or negative number
                    $refunded_product_id    = $item->get_product_id();

                    if ( $refunded_product_id && $refunded_product_id == $carbon_offset_product_id ) {
                        
                        if( $current_refund_amount_bool ){
                            $current_refund_amount = $refunded_line_subtotal;
                            $current_refund_amount_bool = false;
                            $refund_reason = $refund->get_reason() ? $refund->get_reason() : __( 'customer', 'woocommerce' ) ;
                        }else{
                            $total_offset_amount_refunded += $refunded_line_subtotal;    
                        }
                    }
                }
            }

            // Loop through the order items array
            $order_items = $order->get_items();
            foreach ( $order_items as $item_id => $item ) {

                $product_id = $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id();
                if ( $product_id && $product_id == $carbon_offset_product_id ) {

                        $offset_amount = $item->get_subtotal();
                }
            }
            
            if( $current_refund_amount < 0 ){
                /*
                    $current_refund_amount
                    $total_offset_amount_refunded
                    $offset_amount
                */

                $args = array(
                        "number"        => $order_id,
                        "cancel_reason" => $refund_reason
                        );

                $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
                $refund_response = $CFC_Carbonclick_Laravel_API->cfc_refund( $args );
                
                if( !empty( $refund_response['success'] ) && ( $refund_response['success'] == true || $refund_response['success'] == 1 ) ){
                    
                    update_post_meta( $order_id, '_order_has_offset', 'no' );
                }

            }
        }
    }


    /*
    *Exclude offset from all woocommerce coupons
    */
    public function cfc_zero_discount_for_offset_callback( $discount, $discounting_amount, $cart_item, $single, $coupon ){
        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
        $carbon_offset_product_id   = $cfc_onboarding_status['carbon_offset_product_id'];
            
        if( $cart_item['product_id'] == $carbon_offset_product_id  )
            $discount = 0;

        return $discount;
    }


    /*
    *Limit maximum amount of product to be updated as 100 on single product page
    */
    public function cfc_woocommerce_quantity_max_100_callback( $max, $product ) {

        if ( is_product() ) {
            $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
            $carbon_offset_product_id   = $cfc_onboarding_status['carbon_offset_product_id'];
            if ( $carbon_offset_product_id === $product->get_id() ) {
                $max = ceil( 100 / $product->get_price() );
            }
        }

        return $max;
    }


    /*
    *Limit maximum amount of product to be updated as 100 on cart page
    */
    public function cfc_woocommerce_quantity_max_100_in_cart_callback( $product_quantity, $cart_item_key, $cart_item ) {

        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        $max = 0;

        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
        $carbon_offset_product_id   = $cfc_onboarding_status['carbon_offset_product_id'];
        
        if ( $carbon_offset_product_id === $_product->get_id() ) {
            $max = ceil( 100 / $_product->get_price() );
        }

        $product_quantity = woocommerce_quantity_input( array(
            'input_name'   => "cart[{$cart_item_key}][qty]",
            'input_value'  => $cart_item['quantity'],
            'max_value'    => $max,
            'min_value'    => $_product->get_min_purchase_quantity(),
            'product_name' => $_product->get_name(),
        ), $_product, false );

        return $product_quantity;

    }


    /*
    *This is used to remove product to be listed in wp rest api
    */
    public function cfc_hide_carbon_offset_from_external_access_callback( $query = false ) {
        if ( ! is_admin() && isset( $query->query['post_type'] ) && $query->query['post_type'] === 'product' ) {
            
            $tax_query = array();
            
            if($query->get( 'tax_query' )){
                $tax_query = $query->get( 'tax_query' );
            }
            
            $tax_query[] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'exclude-from-catalog',
                    'operator' => 'NOT IN',
                ),
                array(
                
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'exclude-from-catalog',
                    'operator' => '!=',
                ),
            );

            $query->set( 'tax_query', $tax_query );
        }
    }

    /*
    * This function is used to display, offset button on cart page as per condition
    */
    public function cfc_add_carbon_offset_btn_on_cart_page_callback() {
        
        

        $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
        $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
        
        if($product_id){

            $product_cart_id = WC()->cart->generate_cart_id( $product_id );
            
            if(is_checkout())
                echo "<form method='post'>";

            $active_theme_textdomain = $this->get_active_theme_textdomain_callback();
            $theme_template_path = CFC_PLUGIN_PATH . 'includes/woo/themes-template/'.$active_theme_textdomain.'-cart-html.php';
            if(file_exists($theme_template_path)){
                require_once $theme_template_path;
            }else{
                require_once CFC_PLUGIN_PATH . 'includes/woo/themes-template/default-cart-html.php';
            }

            if(is_checkout())
                echo "</form>";
        }
    }

    /*
    * This function is used to display, offset button on cart page as per condition
    */
    public function cfc_add_carbon_offset_btn_on_mini_cart_callback() {
        
        $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
        $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
        
        if($product_id){
            $product_cart_id = WC()->cart->generate_cart_id( $product_id );
            
            $active_theme_textdomain = $this->get_active_theme_textdomain_callback();
            $theme_template_path = CFC_PLUGIN_PATH . 'includes/woo/themes-template/mini-cart/'.$active_theme_textdomain.'-mini-cart-html.php';
            if(file_exists($theme_template_path)){
                require_once $theme_template_path;
            }else{
                require_once CFC_PLUGIN_PATH . 'includes/woo/themes-template/mini-cart/default-mini-cart-html.php';
            }
        }
    }


    /*
    * This function is used to add carbon offset product to the cart, when user click on Offset Button located below cart table
    */
    public function cfc_add_carbon_offset_to_cart_on_btn_click_callback(){
        
        if(is_cart()){
            /*Last Impression update shop info*/
            $args  = array(
                'last_impression' => time()
                );
            $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
            $CFC_Carbonclick_Laravel_API->cfc_update_shop_info( $args );
        }

        if ( ! isset( $_POST['cfc_add_carbon_offset_button'] )  || !wp_verify_nonce($_REQUEST['cfc_add_carbon_offset_button_nonce_field'], 'cfc_add_carbon_offset_button_nonce')) {
            return;
        }

        $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
        $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];

        if($product_id){
            $product_cart_id    = WC()->cart->generate_cart_id( $product_id );
         
            if( ! WC()->cart->find_product_in_cart( $product_cart_id ) ){
                // Yep, the product with ID is NOT in the cart, let's add it then!
                WC()->cart->add_to_cart( $product_id );
            }     
        }
    }


    /*
    * This function is used to remove carbon offset product from the cart, when user click on Thank you Offset Button located below cart table
    */
    public function cfc_remove_carbon_offset_from_cart_on_btn_click_callback(){
        
        if ( ! isset( $_POST['cfc_remove_carbon_offset_button'] )  || !wp_verify_nonce($_REQUEST['cfc_remove_carbon_offset_button_nonce_field'], 'cfc_remove_carbon_offset_button_nonce')) {
            return;
        }

        $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
        $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
        if($product_id){
            $product_cart_id    = WC()->cart->generate_cart_id( $product_id );
            $cart_item_key      = WC()->cart->find_product_in_cart( $product_cart_id );

            if ( $cart_item_key ) 
                WC()->cart->remove_cart_item( $cart_item_key );
        }
    }

    
    /*
    * This function is used add column to the orders listing in admin to easily identify whether order has offset or not
    */
    public function cfc_admin_order_has_offset_column_callback( $columns ) {
        $columns['has_offset'] = 'Has Offset?';
        return $columns;
    }
     

    /*
    *Get current theme details. This is used to support few theme cart template. Based on active theme we will display the cart layout to meet the theme UI
    */
    public function get_active_theme_textdomain_callback(){

        $active_theme_details = wp_get_theme();
        
        $active_theme_textdomain = esc_html( $active_theme_details->get( 'TextDomain' ) );
        
        if(!$active_theme_textdomain){ 
            //It means that the child theme is active. You need to fetch the "Template"
            $active_theme_textdomain = esc_html( $active_theme_details->get( 'Template' ) );
            
            if(!$active_theme_textdomain){ 
                $active_theme_textdomain = esc_html( $active_theme_details->get( 'Name' ) );
            }
            
        }

        return $active_theme_textdomain;
    }

    /*
    * This function is used add column content to the orders listing in admin
    */ 
    public function cfc_admin_order_has_offset_column_content_callback( $column ) {
       
        global $post;
     
        if ( 'has_offset' === $column ) {
            $order_has_offset = get_post_meta( $post->ID, '_order_has_offset', true );
            if($order_has_offset && $order_has_offset == "yes" && get_post_meta( $post->ID, '_purchase_api_status', true ) == "SUCCESS"){
                echo '<mark class="order-status status-processing"><span>Yes</span></mark>';
            }else{
                echo '<mark class="order-status status-failed"><span>No</span></mark>';
            }
        }
    }


    /*
    * This function is used to check order has offset and if it has offset then call purchase api
    */
    public function cfc_check_order_and_manage_offset_callback( $order_id ){
        global $wpdb;
        
        $cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
        $carbon_offset_product_id   = $cfc_onboarding_status['carbon_offset_product_id'];
        
        $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
        $cfc_update_shop_info           = $CFC_Carbonclick_Laravel_API->cfc_update_shop_info();

        update_post_meta( $order_id, '_is_cfc_enable', "yes" );
        
        /*Update shop info with order count*/
        $CFC_Carbonclick_Laravel_API->woo_order_count_when_widget_enable();
               
        $order = wc_get_order( $order_id );
        $items = $order->get_items();
        foreach ( $items as $item_id => $item ) {

            $product_id = $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id();
            if ( $product_id && $product_id == $carbon_offset_product_id ) {

                //if($order->get_transaction_id()){
                    $product        = $item->get_product();
                    $active_price   = $product->get_price(); // The product active raw price
                    $regular_price  = $product->get_sale_price(); // The product raw sale price
                    $sale_price     = $product->get_regular_price();
                    $item_quantity  = $item->get_quantity(); // Get the item quantit

                    $paymentReference   = rand();//$order->get_transaction_id();
                    $payment_method_title = $order->get_payment_method_title();
                    $paymentProviderId  = $order->get_payment_method();
                    $total_tax          = $item->get_total_tax();
                    //$offset_total       = $item->get_total() + $item->get_total_tax();
                    $offset_total       = $item->get_total();
                    $amount_currency    = $order->get_currency();
                    
                    $billing_first_name = $order->get_billing_first_name();
                    $billing_last_name  = $order->get_billing_last_name();
                    $billing_company    = $order->get_billing_company();
                    $billing_address_1  = $order->get_billing_address_1();
                    $billing_address_2  = $order->get_billing_address_2();
                    $billing_city       = $order->get_billing_city();
                    $billing_state      = $order->get_billing_state();
                    $billing_postcode   = $order->get_billing_postcode();
                    $billing_country    = $order->get_billing_country();
                    $billing_email      = $order->get_billing_email();
                    $billing_phone      = $order->get_billing_phone();
                    $order_received_url = $order->get_checkout_order_received_url();

                    if( !get_post_meta( $order_id, '_order_has_offset', true )  ){

                        update_post_meta( $order_id, '_carbon_offset_product_id', $product_id ); 
                        update_post_meta( $order_id, '_order_has_offset', "yes" );

                        $cfc_carbonclick_api    = new CFC_Carbonclick_Laravel_API();
                        $fetch_card_response    = $cfc_carbonclick_api->cfc_fetch_customer();

                        $deduct_topup = true;

                        /* check topup and is less than offset amount charge customer*/
                        $CFC_MINIMUM_TOP_UP_AMOUNT = CFC_MINIMUM_TOP_UP_AMOUNT;

                        if( $offset_total >=   $CFC_MINIMUM_TOP_UP_AMOUNT + $fetch_card_response['topup'] ){
                            $CFC_MINIMUM_TOP_UP_AMOUNT = ceil($offset_total);
                        }

                        $args = array(
                                    "email"                 => $billing_email,
                                    'name'                  => $billing_first_name . " " . $billing_last_name,
                                    "price"                 => $active_price,
                                    "currency"              => $amount_currency,
                                    "quantity"              => $item_quantity,
                                    "preferred_topup"       => $CFC_MINIMUM_TOP_UP_AMOUNT,
                                    "number"                => $order_id,
                                    "tax"                   => $total_tax,
                                    "total_price"           => $offset_total,
                                    "order_status_url"      => $order_received_url,
                                    "gateway"               => $payment_method_title .'('.$paymentProviderId.')',
                                    "billing_address" => array(
                                            'city'       => $billing_city,
                                            'name'       => $billing_first_name . " " . $billing_last_name,
                                            'phone'      => $billing_phone,
                                            'company'    => $billing_company,
                                            'country'    => WC()->countries->countries[$billing_country ],
                                            'address1'   => $billing_address_1,
                                            'address2'   => $billing_address_2,
                                            'last_name'  => $billing_last_name,
                                            'first_name' => $billing_first_name,
                                            'country_code' => $billing_country,
                                        )
                                );

                        $save_purchase_response = $CFC_Carbonclick_Laravel_API->cfc_save_purchase($args);

                        if( !empty( $save_purchase_response['success'] ) && ( $save_purchase_response['success'] == true || $save_purchase_response['success'] == 1 ) ){

                            update_post_meta( $order_id, '_is_cfc_deducted', "yes" );
                            update_post_meta( $order_id, '_purchase_api_status', "SUCCESS" );
                            

                            $global_notice = get_option( 'cfc-global-notice' );
                            $global_notice['payment_failure'] = "";
                            update_option( 'cfc-global-notice', $global_notice );
                            update_option( 'cfc-charge-status', 'paid' );
                            
                        }else{

                            update_post_meta( $order_id, '_is_cfc_deducted', "no" );
                            update_post_meta( $order_id, '_purchase_api_status', "FAIL" );

                        }
                        
                    }
                //}
            }
        }
    }
} // end of class CFC_WooCommerce_Init

$cfc_woocommerce_init = new CFC_WooCommerce_Init;