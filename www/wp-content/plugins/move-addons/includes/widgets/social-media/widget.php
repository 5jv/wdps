<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Social_Media_Element extends Base {

    public function get_name() {
        return 'move-social-media';
    }

    public function get_title() {
        return esc_html__( 'Social Media', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-social-icons';
    }

    public function get_keywords() {
        return [ 'move', 'social', 'media', 'social media', 'social icon' ];
    }

    public function get_style_depends() {
        return ['move-socialmedia'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Social Media', 'moveaddons' ),
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'social_title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Facebook', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your social media title here', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'social_link',
                [
                    'label' => esc_html__( 'Social Media Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => 'https://facebook.com',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'social_icon',
                [
                    'label' => esc_html__( 'Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'fa4compatibility' => 'socialicon',
                ]
            );

            $repeater->add_control(
                'individual_style',
                [
                    'label' => esc_html__( 'Do you want to individual style ?', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater->start_controls_tabs(
                'icon_individual_style_tab',
                [
                    'condition' => [
                        'individual_style' => 'yes'
                    ],
                ]
            );

                $repeater->start_controls_tab(
                    'icon_individual_style_normal',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'icon_ind_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

                $repeater->start_controls_tab(
                    'icon_individual_style_hover',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'icon_ind_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a:hover svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_hover_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li{{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

            $repeater->end_controls_tabs();

            $this->add_control(
                'social_media_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'social_title' => esc_html__( 'Facebook', 'moveaddons' ),
                            'social_link' => ['url' => 'https://facebook.com/'],
                            'social_icon' =>[
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Instagram', 'moveaddons' ),
                            'social_link' => ['url' => 'https://instagram.com/'],
                            'social_icon' =>[
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Twitter', 'moveaddons' ),
                            'social_link' => ['url' => 'https://twitter.com/'],
                            'social_icon' =>[
                                'value' => 'fab fa-twitter',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Dribbble', 'moveaddons' ),
                            'social_link' => ['url' => 'https://dribbble.com/'],
                            'social_icon' =>[
                                'value' => 'fab fa-dribbble',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Behance', 'moveaddons' ),
                            'social_link' => ['url' => 'https://www.behance.net'],
                            'social_icon' =>[
                                'value' => 'fab fa-behance',
                                'library' => 'solid',
                            ],
                        ]
                    ],
                    'title_field' => '{{{ social_title }}}',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_additional_opt',
            [
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'show_type',
                [
                    'label' => esc_html__( 'Show Type', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'text'  => esc_html__( 'Text', 'moveaddons' ),
                        'icon' => esc_html__( 'Icon', 'moveaddons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
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
                        '{{WRAPPER}} .htmove-social' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

            $this->add_responsive_control(
                'space_between',
                [
                    'label' => esc_html__( 'Space between', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-social li + li' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->start_controls_tabs('social_media_style_tabs');

                // Normal Tab
                $this->start_controls_tab(
                    'social_media_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_responsive_control(
                        'social_width',
                        [
                            'label' => esc_html__( 'Width', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'social_height',
                        [
                            'label' => esc_html__( 'Height', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'social_font_size',
                        [
                            'label' => esc_html__( 'Font Size', 'moveaddons' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-social li a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                            ],
                            'condition'=>[
                                'show_type'=>'icon',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'social_media_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-social li a',
                            'condition'=>[
                                'show_type'=>'text',
                            ],
                        ]
                    );

                    $this->add_control(
                        'social_normal_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-social li a svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'social_normal_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-social li a',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'social_normal_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-social li a',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'social_normal_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-social li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'social_normal_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'social_normal_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Hover Tab
                $this->start_controls_tab(
                    'social_media_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'social_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-social li a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-social li a:hover svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'social_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-social li a:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'social_hover_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-social li a:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'social_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-social li a:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $socialmedia_lists = $this->get_settings_for_display('social_media_list');
        $show_type = $this->get_settings_for_display('show_type');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-social' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-social-show-'.$show_type );

        if( is_array( $socialmedia_lists ) ){
            echo '<ul '.$this->get_render_attribute_string( 'area_attr' ).'>';
                foreach ( $socialmedia_lists as $socialkey => $socialmedia ) {
                    
                    $link = $target = $nofollow = $text = '';
                    if ( ! empty( $socialmedia['social_link']['url'] ) ) {

                        $link = ( $socialmedia['social_link']['url'] ? $socialmedia['social_link']['url'] : '#' );

                        $target = ( $socialmedia['social_link']['is_external'] ? 'target="_blank"' : '' );
                        $nofollow = ( $socialmedia['social_link']['nofollow'] ? 'rel="nofollow"' : '' );
                    }

                    if( $show_type == 'text' ){
                        $text = $socialmedia['social_title'];
                    }else{
                        $text = move_addons_render_icon( $socialmedia,'social_icon', 'socialicon' );
                    }

                    echo sprintf('<li class="elementor-repeater-item-%5$s"><a href="%1$s" %2$s %3$s >%4$s</a></li>', $link, $target, $nofollow, $text, $socialmedia['_id'] );
                }
            echo '</ul>';
        }

    }

}