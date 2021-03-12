<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flip_Box_Element extends Base {

    public function get_name() {
        return 'move-flip-box';
    }

    public function get_title() {
        return esc_html__( 'Flip Box', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-flip-box';
    }

    public function get_keywords() {
        return [ 'move', 'flip box', 'box', 'flip' ];
    }

    public function get_style_depends() {
        return [ 'move-flipbox' ];
    }

    protected function _register_controls() {

        // Front Side Content Area Start
        $this->start_controls_section(
            'content_front_side',
            [
                'label' => esc_html__( 'Front Side', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'front_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'fronticon',
                ]
            );

            $this->add_control(
                'front_title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Creative Design', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type flip box title here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'front_description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amem dolor sit amet, consectetur adipiscing elit.', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type flip box description here', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'front_image',
                [
                    'label' => esc_html__( 'Image','moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

        $this->end_controls_section();

        // Back Side Content Area Start
        $this->start_controls_section(
            'content_back_side',
            [
                'label' => esc_html__( 'Back Side', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'back_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'backicon',
                ]
            );

            $this->add_control(
                'back_title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Creative Design', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type flip box title here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'back_title_link',
                [
                    'label' => esc_html__( 'Title Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'back_title!'=>'',
                    ],
                ]
            );
            
            $this->add_control(
                'back_description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amem dolor sit amet, consectetur adipiscing elit.', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type flip box description here', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'back_button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'View More', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type flip box button text here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'back_button_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'condition'=>[
                        'back_button_text!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'back_image',
                [
                    'label' => esc_html__( 'Image','moveaddons' ),
                    'type'=>Controls_Manager::MEDIA,
                ]
            );

        $this->end_controls_section();

        // Aditional Options area Start
        $this->start_controls_section(
            'flipbox_options',
            [
                'label' => esc_html__( 'Aditional Options', 'moveaddons' ),
            ]
        );

            $this->add_responsive_control(
                'flipbox_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1500,
                        ],
                        'vh' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ 'px', 'vh' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-flipbox' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'open_animation',
                [
                    'label' => esc_html__( 'Open Animation', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'top'   => esc_html__( 'Top', 'moveaddons' ),
                        'bottom'=> esc_html__( 'Bottom', 'moveaddons' ),
                        'left'  => esc_html__( 'Left', 'moveaddons' ),
                        'right' => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__( 'Title HTML Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'h3',
                    'label_block' => true,
                ]
            );

            $this->start_controls_tabs('flipbox_options_tabs');
                
                // Front Option Tab
                $this->start_controls_tab(
                    'front_option_tab',
                    [
                        'label' => esc_html__( 'Front Side', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'front_overlay',
                        [
                            'label' => esc_html__( 'Overlay', 'moveaddons' ),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                            'label_off' => esc_html__( 'No', 'moveaddons' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                        ]
                    );

                    $this->add_control(
                        'front_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-overlay' => 'background-color: {{VALUE}}',
                            ],
                            'condition'=>[
                                'front_overlay'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_overlay_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ]
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0.4,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-overlay' => 'opacity: {{SIZE}};',
                            ],
                            'condition'=>[
                                'front_overlay'=>'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Back Option Tab
                $this->start_controls_tab(
                    'back_option_tab',
                    [
                        'label' => esc_html__( 'Back Side', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'back_overlay',
                        [
                            'label' => esc_html__( 'Overlay', 'moveaddons' ),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                            'label_off' => esc_html__( 'No', 'moveaddons' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                        ]
                    );

                    $this->add_control(
                        'back_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#000000',
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-overlay' => 'background-color: {{VALUE}}',
                            ],
                            'condition'=>[
                                'back_overlay'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_overlay_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ]
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0.4,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-overlay' => 'opacity: {{SIZE}};',
                            ],
                            'condition'=>[
                                'back_overlay'=>'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'flip_box_style',
            [
                'label' => esc_html__( 'Box', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'content_verticle_alignment',
                [
                    'label' => esc_html__( 'Verticle Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Top', 'moveaddons' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Middle', 'moveaddons' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Bottom', 'moveaddons' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer' => 'align-items: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'htmove-flipboxv-%s',
                ]
            );
            
            $this->add_responsive_control(
                'content_horizontal_alignment',
                [
                    'label' => esc_html__( 'Horizontal Alignment', 'moveaddons' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'htmove-flipboxh-%s',
                ]
            );

            $this->start_controls_tabs('flipbox_box_style_tabs');
                
                // Box Front Style Tab
                $this->start_controls_tab(
                    'front_box_style_tab',
                    [
                        'label' => esc_html__( 'Front Side', 'moveaddons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'front_side_box_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_side_box_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'front_side_box_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side',
                        ]
                    );

                    $this->add_responsive_control(
                        'front_side_box_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'front_side_box_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'front_side_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side',
                        ]
                    );

                $this->end_controls_tab();

                // Box Back Style Tab
                $this->start_controls_tab(
                    'back_box_style_tab',
                    [
                        'label' => esc_html__( 'Back Side', 'moveaddons' ),
                    ]
                );

                    $this->add_responsive_control(
                        'back_side_box_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_side_box_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'back_side_box_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side',
                        ]
                    );

                    $this->add_responsive_control(
                        'back_side_box_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'back_side_box_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'back_side_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Title Style */
        $this->start_controls_section(
            'flipbox_title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('flipbox_title_style_tabs');
                
                // Front Side Style Tab
                $this->start_controls_tab(
                    'front_title_style_tab',
                    [
                        'label' => esc_html__( 'Front Side', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'front_title_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'front_title_typography',
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-title',
                        ]
                    );

                    $this->add_responsive_control(
                        'front_title_nmargin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_title_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Back Side Style Tab
                $this->start_controls_tab(
                    'back_title_style_tab',
                    [
                        'label' => esc_html__( 'Back Side', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'back_title_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'back_title_typography',
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-title',
                        ]
                    );

                    $this->add_responsive_control(
                        'back_title_nmargin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_title_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Description Style */
        $this->start_controls_section(
            'flipbox_description_style',
            [
                'label' => esc_html__( 'Description', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('flipbox_description_style_tabs');
                
                // Front Side Style Tab
                $this->start_controls_tab(
                    'front_description_style_tab',
                    [
                        'label' => esc_html__( 'Front Side', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'front_description_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-text' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'front_description_typography',
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-text',
                        ]
                    );

                    $this->add_responsive_control(
                        'front_description_nmargin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_description_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Back Side Style Tab
                $this->start_controls_tab(
                    'back_description_style_tab',
                    [
                        'label' => esc_html__( 'Back Side', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'back_description_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-text' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'back_description_typography',
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-text',
                        ]
                    );

                    $this->add_responsive_control(
                        'back_description_nmargin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_description_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Icon Style */
        $this->start_controls_section(
            'flipbox_icon_style',
            [
                'label' => esc_html__( 'Icon', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('flipbox_icon_style_tabs');
                
                // Front Side Style Tab
                $this->start_controls_tab(
                    'front_icon_style_tab',
                    [
                        'label' => esc_html__( 'Front Side', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'front_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_icon_size',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_icon_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'front_icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-front-side .htmove-flipbox-content .htmove-flipbox-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Back Side Style Tab
                $this->start_controls_tab(
                    'back_icon_style_tab',
                    [
                        'label' => esc_html__( 'Back Side', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'back_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_icon_size',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_icon_nmargin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'back_icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer.htmove-flipbox-back-side .htmove-flipbox-content .htmove-flipbox-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Button Style */
        $this->start_controls_section(
            'flipbox_button_style',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('flipbox_button_style_tabs');
                
                // Front Side Style Tab
                $this->start_controls_tab(
                    'back_button_normal_style_tab',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_normal_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn'  => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Back Side Style Tab
                $this->start_controls_tab(
                    'back_button_hover_style_tab',
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
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_hover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-flipbox .htmove-flipbox-layer .htmove-flipbox-content .htmove-flipbox-btn:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-flipbox' );
        $this->add_render_attribute( 'area_attr', 'class', 'from-'.$settings['open_animation'] );

        $front_image = !empty( $settings['front_image']['url'] ) ? 'style="background-image: url('.$settings['front_image']['url'].')"' : '';
        $back_image = !empty( $settings['back_image']['url'] ) ? 'style="background-image: url('.$settings['back_image']['url'].')"' : '';

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <div class="htmove-flipbox-layer htmove-flipbox-front-side" <?php echo $front_image; ?> >
                <?php $this->render_flipbox( $settings,'front' ); ?>
            </div>
            <div class="htmove-flipbox-layer htmove-flipbox-back-side" <?php echo $back_image; ?> >
                <?php $this->render_flipbox( $settings,'back' ); ?>
            </div>
        </div>
        <?php

    }

    public function render_flipbox( $settings, $side ){

        $title = ( !empty( $settings[$side.'_title'] ) ? $settings[$side.'_title'] : '' );
        $description = ( !empty( $settings[$side.'_description'] ) ? '<p class="htmove-flipbox-text">'.$settings[$side.'_description'].'</p>' : '' );
        $button_text = ( !empty( $settings[$side.'_button_text'] ) ? $settings[$side.'_button_text'] : '' );

        $icon = ( !empty( $settings[$side.'_icon']['value'] ) ? '<span class="htmove-flipbox-icon">'.move_addons_render_icon( $settings, $side.'_icon', $side.'icon' ).'</span>' : '' );

        $overlay = ( $settings[$side.'_overlay'] == 'yes' ? '<span class="htmove-flipbox-overlay"></span>' : '' );

        // URL For Title
        if ( ! empty( $settings[$side.'_title_link']['url'] ) ) {

            $this->add_render_attribute( $side.'_title_url', 'href', $settings[$side.'_title_link']['url'] );

            if ( $settings[$side.'_title_link']['is_external'] ) {
                $this->add_render_attribute( $side.'_title_url', 'target', '_blank' );
            }

            if ( ! empty( $settings[$side.'_title_link']['nofollow'] ) ) {
                $this->add_render_attribute( $side.'_title_url', 'rel', 'nofollow' );
            }

            $title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( $side.'_title_url' ), $title );

        }

        // URL For Button
        if ( ! empty( $settings[$side.'_button_link']['url'] ) ) {

            $this->add_render_attribute( $side.'_btn_url', 'class', 'htmove-flipbox-btn' );

            $this->add_render_attribute( $side.'_btn_url', 'href', $settings[$side.'_button_link']['url'] );

            if ( $settings[$side.'_button_link']['is_external'] ) {
                $this->add_render_attribute( $side.'_btn_url', 'target', '_blank' );
            }

            if ( ! empty( $settings[$side.'_button_link']['nofollow'] ) ) {
                $this->add_render_attribute( $side.'_btn_url', 'rel', 'nofollow' );
            }

            $button_text = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( $side.'_btn_url' ), $button_text );

        }

        if( !empty( $title ) ){
            $this->add_render_attribute( $side.'_title_attr', 'class', 'htmove-flipbox-title' );
            $title = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( $side.'_title_attr' ), $title );
        }

        echo sprintf('%5$s<div class="htmove-flipbox-content">%1$s %2$s %3$s %4$s</div>',$icon, $title, $description, $button_text, $overlay );

    }

}