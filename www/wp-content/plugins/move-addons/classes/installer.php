<?php
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Installer class
 */
class Installer {

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->deactivate();
        $this->add_version();
        $this->disable_pro_elemets();
        $this->add_redirection_flag();
    }

    /**
     * Add time and version on DB
     */
    public function add_version() {
        $installed = get_option( 'move_installed' );

        if ( ! $installed ) {
            update_option( 'move_installed', time() );
        }

        update_option( 'MOVE_ADDONS_VERSION', MOVE_ADDONS_VERSION );
    }

    /**
     * [add_redirection_flag] redirection flug
     */
    public function add_redirection_flag(){
        add_option( 'move_do_activation_redirect', true );
    }

    /**
     * [deactivate] Deactivated Pro version
     * @return [void]
     */
    public function deactivate(){
        if( is_plugin_active('move-addons-pro/move-addons-pro.php') ){
            add_action('update_option_active_plugins', function(){
                deactivate_plugins('move-addons-pro/move-addons-pro.php');
            });
        }
    }

    /**
     * [disable_pro_elemets] Pro Element Disable
     * @return [void]
     */
    public function disable_pro_elemets(){
        $widgets  = Admin_Options_Fields::instance()->widgets();
        $userdataes = Admin_Options_Fields::instance()->userdata();
        $modules = Admin_Options_Fields::instance()->modules();
        update_option( 'htmove_widget_list', $widgets );
        update_option( 'htmove_userdata_list', $userdataes );
        update_option( 'htmove_module_list', $modules );
    }


}
