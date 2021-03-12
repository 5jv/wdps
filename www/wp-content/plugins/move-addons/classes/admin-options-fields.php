<?php
namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Admin_Options_Fields{

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
     * [widgets] widgets option field list
     * @return [array] widgets
     */
    public function widgets(){
        return Widgets_Control::instance()->widgets();
    }

    /**
     * [userdata] userdata option field
     * @return [array] userdata
     */
    public function userdata(){
        $userdata = [
            'mailchimpapi' => [
                'title' => esc_html__( 'Mail Chimp', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'value'  => move_addons_is_option('htmove_userdata_list','mailchimpapi','value'),
            ],
        ];
        return apply_filters( 'move_userdata', $userdata );
    }

    /**
     * [modules] module option field
     * @return [array] module list
     */
    public function modules(){

        $modules = [
            'crossdomaincp' => [
                'title' => esc_html__( 'Cross Domain Copy Paste', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],

            'megamenubuilder' => [
                'title' => esc_html__( 'MegaMenu Builder', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],

            'customcss' => [
                'title' => esc_html__( 'Custom CSS', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ]
        ];
        
        return apply_filters( 'move_module', $modules );
    }

    /**
     * [pro_widgets] pro widgets
     * @return [array] pro widgets list
     */
    public function pro_widgets(){
        $pro_widgets = [
            'comparison-table' => [
                'title' => esc_html__( 'Comparison Table', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'instagram-feed' => [
                'title' => esc_html__( 'Instagram Feed', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'motion-text' => [
                'title' => esc_html__( 'Motion Text', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'twitter-feed' => [
                'title' => esc_html__( 'Twitter Feed', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'google-map' => [
                'title' => esc_html__( 'Google Map', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'image-marker' => [
                'title' => esc_html__( 'Image Marker', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'panel-slider' => [
                'title' => esc_html__( 'Panel Slider', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'user-register' => [
                'title' => esc_html__( 'User Register', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'flip-carousel' => [
                'title' => esc_html__( 'Flip Carousel', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'interactive-cards' => [
                'title' => esc_html__( 'Interactive Cards', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'timeline-content' => [
                'title' => esc_html__( 'Timeline Content', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'image-scrolling' => [
                'title' => esc_html__( 'Image Scrolling', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'protected-content' => [
                'title' => esc_html__( 'Protected Content', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'post-slider' => [
                'title' => esc_html__( 'Post Slider', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'pricing-table' => [
                'title' => esc_html__( 'Pricing Table', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'pricing-list' => [
                'title' => esc_html__( 'Pricing List', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'pricing-menu' => [
                'title' => esc_html__( 'Pricing Menu', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'interactive-content' => [
                'title' => esc_html__( 'Interactive Content', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'onepage-navigation' => [
                'title' => esc_html__( 'Onepage Navigation', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'divider' => [
                'title' => esc_html__( 'Divider', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'advanced-list' => [
                'title' => esc_html__( 'Advanced List', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'blog-list' => [
                'title' => esc_html__( 'Blog List', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'search-form' => [
                'title' => esc_html__( 'Search Form', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'product-category' => [
                'title' => esc_html__( 'Product Category', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'product-carousel' => [
                'title' => esc_html__( 'Product Carousel', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'product-tab' => [
                'title' => esc_html__( 'Product Tab', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'product-table' => [
                'title' => esc_html__( 'Product Table', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'mini-cart' => [
                'title' => esc_html__( 'Mini Cart', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'product-list' => [
                'title' => esc_html__( 'Product List', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'megamenu-horizontal' => [
                'title' => esc_html__( 'MegaMenu Horizontal', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],
            'megamenu-vertical' => [
                'title' => esc_html__( 'MegaMenu Vertical', 'moveaddons' ),
                'description' => '',
                'is_pro' => true,
                'enable' => false,
            ],

        ];
        
        return apply_filters( 'move_prowidget', $pro_widgets );
    }

    /**
     * [get_option] Get Option value
     * @param  [string] $key
     * @return [array]
     */
    public function get_option( $key, $default ){
        return get_option( $key, $default );
    }

}