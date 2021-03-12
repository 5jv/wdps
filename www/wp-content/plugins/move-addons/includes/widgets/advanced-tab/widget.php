<?php
namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Advanced_Tab_Element extends Base {

    public function get_name() {
        return 'move-advanced-tab';
    }

    public function get_title() {
        return esc_html__( 'Advanced Tab', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-tabs';
    }

    public function get_keywords() {
        return [ 'move', 'tabs', 'tab', 'advanced tab','advanced' ];
    }

    public function get_style_depends() {
        return [ 'move-advanced-tab' ];
    }

    public function get_script_depends() {
        return [ 'move-tabslet', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );
            
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'content_source',
                [
                    'label'   => esc_html__( 'Select Content Source', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'    => esc_html__( 'Custom', 'moveaddons' ),
                        "elementor" => esc_html__( 'Elementor Template', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'menu_title',
                [
                    'label' => esc_html__( 'Menu Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Tab #1', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'menu_icon',
                [
                    'label'       => esc_html__( 'Menu Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'menuicon',
                ]
            );

            $repeater->add_control(
                'content_title',
                [
                    'label' => esc_html__( 'Content Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
                        'content_source' =>'custom',
                    ],
                ]
            );

            $repeater->add_control(
                'content_image',
                [
                    'label' => esc_html__( 'Content Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'content_source' =>'custom',
                    ],
                ]
            );

            $repeater->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'content_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition'=>[
                        'content_image[url]!'=>'',
                    ]
                ]
            );

            $repeater->add_control(
                'content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => '<p>There is a lot of exciting stuff going on in the stars above us that make astronomy so much fun. The truth is the universe is a constantly changing, moving, some would say “living” thing because you just never know what you are going to see on any given night of stargazing.</p><p>But of the many celestial phenomenons, there is probably none as exciting as that time you see your first asteroid on the move in the heavens.</p>',
                    'condition' => [
                        'content_source' =>'custom',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'template_id',
                [
                    'label'   => esc_html__( 'Select Template', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => move_addons_elementor_template(),
                    'condition' => [
                        'content_source'=>'elementor',
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'tabs_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'menu_title' => esc_html__( 'Tab #1', 'moveaddons' ),
                            'content_title' => esc_html__( 'Break Through Self Doubt And Fear', 'moveaddons' ),
                            'content_image' => [ 'url'=> \Elementor\Utils::get_placeholder_image_src() ],
                            'content' => '<p>There is a lot of exciting stuff going on in the stars above us that make astronomy so much fun. The truth is the universe is a constantly changing, moving, some would say “living” thing because you just never know what you are going to see on any given night of stargazing.</p><p>But of the many celestial phenomenons, there is probably none as exciting as that time you see your first asteroid on the move in the heavens.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'menu_title' => esc_html__( 'Tab #2', 'moveaddons' ),
                            'content_title' => esc_html__( 'Break Through Self Doubt', 'moveaddons' ),
                            'content_image' => [ 'url'=> \Elementor\Utils::get_placeholder_image_src() ],
                            'content' => '<p>There is a lot of exciting stuff going on in the stars above us that make astronomy so much fun. The truth is the universe is a constantly changing, moving, some would say “living” thing because you just never know what you are going to see on any given night of stargazing.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'menu_title' => esc_html__( 'Tab #3', 'moveaddons' ),
                            'content_title' => esc_html__( 'Break Through Self Doubt', 'moveaddons' ),
                            'content_image' => [ 'url'=> \Elementor\Utils::get_placeholder_image_src() ],
                            'content' => '<p>There is a lot of exciting stuff going on in the stars above us that make astronomy so much fun. The truth is the universe is a constantly changing, moving, some would say “living” thing because you just never know what you are going to see on any given night of stargazing.</p><p>But of the many celestial phenomenons, there is probably none as exciting as that time you see your first asteroid on the move in the heavens.</p>',
                            'content_source'=>'custom',
                        ],
                        [
                            'menu_title' => esc_html__( 'Tab #4', 'moveaddons' ),
                            'content_title' => esc_html__( 'Break Through Self Doubt And Fear', 'moveaddons' ),
                            'content_image' => [ 'url'=> \Elementor\Utils::get_placeholder_image_src() ],
                            'content' => '<p>There is a lot of exciting stuff going on in the stars above us that make astronomy so much fun. The truth is the universe is a constantly changing, moving, some would say “living” thing because you just never know what you are going to see on any given night of stargazing.</p><p>But of the many celestial phenomenons, there is probably none as exciting as that time you see your first asteroid on the move in the heavens.</p>',
                            'content_source'=>'custom',
                        ],
                        
                    ],
                    'title_field' => '{{{ menu_title }}}',
                ]
            );

        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'content_additional_opt',
            [
                'label' => esc_html__( 'Option', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'menu_layout',
                [
                    'label'   => esc_html__( 'Menu Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
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

        $this->end_controls_section();

        // Menu Style tab section
        $this->start_controls_section(
            'menu_style_area',
            [
                'label' => esc_html__( 'Menu', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'menu_area_margin',
                [
                    'label' => esc_html__( 'Menu Area Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'after'
                ]
            );
            
            $this->add_responsive_control(
                'menu_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'menu_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'menu_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'menu_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a',
                ]
            );

            $this->add_responsive_control(
                'menu_icon_space',
                [
                    'label' => esc_html__( 'Icon Space', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'menu_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'moveaddons' ),
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
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'menu_style_tabs' );

                // Menu Normal Style
                $this->start_controls_tab(
                    'menu_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'menu_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-advance-tab-one > .htmove-tab-list li a svg *' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                // Menu Hover Style
                $this->start_controls_tab(
                    'menu_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'menu_active_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a::after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a svg *' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'menu_active_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'menu_active_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a',
                        ]
                    );

                    $this->add_control(
                        'menu_active_after_color',
                        [
                            'label' => esc_html__( 'Active Border Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-list li.active a::after' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Content Style tab section
        $this->start_controls_section(
            'content_style_area',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_area_padding',
                [
                    'label' => esc_html__( 'Content Area padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-container .htmove-tab-pane' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'content_area_border',
                    'label' => esc_html__( 'Content Area Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-advance-tab > .htmove-tab-container',
                ]
            );

            $this->add_control(
                'important_note',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<div style="color:#F64444;line-height:18px;">Title and content style option will work only for custom content.</div>',
                    'content_classes' => 'movenotice-imp',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'content_title_heading',
                [
                    'label' => esc_html__( 'Content Title', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Title Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content .htmove-tab-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Title Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content .htmove-tab-title',
                ]
            );

            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Title Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content .htmove-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_content_heading',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Content Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Content Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content p',
                ]
            );

            $this->add_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Content Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-advance-tab .htmove-tab-body .htmove-tab-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $tabs_list  = $this->get_settings_for_display('tabs_list');
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-advance-tab htmove-advance-tab-'.$settings['menu_layout'] );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <!-- Tab List Start -->
                <ul class="htmove-tab-list">
                    <?php
                        if( is_array( $tabs_list ) ){
                            $j = 0;
                            foreach ( $tabs_list as  $tab_item ){
                                $j++;

                                if( !empty( $tab_item['menu_icon']['value'] ) ){
                                    echo '<li><a href="#htmove-advance-tab-'.$j.$id.'">'.move_addons_render_icon( $tab_item,'menu_icon', 'menuicon' ).esc_html__( $tab_item['menu_title'], 'moveaddons' ).'</a></li>';
                                }else{
                                    echo '<li><a href="#htmove-advance-tab-'.$j.$id.'">'.esc_html__( $tab_item['menu_title'], 'moveaddons' ).'</a></li>';
                                }
                            }
                        }
                    ?>
                </ul>
                <!-- Tab List End -->

                <div class="htmove-tab-container">
                    <?php
                        if( is_array( $tabs_list ) ){
                            $i = 0;
                            foreach ( $tabs_list as  $tab_item ){
                                $i++;
                                echo '<div id="htmove-advance-tab-'.$i.$id.'" class="htmove-tab-pane">';
                                    $this->item_render( $tab_item );
                                echo '</div>';
                            }
                        }
                    ?>
                </div>

            </div>
        <?php

    }


    public function item_render( $tab ){
        ?>
        <div class="htmove-tab-body">
            <?php 
                if( $tab['content_source'] == 'custom' ){
                    
                    if( !empty( $tab['content_image']['url'] ) ){
                        echo '<div class="htmove-tab-image">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $tab, 'content_image_size', 'content_image' ).'</div>';
                    }

                    echo '<div class="htmove-tab-content">';

                        if( !empty( $tab['content_title'] ) ){
                            echo '<h4 class="htmove-tab-title">'.esc_html__( $tab['content_title'], 'moveaddons' ).'</h4>';
                        }

                        if( !empty( $tab['content'] ) ){
                            echo wp_kses_post( $tab['content'] );
                        }

                    echo '</div>';
                }else{
                    if( !empty( $tab['template_id'] ) ){
                        echo move_addons_get_elementor()->frontend->get_builder_content_for_display( $tab['template_id'] );
                    }
                }
            ?>
        </div>
        <?php
    }

}