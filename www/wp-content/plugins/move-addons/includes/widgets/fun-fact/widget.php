<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Fun_Fact_Element extends Base {

    public function get_name() {
        return 'move-fun-fact';
    }

    public function get_title() {
        return esc_html__( 'Fun Fact', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-number-field';
    }

    public function get_keywords() {
        return [ 'move', 'fun fact', 'counterup', 'counter' ];
    }

    public function get_style_depends() {
        return ['move-funfact'];
    }

    public function get_script_depends() {
        return ['waypoints','counterup','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Fun Fact', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'counter_icon',
                [
                    'label' => esc_html__( 'Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'countericon',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'counter_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                        'top'    => esc_html__( 'Top', 'moveaddons' ),
                        'bottom' => esc_html__( 'Bottom', 'moveaddons' ),
                        'beforenumber' => esc_html__( 'Before Number', 'moveaddons' ),
                        'afternumber' => esc_html__( 'After Number', 'moveaddons' ),
                    ],
                    'condition' => [
                        'counter_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'counter_title',
                [
                    'label' => esc_html__( 'Counter Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Creative Designers', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your title here', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'terget_number',
                [
                    'label' => esc_html__( 'Target Number', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 500,
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Item Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'counter_content_align',
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
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-info' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'counter_area_width',
                [
                    'label' => esc_html__( 'Width', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1500,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact' => 'width: {{SIZE}}{{UNIT}};margin: auto;',
                    ],
                ]
            );

            $this->add_control(
                'counter_area_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1500,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact' => 'height: {{SIZE}}{{UNIT}};display: flex;justify-content: center;align-items: center;flex-flow:column;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'counter_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->start_controls_tabs('item_area_style_tabs');

                $this->start_controls_tab(
                    'item_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'counter_area_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-funfact',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'counter_area_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-funfact',
                        ]
                    );

                    $this->add_responsive_control(
                        'counter_area_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-funfact' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'counter_content_color',
                        [
                            'label' => esc_html__( 'Content Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-funfact *' => 'color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'item_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'counter_area_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-funfact:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'counter_area_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-funfact:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'counter_area_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-funfact:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'counter_content_hover_color',
                        [
                            'label' => esc_html__( 'Content Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-funfact:hover *' => 'color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Number tab section
        $this->start_controls_section(
            'counter_number_style_section',
            [
                'label' => esc_html__( 'Number', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'terget_number!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'counter_number_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_number_typography',
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_number_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter',
                ]
            );

            $this->add_responsive_control(
                'counter_number_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_number_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'counter_number_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter',
                ]
            );

            $this->add_responsive_control(
                'counter_number_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-number .htmove-funfact-counter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'counter_title_style_section',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_title!'=>'',
                ]
            ]
        );
            $this->add_control(
                'counter_title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_title_typography',
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-title',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_title_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-title',
                ]
            );

            $this->add_responsive_control(
                'counter_title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'counter_title_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-title',
                ]
            );

            $this->add_responsive_control(
                'counter_title_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Icon tab section
        $this->start_controls_section(
            'counter_icon_style_section',
            [
                'label' => esc_html__( 'Icon', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'counter_icon[value]!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'counter_icon_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'counter_icon_size',
                [
                    'label' => esc_html__( 'Size', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_icon_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'counter_icon_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon',
                ]
            );

            $this->add_responsive_control(
                'counter_icon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-funfact .htmove-funfact-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-funfact' );

        $counter_icon = '';
        if( !empty( $settings['counter_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-counter-icon-'.$settings['counter_icon_align'] );

            $counter_icon = '<span class="htmove-funfact-icon">'.move_addons_render_icon( $settings, 'counter_icon', 'countericon' ).'</span>';
        }

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php 
                    if( $settings['counter_icon_align'] == 'top' || $settings['counter_icon_align'] == 'bottom' || $settings['counter_icon_align'] == 'right' || $settings['counter_icon_align'] == 'left' ){
                        echo $counter_icon;
                    }
                ?>
                <div class="htmove-funfact-info">
                    <?php
                        echo '<div class="htmove-funfact-top">';
                            if( $settings['counter_icon_align'] == 'beforenumber' || $settings['counter_icon_align'] == 'afternumber'){
                                echo $counter_icon;
                            }
                            if( !empty( $settings['terget_number'] ) ){
                                echo '<h2 class="htmove-funfact-number"><span class="htmove-funfact-counter">'.esc_attr__( $settings['terget_number'] ).'</span></h2>';
                            }
                        echo '</div>';

                        if( !empty( $settings['counter_title'] ) ){
                            echo '<h6 class="htmove-funfact-title">'.esc_html__($settings['counter_title'],'moveaddons').'</h6>';
                        }
                    ?>
                </div>
            </div>
        <?php

    }

}