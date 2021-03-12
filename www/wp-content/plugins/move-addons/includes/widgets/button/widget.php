<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button_Element extends Base {

    public function get_name() {
        return 'move-button';
    }

    public function get_title() {
        return esc_html__( 'Button', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-button';
    }

    public function get_keywords() {
        return [ 'move', 'button' ];
    }

    public function get_style_depends() {
        return ['move-button'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'button_content',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'button_type',
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
                'button_outline',
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
                'button_size',
                [
                    'label'   => esc_html__( 'Button Size', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'st',
                    'options' => [
                        'xs' => esc_html__( 'Extra Small', 'moveaddons' ),
                        'sm' => esc_html__( 'Small', 'moveaddons' ),
                        'st' => esc_html__( 'Standard', 'moveaddons' ),
                        'lg' => esc_html__( 'Large', 'moveaddons' ),
                        'xl' => esc_html__( 'Extra Large', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Enter your Text', 'moveaddons' ),
                    'default' => esc_html__( 'Click Me', 'moveaddons' ),
                    'title' => esc_html__( 'Enter your Text', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'button_link',
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
                'button_icon',
                [
                    'label'       => esc_html__( 'Button Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'icon',
                ]
            );

            $this->add_control(
                'button_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'icon_specing',
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
                        'button_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-button-icon-right .htmove-btn-cion'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-button-icon-left .htmove-btn-cion'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'buttonalign',
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
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'moveaddons' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'button_style_tab',
            [
                'label' => esc_html__( 'Button Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('button_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_style_normal_tab',
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
                                '{{WRAPPER}} .htmove-button-area .htmove-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .htmove-button-area .htmove-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .htmove-button-area .htmove-btn'  => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
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
                                '{{WRAPPER}} .htmove-button-area .htmove-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'boxhover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn:hover',
                        ]
                    );

                    $this->add_control(
                        'button_hover_animation',
                        [
                            'label' => esc_html__( 'Hover Animation', 'moveaddons' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button Icon style tab start
        $this->start_controls_section(
            'button_icon_style_section',
            [
                'label'     => esc_html__( 'Icon Style', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

            // Button Icon style tabs start
            $this->start_controls_tabs( 'button_icon_style_tabs' );

                // Button Icon style normal tab start
                $this->start_controls_tab(
                    'buttonicon_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'htmega_button_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_icon_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonicon_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_bordericon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_icon_size',
                        [
                            'label' => esc_html__( 'Icon Size', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion'  => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-button-area .htmove-btn .htmove-btn-cion svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'buttonicon_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_iconhover_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-button-area .htmove-btn:hover .htmove-btn-cion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-button-area .htmove-btn:hover .htmove-btn-cion svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_iconhover_background',
                            'label' => esc_html__( 'Icon Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-button-area .htmove-btn:hover .htmove-btn-cion',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-button-area' );
        $this->add_render_attribute( 'btn_attr', 'class', 'htmove-btn' );
        $this->add_render_attribute( 'btn_attr', 'class', 'htmove-btn-'.$settings['button_type'] );
        $this->add_render_attribute( 'btn_attr', 'class', 'htmove-btn-'.$settings['button_size'] );

        if( $settings['button_outline'] === 'yes' ){
            $this->add_render_attribute( 'btn_attr', 'class', 'htmove-btn-outline-'.$settings['button_type'] );
        }

        if ( $settings['button_hover_animation'] ) {
            $this->add_render_attribute( 'btn_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
        }

        $button_icon = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-button-icon-'.$settings['button_icon_align'] );

            $button_icon = '<span class="htmove-btn-cion">'.move_addons_render_icon( $settings, 'button_icon', 'icon' ).'</span>';
        }

        $button_text  = ! empty( $settings['button_text'] ) ? '<span class="htmove-btn-text">'.$settings['button_text'].'</span>' : '';

        // URL Generate
        if ( ! empty( $settings['button_link']['url'] ) ) {
            
            $this->add_render_attribute( 'url', 'href', $settings['button_link']['url'] );

            if ( $settings['button_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
            
            echo sprintf( '<div %1$s><a %5$s><button %2$s> %3$s %4$s </button></a></div>', $this->get_render_attribute_string( 'area_attr' ), $this->get_render_attribute_string( 'btn_attr' ), $button_text, $button_icon, $this->get_render_attribute_string( 'url' ) );

        }else{
            echo sprintf( '<div %1$s><button %2$s> %3$s %4$s </button></div>', $this->get_render_attribute_string( 'area_attr' ), $this->get_render_attribute_string( 'btn_attr' ), $button_text, $button_icon );
        }

    }

}