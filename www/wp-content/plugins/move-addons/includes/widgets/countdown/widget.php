<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Countdown_Element extends Base {

    public function get_name() {
        return 'move-countdown';
    }

    public function get_title() {
        return esc_html__( 'Countdown', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-countdown';
    }

    public function get_keywords() {
        return [ 'move', 'countdown', 'counttime', 'count' ];
    }

    public function get_style_depends() {
        return [ 'move-countdown' ];
    }

    public function get_script_depends() {
        return [ 'move-countdown', 'move-timecircles', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Countdown', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'count_style',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style one', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                        'three' => esc_html__( 'Style Three', 'moveaddons' ),
                        'four'  => esc_html__( 'Style Four', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'count_down_timecircle',
                [
                    'label'        => esc_html__( 'Time Circle', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );

            $this->add_control(
                'target_date',
                [
                    'label'          => esc_html__( 'Due Date', 'moveaddons' ),
                    'type'           => Controls_Manager::DATE_TIME,
                    'picker_options' => array( 'dateFormat' => "Y/m/d" ),
                    'default'        => date( 'Y/m/d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
                    'condition'=>[
                        'count_down_timecircle!'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'target_date2',
                [
                    'label'          => esc_html__( 'Due Date', 'moveaddons' ),
                    'type'           => Controls_Manager::DATE_TIME,
                    'picker_options' => array( 'dateFormat' => "Y-m-d" ),
                    'default'        => date( 'Y-m-d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
                    'condition'=>[
                        'count_down_timecircle'=>'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        // Addintional Option
        $this->start_controls_section(
            'additional_options',
            [
                'label' => esc_html__( 'Additional Options', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'timing_heading',
                [
                    'label' => esc_html__( 'Time Setting', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'count_down_days',
                [
                    'label'        => esc_html__( 'Day', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_hours',
                [
                    'label'        => esc_html__( 'Hours', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_miniute',
                [
                    'label'        => esc_html__( 'Minutes', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'count_down_second',
                [
                    'label'        => esc_html__( 'Seconds', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'yes',
                ]
            );

            $this->add_control(
                'counter_lavel_heading',
                [
                    'label' => esc_html__( 'Label Setting', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'count_down_labels',
                [
                    'label'        => esc_html__( 'Hide Label', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' =>'no',
                ]
            );

            $this->add_control(
                'custom_labels',
                [
                    'label'        => esc_html__( 'Custom Label', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'condition'   => [
                        'count_down_labels!' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_days',
                [
                    'label'       => esc_html__( 'Days', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Days', 'moveaddons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_days'    => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_hours',
                [
                    'label'       => esc_html__( 'Hours', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Hours', 'moveaddons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_hours'   => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_minutes',
                [
                    'label'       => esc_html__( 'Minutes', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Minutes', 'moveaddons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_miniute' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'customlabel_seconds',
                [
                    'label'       => esc_html__( 'Seconds', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Seconds', 'moveaddons' ),
                    'condition'   => [
                        'custom_labels!'     => '',
                        'count_down_labels!' => 'yes',
                        'count_down_second'  => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        // Time Circles Option
        $this->start_controls_section(
            'timing_options',
            [
                'label' => esc_html__( 'Time Circles Options', 'moveaddons' ),
                'condition'=>[
                    'count_down_timecircle'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'circle_animation',
                [
                    'label'   => esc_html__( 'Animation', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'smooth',
                    'options' => [
                        'smooth' => esc_html__( 'Smooth', 'moveaddons' ),
                        'ticks'  => esc_html__( 'Ticks', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'circle_direction',
                [
                    'label'   => esc_html__( 'Direction', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'Clockwise',
                    'options' => [
                        'Clockwise' => esc_html__( 'Clockwise', 'moveaddons' ),
                        'Counter-clockwise'  => esc_html__( 'Counter clockwise', 'moveaddons' ),
                        'Both'  => esc_html__( 'Both', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'fg_width',
                [
                    'label' => esc_html__( 'Foreground Circle Width', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                ]
            );

            $this->add_control(
                'bg_width',
                [
                    'label' => esc_html__( 'Background Circle Width', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                ]
            );

            $this->add_control(
                'use_background',
                [
                    'label'        => esc_html__( 'Use Background', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'circle_bg_color',
                [
                    'label' => esc_html__( 'Circle Background Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'day_circle_color',
                [
                    'label' => esc_html__( 'Day Circle Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'hour_circle_color',
                [
                    'label' => esc_html__( 'Hours Circle Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'minute_circle_color',
                [
                    'label' => esc_html__( 'Minutes Circle Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'second_circle_color',
                [
                    'label' => esc_html__( 'Seconds Circle Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

        $this->end_controls_section();

        // Content Layout
        $this->start_controls_section(
            'countdown_layout',
            [
                'label' => esc_html__( 'Count Layout', 'moveaddons' ),
                'condition'=>[
                    'count_down_timecircle!'=>'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'column_width',
                [
                    'label'   => esc_html__( 'Column Width', 'moveaddons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ '%', 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-single-countdown' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'column_height',
                [
                    'label'   => esc_html__( 'Column Height', 'moveaddons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ '%', 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-single-countdown' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_down_specing',
                [
                    'label' => esc_html__( 'Column Spacing', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-single-countdown + .htmove-single-countdown' => 'margin-left:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Counter Area
        $this->start_controls_section(
            'countdown_area_style',
            [
                'label' => esc_html__( 'Counter Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-countdown-timer',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'counter_area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown-timer',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'count_area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown-timer',
                ]
            );

            $this->add_responsive_control(
                'count_area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown-timer' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown-timer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_area_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown-timer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'item_area_aligntitle',
                [
                    'label' => esc_html__( 'Item Alignment', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-countdown-timer' => 'justify-content: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-item-align%s-',
                ]
            );

        $this->end_controls_section();

        // Counter Item Style tab section
        $this->start_controls_section(
            'countdown_style',
            [
                'label' => esc_html__( 'Counter Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-single-countdown',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'counter_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-single-countdown',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'countborder',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-single-countdown',
                ]
            );

            $this->add_responsive_control(
                'count_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-single-countdown' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'countpadding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-single-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'countmargin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-single-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'aligntitle',
                [
                    'label' => esc_html__( 'Content Alignment', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-single-countdown' => 'text-align: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-count-align%s-',
                ]
            );

        $this->end_controls_section(); // Section style tab end

        // Number style tab start
        $this->start_controls_section(
            'countdown_number_style',
            [
                'label'     => esc_html__( 'Number', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'count_number_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-time' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'count_timer_typography',
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-time',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'count_timer_shadow',
                    'label' => esc_html__( 'Text Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-time',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'count_timer_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-time',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'count_timer_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-time',
                ]
            );

            $this->add_responsive_control(
                'count_timer_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-time' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_timer_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_timer_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Timer style tab end

        // Label Style tab section
        $this->start_controls_section(
            'countdown_label_style',
            [
                'label' => esc_html__( 'Label', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'count_down_labels!' => 'yes',
                ],
            ]
        );
            $this->add_control(
                'count_lavel_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'count_lavel_typography',
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-name',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'count_lavel_shadow',
                    'label' => esc_html__( 'Text Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-name',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'count_lavel_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-name',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'count_lavel_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-countdown .htmove-countdown-name',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-name' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'count_lavel_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-countdown .htmove-countdown-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Label style tab end


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $data_options = [
            'targetdate' => isset( $settings['target_date'] ) ? $settings['target_date'] : date( 'Y/m/d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
            'status' => [
                'label'    => ( 'yes' === $settings['count_down_labels'] ),
                'day'      => ( 'yes' === $settings['count_down_days'] ),
                'hour'     => ( 'yes' === $settings['count_down_hours'] ),
                'miniute'   => ( 'yes' === $settings['count_down_miniute'] ),
                'second'    => ( 'yes' === $settings['count_down_second'] ),
                'timecircle'=> ( 'yes' === $settings['count_down_timecircle'] ),
            ],
            'customlabel' => [
                'days' => ! empty( $settings['customlabel_days'] ) ? $settings['customlabel_days'] : esc_html__( 'Days','moveaddons' ),
                'hours' => ! empty( $settings['customlabel_hours'] ) ? $settings['customlabel_hours'] : esc_html__( 'Hours','moveaddons' ),
                'minutes' => ! empty( $settings['customlabel_minutes'] ) ? $settings['customlabel_minutes'] : esc_html__( 'Minutes','moveaddons' ),
                'seconds' => ! empty( $settings['customlabel_seconds'] ) ? $settings['customlabel_seconds'] : esc_html__( 'Seconds','moveaddons' ),
            ],
        ];

        if( $settings['count_down_timecircle'] == 'yes' ){

            $date = isset( $settings['target_date2'] ) ? $settings['target_date2'] : date( 'Y-m-d', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );

            $this->add_render_attribute( 'area_attr', 'data-date', $date.' 00:00:00' );

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-countdown-timer htmove-circle-countdown htmove-circle-countdown-'.$settings['count_style'] );

            $data_options['animation'] = $settings['circle_animation'];
            $data_options['direction'] = $settings['circle_direction'];

            $data_options['use_bg'] = ( 'yes' === $settings['use_background'] );

            $data_options['bg_color'] = !empty( $settings['circle_bg_color'] ) ? $settings['circle_bg_color'] : '#E5E5E5';
            $data_options['day_color'] = !empty( $settings['day_circle_color'] ) ? $settings['day_circle_color'] : '#1D39D7';
            $data_options['hour_color'] = !empty( $settings['hour_circle_color'] ) ? $settings['hour_circle_color'] : '#1D39D7';
            $data_options['minute_color'] = !empty( $settings['minute_circle_color'] ) ? $settings['minute_circle_color'] : '#1D39D7';
            $data_options['second_color'] = !empty( $settings['second_circle_color'] ) ? $settings['second_circle_color'] : '#1D39D7';

            $data_options['fg_width'] = !empty( $settings['fg_width']['size']) ? ( absint( $settings['fg_width']['size'] ) / 100 ) : 0.03;
            $data_options['bg_width'] = !empty($settings['bg_width']['size']) ? ( absint( $settings['bg_width']['size'] ) / 100 ) : 0.6;

        }else{
            if( $settings['count_style'] == 'four' ){
                $this->add_render_attribute( 'area_attr', 'class', 'htmove-countdown-timer htmove-countdown htmove-countdown-one htmove-countdown-'.$settings['count_style'] );
            }else{
                $this->add_render_attribute( 'area_attr', 'class', 'htmove-countdown-timer htmove-countdown htmove-countdown-'.$settings['count_style'] );
            }
        }

        $this->add_render_attribute( 'area_attr', 'data-countdown', wp_json_encode( $data_options ) );

        echo sprintf('<div %1$s></div>', $this->get_render_attribute_string( 'area_attr' ) );

    }

}