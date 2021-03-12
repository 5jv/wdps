<?php
/**
 * Plugin base class
 * @package MoveAddons
 */
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Base Class
*/
final class Base{

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
            self::$_instance->include_files();
        }
        return self::$_instance;
    }
    
    /**
     * [__construct] Class Constructor
     */
    private function __construct(){

        register_activation_hook( MOVE_ADDONS_FILE, [ $this, 'activate' ] );

        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

    }

    /**
     * [i18n] Load text domain
     * @return [void]
     */
    public function i18n() {
        load_plugin_textdomain( 'moveaddons', false, dirname( plugin_basename( MOVE_ADDONS_FILE ) ) . '/languages/' );
    }

    /**
     * [init] Plugins loaded Initializes
     * @return [void]
     */
    public function init() {

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        Assets::instance()->init();
        Widgets_Control::instance()->init();
        Login_Register_Manager::instance()->init();
        MailChimp::instance()->init();
        QuickView::instance()->init();

        // For Admin
        if ( is_admin() ) {
            $this->admin_notices();
            $this->redirect_option_page();
            Admin_Dashboard::instance()->init();
        }
        
        // Template Redirect Action Hook
        add_action( 'template_redirect', 'move_addons_view_count' );

        // Footer Content
        add_action( 'wp_footer', 'move_addons_in_footer' );


    }

    /**
     * Add custom category.
     * @param $elements_manager
     */
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'move_addon',
            [
                'title' => esc_html__( 'Move', 'moveaddons' ),
                'icon' => 'fa fa-snowflake-o',
            ]
        );
    }

    /**
     * [include_files] Necessary File
     * @return [void]
     */
    public function include_files(){
        if ( ! function_exists('is_plugin_active') ){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }

        include_once ( MOVE_ADDONS_PL_PATH . 'classes/installer.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'includes/helper-functions.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/admin-notices.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/assets.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/widgets-control.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/menu-walker.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/login-register-manager.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/mailchimp.php' );
        include_once ( MOVE_ADDONS_PL_PATH . 'classes/quick-view.php' );

        if ( is_admin() ) {
            include_once ( MOVE_ADDONS_PL_PATH . 'classes/admin-options-fields.php' );
            include_once ( MOVE_ADDONS_PL_PATH . 'classes/admin-dashboard.php' );
        }

    }

    /**
     * Plugin activation
     * @return void
     */
    public function activate() {
        $installer = new Installer();
        $installer->run();
    }

    /**
     * Admin Notices
     * @return void
     */
    public function admin_notices() {
        $notice = new Notices();
        $notice->notice();
    }

    /**
     * [redirect_option_page] After Active the plugin then redirect to option page
     * @return [void]
     */
    public function redirect_option_page() {
        if ( get_option( 'move_do_activation_redirect', FALSE ) ) {
            delete_option('move_do_activation_redirect');
            if( !isset( $_GET['activate-multi'] ) ){
                wp_redirect( admin_url("admin.php?page=move-elementor#welcome") );
            }
        }
    }

}

/**
 * Initializes the main plugin
 *
 * @return \Base
 */
function move_addons() {
    return Base::instance();
}