<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dual_Button_Element extends Base {

    public function get_name() {
        return 'move-dual-button';
    }

    public function get_title() {
        return esc_html__( 'Dual Button', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-button';
    }

    public function get_keywords() {
        return [ 'move', 'button', 'dual button', 'double button' ];
    }

    public function get_style_depends() {
        return ['move-button'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Dual Button', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'button_size',
                [
                    'label'   => esc_html__( 'Button Size', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'sm',
                    'options' => [
                        'xs' => esc_html__( 'Extra Small', 'moveaddons' ),
                        'sm' => esc_html__( 'Small', 'moveaddons' ),
                        'st' => esc_html__( 'Standard', 'moveaddons' ),
                        'lg' => esc_html__( 'Large', 'moveaddons' ),
                        'xl' => esc_html__( 'Extra Large', 'moveaddons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // Button One
        $this->start_controls_section(
            'button_one_section',
            [
                'label' => esc_html__( 'Button One', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'button_one_type',
                [
                    'label'   => esc_html__( 'Button Type', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'primary',
                    'options' => [
                        'primary'   => esc_html__( 'Primary', 'moveaddons' ),
                        'secondary' => esc_html__( 'Secondary', 'moveaddons' ),
                        'success'   => esc_html__( 'Success', 'moveaddons' ),
                        'danger'    => esc_html__( 'Danger', 'moveaddons' ),
                        'warning'   => esc_html__( 'Warning', 'moveaddons' ),
                        'info'      => esc_html__( 'Info', 'moveaddons' ),
                        'light'     => esc_html__( 'Light', 'moveaddons' ),
                        'dark'      => esc_html__( 'Dark', 'moveaddons' ),
                        'grey'      => esc_html__( 'Grey', 'moveaddons' ),
                        'gradient'  => esc_html__( 'Gradient', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'button_one_outline',
                [
                    'label' => esc_html__( 'Outline', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'button_one_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Enter your Text', 'moveaddons' ),
                    'default' => esc_html__( 'Save It', 'moveaddons' ),
                    'title' => esc_html__( 'Enter your Text', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'button_one_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'button_one_icon',
                [
                    'label'       => esc_html__( 'Button Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'buttononeicon',
                ]
            );

            $this->add_control(
                'button_one_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'button_one_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'button_one_icon_specing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'condition' => [
                        'button_one_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-button-one.htmove-button-icon-right .htmove-btn-cion'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-button-one.htmove-button-icon-left .htmove-btn-cion'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button One
        $this->start_controls_section(
            'button_two_section',
            [
                'label' => esc_html__( 'Button Two', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'button_two_type',
                [
                    'label'   => esc_html__( 'Button Type', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'dark',
                    'options' => [
                        'primary'   => esc_html__( 'Primary', 'moveaddons' ),
                        'secondary' => esc_html__( 'Secondary', 'moveaddons' ),
                        'success'   => esc_html__( 'Success', 'moveaddons' ),
                        'danger'    => esc_html__( 'Danger', 'moveaddons' ),
                        'warning'   => esc_html__( 'Warning', 'moveaddons' ),
                        'info'      => esc_html__( 'Info', 'moveaddons' ),
                        'light'     => esc_html__( 'Light', 'moveaddons' ),
                        'dark'      => esc_html__( 'Dark', 'moveaddons' ),
                        'grey'      => esc_html__( 'Grey', 'moveaddons' ),
                        'gradient'  => esc_html__( 'Gradient', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'button_two_outline',
                [
                    'label' => esc_html__( 'Outline', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'button_two_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Enter your Text', 'moveaddons' ),
                    'default' => esc_html__( 'Cancel', 'moveaddons' ),
                    'title' => esc_html__( 'Enter your Text', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'button_two_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'button_two_icon',
                [
                    'label'       => esc_html__( 'Button Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'buttontwoicon',
                ]
            );

            $this->add_control(
                'button_two_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'button_two_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'button_two_icon_specing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'condition' => [
                        'button_two_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-button-two.htmove-button-icon-right .htmove-btn-cion'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-button-two.htmove-button-icon-left .htmove-btn-cion'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'buttonalign',
                [
                    'label' => esc_html__( 'Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-dual-buttons' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_height',
                [
                    'label' => esc_html__( 'Button Height', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} .htmove-button-area .htmove-btn'  => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button One Style tab section
        $this->start_controls_section(
            'button_one_style_tab',
            [
                'label' => esc_html__( 'Button One Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_one_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_one_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_one_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_one_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_one_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_one_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_one_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_one_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_one_hover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_one_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_one_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_button_one_hover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_control(
                        'button_one_hover_animation',
                        [
                            'label' => esc_html__( 'Hover Animation', 'moveaddons' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button One Icon style tab start
        $this->start_controls_section(
            'button_one_icon_style_section',
            [
                'label'     => esc_html__( 'Button One Icon Style', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_one_icon[value]!' => '',
                ],
            ]
        );

            // Button One Icon style tabs start
            $this->start_controls_tabs( 'button_one_icon_style_tabs' );

                // Button One Icon style normal tab start
                $this->start_controls_tab(
                    'button_one_icon_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_one_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_one_icon_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_one_icon_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_bordericon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_one_icon_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_one_icon_size',
                        [
                            'label' => esc_html__( 'Icon Size', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion'  => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn .htmove-btn-cion svg'  => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'button_one_icon_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_one_iconhover_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_one_iconhover_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-one.htmove-button-area .htmove-btn:hover .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end

        // Button Two Style tab section
        $this->start_controls_section(
            'button_two_style_tab',
            [
                'label' => esc_html__( 'Button Two Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_two_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_two_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_two_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_two_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_two_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_two_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_two_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_two_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_two_hover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_two_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_two_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_button_two_hover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_control(
                        'button_two_hover_animation',
                        [
                            'label' => esc_html__( 'Hover Animation', 'moveaddons' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button Two Icon style tab start
        $this->start_controls_section(
            'button_two_icon_style_section',
            [
                'label'     => esc_html__( 'Button Two Icon Style', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_two_icon[value]!' => '',
                ],
            ]
        );

            // Button Two Icon style tabs start
            $this->start_controls_tabs( 'button_two_icon_style_tabs' );

                // Button Two Icon style normal tab start
                $this->start_controls_tab(
                    'button_two_icon_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_two_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_two_icon_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_two_icon_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_bordericon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_two_icon_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_two_icon_size',
                        [
                            'label' => esc_html__( 'Icon Size', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion'  => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn .htmove-btn-cion svg'  => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'button_two_icon_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_two_iconhover_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_two_iconhover_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-two.htmove-button-area .htmove-btn:hover .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-dual-buttons' );
        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <?php $this->render_button( $settings,'one' ); ?>
            <?php $this->render_button( $settings,'two' ); ?>
        </div>
        <?php
    }

    public function render_button( $settings, $number ){

        $this->add_render_attribute( $number.'_area_attr', 'class', 'htmove-button-area htmove-button-'.$number );
        $this->add_render_attribute( $number.'_btn_attr', 'class', 'htmove-btn' );
        $this->add_render_attribute( $number.'_btn_attr', 'class', 'htmove-btn-'.$settings['button_'.$number.'_type'] );
        $this->add_render_attribute( $number.'_btn_attr', 'class', 'htmove-btn-'.$settings['button_size'] );

        if( $settings['button_'.$number.'_outline'] === 'yes' ){
            $this->add_render_attribute( $number.'_btn_attr', 'class', 'htmove-btn-outline-'.$settings['button_'.$number.'_type'] );
        }

        if ( $settings['button_'.$number.'_hover_animation'] ) {
            $this->add_render_attribute( 'btn_attr', 'class', 'elementor-animation-' . $settings['button_'.$number.'_hover_animation'] );
        }

        $button_icon = '';
        if( !empty( $settings['button_'.$number.'_icon']['value'] ) ){

            $this->add_render_attribute( $number.'_area_attr', 'class', 'htmove-button-icon-'.$settings['button_'.$number.'_icon_align'] );

            $button_icon = '<span class="htmove-btn-cion">'.move_addons_render_icon( $settings, 'button_'.$number.'_icon', 'icon' ).'</span>';
        }

        $button_text  = ! empty( $settings['button_'.$number.'_text'] ) ? '<span class="htmove-btn-text">'.$settings['button_'.$number.'_text'].'</span>' : '';

        // URL Generate
        if ( ! empty( $settings['button_'.$number.'_link']['url'] ) ) {
            
            $this->add_render_attribute( $number.'_url', 'href', $settings['button_'.$number.'_link']['url'] );

            if ( $settings['button_'.$number.'_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['button_'.$number.'_link']['nofollow'] ) ) {
                $this->add_render_attribute( $number.'_url', 'rel', 'nofollow' );
            }
            
            echo sprintf( '<div %1$s><a %5$s><button %2$s> %3$s %4$s </button></a></div>', $this->get_render_attribute_string( $number.'_area_attr' ), $this->get_render_attribute_string( $number.'_btn_attr' ), $button_text, $button_icon, $this->get_render_attribute_string( $number.'_url' ) );

        }else{
            echo sprintf( '<div %1$s><button %2$s> %3$s %4$s </button></div>', $this->get_render_attribute_string( $number.'_area_attr' ), $this->get_render_attribute_string( $number.'_btn_attr' ), $button_text, $button_icon );
        }

    }

}