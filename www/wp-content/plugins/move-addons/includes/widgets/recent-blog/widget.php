<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Recent_Blog_Element extends Base {

    public function get_name() {
        return 'move-recent-blog';
    }

    public function get_title() {
        return esc_html__( 'Recent Blog', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-columns';
    }

    public function get_keywords() {
        return [ 'move', 'blog', 'post', 'recent blog', 'news' ];
    }

    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-recentblog'];
    }

    public function get_script_depends() {
        return [ 'swiper', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Query Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'categories',
                [
                    'label' => esc_html__( 'Categories', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => move_addons_get_taxonomies(),
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label' => esc_html__('Limit', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label' => esc_html__( 'Custom order', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'postorder',
                [
                    'label' => esc_html__( 'Order', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending','moveaddons'),
                        'ASC'   => esc_html__('Ascending','moveaddons'),
                    ],
                    'condition' => [
                        'custom_order!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__( 'Orderby', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None','moveaddons'),
                        'ID'            => esc_html__('ID','moveaddons'),
                        'date'          => esc_html__('Date','moveaddons'),
                        'name'          => esc_html__('Name','moveaddons'),
                        'title'         => esc_html__('Title','moveaddons'),
                        'comment_count' => esc_html__('Comment count','moveaddons'),
                        'rand'          => esc_html__('Random','moveaddons'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        /* Additional Options */
        $this->start_controls_section(
            'additional_option',
            [
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'blog_style',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style one', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                        'three' => esc_html__( 'Style Three', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'full',
                    'separator' => 'none',
                    'fields_options'=>[
                        'size'=>[
                            'label'=> esc_html__( 'Image Size', 'moveaddons' ),
                        ],
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'smthumbnail',
                    'default' => 'thumbnail',
                    'separator' => 'none',
                    'fields_options'=>[
                        'size'=>[
                            'label'=> esc_html__( 'Thumbnail Image Size', 'moveaddons' ),
                        ],
                    ],
                    'condition'=>[
                        'blog_style'=>'three',
                    ],
                ]
            );

            $this->add_control(
                'title_len',
                [
                    'label' => esc_html__('Title Length', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                ]
            );

            $this->add_control(
                'content_len',
                [
                    'label' => esc_html__('Content Length', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 15,
                ]
            );

            $this->add_control(
                'default_enable',
                [
                    'label' => esc_html__( 'Default Date Formate', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'read_more_txt',
                [
                    'label' => esc_html__( 'Read More Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Learn More', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'meta_info_position',
                [
                    'label' => esc_html__( 'Meta Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'after',
                    'options' => [
                        'after'  => esc_html__( 'After Title', 'moveaddons' ),
                        'before' => esc_html__( 'Before Title', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'blog_style!'=>['three','two']
                    ],
                ]
            );

            $this->add_control(
                'all_post_btn_before',
                [
                    'label' => esc_html__( 'View Post Button before text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Suspe ndisse suscipit sagittis leoagi.', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'blog_style'=>'three',
                    ],
                ]
            );

            $this->add_control(
                'all_post_btn_before_color',
                [
                    'label' => __( 'View Post Button before text Color', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} p.htmove-btn-all-post-before' => 'color: {{VALUE}} !important',
                    ],
                    'condition'=>[
                        'blog_style'=>'three',
                        'all_post_btn_before!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'all_post_btn',
                [
                    'label' => esc_html__( 'View Post Button', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'View All Post', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'blog_style'=>'three',
                    ],
                ]
            );

            $this->add_control(
                'all_post_btn_link',
                [
                    'label' => esc_html__( 'View Post Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '#', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'blog_style'=>'three',
                    ],
                ]
            );
            
            $this->add_control(
                'slider_enable',
                [
                    'label' => esc_html__( 'Slider', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator'=>'before',
                    'condition'=>[
                        'blog_style!'=>'three',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__( 'One', 'moveaddons' ),
                        '2' => esc_html__( 'Two', 'moveaddons' ),
                        '3' => esc_html__( 'Three', 'moveaddons' ),
                        '4' => esc_html__( 'Four', 'moveaddons' ),
                        '5' => esc_html__( 'Five', 'moveaddons' ),
                        '6' => esc_html__( 'Six', 'moveaddons' ),
                        '7' => esc_html__( 'Seven', 'moveaddons' ),
                        '8' => esc_html__( 'Eight', 'moveaddons' ),
                        '9' => esc_html__( 'Nine', 'moveaddons' ),
                        '10'=> esc_html__( 'Ten', 'moveaddons' ),
                    ],
                    'label_block' => true,
                    'prefix_class' => 'htmove-columns%s-',
                    'condition'=>[
                        'slider_enable!'=>'yes',
                        'blog_style!'=>'three',
                    ],
                ]
            );

            $this->add_control(
                'no_gutters',
                [
                    'label' => esc_html__( 'No Gutters', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'slider_enable!'=>'yes',
                        'blog_style!'=>'three',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_space',
                [
                    'label' => esc_html__( 'Space', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-row > [class*="col-"]' => 'padding: 0  {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'slider_enable!'=>'yes',
                        'blog_style!'=>'three',
                    ],
                ]
            );

        $this->end_controls_section();

        // Slider Item Section Start
        $this->start_controls_section(
            'slider_item_options',
            [
                'label' => esc_html__( 'Slider Item Options', 'moveaddons' ),
                'condition'=>[
                    'slider_enable'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'slider_item',
                [
                    'label' => esc_html__('Slider Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3,
                ]
            );

            $this->add_control(
                'desktop_item',
                [
                    'label' => esc_html__('Desktop Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3,
                ]
            );

            $this->add_control(
                'tablet_item',
                [
                    'label' => esc_html__('Tablet Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'small_mobile_item',
                [
                    'label' => esc_html__('Small mobile Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'large_mobile_item',
                [
                    'label' => esc_html__('Large mobile', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'landscape_mobile_item',
                [
                    'label' => esc_html__('Mobile landscape', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

        $this->end_controls_section();

        // Slider Options Section Start
        $this->start_controls_section(
            'slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'moveaddons' ),
                'condition'=>[
                    'slider_enable'=>'yes',
                ],
            ]
        );

            $this->add_control(
                'slider_speed',
                [
                    'label' => esc_html__('Speed', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                ]
            );

            $this->add_control(
                'slider_spacebetween',
                [
                    'label' => esc_html__('Space Between', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 30,
                ]
            );

            $this->add_control(
                'slider_loop',
                [
                    'label' => esc_html__( 'Repeatable Loop', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'slider_autoplay',
                [
                    'label' => esc_html__( 'Autoplay', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_autoplay_delay',
                [
                    'label' => esc_html__('Autoplay Delay', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3500,
                    'condition'=>[
                        'slider_autoplay'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'slider_arrow',
                [
                    'label' => esc_html__( 'Slider Navigation', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_arrow_on_hover',
                [
                    'label' => esc_html__( 'Navigation Show On Hover', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'slider_dots',
                [
                    'label' => esc_html__( 'Slider Pagination', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_dots_on_hover',
                [
                    'label' => esc_html__( 'Pagination Show On Hover', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'slider_dots'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'next_icon',
                [
                    'label' => esc_html__( 'Next Navigation Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'nexticon',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'prev_icon',
                [
                    'label' => esc_html__( 'Previous Navigation Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'previcon',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

        $this->end_controls_section(); // Slider Options Section End

        // Item area Style tab section
        $this->start_controls_section(
            'item_area_style',
            [
                'label' => esc_html__( 'Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'blog_style!'=>'three',
                ],
            ]
        );
            
            $this->add_control(
                'item_area_padding',
                [
                    'label' => esc_html__( 'Content Area Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'item_area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blog',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'item_area_hover_box_shadow',
                    'label' => esc_html__( 'Hover Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blog:hover',
                ]
            );

        $this->end_controls_section();

        // Image Style tab section
        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blog .htmove-blog-image img',
                ]
            );

            $this->add_control(
                'image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-blog .htmove-blog-image::before' => 'left:{{LEFT}}{{UNIT}};right:{{RIGHT}}{{UNIT}};width:auto;height:auto;top:{{TOP}}{{UNIT}};bottom:{{BOTTOM}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
                'image_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('image_style_tabs');

                $this->start_controls_tab(
                    'image_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'image_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-image::before' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_overlay_opacity',
                        [
                            'label' => esc_html__( 'Overlay Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-image::before' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'image_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'image_hover_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog:hover .htmove-blog-image::before' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_hover_overlay_opacity',
                        [
                            'label' => esc_html__( 'Overlay Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog:hover .htmove-blog-image::before' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Title Style tab section
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-title a' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-title a:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blog .htmove-blog-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content Style tab section
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blog .htmove-blog-text',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blog .htmove-blog-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Meta Info Style tab section
        $this->start_controls_section(
            'content_meta_style',
            [
                'label' => esc_html__( 'Meta Info', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('meta_style_tabs');

                $this->start_controls_tab(
                    'meta_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'post_meta_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-meta li' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'post_meta_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-blog .htmove-blog-meta li',
                        ]
                    );

                    $this->add_responsive_control(
                        'post_meta_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator'=>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'post_meta_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'meta_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'post_meta_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-blog .htmove-blog-meta li a:hover' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'read_more_btn_style_section',
            [
                'label' => esc_html__( 'Read More Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('read_more_btn_style_tabs');

                $this->start_controls_tab(
                    'read_more_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'read_more_btn_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link' => 'color: {{VALUE}};',
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'read_more_btn_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'read_more_btn_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_btn_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'read_more_btn_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_btn_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_btn_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'read_more_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'read_more_btn_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn:hover,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'read_more_btn_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn:hover,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_btn_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn:hover,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'read_more_btn_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} [class*="htmove-blog"] .htmove-blog-btn:hover,{{WRAPPER}} [class*="htmove-blog"] .htmove-btn-link:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Slider Button style
        $this->start_controls_section(
            'slider_controller_style',
            [
                'label' => esc_html__( 'Slider Controller Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_enable'=>'yes',
                ],
            ]
        );

            $this->add_control(
                'navigation_style',
                [
                    'label' => esc_html__( 'Navigation Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'  => esc_html__( 'One', 'moveaddons' ),
                        'two' => esc_html__( 'Two', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->start_controls_tabs('sliderbtn_style_tabs');

                // Slider Button style Normal
                $this->start_controls_tab(
                    'sliderbtn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_style_heading',
                        [
                            'label' => esc_html__( 'Navigation Arrow', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_responsive_control(
                        'nvigation_offeset',
                        [
                            'label' => esc_html__( 'Navigation Offest', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 70,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-slider-area .swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'nvigation_size',
                        [
                            'label' => esc_html__( 'Size', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 30,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]::after' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"] i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_style_dots_heading',
                        [
                            'label' => esc_html__( 'Pagination', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_pos_toggle',
                            [
                                'label' => esc_html__( 'Position', 'moveaddons' ),
                                'type' => Controls_Manager::POPOVER_TOGGLE,
                                'default' => 'no',
                            ]
                        );

                        $this->start_popover();

                        $this->add_responsive_control(
                            'dots_x_position',
                            [
                                'label' => esc_html__( 'Horizontal Postion', 'moveaddons' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => '%',
                                    'size' => 50,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_y_position',
                            [
                                'label' => esc_html__( 'Vertical Postion', 'moveaddons' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                     'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => -40,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->end_popover();

                        $this->add_control(
                            'dots_bg_color',
                            [
                                'label' => esc_html__( 'Color', 'moveaddons' ),
                                'type' => Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet::before' => 'background-color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => esc_html__( 'Border', 'moveaddons' ),
                                'selector' => '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Normal button style end

                // Button style Hover
                $this->start_controls_tab(
                    'sliderbtn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_style_arrow_heading',
                        [
                            'label' => esc_html__( 'Navigation', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                    $this->add_control(
                        'button_style_dotshov_heading',
                        [
                            'label' => esc_html__( 'Pagination', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'dots_hover_bg_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'dots_border_hover',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before,{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before',
                        ]
                    );

                    $this->add_responsive_control(
                        'dots_border_radius_hover',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();// Hover button style end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Tab option end


    }

    protected function render( $instance = [] ) {
        $settings  = $this->get_settings_for_display();
        $column    = $this->get_settings_for_display('column');
        $id        = $this->get_id();

        $collumval = 'htmove-col-3';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-blog-area' );
        $this->add_render_attribute( 'item_attr', 'class', 'htmove-blog htmove-blog-'.$settings['blog_style'] );

        if( $settings['slider_enable'] != 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-row' );
        }
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        // Slider Option
        if( $settings['slider_enable'] === 'yes' ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-slider-area' );

            $this->add_render_attribute( 'slider_attr', 'class', 'htmove-swiper-slider swiper-container' );

            $nexticon = ( !empty( $settings['next_icon']['value'] ) ? move_addons_render_icon( $settings, 'next_icon', 'nexticon' ) : '' );
            $previcon = ( !empty( $settings['prev_icon']['value'] ) ? move_addons_render_icon( $settings, 'prev_icon', 'previcon' ) : '' );

            $items = [
                'item'              => $settings['slider_item'],
                'desktop'           => $settings['desktop_item'],
                'tablet'            => $settings['tablet_item'],
                'small_mobile'      => $settings['small_mobile_item'],
                'large_mobile'      => $settings['large_mobile_item'],
                'landscape_mobile'  => $settings['landscape_mobile_item'],
            ];

            $slider_settings = [
                'slideitem'    => $items,
                'speed'        => absint( $settings['slider_speed'] ),
                'spacebetween' => absint( $settings['slider_spacebetween'] ),
                'loop'         => ( 'yes' === $settings['slider_loop'] ),
                'autoplay'     => ( 'yes' === $settings['slider_autoplay'] ),
                'autoplay_delay'=> absint( $settings['slider_autoplay_delay'] ),
                'navigation'   => ( 'yes' === $settings['slider_arrow'] ),
                'pagination'   => ( 'yes' === $settings['slider_dots'] ),
                'uniqid'       => $id,
                'style'        => 'one',
            ];
            $this->add_render_attribute( 'slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );

        }

        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        // Query
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        $get_categories = $settings['categories'];

        $grid_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($grid_cats) && count($grid_cats) > 0 ){
                $field_name = is_numeric( $grid_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'terms' => $grid_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $recent_post = new \WP_Query( $args );
        $all_post = $recent_post->found_posts;

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php
                    if( $settings['slider_enable'] === 'yes' ){
                        echo '<div '.$this->get_render_attribute_string( 'slider_attr' ).'><div class="swiper-wrapper">';
                    }
                    $i = 0;
                    if( $recent_post->have_posts() ){
                        while( $recent_post->have_posts() ) { 
                            $recent_post->the_post();
                            $i++;
                            $this->render_item( $settings, $collumval, $i, $all_post );
                        } 
                        wp_reset_postdata(); wp_reset_query(); 
                    }
                    if( $settings['slider_enable'] === 'yes' ){ echo '</div></div>';
                        if( $settings['slider_dots'] === 'yes' ){
                            echo '<div class="htmove-pagination-style-'.$settings['navigation_style'].' htmove-pagination-'.$id.' '.( $settings['slider_dots_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-pagination"></div></div>';
                        }
                        if( $settings['slider_arrow'] === 'yes' ){
                            echo '<div class="htmove-navigation-style-'.$settings['navigation_style'].' htmove-navigation-'.$id.' '.( $settings['slider_arrow_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-button-next">'.$nexticon.'</div><div class="swiper-button-prev">'.$previcon.'</div></div>';
                        }
                    }
                ?>
            </div>
        <?php

    }

    public function render_item( $settings, $collumval, $i, $all_post ){

        $size = $settings['thumbnail_size'];
        $size2 = $settings['smthumbnail_size'];
        $image_size = $small_image = Null;

        // Large Image
        if( $size === 'custom' ){
            $image_size = [
                $settings['thumbnail_custom_dimension']['width'],
                $settings['thumbnail_custom_dimension']['height']
            ];
        }else{
            $image_size = $size;
        }

        // Small Image
        if( $size2 === 'custom' ){
            $small_image = [
                $settings['smthumbnail_custom_dimension']['width'],
                $settings['smthumbnail_custom_dimension']['height']
            ];
        }else{
            $small_image = $size2;
        }

        $date_format = ( $settings['default_enable'] == 'yes' ? get_option('date_format') : 'd M Y' );

        $viewtxt = ( move_addons_get_post_view( get_the_ID(), 'post' ) > 1 ? esc_html__( 'views', 'moveaddons' ) : esc_html__( 'view', 'moveaddons' ) );

        if( $settings['blog_style'] == 'three' ){
        ?>

            <?php if( $i == 1 ): ?>
                <div class="htmove-blog-col-2">
                    <div class="htmove-blog htmove-blog-three">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="htmove-blog-thumbnail">
                                <div class="htmove-blog-image">
                                    <?php the_post_thumbnail( $image_size ); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="htmove-blog-btn">
                                    <?php echo esc_html__( $settings['read_more_txt'] ); ?>
                                </a>
                                <ul class="htmove-blog-meta">
                                    <li><?php the_author_posts_link(); ?></li>
                                    <li><i class="far fa-calendar"></i> <?php echo get_the_time( $date_format ); ?></li>
                                    <li><i class="far fa-eye"></i> <?php echo move_addons_get_post_view( get_the_ID(), 'post' ).' '.$viewtxt; ?></li>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="htmove-blog-content">
                            <h3 class="htmove-blog-title">
                                <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words( get_the_title(), $settings['title_len'], ' ' ); ?>
                                </a>
                            </h3>
                            <p class="htmove-blog-text"><?php echo wp_trim_words( get_the_content(), $settings['content_len'], ' ' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="htmove-btn-link"><?php echo esc_html__( $settings['read_more_txt'] ); ?> <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
            <?php else:?>
                <div class="htmove-blog htmove-blog-three-list">
                    <?php if( has_post_thumbnail() ): ?>
                        <div class="htmove-blog-thumbnail">
                            <div class="htmove-blog-image">
                                <?php the_post_thumbnail( $small_image ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="htmove-blog-btn">
                                <?php echo esc_html__( $settings['read_more_txt'] ); ?>
                            </a>
                            <ul class="htmove-blog-meta">
                                <li><?php the_category( ', ' ); ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="htmove-blog-content">
                        <ul class="htmove-blog-meta">
                            <li><i class="far fa-calendar"></i> <?php echo get_the_time( $date_format ); ?></li>
                            <li><i class="far fa-eye"></i> <?php echo move_addons_get_post_view( get_the_ID(), 'post' ).' '.$viewtxt; ?></li>
                        </ul>
                        <h3 class="htmove-blog-title">
                            <a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words( get_the_title(), $settings['title_len'], ' ' ); ?>
                            </a>
                        </h3>
                    </div>
                </div>
            <?php endif;?>

            <?php if( $i == 1 ){ ?>
            </div>
            <div class="htmove-blog-col-2">
                <div class="htmove-blog-three-list-wrap">
                    <?php }?>

            <?php if( $i == $all_post ){ ?>
            <p class="htmove-btn-all-post-before" style="margin-top:20px; color: #999999; padding-left: 30px;"><?php echo esc_html__( $settings['all_post_btn_before'], 'moveaddons' );?> <a href="<?php echo esc_url( $settings['all_post_btn_link'] ); ?>" class="htmove-btn-link"><?php echo esc_html__( $settings['all_post_btn'], 'moveaddons' );?><i class="fas fa-arrow-right"></i></a></p>
            </div></div>
            <?php } ?>

        <?php
        }else{
            echo '<div class="'.( $settings['slider_enable'] === 'yes' ? 'swiper-slide' : $collumval ).'">';
                ?>
                <div <?php echo $this->get_render_attribute_string( 'item_attr' ); ?>>
                    <?php if( has_post_thumbnail() ): ?>
                        <div class="htmove-blog-thumbnail">
                            <div class="htmove-blog-image">
                                <?php the_post_thumbnail( $image_size ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="htmove-blog-btn">
                                <?php echo esc_html__( $settings['read_more_txt'] ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="htmove-blog-content htmove-blog-meta-pos-<?php echo esc_attr( $settings['meta_info_position'] ); ?>">
                        <?php if( $settings['blog_style'] == 'two' ): ?>
                            <ul class="htmove-blog-meta">
                                <li><?php the_category( ', ' ); ?></li>
                            </ul>
                            <h3 class="htmove-blog-title">
                                <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words( get_the_title(), $settings['title_len'], ' ' ); ?>
                                </a>
                            </h3>
                            <ul class="htmove-blog-meta">
                                <li><i class="far fa-calendar"></i> <?php echo get_the_time( $date_format ); ?></li>
                                <li><i class="far fa-eye"></i> <?php echo move_addons_get_post_view( get_the_ID(), 'post' ).' '.$viewtxt; ?></li>
                            </ul>
                        <?php else:?>
                            <?php if( $settings['meta_info_position'] == 'before' ): ?>
                                <ul class="htmove-blog-meta">
                                    <li><?php the_category( ', ' ); ?></li>
                                    <li><?php echo get_the_time( $date_format ); ?></li>
                                </ul>
                            <?php endif; ?>
                            <h3 class="htmove-blog-title">
                                <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words( get_the_title(), $settings['title_len'], ' ' ); ?>
                                </a>
                            </h3>
                            <?php if( $settings['meta_info_position'] != 'before' ): ?>
                            <ul class="htmove-blog-meta">
                                <li><?php the_category( ', ' ); ?></li>
                                <li><?php echo get_the_time( $date_format ); ?></li>
                            </ul>
                            <?php endif; ?>
                            <p class="htmove-blog-text"><?php echo wp_trim_words( get_the_content(), $settings['content_len'], ' ' ); ?></p>
                        <?php endif;?>
                    </div>

                </div>
                <?php
            echo '</div>';
        }
    }

}