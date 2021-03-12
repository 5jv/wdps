<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial_Element extends Base {

    public function get_name() {
        return 'move-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Testimonial', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-testimonial';
    }

    public function get_keywords() {
        return [ 'move', 'testimonial', 'client say', 'client comment' ];
    }

    public function get_style_depends() {
        return ['move-testimonial'];
    }

    public function get_script_depends() {
        return [ 'swiper', 'move-main' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Testimonial', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'testimonial_style',
                [
                    'label' => esc_html__( 'Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Style One', 'moveaddons' ),
                        'two'   => esc_html__( 'Style Two', 'moveaddons' ),
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'client_image',
                [
                    'label' => esc_html__( 'Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $repeater->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'client_imagesize',
                    'default' => 'thumbnail',
                    'separator' => 'none',
                    'condition'=>[
                        'client_image[id]!'=>'',
                    ],
                ]
            );

            $repeater->add_control(
                'client_name',
                [
                    'label'   => esc_html__( 'Name', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__('Annie Quinn','moveaddons'),
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'client_designation',
                [
                    'label'   => esc_html__( 'Designation', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__('Managing Director','moveaddons'),
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'client_say',
                [
                    'label'   => esc_html__( 'Client Say', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('“Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis architecto beatae unde omnis iste natus.”','moveaddons'),
                ]
            );

            $this->add_control(
                'testimonial_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'client_name' => esc_html__('Maggie Strickland','moveaddons'),
                            'client_designation' => esc_html__( 'Marketer / May Inc','moveaddons' ),
                            'client_say' => esc_html__( '“Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis architecto beatae unde omnis iste natus.”', 'moveaddons' ),
                        ],
                        [
                            'client_name' => esc_html__('Arthur Hansen','moveaddons'),
                            'client_designation' => esc_html__( 'CEO / Letters Inc','moveaddons' ),
                            'client_say' => esc_html__( '“Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis architecto beatae unde omnis iste natus.”', 'moveaddons' ),
                        ],
                        [
                            'client_name' => esc_html__('Annie Quinn','moveaddons'),
                            'client_designation' => esc_html__( 'Co-Founder / April Inc','moveaddons' ),
                            'client_say' => esc_html__( '“Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis architecto beatae unde omnis iste natus.”', 'moveaddons' ),
                        ],
                        [
                            'client_name' => esc_html__('Chester Torres','moveaddons'),
                            'client_designation' => esc_html__( 'VP of Product / Local Inc','moveaddons' ),
                            'client_say' => esc_html__( '“Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis architecto beatae unde omnis iste natus.”', 'moveaddons' ),
                        ],
                    ],
                    'title_field' => '{{{ client_name }}}',
                ]
            );

        $this->end_controls_section();

        /* Additional Options */
        $this->start_controls_section(
            'additional_option',
            [
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'slider_on',
                [
                    'label' => esc_html__( 'Slider', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '5',
                    'options' => [
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
                    'condition'=>[
                        'slider_on!'=>'yes',
                    ],
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
                    'condition'=>[
                        'slider_on!'=>'yes',
                    ],
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
                        'slider_on!'=>'yes',
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
                        'size' => 30,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                        'slider_on!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-row > [class*="col-"]' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'thumbnail_type',
                [
                    'label' => esc_html__( 'Thumbnail Type', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image'  => esc_html__( 'Image', 'moveaddons' ),
                        'quote' => esc_html__( 'Quote', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'quote_icon',
                [
                    'label' => esc_html__( 'Quote Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-quote-right',
                        'library' => 'solid',
                    ],
                    'fa4compatibility' => 'quoteicon',
                    'condition'=>[
                        'thumbnail_type'=>'quote',
                    ],
                ]
            );

            $this->add_control(
                'thumbnail_pos',
                [
                    'label' => esc_html__( 'Thumbnail Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'  => esc_html__( 'Left', 'moveaddons' ),
                        'right' => esc_html__( 'Right', 'moveaddons' ),
                        'top'   => esc_html__( 'Top', 'moveaddons' ),
                        'bottom'=> esc_html__( 'Bottom', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'title_designation_pos',
                [
                    'label' => esc_html__( 'Title/Designation Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'after',
                    'options' => [
                        'before'  => esc_html__( 'Before Client Say', 'moveaddons' ),
                        'after' => esc_html__( 'After Client Say', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // Slider Item Section Start
        $this->start_controls_section(
            'slider_item_options',
            [
                'label' => esc_html__( 'Slider Item Options', 'moveaddons' ),
                'condition'=>[
                    'slider_on'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'slider_item',
                [
                    'label' => esc_html__('Slider Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'desktop_item',
                [
                    'label' => esc_html__('Desktop Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                ]
            );

            $this->add_control(
                'tablet_item',
                [
                    'label' => esc_html__('Tablet Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'small_mobile_item',
                [
                    'label' => esc_html__('Small mobile Item', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'large_mobile_item',
                [
                    'label' => esc_html__('Large mobile', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'landscape_mobile_item',
                [
                    'label' => esc_html__('Mobile landscape', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

        $this->end_controls_section();

        // Slider Options Section Start
        $this->start_controls_section(
            'slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'moveaddons' ),
                'condition'=>[
                    'slider_on'=>'yes',
                ],
            ]
        );

            $this->add_control(
                'slider_speed',
                [
                    'label' => esc_html__('Speed', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                ]
            );

            $this->add_control(
                'slider_spacebetween',
                [
                    'label' => esc_html__('Space Between', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 30,
                ]
            );

            $this->add_control(
                'slider_loop',
                [
                    'label' => esc_html__( 'Repeatable Loop', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'slider_autoplay',
                [
                    'label' => esc_html__( 'Autoplay', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_autoplay_delay',
                [
                    'label' => esc_html__('Autoplay Delay', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3500,
                    'condition'=>[
                        'slider_autoplay'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'slider_arrow',
                [
                    'label' => esc_html__( 'Slider Navigation', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_arrow_on_hover',
                [
                    'label' => esc_html__( 'Navigation Show On Hover', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'slider_dots',
                [
                    'label' => esc_html__( 'Slider Pagination', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'slider_dots_on_hover',
                [
                    'label' => esc_html__( 'Pagination Show On Hover', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'slider_dots'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'next_icon',
                [
                    'label' => esc_html__( 'Next Navigation Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'nexticon',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'prev_icon',
                [
                    'label' => esc_html__( 'Previous Navigation Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'previcon',
                    'condition'=>[
                        'slider_arrow'=>'yes',
                    ],
                ]
            );

        $this->end_controls_section(); // Slider Options Section End

        // Animated text Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'htmega_testimonial_name_align',
                [
                    'label' => __( 'Alignment', 'moveaddons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'moveaddons' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'moveaddons' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'moveaddons' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content' => 'text-align: {{VALUE}};',
                    ],
                    'prefix_class' => 'htmove-testmolial-content-%s',
                ]
            );

        $this->end_controls_section();

        // Style Testimonial image style start
        $this->start_controls_section(
            'testimonial_thumbnail_style',
            [
                'label'     => esc_html__( 'Thumbnail', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'testimonial_quote_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-quote' => 'color: {{VALUE}};',
                    ],
                    'condition'=>[
                        'thumbnail_type'=>'quote',
                    ],
                ]
            );

            $this->add_control(
                'testimonial_quote_size',
                [
                    'label' => esc_html__( 'Font Size', 'plugin-domain' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-quote i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'thumbnail_type'=>'quote',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'testimonial_image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-thumb img',
                ]
            );

            $this->add_responsive_control(
                'testimonial_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-thumb img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'testimonial_image_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-thumb img' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section(); // Style Testimonial image style end

        // Style Testimonial name style start
        $this->start_controls_section(
            'testimonial_name_style',
            [
                'label'     => esc_html__( 'Name', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'testimonial_name_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_name_typography',
                    'selector' => '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-name',
                ]
            );

            $this->add_responsive_control(
                'testimonial_name_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'testimonial_name_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial name style end

        // Style Testimonial designation style start
        $this->start_controls_section(
            'testimonial_designation_style',
            [
                'label'     => esc_html__( 'Designation', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'testimonial_designation_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-position' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_designation_typography',
                    'selector' => '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-position',
                ]
            );

            $this->add_responsive_control(
                'testimonial_designation_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'testimonial_designation_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-info .htmove-testimonial-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end


        // Style Testimonial designation style start
        $this->start_controls_section(
            'testimonial_clientsay_style',
            [
                'label'     => esc_html__( 'Client say', 'moveaddons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'testimonial_clientsay_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-text p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_clientsay_typography',
                    'selector' => '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-text p',
                ]
            );

            $this->add_responsive_control(
                'testimonial_clientsay_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'testimonial_clientsay_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-testimonial .htmove-testimonial-content .htmove-testimonial-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end

        // Slider Button style
        $this->start_controls_section(
            'slider_controller_style',
            [
                'label' => esc_html__( 'Slider Controller Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on'=>'yes',
                ],
            ]
        );

            $this->add_control(
                'navigation_style',
                [
                    'label' => esc_html__( 'Navigation Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'  => esc_html__( 'One', 'moveaddons' ),
                        'two' => esc_html__( 'Two', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->start_controls_tabs('sliderbtn_style_tabs');

                // Slider Button style Normal
                $this->start_controls_tab(
                    'sliderbtn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_style_heading',
                        [
                            'label' => esc_html__( 'Navigation Arrow', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_responsive_control(
                        'nvigation_offeset',
                        [
                            'label' => esc_html__( 'Navigation Offest', 'moveaddons' ),
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
                                'size' => 70,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-slider-area .swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => esc_html__( 'Background Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'background-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'nvigation_size',
                        [
                            'label' => esc_html__( 'Size', 'moveaddons' ),
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
                                'size' => 30,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]::after' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"] i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_style_dots_heading',
                        [
                            'label' => esc_html__( 'Pagination', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                        $this->add_control(
                            'dots_pos_toggle',
                            [
                                'label' => esc_html__( 'Position', 'moveaddons' ),
                                'type' => Controls_Manager::POPOVER_TOGGLE,
                                'default' => 'no',
                            ]
                        );

                        $this->start_popover();

                        $this->add_responsive_control(
                            'dots_x_position',
                            [
                                'label' => esc_html__( 'Horizontal Postion', 'moveaddons' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => '%',
                                    'size' => 50,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_y_position',
                            [
                                'label' => esc_html__( 'Vertical Postion', 'moveaddons' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                     'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => -40,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->end_popover();

                        $this->add_control(
                            'dots_bg_color',
                            [
                                'label' => esc_html__( 'Color', 'moveaddons' ),
                                'type' => Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet::before' => 'background-color: {{VALUE}};',
                                ],
                            ]
                        );

                        $this->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name' => 'dots_border',
                                'label' => esc_html__( 'Border', 'moveaddons' ),
                                'selector' => '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet',
                            ]
                        );

                        $this->add_responsive_control(
                            'dots_border_radius',
                            [
                                'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                ],
                            ]
                        );

                $this->end_controls_tab();// Normal button style end

                // Button style Hover
                $this->start_controls_tab(
                    'sliderbtn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_style_arrow_heading',
                        [
                            'label' => esc_html__( 'Navigation', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area [class*="swiper-button"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                    $this->add_control(
                        'button_style_dotshov_heading',
                        [
                            'label' => esc_html__( 'Pagination', 'moveaddons' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'dots_hover_bg_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'dots_border_hover',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before,{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before',
                        ]
                    );

                    $this->add_responsive_control(
                        'dots_border_radius_hover',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet-active::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmove-slider-area .swiper-pagination .swiper-pagination-bullet:hover::before' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();// Hover button style end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Tab option end


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $column    = $this->get_settings_for_display('column');
        $testimonials = $this->get_settings_for_display('testimonial_list');
        $id        = $this->get_id();

        $collumval = 'htmove-col-5';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-testimonial-area' );
        if( $settings['slider_on'] != 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-row' );
        }
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        $this->add_render_attribute( 'item_attr', 'class', 'htmove-testimonial htmove-testimonial-'.$settings['testimonial_style'] );

        $this->add_render_attribute( 'item_attr', 'class', 'htmove-image-pos-'.$settings['thumbnail_pos'] );

        $this->add_render_attribute( 'item_attr', 'class', 'htmove-title-designation-'.$settings['title_designation_pos'] );

        $this->add_render_attribute( 'item_attr', 'class', ( $settings['slider_on'] === 'yes' ? 'swiper-slide' : $collumval ) );

        // Slider Option
        if( is_array( $testimonials ) ){
            $totalitem = count( $testimonials );
        }
        if( $settings['slider_on'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-slider-area' );
            $this->add_render_attribute( 'slider_attr', 'class', 'htmove-swiper-slider swiper-container' );

            $nexticon = ( !empty( $settings['next_icon']['value'] ) ? move_addons_render_icon( $settings, 'next_icon', 'nexticon' ) : '' );
            $previcon = ( !empty( $settings['prev_icon']['value'] ) ? move_addons_render_icon( $settings, 'prev_icon', 'previcon' ) : '' );

            $items = [
                'item'              => $settings['slider_item'],
                'desktop'           => $settings['desktop_item'],
                'tablet'            => $settings['tablet_item'],
                'small_mobile'      => $settings['small_mobile_item'],
                'large_mobile'      => $settings['large_mobile_item'],
                'landscape_mobile'  => $settings['landscape_mobile_item'],
            ];

            $slider_settings = [
                'slideitem'    => $items,
                'speed'        => absint( $settings['slider_speed'] ),
                'spacebetween' => absint( $settings['slider_spacebetween'] ),
                'loop'         => ( 'yes' === $settings['slider_loop'] ),
                'autoplay'=> ( 'yes' === $settings['slider_autoplay'] ),
                'autoplay_delay'=> absint( $settings['slider_autoplay_delay'] ),
                'navigation'   => ( 'yes' === $settings['slider_arrow'] ),
                'pagination'   => ( 'yes' === $settings['slider_dots'] ),
                'uniqid'       => $id,
                'style'        => $settings['testimonial_style'],
                'totalitem'    => $totalitem,
            ];
            $this->add_render_attribute( 'slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );

        }

        if( $settings['testimonial_style'] == 'two' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-testimonial-two' );
            $this->add_render_attribute( 'slider_attr', 'class', 'htmove-testimonial-sync-content' );
        }

        if( is_array( $testimonials ) ){
            echo '<div '.$this->get_render_attribute_string( 'area_attr' ).'>';

            if( $settings['testimonial_style'] == 'two' ){
                echo '<div class="swiper-container htmove-testimonial-sync-thumbnail"><div class="swiper-wrapper">';
                    foreach ( $testimonials as $testimonialimg ) {
                        if( !empty( $testimonialimg['client_image']['url'] ) ){
                            echo '<div class="swiper-slide htmove-testimonial-thumb">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $testimonialimg, 'client_imagesize', 'client_image' ).'</div>';
                        }

                    }
                echo '</div></div>';
            }


            if( $settings['slider_on'] === 'yes' ){
                echo '<div '.$this->get_render_attribute_string( 'slider_attr' ).'><div class="swiper-wrapper">';
            }
            foreach ( $testimonials as $testimonial ) {
            ?>
            <div <?php echo $this->get_render_attribute_string( 'item_attr' ); ?> >
                <?php
                    if( $settings['testimonial_style'] != 'two' ){
                        if( $settings['thumbnail_type'] == 'quote' ){
                            echo '<span class="htmove-testimonial-quote">'.move_addons_render_icon( $settings, 'quote_icon', 'quoteicon' ).'</span>';
                        }else{
                            if( !empty( $testimonial['client_image']['url'] ) ){
                                echo '<div class="htmove-testimonial-thumb">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' ).'</div>';
                            }
                        }
                    }
                ?>
                <!-- Testimonial Content Start -->
                <div class="htmove-testimonial-content">
                    <?php
                        if( !empty( $testimonial['client_say'] ) ){
                            echo '<div class="htmove-testimonial-text"><p>'.$testimonial['client_say'].'</p></div>';
                        }
                    ?>
                    <div class="htmove-testimonial-info">
                        <?php
                            if( !empty( $testimonial['client_name'] ) ){
                                echo '<h6 class="htmove-testimonial-name">'.esc_html__( $testimonial['client_name'], 'moveaddons' ).'</h6>';
                            }
                            if( !empty( $testimonial['client_designation'] ) ){
                                echo '<span class="htmove-testimonial-position">'.esc_html__( $testimonial['client_designation'], 'moveaddons' ).'</span>';
                            }
                        ?>
                    </div>
                </div>
                <!-- Testimonial Content End -->
            </div>
            <?php
            }
            if( $settings['slider_on'] === 'yes' ){ echo '</div></div>';
                if( $settings['slider_dots'] === 'yes' ){
                    echo '<div class="htmove-pagination-'.$id.' '.( $settings['slider_dots_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-pagination"></div></div>';
                }
                if( $settings['slider_arrow'] === 'yes' ){
                    echo '<div class="htmove-navigation-style-'.$settings['navigation_style'].' htmove-navigation-'.$id.' '.( $settings['slider_arrow_on_hover'] === 'yes' ? 'htmove-onhover': '' ).'"><div class="swiper-button-next">'.$nexticon.'</div><div class="swiper-button-prev">'.$previcon.'</div></div>';
                }
            }

            echo '</div>';
        }

    }

}