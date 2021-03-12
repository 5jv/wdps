<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cf7_Element extends Base {

    public function get_name() {
        return 'move-contact-form7';
    }

    public function get_title() {
        return esc_html__( 'Contact Form 7', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-mail';
    }

    public function get_keywords() {
        return [ 'move', 'contact form','contact','form','cf7' ];
    }

    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-cf7'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Contact Form 7', 'moveaddons' ),
            ]
        );

            if ( move_addons_is_form_activated( '\WPCF7' ) ) {

                $this->add_control(
                    'form_id',
                    [
                        'label' => esc_html__( 'Select Your Form', 'moveaddons' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => ['' => __( 'Select Form', 'moveaddons' ) ] + move_addons_get_cf7_forms(),
                    ]
                );

            }else{
                $this->add_control(
                    'form_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => '<p style="margin-bottom:10px;">Install or activate contact form 7</p><a href="'.esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Click Here</a> to install or activate',
                    ]
                );
            }

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'form_section_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'form_section_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'form_section_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'form_section_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-form-wrapper-area',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'form_section_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-form-wrapper-area',
                ]
            );

            $this->add_responsive_control(
                'form_section_align',
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
                        '{{WRAPPER}} .htmove-form-wrapper-area' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Input Field style tab start
        $this->start_controls_section(
            'contactform_input_style',
            [
                'label'     => esc_html__( 'Input Box', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'input_box_height',
                [
                    'label' => __( 'Height', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],

                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'input_box_background',
                [
                    'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'htmega_input_box_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
                ]
            );

            $this->add_control(
                'input_box_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'input_box_placeholder_color',
                [
                    'label'     => esc_html__( 'Placeholder Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'      => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'input_box_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
                ]
            );

            $this->add_responsive_control(
                'input_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'input_box_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'input_box_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Input Field style tab end

         // Textarea style tab start
        $this->start_controls_section(
            'contactform_textarea_style',
            [
                'label'     => esc_html__( 'Textarea', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'textarea_box_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 500,
                        ],
                    ],

                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'textarea_box_background',
                [
                    'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'textarea_box_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
                ]
            );

            $this->add_control(
                'textarea_box_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'textarea_box_placeholder_color',
                [
                    'label'     => esc_html__( 'Placeholder Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'textarea_box_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
                ]
            );

            $this->add_responsive_control(
                'textarea_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'textarea_box_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'textarea_box_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Textarea style tab end

        // Label style tab start
        $this->start_controls_section(
            'contactform_label_style',
            [
                'label'     => esc_html__( 'Label', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'label_background',
                [
                    'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label'   => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'label_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'label_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label',
                ]
            );

            $this->add_responsive_control(
                'label_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'label_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'label_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-wrapper-area form.wpcf7-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // // Label style tab end


        // Input submit button style tab start
        $this->start_controls_section(
            'contactform_inputsubmit_style',
            [
                'label'     => esc_html__( 'Button', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('htmega_submit_style_tabs');

                // Button Normal tab start
                $this->start_controls_tab(
                    'submit_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'input_submit_height',
                        [
                            'label' => esc_html__( 'Height', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'input_submit_typography',
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                    $this->add_control(
                        'input_submit_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_submit_background_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'input_submit_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'input_submit_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'input_submit_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                    $this->add_responsive_control(
                        'input_submit_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'input_submit_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'submit_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'input_submithover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_submithover_background_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'input_submithover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Input submit button style tab end


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-form-wrapper-area' );

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <?php
                if( !empty( $settings['form_id'] ) ){
                    echo do_shortcode( '[contact-form-7  id="'.$settings['form_id'].'"]' ); 
                }else{
                    echo '<div class="form_no_select">' .esc_html__('Please Select contact form.','moveaddons'). '</div>';
                }
            ?>
        </div>
        <?php

    }

}