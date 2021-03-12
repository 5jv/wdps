<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brand_Element extends Base {

    public function get_name() {
        return 'move-brand';
    }

    public function get_title() {
        return esc_html__( 'Brand', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-logo';
    }

    public function get_keywords() {
        return [ 'move', 'brand', 'brand logo', 'logo', 'partner','partner logo' ];
    }

    public function get_style_depends() {
        return [ 'move-brand' ];
    }

    public function get_script_depends() {
        return [ 'swiper', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'brand_content',
            [
                'label' => esc_html__( 'Brand', 'moveaddons' ),
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'brand_title',
                [
                    'label' => esc_html__( 'Brand Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your title here', 'moveaddons' ),
                ]
            );

            $repeater->add_control(
                'brand_logo',
                [
                    'label' => esc_html__( 'Choose Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => MOVE_ADDONS_ASSETS.'images/brand.png',
                    ],
                ]
            );

            $repeater->add_control(
                'brand_link',
                [
                    'label' => esc_html__( 'Brand Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'brand_logos',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'brand_title' => esc_html__( 'Brand Title', 'moveaddons' ),
                            'brand_link' => '',
                        ]
                    ],
                    'title_field' => '{{{ brand_title }}}',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'brandsize',
                    'default' => 'medium',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'slider_enable',
                [
                    'label' => esc_html__( 'Slider', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        /* Brand Options */
        $this->start_controls_section(
            'brand_option',
            array(
                'label' => esc_html__( 'Brand Option', 'moveaddons' ),
                'condition'=>[
                    'slider_enable!'=>'yes',
                ],
            )
        );
            
            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '5',
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
                    'default' => 5,
                ]
            );

            $this->add_control(
                'desktop_item',
                [
                    'label' => esc_html__('Desktop Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                ]
            );

            $this->add_control(
                'tablet_item',
                [
                    'label' => esc_html__('Tablet Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 4,
                ]
            );

            $this->add_control(
                'small_mobile_item',
                [
                    'label' => esc_html__('Small mobile Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'large_mobile_item',
                [
                    'label' => esc_html__('Large mobile', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'landscape_mobile_item',
                [
                    'label' => esc_html__('Mobile landscape', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3,
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

            $this->add_responsive_control(
                'item_separator',
                [
                    'label' => esc_html__( 'Separator', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-slide-visible:not(.swiper-slide-active) .htmove-brand' => 'border-left:{{SIZE}}{{UNIT}} solid #EEEEEE;',
                    ],
                ]
            );

            $this->add_control(
                'item_separator_color',
                [
                    'label' => esc_html__( 'Separator Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .swiper-slide-visible:not(.swiper-slide-active) .htmove-brand' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Slider Options Section End

        // Brand Style tab section
        $this->start_controls_section(
            'brand_style',
            [
                'label' => esc_html__( 'Brand Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'brand_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-brand',
                ]
            );

            $this->add_responsive_control(
                'brand_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-brand' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'brand_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-brand' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'brand_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-brand' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-brand' => 'height:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'brand_align',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-brand'   => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Image Style Section
        $this->start_controls_section(
            'brand_image_style',
            [
                'label' => esc_html__( 'Brand Image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('image_style_tabs');

                // Image Normal tab
                $this->start_controls_tab(
                    'image_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'brand_img_border',
                            'label' => esc_html__( 'Image Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand img',
                        ]
                    );

                    $this->add_responsive_control(
                        'brand_img_border_radius',
                        [
                            'label' => esc_html__( 'Image Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'image_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand img' => 'opacity:{{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'image_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-brand',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'image_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand',
                        ]
                    );

                    $this->add_control(
                        'image_brightness',
                        [
                            'label' => esc_html__( 'Brightness', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand img' => 'filter:brightness( {{SIZE}} ) invert(1);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Image Hover tab
                $this->start_controls_tab(
                    'image_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'brand_img_hover_border',
                            'label' => esc_html__( 'Image Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand:hover img',
                        ]
                    );

                    $this->add_responsive_control(
                        'brand_img_hover_border_radius',
                        [
                            'label' => esc_html__( 'Image Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'image_hover_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand:hover img' => 'opacity:{{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'image_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-brand:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'image_hover_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand:hover',
                        ]
                    );

                    $this->add_control(
                        'image_hover_brightness',
                        [
                            'label' => esc_html__( 'Brightness', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand:hover img' => 'filter:brightness( {{SIZE}} ) invert(0);',
                            ],
                        ]
                    );
                    
                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Slider Area style
        $this->start_controls_section(
            'slider_area_style',
            [
                'label' => esc_html__( 'Slider Area Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_enable'=>'yes',
                ],
            ]
        );

            $this->add_responsive_control(
                'slider_area_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-swiper-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'slider_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-swiper-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'slider_area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-swiper-slider',
                ]
            );

            $this->add_responsive_control(
                'slider_area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-swiper-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

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
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area .swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-brand-area .swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'nvigation_icon_size',
                        [
                            'label' => esc_html__( 'Icon Font Size', 'moveaddons' ),
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
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]::after' => 'font-size: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-brand-area .swiper-pagination' => 'left: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-brand-area .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet::before' => 'background-color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => esc_html__( 'Border', 'moveaddons' ),
                                'selector' => '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]:hover' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area [class*="swiper-button"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'dots_border_hover',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet:hover::before,{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet-active::before',
                        ]
                    );

                    $this->add_responsive_control(
                        'dots_border_radius_hover',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-brand-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
        $brands    = $this->get_settings_for_display('brand_logos');
        $id        = $this->get_id();

        $collumval = 'htmove-col-5';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }

        $size = $settings['brandsize_size'];
        $image_size = Null;
        if( $size === 'custom' ){
            $image_size = [
                $settings['brandsize_custom_dimension']['width'],
                $settings['brandsize_custom_dimension']['height']
            ];
        }else{
            $image_size = $size;
        }
        $default_img = '<img src="'.MOVE_ADDONS_ASSETS.'images/brand.png'.'" alt="">';

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-brand-area' );
        if( $settings['slider_enable'] != 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-row' );
        }
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        // Slider Option
        if( $settings['slider_enable'] === 'yes' ){

            $nexticon = ( !empty( $settings['next_icon']['value'] ) ? move_addons_render_icon( $settings, 'next_icon', 'nexticon' ) : '' );
            $previcon = ( !empty( $settings['prev_icon']['value'] ) ? move_addons_render_icon( $settings, 'prev_icon', 'previcon' ) : '' );

            $this->add_render_attribute( 'slider_attr', 'class', 'htmove-swiper-slider swiper-container' );

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
                'effect'       => 'slide',
                'navigation'   => ( 'yes' === $settings['slider_arrow'] ),
                'pagination'   => ( 'yes' === $settings['slider_dots'] ),
                'uniqid'       => $id,
                'style'        => 'one',
            ];
            $this->add_render_attribute( 'slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );

        }

        if( is_array( $brands ) ){

            echo '<div '.$this->get_render_attribute_string( 'area_attr' ).'>';

                if( $settings['slider_enable'] === 'yes' ){
                    echo '<div '.$this->get_render_attribute_string( 'slider_attr' ).'><div class="swiper-wrapper">';
                }
                    foreach ( $brands as  $brand ):
                        if( !empty( $brand['brand_logo']['id'] ) ){
                            $logo = wp_get_attachment_image( $brand['brand_logo']['id'], $image_size );
                        }else{
                            $logo = $default_img;
                        }

                        echo $this->render_item( $settings['slider_enable'], $logo, $collumval, $brand );

                    endforeach;

                if( $settings['slider_enable'] === 'yes' ){ echo '</div></div>';

                    if( $settings['slider_dots'] === 'yes' ){
                        echo '<div class="htmove-pagination-'.$id.' '.( $settings['slider_dots_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-pagination"></div></div>';
                    }
                    if( $settings['slider_arrow'] === 'yes' ){
                        echo '<div class="htmove-navigation-'.$id.' '.( $settings['slider_arrow_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-button-next '.( $nexticon != '' ? 'htmove-has' : '' ).'">'.$nexticon.'</div><div class="swiper-button-prev '.( $previcon != '' ? 'htmove-has' : '' ).'">'.$previcon.'</div></div>';
                    }
                }

            echo '</div>';

        }

    }

    public function render_item( $slider, $logo, $collumval, $brand ){
        echo '<div class="'.( $slider === 'yes' ? 'swiper-slide' : $collumval ).'">';
            if( !empty( $brand['brand_link']['url'] ) ){
                $target = $brand['brand_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $brand['brand_link']['nofollow'] ? ' rel="nofollow"' : '';
                echo '<a href="'.esc_url( $brand['brand_link']['url'] ).'" '.$target.$nofollow.'><div class="htmove-brand">'.$logo.'</div></a>';
            }else{
                echo '<div class="htmove-brand">'.$logo.'</div>';
            }
        echo '</div>';
    }

}