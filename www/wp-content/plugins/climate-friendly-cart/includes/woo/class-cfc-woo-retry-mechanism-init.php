<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CFC_Woo_Retry_Mechanism_Init class responsable to load all the scripts and styles.
 */
class CFC_Woo_Retry_Mechanism_Init {

    public function __construct() {
        $this->init_hooks();
    }

    public function init_hooks() {
       
        add_filter('cron_schedules',array( $this, 'cfc_cron_schedules_callback' ) );
        add_action ( 'init', array( $this, 'cfc_schedule_event_callback' ) );

        //add_action ( 'cfc_cron_hook_1min', array( $this, 'cfc_cron_task_1min_callback' ) );
        //add_action ( 'cfc_cron_hook_5min', array( $this, 'cfc_cron_task_5min_callback' ) );
        add_action ( 'cfc_cron_hook_hourly', array( $this, 'cfc_cron_task_cfc_hourly_callback' ) );
        //add_action ( 'cfc_cron_hook_weekly', array( $this, 'cfc_cron_task_cfc_week_callback' ) );
        
    }

    /**
    * Schedule weekly event for wp cron
    */
    public function cfc_cron_schedules_callback($schedules){
        
        if(!isset($schedules["1min"])){

            $schedules["1min"] = array(

                'interval' => 1*60,
                'display' => __('Once every minutes'));

        }

        if(!isset($schedules["5min"])){
            
            $schedules["5min"] = array(
                'interval' => 5*60,
                'display' => __('Once every 5 minutes'));

        }

        if(!isset($schedules["cfc_week"])){
            
            $schedules["cfc_week"] = array(
                'interval' => 604800,
                'display' => __('Event By CarbonClick. Once every week'));

        }

        return $schedules;
    }


    public function cfc_schedule_event_callback(){

        if (!wp_next_scheduled('cfc_cron_hook_1min')) {
            
            wp_schedule_event( time(), '1min', 'cfc_cron_hook_1min' );

        }

        if (!wp_next_scheduled('cfc_cron_hook_5min')) {
            
            wp_schedule_event( time(), '5min', 'cfc_cron_hook_5min' );

        }

        if (!wp_next_scheduled('cfc_cron_hook_weekly')) {
            
            wp_schedule_event( time(), 'cfc_week', 'cfc_cron_hook_weekly' );

        }

        if (!wp_next_scheduled('cfc_cron_hook_hourly')) {
            
            wp_schedule_event( time(), 'hourly', 'cfc_cron_hook_hourly' );

        }
    }

    /**
    * Task execution 1 min
    */
    public function cfc_cron_task_1min_callback() {
        
        $this->cfc_generate_log( "1 minute carbonclick cron executed" );

        $message = $this->cfc_get_order_ids_where_purchase_api_fail();
        foreach ( $message as $key => $order_id ) {
            
            $CFC_WooCommerce_Init = new CFC_WooCommerce_Init();
            
            delete_post_meta( $order_id, '_order_has_offset' );
            
            $CFC_WooCommerce_Init->cfc_check_order_and_manage_offset_callback($order_id);
            $this->cfc_generate_log( "Purchase API Attempted for order id " . $order_id );

        }
    }

    /**
    * Task execution 5 min
    */
    public function cfc_cron_task_5min_callback() {
        
        $this->cfc_generate_log( "5 minute carbonclick cron executed" );

        $message = $this->cfc_get_order_ids_where_purchase_api_fail();
        foreach ( $message as $key => $order_id ) {
            
            $CFC_WooCommerce_Init = new CFC_WooCommerce_Init();
            
            delete_post_meta( $order_id, '_order_has_offset' );
            
            $CFC_WooCommerce_Init->cfc_check_order_and_manage_offset_callback($order_id);
            $this->cfc_generate_log( "Purchase API Attempted for order id " . $order_id );

        }

    }

    /**
    * Task execution Daily
    */
    public function cfc_cron_task_cfc_hourly_callback(){

        $this->cfc_generate_log( "Daily carbonclick cron executed" );

        $message = $this->cfc_get_order_ids_where_purchase_api_fail();
        foreach ( $message as $key => $order_id ) {
            
            $CFC_WooCommerce_Init = new CFC_WooCommerce_Init();
            
            delete_post_meta( $order_id, '_order_has_offset' );
            
            $CFC_WooCommerce_Init->cfc_check_order_and_manage_offset_callback($order_id);
            $this->cfc_generate_log( "Purchase API Attempted for order id " . $order_id );

        }
    }

    /**
    * Task execution Weekly
    */
    public function cfc_cron_task_cfc_week_callback() {
        
        $message = 'Fcr Weekly Cron Executed';
        $this->cfc_generate_log( $message );

    }

    public function cfc_get_order_ids_where_purchase_api_fail() {
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
                                            'key'     => '_purchase_api_status',
                                            'value'   => 'FAIL',
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

    /**
    * Generate Log
    */
    public function cfc_generate_log($message = ""){
        
        $log  = "-------------------------".PHP_EOL.
                "Time: " . date("h:i:sa").PHP_EOL.
                "Message: ".print_r( $message, true ).PHP_EOL.
                "-------------------------".PHP_EOL;
        //Save string to log, use FILE_APPEND to append.
        $file_path = CFC_PLUGIN_PATH.'logger.log';        
        //file_put_contents( $file_path , $log, FILE_APPEND );
        $fileContents = file_get_contents( $file_path );
        file_put_contents( $file_path , $log.$fileContents );

    }

} // end of class CFC_Woo_Retry_Mechanism_Init

$CFC_Woo_Retry_Mechanism_Init = new CFC_Woo_Retry_Mechanism_Init;
