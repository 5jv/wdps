<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Animated_Heading_Element extends Base {

    public function get_name() {
        return 'move-animated-heading';
    }

    public function get_title() {
        return esc_html__( 'Animated Heading', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-animated-headline';
    }

    public function get_keywords() {
        return [ 'move', 'heading', 'animated', 'animation' ];
    }

    public function get_style_depends() {
        return [
            'move-animated-heading',
        ];
    }

    public function get_script_depends() {
        return [
            'cd-headline',
            'waypoints',
            'counterup',
            'move-main',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'animatedheading_content',
            [
                'label' => esc_html__( 'Animated Heading', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'layout_style',
                [
                    'label'   => esc_html__( 'Layout', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__( 'Style One', 'moveaddons' ),
                        '2' => esc_html__( 'Style Two', 'moveaddons' )
                    ],
                ]
            );

            $this->add_control(
                'animation_type',
                [
                    'label'   => esc_html__( 'Animation Type', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'type',
                    'options' => [
                        'type'          => esc_html__( 'Type', 'moveaddons' ),
                        'loading-bar'   => esc_html__( 'Loading bar', 'moveaddons' ),
                        'slide'         => esc_html__( 'Slide', 'moveaddons' ),
                        'clip'          => esc_html__( 'Clip', 'moveaddons' ),
                        'zoom'          => esc_html__( 'Zoom', 'moveaddons' ),
                        'scale'         => esc_html__( 'Scale', 'moveaddons' ),
                        'push'          => esc_html__( 'Push', 'moveaddons' ),
                        'rotate-1'      => esc_html__( 'Rotate Style One', 'moveaddons' ),
                        'rotate-2'      => esc_html__( 'Rotate Style Two', 'moveaddons' ),
                        'rotate-3'      => esc_html__( 'Rotate Style Three', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'layout_style!'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'animated_before_text',
                [
                    'label' => esc_html__( 'Heading Before Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Online Tutoring &', 'moveaddons' ),
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'animated_heading_text',
                [
                    'label'       => esc_html__( 'Animated Heading Text', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'default'     => esc_html__( "Life Coach,Life,Coach", 'moveaddons' ),
                    'condition'=>[
                        'layout_style!'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'counter_number',
                [
                    'label' => esc_html__( 'Target Counter Number', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 15,
                    'condition'=>[
                        'layout_style'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'counter_number_prefix',
                [
                    'label'       => esc_html__( 'Counter Prefix', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'condition'=>[
                        'layout_style'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'counter_number_suffix',
                [
                    'label'       => esc_html__( 'Counter Suffix', 'moveaddons' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => esc_html__( "+", 'moveaddons' ),
                    'condition'=>[
                        'layout_style'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'visible_items',
                [
                    'label' => esc_html__( 'Visible Item Number', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'step' => 1,
                    'default' => 1,
                    'condition'=>[
                        'layout_style!'=>'2',
                    ],
                ]
            );

            $this->add_control(
                'animated_after_text',
                [
                    'label' => esc_html__( 'Heading After Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Before Style tab section
        $this->start_controls_section(
            'animated_heading_beforetext_style',
            [
                'label' => esc_html__( 'Before Text Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'animated_before_text!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'heading_before_text_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_before_text_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'heading_before_text_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext',
                ]
            );

            $this->add_responsive_control(
                'heading_before_text_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'heading_before_text_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_before_text_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext',
                ]
            );

            $this->add_responsive_control(
                'heading_before_text_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.beforetext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Animated text Style tab section
        $this->start_controls_section(
            'animated_heading_text_style',
            [
                'label' => esc_html__( 'Animated Text Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'layout_style!'=>'2',
                ],
            ]
        );
            
            $this->add_control(
                'heading_animated_text_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper::after' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_animated_text_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'heading_animated_text_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_responsive_control(
                'heading_animated_text_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'heading_animated_text_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_animated_text_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b',
                ]
            );

            $this->add_responsive_control(
                'heading_animated_text_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading .cd-words-wrapper b' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'heading_animated_text_loadingbar_color',
                [
                    'label'     => esc_html__( 'Loading bar Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' =>[
                        'animation_type'=>'loading-bar',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading .cd-headline.loading-bar .cd-words-wrapper::after' => 'background-color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // After Style tab section
        $this->start_controls_section(
            'animated_heading_aftertext_style',
            [
                'label' => esc_html__( 'After Text Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'animated_after_text!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'heading_after_text_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_after_text_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'heading_after_text_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext',
                ]
            );

            $this->add_responsive_control(
                'heading_after_text_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'heading_after_text_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'heading_after_text_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext',
                ]
            );

            $this->add_responsive_control(
                'heading_after_text_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.aftertext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        // Counter Style tab section
        $this->start_controls_section(
            'animated_counter_style',
            [
                'label' => esc_html__( 'Counter', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'layout_style'=>'2',
                ]
            ]
        );
            
            $this->add_control(
                'counter_color',
                [
                    'label'     => esc_html__( 'Color', 'moveaddons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.number' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.number',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'counter_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.number',
                ]
            );

            $this->add_responsive_control(
                'counter_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.number' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'counter_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.number',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'counter_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-animated-heading h2 span.number',
                ]
            );

            $this->add_responsive_control(
                'counter_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-animated-heading h2 span.number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'heading_area_attr', 'class', 'htmove-animated-heading htmove-style-'.$settings['layout_style'] );

        $this->add_render_attribute( 'heading_attr', 'class', 'title cd-headline '.$settings['animation_type'] );

        if( $settings['animation_type'] === 'type' || $settings['animation_type'] === 'rotate-3' || $settings['animation_type'] === 'rotate-2' || $settings['animation_type'] === 'scale' ){
            $this->add_render_attribute( 'heading_attr', 'class', 'letters' );
        }

        $text_list = explode(",", esc_html( $settings['animated_heading_text'] ) );

        if( $settings['layout_style'] === '2' ):?>
            <div class="htmove-animated-heading htmove-animated-heading-two">
                <h2 class="title">
                    <?php
                        if( !empty( $settings['animated_before_text'] ) ){
                            echo '<span class="beforetext">'.$settings['animated_before_text'].'</span>';
                        }
                    ?>
                    <span class="number">
                        <?php
                            if( !empty( $settings['counter_number_prefix'] ) ){
                                echo '<span class="move-counter-prefix">'.esc_html__( $settings['counter_number_prefix'], 'moveaddons' ).'</span>';
                            }
                            if( !empty( $settings['counter_number'] ) ){
                                echo '<span class="move-counter">'.esc_html__( $settings['counter_number'], 'moveaddons' ).'</span>';
                            }
                            if( !empty( $settings['counter_number_suffix'] ) ){
                                echo '<span class="move-counter-suffix">'.esc_html__( $settings['counter_number_suffix'], 'moveaddons' ).'</span>';
                            }
                        ?>
                    </span>
                    <?php
                        if( !empty( $settings['animated_after_text'] ) ){
                            echo '<span class="aftertext">'.$settings['animated_after_text'].'</span>';
                        }
                    ?>
                </h2>
            </div>
        <?php else: ?>
            <div <?php echo $this->get_render_attribute_string( 'heading_area_attr' ); ?> >
                <h2 <?php echo $this->get_render_attribute_string( 'heading_attr' ); ?> >
                    <?php
                        if( !empty( $settings['animated_before_text'] ) ){
                            echo '<span class="beforetext">'.$settings['animated_before_text'].'</span>';
                        }

                        if( is_array( $text_list ) && count( $text_list ) > 0 ):
                    ?>
                        <span class="cd-words-wrapper">
                            <?php
                                $i = 0; 
                                foreach ( $text_list as $text ) {
                                    $i++;
                                    if( $i == $settings['visible_items'] ){
                                        echo '<b class="is-visible" >'.esc_html__( $text, 'moveaddons' ).'</b>';
                                    }else{
                                        echo '<b>'.esc_html__( $text, 'moveaddons' ).'</b>';
                                    }
                                }
                            ?>
                        </span>
                    <?php
                        endif;
                        if( !empty( $settings['animated_after_text'] ) ){
                            echo '<span class="aftertext">'.$settings['animated_after_text'].'</span>';
                        }
                    ?>
                </h2>
            </div>
        <?php endif;

    }

}