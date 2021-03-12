<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dual_Color_Heading_Element extends Base {

    public function get_name() {
        return 'move-doul-color-heading';
    }

    public function get_title() {
        return esc_html__( 'Dual Color Headline', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-heading';
    }

    public function get_keywords() {
        return [ 'move', 'doul color','headline', 'heading', 'section title', 'title' ];
    }

    public function get_style_depends() {
        return [
            'move-heading',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'heading_content',
            [
                'label' => esc_html__( 'Heading', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'heading',
                [
                    'label' => esc_html__( 'Heading', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Move Plugin The Ultimate Addons', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your heading here', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'sub_heading',
                [
                    'label' => esc_html__( 'Sub Heading', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Modern Heading', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your sub heading here', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'description_heading',
                [
                    'label' => esc_html__( 'Heading Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Your Widget List freely use these elements to create your site. You can enable which you are not using.', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your heading description here', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'heading_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'headingicon',
                ]
            );

            $this->add_control(
                'heading_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top'    => esc_html__( 'Top', 'moveaddons' ),
                        'bottom' => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition' => [
                        'heading_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'heading_highlight_enable',
                [
                    'label' => esc_html__( 'Highlight Text Enable', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'heading_highlight_txt',
                [
                    'label' => esc_html__( 'Highlight Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your highlight text here', 'moveaddons' ),
                    'default' => esc_html__( 'An Effective Business Card', 'moveaddons' ),
                    'condition'=>[
                        'heading_highlight_enable'=>'yes',
                    ],
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'heading_highlight_txt_pos',
                [
                    'label'   => esc_html__( 'Highlight text position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'after',
                    'options' => [
                        'before' => esc_html__( 'Before Title', 'moveaddons' ),
                        'after'  => esc_html__( 'After Title', 'moveaddons' ),
                    ],
                    'condition' => [
                        'heading_highlight_txt!' => '',
                    ],
                ]
            );

        $this->end_controls_section();

        // Headinbg Option start
        $this->start_controls_section(
            'heading_setting',
            [
                'label' => esc_html__( 'Setting', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'heading_link',
                [
                    'label' => esc_html__( 'Heading Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'heading!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'highlight_link',
                [
                    'label' => esc_html__( 'Highlight Text Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'heading_highlight_enable'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'sub_heading_link',
                [
                    'label' => esc_html__( 'Sub Heading Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'heading_tag',
                [
                    'label' => esc_html__( 'Heading HTML Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'h2',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'sub_heading_tag',
                [
                    'label' => esc_html__( 'Sub Heading HTML Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'span',
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'desc_heading_tag',
                [
                    'label' => esc_html__( 'Heading Description HTML Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'p',
                    'condition'=>[
                        'description_heading!'=>'',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'sub_heading_position',
                [
                    'label' => esc_html__( 'Sub Heading Position', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => esc_html__( 'Top', 'moveaddons' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => esc_html__( 'Bottom', 'moveaddons' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'default' => 'top',
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'enable_separator',
                [
                    'label' => esc_html__( 'Enable Separator', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'heading!'=>'',
                    ],
                ]
            );

            $this->add_responsive_control(
                'separator_width',
                [
                    'label' => esc_html__( 'Separator Width', 'moveaddons' ),
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
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-separator' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'enable_separator'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'separator_color',
                [
                    'label' => esc_html__( 'Separator Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-separator' => 'background-color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'enable_separator'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'enable_placeholder',
                [
                    'label' => esc_html__( 'Enable Transparent text', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'heading_placeholder_txt',
                [
                    'label' => esc_html__( 'Heading Transparent Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your placeholder text here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition'=>[
                        'enable_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'sub_placeholder_txt',
                [
                    'label' => esc_html__( 'Sub Heading Transparent Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your placeholder text here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition'=>[
                        'enable_placeholder'=>'yes',
                    ],
                ]
            );

        $this->end_controls_section(); // Subtitle Option end

        // Style tab section
        $this->start_controls_section(
            'heading_area_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'alignment',
                [
                    'label' => esc_html__( 'Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading' => 'align-items: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'htmove-heading-%s',
                ]
            );

        $this->end_controls_section();

        /* Headline Style */
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#333333',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-title',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'heading_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-title',
                ]
            );

            $this->add_responsive_control(
                'heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_nmargin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Sub headline Style*/
        $this->start_controls_section(
            'sub_heading_style',
            [
                'label' => esc_html__( 'Sub Heading', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'sub_heading!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'sub_heading_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#666666',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_heading_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'sub_heading_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title',
                ]
            );

            $this->add_responsive_control(
                'sub_heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sub_heading_nmargin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sub_heading_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sub_heading_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-sub-title',
                ]
            );

        $this->end_controls_section();

        /* Description headline Style*/
        $this->start_controls_section(
            'desc_heading_style',
            [
                'label' => esc_html__( 'Heading Description', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'description_heading!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'desc_heading_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-desc' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_heading_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-desc',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'desc_heading_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heading-desc',
                ]
            );

            $this->add_responsive_control(
                'desc_heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-desc' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_heading_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_heading_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Icon style tab start
        $this->start_controls_section(
            'heading_icon_style_section',
            [
                'label'     => esc_html__( 'Icon', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading_icon[value]!' => '',
                ],
            ]
        );
            
            $this->add_control(
                'icon_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heading-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Size', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-heading .htmove-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-heading .htmove-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-heading .htmove-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Transparent text Style*/
        $this->start_controls_section(
            'transparent_heading_style',
            [
                'label' => esc_html__( 'Transparent', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'enable_placeholder'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'transparent_heading',
                [
                    'label' => esc_html__( 'Heading Transparent', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'transparent_heading_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#F3F3F3',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading.htmove-heading-placeholder .htmove-heading-title::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'transparent_heading_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading.htmove-heading-placeholder .htmove-heading-title::before',
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'transparent_subheading',
                [
                    'label' => esc_html__( 'Sub Heading Transparent', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'transparent_subheading_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#E6E6E6',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading.htmove-heading-placeholder .htmove-heading-sub-title::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'transparent_subheading_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading.htmove-heading-placeholder .htmove-heading-sub-title::before',
                    'separator'=>'before',
                ]
            );

        $this->end_controls_section();

        /* Highlight text Style*/
        $this->start_controls_section(
            'highlight_headline_style',
            [
                'label' => esc_html__( 'Highlight Text', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'heading_highlight_enable'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'highlight_headline_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1D39D7',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heighlight-txt' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'highlight_headline_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-heading .htmove-heighlight-txt',
                ]
            );

            $this->add_responsive_control(
                'highlight_headline_nmargin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-heading .htmove-heighlight-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-heading htmove-heading-center' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-sub-heading-pos-'.$settings['sub_heading_position'] );

        if( $settings['enable_placeholder'] =='yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-heading-placeholder' );
        }

        $heading    = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
        $subheading = ! empty( $settings['sub_heading'] ) ? $settings['sub_heading'] : '';
        $des_heading = ! empty( $settings['description_heading'] ) ? $settings['description_heading'] : '';

        $heading_pl_txt = ! empty( $settings['heading_placeholder_txt'] ) ? 'data-pltext="'.$settings['heading_placeholder_txt'].'"' : '';
        $sub_heading_pl_txt = ! empty( $settings['sub_placeholder_txt'] ) ? 'data-pltext="'.$settings['sub_placeholder_txt'].'"' : '';

        $highlight_txt = ! empty( $settings['heading_highlight_txt'] ) ? '<span class="htmove-heighlight-txt">'.$settings['heading_highlight_txt'].'</span>' : '';


        // URL Generate For Heading
        if ( ! empty( $settings['heading_link']['url'] ) ) {

            $this->add_render_attribute( 'headingurl', 'href', $settings['heading_link']['url'] );

            if ( $settings['heading_link']['is_external'] ) {
                $this->add_render_attribute( 'headingurl', 'target', '_blank' );
            }

            if ( ! empty( $settings['heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'headingurl', 'rel', 'nofollow' );
            }

            $heading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'headingurl' ), $heading );

        }

        // URL Generate For highlight txt
        if ( ! empty( $settings['highlight_link']['url'] ) ) {
            $this->add_render_attribute( 'highlightgurl', 'href', $settings['highlight_link']['url'] );

            if ( $settings['highlight_link']['is_external'] ) {
                $this->add_render_attribute( 'highlightgurl', 'target', '_blank' );
            }

            if ( ! empty( $settings['highlight_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'highlightgurl', 'rel', 'nofollow' );
            }

            $highlight_txt = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'highlightgurl' ), $highlight_txt );
        }

        // URL Generate For Sub Heading
        if ( ! empty( $settings['sub_heading_link']['url'] ) ) {

            $this->add_render_attribute( 'subheadingurl', 'href', $settings['sub_heading_link']['url'] );

            if ( $settings['sub_heading_link']['is_external'] ) {
                $this->add_render_attribute( 'subheadingurl', 'target', '_blank' );
            }

            if ( ! empty( $settings['sub_heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'subheadingurl', 'rel', 'nofollow' );
            }

            $subheading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'subheadingurl' ), $subheading );

        }

        $heading_icon = '';
        if( !empty( $settings['heading_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-heading-icon-'.$settings['heading_icon_align'] );

            $heading_icon = '<span class="htmove-heading-icon">'.move_addons_render_icon( $settings, 'heading_icon', 'headingicon' ).'</span>';
        }

        $heading_output = $sub_heading = $heading_des = $heading_text ='';
        if( !empty( $subheading ) ){
            $this->add_render_attribute( 'sub_heading_attr', 'class', 'htmove-heading-sub-title' );
            $sub_heading = sprintf( '<%1$s %4$s %2$s>%3$s</%1$s>', $settings['sub_heading_tag'], $this->get_render_attribute_string( 'sub_heading_attr' ), $subheading, $sub_heading_pl_txt );
        }

        if( !empty( $heading ) ){
            $this->add_render_attribute( 'heading_attr', 'class', 'htmove-heading-title' );

            if ( $settings['heading_highlight_txt_pos'] == 'before' ) {
                $heading_text = sprintf( '<%1$s %4$s %2$s>%5$s %3$s</%1$s>', $settings['heading_tag'], $this->get_render_attribute_string( 'heading_attr' ), $heading, $heading_pl_txt, $highlight_txt );
            }else{
                $heading_text = sprintf( '<%1$s %4$s %2$s>%3$s %5$s</%1$s>', $settings['heading_tag'], $this->get_render_attribute_string( 'heading_attr' ), $heading, $heading_pl_txt, $highlight_txt );
            }
        }

        if( !empty( $des_heading ) ){
            $this->add_render_attribute( 'des_heading_attr', 'class', 'htmove-heading-desc' );
            $heading_des = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['desc_heading_tag'], $this->get_render_attribute_string( 'des_heading_attr' ), $des_heading );
        }

        // Separator
        if( $settings['enable_separator'] == 'yes' && !empty( $heading ) ){
            $heading_text = $heading_text.'<span class="htmove-heading-separator"></span>';
        }

        // Sub Heading Position
        if( $settings['sub_heading_position'] === 'bottom' ){
            $heading_output = $heading_text.$sub_heading.$heading_des;
        }else{
            $heading_output = $sub_heading.$heading_text.$heading_des;
        }

        // Icon Position
        if( $settings['heading_icon_align'] === 'bottom' ){
            $heading_output = $heading_output.$heading_icon;
        }else{
            $heading_output = $heading_icon.$heading_output;
        }

        echo sprintf('<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'area_attr' ), $heading_output );
        

    }

}