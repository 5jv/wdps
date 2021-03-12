<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Image_Comparison_Element extends Base {

    public function get_name() {
        return 'move-image-comparison';
    }

    public function get_title() {
        return esc_html__( 'Image Comparison', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-image-before-after';
    }

    public function get_keywords() {
        return [ 'move', 'image comparison', 'comparison', 'compare' ];
    }

    public function get_style_depends() {
        return [ 'move-imagecomparison' ];
    }

    public function get_script_depends() {
        return ['move-twentytwenty','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Image Comparison', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout_style',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style one', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                        'three' => esc_html__( 'Style Three', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'before_image',
                [
                    'label' => esc_html__( 'Before Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'before_image_size',
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'after_image',
                [
                    'label' => esc_html__( 'After Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'after_image_size',
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

        $this->end_controls_section();

        // Addition Option
        $this->start_controls_section(
            'image_comparison_addition',
            [
                'label' => esc_html__( 'Additional Settings', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'direction',
                [
                    'label'   => esc_html__( 'Direction', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'options' => [
                        'vertical'   => esc_html__( 'Vertical', 'moveaddons' ),
                        'horizontal' => esc_html__( 'Horizontal', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'start_amount',
                [
                    'label' => esc_html__( 'Before Start Amount', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                ]
            );

            $this->add_control(
                'no_overlay',
                [
                    'label'        => esc_html__( 'No Overlay', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );

            $this->add_control(
                'move_slider_on_hover',
                [
                    'label'        => esc_html__( 'Move On Hover', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );

            $this->add_control(
                'click_to_move',
                [
                    'label'        => esc_html__( 'Click To Move', 'moveaddons' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'condition'=>[
                        'move_slider_on_hover!'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'before_title',
                [
                    'label' => esc_html__( 'Before Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder'=> esc_html__('Before','moveaddons'),
                ]
            );

            $this->add_control(
                'after_title',
                [
                    'label' => esc_html__( 'After Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder'=> esc_html__('After','moveaddons'),
                ]
            );

            $this->add_control(
                'label_pos',
                [
                    'label' => esc_html__( 'Label Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top'      => esc_html__( 'Top', 'moveaddons' ),
                        'center'   => esc_html__( 'Center', 'moveaddons' ),
                        'bottom'   => esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'direction'=>'horizontal',
                    ],
                ]
            );

            $this->add_control(
                'label_pos_2',
                [
                    'label' => esc_html__( 'Label Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'middle',
                    'options' => [
                        'left'    => esc_html__( 'Left', 'moveaddons' ),
                        'middle'  => esc_html__( 'Middle', 'moveaddons' ),
                        'right'   => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition'=>[
                        'direction'=>'vertical',
                    ],
                ]
            );

        $this->end_controls_section();

        // Handler Style tab section
        $this->start_controls_section(
            'handler_style_section',
            [
                'label' => esc_html__( 'Handler', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'handler_border_color',
                [
                    'label' => esc_html__( 'Handle Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle::before' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle::after' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle span.twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle span.twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle span.twentytwenty-down-arrow' => 'border-top-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle span.twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'handler_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic' ],
                    'selector' => '{{WRAPPER}} .htmove-image-comparison .twentytwenty-handle span',
                    'condition'=>[
                        'layout_style'=>'two',
                    ]
                ]
            );

        $this->end_controls_section();

        // Label Style tab section
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__( 'Before After Label', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'before_after_label_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'before_after_label_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'before_after_label_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before',
                ]
            );

            $this->add_control(
                'before_after_label_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'before_after_label_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'before_after_label_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-image-comparison .twentytwenty-overlay div::before',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-image-comparison htmove-image-comparison-'.$settings['layout_style'] );

        $this->add_render_attribute( 'area_attr', 'class', ( $settings['direction'] == 'horizontal' ? 'htmove-label-pos-'.$settings['label_pos'] : 'htmove-label-vpos-'.$settings['label_pos_2'] ) );

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-image-comparison-'.$settings['direction'] );

        $data_settings = [
            'orientation'           => $settings['direction'],
            'default_offset_pct'    => ( !empty( $settings['start_amount']) ? ( absint( $settings['start_amount'] ) / 10 ) : 0.5 ),
            'no_overlay'            => ( 'yes' === $settings['no_overlay'] ),
            'move_slider_on_hover'  => ( 'yes' === $settings['move_slider_on_hover'] ),
            'click_to_move'         => ( 'yes' === $settings['click_to_move'] ),
            'before_label'          => ( !empty( $settings['before_title'] ) ? $settings['before_title'] : esc_html__( 'Before', 'moveaddons' ) ),
            'after_label'           => ( !empty( $settings['after_title'] ) ? $settings['after_title'] : esc_html__( 'After', 'moveaddons' ) ),
        ];
        $this->add_render_attribute( 'area_attr', 'data-settings', wp_json_encode( $data_settings ) );

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
        <?php
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'before_image_size', 'before_image' );
        
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'after_image_size', 'after_image' );
        ?>
        </div>
        <?php

    }

}