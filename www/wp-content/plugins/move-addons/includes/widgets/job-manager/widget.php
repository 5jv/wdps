<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Job_Manager_Element extends Base {

    public function get_name() {
        return 'move-job-manager';
    }

    public function get_title() {
        return esc_html__( 'Job Manager', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-site-title';
    }

    public function get_keywords() {
        return [ 'move', 'job manager', 'job', 'manager' ];
    }

    public function get_style_depends() {
        return [ 'elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-job-manager','move-accordion' ];
    }

    public function get_script_depends() {
        return ['move-accordion','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Job Manager', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Select Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style One','moveaddons' ),
                        'two'   => esc_html__( 'Style Two','moveaddons' ),
                        'three' => esc_html__( 'Style Three','moveaddons' ),
                    ],
                    'label_block' => true,
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

            $this->add_control(
                'content_len',
                [
                    'label' => esc_html__('Content Length', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 15,
                ]
            );

            $this->add_control(
                'individual_job',
                [
                    'label' => esc_html__( 'Individual Select', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'individual_ids',
                [
                    'label' => esc_html__( 'Select Job', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => move_addons_get_post_list( 'job_listing', ['limit'=>-1 ] ),
                    'condition'=>[
                        'individual_job'=>'yes',
                    ],
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'additional_option_section',
            [
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
                'condition' => [
                    'layout' => ['one','two']
                ]
            ]
        );
            
            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Apply now', 'moveaddons' ),
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
                'show_location',
                [
                    'label' => esc_html__( 'Location', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_types',
                [
                    'label' => esc_html__( 'Types', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['one','two']
                ]
            ]
        );
            
            $this->add_responsive_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'area_space_between',
                [
                    'label' => esc_html__( 'Space between', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-manager > li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-job-item',
                ]
            );

        $this->end_controls_section();

        // Title Style tab section
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['one','two']
                ]
            ]
        );
            
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'condition' => [
                    'layout' => ['one','two']
                ]
            ]
        );
            
            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-content p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Meta Info Style tab section
        $this->start_controls_section(
            'meta_style',
            [
                'label' => esc_html__( 'Meta Info', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['one','two']
                ]
            ]
        );
            
            $this->add_control(
                'meta_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-meta li' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-meta li',
                ]
            );

            $this->add_responsive_control(
                'meta_space_between',
                [
                    'label' => esc_html__( 'Space between', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-job-item .htmove-job-content .htmove-job-meta li' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Apply Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('button_style_tabs');

                $this->add_control(
                    'btn_padding',
                    [
                        'label' => esc_html__( 'Padding', 'moveaddons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'btn_margin',
                    [
                        'label' => esc_html__( 'Margin', 'moveaddons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn,{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn',
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn,{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn:hover,{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-job-item .htmove-job-action .htmove-job-btn:hover,{{WRAPPER}} .htmove-accordion-content .htmove-job-action .htmove-job-btn',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


        // Accordion Options area Start
        $this->start_controls_section(
            'aditional_options',
            [
                'label' => esc_html__( 'Accordion Options', 'moveaddons' ),
                'condition' => [
                    'layout' => 'three'
                ]
            ]
        );
            
            $this->add_control(
                'button_text2',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
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
                    'default' => 'before',
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
                'label' => esc_html__( 'Accordion Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'three'
                ]
            ]
        );
            
            $this->add_responsive_control(
                'accordion_item_spacing',
                [
                    'label' => esc_html__( 'Accordion Item Spacing', 'moveaddons' ),
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
                'label'     => esc_html__( 'Accordion Title', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'three'
                ]
            ]
        );

            $this->add_responsive_control(
                'accordion_title_align',
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
                            'name' => 'accordion_title_normal_background',
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
                            'name' => 'accordion_title_box_shadow',
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
                            'name' => 'accordion_title_typography',
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
                'label'     => esc_html__( 'Accordion Content', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'three'
                ]
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
                    'name' => 'accordion_content_typography',
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
                'label'     => esc_html__( 'Accordion Icon', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'three'
                ]
            ]
        );
        
            // Accordion Icon tabs Start
            $this->start_controls_tabs('accordion_icon_style_tabs');

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
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-job-manager htmove-job-manager-'.$settings['layout'] );

        $args = array(
            'post_type'       => 'job_listing',
            'post_status'     => 'publish',
        );

        if( $settings['individual_job'] != 'yes' ){
            $args['posts_per_page'] = !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 5;
        }

        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }
        if( $custom_order_ck != 'yes' ){
            $args['order']    = $postorder;
        }

        if( $settings['individual_job'] == 'yes' ){
            $args['post__in'] = $settings['individual_ids'];
        }

        if( class_exists( '\WP_Job_Manager' ) ){

            $job_list = new \WP_Query( $args );

            if ( $job_list->have_posts() ) {

                if( $settings['layout'] == 'three' ){

                    $this->add_render_attribute( 'accarea_attr', 'class', 'htmove-accordion htmove-icon-pos-'.$settings['icon_position'] );
                    $this->add_render_attribute( 'accarea_attr', 'id', 'htmove-accordion-'.$id );

                    $accordion_settings = [
                        'showitem' => ( 'yes' === $settings['show_item'] ),
                    ];
                    $this->add_render_attribute( 'accarea_attr', 'data-settings', wp_json_encode( $accordion_settings ) );

                    // Icon
                    $open_icon = ( !empty( $settings['open_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-open-icon">'.move_addons_render_icon( $settings,'open_icon', 'openicon' ).'</span>' : ''  );

                    $close_icon = ( !empty( $settings['close_icon']['value'] ) ? '<span class="htmove-accordion-head-icon htmove-accordion-close-icon">'.move_addons_render_icon( $settings,'close_icon', 'closeicon' ).'</span>' : '' );

                    $icon = '<span class="htmove-accordion-head-indicator"></span>';
                    if( !empty( $settings['open_icon']['value'] ) || !empty( $settings['close_icon']['value'] )){
                        $icon = $open_icon.$close_icon;
                    }

                    ?>
                    <div <?php echo $this->get_render_attribute_string( 'accarea_attr' ); ?> >

                        <?php while ( $job_list->have_posts() ): 
                            $job_list->the_post(); 
                                $title = wpjm_get_the_job_title();
                            ?>
                            <div class="htmove-accordion-card">
                                <?php
                                    if( $settings['icon_position'] == 'after'){
                                        echo sprintf( '<div class="htmove-accordion-head">%2$s %1$s</div>',$icon, $title );
                                    }else{
                                        echo sprintf( '<div class="htmove-accordion-head">%1$s %2$s</div>',$icon, $title );
                                    }
                                ?>
                                <div class="htmove-accordion-body">
                                    <div class="htmove-accordion-content">
                                        <p><?php echo wp_trim_words( get_the_content(), $settings['content_len'], ' ' ); ?></p>

                                        <?php if( !empty( $settings['button_text2'] ) ): ?>
                                            <div class="htmove-job-action">
                                                <a href="<?php the_job_permalink(); ?>" class="htmove-job-btn"><?php echo esc_html__( $settings['button_text2'], 'moveaddons' ); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    </div>
                    <?php

                }else{
                ?>                
                    <ul <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                        <?php while ( $job_list->have_posts() ): 
                            $job_list->the_post();
                        ?>
                            <li>
                                <div class="htmove-job-item">
                                    <div class="htmove-job-content">
                                        <h4 class="htmove-job-title">
                                            <a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
                                        </h4>
                                        <p><?php echo wp_trim_words( get_the_content(), $settings['content_len'], ' ' ); ?></p>

                                        <?php if( $settings['show_location'] == 'yes' || $settings['show_types'] == 'yes' ): ?>
                                            <ul class="htmove-job-meta">
                                                <?php if( $settings['show_location'] == 'yes' ): ?>
                                                    <li>
                                                        <i class="fas fa-map-marker"></i>
                                                        <?php the_job_location( false ); ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if( get_option( 'job_manager_enable_types' ) && $settings['show_types'] == 'yes' ): 

                                                $types = wpjm_get_the_job_types();
                                                if ( ! empty( $types ) ) :
                                                ?>
                                                    <li>
                                                        <i class="fas fa-user-tie"></i>
                                                        <?php 
                                                            foreach ( $types as $type ){
                                                                echo esc_html( $type->name );
                                                            }
                                                        ?>
                                                    </li>
                                                <?php endif;endif; ?>
                                            </ul>
                                        <?php endif; ?>

                                    </div>
                                    <?php if( !empty( $settings['button_text'] ) ): ?>
                                        <div class="htmove-job-action">
                                            <a href="<?php the_job_permalink(); ?>" class="htmove-job-btn"><?php echo esc_html__( $settings['button_text'], 'moveaddons' ); ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php
                }
            }
            
        }

    }

}