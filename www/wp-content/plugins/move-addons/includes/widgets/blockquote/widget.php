<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blockquote_Element extends Base {

    public function get_name() {
        return 'move-blockquote';
    }

    public function get_title() {
        return esc_html__( 'Block quote', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-blockquote';
    }

    public function get_keywords() {
        return [ 'move', 'blockquote', 'block quote', 'block', 'quote' ];
    }

    public function get_style_depends() {
        return ['move-blockquote'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'custom_content',
                [
                    'label' => esc_html__( 'Content', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( '“Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. quis nostrud exercitation ullamco.”', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'blockquote_by',
                [
                    'label' => esc_html__( 'Blockquote By', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Shane McGuire', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Shane McGuire', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'quote_icon',
                [
                    'label'       => esc_html__( 'Blockquote Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-quote-right',
                        'library' => 'solid',
                    ],
                    'label_block' => true,
                    'fa4compatibility' => 'quoteicon',
                ]
            );

            $this->add_control(
                'icon_pos',
                [
                    'label' => esc_html__( 'Quote Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                        'top'    => esc_html__( 'Top', 'moveaddons' ),
                        'bottom' => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'quote_icon[value]!'=>'',
                    ]
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'blockquote_align',
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
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'htmove-blockquote-align-%s',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'blockquote_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner',
                ]
            );

            $this->add_responsive_control(
                'blockquote_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquote_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'blockquote_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner',
                ]
            );

            $this->add_responsive_control(
                'blockquote_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition'=>[
                        'blockquote_border_border!'=>'',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content Style Tab
        $this->start_controls_section(
            'blockquote_content_style_section',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'blockquote_content_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'blockquote_content_typography',
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content,{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content p',
                ]
            );

            $this->add_responsive_control(
                'blockquote_content_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquote_content_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'blockquoteby_style_section',
            [
                'label' => esc_html__( 'Quote By', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'blockquoteby_color',
                [
                    'label' => __( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'blockquotenby_typography',
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name',
                ]
            );

            $this->add_responsive_control(
                'blockquoteby_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquoteby_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'blockquoteby_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name',
                ]
            );

            $this->add_responsive_control(
                'blockquoteby_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-name' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition'=>[
                        'blockquoteby_border_border!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteby_before_position',
                [
                    'label' => esc_html__( 'Separator Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'before' => esc_html__( 'Before', 'moveaddons' ),
                        'after'  => esc_html__( 'After', 'moveaddons' ),
                        'none'   => esc_html__( 'None', 'htmega-addons' ),
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'blockquoteby_before_color',
                [
                    'label' => esc_html__( 'Separator Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::before' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::after' => 'background-color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteby_before_width',
                [
                    'label' => esc_html__( 'Separator Width', 'moveaddons' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::before' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::after' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteby_before_height',
                [
                    'label' => esc_html__( 'Separator Height', 'moveaddons' ),
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
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::before' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-content .htmove-blockquote-name::after' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'blockquoteby_before_position!'=>'none',
                    ],
                ]
            );

        $this->end_controls_section();

        // blockquote icon style start
        $this->start_controls_section(
            'blockquoteicon_style_section',
            [
                'label' => esc_html__( 'Quote Icon', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'quote_icon[value]!' =>'',
                ],
            ]
        );

            $this->add_control(
                'blockquoteicon_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon svg *' => 'stroke: {{VALUE}};fill:{{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'blockquoteicon_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'blockquoteicon_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon',
                ]
            );

            $this->add_responsive_control(
                'blockquoteicon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'condition'=>[
                        'blockquoteicon_border_border!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'blockquoteicon_fontsize',
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'blockquoteicon_width',
                [
                    'label' => esc_html__( 'Width', 'moveaddons' ),
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
                        'size' => 64,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'blockquoteicon_height',
                [
                    'label' => esc_html__( 'Height', 'moveaddons' ),
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
                        'size' => 64,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-blockquote .htmove-blockquote-inner .htmove-blockquote-icon' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-blockquote' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-quote-icon-pos-'.$settings['icon_pos'] );

        $quote_txt = ( !empty( $settings['custom_content'] ) ? '<p class="htmove-quote-text">'.$settings['custom_content'].'</p>' : '' );

        $quote_by = ( !empty( $settings['blockquote_by'] ) ? '<span class="htmove-blockquote-name htmove-quote-pos-'.$settings['blockquoteby_before_position'].'">'.$settings['blockquote_by'].'</span>' : '' );

        $icon = ( !empty( $settings['quote_icon']['value'] ) ? '<div class="htmove-blockquote-icon">'.move_addons_render_icon( $settings, 'quote_icon', 'quoteicon' ).'</div>' : '' );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <div class="htmove-blockquote-inner">
                    <?php
                        echo sprintf( '%1$s<div class="htmove-blockquote-content">%2$s %3$s</div>',$icon, $quote_txt, $quote_by );
                    ?>
                </div>
            </div>
        <?php

    }

}