<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Off_Canvas_Element extends Base {

    public function get_name() {
        return 'move-off-canvas';
    }

    public function get_title() {
        return esc_html__( 'Off Canvas', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-menu-bar';
    }

    public function get_keywords() {
        return [ 'move', 'canvas', 'off', 'off canvas' ];
    }

    public function get_style_depends() {
        return ['move-offcanvas'];
    }

    public function get_script_depends() {
        return [  ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Off Canvas', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'content_source',
                [
                    'label'   => esc_html__( 'Select Source', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default' => 'sidebar',
                    'options' => [
                        'sidebar'   => esc_html__( 'Sidebar', 'moveaddons' ),
                        'elementor' => esc_html__( 'Elementor Template', 'moveaddons' ),
                    ],          
                ]
            );

            $this->add_control(
                'template_id',
                [
                    'label'       => esc_html__( 'Select Template', 'moveaddons' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default'     => '0',
                    'options'     => move_addons_elementor_template(),
                    'condition'   => [
                        'content_source' => "elementor"
                    ],
                ]
            );

            $this->add_control(
                'sidebars_id',
                [
                    'label'       => esc_html__( 'Select Sidebar', 'moveaddons' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => '0',
                    'options'     => move_addons_get_sidebar(),
                    'label_block' => 'true',
                    'condition'   => [
                        'content_source' => 'sidebar'
                    ],
                ]
            );

            $this->add_control(
                'position',
                [
                    'label'   => esc_html__( 'Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right' => esc_html__( 'Right', 'moveaddons' ),
                        'top' => esc_html__( 'Top', 'moveaddons' ),
                        'bottom' => esc_html__( 'Bottom', 'moveaddons' ),
                    ],          
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'offcanvas_button',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Off canvas', 'moveaddons' ),
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

        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'button_style_tab',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'btn_align',
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
                        '{{WRAPPER}} .htmove-offcanvas-single-btn' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->start_controls_tabs('button_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-offcanvas-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-offcanvas-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-offcanvas-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .htmove-offcanvas-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_height',
                        [
                            'label' => esc_html__( 'Button Height', 'moveaddons' ),
                            'type'  => Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .htmove-offcanvas-btn'  => 'height: {{SIZE}}{{UNIT}};',
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
                        'buttonhover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-offcanvas-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'boxhover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-offcanvas-btn:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Area Style tab section
        $this->start_controls_section(
            'content_area_style',
            [
                'label' => esc_html__( 'Off Canvas Content Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'offcanvas_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-offcanvas-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'offcanvas_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-offcanvas-inner',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();

        $this->add_render_attribute( 'btn_attr', 'class', 'htmove-offcanvas-single-btn' );

        $button_icon = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $this->add_render_attribute( 'btn_attr', 'class', 'htmove-button-icon-'.$settings['button_icon_align'] );

            $button_icon = '<span class="htmove-btn-cion">'.move_addons_render_icon( $settings, 'button_icon', 'icon' ).'</span>';
        }

        $button_text  = ! empty( $settings['button_text'] ) ? '<span class="htmove-btn-text">'.$settings['button_text'].'</span>' : '';

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'btn_attr' ); ?> >
                <a href="#" class="htmove-offcanvas-btn" data-target="#htmove-offcanvas-<?php echo $id; ?>"><?php echo sprintf('%1$s %2$s',$button_text, $button_icon);?></a>
            </div>

            <div class="htmove-offcanvas-overlay"></div>
            <div id="htmove-offcanvas-<?php echo $id; ?>" class="htmove-offcanvas-<?php echo $settings['position']; ?>">
                <div class="htmove-offcanvas-inner">
                    <?php
                        if ( $settings['content_source'] == 'sidebar' ) {
                            if( !empty( $settings['sidebars_id'] ) ){
                                dynamic_sidebar( $settings['sidebars_id'] );
                            }
                        } else{
                            if( !empty( $settings['template_id'] ) ){
                                echo move_addons_get_elementor()->frontend->get_builder_content_for_display( $settings['template_id'] );
                            }
                        }
                    ?>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    'use strict';
                    var offCanvasFunction = function() {
                        var offCanvasOverlay = $('.htmove-offcanvas-overlay'),
                            offCanvasTarget;
                        $('body').on('click', '.htmove-offcanvas-btn', function(e) {
                            e.preventDefault();
                            var $this = $(this);
                            offCanvasTarget = $this.data('target');
                            offCanvasOverlay.addClass('active');
                            $(offCanvasTarget).addClass('open');
                        });
                        $('body').on('click', '.htmove-offcanvas-overlay', function() {
                            offCanvasOverlay.removeClass('active');
                            $(offCanvasTarget).removeClass('open');
                        });
                    }
                    offCanvasFunction();
                });
            </script>
        <?php

    }

}