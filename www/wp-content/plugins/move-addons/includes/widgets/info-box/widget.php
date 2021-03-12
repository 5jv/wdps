<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Info_Box_Element extends Base {

    public function get_name() {
        return 'move-info-box';
    }

    public function get_title() {
        return esc_html__( 'Info Box', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-info-box';
    }

    public function get_keywords() {
        return [ 'move', 'info', 'info box', 'information', 'information box' ];
    }

    public function get_style_depends() {
        return ['move-infobox'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one' => esc_html__( 'One', 'moveaddons' ),
                        'two' => esc_html__( 'Two', 'moveaddons' ),
                    ],
                    'label_block' => true,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'info_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'infoicon',
                ]
            );

            $this->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Huge Collection', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type info box title here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Was likeness brought divided given fruit in wherein lights green hath third', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type info box description here', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type flip box button text here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'condition'=>[
                        'button_text!'=>'',
                    ],
                ]
            );

        $this->end_controls_section();

        // Aditional Options area Start
        $this->start_controls_section(
            'infobox_options',
            [
                'label' => esc_html__( 'Aditional Options', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'title_link',
                [
                    'label' => esc_html__( 'Title Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'title!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__( 'Title HTML Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'h5',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'icon_pos',
                [
                    'label' => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left' => esc_html__( 'Left', 'moveaddons' ),
                        'right' => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'label_block' => true,
                    'condition'=>[
                        'layout'=>'two',
                        'info_icon[value]!'=>'',
                    ],
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__( 'Box', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'content_alignment',
                [
                    'label' => esc_html__( 'Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'htmove-infobox-align-%s',
                ]
            );

            $this->start_controls_tabs('infobox_box_style_tabs');
                
                // Box Normal Style Tab
                $this->start_controls_tab(
                    'box_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'box_normal_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'box_normal_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'box_normal_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox',
                        ]
                    );

                    $this->add_responsive_control(
                        'box_normal_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'box_normal_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-infobox',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_normal_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox',
                        ]
                    );

                $this->end_controls_tab();

                // Box Hover Style Tab
                $this->start_controls_tab(
                    'box_hover_style_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'box_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'box_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'box_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-infobox:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'box_hover_content_color',
                        [
                            'label' => esc_html__( 'Content Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox:hover .htmove-infobox-inner .htmove-infobox-content *' => 'color: {{VALUE}} !important',
                                '{{WRAPPER}} .htmove-infobox:hover .htmove-infobox-inner .htmove-infobox-icon' => 'color: {{VALUE}} !important',
                                '{{WRAPPER}} .htmove-infobox:hover .htmove-infobox-inner .htmove-infobox-icon svg *' => 'stroke: {{VALUE}} !important',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_hover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox:hover',
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
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-title',
                ]
            );

            $this->add_responsive_control(
                'title_nmargin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Icon Style */
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'info_icon[value]!'=>''
                ],
            ]
        );
            
            $this->add_control(
                'icon_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-icon svg *' => 'stroke: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',
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
                        'size' => 36,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Description Style tab section
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-text' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-text',
                ]
            );

            $this->add_responsive_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Button Style */
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

            $this->start_controls_tabs('button_style_tabs');
                
                // Button Normal Style Tab
                $this->start_controls_tab(
                    'button_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();
                
                // Button Hover Style Tab
                $this->start_controls_tab(
                    'button_hover_style_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'buttonhover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_hover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-infobox .htmove-infobox-inner .htmove-infobox-content .htmove-infobox-link:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-infobox htmove-infobox-'.$settings['layout'] );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-infobox-iconpos-'.$settings['icon_pos'] );

        $icon = ( !empty( $settings['info_icon']['value'] ) ? '<div class="htmove-infobox-icon">'.move_addons_render_icon( $settings, 'info_icon', 'infoicon' ).'</div>' : '' );

        $title = ( !empty( $settings['title'] ) ? $settings['title'] : '' );

        $description = ( !empty( $settings['description'] ) ? '<p class="htmove-infobox-text">'.$settings['description'].'</p>' : '' );

        $button_text = ( !empty( $settings['button_link']['url'] ) ? $settings['button_text'] : '' );

        // URL For Title
        if ( ! empty( $settings['title_link']['url'] ) ) {

            $this->add_render_attribute( 'title_url', 'href', $settings['title_link']['url'] );

            if ( $settings['title_link']['is_external'] ) {
                $this->add_render_attribute( 'title_url', 'target', '_blank' );
            }

            if ( ! empty( $settings['title_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'title_url', 'rel', 'nofollow' );
            }

            $title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'title_url' ), $title );

        }

        // URL For Button
        if ( ! empty( $settings['button_link']['url'] ) ) {

            $this->add_render_attribute( 'btn_url', 'class', 'htmove-infobox-link' );

            $this->add_render_attribute( 'btn_url', 'href', $settings['button_link']['url'] );

            if ( $settings['button_link']['is_external'] ) {
                $this->add_render_attribute( 'btn_url', 'target', '_blank' );
            }

            if ( ! empty( $settings['button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'btn_url', 'rel', 'nofollow' );
            }

            $button_text = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'btn_url' ), $button_text );

        }

        if( !empty( $title ) ){
            $this->add_render_attribute( 'title_attr', 'class', 'htmove-infobox-title' );
            $title = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title_attr' ), $title );
        }

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <div class="htmove-infobox-inner">
                <?php
                    echo sprintf('%1$s<div class="htmove-infobox-content">%2$s %3$s %4$s</div>',$icon, $title, $description, $button_text );
                ?>
            </div>
        </div>
        <?php

    }

}