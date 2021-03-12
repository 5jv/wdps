<?php

namespace MoveAddons\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Assest Manager Class
*/
class Widgets_Control{

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
     * [init] Widgets_Control Initializes
     * @return [void]
     */
    public function init() {

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

    }

    /**
     * [widgets] widget List
     * @return [array]
     */
    public function widgets(){

        $widgets = [
            'accordion' => [
                'title' => esc_html__( 'Accordion', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'image-accordion' => [
                'title' => esc_html__( 'Image Accordion', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'animated-heading' => [
                'title' => esc_html__( 'Animated Heading', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'banner' => [
                'title' => esc_html__( 'Banner', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'button' => [
                'title' => esc_html__( 'Button', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'brand' => [
                'title' => esc_html__( 'Brand', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'heading' => [
                'title' => esc_html__( 'Heading', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'dual-color-heading' => [
                'title' => esc_html__( 'Dual Color Heading', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'flip-box' => [
                'title' => esc_html__( 'Flip Box', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'info-box' => [
                'title' => esc_html__( 'Info Box', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'image-box' => [
                'title' => esc_html__( 'Image Box', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'team-member' => [
                'title' => esc_html__( 'Team Member', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'blockquote' => [
                'title' => esc_html__( 'Block quote', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'social-media' => [
                'title' => esc_html__( 'Social Media', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'testimonial' => [
                'title' => esc_html__( 'Testimonial', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'countdown' => [
                'title' => esc_html__( 'Countdown', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'fun-fact' => [
                'title' => esc_html__( 'Fun Fact', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'recent-blog' => [
                'title' => esc_html__( 'Recent Blog', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'faq' => [
                'title' => esc_html__( 'Faq', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'cf7' => [
                'title' => esc_html__( 'Contact Form 7', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'image-comparison' => [
                'title' => esc_html__( 'Image comparison', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'video' => [
                'title' => esc_html__( 'Video', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'category-list' => [
                'title' => esc_html__( 'Category List', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'page-list' => [
                'title' => esc_html__( 'Page List', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'post-list' => [
                'title' => esc_html__( 'Post List', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'drop-cap' => [
                'title' => esc_html__( 'Drop Cap', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'dual-button' => [
                'title' => esc_html__( 'Dual Button', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'business-hours' => [
                'title' => esc_html__( 'Business Hours', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'image-grid' => [
                'title' => esc_html__( 'Image Grid', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'image-masonry' => [
                'title' => esc_html__( 'Image Masonry', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'news-ticker' => [
                'title' => esc_html__( 'News Ticker', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'inline-menu' => [
                'title' => esc_html__( 'Inline Menu', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'user-login' => [
                'title' => esc_html__( 'User Login', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'filterable-gallery' => [
                'title' => esc_html__( 'Filterable gallery', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'advanced-tab' => [
                'title' => esc_html__( 'Advanced Tab', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'feature-list' => [
                'title' => esc_html__( 'Feature List', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'mailchimp' => [
                'title' => esc_html__( 'MailChimp', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'call-to-action' => [
                'title' => esc_html__( 'Call To Action', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'data-table' => [
                'title' => esc_html__( 'Data Table', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'event-calendar' => [
                'title' => esc_html__( 'Event Calender', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'tooltip' => [
                'title' => esc_html__( 'Tooltip', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'off-canvas' => [
                'title' => esc_html__( 'Off Canvas', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],
            'remote-template' => [
                'title' => esc_html__( 'Remote template', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ],

        ];

        if( class_exists( '\WP_Job_Manager' ) ){
            $widgets['job-manager'] = [
                'title' => esc_html__( 'Job Manager', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ];
        }

        if( class_exists( '\WooCommerce' ) ){
            $widgets['shop-product-grid'] = [
                'title' => esc_html__( 'Shop product grid', 'moveaddons' ),
                'description' => '',
                'is_pro' => false,
                'enable' => true,
            ];
        }

        return apply_filters( 'move_widgets', $widgets );

    }

    /**
     * [init_widgets] Register Widgets
     * @return [void]
     */
    public function register_widgets(){
        include_once( MOVE_ADDONS_PL_PATH . 'base/widget-base.php' );

        $widget_list = $this->widgets();
        $widget = get_option( 'htmove_widget_list', $widget_list );
        $widget_list = array_merge( $widget_list, $widget );
        
        // Include Widget files
        foreach ( $widget_list as $widget_key => $widget ){
            if( $widget['enable'] === true ){
                $file_path = MOVE_ADDONS_PL_PATH .'includes/widgets/'.$widget_key.'/widget.php';
                $generate_name = str_replace('-','_', $widget_key );
                
                if ( file_exists( $file_path ) ){
                    include_once( $file_path );
                    $class_name = 'MoveAddons\Elementor\Widget\\'.$generate_name.'_Element';
                    move_addons_get_elementor()->widgets_manager->register_widget_type( new $class_name() );
                }
            }
        }


    }



}