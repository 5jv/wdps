<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Video_Element extends Base {

    public function get_name() {
        return 'move-video';
    }

    public function get_title() {
        return esc_html__( 'Video', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-play';
    }

    public function get_keywords() {
        return [ 'move', 'video', 'video player', 'popup' ];
    }

    public function get_style_depends() {
        return ['move-video'];
    }

    public function get_script_depends() {
        return ['magnific-popup','ytplayer','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Video', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'videocontainer',
                [
                    'label' => esc_html__( 'Video Container', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'popup',
                    'options' => [
                        'self'   => esc_html__( 'Self', 'moveaddons' ),
                        'popup'  => esc_html__( 'Pop Up', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'video_url',
                [
                    'label'     => esc_html__( 'Video Url', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'https://www.youtube.com/watch?v=yDAC3JhW4jU', 'moveaddons' ),
                    'placeholder' => esc_html__( 'https://www.youtube.com/watch?v=yDAC3JhW4jU', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'buttontext',
                [
                    'label'     => esc_html__( 'Button Text', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => esc_html__( 'Button Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'buttonicon',
                    'default' => [
                        'value' => 'fas fa-play',
                        'library' => 'solid',
                    ],
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                ]
            );

            $this->add_control(
                'video_image',
                [
                    'label' => esc_html__( 'Cover Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'title',
                [
                    'label'     => esc_html__( 'Title', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'subtitle',
                [
                    'label'     => esc_html__( 'Sub Title', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXTAREA,
                    'condition' =>[
                        'videocontainer' =>'popup',
                    ],
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // Video Options
        $this->start_controls_section(
            'videoplayer_options',
            [
                'label' => esc_html__( 'Video Options', 'moveaddons' ),
                'condition' =>[
                    'videocontainer' =>'self',
                ],
            ]
        );
            $this->add_control(
                'autoplay',
                [
                    'label' => esc_html__( 'Auto Play', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'soundmute',
                [
                    'label' => esc_html__( 'Sound Mute', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'repeatvideo',
                [
                    'label' => esc_html__( 'Repeat Video', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'controlerbutton',
                [
                    'label' => esc_html__( 'Show Controller Button', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'videosourselogo',
                [
                    'label' => esc_html__( 'Show video sourse Logo', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'videostarttime',
                [
                    'label' => esc_html__( 'Video Start Time', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                ]
            );

        $this->end_controls_section();

        // Popup Options
        $this->start_controls_section(
            'popup_options',
            [
                'label' => esc_html__( 'Popup Options', 'moveaddons' ),
                'condition' =>[
                    'videocontainer' =>'popup',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'popup_container_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-video' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'overlay',
                [
                    'label' => esc_html__( 'Overlay', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'overlay_color',
                [
                    'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video::before' => 'background-color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'overlay'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'overlay_opacity',
                [
                    'label' => esc_html__( 'Overlay Opacity', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'condition'=>[
                        'overlay'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video::before' => 'opacity: {{SIZE}};',
                    ],
                ]
            );

            $this->add_control(
                'button_position',
                [
                    'label'   => esc_html__( 'Button Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                        'top'  => esc_html__( 'Top', 'moveaddons' ),
                        'bottom'  => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'subtitle_position',
                [
                    'label'   => esc_html__( 'Subtitle Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'after'   => esc_html__( 'After Title', 'moveaddons' ),
                        'before'   => esc_html__( 'Before Title', 'moveaddons' ),
                    ],
                    'condition' => [
                        'subtitle!' => '',
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
                'condition' =>[
                    'videocontainer' =>'popup',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'contentalign',
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video .htmove-video-content' => 'align-items: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-content-align-%s',
                ]
            );

        $this->end_controls_section();

        // Title tab section
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'title!'=>''
                ],
            ]
        );
            
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-video-content .htmove-video-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Sub Title tab section
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'subtitle!'=>''
                ],
            ]
        );
            
            $this->add_control(
                'subtitle_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-sub-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'subtitle_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-video-content .htmove-video-sub-title',
                ]
            );

            $this->add_responsive_control(
                'subtitle_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'subtitle_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-video-content .htmove-video-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-video .htmove-video-popup' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-video .htmove-video-popup svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-video .htmove-video-popup' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-video .htmove-video-popup::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-video .htmove-video-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                '{{WRAPPER}} .htmove-video .htmove-video-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_width',
                        [
                            'label' => esc_html__( 'Button Width', 'moveaddons' ),
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
                                '{{WRAPPER}} .htmove-video .htmove-video-popup'  => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                            ],
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
                                '{{WRAPPER}} .htmove-video .htmove-video-popup'  => 'height: {{SIZE}}{{UNIT}};',
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
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-video .htmove-video-popup:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-video .htmove-video-popup:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup:hover',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'boxhover_shadow',
                            'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-video .htmove-video-popup:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-video-area' );

        if( $settings['overlay'] == 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-video-overlay' );
        }

        if( $settings['videocontainer'] != 'self' ){

            $this->add_render_attribute( 'area_attr', 'class', 'htmove-video htmove-video' );

            if( !empty( $settings['video_image']['url'] ) ){
                $this->add_render_attribute( 'area_attr', 'style', 'background-image:url('.$settings['video_image']['url'].')' );
            }

            $button = '';
            if( !empty( $settings['button_icon']['value'] ) ){
                $this->add_render_attribute( 'area_attr', 'class', 'htmove-button-position-'.$settings['button_position'] );
                $button = move_addons_render_icon( $settings, 'button_icon', 'buttonicon' );
            }

            $title = ( !empty( $settings['title'] ) ? '<h2 class="htmove-video-title">'.$settings['title'].'</h2>' : '' );
            $subtitle = ( !empty( $settings['subtitle'] ) ? '<span class="htmove-video-sub-title">'.$settings['subtitle'].'</span>' : '' );

        }

        if( $settings['videocontainer'] == 'self' ){

            $player_options_settings = [
                'videoURL'          => !empty( $settings['video_url'] ) ? $settings['video_url'] : 'https://www.youtube.com/watch?v=CDilI6jcpP4',
                'coverImage'        => !empty( $settings['video_image']['url'] ) ? $settings['video_image']['url'] : '',
                'autoPlay'          => ( 'yes' === $settings['autoplay'] ),
                'mute'              => ( 'yes' === $settings['soundmute'] ),
                'loop'              => ( 'yes' === $settings['repeatvideo'] ),
                'showControls'      => ( 'yes' === $settings['controlerbutton'] ),
                'showYTLogo'        => ( 'yes' === $settings['videosourselogo'] ),
                'startAt'           => $settings['videostarttime'],
                'containment'       => 'self',
                'opacity'           => 1,
                'optimizeDisplay'   => true,
                'realfullscreen'    => true,
            ];
        }

        $videocontainer = [
            'videocontainer' => isset( $settings['videocontainer'] ) ? $settings['videocontainer'] : '',
        ];
        $this->add_render_attribute( 'area_attr', 'data-videotype', wp_json_encode( $videocontainer ) );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

            <?php if( $settings['videocontainer'] == 'self' ): ?>
                <div class="htmove-video-player" data-property=<?php echo wp_json_encode( $player_options_settings );?> ></div>
            <?php else: ?>
                <div class="htmove-video-content">
                    <?php
                        if( !empty( $settings['buttontext'] ) ){
                            echo sprintf('<a href="%1$s" class="%2$s">%3$s</a>',$settings['video_url'],'htmove-video-btn htmove-video-popup',$button.$settings['buttontext'] );
                        }else{
                            echo sprintf('<a href="%1$s" class="%2$s">%3$s</a>',$settings['video_url'],'htmove-video-popup-btn htmove-video-popup',$button);
                        }
                    
                        if( !empty($settings['title']) || !empty( $settings['subtitle'] ) ){
                            if( $settings['subtitle_position'] == 'after' ){
                                echo sprintf('<div class="htmove-video-text">%1$s %2$s</div>',$title,$subtitle );
                            }else{
                                echo sprintf('<div class="htmove-video-text">%1$s %2$s</div>',$subtitle,$title );
                            }
                        }
                    ?>
                </div>
            <?php endif;?>

        </div>
        <?php

    }

}