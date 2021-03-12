<?php
namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Feature_List_Element extends Base {

    public function get_name() {
        return 'move-feature-list';
    }

    public function get_title() {
        return esc_html__( 'Feature List', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-editor-list-ul';
    }

    public function get_keywords() {
        return [ 'move', 'feature', 'feature list', 'list' ];
    }

    public function get_style_depends() {
        return [ 'move-feature-list' ];
    }

    public function get_script_depends() {
        return [  ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Feature List', 'moveaddons' ),
            ]
        );
            
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Feature Title', 'moveaddons' ),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'listtype_content',
                [
                    'label' => esc_html__( 'List type content ?', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater->add_control(
                'list_content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'description' => esc_html__( 'Add separate by new line.', 'moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'listtype_content' => 'yes',
                    ]
                ]
            );

            $repeater->add_control(
                'content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Neque porro quisquam eos est, qui dolorem ipsum quia dolor sit amet.','moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'listtype_content!' => 'yes',
                    ]
                ]
            );

            $repeater->add_control(
                'feature_icon',
                [
                    'label'       => esc_html__( 'Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'featureicon',
                ]
            );

            $this->add_control(
                'feature_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'title' => esc_html__( 'Design', 'moveaddons' ),
                            'content' => esc_html__( 'Duis aute irure in reprehenderit in voluptate velit esse cillum dolore. Lorem ispum kaixa design','moveaddons' ),
                            'feature_icon' => [
                                'value'     => 'fas fa-brush',
                                'library'   => 'solid'
                            ]
                        ],
                        [
                            'title' => esc_html__( 'Development', 'moveaddons' ),
                            'content' => esc_html__( 'Neque porro quisquam eos est, qui dolorem ipsum quia dolor sit amet.','moveaddons' ),
                            'feature_icon' => [
                                'value'     => 'fas fa-rocket',
                                'library'   => 'solid'
                            ]
                        ],
                        [
                            'title' => esc_html__( 'Testing', 'moveaddons' ),
                            'content' => esc_html__( 'Excepteur sint occaecat cupidatat proident, sunt culpa qui officia deserunt.','moveaddons' ),
                            'feature_icon' => [
                                'value'     => 'fab fa-accessible-icon',
                                'library'   => 'brands'
                            ]
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'additional_option_section',
            [
                'label' => esc_html__( 'Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'icon_pos',
                [
                    'label' => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'        => esc_html__( 'Left', 'moveaddons' ),
                        'right'       => esc_html__( 'Right', 'moveaddons' ),
                        'top'         => esc_html__( 'Top', 'moveaddons' ),
                        'bottom'      => esc_html__( 'Bottom', 'moveaddons' ),
                        'titlebefore' => esc_html__( 'Before Title', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_responsive_control(
                'space_between',
                [
                    'label' => esc_html__( 'Space Between', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature-list .htmove-feature + .htmove-feature' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'feature_link_bar_color',
                [
                    'label' => esc_html__( 'Feature Bar', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-icon-pos-left:not(:last-child)::before, .htmove-icon-pos-right:not(:last-child)::before' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-icon-pos-right:not(:last-child)::before' => 'background-color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'icon_pos' => [ 'left','right' ],
                    ]
                ]
            );

        $this->end_controls_section();

        // Column Option
        $this->start_controls_section(
            'column_option_section',
            [
                'label' => esc_html__( 'Column', 'moveaddons' ),
                'condition'=>[
                    'icon_pos' => [ 'top','bottom','titlebefore' ],
                ]
            ]
        );
            
            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        ''  => esc_html__( 'Default', 'moveaddons' ),
                        '1' => esc_html__( 'One', 'moveaddons' ),
                        '2' => esc_html__( 'Two', 'moveaddons' ),
                        '3' => esc_html__( 'Three', 'moveaddons' ),
                        '4' => esc_html__( 'Four', 'moveaddons' ),
                        '5' => esc_html__( 'Five', 'moveaddons' ),
                        '6' => esc_html__( 'Six', 'moveaddons' ),
                        '7' => esc_html__( 'Seven', 'moveaddons' ),
                        '8' => esc_html__( 'Eight', 'moveaddons' ),
                        '9' => esc_html__( 'Nine', 'moveaddons' ),
                        '10'=> esc_html__( 'Ten', 'moveaddons' ),
                    ],
                    'label_block' => true,
                    'prefix_class' => 'htmove-columns%s-',
                ]
            );

            $this->add_control(
                'no_gutters',
                [
                    'label' => esc_html__( 'No Gutters', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'item_space',
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-row > [class*="col-"]' => 'padding: 0  {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_bottom_space',
                [
                    'label' => esc_html__( 'Bottom Space', 'moveaddons' ),
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-row > [class*="col-"]' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();



        // Title tab section
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content .htmove-feature-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-feature .htmove-feature-content .htmove-feature-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content .htmove-feature-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content tab section
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content p' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content ul li' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-feature .htmove-feature-content p,{{WRAPPER}} .htmove-feature .htmove-feature-content ul li',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_list_item_space',
                [
                    'label' => esc_html__( 'Content Item Space', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'description'=> esc_html__( 'Only Work in content list item', 'moveaddons' ),
                    'selectors' => [
                        '{{WRAPPER}} .htmove-feature .htmove-feature-content ul li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Icon tab section
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('icon_style_tabs');
                
                // Normal Style Tab
                $this->start_controls_tab(
                    'icon_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'icon_normal_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon svg *' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_normal_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon::before' => 'background-color: {{VALUE}};opacity:1',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'icon_normal_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-feature .htmove-feature-icon',
                        ]
                    );

                    $this->add_responsive_control(
                        'icon_normal_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'icon_normal_margin',
                        [
                            'label' => esc_html__( 'Margin', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature .htmove-feature-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Hover Style Tab
                $this->start_controls_tab(
                    'icon_hover_style_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'icon_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature:hover .htmove-feature-icon' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-feature:hover .htmove-feature-icon svg *' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-feature:hover .htmove-feature-icon::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'icon_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-feature:hover .htmove-feature-icon',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings       = $this->get_settings_for_display();
        $feature_list   = $this->get_settings_for_display( 'feature_list' );

        // Column
        $column         = $this->get_settings_for_display('column');
        $collumval = '';
        if( !empty( $column ) ){
            $collumval = 'htmove-col-'.$column;
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-row' );
            if( $settings['no_gutters'] === 'yes' ){
                $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
            }
            $this->add_render_attribute( 'item_attr', 'class', $collumval );
        }

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-feature-list' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-feature-list-one' );
        $this->add_render_attribute( 'item_attr', 'class', 'htmove-feature htmove-icon-pos-'.$settings['icon_pos'] );

        if( $settings['icon_pos'] == 'titlebefore' ){
            $this->add_render_attribute( 'item_attr', 'class', 'htmove-feature-two' );
        }


        if( is_array( $feature_list ) ){
            ?>                
            <ul <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <?php foreach ( $feature_list as  $feature ): ?>
                    <li <?php echo $this->get_render_attribute_string( 'item_attr' ); ?>>

                        <?php
                            if( $settings['icon_pos'] != 'titlebefore' ){
                                if( !empty( $feature['feature_icon']['value'] ) ){
                                    echo '<div class="htmove-feature-icon">'.move_addons_render_icon( $feature,'feature_icon', 'featureicon' ).'</div>';
                                }
                            }
                        ?>

                        <div class="htmove-feature-content">
                            <?php

                                if( $settings['icon_pos'] == 'titlebefore' ){ 
                                    echo '<div class="htmove-feature-head">';

                                    if( !empty( $feature['feature_icon']['value'] ) ){
                                        echo '<div class="htmove-feature-icon">'.move_addons_render_icon( $feature,'feature_icon', 'featureicon' ).'</div>';
                                    }
                                }

                                    if( !empty( $feature['title'] ) ){
                                        echo '<h5 class="htmove-feature-title">'.esc_html__( $feature['title'] ,'moveaddons' ).'</h5>';
                                    }

                                if( $settings['icon_pos'] == 'titlebefore' ){ echo '</div>'; }

                                if( $feature['listtype_content'] == 'yes' ){
                                    move_addons_generate_list( $feature['list_content'] );
                                }else{
                                    if( !empty( $feature['content'] ) ){
                                        echo '<p>'.esc_html__( $feature['content'] ,'moveaddons' ).'</p>';
                                    }
                                }
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
            <?php
        }

    }

}