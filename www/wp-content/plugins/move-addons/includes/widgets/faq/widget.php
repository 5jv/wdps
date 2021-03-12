<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Faq_Element extends Base {

    public function get_name() {
        return 'move-faq';
    }

    public function get_title() {
        return esc_html__( 'Faq', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-accordion';
    }

    public function get_keywords() {
        return [ 'move', 'accordion', 'collapse', 'faq' ];
    }

    public function get_style_depends() {
        return ['move-accordion','move-faq'];
    }

    public function get_script_depends() {
        return ['move-accordion','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'content_source',
                [
                    'label'   => esc_html__( 'Select Content Source', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'    => esc_html__( 'Custom', 'moveaddons' ),
                        "elementor" => esc_html__( 'Elementor Template', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Faq Title', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your faq title here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris niesi ut aliquip ex ea commodo consequat.sed do eiusmod tempor incididunt ut quis labore et doliore magna aliqua.</p>',
                    'condition' => [
                        'content_source' =>'custom',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'template_id',
                [
                    'label'   => esc_html__( 'Select Template', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => move_addons_elementor_template(),
                    'condition' => [
                        'content_source' =>'elementor',
                    ],
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'individual_icon',
                [
                    'label' => esc_html__( 'Do you want to individual icon ?', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater->add_control(
                'indopen_icon',
                [
                    'label'       => esc_html__( 'Open Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'indopenicon',
                    'condition'=>[
                        'individual_icon'=>'yes',
                    ],
                ]
            );

            $repeater->add_control(
                'indclose_icon',
                [
                    'label'       => esc_html__( 'Close Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'indcloseicon',
                    'condition'=>[
                        'individual_icon'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'accordion_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'title' => esc_html__( 'How do I set up my developer environment?', 'moveaddons' ),
                            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'title' => esc_html__( 'How do I authenticate my requests to Move?', 'moveaddons' ),
                            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'title' => esc_html__( 'How do I authenticate requests from Move to me?', 'moveaddons' ),
                            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'title' => esc_html__( 'When do authorization codes expire?', 'moveaddons' ),
                            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'title' => esc_html__( 'How do I revoke a token?', 'moveaddons' ),
                            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                            'content_source'=>'custom',
                        ]
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

        $this->end_controls_section();

        // Aditional Options area Start
        $this->start_controls_section(
            'aditional_options',
            [
                'label' => esc_html__( 'Aditional Options', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'show_item',
                [
                    'label' => esc_html__( 'Show First Item', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator'=>'after',
                ]
            );

            $this->add_control(
                'custom_icon',
                [
                    'label' => esc_html__( 'Custom Icon', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'open_icon',
                [
                    'label'       => esc_html__( 'Open Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'openicon',
                    'condition'=>[
                        'custom_icon'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'close_icon',
                [
                    'label'       => esc_html__( 'Close Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'closeicon',
                    'condition'=>[
                        'custom_icon'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'icon_position',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'after',
                    'options' => [
                        'before'=> esc_html__( 'Before Title', 'moveaddons' ),
                        'after' => esc_html__( 'After Title', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                    'separator'=>'before',
                ]
            );

        $this->end_controls_section();

        // Accordion item style tab section
        $this->start_controls_section(
            'accordion_item_style',
            [
                'label' => esc_html__( 'Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'accordion_item_spacing',
                [
                    'label' => esc_html__( 'Item Spacing', 'moveaddons' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 12,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card + .htmove-accordion-card' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'accordion_item_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card',
                ]
            );

            $this->add_responsive_control(
                'accordion_item_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'accordion_item_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'accordion_item_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card',
                ]
            );

            $this->add_responsive_control(
                'accordion_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Title style tab start
        $this->start_controls_section(
            'accordion_title_style',
            [
                'label'     => esc_html__( 'Title', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'title_align',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'start'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-head' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

            $this->start_controls_tabs('accordion_title_style_tabs');

                // Accordion Title Normal tab Start
                $this->start_controls_tab(
                    'accordion_title_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'title_normal_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_title_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'title_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'accordion_title_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-head',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Title Normal tab End

                // Accordion Title Active tab Start
                $this->start_controls_tab(
                    'accordion_title_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'moveaddons' ),
                    ]
                );
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'activebackground',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head',
                        ]
                    );

                    $this->add_control(
                        'accordion_title_active_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_title_active_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_active_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_active_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'active_title_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Title Active tab End

            $this->end_controls_tabs();

        $this->end_controls_section();


        // Content style tab start
        $this->start_controls_section(
            'accordion_content_style',
            [
                'label'     => esc_html__( 'Content', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'accordion_content_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-content' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-content',
                ]
            );

            $this->add_responsive_control(
                'accordion_content_align',
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
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'accordion_content_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-accordion .htmove-accordion-card .htmove-accordion-content' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Icon style tab start
        $this->start_controls_section(
            'accordion_icon_style',
            [
                'label'     => esc_html__( 'Icon', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        
            // Accordion Icon tabs Start
            $this->start_controls_tabs('htmega_accordion_icon_style_tabs');

                // Accordion Icon normal tab Start
                $this->start_controls_tab(
                    'accordion_icon_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'accordion_icon_indecator_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-indicator::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-indicator::after' => 'background-color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon!'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'iconbackground',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'accordion_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_icon_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_icon_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon',
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_icon_lineheight',
                        [
                            'label' => esc_html__( 'Icon Line Height', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 150,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_icon_width',
                        [
                            'label' => esc_html__( 'Icon Width', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card:not(.is-active) .htmove-accordion-head .htmove-accordion-head-icon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Accordion Icon normal tab End

                // Accordion Icon Active tab Start
                $this->start_controls_tab(
                    'accordion_active_icon_style_tab',
                    [
                        'label' => esc_html__( 'Active', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'accordion_icon_active_indecator_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-indicator::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-indicator::after' => 'background-color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon!'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'iconactivebackground',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'accordion_active_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_active_icon_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_active_icon_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_active_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon',
                            'separator' => 'before',
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'accordion_active_icon_lineheight',
                        [
                            'label' => esc_html__( 'Icon Line Height', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 150,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-accordion .htmove-accordion-card.is-active .htmove-accordion-head .htmove-accordion-head-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'=>[
                                'custom_icon'=>'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Accordion Icon Active tab End

            $this->end_controls_tabs();

        $this->end_controls_section(); // Icon style tabs end


    }

    protected function render( $instance = [] ) {
        $settings       = $this->get_settings_for_display();
        $accordion_list = $this->get_settings_for_display('accordion_list');
        $id             = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-faq htmove-accordion htmove-icon-pos-'.$settings['icon_position'] );
        $this->add_render_attribute( 'area_attr', 'id', 'htmove-accordion-'.$id );

        $accordion_settings = [
            'showitem' => ( 'yes' === $settings['show_item'] ),
        ];
        $this->add_render_attribute( 'area_attr', 'data-settings', wp_json_encode( $accordion_settings ) );

        // Icon
        $open_icon = ( !empty( $settings['open_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-open-icon">'.move_addons_render_icon( $settings,'open_icon', 'openicon' ).'</span>' : ''  );

        $close_icon = ( !empty( $settings['close_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-close-icon">'.move_addons_render_icon( $settings,'close_icon', 'closeicon' ).'</span>' : '' );

        $icon = '<span class="htmove-accordion-head-indicator"></span>';
        if( !empty( $settings['open_icon']['value'] ) || !empty( $settings['close_icon']['value'] )){
            $icon = $open_icon.$close_icon;
        }

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php
                    if( is_array( $accordion_list ) ){
                        foreach ( $accordion_list as  $accordion ){

                            $title = ( !empty( $accordion['title'] ) ? '<span class="htmove-accordion-head-text">'.$accordion['title'].'</span>' : '' );

                            if( $accordion['individual_icon'] == 'yes' ){
                                $ind_open_icon = ( !empty( $accordion['indopen_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-open-icon">'.move_addons_render_icon( $accordion,'indopen_icon', 'indopenicon' ).'</span>' : ''  );

                                $ind_close_icon = ( !empty( $accordion['indclose_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-close-icon">'.move_addons_render_icon( $accordion,'indclose_icon', 'indcloseicon' ).'</span>' : '' );

                                $open_close_icon = $ind_open_icon.$ind_close_icon;

                            }else{
                                $open_close_icon = $icon;
                            }

                            ?>
                            <div class="htmove-accordion-card">
                                <?php
                                    if( $settings['icon_position'] == 'after'){
                                        echo sprintf( '<div class="htmove-accordion-head">%2$s %1$s</div>',$open_close_icon, $title );
                                    }else{
                                        echo sprintf( '<div class="htmove-accordion-head">%1$s %2$s</div>',$open_close_icon, $title );
                                    }
                                ?>
                                <div class="htmove-accordion-body">
                                    <div class="htmove-accordion-content">
                                    <?php 
                                        if ( $accordion['content_source'] == 'custom' && !empty( $accordion['content'] ) ) {
                                            echo wp_kses_post( $accordion['content'] );
                                        } elseif ( $accordion['content_source'] == "elementor" && !empty( $accordion['template_id'] )) {
                                            echo move_addons_get_elementor()->frontend->get_builder_content_for_display( $accordion['template_id'] );
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        <?php

    }

}