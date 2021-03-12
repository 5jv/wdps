<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Inline_Menu_Element extends Base {

    public function get_name() {
        return 'move-inline-menu';
    }

    public function get_title() {
        return esc_html__( 'Inline Menu', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-nav-menu';
    }

    public function get_keywords() {
        return [ 'move', 'menu', 'inline menu', 'inline navigation' ];
    }

    public function get_style_depends() {
        return ['move-inlinemenu'];
    }

    public function get_script_depends() {
        return ['move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Inline Menu', 'moveaddons' ),
            ]
        );
            
            if ( ! empty( move_addons_get_available_menus() ) ) {

                $this->add_control(
                    'menu_style',
                    [
                        'label' => esc_html__( 'Style', 'moveaddons' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'one',
                        'options' => [
                            'one'  => esc_html__( 'Style One', 'moveaddons' ),
                            'two'  => esc_html__( 'Style Two', 'moveaddons' ),
                        ],
                    ]
                );

                $this->add_control(
                    'inline_menu_slug',
                    [
                        'label'   => esc_html__( 'Menu', 'moveaddons' ),
                        'type'    => Controls_Manager::SELECT,
                        'options' => move_addons_get_available_menus(),
                        'default' => array_keys( move_addons_get_available_menus() )[0],
                        'save_default' => true,
                        'separator' => 'after',
                        'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus Option</a> to manage your menus.', 'moveaddons' ), admin_url( 'nav-menus.php' ) ),
                    ]
                );
            } else {
                $this->add_control(
                    'inline_menu_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus Option</a> to create one.', 'moveaddons' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                        'separator' => 'after',
                    ]
                );
            }

        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'additional_option_section',
            [
                'label' => esc_html__( 'Addintional Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'mobile_menu',
                [
                    'label' => esc_html__( 'Mobile Menu Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Menu', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'mobile_menu_toggler_icon',
                [
                    'label' => esc_html__( 'Mobile Menu Toggler Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-bars',
                        'library' => 'solid',
                    ],
                    'fa4compatibility' => 'mobile_menu_togglericon',
                ]
            );

            $this->add_control(
                'add_custom_menuicon',
                [
                    'label' => esc_html__( 'Custom Menu Icon', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'icon_pos',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                        'top'    => esc_html__( 'Top', 'moveaddons' ),
                        'bottom' => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition' => [
                        'add_custom_menuicon' => 'yes',
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
                        'add_custom_menuicon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu.htmove-menu-icon-pos-right > .htmove-inline-menu-list > li > a span.htmove-inline-menu-icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-inline-menu.htmove-menu-icon-pos-left > .htmove-inline-menu-list > li > a span.htmove-inline-menu-icon'   => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-inline-menu.htmove-menu-icon-pos-top > .htmove-inline-menu-list > li > a span.htmove-inline-menu-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-inline-menu.htmove-menu-icon-pos-bottom > .htmove-inline-menu-list > li > a span.htmove-inline-menu-icon'   => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'menu_item',
                [
                    'label' => esc_html__( 'Menu items ID', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );

            $repeater->add_control(
                'custom_menu_icon',
                [
                    'label' => esc_html__( 'Custom Menu Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-shopping-cart',
                        'library' => 'solid',
                    ],
                    'fa4compatibility' => 'custom_menuicon',
                ]
            );

            $this->add_control(
                'custom_icon_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'select_menu' => '',
                        ]
                    ],
                    'title_field' => '{{{ menu_item }}}',
                    'condition' => [
                        'add_custom_menuicon' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'area_style',
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
                    'selector' => '{{WRAPPER}} .htmove-inline-menu',
                ]
            );

            $this->add_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-inline-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-inline-menu',
                ]
            );

            $this->add_responsive_control(
                'area_alignment',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list'   => 'justify-content: {{VALUE}};',
                    ],
                    'prefix_class'=>'htmove-menu-align-%s',
                ]
            );

        $this->end_controls_section();

        // Menu Item Style tab section
        $this->start_controls_section(
            'menu_item_style_section',
            [
                'label' => esc_html__( 'Menu Item', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'menu_item_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li > a',
                ]
            );

            $this->add_control(
                'menu_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'menu_item_space',
                [
                    'label' => esc_html__( 'Space', 'moveaddons' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li + li' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Menu Style Normal Tabs Start
            $this->start_controls_tabs( 'menu_style_tabs' );
                
                // Menu Style Normal Tab Start
                $this->start_controls_tab(
                    'menu_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'menu_normal_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li > a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Menu Style Hover Tab Start
                $this->start_controls_tab(
                    'menu_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'menu_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li:hover > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li.current-menu-item > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li > a::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-inline-menu > .htmove-inline-menu-list > li.current-menu-item > a:before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Mobile Menu Toggler Style tab section
        $this->start_controls_section(
            'mobile_menu_toggler_style',
            [
                'label' => esc_html__( 'Mobile Menu Toggler', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'mobile_menu_icon_color',
                [
                    'label'     => esc_html__( 'Icon Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu .htmove-inline-menu-head .htmove-inline-menu-toggle' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-close::before,{{WRAPPER}} .htmove-close::after' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'mobile_menu_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-inline-menu .htmove-inline-menu-head .htmove-inline-menu-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-inline-menu htmove-inline-menu-'.$settings['menu_style'] );

        // Mobile Menu Toggler
        $mobile_text = ( !empty( $settings['mobile_menu'] ) ? '<h3 class="htmove-inline-menu-title">'.$settings['mobile_menu'].'</h2>' : '' );
        if( !empty( $settings['mobile_menu_toggler_icon']['value'] ) ){
            $mobile_icon = move_addons_render_icon( $settings, 'mobile_menu_toggler_icon', 'mobile_menu_togglericon' );
        }

        // Custom Title and Badge
        $customdata = [];
        if( $settings['add_custom_menuicon'] == 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-menu-icon-pos-'.$settings['icon_pos'] );
            $customicons = $settings['custom_icon_list'];
            if( is_array( $customicons ) ){
                foreach ( $customicons as $customicon ) {
                    $customdata[$customicon['menu_item']] = [
                        'icon' => move_addons_render_icon( $customicon, 'custom_menu_icon', 'custom_menuicon' ),
                    ];
                }
            }

        }

        // Menu Argument
        $args = [
            'echo' => false,
            'menu' => $settings['inline_menu_slug'],
            'menu_class' => 'htmove-inline-menu-list',
            'menu_id' => 'menu-'. $id,
            'fallback_cb' => '__return_empty_string',
            'container' => '',
            'walker' => new \MoveAddons\Elementor\Move_Addons_Walker_Nav_Menu(),
            'custom_data' => [
                'icon'=> $customdata,
            ]
        ];

        // Generate Menu.
        $menu_html = wp_nav_menu( $args );

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <div class="htmove-inline-menu-head">
                <?php
                    echo $mobile_text;
                    if( !empty( $settings['mobile_menu_toggler_icon']['value'] ) ){
                        echo '<button class="htmove-inline-menu-toggle"><span class="htmove-open">'.$mobile_icon.'</span><span class="htmove-close">&nbsp;</span></button>';
                    }
                ?>
            </div>
            <?php
                if( !empty( $menu_html ) ){
                    echo $menu_html;
                }
            ?>
        </div>
        <?php

    }

}