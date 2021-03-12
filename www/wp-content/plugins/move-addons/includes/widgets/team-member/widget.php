<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team_Member_Element extends Base {

    public function get_name() {
        return 'move-team-member';
    }

    public function get_title() {
        return esc_html__( 'Team Member', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-person';
    }

    public function get_keywords() {
        return [ 'move', 'team member', 'member', 'team', 'our team' ];
    }

    public function get_style_depends() {
        return [ 'elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','move-team' ];
    }

    public function get_script_depends() {
        return [ 'swiper', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'team_content',
            [
                'label' => esc_html__( 'Team', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'team_style',
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
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'member_image',
                [
                    'label' => esc_html__( 'Member image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'team_style!' => 'four',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'member_imagesize',
                    'default' => 'thumbnail',
                    'separator' => 'none',
                    'condition' => [
                        'team_style!' => 'four',
                    ],
                ]
            );

            $this->add_control(
                'member_name',
                [
                    'label' => esc_html__( 'Name', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Tony Bridges', 'moveaddons' ),
                    'separator' => 'before',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Tony Bridges', 'moveaddons' ),
                    'label_block'=>true,
                    'condition' => [
                        'team_style!' => 'four',
                    ],
                ]
            );

            $this->add_control(
                'member_designation',
                [
                    'label' => esc_html__( 'Designation', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Co-founder & CEO', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Co-founder & CEO', 'moveaddons' ),
                    'label_block'=>true,
                    'condition' => [
                        'team_style!' => 'four',
                    ],
                ]
            );

            $this->add_control(
                'member_bioinfo',
                [
                    'label' => esc_html__( 'Bio Info', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => esc_html__( 'I am web developer.', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'team_style!' => 'four',
                    ],
                ]
            );

            // For style Four
            $teamrepeater = new \Elementor\Repeater();

            $teamrepeater->add_control(
                'image',
                [
                    'label' => esc_html__( 'Member image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $teamrepeater->add_control(
                'name',
                [
                    'label' => esc_html__( 'Name', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Tony Bridges', 'moveaddons' ),
                    'separator' => 'before',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Tony Bridges', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $teamrepeater->add_control(
                'designation',
                [
                    'label' => esc_html__( 'Designation', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Co-founder & CEO', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Co-founder & CEO', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $teamrepeater->add_control(
                'bioinfo',
                [
                    'label' => esc_html__( 'Bio Info', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => esc_html__( 'I am web developer.', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );

            $teamrepeater->add_control(
                'social_media_icon',
                [
                    'label' => esc_html__( 'Social Media Name', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'description' => esc_html__( 'Enter Name separate by new line', 'moveaddons' ),
                ]
            );

            $teamrepeater->add_control(
                'social_media_link',
                [
                    'label' => esc_html__( 'Social Media Link', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'description' => esc_html__( 'Enter Link separate by new line', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'team_list',
                [
                    'label' => esc_html__( 'Team Member', 'moveaddons' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields'  => $teamrepeater->get_controls(),
                    'condition' => [
                        'team_style' => 'four',
                    ],
                    'default' => [
                        [
                            'name' => esc_html__( 'Tony Bridges', 'moveaddons' ),
                            'designation' => esc_html__( 'Co-founder & CEO', 'moveaddons' ),
                            'bioinfo' => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem.', 'moveaddons' ),
                        ]

                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'imagesize',
                    'default' => 'full',
                    'separator' => 'none',
                    'condition' => [
                        'team_style' => 'four',
                    ],
                    'fields_options'=>[
                        'size'=>[
                            'label'=> esc_html__( 'Slider Image Size', 'moveaddons' ),
                        ],
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbimagesize',
                    'default' => 'thumbnail',
                    'separator' => 'none',
                    'condition' => [
                        'team_style' => 'four',
                    ],
                    'fields_options'=>[
                        'size'=>[
                            'label'=> esc_html__( 'Thumbnail Size', 'moveaddons' ),
                        ],
                    ],
                ]
            );


        $this->end_controls_section();

        // Social Profile tab
        $this->start_controls_section(
            'team_member_social_link',
            [
                'label' => esc_html__( 'Social Profiles', 'moveaddons' ),
                'condition' => [
                    'team_style!' => 'four',
                ],
            ]
        );
            
            $this->add_control(
                'show_profile_link',
                [
                    'label' => esc_html__( 'Show Profile Link', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'after',
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'social_title',
                [
                    'label'   => esc_html__( 'Title', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => 'Facebook',
                ]
            );

            $repeater->add_control(
                'social_link',
                [
                    'label' => __( 'Link', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'Enter your profile link', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'social_icon',
                [
                    'label'   => esc_html__( 'Icon', 'moveaddons' ),
                    'type'    => Controls_Manager::ICONS,
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
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}} svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
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
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}}:hover svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'icon_ind_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social > {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

            $repeater->end_controls_tabs();

            $this->add_control(
                'social_profile_list',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'social_title' => esc_html__( 'Facebook', 'moveaddons' ),
                            'social_link' => [ 
                                'url' => 'https://facebook.com/' 
                            ],
                            'social_icon' =>[
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Instagram','moveaddons' ),
                            'social_link' => [ 
                                'url' => 'https://instagram.com/'
                            ],
                            'social_icon' =>[
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                        ],
                        [
                            'social_title' => esc_html__( 'Twitter','moveaddons' ),
                            'social_link' => [ 
                                'url' => 'https://twitter.com/'
                            ],
                            'social_icon' =>[
                                'value' => 'fab fa-twitter',
                                'library' => 'solid',
                            ],
                        ]

                    ],
                    'title_field' => '{{{ social_title }}}',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'team_style_section',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style!'=>'four',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'team_member_area_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'team_member_bg_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'fields_options'=>[
                        'background'=>[
                            'label'=> esc_html__( 'Area Background', 'moveaddons' ),
                        ],
                    ],
                    'selector' => '{{WRAPPER}} .htmove-team',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'team_member_overlay_background',
                    'label' => esc_html__( 'Overlay Color', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'condition'=>[ 
                        'team_style'=> ['two','five','nine','ten'],
                    ],
                    'fields_options'=>[
                        'background'=>[
                            'label'=> esc_html__( 'Overlay Background Type', 'moveaddons' ),
                        ],
                    ],
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-image .htmove-team-overlay',
                ]
            );

        $this->end_controls_section();

        // Image Style tab section
        $this->start_controls_section(
            'team_image_style_section',
            [
                'label' => esc_html__( 'Image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style!'=>'four',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'team_member_image_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_image_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'team_member_image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-image',
                ]
            );

            $this->add_responsive_control(
                'team_member_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'shape_1',
                [
                    'label' => esc_html__( 'Shape One', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition' => [
                        'team_style' => 'three',
                    ],
                ]
            );

            $this->add_control(
                'shape_2',
                [
                    'label' => esc_html__( 'Shape Two', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition' => [
                        'team_style' => 'three',
                    ],
                ]
            );

            $this->add_control(
                'shape_3',
                [
                    'label' => esc_html__( 'Shape Three', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition' => [
                        'team_style' => 'three',
                    ],
                ]
            );

        $this->end_controls_section();

        // Team Member Name style tab start
        $this->start_controls_section(
            'team_member_name_style',
            [
                'label'     => esc_html__( 'Name', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'member_name!' => '',
                    'team_style!' => 'four',
                ],
            ]
        );

            $this->add_control(
                'team_name_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_name_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-name',
                ]
            );

            $this->add_responsive_control(
                'team_name_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_name_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_name_align',
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
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-name' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

        $this->end_controls_section(); // Team Member Name style tab end

        // Team Member Slider Name style tab start
        $this->start_controls_section(
            'team4_member_name_style',
            [
                'label'     => esc_html__( 'Name', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style' => 'four',
                ],
            ]
        );

            $this->add_control(
                'team4_name_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team4_name_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-name',
                ]
            );

            $this->add_responsive_control(
                'team4_name_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team4_name_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Team Member Slider Name style tab end

        // Team Member Designation style tab start
        $this->start_controls_section(
            'team_member_designation_style',
            [
                'label'     => esc_html__( 'Designation', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'member_designation!' => '',
                    'team_style!' => 'four',
                ],
            ]
        );

            $this->add_control(
                'team_designation_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-designation' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_designation_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-designation',
                ]
            );

            $this->add_responsive_control(
                'team_designation_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_designation_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_designation_align',
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
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-designation' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

        $this->end_controls_section(); // Team Member Designation style tab end

        // Team Member Slider Designation style tab start
        $this->start_controls_section(
            'team4_member_designation_style',
            [
                'label'     => esc_html__( 'Designation', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style' => 'four',
                ],
            ]
        );

            $this->add_control(
                'team4_designation_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-designation' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team4_designation_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-designation',
                ]
            );

            $this->add_responsive_control(
                'team4_designation_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team4_designation_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Team Member Slider Designation style tab end

        // Team Member Bio style tab start
        $this->start_controls_section(
            'team_member_bio_style',
            [
                'label'     => esc_html__( 'Bio', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'member_bioinfo!' => '',
                    'team_style!'=>'four',
                ],
            ]
        );

            $this->add_control(
                'team_bio_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-bio' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_bio_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-bio',
                ]
            );

            $this->add_responsive_control(
                'team_bio_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_bio_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-bio' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team_bio_align',
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
                        '{{WRAPPER}} .htmove-team .htmove-team-inner .htmove-team-info .htmove-team-bio' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

        $this->end_controls_section(); // Team Member Designation style tab end

        // Team Member Slider Bio style tab start
        $this->start_controls_section(
            'team4_member_bio_style',
            [
                'label'     => esc_html__( 'Bio', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style'=>'four',
                ],
            ]
        );

            $this->add_control(
                'team4_bio_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-info .htmove-team-bio' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-team .htmove-team-bio p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team4_bio_typography',
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htmove-team .htmove-team-bio, {{WRAPPER}} .htmove-team .htmove-team-bio p',
                ]
            );

            $this->add_responsive_control(
                'team4_bio_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team4_bio_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-team .htmove-team-bio' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'team4_bio_align',
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
                        '{{WRAPPER}} .htmove-team .htmove-team-bio' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

        $this->end_controls_section(); // Team Member Slider Designation style tab end

        // Team Member Social Profile style tab start
        $this->start_controls_section(
            'team_member_social_profile_style',
            [
                'label'     => esc_html__( 'Social Profile', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_profile_link' => 'yes',
                    'team_style!'=>'four',
                ],
            ]
        );
            
            $this->start_controls_tabs('social_profile_style_tabs');

                // Normal Tab
                $this->start_controls_tab(
                    'social_profile_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'icon_normal_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social a' => 'color: {{VALUE}} !important',
                                '{{WRAPPER}} .htmove-team-social a svg *' => 'stroke: {{VALUE}} !important;fill:{{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_normal_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social a' => 'background-color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab
                $this->start_controls_tab(
                    'social_profile_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'icon_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social a:hover' => 'color: {{VALUE}} !important',
                                '{{WRAPPER}} .htmove-team-social a:hover svg *' => 'stroke: {{VALUE}} !important;fill:{{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team-social a:hover' => 'background-color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Team Member Social Profile style tab end

        // Team Member Slider Social Profile style tab start
        $this->start_controls_section(
            'team4_member_social_profile_style',
            [
                'label'     => esc_html__( 'Social Profile', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style'=>'four',
                ],
            ]
        );
            
            $this->start_controls_tabs('social4_profile_style_tabs');

                // Normal Tab
                $this->start_controls_tab(
                    'social4_profile_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'icon4_normal_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team4-social a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-team4-social a svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon4_normal_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team4-social a' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab
                $this->start_controls_tab(
                    'social4_profile_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'icon4_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team4-social a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-team4-social a:hover svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon4_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-team4-social a:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Team Member Social Profile style tab end


    }

    protected function render( $instance = [] ) {
        
        $settings   = $this->get_settings_for_display();
        $profiles   = $this->get_settings_for_display('social_profile_list');
        $team_list  = $this->get_settings_for_display('team_list');
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-team' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-team-'.$settings['team_style'] );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <?php if( $settings['team_style'] != 'four' ): ?>
                    <div class="htmove-team-inner">
                        <?php 
                            if( $settings['team_style'] == 'three' ){
                                if( $settings['shape_1']['id'] != '' ){
                                    echo '<div class="htmove-team-shape-1">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'shape_1' ).'</div>';
                                }
                                if( $settings['shape_2']['id'] != '' ){
                                    echo '<div class="htmove-team-shape-2">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'shape_2' ).'</div>';
                                }
                                if( $settings['shape_3']['id'] != '' ){
                                    echo '<div class="htmove-team-shape-3">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'shape_3' ).'</div>';
                                }
                            }
                        ?>
                        <div class="htmove-team-image">
                            <span class="htmove-team-overlay"></span>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'member_imagesize', 'member_image' ); ?>

                            <?php 
                                if( is_array( $profiles ) && $settings['show_profile_link'] === 'yes' ){
                                    echo '<div class="htmove-team-social">';
                                        foreach ( $profiles as $profile ) {
                                            echo sprintf('<a class="elementor-repeater-item-%1$s" href="'.esc_url( $profile['social_link']['url']).'">%2$s</a>', $profile['_id'], move_addons_render_icon( $profile, 'social_icon', 'socialicon' )  );
                                        }
                                    echo '</div>';
                                }
                            ?>
                        </div>

                        <div class="htmove-team-info">
                            <?php
                                if( !empty( $settings['member_name'] ) ){
                                    echo '<h6 class="htmove-team-name">'.esc_html( $settings['member_name'] ).'</h6>';
                                }
                                if( !empty( $settings['member_designation'] ) ){
                                    echo '<span class="htmove-team-designation">'.esc_html( $settings['member_designation'] ).'</span>';
                                }
                                if( !empty( $settings['member_bioinfo'] ) ){
                                    echo '<p class="htmove-team-bio">'.$settings['member_bioinfo'].'</p>';
                                }
                            ?>
                        </div>

                    </div>
                <?php endif; ?>

                <?php 
                    if( $settings['team_style'] == 'four' ):

                        $size = $settings['thumbimagesize_size'];
                        $thumbnails_size = Null;
                        if( $size === 'custom' ){
                            $thumbnails_size = [
                                $settings['thumbimagesize_custom_dimension']['width'],
                                $settings['thumbimagesize_custom_dimension']['height']
                            ];
                        }else{
                            $thumbnails_size = $size;
                        }
                ?>
                    <div class="htmove-team4-image-slider htmove-team-image-slider-<?php echo $id; ?>">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <?php 
                                    if( is_array( $team_list ) ){
                                        foreach ( $team_list as $team ) {

                                            $thumbimg[] = wp_get_attachment_image( $team['image']['id'], $thumbnails_size );

                                            ?>
                                                <div class="swiper-slide">
                                                    <div class="htmove-team4-image">
                                                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $team, 'imagesize', 'image' ); ?>
                                                    </div>
                                                </div>
                                            <?php
                                        }

                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="htmove-team4-content-slider htmove-team-content-slider-<?php echo $id; ?>">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                            <?php
                                if( is_array( $team_list ) ){
                                    foreach ( $team_list as $teamcontent ) {

                                        $social_profile_link = explode( "\n", $teamcontent['social_media_link'] );
                                        $social_profile_icon = explode( "\n", $teamcontent['social_media_icon'] );

                                        ?>
                                            <div class="swiper-slide">
                                                <div class="htmove-team4-content">
                                                    <div class="htmove-team-content-head">
                                                        <div class="htmove-team-info">
                                                            <h2 class="htmove-team-name"><?php echo esc_html( $teamcontent['name'] );?></h2>
                                                            <span class="htmove-team-designation"><?php echo esc_html( $teamcontent['designation'] );?></span>
                                                        </div>
                                                        <?php 
                                                            if( is_array( $social_profile_link ) && is_array( $social_profile_icon ) ){
                                                                echo '<div class="htmove-team4-social">';
                                                                foreach ( $social_profile_link as $key => $link ) {
                                                                    if( array_key_exists( $key, $social_profile_icon ) ){
                                                                        echo '<a href="'.$link.'"><i class="'.strtolower( $social_profile_icon[$key] ).'"></i></a>';
                                                                    }
                                                                }
                                                                echo '</div>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="htmove-team-bio">
                                                        <?php echo $teamcontent['bioinfo'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                <?php endif; ?>

                <?php if( $settings['team_style'] == 'four' ): ?>
                    <script type="text/javascript">
                        ;jQuery(document).ready(function($) {
                            'use strict';

                            var thumbimg = <?php echo json_encode( $thumbimg ); ?>;

                            var teamFourImage = new Swiper('.htmove-team-image-slider-<?php echo $id; ?> .swiper-container', {
                                loop: true,
                                spaceBetween: 0,
                                slidesPerView: 1,
                                loopedSlides: 2,
                                watchSlidesProgress: true,
                                allowTouchMove: false,
                            });
                            var teamFourContent = new Swiper('.htmove-team-content-slider-<?php echo $id; ?> .swiper-container', {
                                loop: true,
                                spaceBetween: 0,
                                slidesPerView: 1,
                                loopedSlides: 2,
                                pagination: {
                                    el: '.htmove-team-content-slider-<?php echo $id; ?> .swiper-pagination',
                                    clickable: true,
                                    renderBullet: function(index, className) {
                                        return '<span class="' + className + '">'+thumbimg[index]+'</span>';
                                    }
                                },
                                thumbs: {
                                    swiper: teamFourImage
                                }
                            });
                        });
                    </script>
                <?php endif; ?>

            </div>
        <?php

    }

}