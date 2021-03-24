<?php

// Preventing to direct access
defined( 'ABSPATH' ) OR die( 'Direct access not acceptable!' );

class CFC_Admin_Init {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
    }

    public function add_admin_menu() {
        add_menu_page(
            esc_html__( 'Climate Friendly Cart', 'wc-cfc' ),
            esc_html__( 'Climate Friendly Cart', 'wc-cfc' ),
            'manage_options',
            'cfc-dashboard',
            array( $this, 'admin_setting_page' ),
            CFC_PLUGIN_URL . 'assets/images/cc_logo_grey.svg',
            NULL
        );
    }

    // Admin general setting page.
    public function admin_setting_page() {
        require_once CFC_PLUGIN_PATH . 'includes/admin/views/admin-dashboard-page.php';
    }

    // Encrption function
    public function cfc_encrypt_data($plaindata) {
        //$key previously generated safely, ie: openssl_random_pseudo_bytes
        $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv             = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaindata, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac           = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext     = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }


    // Decryption function
    public function cfc_decrypt_data($ciphertext) {
        $c              = base64_decode($ciphertext);
        $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv             = substr($c, 0, $ivlen);
        $hmac           = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac        = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
        {
            return $original_plaintext;
        }
        return false;
    }
    

    // Manipulation of order data for dashboard
    public function get_order_data_for_dashboard($key = "orders_with_offsets") {

        /*
            merchant_count : This is the total merchant count from central database

            orders_with_offsets : This will return % of offsets orders. 100 total orders. 70 orders has offset value and api hit is success then the value return will be '70%'

            offsets_collected : This will return total of offsets prices collected via orders. This data will be fetched from the order meta using wp query.
        */

        $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
        $fetch_card_response = $CFC_Carbonclick_Laravel_API->cfc_fetch_customer();    

        /*Merchant Count*/        
        if($key == 'merchant_count'){

             return $fetch_card_response['merchants'];

        }else if($key == "offsets_collected"){
            
            /*Offset Collected*/ 
            if( $fetch_card_response['offsets'] ){
                return get_woocommerce_currency_symbol().$fetch_card_response['offsets'];
            }
            return 'N/A';

        }else if($key == "orders_with_offsets"){

            /*Get Count of All Orders*/
            $args = array(
                'post_status'       => 'any',
                'post_type'         => 'shop_order',
                'posts_per_page'    => 1,
            );

            $total_orders       = new WP_Query($args);
            $total_orders_count = $total_orders->found_posts;
            wp_reset_postdata();

            $orders_with_offset_count   = $fetch_card_response['orders'];

            if( $total_orders_count ){
                $orders_with_offsets = round((($orders_with_offset_count / $total_orders_count) * 100), 2).'%' ;
                if($orders_with_offsets){
                    return $orders_with_offsets;
                }    
            }
            
            return 'N/A';
        }
    }


    // Manipulation of order data for dashboard
    public function get_order_ids_where_charge_fail() {

        $order_ids = array();

        $args = array(
            'post_status'       => 'any',
            'post_type'         => 'shop_order',
            'posts_per_page'    => -1,
        );

        /*Get Count of Orders having is_cfc_deducted no*/
        $args['meta_query'] =   array(
                                    'relation'        => 'AND',
                                        array(
                                            'key'     => '_is_cfc_deducted',
                                            'value'   => 'no',
                                            'compare' => '='
                                        )
                                );


        $orders_with_offset  = new WP_Query($args);

        if ($orders_with_offset->have_posts()) {

            while ($orders_with_offset->have_posts()) : $orders_with_offset->the_post(); 

                global $post;
                $order_ids[] = $post->ID;
                
            endwhile; 
        }

        wp_reset_postdata();

        return $order_ids;
    }
    
    public function cfc_maybe_is_ssl() {
        // cloudflare
        if ( ! empty( $_SERVER['HTTP_CF_VISITOR'] ) ) {
            $cfo = json_decode( $_SERVER['HTTP_CF_VISITOR'] );
            if ( isset( $cfo->scheme ) && 'https' === $cfo->scheme ) {
                return true;
            }
        }
     
        // other proxy
        if ( ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
            return true;
        }
     
        return function_exists( 'is_ssl' ) ? is_ssl() : false;
    }
    
} // End of CFC_Admin_Init class

// Init the class
$cfc_admin_init = new CFC_Admin_Init;