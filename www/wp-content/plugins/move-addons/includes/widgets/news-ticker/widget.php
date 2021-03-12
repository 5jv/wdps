<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class News_Ticker_Element extends Base {

    public function get_name() {
        return 'move-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'News Ticker', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-posts-ticker';
    }

    public function get_keywords() {
        return [ 'move', 'news ticker', 'live news', 'post ticker' ];
    }

    public function get_style_depends() {
        return ['move-newsticker'];
    }

    public function get_script_depends() {
        return ['swiper', 'move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'News Ticker', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'ticker_style',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one' => esc_html__( 'Style One', 'moveaddons' ),
                        'two' => esc_html__( 'Style Two', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'ticker_label',
                [
                    'label' => esc_html__( 'Ticker Label', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Breaking News', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'label_icon',
                [
                    'label'       => esc_html__( 'Label Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'labelicon',
                ]
            );

            $this->add_control(
                'icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'label_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'title_len',
                [
                    'label' => esc_html__('Title Length', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 10,
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label' => esc_html__( 'Show Date', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'date_align',
                [
                    'label'   => esc_html__( 'Date Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'before' => esc_html__( 'Before Title', 'moveaddons' ),
                        'after'  => esc_html__( 'After Title', 'moveaddons' ),
                    ],
                    'condition' => [
                        'show_date' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_section',
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

        // Slider Options Section Start
        $this->start_controls_section(
            'slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'moveaddons' ),
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
                    'default' => 'yes',
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

        // Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker:not(.htmove-ticker-one),{{WRAPPER}} .htmove-ticker-one .htmove-ticker-slider',
                ]
            );

            $this->add_responsive_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker:not(.htmove-ticker-one)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-ticker-one .htmove-ticker-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker:not(.htmove-ticker-one)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-ticker-one .htmove-ticker-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-ticker-slider',
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Content Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker .htmove-ticker-content a' => 'color: {{VALUE}}',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Content Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker .htmove-ticker-content a',
                ]
            );

        $this->end_controls_section();

        // Badge Style tab section
        $this->start_controls_section(
            'badge_style',
            [
                'label' => esc_html__( 'Badge', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'badge_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'badge_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'badge_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge',
                ]
            );

            $this->add_control(
                'badge_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'badge_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'badge_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'badge_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-ticker .htmove-ticker-badge',
                ]
            );

        $this->end_controls_section();

        // Date Style tab section
        $this->start_controls_section(
            'date_style',
            [
                'label' => esc_html__( 'Date', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_date'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'date_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker-content a .htmove-date' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker-content a .htmove-date',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'date_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-ticker-content a .htmove-date',
                ]
            );

            $this->add_control(
                'date_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker-content a .htmove-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'date_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker-content a .htmove-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'date_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-ticker-content a .htmove-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'date_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-ticker-content a .htmove-date',
                ]
            );

        $this->end_controls_section();

        // Slider Button style
        $this->start_controls_section(
            'slider_controller_style',
            [
                'label' => esc_html__( 'Slider Controller Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
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

                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]::after' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"] i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination' => 'left: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => esc_html__( 'Border', 'moveaddons' ),
                                'selector' => '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider [class*="swiper-button"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'dots_border_hover',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet:hover,{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'dots_border_radius_hover',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-ticker-slider .swiper-pagination .swiper-pagination-bullet:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();// Hover button style end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Tab option end


    }

    protected function render( $instance = [] ) {

        $settings  = $this->get_settings_for_display();
        $id        = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-ticker htmove-ticker-'.$settings['ticker_style'] );

        // Ticker Badge
        $badgetext = ( !empty( $settings['ticker_label'] ) ? $settings['ticker_label'] : '' );
        $badgeicon = ( !empty( $settings['label_icon']['value'] ) ? move_addons_render_icon( $settings, 'label_icon', 'labelicon' ) : '' );
        $icon_pos = ( !empty( $settings['label_icon']['value'] ) ? $settings['icon_align'] : 'default' );

        $ticker_badge = sprintf('<span class="htmove-icon-%s htmove-ticker-badge htmove-ticker-badge-%s">%s %s</span>', $icon_pos, $settings['ticker_style'],$badgeicon, $badgetext );

        if( !empty( $settings['label_icon']['value'] ) || !empty( $badgetext ) ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-has-ticker-badge' );
        }

        // Slider Option
        $this->add_render_attribute( 'slider_attr', 'class', 'htmove-swiper-slider swiper-container' );

        $nexticon = ( !empty( $settings['next_icon']['value'] ) ? move_addons_render_icon( $settings, 'next_icon', 'nexticon' ) : '' );
        $previcon = ( !empty( $settings['prev_icon']['value'] ) ? move_addons_render_icon( $settings, 'prev_icon', 'previcon' ) : '' );

        $items = [
            'item'              => 1,
            'desktop'           => 1,
            'tablet'            => 1,
            'small_mobile'      => 1,
            'large_mobile'      => 1,
            'landscape_mobile'  => 1,
        ];

        $slider_settings = [
            'slideitem'    => $items,
            'speed'        => absint( $settings['slider_speed'] ),
            'spacebetween' => absint( $settings['slider_spacebetween'] ),
            'loop'         => ( 'yes' === $settings['slider_loop'] ),
            'autoplay'=> ( 'yes' === $settings['slider_autoplay'] ),
            'autoplay_delay'=> absint( $settings['slider_autoplay_delay'] ),
            'effect'       => 'fade',
            'navigation'   => ( 'yes' === $settings['slider_arrow'] ),
            'pagination'   => ( 'yes' === $settings['slider_dots'] ),
            'uniqid'       => $id,
            'style'        => 'one',
        ];
        $this->add_render_attribute( 'slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );

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

        $news = new \WP_Query( $args );
        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?>>
            <?php
                if( !empty( $settings['label_icon']['value'] ) || !empty( $badgetext ) ){
                    echo $ticker_badge; 
                }
            ?>
            <div class="htmove-ticker-slider">
                <div <?php echo $this->get_render_attribute_string( 'slider_attr' ); ?> >
                    <div class="swiper-wrapper">
                        <?php
                            if( $news->have_posts() ){
                                while( $news->have_posts() ) { 
                                    $news->the_post();
                        ?>
                        <div class="swiper-slide">
                            <div class="htmove-ticker-content">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                        if( ( $settings['show_date'] == 'yes') && ( $settings['date_align'] == 'before' ) ){
                                            echo '<span class="htmove-date htmove-date-1">'.get_the_time('d M').'</span>';
                                        }
                                        echo wp_trim_words( get_the_title(), $settings['title_len'], ' ' );
                                        if( ( $settings['show_date'] == 'yes') && ( $settings['date_align'] == 'after' ) ){
                                            echo '<span class="htmove-date htmove-date-2">'.get_the_time('d M').'</span>';
                                        }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <?php } wp_reset_postdata(); wp_reset_query(); } ?>
                    </div>
                </div>
                <?php
                    if( $settings['slider_dots'] === 'yes' ){
                        echo '<div class="htmove-pagination-'.$id.'"><div class="swiper-pagination"></div></div>';
                    }
                    if( $settings['slider_arrow'] === 'yes' ){
                        echo '<div class="htmove-navigation-'.$id.'"><div class="swiper-button-next">'.$nexticon.'</div><div class="swiper-button-prev">'.$previcon.'</div></div>';
                    }
                ?>
            </div>
        </div>
        <?php

    }

}