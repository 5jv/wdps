<?php
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class MailChimp{

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [MailChimp]
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * [init] MailChimp Initializes
     * @return [void]
     */
    public function init() {

        add_action( 'wp_ajax_htmove_addons_mailchimp_data_save', [ $this, 'mailchimp_data' ] );

    }

    public function mailchimp_data() {
        if ( isset( $_POST['fields'] ) ) {
            $form_data = ( !empty( $_POST['fields'] ) ? sanitize_text_field( $_POST['fields'] ) : '' );
            parse_str( $form_data, $data );
        } else {
            return;
        }
        
        if ( empty( $data['email'] ) ) {
            return "Email is required!";
        }

        $api = move_addons_is_option('htmove_userdata_list','mailchimpapi','value');
        $server = explode('-', $api);
        
        $email      = $data['email'] ? $data['email'] : '';
        $first_name = $data['first_name'] ? $data['first_name'] : '';
        $last_name  = $data['last_name'] ? $data['last_name'] : '';
        $list       = $data['list'] ? $data['list'] : '';
        $member_id   = md5(strtolower($email));

        $url = 'https://'.$server[1].'api.mailchimp.com/3.0/lists/'.$list.'/members/'.$member_id;

        $data = [
            "email_address" => $email,
            "status" => "subscribed",
            "merge_fields" => [
                "FNAME" => $first_name,
                "LNAME" => $last_name
            ]
        ];

        $response = wp_remote_post( $url, [
            'method'  => 'PUT',
            'body'    => json_encode( $data ),
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode( 'user:' . $api )
            ],
        ]);
        
        $response_body = json_decode( wp_remote_retrieve_body( $response ) );
        
        if ( $response_body->status == "subscribed" ) {
            return true;
        } else {
            return false;
        }
    }

}
