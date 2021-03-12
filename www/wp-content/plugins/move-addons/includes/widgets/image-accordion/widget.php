<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Image_Accordion_Element extends Base {

    public function get_name() {
        return 'move-image-accordion';
    }

    public function get_title() {
        return esc_html__( 'Image Accordion', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-accordion';
    }

    public function get_keywords() {
        return [ 'move', 'image', 'accordion', 'image accordion' ];
    }

    public function get_style_depends() {
        return [ 'move-image-accordion' ];
    }

    public function get_script_depends() {
        return ['move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Image Accordion', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'options' => [
                        'horizontal' => esc_html__( 'Horizontal', 'moveaddons' ),
                        'vertical'   => esc_html__( 'Vertical', 'moveaddons' ),
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'image',
                [
                    'label' => __( 'Choose Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Accordion Title', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your accordion title here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'subtitle',
                [
                    'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Accordion Sub Title', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your accordion sub title here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'btntitle',
                [
                    'label' => esc_html__( 'Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your accordion title here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'btn_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'accordion_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'title' => esc_html__( 'Flash Sale', 'moveaddons' ),
                            'subtitle' => esc_html__( 'Sale off 50% all item', 'moveaddons' ),
                            'btntitle' => esc_html__( 'Learn more', 'moveaddons' ),
                            'btn_link' => ['url'=>'#'],
                        ],
                        [
                            'title' => esc_html__( 'Flash Sale', 'moveaddons' ),
                            'subtitle' => esc_html__( 'Sale off 70% all item', 'moveaddons' ),
                            'btntitle' => esc_html__( 'Learn more', 'moveaddons' ),
                            'btn_link' => ['url'=>'#'],
                        ],
                        [
                            'title' => esc_html__( 'Flash Sale', 'moveaddons' ),
                            'subtitle' => esc_html__( 'Sale off 80% all item', 'moveaddons' ),
                            'btntitle' => esc_html__( 'Learn more', 'moveaddons' ),
                            'btn_link' => ['url'=>'#'],
                        ],

                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );


        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'content_additional_option',
            [
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
            ]
        );
            
            $this->add_responsive_control(
                'accordion_item_spacing',
                [
                    'label'   => esc_html__( 'Item Spacing', 'moveaddons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ '%', 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-image-accordion-horizontal .htmove-image-accordion-item + .htmove-image-accordion-item' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-image-accordion-vertical .htmove-image-accordion-item + .htmove-image-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'accordion_item_data_grow',
                [
                    'label'   => esc_html__( 'Data Expandable column', 'moveaddons' ),
                    'type'    => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                    ],
                    'size_units' => [ 'px' ],
                ]
            );

            $this->add_control(
                'active_item_number',
                [
                    'label' => __( 'Active Item No', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'step' => 1,
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
                'content_align',
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
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Title Style tab section
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
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-title' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Sub Title Style tab section
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'subtitle_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'subtitle_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-text',
                ]
            );

            $this->add_responsive_control(
                'subtitle_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('button_style_tabs');

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
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
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
                        'button_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-image-accordion .htmove-image-accordion-item .htmove-image-accordion-item-inner .htmove-image-accordion-content .htmove-image-accordion-btn:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $accordion_list = $this->get_settings_for_display('accordion_list');
        $activenum = (!empty( $settings['active_item_number'] ) ? $settings['active_item_number'] : 1 );
        $datagrow = ( !empty( $settings['accordion_item_data_grow']['size'] ) ? $settings['accordion_item_data_grow']['size'] : 2 );

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-image-accordion htmove-image-accordion-'.$settings['layout'] );
        $this->add_render_attribute( 'area_attr', 'data-grow', $datagrow );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <?php
                    $i = 0;
                    foreach ( $accordion_list as $accordion ) {
                        $bg_image = !empty( $accordion['image']['url'] ) ? 'style=background-image:url('.$accordion['image']['url'].')' : '';
                        $i++;
                        $active = ( $i == $activenum ) ? 'active' : '';

                        // URL Generate
                        $target = $nofollow = '';
                        $url = '#';
                        if( !empty( $accordion['btn_link']['url'] ) ){
                            $url = $accordion['btn_link']['url'] ? $accordion['btn_link']['url'] : '#';
                            $target = $accordion['btn_link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $accordion['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
                        }

                    ?>
                    <div class="htmove-image-accordion-item <?php echo esc_attr( $active ); ?>">
                        <div class="htmove-image-accordion-item-inner" <?php echo esc_attr( $bg_image ); ?>>
                            <div class="htmove-image-accordion-content">
                                <?php
                                    if( !empty( $accordion['title'] ) ){
                                        echo '<h3 class="htmove-image-accordion-title">'.esc_html__($accordion['title'],'moveaddons').'</h3>';
                                    }
                                    if( !empty( $accordion['subtitle'] ) ){
                                        echo '<p class="htmove-image-accordion-text">'.esc_html__($accordion['subtitle'],'moveaddons').'</p>';
                                    }
                                    if( !empty( $accordion['btntitle'] ) ){
                                        echo '<a href="'.esc_url($url).'" class="htmove-image-accordion-btn" '.$target.$nofollow.'>'.esc_html__($accordion['btntitle'],'moveaddons').'</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                ?>

            </div>
        <?php

    }

}