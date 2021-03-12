<?php
namespace MoveAddons\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Call_To_Action_Element extends Base {

    public function get_name() {
        return 'move-call-to-action';
    }

    public function get_title() {
        return esc_html__( 'Call To Action', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-banner';
    }

    public function get_keywords() {
        return [ 'move', 'call to action', 'call banner', 'action banner' ];
    }

    public function get_style_depends() {
        return [ 'move-callto-action' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label'   => esc_html__( 'Layout', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'  => esc_html__( 'One', 'moveaddons' ),
                        'two'  => esc_html__( 'Two', 'moveaddons' ),
                    ],
                    'condition' => [
                        'image[id]' => '',
                    ],
                ]
            );

            $this->add_control(
                'image',
                [
                    'label' => esc_html__( 'Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $this->add_control(
                'image_position',
                [
                    'label'   => esc_html__( 'Image Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'image[id]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'=> esc_html__( 'Purchase Move Plugin Now!', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default'=> esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'btntitle',
                [
                    'label' => esc_html__( 'Button Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Purchase now', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'btn_link',
                [
                    'label' => esc_html__( 'Button Link', 'moveaddons' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'moveaddons' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'btn_icon',
                [
                    'label'       => esc_html__( 'Button Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'btnicon',
                ]
            );

            $this->add_control(
                'icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'btn_icon[value]!' => '',
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
            
            $this->add_control(
                'content_position',
                [
                    'label'   => esc_html__( 'Content Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'middle',
                    'options' => [
                        'top'     => esc_html__( 'Top', 'moveaddons' ),
                        'middle'  => esc_html__( 'Middle', 'moveaddons' ),
                        'bottom'  => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition' => [
                        'image[id]!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'allcontent_align',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'htmove-cta-content-align-%s',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'content_area_border',
                    'label' => esc_html__( 'Content Area Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-cta-content-area',
                    'condition' => [
                        'layout' => 'two',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_area_padding',
                [
                    'label' => esc_html__( 'Content Area Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout' => 'two',
                    ],
                ]
            );

        $this->end_controls_section();

        // Image Style tab section
        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'image[id]!' => '',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'image_align',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'htmove-cta-image-align-%s',
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-image' => 'text-align: {{VALUE}};',
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
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content Style tab section
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
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-desc p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-desc p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'btn_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn',
                ]
            );

            $this->add_responsive_control(
                'btn_icon_size',
                [
                    'label' => __( 'Icon size', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'btn_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'btn_icon_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'btn_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'btn_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn',
                        ]
                    );

                $this->end_controls_tab();

                // Button Hover style tab
                $this->start_controls_tab(
                    'btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'btn_icon_hover_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn:hover i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn:hover svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'btn_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'btn_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-cta-content .htmove-cta-btn:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();
            
        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-cta-content htmove-cta-content-'.$settings['layout'] );

        $layout = ( !empty( $settings['layout'] ) ? $settings['layout'] : '' );

        if( !empty( $settings['btn_icon']['value'] ) ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-icon-'.$settings['icon_align'] );
        }

        $btntitle = !empty( $settings['btntitle'] ) ? $settings['btntitle'] : '';
        $btnicon  = !empty( $settings['btn_icon']['value'] ) ? move_addons_render_icon( $settings,'btn_icon', 'btnicon' ) : '';

        if( $settings['icon_align'] == 'right' ){
            $btntitle = $btntitle.$btnicon;
        }else{
            $btntitle = $btnicon.$btntitle;
        }

        $this->add_render_attribute( 'url', 'class', 'htmove-cta-btn' );
        if ( ! empty( $settings['btn_link']['url'] ) ) {
            
            $this->add_render_attribute( 'url', 'href', $settings['btn_link']['url'] );

            if ( $settings['btn_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['btn_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }

        }

        ?>
            <?php if( !empty( $settings['image']['url'] ) ): ?>
            <div class="htmove-crow">      
                <div class="htmove-ccol-2 htmove-img-pos-<?php echo ( !empty( $settings['image_position'] ) ? $settings['image_position'] : 'default' ); ?>">
                    <div class="htmove-cta-image">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' ); ?>
                    </div>
                </div>
            <?php endif; if( !empty( $settings['image']['url'] ) ){ echo '<div class="htmove-ccol-2 htmove-ccontent-pos-'.$settings['content_position'].'">'; } ?>

            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php
                    if( $layout == 'two' ){ echo '<div class="htmove-cta-content-area">';
                    }
                    if( !empty( $settings['title'] ) ){
                        echo '<h2 class="htmove-cta-title">'.esc_html__( $settings['title'], 'moveaddons' ).'</h2>';
                    }
                    if( !empty( $settings['content'] ) ){
                        echo '<div class="htmove-cta-desc"><p>'.esc_html__( $settings['content'], 'moveaddons' ).'</p></div>';
                    }
                    if( $layout == 'two' ){ echo '</div>';}

                    if( !empty( $settings['btntitle'] ) ){
                        echo '<a '.$this->get_render_attribute_string( 'url' ).'>'.$btntitle.'</a>';
                    }
                ?>
            </div>

        <?php
        if( !empty( $settings['image']['url'] ) ){ echo '</div></div>'; }

    }

}