<?php
/*
* POST URL : SITEURL/wp-json/cfc_api/v1/carbonclick-webhook
*/
class CFC_Rest_Server extends WP_REST_Controller {
	private $api_namespace;
	private $api_version;
	
	public function __construct() {
		$this->api_namespace = 'cfc_api/v';
		$this->api_version = '1';
		$this->init();
	}
	
	
	public function register_routes() {
		$namespace = $this->api_namespace . $this->api_version;
		
		register_rest_route( $namespace, '/carbonclick-webhook', array(
			array( 'methods' => WP_REST_Server::EDITABLE, 'callback' => array( $this, 'carbonclick_webhook_callback' ), ),
		)  );
	}


	// Register our REST Server
	public function init(){
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}
	
	
	public function carbonclick_webhook_callback( WP_REST_Request $request ){
		$creds 		= array();
		$headers 	= getallheaders();
		$get_params = $request->get_params();
		
		$Authorization = $headers['Authorization'];
		$Authorization = explode(" ", $Authorization);
		$Authorization = $Authorization[1];

		if( trim($Authorization) == CFC_ACCESS_TOKEN ){
			
			$action_type 	= $get_params['type'];
			$message 		= $get_params['message'];

			if( $action_type == "charge_succeeded" || $action_type == "invoice_payment_succeeded" ){
				
				update_option( 'cfc-charge-status', 'paid' );
				$global_notice = get_option( 'cfc-global-notice' );
                $global_notice['payment_failure'] = "";
                update_option( 'cfc-global-notice', $global_notice );

			}else if( $action_type == "charge_failed" || $action_type == "invoice_payment_failed" ){
				
				update_option( 'cfc-charge-status', 'fail' );
				$global_notice = get_option( 'cfc-global-notice' );
                $global_notice['payment_failure'] = $message;
                update_option( 'cfc-global-notice', $global_notice );	

			}else if( $action_type == "blocked" ){
				
				update_option( 'cfc-widget-status', 'blocked' );
				$global_notice = get_option( 'cfc-global-notice' );
                $global_notice['payment_failure'] = $message;
                update_option( 'cfc-global-notice', $global_notice );
                
                $cfc_settings = get_option( 'cfc_settings_options' );
            	$cfc_settings['cfc_enable_widget_on_cart']  = 0;
            	update_option( 'cfc_settings_options', $cfc_settings );

			}else if( $action_type == "unblocked" ){
				
				update_option( 'cfc-widget-status', 'unblocked' );
				$global_notice = get_option( 'cfc-global-notice' );
                $global_notice['payment_failure'] = "";
                update_option( 'cfc-global-notice', $global_notice );	

			}
			
			return array( 'sucess' => true );
		}
		else {
			return new WP_Error( 'invalid-method', 'You must specify a valid username and password.', array( 'status' => 400 /* Bad Request */ ) );
		}
	}
}
 
$CFC_Rest_Server = new CFC_Rest_Server();
?>