<?php

namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Assest Manager Class
*/
class Assets{

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Assests]
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
        
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );

        // Elementor Editor Style
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_scripts' ] );

    }

    /**
     * [get_styles] All Style
     * @return [array]
     */
    public function get_styles(){

        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        $style_list = [

            'move-admin' => [
                'src'     => MOVE_ADDONS_ASSETS . 'admin/css/move-admin.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-icon' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/move-icon.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-common' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/common.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'cd-headline' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/cd-headline.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'swiper' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/swiper.min.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'slick' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/slick.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-accordion' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/accordion.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-image-accordion' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/image-accordion.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-animated-heading' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/animated-heading.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'cd-headline', 'move-common' ]
            ],

            'move-banner' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/banner.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-button' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/button.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-brand' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/brand.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common', 'swiper' ]
            ],

            'move-heading' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/heading.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-team' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/teammember.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common', 'swiper' ]
            ],

            'move-flipbox' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/flipbox.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-infobox' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/infobox.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-imagebox' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/imagebox.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-blockquote' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/blockquote.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-socialmedia' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/socialmedia.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-testimonial' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/testimonials.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common', 'swiper' ]
            ],

            'move-countdown' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/countdown.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-funfact' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/funfact.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-recentblog' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/recentblog.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-faq' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/faq.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-cf7' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/cf7.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-twentytwenty' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/twentytwenty.css',
                'version' => MOVE_ADDONS_VERSION,
            ],

            'move-imagecomparison' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/image-conparison.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','move-twentytwenty' ]
            ],

            'magnific-popup' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/magnific-popup.css',
                'version' => MOVE_ADDONS_VERSION,
            ],

            'ytplayer' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/jquery.mb.YTPlayer.min.css',
                'version' => MOVE_ADDONS_VERSION,
            ],

            'move-video' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/video.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','magnific-popup','ytplayer' ]
            ],

            'move-page-category-list' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/page-category-list.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-postlist' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/post-list.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-dropcap' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/dropcap.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-businesshours' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/business-hour.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-imagegrid-masonry' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/image-grid-masonry.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','magnific-popup' ]
            ],

            'move-newsticker' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/news-ticker.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','swiper' ]
            ],

            'move-inlinemenu' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/inline-menu.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-userlogin' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/user-login.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-filterable-gallery' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/filterable-gallery.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','magnific-popup' ]
            ],

            'move-advanced-tab' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/advanced-tab.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-job-manager' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/job-manager.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-feature-list' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/feature-list.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-callto-action' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/call-to-action.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-data-tables' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/datatables.min.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-data-table' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/data-table.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','move-data-tables' ]
            ],

            'move-fullcalendar' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/css/fullcalendar.min.css',
                'version' => MOVE_ADDONS_VERSION
            ],

            'move-event-calendar' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/event-calendar.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common','move-fullcalendar' ]
            ],

            'move-tooltip' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/tooltip.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-offcanvas' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/off-canvas.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-mailchimp' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/mailchimp.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common' ]
            ],

            'move-shop-product-grid' => [
                'src'     => MOVE_ADDONS_ASSETS . 'css/widget/shop-product-grid.css',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'move-common', 'slick' ]
            ],

        ];
        return $style_list;

    }

    /**
     * [get_scripts] All Script
     * @return [array]
     */
    public function get_scripts(){

        $script_list = [

            'move-admin' => [
                'src'     => MOVE_ADDONS_ASSETS . 'admin/js/admin.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-main' => [
                'src'     => MOVE_ADDONS_ASSETS . 'js/move-main.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'waypoints' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/waypoints.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'counterup' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.counterup.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-countdown' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.countdown.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-timecircles' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/TimeCircles.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'cd-headline' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/cd-headline.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'swiper' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/swiper.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'slick' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/slick.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-accordion' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/accordion.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-event-move' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.event.move.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-twentytwenty' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.twentytwenty.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'imagesloaded','move-event-move' ]
            ],

            'magnific-popup' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.magnific-popup.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'ytplayer' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.mb.YTPlayer.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'isotope' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/isotope.pkgd.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-tabslet' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/jquery.tabslet.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-data-tables' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/datatables.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-fullcalendar' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/fullcalendar.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-locales-all' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/locales-all.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery', 'move-fullcalendar' ]
            ],

            'move-popper' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/popper.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery' ]
            ],

            'move-tippy-bundle' => [
                'src'     => MOVE_ADDONS_ASSETS . 'lib/js/tippy-bundle.umd.min.js',
                'version' => MOVE_ADDONS_VERSION,
                'deps'    => [ 'jquery', 'move-popper' ]
            ],

        ];

        return $script_list;

    }

    /**
     * Register scripts and styles
     * @return void
     */
    public function register_assets() {
        $scripts = self::get_scripts();
        $styles  = self::get_styles();

        // Register Scripts
        foreach ( $scripts as $handle => $script ) {
            $deps = ( isset( $script['deps'] ) ? $script['deps'] : false );
            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        // Register Styles
        foreach ( $styles as $handle => $style ) {
            $deps = ( isset( $style['deps'] ) ? $style['deps'] : false );
            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        wp_localize_script( 'move-main', 'HTFMOVE',
            [
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
            ]
        );

        if( is_admin() ){
            wp_localize_script( 'move-admin', 'HTMOVE',
                [
                    'nonce' => wp_create_nonce( 'htmove_save_opt_nonce' ),
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'message'=>[
                        'btntxt'  => esc_html__( 'Save Changes', 'moveaddons' ),
                        'loading' => esc_html__( 'Saving...', 'moveaddons' ),
                        'success' => esc_html__( 'Saved All Data', 'moveaddons' ),
                    ]
                ]
            );
        }
        
    }

    /**
     * [editor_scripts]
     * @return [void] Load Editor Scripts
     */
    public function editor_scripts() {
        wp_enqueue_style( 'move-elementor-editor', MOVE_ADDONS_ASSETS . 'css/elementor-editor.css', MOVE_ADDONS_VERSION );
    }



}
