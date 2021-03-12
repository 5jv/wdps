<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Image_Box_Element extends Base {

    public function get_name() {
        return 'move-image-box';
    }

    public function get_title() {
        return esc_html__( 'Image Box', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-image-box';
    }

    public function get_keywords() {
        return [ 'move', 'image box', 'box', 'image' ];
    }

    public function get_style_depends() {
        return ['move-imagebox'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'box_style',
                [
                    'label' => esc_html__( 'Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style One', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'image',
                [
                    'label' => esc_html__( 'Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image_size',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition'=>[
                        'image[url]!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'image_align',
                [
                    'label'   => esc_html__( 'Image Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                        'top'  => esc_html__( 'Top', 'moveaddons' ),
                        'bottom'  => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'image[url]!'=>'',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Vase of Flowers', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type image box title here', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__( 'Title Tag', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => move_addons_html_tag_lists(),
                    'default' => 'h3',
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type image box description here', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type Button text here', 'moveaddons' ),
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
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-button-icon-right .htmove-btn-cion'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-button-icon-left .htmove-btn-cion'   => 'margin-right: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content' => 'text-align: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-image-content-%s',
                ]
            );

            $this->add_responsive_control(
                'content_verticle_alignment',
                [
                    'label' => esc_html__( 'Vertical Align', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content' => 'align-self: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-image-content-%s',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-image-box',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-box',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-box',
                ]
            );

            $this->add_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'area_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Image Style tab section
        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'image[url]!'=>'',
                ],
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail img',
                ]
            );

            $this->add_control(
                'image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail::before' => 'left:{{LEFT}}{{UNIT}};right:{{RIGHT}}{{UNIT}};width:auto;height:auto;top:{{TOP}}{{UNIT}};bottom:{{BOTTOM}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
                'image_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_width',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail' => 'width: {{SIZE}}{{UNIT}};flex:1 0 {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->start_controls_tabs('image_style_tabs');

                $this->start_controls_tab(
                    'image_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'image_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail::before' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_overlay_opacity',
                        [
                            'label' => esc_html__( 'Overlay Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-thumbnail::before' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'image_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'image_hover_overlay_color',
                        [
                            'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box:hover .htmove-image-box-thumbnail::before' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_hover_overlay_opacity',
                        [
                            'label' => esc_html__( 'Overlay Opacity', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box:hover .htmove-image-box-thumbnail::before' => 'opacity: {{SIZE}};',
                            ],
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
                'condition'=>[
                    'title!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'condition'=>[
                    'description!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-text .htmove-description' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-text .htmove-description',
                ]
            );

            $this->add_responsive_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_responsive_control(
                'description_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-box .htmove-image-box-content .htmove-image-box-text .htmove-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'button_text!'=>'',
                ]
            ]
        );

            $this->add_control(
                'button_style',
                [
                    'label' => esc_html__( 'Button Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one' => esc_html__( 'One', 'moveaddons' ),
                        'two' => esc_html__( 'Two', 'moveaddons' ),
                    ],
                ]
            );

            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn, {{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn,{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn,{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
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
                        'button_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn:hover,{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-image-box .htmove-image-box-btn:hover,{{WRAPPER}} .htmove-image-box .htmove-image-box-btn-2:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-image-box htmove-image-box-'.$settings['box_style'] );

        // Image
        if( !empty($settings['image']['url']) ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-image-'.$settings['image_align'] );
        }

        // URl Generate
        if ( ! empty( $settings['button_link']['url'] ) ) {

            if( $settings['button_style'] == 'two' ){
                $this->add_render_attribute( 'url', 'class', 'htmove-image-box-btn-2' );
            }else{
                $this->add_render_attribute( 'url', 'class', 'htmove-image-box-btn' );
            }
            
            $this->add_render_attribute( 'url', 'href', $settings['button_link']['url'] );
            if ( $settings['button_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }

        }

        // Button Icon
        $button_icon = $button_text = $button = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-button-icon-'.$settings['button_icon_align'] );

            $button_icon = '<span class="htmove-btn-cion">'.move_addons_render_icon( $settings, 'button_icon', 'icon' ).'</span>';

        }
        $button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : $button_text;

        if( !empty( $settings['button_text'] ) ){
            $button = sprintf('<a %1$s><span class="htmove-btn-text">%2$s</span>%3$s</a>',$this->get_render_attribute_string( 'url' ), $button_text, $button_icon );
        } 

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php
                    if( !empty($settings['image']['url']) ){
                        echo '<div class="htmove-image-box-thumbnail">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' ).( $settings['box_style'] == 'two' ? $button : '' ).'</div>';
                    }
                ?>

                <div class="htmove-image-box-content">
                    <?php
                        if( !empty( $settings['title'] ) ){
                            echo sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $settings['title_tag'], 'htmove-image-box-title', $settings['title'] );
                        }

                        if( !empty( $settings['description'] ) ){
                            echo sprintf('<div class="htmove-image-box-text"><%1$s class="%2$s">%3$s</%1$s></div>','div','htmove-description', $settings['description'] );
                        }
                        if( $settings['box_style'] != 'two' ){
                            echo $button;
                        }
                    ?>
                </div>

            </div>
        <?php

    }

}