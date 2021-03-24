<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
* CFC_Enqueue_Scripts class responsable to load all the scripts and styles.
*/
class CFC_Enqueue_Scripts {

    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ), 200 );
        add_action( 'wp_enqueue_scripts', array( $this, 'public_dynamic_resources'), 200 );

    }

    public function public_enqueue_scripts() {
        // Load public scripts
        wp_enqueue_style( 'cfc-public-style', CFC_PLUGIN_URL . 'assets/css/cfc-public-style.css', array(), CFC_PLUGIN_VER );
        wp_enqueue_script( 'cfc-public-script', CFC_PLUGIN_URL . 'assets/js/cfc-public-script.js', array( 'jquery' ), CFC_PLUGIN_VER, true );
    }

    public function public_dynamic_resources() {
        
        $cfc_look_and_feel_options = get_option('cfc_look_and_feel_options');
        extract($cfc_look_and_feel_options);

        $dynamic_css = '';

        // Dynamic bg color
        $dynamic_css .= '.cfc-cart-wrapper-main {
            border-color: ' . esc_html( $plugin_border_color ) . ';
            background-color  : ' . esc_html( $plugin_background_color ) . ';
        }';

        $dynamic_css .= '.cfc-dropdown-body {
            background-color  : ' . esc_html( $plugin_background_color_expanded ) . ';
        }';

        $dynamic_css .= '.cfc-content .cfc-content-title, #cfc-learn-more {
            color: ' . esc_html( $plugin_text_colour_top_section ) . ';
        }';

        $dynamic_css .= '#cfc-dropdown h5 {
            color: ' . esc_html( $plugin_large_text_colour_expanded ) . ';
        }';

        $dynamic_css .= '.help-fund-text, .cfc-tagline, .cfc-stat-number, .cfc-stat-name {
            color: ' . esc_html( $plugin_small_text_colour_expanded ) . ';
        }';

        $dynamic_css .= '.cfc-carbo-offset-button button {
            border-color: ' . esc_html( $button_border_colour ) . ';
            background: ' . esc_html( $button_background_colour ) . ';
            color: ' . esc_html( $button_text_colour ) . ';
        }';

        $dynamic_css .= 'span.cfc-offset-plus {
            color: ' . esc_html( $button_plus_icon_colour ) . ';
        }';

        $dynamic_css .= '.cfc-thankyou-button button {
            background: ' . esc_html( $button_background_colour_selected ) . ';
            color: ' . esc_html( $button_text_colour_selected ) . ';
        }';

        $dynamic_css .= '.cc-add-button-tick svg path {
            fill: ' . esc_html( $button_checkmark_icon_selected ) . ';
        }';
        
        $dynamic_css .= '.cfc-angle-down {
            border-color: ' . esc_html( $plugin_icons_color ) . ';
        }
        .help-fund-wrapper .help-fund svg path,
        .cfc-stat svg path {
           stroke: ' . esc_html( $plugin_icons_color ) . ';
        }
        .help-fund-wrapper .windmill_svg .st0 {
           stroke: ' . esc_html( $plugin_icons_color ) . ' !important;
           fill: ' . esc_html( $plugin_icons_color ) . ';
        }
        .cfc-stat-icon-2 svg path,
        .cfc-stat-icon-3 svg path:first-child,
        .cfc-tagline svg path:first-child, .cc-hidden-mobile svg path {
           fill: ' . esc_html( $plugin_icons_color ) . ';
        }';

        wp_add_inline_style( 'cfc-public-style', $dynamic_css );
    }
    
} // end of class CFC_Enqueue_Scripts

$cfc_enqueue_scripts = new CFC_Enqueue_Scripts;