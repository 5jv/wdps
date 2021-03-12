<?php
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Installer class
 */
class Notices {

    /**
     * Elementor minimum version
     * @var string
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';

    /**
     * PHP minimum version
     * @var string
     */
    const MINIMUM_PHP_VERSION = '5.4';

    /**
     * Run the Notices
     *
     * @return void
     */
    public function notice() {
        $this->all_notices();
    }

    /**
     * Add Notices
     */
    public function all_notices() {

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

    }

    /**
     * [admin_notice_missing_main_plugin] Admin notice for Elementor
     * @return [void]
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor = 'elementor/elementor.php';
        if( $this->is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
            $button_text = '<p><a href="' . $activation_url . '" class="button-primary">' . __( 'Activate Elementor', 'moveaddons' ) . '</a></p>';
        } else {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $button_text = '<p><a href="' . $activation_url . '" class="button-primary">' . __( 'Install Elementor', 'moveaddons' ) . '</a></p>';
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'moveaddons' ),
            '<strong>' . esc_html__( 'Move Addons', 'moveaddons' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'moveaddons' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', $message, $button_text );

    }

    /**
     * [admin_notice_minimum_elementor_version] Admin notice for elementor require version
     * @return [void]
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'moveaddons' ),
            '<strong>' . esc_html__( 'Move Addons', 'moveaddons' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'moveaddons' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * [admin_notice_minimum_php_version] Admin notice for required PHP
     * @return [void]
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'moveaddons' ),
            '<strong>' . esc_html__( 'Move Addons', 'moveaddons' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'moveaddons' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /*
    * Check Plugins is Installed or not
    */
    public function is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }


}
