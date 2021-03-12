<?php
/**
 * Plugin Name: Move Addons for Elementor
 * Description: Move Addons is an Elementor Page builder widget plugin. The only Elementor Addon you will ever need! Take Your Website to the whole new level with 80+ Elementor Widgets.
 * Plugin URI:  https://demo.moveaddons.com
 * Author:      moveaddons
 * Author URI:  https://moveaddons.com
 * Version:     1.0.8
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: moveaddons
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

define( 'MOVE_ADDONS_VERSION', '1.0.8' );
define( 'MOVE_ADDONS_FILE', __FILE__ );
define( 'MOVE_ADDONS_PL_PATH', plugin_dir_path( MOVE_ADDONS_FILE ) );
define( 'MOVE_ADDONS_DIR_URL', plugin_dir_url( MOVE_ADDONS_FILE ) );
define( 'MOVE_ADDONS_BASE', plugin_basename( MOVE_ADDONS_FILE ) );
define( 'MOVE_ADDONS_ASSETS', trailingslashit( MOVE_ADDONS_DIR_URL . 'assets' ) );

require_once MOVE_ADDONS_PL_PATH . 'base/move-base.php';
\MoveAddons\Elementor\move_addons();