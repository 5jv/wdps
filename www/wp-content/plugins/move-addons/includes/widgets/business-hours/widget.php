<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Business_Hours_Element extends Base {

    public function get_name() {
        return 'move-business-hours';
    }

    public function get_title() {
        return esc_html__( 'Business Hours', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-clock-o';
    }

    public function get_keywords() {
        return [ 'move', 'business hours', 'business', 'hours','opening hours','opening time' ];
    }

    public function get_style_depends() {
        return ['move-businesshours'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Business Hours', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style One', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                        'three' => esc_html__( 'Style Three', 'moveaddons' ),
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'business_day',
                [
                    'label'   => esc_html__( 'Day', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Monday', 'moveaddons' ),
                ]
            );

            $repeater->add_control(
                'business_time',
                [
                    'label'   => esc_html__( 'Time', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( '9:00 Am to 5:30 Pm', 'moveaddons' ),
                ]
            );

            $repeater->add_control(
                'business_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'businessicon',
                ]
            );

            $repeater->add_control(
                'close_day',
                [
                    'label' => esc_html__( 'Closing Day', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'business_day_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'business_day' => esc_html__( 'Monday', 'moveaddons' ),
                            'business_time' => esc_html__( '9:00 Am to 5:30 Pm','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'no',
                        ],
                        [
                            'business_day' => esc_html__( 'Tuesday', 'moveaddons' ),
                            'business_time' => esc_html__( '9:00 Am to 5:30 Pm','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'no',
                        ],
                        [
                            'business_day' => esc_html__( 'Wednesday', 'moveaddons' ),
                            'business_time' => esc_html__( '9:00 Am to 5:30 Pm','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'no',
                        ],
                        [
                            'business_day' => esc_html__( 'Thursday', 'moveaddons' ),
                            'business_time' => esc_html__( '9:00 Am to 5:30 Pm','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'no',
                        ],
                        [
                            'business_day' => esc_html__( 'Friday', 'moveaddons' ),
                            'business_time' => esc_html__( '9:00 Am to 5:30 Pm','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'no',
                        ],
                        [
                            'business_day' => esc_html__( 'Saturday', 'moveaddons' ),
                            'business_time' => esc_html__( 'Close','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'yes',
                        ],
                        [
                            'business_day' => esc_html__( 'Sunday', 'moveaddons' ),
                            'business_time' => esc_html__( 'Close','moveaddons' ),
                            'business_icon'=>['value'=>'fas fa-plus','library' => 'solid'],
                            'close_day'=>'yes',
                        ],
                    ],
                    'title_field' => '{{{ business_day }}}',
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
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-business-hours',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-business-hours',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-business-hours',
                ]
            );

            $this->add_responsive_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-business-hours' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Item Area Day
        $this->start_controls_section(
            'item_area_style',
            [
                'label' => esc_html__( 'Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'business_day_typography',
                    'label' => esc_html__( 'Day Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'business_time_typography',
                    'label' => esc_html__( 'Time Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-business-hours .htmove-business-hour-day span.htmove-business-hour-time',
                ]
            );

            $this->add_responsive_control(
                'item_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('item_area_style_tabs');

                // Item Normal Style Tab
                $this->start_controls_tab(
                    'item_area_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'item_area_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'item_area_odd_background',
                            'label' => esc_html__( 'Odd Item Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-business-hours .htmove-business-hour-day:nth-child(2n+1)',
                            'fields_options'=>[
                                'background'=>[
                                    'label'=> esc_html__( 'Odd Item Background', 'moveaddons' ),
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'item_area_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day',
                        ]
                    );

                    $this->add_control(
                        'item_text_color',
                        [
                            'label' => esc_html__( 'Text Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day *' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                    $this->add_control(
                        'item_close_text_color',
                        [
                            'label' => esc_html__( 'Close day Text Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day.htmove-business-hour-day-close *' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Item Hover Style Tab
                $this->start_controls_tab(
                    'item_area_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'item_area_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'item_area_hover_odd_background',
                            'label' => esc_html__( 'Odd Item Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-business-hours .htmove-business-hour-day:nth-child(2n+1):hover',
                            'fields_options'=>[
                                'background'=>[
                                    'label'=> esc_html__( 'Odd Item Background', 'moveaddons' ),
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'item_area_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day:hover',
                        ]
                    );

                    $this->add_control(
                        'item_text_hover_color',
                        [
                            'label' => esc_html__( 'Text Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day:hover *' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                    $this->add_control(
                        'item_close_text_hover_color',
                        [
                            'label' => esc_html__( 'Close day Text Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-business-hours li.htmove-business-hour-day.htmove-business-hour-day-close:hover *' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings  = $this->get_settings_for_display();
        $daylist   = $this->get_settings_for_display('business_day_list');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-business-hours htmove-business-hours-'.$settings['layout'] );

        if( is_array( $daylist ) ){
            echo '<ul '.$this->get_render_attribute_string( 'area_attr' ).'>';
                
                foreach ( $daylist as $day ) {

                    $close = ( $day['close_day'] == 'yes' ? 'htmove-business-hour-day-close' : '' );

                    $icon = ( !empty( $day['business_icon']['value'] ) ? move_addons_render_icon( $day, 'business_icon', 'businessicon' ) : '' );

                    $dayname = ( !empty( $day['business_day'] ) ? $day['business_day'] : '' );

                    $time = ( !empty( $day['business_time'] ) ?'<span class="htmove-business-hour-time">'.$day['business_time'].'</span>' : '' );

                    echo sprintf('<li class="htmove-business-hour-day %1$s"><span class="htmove-business-hour-name">%2$s %3$s</span>%4$s</li>',$close, $icon, $dayname, $time  );
                }

            echo '</ul>';
        }

    }

}