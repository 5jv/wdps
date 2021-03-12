<?php
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Login_Register_Manager{

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Base]
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * [init] Assets Initializes
     * @return [void]
     */
    public function init() {
        /**
         * Check user Login and call this function
         */
        global $user;
        if ( empty( $user->ID ) ) {
            add_action('elementor/init', [ $this, 'login_init' ] );
        }

    }

    /**
     * [login_init]
     * @return
     */
    public function login_init() {
        add_action( 'wp_ajax_nopriv_move_ajax_login', [ $this,'login_ajax' ] );
    }

    /**
     * [login_ajax] Ajax Callable Function
     * @return
     */
    public function login_ajax(){
        check_ajax_referer( 'htmove_login_nonce', 'security' );

        $user_data = array();
        $user_data['user_login'] = !empty( $_POST['username'] ) ? sanitize_text_field($_POST['username'] ) : "";
        $user_data['user_password'] = !empty( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : "";
        $user_data['remember'] = true;
        $user_signon = wp_signon( $user_data, false );

        if ( is_wp_error($user_signon) ){
            echo json_encode( 
                [ 
                    'loggeauth'=>false, 
                    'message'=> esc_html__('Invalid username or password!', 'moveaddons')
                ] 
            );
        } else {
            echo json_encode( 
                [ 
                    'loggeauth'=>true, 
                    'message'=> esc_html__('Login Successfully', 'moveaddons') 
                ] 
            );
        }
        wp_die();
    }


}