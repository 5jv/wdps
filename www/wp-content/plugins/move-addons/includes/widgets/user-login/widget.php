<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class User_Login_Element extends Base {

    public function get_name() {
        return 'move-user-login';
    }

    public function get_title() {
        return esc_html__( 'User Login', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-lock-user';
    }

    public function get_keywords() {
        return [ 'move', 'user login', 'login', 'login form' ];
    }

    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-userlogin'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Login Form', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'form_show_label',
                [
                    'label' => esc_html__( 'Label', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'form_show_customlabel',
                [
                    'label' => esc_html__( 'Custom label', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'condition' =>[
                        'form_show_label' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'user_label',
                    [
                    'label'     => esc_html__( 'Username Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Username or Email', 'moveaddons' ),
                    'condition' => [
                        'form_show_label'   => 'yes',
                        'form_show_customlabel' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'user_placeholder',
                [
                    'label'     => esc_html__( 'Username Placeholder', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Username or Email', 'moveaddons' ),
                    'condition' => [
                        'form_show_label'   => 'yes',
                        'form_show_customlabel' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'password_label',
                [
                    'label'     => esc_html__( 'Password Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Password', 'moveaddons' ),
                    'condition' => [
                        'form_show_label'   => 'yes',
                        'form_show_customlabel' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'password_placeholder',
                [
                    'label'     => esc_html__( 'Password Placeholder', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Password', 'moveaddons' ),
                    'condition' => [
                        'form_show_label'   => 'yes',
                        'form_show_customlabel' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'redirect_page',
                [
                    'label' => esc_html__( 'Redirect page after Login', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'redirect_page_url',
                [
                    'type'          => Controls_Manager::URL,
                    'show_label'    => false,
                    'show_external' => false,
                    'separator'     => false,
                    'placeholder'   => 'http://your-link.com/',
                    'condition'     => [
                        'redirect_page' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'lost_password',
                [
                    'label'     => esc_html__( 'Lost your password?', 'moveaddons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'label_on'  => esc_html__( 'Show', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'lost_password_label',
                    [
                    'label'     => esc_html__( 'Lost your password Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Forgot password?', 'moveaddons' ),
                    'condition' => [
                        'lost_password' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'remember_me',
                [
                    'label'     => esc_html__( 'Remember Me', 'moveaddons' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'label_on'  => esc_html__( 'Show', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'remember_me_label',
                    [
                    'label'     => esc_html__( 'Remember Me Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Remember Me', 'moveaddons' ),
                    'condition' => [
                        'remember_me' => 'yes',
                    ],
                    'label_block' => true,
                ]
            );

            if ( get_option( 'users_can_register' ) ) {

                $this->add_control(
                    'register_link',
                    [
                        'label'     => esc_html__( 'Register', 'moveaddons' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'default'   => 'no',
                        'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                        'label_on'  => esc_html__( 'Show', 'moveaddons' ),
                    ]
                );

                $this->add_control(
                    'register_message',
                    [
                        'label' => esc_html__( 'Message for register link', 'moveaddons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Don\'t have an account?', 'moveaddons' ),
                        'condition'     => [
                            'register_link' => 'yes',
                        ],
                        'label_block'=>true,
                    ]
                );

                $this->add_control(
                    'register_link_text',
                    [
                        'label' => esc_html__( 'Text for register link', 'moveaddons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Sign Up', 'moveaddons' ),
                        'condition'     => [
                            'register_link' => 'yes',
                        ],
                        'label_block'=>true,
                    ]
                );

            }

            $this->add_control(
                'login_button_heading',
                [
                    'label' => esc_html__( 'Login Button', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'login_button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Login', 'moveaddons' ),
                ]
            );

        $this->end_controls_section();

        // Additional Options section
        $this->start_controls_section(
            'content_additional_opt',
            [
                'label' => esc_html__( 'Additional Options', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'form_title',
                [
                    'label' => esc_html__( 'Form Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Login to', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );
            
            $this->add_control(
                'form_heightlight_title',
                [
                    'label' => esc_html__( 'Form Height light Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'moveaddons', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'form_heightlight_title_pos',
                [
                    'label'   => esc_html__( 'Height Light Title Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'form_heightlight_title!' => '',
                    ],
                    'separator'=>'after',
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'loading_msg',
                [
                    'label' => esc_html__( 'Loading Message', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Please wait...', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'invalid_msg',
                [
                    'label' => esc_html__( 'Error Message', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Invalid username or password!', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'success_msg',
                [
                    'label' => esc_html__( 'Success Message', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Login Successfully', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'refresh_page',
                [
                    'label' => esc_html__( 'Refresh current page after Login', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'condition'=>[
                        'redirect_page!'=>'yes',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Area Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'area_width',
                [
                    'label' => esc_html__( 'Width', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-login-form' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-login-form',
                ]
            );

            $this->add_responsive_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-login-form',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-login-form',
                ]
            );

            $this->add_responsive_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'area_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_align',
                [
                    'label' => esc_html__( 'Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'auto' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors_dictionary' => [
                        'left' => '0 auto 0 0',
                        'right' => '0 0 0 auto',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form' => 'margin: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Area Title Style tab section
        $this->start_controls_section(
            'area_title_style',
            [
                'label' => esc_html__( 'Form Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'form_title_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form .htmove-login-form-title'   => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'form_title_heightlight_color',
                [
                    'label'     => esc_html__( 'Height Light Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form .htmove-login-form-title .htmove-heightlight'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'form_title_typography',
                    'selector' => '{{WRAPPER}} .htmove-login-form .htmove-login-form-title',
                ]
            );

            $this->add_responsive_control(
                'form_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form .htmove-login-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'form_title_align',
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
                        '{{WRAPPER}} .htmove-login-form .htmove-login-form-title' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Input Box Style tab section
        $this->start_controls_section(
            'input_box_style',
            [
                'label' => esc_html__( 'Input', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'input_box_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form input'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'input_box_placeholder_color',
                [
                    'label'     => esc_html__( 'Placeholder Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                         '{{WRAPPER}} .htmove-login-form input[type*="password"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="password"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="password"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                         '{{WRAPPER}} .htmove-login-form input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="email"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form input[type*="email"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'input_box_typography',
                    'selector' => '{{WRAPPER}} .htmove-login-form input',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'input_box_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-login-form input',
                ]
            );

            $this->add_responsive_control(
                'input_box_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-login-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'input_box_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-login-form input' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'input_box_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-login-form input',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'input_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Submit Button
        $this->start_controls_section(
            'style_submit_button',
            [
                'label' => esc_html__( 'Submit Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('login_form_style_submit_tabs');

                // Start Normal Submit button tab
                $this->start_controls_tab(
                    'style_submit_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'submitbutton_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'submitbutton_typography',
                            'selector' => '{{WRAPPER}} .htmove-login-form input[type="submit"]',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'submitbutton_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-login-form input[type="submit"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'submitbutton_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'submitbutton_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'submitbutton_height',
                        [
                            'label' => esc_html__( 'Height', 'moveaddons' ),
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
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'submitbutton_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-login-form input[type="submit"]',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'submitbutton_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'style_submit_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'submitbutton_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'submitbutton_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-login-form input[type="submit"]:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'submitbutton_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-login-form input[type="submit"]:hover',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'submitbutton_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-login-form input[type="submit"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();

        // Label Style Start
        $this->start_controls_section(
            'form_style_label',
            [
                'label' => esc_html__( 'Label', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'form_label_text_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form label'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-login-form .htmove-forgot-password'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'form_registration_text_color',
                [
                    'label'     => esc_html__( 'Registration Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form .htmove-form-text'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'form_registration_link_color',
                [
                    'label'     => esc_html__( 'Registration Link Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form .htmove-form-text .login_register_text'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .htmove-login-form label,{{WRAPPER}} .htmove-login-form .htmove-forgot-password',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'form_label_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-login-form label',
                ]
            );

            $this->add_responsive_control(
                'form_label_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'form_label_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'form_label_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-login-form label',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'form_label_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-login-form label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_label_align',
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
                        '{{WRAPPER}} .htmove-login-form label' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $current_url = remove_query_arg( 'fake_arg' );
        $id = $this->get_id();

        if ( $settings['redirect_page'] == 'yes' && ! empty( $settings['redirect_page_url']['url'] ) ) {
            $redirect_url = $settings['redirect_page_url']['url'];
        } else {
            $redirect_url = $current_url;
        }

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-login-form' );

        $title = ( $settings['form_title'] ? '<span>'.$settings['form_title'].'</span>' : '' );
        $heighttitle = ( $settings['form_heightlight_title'] ? '<span class="htmove-heightlight">'.$settings['form_heightlight_title'].'</span>' : '' );

        if( !empty($settings['form_heightlight_title']) ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-form-title-pos-'.$settings['form_heightlight_title_pos'] );
        }

        // Label Value
        $user_label = ( !empty( $settings['user_label'] ) ? $settings['user_label'] : esc_html__( 'Username', 'moveaddons' ) );
        $user_placeholder = ( !empty( $settings['user_placeholder'] ) ? $settings['user_placeholder'] : esc_html__('Username','moveaddons') );
        $pass_label = ( !empty( $settings['password_label'] ) ? $settings['password_label'] : esc_html__('Password','moveaddons') );
        $pass_placeholder = ( !empty( $settings['password_placeholder'] ) ? $settings['password_placeholder'] : esc_html__('Password','moveaddons') );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <div id="htmove_message_<?php echo esc_attr( $id ); ?>" class="htmove_message">&nbsp;</div>

                <?php
                    if ( is_user_logged_in() && !move_addons_get_elementor()->editor->is_edit_mode() ) {
                        $current_user = wp_get_current_user();
                        echo '<div class="htmove-user-login">' .sprintf( __( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'moveaddons' ), $current_user->display_name, wp_logout_url( $current_url ) ) .'</div></div>';
                        return;
                    }
                ?>


                <form id="htmove_login_form_<?php echo esc_attr( $id ); ?>" action="formloginaction" method="post">
                    <?php
                        if( !empty($title) || !empty($heighttitle) ){
                            echo '<h2 class="htmove-login-form-title">'.$title.' '.$heighttitle.'</h2>';
                        }
                    ?>
                    
                    <div class="htmove-form-group htmove-mb-30">

                        <?php
                            if( $settings['form_show_label'] == 'yes'){
                                echo sprintf('<label for="login_username-%1$s" class="htmove-form-label">%2$s</label>',$id, $user_label );
                            }
                        ?>
                        <div class="htmove-form-control">
                            <input 
                                type="text"  
                                id="login_username-<?php echo esc_attr( $id ); ?>" 
                                name="login_username" 
                                placeholder="<?php echo esc_attr__( $user_placeholder,'moveaddons' );?>">
                        </div>

                    </div>
                    <div class="htmove-form-group htmove-mb-20">
                        <?php
                            if( $settings['form_show_label'] == 'yes'){
                                echo sprintf('<label for="login_password-%1$s" class="htmove-form-label">%2$s</label>',$id, $pass_label );
                            }
                        ?>
                        <div class="htmove-form-control">
                            <input 
                                type="password" 
                                id="login_password-<?php echo esc_attr( $id ); ?>" 
                                name="login_password" 
                                placeholder="<?php echo esc_attr__( $pass_placeholder,'moveaddons' );?>">

                        </div>
                    </div>
                    <div class="htmove-form-row htmove-form-content-between htmove-mb-50">

                        <div class="htmove-form-col">
                            <?php if( $settings['remember_me'] == 'yes' ): ?>
                            <div class="htmove-form-group">
                                <div class="htmove-form-control htmove-form-control-checkbox">
                                    <input name="rememberme" type="checkbox" id="rememberme-<?php echo esc_attr( $id );?>" value="forever">
                                    <label for="rememberme-<?php echo esc_attr( $id );?>" class="htmove-form-label"><?php echo esc_html__( $settings['remember_me_label'], 'moveaddons' ); ?></label>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>

                        <div class="htmove-form-col">
                            <?php if( $settings['lost_password'] == 'yes' ): ?>
                                <div class="htmove-form-group">
                                    <a href="<?php echo wp_lostpassword_url( $current_url ); ?>" class="htmove-forgot-password"><?php esc_html_e( $settings['lost_password_label'], 'moveaddons' ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="htmove-form-group htmove-mb-15">
                        <div class="htmove-form-control">
                            <input 
                                type="submit" 
                                id="login_form_submit_<?php echo esc_attr__( $id, 'moveaddons'); ?>" 
                                name="login_form_submit<?php echo $id; ?>" 
                                value="<?php if( !empty( $settings['login_button_text'] ) ){ echo esc_attr__( $settings['login_button_text'], 'moveaddons'); } else { esc_html_e( 'Login', 'moveaddons' ); } ?>">

                        </div>
                    </div>

                    <?php if( get_option( 'users_can_register' ) && $settings['register_link'] == 'yes' ): ?>
                    <div class="htmove-form-group">
                        <p class="htmove-form-text htmove-text-center">
                            <?php esc_html_e( $settings['register_message'], 'moveaddons' ); ?>
                            <a href="<?php echo wp_registration_url(); ?>" class="login_register_text"><?php if( !empty( $settings['register_link_text'] ) ){ echo esc_attr__( $settings['register_link_text'], 'moveaddons'); } else { esc_html_e( 'Register', 'moveaddons' ); } ?></a>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php wp_nonce_field( 'htmove_login_nonce', 'security' ); ?>

                </form>
            </div>
        <?php

        $this->login_check( $settings, $redirect_url, $id );

    }

    public function login_check( $settings, $redirect_url, $id ) {

        ?>
        <script type="text/javascript">
            ;jQuery(document).ready(function($) {
                "use strict";

                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                var loading_msg = '<?php echo esc_html($settings['loading_msg']); ?>';
                var invalid_msg = '<?php echo esc_html($settings['invalid_msg']); ?>';
                var success_msg = '<?php echo esc_html($settings['success_msg']); ?>';
                var login_form_id = 'form#htmove_login_form_<?php echo esc_attr( $id ); ?>';
                var login_button_id = '#login_form_submit_<?php echo esc_attr( $id ); ?>';
                var button_text = '<?php echo esc_html( $settings['login_button_text'] ); ?>';
                var redirect = '<?php echo $settings['redirect_page']; ?>';
                var refresh = '<?php echo $settings['refresh_page']; ?>';

                $( login_button_id ).on('click', function(){

                    $('#htmove_message_<?php echo esc_attr( $id ); ?>').html('<span class="htmove_loading_msg">'+ loading_msg +'</span>').fadeIn();

                    $.ajax({  
                        type: 'POST',
                        dataType: 'json',  
                        url:  ajaxurl,  
                        data: { 
                            'action': 'move_ajax_login',
                            'username': $( login_form_id + ' #login_username-<?php echo esc_attr( $id ); ?>').val(), 
                            'password': $( login_form_id + ' #login_password-<?php echo esc_attr( $id ); ?>').val(), 
                            'security': $( login_form_id + ' #security').val()
                        },
                        success: function(msg){
                            if ( msg.loggeauth == true ){
                                $('#htmove_message_<?php echo esc_attr( $id ); ?>').html('<div class="htmove_success htmove-alert">'+ success_msg +'</div>').fadeIn();

                                if( redirect === 'yes' ){
                                    document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
                                }else{
                                    if( refresh === 'yes' ){
                                        document.location.reload();
                                    }
                                }
                            }else{
                                $('#htmove_message_<?php echo esc_attr( $id ); ?>').html('<div class="htmove_invalid htmove-alert">'+ invalid_msg +'</div>').fadeIn();
                            }
                        }

                    });
                    return false;
                });

            });

        </script>

        <?php

    }

}