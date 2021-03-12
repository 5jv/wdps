<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Banner_Element extends Base {

    public function get_name() {
        return 'move-banner';
    }

    public function get_title() {
        return esc_html__( 'Banner', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-banner';
    }

    public function get_keywords() {
        return [ 'move', 'banner', 'adds', 'adds banner', 'offer banner', 'discount','discount banner','product banner' ];
    }

    public function get_style_depends() {
        return [
            'move-banner',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'banner_content',
            [
                'label' => esc_html__( 'Banner', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'banner_style',
                [
                    'label' => esc_html__( 'Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style One', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                        'three' => esc_html__( 'Style Three', 'moveaddons' ),
                        'four'  => esc_html__( 'Style Four', 'moveaddons' ),
                        'five'  => esc_html__( 'Style Five', 'moveaddons' ),
                        'six'   => esc_html__( 'Style Six', 'moveaddons' ),
                        'seven' => esc_html__( 'Style Seven', 'moveaddons' ),
                        'eight' => esc_html__( 'Style Eight', 'moveaddons' ),
                        'nine' => esc_html__( 'Style Nine', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'banner_content_pos',
                [
                    'label' => esc_html__( 'Content Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'bottom-center',
                    'options' => [
                        'bottom-left'   => esc_html__( 'Bottom Left', 'moveaddons' ),
                        'bottom-center' => esc_html__( 'Bottom Center', 'moveaddons' ),
                        'bottom-right'  => esc_html__( 'Bottom Right', 'moveaddons' ),
                        'top-left'      => esc_html__( 'Top Left', 'moveaddons' ),
                        'top-center'    => esc_html__( 'Top Center', 'moveaddons' ),
                        'top-right'     => esc_html__( 'Top Right', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'banner_style'=>'five'
                    ],
                ]
            );

            $this->add_control(
                'banner_image',
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
                    'name' => 'banner_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition'=>[
                        'banner_image[url]!'=>'',
                    ]
                ]
            );

            $this->add_control(
                'banner_title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=> esc_html__( 'Coats and Jackets', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Banner Title', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'banner_sub_title',
                [
                    'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Banner Sub Title', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'banner_sub_title_pos',
                [
                    'label' => esc_html__( 'Sub Title Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'after',
                    'options' => [
                        'before'  => esc_html__( 'Before Title', 'moveaddons' ),
                        'after'   => esc_html__( 'After Title', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'banner_sub_title!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'banner_badge',
                [
                    'label' => esc_html__( 'Badge', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=> esc_html__( 'Sale', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Sale', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'banner_description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => esc_html__( 'Banner Description', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'banner_link',
                [
                    'label' => esc_html__( 'Banner Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

            $this->add_control(
                'banner_button_txt',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=>esc_html__( 'Shop Now', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Button Text', 'moveaddons' ),
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
                        'button_style' => 'one',
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

            $this->add_control(
                'image_area_link',
                [
                    'label' => esc_html__( 'Enable link in image', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=> [
                        'banner_link[url]!'=>''
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Area Style tab section
        $this->start_controls_section(
            'banner_area_style',
            [
                'label' => esc_html__( 'Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-banner',
                ]
            );

            $this->add_responsive_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .htmove-banner .htmove-banner-thumb img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'content_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-banner-seven .htmove-banner-info',
                    'condition' => [
                        'banner_style' => 'seven',
                    ],
                ]
            );

        $this->end_controls_section();
        // End Area Style tab section

        // Title Style tab section
        $this->start_controls_section(
            'banner_title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_title!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'banner_title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-title',
                ]
            );

            $this->add_responsive_control(
                'banner_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_title_align',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        // Title Style End

        // Sub Title Style tab section
        $this->start_controls_section(
            'banner_sub_title_style',
            [
                'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_sub_title!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'banner_sub_title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-sub-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_sub_title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-sub-title',
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_align',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content .htmove-banner-sub-title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        // Title Style End

        // Description Style tab section
        $this->start_controls_section(
            'banner_description_style',
            [
                'label' => esc_html__( 'Description', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_description!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'banner_description_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content p' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_description_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content p',
                ]
            );

            $this->add_responsive_control(
                'banner_description_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_description_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_description_align',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-content p' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        // Description Style End

        // Badge Style tab section
        $this->start_controls_section(
            'banner_badge_style',
            [
                'label' => esc_html__( 'Badge', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_badge!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'banner_badge_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-label' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_badge_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-label',
                ]
            );

            $this->add_responsive_control(
                'banner_badge_align',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-banner .htmove-banner-label' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'banner_badge_pos_toggle',
                [
                    'label' => esc_html__( 'Badge Position', 'moveaddons' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'default' => 'no',
                ]
            );

            $this->start_popover();

                $this->add_responsive_control(
                    'badge_x_position',
                    [
                        'label' => esc_html__( 'Horizontal Postion', 'moveaddons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .htmove-banner .htmove-banner-label' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'badge_y_position',
                    [
                        'label' => esc_html__( 'Vertical Postion', 'moveaddons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                             'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .htmove-banner .htmove-banner-label' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_popover();

        $this->end_controls_section();
        // Badge Style End
        
        // Style Button tab section
        $this->start_controls_section(
            'banner_button_style_section',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_button_txt!'=>'',
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
                        'one'  => esc_html__( 'One', 'moveaddons' ),
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
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a',
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
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'banner_button_align',
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
                            'selectors' => [
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link' => 'text-align: {{VALUE}};',
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
                        'button_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a:not(.htmove-banner-btn)::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-banner .htmove-banner-info .htmove-banner-link a:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-banner' );
        if( $settings['banner_style'] == 'eight' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-banner-six position-left-middle' );
        }else if( $settings['banner_style'] == 'nine' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-banner-one-2' );
        }else{
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-banner-'.$settings['banner_style'] );
        }
        $this->add_render_attribute( 'area_attr', 'class', 'position-'.$settings['banner_content_pos'] );

        // URL Generate
        if ( ! empty( $settings['banner_link']['url'] ) ) {
            
            $this->add_render_attribute( 'url', 'href', $settings['banner_link']['url'] );
            if ( $settings['banner_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['banner_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }

        }

        // Button Icon
        $button_icon = $button_text = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-button-icon-'.$settings['button_icon_align'] );

            $button_icon = '<span class="htmove-btn-cion">'.move_addons_render_icon( $settings, 'button_icon', 'icon' ).'</span>';

        }
        $button_text  = ! empty( $settings['banner_button_txt'] ) ? $settings['banner_button_txt'] : $button_text;

        ?>

        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <?php 
                if( !empty( $settings['banner_image']['url'] ) ){

                    if( $settings['image_area_link'] === 'yes' ){ echo '<a '.$this->get_render_attribute_string( 'url' ).'>';
                    }
                        echo '<div class="htmove-banner-thumb">' . \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'banner_image_size', 'banner_image' ) . '</div>';
                    if( $settings['image_area_link'] === 'yes' ){ echo '</a>';}
                }

            ?>
            <div class="htmove-banner-info">
                <?php
                    if( !empty( $settings['banner_badge'] ) ){
                        echo '<span class="htmove-banner-label">'.esc_html( $settings['banner_badge'] ).'</span>';
                    }
                ?>
                <?php if( !empty( $settings['banner_title'] ) || !empty( $settings['banner_description'] ) || !empty( $settings['banner_sub_title'] ) ): ?>
                    <div class="htmove-banner-content">
                        <?php
                            if( !empty( $settings['banner_sub_title'] ) && $settings['banner_sub_title_pos'] === 'before' ){
                                echo '<span class="htmove-banner-sub-title">'. $settings['banner_sub_title'].'</span>'; 
                            }
                            if( !empty( $settings['banner_title'] ) ){
                                echo '<h2 class="htmove-banner-title">'. $settings['banner_title'].'</h2>'; 
                            }
                            if( !empty( $settings['banner_sub_title'] ) && $settings['banner_sub_title_pos'] == 'after' ){
                                echo '<span class="htmove-banner-sub-title">'. $settings['banner_sub_title'].'</span>'; 
                            }
                            if( !empty( $settings['banner_description'] ) ){
                                echo '<p>'. $settings['banner_description'].'</p>'; 
                            }
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php
                    if( !empty( $settings['banner_button_txt'] ) ){
                        echo '<div class="htmove-banner-link"><a class="'.($settings['button_style'] == 'two' ? '' : 'htmove-banner-btn' ).'" '.$this->get_render_attribute_string( 'url' ).'><span class="htmove-btn-text">'.esc_html__( $button_text, 'moveaddons' ).'</span>'.$button_icon.'</a></div>';
                    }
                ?>
            </div>

        </div>
        <?php

    }

}