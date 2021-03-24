<?php
// Preventing to direct access
defined( 'ABSPATH' ) OR die( 'Direct access not acceptable!' );

class CFC_Admin_Save_Settings {

    public function __construct() {

        add_action( 'woocommerce_update_product', array( $this, 'save_cfc_on_product_save' ), 10, 1 );
        
        add_action( 'admin_init', array( $this, 'save_cfc_settings_callback' ) );
        add_action( 'admin_init', array( $this, 'save_cfc_look_and_feel_callback' ) );
        add_action( 'admin_init', array( $this, 'reset_cfc_look_and_feel_callback' ) );
        add_action( 'admin_init', array( $this, 'save_cfc_card_management_callback' ) );
        add_action( 'admin_init', array( $this, 'save_cfc_onboarding_data_callback' ) );

        /*ajax call request*/
        add_action("wp_ajax_dasbhoard_cards", array( $this, 'dasbhoard_cards_callback' ) );
        //add_action("wp_ajax_nopriv_dasbhoard_cards", array( $this, 'dasbhoard_cards_callback' ) );

        add_action("wp_ajax_rewards_redemption_request", array( $this, 'rewards_redemption_request_callback' ) );
        //add_action("wp_ajax_nopriv_rewards_redemption_request", array( $this, 'rewards_redemption_request_callback' ) );

        add_action("wp_ajax_get_stripe_intent_client_secret", array( $this, 'get_stripe_intent_client_secret_callback' ) );

    }

    /*This function is used to check amd make sure to update offset price greater than 0*/
    public function save_cfc_on_product_save( $product_id ){

        /*get onboarding_option_data to get the offset product id . key : carbon_offset_product_id*/
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );
        $carbon_offset_product_id = $cfc_onboarding_status['carbon_offset_product_id'];
        
        if($carbon_offset_product_id &&  ( $carbon_offset_product_id == $product_id ) ){
            $cfc_settings_options = get_option( 'cfc_settings_options' );
            $cfc_offset_amount    = $cfc_settings_options['cfc_offset_amount'];

            if( isset( $_POST['_regular_price']) && $_POST['_regular_price'] < $cfc_offset_amount ){
                update_post_meta( $carbon_offset_product_id, '_price', $cfc_offset_amount );
                update_post_meta( $carbon_offset_product_id, '_regular_price', $cfc_offset_amount );
            }
        }
    }

    
    /*This function is used to call laravel api to get the intent client secret*/
    public function get_stripe_intent_client_secret_callback(){
        $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
        $result =  $CFC_Carbonclick_Laravel_API->cfc_get_stripe_intent_client_secret();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
        }
        else {
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        die();
    }


    /*This function will trigger when CFC Settings Tab data is saved/updated*/
    public function save_cfc_settings_callback() {

        /*onboarding input data*/
        
        if ( ! is_admin() || ! isset( $_POST['save_cfc_settings'] )  || !wp_verify_nonce($_REQUEST['cfc_settings_nonce_field'], 'cfc_settings_nonce')) {
            return;
        }

        $cfc_offset_amount       = sanitize_text_field( $_POST['cfc_offset_amount'] );

        if( $cfc_offset_amount > 100)
            $cfc_offset_amount   = 100;

        if( $cfc_offset_amount < 1)
            $cfc_offset_amount   = 2;

        if( !isset( $_POST['cfc_widget_location_on_cart'] ) && !isset( $_POST['cfc_widget_location_on_mini_cart'] ) && !isset( $_POST['cfc_widget_location_on_checkout']) ){
            $_POST['cfc_widget_location_on_cart'] = 1;
        }

        $cfc_settings       = array(
            'cfc_enable_widget_on_cart'         => isset($_POST['cfc_enable_widget_on_cart']) ? sanitize_text_field( $_POST['cfc_enable_widget_on_cart'] ): '0',
            'cfc_widget_location_on_cart'       => isset($_POST['cfc_widget_location_on_cart']) ? sanitize_text_field( $_POST['cfc_widget_location_on_cart'] ): '0',
            'cfc_widget_location_on_mini_cart'  => isset($_POST['cfc_widget_location_on_mini_cart']) ? sanitize_text_field( $_POST['cfc_widget_location_on_mini_cart'] ): '0',
            'cfc_widget_location_on_checkout'   => isset($_POST['cfc_widget_location_on_checkout']) ? sanitize_text_field( $_POST['cfc_widget_location_on_checkout'] ): '0',
            'cfc_offset_amount'                 => $cfc_offset_amount,
            'cfc_card_management_prefered_topup' => (isset($_POST['cfc_card_management_prefered_topup']) && $_POST['cfc_card_management_prefered_topup'] >= '20' ) ? sanitize_text_field( $_POST['cfc_card_management_prefered_topup'] ) : '20',

        );

        /*Update shop info when setting details are changes*/
        $args  = array(
                    'setup' => isset($_POST['cfc_enable_widget_on_cart']) ? true : false
                    );

        $CFC_Carbonclick_Laravel_API  = new CFC_Carbonclick_Laravel_API();
        $response = $CFC_Carbonclick_Laravel_API->cfc_update_shop_info( $args );

        /*Logic applied if account is blocked by carbonclick*/
        if( isset( $response['error'] ) && $response['error'] == 'blocked' ){
            update_option( 'cfc-widget-status', 'blocked' );
            $global_notice = get_option( 'cfc-global-notice' );
            $global_notice['payment_failure'] = $response['message'];
            update_option( 'cfc-global-notice', $global_notice );
            
            $cfc_settings['cfc_enable_widget_on_cart']  = 0;
        }else{
            update_option( 'cfc-widget-status', 'unblocked' );
            $global_notice = get_option( 'cfc-global-notice' );
            $global_notice['payment_failure'] = "";
            update_option( 'cfc-global-notice', $global_notice );
        }
        
        
        update_option( 'cfc_settings_options', $cfc_settings );

        /*get onboarding_option_data to get the offset product id . key : carbon_offset_product_id*/
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );
        $carbon_offset_product_id = $cfc_onboarding_status['carbon_offset_product_id'];
        if($carbon_offset_product_id){
            update_post_meta( $carbon_offset_product_id, '_price', $cfc_offset_amount );
            update_post_meta( $carbon_offset_product_id, '_regular_price', $cfc_offset_amount );
        }

        add_action( 'admin_notices', array( $this, 'admin_notices' ) );

    }


    /*This function will trigger when CFC Look and Feel Tab data is saved/updated*/
    public function save_cfc_look_and_feel_callback() {

        if ( ! is_admin() || ! isset( $_POST['save_cfc_look_and_feel'] )  || !wp_verify_nonce($_REQUEST['cfc_look_and_feel_nonce_field'], 'cfc_look_and_feel_nonce')) {
            return;
        }

        $cfc_look_and_feel = $_POST['cfc_look_and_feel'];
     
        update_option( 'cfc_look_and_feel_options', $cfc_look_and_feel );
        
        $this->update_featured_image_on_look_and_feel_callback($cfc_look_and_feel);
        
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        
    }

    public function reset_cfc_look_and_feel_callback() {

        if ( ! is_admin() || ! isset( $_POST['reset_cfc_look_and_feel'] )  || !wp_verify_nonce( $_REQUEST['cfc_look_and_feel_nonce_field'], 'cfc_look_and_feel_nonce' )) {
            return;
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

        $this->update_featured_image_on_look_and_feel_callback( $cfc_look_and_feel );
        
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        
    }


    public function save_cfc_card_management_callback(){
        if(! is_admin() || !isset($_POST['stripeToken']) || !wp_verify_nonce($_REQUEST['cfc_card_management_nonce_field'], 'cfc_card_management_nonce') ){
                return;
        }

        /*Stripe based response data manipulation start here*/

            $cfc_onboarding_status      = get_option('cfc-onboarding-status');
            
            $cfc_onboarding_status      = $this->stripe_data_manipulation_in_admin( $_POST, $cfc_onboarding_status, false , 'update_card');

            $stripe_process_completed   = $cfc_onboarding_status['stripe_data']['stripe_process_completed'];
            
            if($stripe_process_completed){
                update_option( 'cfc-onboarding-status', $cfc_onboarding_status );
                //add_action( 'admin_notices', array( $this, 'card_details_update_success' ) );
            }else{
                //add_action( 'admin_notices', array( $this, 'card_details_update_fail' ) );
            }

        /*Stripe based response data manipulation end here*/

    }


    public function save_cfc_onboarding_data_callback() {
        
        if(! is_admin() || !isset($_POST['stripeToken']) || !wp_verify_nonce($_REQUEST['cfc_onboarding_next_nonce_field'], 'cfc_onboarding_next_nonce') ){
            if ( ! is_admin() || ! isset( $_POST['onboarding_next'] )  || !wp_verify_nonce($_REQUEST['cfc_onboarding_next_nonce_field'], 'cfc_onboarding_next_nonce')) {
                return;
            }
        }
        
        $stripe_process_completed   = false;
   
        $onboarding_previous_step   = sanitize_text_field($_POST['onboarding_previous_step']);
        $onboarding_current_step    = sanitize_text_field($_POST['onboarding_current_step']);
        $onboarding_next_step       = sanitize_text_field($_POST['onboarding_next_step']);
        

        $cfc_onboarding_status = get_option('cfc-onboarding-status');
        $cfc_onboarding_status['steps']['step-'.$onboarding_current_step] = 'complete';


        /*Stripe based response data manipulation start here*/
            
            $cfc_onboarding_status      = $this->stripe_data_manipulation_in_admin( $_POST, $cfc_onboarding_status );
            $stripe_process_completed   = $cfc_onboarding_status['stripe_data']['stripe_process_completed'];

        /*Stripe based response data manipulation end here*/

        /*updating onboarding status to complete, if all steps are complete*/
        if( $stripe_process_completed && !in_array('pending', $cfc_onboarding_status['steps']) ){
            $cfc_onboarding_status['status'] = "complete";
        }

        update_option( 'cfc-onboarding-status', $cfc_onboarding_status );
        
        if($cfc_onboarding_status['status'] == "complete"){
            
            /*If onboarding process is complete, then redirect user to dashboard page*/
            $cfc_settings_url =  get_admin_url().'admin.php?page=cfc-dashboard&tab=dashboard';
            wp_redirect( $cfc_settings_url );
            exit();

        }else{
            
            /*If onboarding process is pending, then redirect user to next steps*/
            if($onboarding_next_step == 1 || $onboarding_next_step == 2){
                $onboarding_next_step = $onboarding_next_step;
            }else{
                $onboarding_next_step = 2;
            }
            
            $onboarding_url =  get_admin_url().'admin.php?page=cfc-dashboard&tab=cfc-onboarding&step='.$onboarding_next_step;
            wp_redirect( $onboarding_url );
            exit();
        }
        
    }

    
    public function stripe_data_manipulation_in_admin($post_data, $cfc_onboarding_status, $charge = true, $action="onboarding"){
        
        if(isset($post_data['step_details']) && !empty($post_data['step_details'])){

            $stripeToken                    = sanitize_text_field($post_data['stripeToken']);
            $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();

            if($action == "onboarding"){
                $onboarding_current_step        = sanitize_text_field($post_data['onboarding_current_step']);

                $args = array(
                           //'stripe_token'  => $stripeToken,
                           'setupintent_id'  => $stripeToken,

                        );

                // if($_SERVER['HTTP_HOST'] == "localhost"){
                //         $args['domain']  = 'http://localhostd.brightness-demo.com';
                // }

                $create_shop_response = $CFC_Carbonclick_Laravel_API->cfc_create_shop($args);
                
                if( !empty( $create_shop_response['success'] ) && ($create_shop_response['success'] == true || $create_shop_response['success'] == 1 ) ){
                    
                    $cfc_onboarding_status['stripe_data']['access_token']              = $create_shop_response['access_token'];
                    $cfc_onboarding_status['stripe_data']['customer_id']                = $create_shop_response['customer_id'];
                    $cfc_onboarding_status['stripe_data']['stripe_process_completed']   = true;
                    $cfc_onboarding_status['stripe_data']['errors']                     = "";

                    $global_notice = get_option( 'cfc-global-notice' );
                    $global_notice['payment_failure'] = "";
                    update_option( 'cfc-global-notice', $global_notice );
                    update_option( 'cfc-charge-status', 'paid' );


                    if( ! function_exists( 'get_plugin_data' ) ) {
                            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                        }
                        
                    $plugin_data = get_plugin_data( CFC_PLUGIN_FILE );

                    $shop_info = array(
                                    'version' => $plugin_data['Version'],
                                );

                    $response = $CFC_Carbonclick_Laravel_API->cfc_update_shop_info( $shop_info, $create_shop_response['access_token'] );

                }else{

                    $cfc_onboarding_status['steps']['step-'.$onboarding_current_step] = 'pending';
                    $cfc_onboarding_status['stripe_data']['stripe_process_completed'] = false;
                    $cfc_onboarding_status['stripe_data']['errors']                   = $create_shop_response;
                    
                    $global_notice = get_option( 'cfc-global-notice' );
                    $global_notice['payment_failure'] = $create_shop_response['message'];
                    update_option( 'cfc-global-notice', $global_notice );
                    update_option( 'cfc-charge-status', 'fail' );
                }
            }

            if($action == "update_card"){
                /*
                * When update card hook executed
                */

                $args = array(
                           'setupintent_id'  => $stripeToken,
                        );

                $cfc_charge_status  = get_option( 'cfc-charge-status' );
                
                if($cfc_charge_status != "paid"){
                    $args['charge_status'] = 'fail';
                    $args['number'] = (new CFC_Admin_Init())->get_order_ids_where_charge_fail();
                }

                $update_card_response = $CFC_Carbonclick_Laravel_API->cfc_update_card($args);
                
                if( !empty( $update_card_response['success'] ) && ( $update_card_response['success'] == true || $update_card_response['success'] == 1 ) ){
                    
                    $cfc_onboarding_status['stripe_data']['stripe_process_completed']   = true;
                    $cfc_onboarding_status['stripe_data']['errors']                     = "";
                    $global_notice = get_option( 'cfc-global-notice' );

                    $global_notice['payment_failure'] = "";
                    $global_notice['card_update_notice'] = "";
                    
                    update_option( 'cfc-global-notice', $global_notice );
                    add_action( 'admin_notices', array( $this, 'card_details_update_success' ) );
                    update_option( 'cfc-charge-status', 'paid' );

                }else{
                    $cfc_onboarding_status['stripe_data']['stripe_process_completed'] = false;
                    $cfc_onboarding_status['stripe_data']['errors']                   = $update_card_response;

                    $global_notice = get_option( 'cfc-global-notice' );
                    $global_notice['card_update_notice'] = $update_card_response['message'];

                    update_option( 'cfc-global-notice', $global_notice );
                }
            }
        }

        return $cfc_onboarding_status;
    }

    public function admin_notices(){

        ?>
        <div class="cfc-updated">
          <p>Settings saved successfully</p>
        </div>
       <?php
       
    }

    public function card_details_update_success(){

        ?>
        <div class="cfc-updated">
          <p>Card details saved successfully</p>
        </div>
       <?php
       
    }


    public function card_details_update_fail(){

        ?>
        <div class="cfc-error">
          <p>something wrong with the card details.</p>
        </div>
       <?php
       
    }

    /*
    * ajax callback function for dashboard switch button to mark as done
    */
    public function dasbhoard_cards_callback() {

        $name   = sanitize_text_field( $_POST['name'] );
        $value  = sanitize_text_field( $_POST['value'] );

        $cfc_onboarding_status          = get_option( 'cfc-onboarding-status' );
        $cfc_onboarding_status[$name]   = $value;

        update_option( 'cfc-onboarding-status', $cfc_onboarding_status );
        
        $result['type'] = "success";

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
        }
        else {
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        die();
    }


    /*
    * ajax callback function for dashboard switch button to mark as done
    */
    public function rewards_redemption_request_callback() {

        $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
        $fetch_card_response = $CFC_Carbonclick_Laravel_API->cfc_fetch_customer();

        $earned_rewards = $fetch_card_response['reward'];
        $success = false;
        if( $earned_rewards >= 50 ){
            $redemption_method  = sanitize_text_field( $_POST['redemption_method'] );
            $store_email        = empty( $_POST['store_email'] ) ? "No Email Found" : sanitize_text_field( $_POST['store_email'] );
            $store_url          = sanitize_text_field( $_POST['store_url'] );

            $args = array(
                        "redeem_method" => $redemption_method
                    );

            $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
            $fetch_card_response            = $CFC_Carbonclick_Laravel_API->cfc_redeem_rewards( $args );
            if( !empty( $fetch_card_response['success'] ) && ($fetch_card_response['success'] == true || $fetch_card_response['success'] == 1 ) ){
                $success = true;
            }
        }
        
        if( $success ){
            $result['type'] = "success";

            $success_html = "<div class='success_reward_redemption'>";
            $success_html .= "<p>Thank you!</p>";
            $success_html .= "<p>We'll be in touch soon.</p>";
            $success_html .= "<span>Questions? Email <a target='_blank' href='mailto:hello@carbonclick.com'>hello@carbonclick.com</a></span>";
            $success_html .= "<div class='success-cont-btn'><a href='".CFC_FRIENDLY_REWARD_URL."'>Continue!</a></div>";
            $success_html .= "</div>";

            $result['html'] = $success_html;
        }else{
            $result['type'] = "fail";
                $error_html = "<div class='error_reward_redemption'>";
                $error_html .= "<p>Something goes wrong!</p>";
                $error_html .= "<span>Questions? Email <a target='_blank' href='mailto:hello@carbonclick.com'>hello@carbonclick.com</a></span>";
                $error_html .= "<div class='success-cont-btn'><a href='".CFC_FRIENDLY_REWARD_URL."'>Click here to check balance!</a></div>";
                $error_html .= "</div>";
            $result['html'] = $error_html;
        }

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
           $result = json_encode($result);
           echo $result;
        }
        else {
           header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        die();
    }



    /*
    *This snippet is used to update the featured image of the product based on look and feel data
    */
    public function update_featured_image_on_look_and_feel_callback($cfc_look_and_feel = array()){
        $cfc_onboarding_status = get_option( 'cfc-onboarding-status' );
        if(isset($cfc_onboarding_status['carbon_offset_product_id'])){
            
            $product_id                 = $cfc_onboarding_status['carbon_offset_product_id'];
            
            $carbonclick_product_image  = $cfc_look_and_feel['carbonclick_product_image'];

            $cfc_carbon_product_image_as_featured   = get_post_meta( $product_id, 'cfc_carbon_product_image_as_featured', true );

            if($cfc_carbon_product_image_as_featured != $carbonclick_product_image ){

                    update_post_meta( $product_id, 'cfc_carbon_product_image_as_featured', $carbonclick_product_image );
                
                    $image_url = CFC_PLUGIN_URL."assets/images/look-and-feel/cloud-".$carbonclick_product_image.".png";
                
                    $this->cfc_generate_featured_image_look_feel_callback($image_url, $product_id);
            }
        }

        return true;
    }
    

    /*
    * This function is used to update the featured image based on setting done in look and feel tab
    */
    public function cfc_generate_featured_image_look_feel_callback( $image_url, $post_id  ){
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($image_url);
        $filename   = basename($image_url);
        
        if(has_post_thumbnail( $post_id )){
            $attachment_id = get_post_thumbnail_id( $post_id );
            wp_delete_attachment($attachment_id, true);
        }

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
        set_post_thumbnail( $post_id, $attach_id );
    }

} // end of class CFC_Admin_Save_Settings

$cfc_admin_save_settings = new CFC_Admin_Save_Settings;