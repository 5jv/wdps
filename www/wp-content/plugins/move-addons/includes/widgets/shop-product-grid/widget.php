<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shop_Product_Grid_Element extends Base {

    public function get_name() {
        return 'move-shop-product-grid';
    }

    public function get_title() {
        return esc_html__( 'Shop Product Grid', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-products';
    }

    public function get_keywords() {
        return [ 'move', 'shop', 'product', 'grid', 'woocommerce', 'woocommerce grid' ];
    }

    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-shop-product-grid'];
    }

    public function get_script_depends() {
        return ['slick','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'    => esc_html__( 'Layout One', 'moveaddons' ),
                        'two'    => esc_html__( 'Layout Two', 'moveaddons' ),
                        'three'  => esc_html__( 'Layout Three', 'moveaddons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_setting_section',
            [
                'label' => esc_html__( 'Query Settings', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'product_grid_product_filter',
                [
                    'label' => esc_html__( 'Filter By', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent' => esc_html__( 'Recent Products', 'moveaddons' ),
                        'featured' => esc_html__( 'Featured Products', 'moveaddons' ),
                        'best_selling' => esc_html__( 'Best Selling Products', 'moveaddons' ),
                        'sale' => esc_html__( 'Sale Products', 'moveaddons' ),
                        'top_rated' => esc_html__( 'Top Rated Products', 'moveaddons' ),
                        'mixed_order' => esc_html__( 'Random Products', 'moveaddons' ),
                        'show_byid' => esc_html__( 'Show By Id', 'moveaddons' ),
                        'show_byid_manually' => esc_html__( 'Add ID Manually', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'product_id',
                [
                    'label' => esc_html__( 'Select Product', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => move_addons_get_post_list( 'product' ),
                    'condition' => [
                        'product_grid_product_filter' => 'show_byid',
                    ]
                ]
            );

            $this->add_control(
                'product_ids_manually',
                [
                    'label' => esc_html__( 'Product IDs', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
                        'product_grid_product_filter' => 'show_byid_manually',
                    ]
                ]
            );

            $this->add_control(
              'product_grid_products_count',
                [
                    'label'   => esc_html__( 'Product Limit', 'moveaddons' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 3,
                    'step'    => 1,
                ]
            );

            $this->add_control(
                'show_by_tagwise',
                [
                    'label' => esc_html__( 'Show Product By Tag Wise', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'product_grid_categories',
                [
                    'label' => esc_html__( 'Product Categories', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => move_addons_get_taxonomies('product_cat'),
                    'condition' => [
                        'show_by_tagwise!' => 'yes',
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'product_grid_tags',
                [
                    'label' => esc_html__( 'Product Tags', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => move_addons_get_taxonomies( 'product_tag' ),
                    'condition' => [
                        'show_by_tagwise' => 'yes',
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label' => esc_html__( 'Custom order', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__( 'Orderby', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None','moveaddons'),
                        'ID'            => esc_html__('ID','moveaddons'),
                        'date'          => esc_html__('Date','moveaddons'),
                        'name'          => esc_html__('Name','moveaddons'),
                        'title'         => esc_html__('Title','moveaddons'),
                        'comment_count' => esc_html__('Comment count','moveaddons'),
                        'rand'          => esc_html__('Random','moveaddons'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => esc_html__( 'order', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending','moveaddons'),
                        'ASC'   => esc_html__('Ascending','moveaddons'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        /* Content Options */
        $this->start_controls_section(
            'content_settings',
            [
                'label' => esc_html__( 'Content Setting', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'add_to_cart_text',
                [
                    'label' => esc_html__( 'Add to Cart Button Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Add To Cart', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your cart button text', 'moveaddons' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label'       => esc_html__( 'Add to Cart Button Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'buttonicon',
                    'default'=>[
                        'value'  => 'fas fa-plus',
                        'library'=> 'solid',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_align',
                [
                    'label'   => esc_html__( 'Add to Cart Icon Position', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', 'moveaddons' ),
                        'right'  => esc_html__( 'Right', 'moveaddons' ),
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_responsive_control(
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
                        'size' => 10,
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-button-icon-right .htmove-product .htmove-product-addtocart i'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-button-icon-left .htmove-product .htmove-product-addtocart i'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'badges_heading',
                [
                    'label' => esc_html__( 'Badges', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'sale_badge_txt',
                [
                    'label' => esc_html__( 'On Sale Product Badge', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'hot_badge_txt',
                [
                    'label' => esc_html__( 'Features Product Badge', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnailsize',
                    'default' => 'large',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'content_showing_heading',
                [
                    'label' => esc_html__( 'Content Display', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_badge',
                [
                    'label' => esc_html__( 'Product Badge', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__( 'Category', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_price',
                [
                    'label' => esc_html__( 'Price', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_rating',
                [
                    'label' => esc_html__( 'Rating', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        /* Column Options */
        $this->start_controls_section(
            'column_options',
            [
                'label' => esc_html__( 'Column Option', 'moveaddons' ),
            ]
        );

            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
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
                        'size' => 30,
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

        // Content Style tab section
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'content_title_heading',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_category_heading',
                [
                    'label' => esc_html__( 'Category', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'category_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-categories li a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'category_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-categories li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-categories li a',
                ]
            );

            $this->add_responsive_control(
                'category_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_price_heading',
                [
                    'label' => esc_html__( 'Price', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'price_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-prices span.woocommerce-Price-amount' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-prices span.woocommerce-Price-amount',
                ]
            );

            $this->add_responsive_control(
                'price_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-prices' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Action Button Style tab section
        $this->start_controls_section(
            'action_btn_style_section',
            [
                'label' => esc_html__( 'Action Button Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'action_btn_size',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'action_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('action_btn_style_tabs');
                
                // Button Normal
                $this->start_controls_tab(
                    'action_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'action_btn_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'action_btn_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'action_btn_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

                // Button Hover
                $this->start_controls_tab(
                    'action_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    $this->add_control(
                        'action_btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'action_btn_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'action_btn_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-action-primary li .htmove-product-action-btn:hover',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            // Add to Cart Button Style
            $this->add_control(
                'cart_button_heading',
                [
                    'label' => esc_html__( 'Add To Cart Button', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_btn_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart,{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart',
                ]
            );

            $this->add_responsive_control(
                'cart_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_btn_icon_size',
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
                        '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('cart_btn_style_tabs');
                
                // Cart Button Normal
                $this->start_controls_tab(
                    'cart_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'cart_btn_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'cart_btn_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart,{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'cart_btn_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart,{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();
                
                // Cart Button Hover
                $this->start_controls_tab(
                    'cart_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'cart_btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'cart_btn_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart:hover,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart:hover,{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart:hover,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'cart_btn_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .htmove-product-addtocart:hover,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .htmove-product-addtocart:hover,{{WRAPPER}} .htmove-product .htmove-product-content .htmove-product-heading .added_to_cart:hover,{{WRAPPER}} .htmove-product-three .htmove-product-thumbnail .added_to_cart:hover',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Badge Style tab section
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => esc_html__( 'Badge Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'badge_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge',
                ]
            );

            $this->add_responsive_control(
                'badge_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'sale_badge_color',
                [
                    'label' => esc_html__( 'Sale Badge Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge-sale' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sale_badge_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge-sale',
                    'exclude'=>['image'],
                    'fields_options'=>[
                        'background'=>[
                            'label'=>esc_html__( 'Sale Badge Background', 'moveaddons' )
                        ]
                    ],
                ]
            );

            $this->add_control(
                'hot_badge_color',
                [
                    'label' => esc_html__( 'Feature Badge Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge-hot' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hot_badge_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-product .htmove-product-thumbnail .htmove-product-badges .htmove-product-badge-hot',
                    'exclude'=>['image'],
                    'fields_options'=>[
                        'background'=>[
                            'label'=>esc_html__( 'Feature Badge Background', 'moveaddons' )
                        ]
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $product_type = $this->get_settings_for_display('product_grid_product_filter');
        $per_page  = $this->get_settings_for_display('product_grid_products_count');
        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $order           = $this->get_settings_for_display('order');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-product-grid htmove-row htmove-product-grid-'.$settings['layout'] );
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        // Query Argument
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'posts_per_page'        => $per_page,
        );

        if ( !empty( $settings['product_grid_categories'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $settings['product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ( !empty( $settings['product_grid_tags'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => $settings['product_grid_tags'],
                    'operator' => 'IN',
                ],
            ];
        }

        // Product Type Check
        switch( $product_type ){

            case 'sale':
                $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            break;

            case 'featured':
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                if ( !empty( $settings['product_grid_categories'] ) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => $settings['product_grid_categories'],
                            'operator' => 'IN',
                        ],
                    ];
                }
                if ( !empty( $settings['product_grid_tags'] ) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'product_tag',
                            'field'    => 'slug',
                            'terms'    => $settings['product_grid_tags'],
                            'operator' => 'IN',
                        ],
                    ];
                }
            break;

            case 'best_selling':
                $args['meta_key']   = 'total_sales';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';
            break;

            case 'top_rated': 
                $args['meta_key']   = '_wc_average_rating';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';          
            break;

            case 'mixed_order':
                $args['orderby']    = 'rand';
            break;

            case 'show_byid':
                $args['post__in'] = $settings['product_id'];
            break;

            case 'show_byid_manually':
                $args['post__in'] = explode( ',', $settings['product_ids_manually'] );
            break;

            default: /* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
            break;
        }

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        ?>
        <div class="woocommerce">
            <ul <?php echo $this->get_render_attribute_string( 'area_attr' ); ?>>
                <?php echo $this->get_products_content( $args, $settings ); ?>
            </ul>
        </div>
        <?php

    }

    public function get_products_content( $args, $settings ){

        $column = $settings['column'];
        $collumval = 'htmove-col-3';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }
        $item_class = array( 'htmove-product-grid-item', $collumval );

        // Add to Cart Button
        $cart_btn = $button_icon = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $item_class[] = 'htmove-button-icon-'.$settings['button_icon_align'];

            $button_icon = move_addons_render_icon( $settings, 'button_icon', 'buttonicon' );
        }
        $button_text  = ! empty( $settings['add_to_cart_text'] ) ? $settings['add_to_cart_text'] : '';

        if( 'right' === $settings['button_icon_align'] ){
            $cart_btn = $button_text.$button_icon;
        }else{
            $cart_btn = $button_icon.$button_text;
        }

        // Badge Text
        $onsale_badge = !empty( $settings['sale_badge_txt'] ) ? $settings['sale_badge_txt'] : 'Sale!';
        $feature_badge = !empty( $settings['hot_badge_txt'] ) ? $settings['hot_badge_txt'] : 'Hot!';

        // Thumbanail Image size
        $image_size = 'woocommerce_thumbnail';
        $size = $settings['thumbnailsize_size'];
        if( $size === 'custom' ){
            $image_size = [
                (int)$settings['thumbnailsize_custom_dimension']['width'],
                (int)$settings['thumbnailsize_custom_dimension']['height']
            ];
        }else{
            $image_size = $size;
        }

        $products = new \WP_Query( $args );

        ob_start();

        if( $products->have_posts() ){
            while ( $products->have_posts() ) {
                $products->the_post();
                $product = wc_get_product( get_the_ID() );

                // Add to cart Button Classes
                $btn_class = 'htmove-product-addtocart product_type_' . $product->get_type();

                $btn_class .= $product->is_purchasable() && $product->is_in_stock() ? ' add_to_cart_button' : '';

                $btn_class .= $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? ' ajax_add_to_cart' : '';


                $rating_width = ( ( $product->get_average_rating() / 5 ) * 100 );
                $rating_count = $product->get_rating_count();

            ?>
                <li class="<?php echo implode( " ", $item_class ); ?>">
                    <div class="htmove-product htmove-product-<?php echo $settings['layout']; ?>">
                        <div class="htmove-product-thumbnail">
                            
                            <?php if( ( $product->is_on_sale() || $product->get_featured() ) && ( $settings['show_badge'] == 'yes') ): ?>
                                <span class="htmove-product-badges">
                                    <?php if( $product->get_featured() ): ?>
                                        <span class="htmove-product-badge htmove-product-badge-hot"><?php echo esc_html__( $feature_badge, 'moveaddons'); ?></span>
                                    <?php endif; ?>

                                    <?php if( $product->is_on_sale() ): ?>
                                        <span class="htmove-product-badge htmove-product-badge-sale"><?php echo esc_html__( $onsale_badge, 'moveaddons'); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>

                            <a href="<?php echo $product->get_permalink(); ?>" class="htmove-product-image">
                                <?php echo $product->get_image($image_size); ?>
                            </a>
                            <ul class="htmove-product-action htmove-product-action-primary">
                                <?php
                                    if ( class_exists( 'YITH_WCWL' ) ) {
                                        echo '<li>'.move_addons_add_to_wishlist_button().'</li>';
                                    }

                                    if( class_exists('TInvWL_Public_AddToWishlist') ){
                                        echo '<li>';
                                            \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                        echo '</li>';
                                    }
                                
                                    if( class_exists('YITH_Woocompare_Frontend') ){
                                        echo '<li>';
                                            move_addons_compare_button(2);
                                        echo '</li>';
                                    }
                                ?>
                                <li>
                                    <a href="#" class="htmove-product-action-btn movequickview" data-quickid="<?php echo $product->get_id(); ?>">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </li>
                            </ul>
                            <?php if( $settings['layout'] == 'three' ): ?>
                                <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" class="<?php echo $btn_class; ?>" data-product_id="<?php echo $product->get_id(); ?>"><?php echo __( $cart_btn, 'moveaddons' );?></a>
                            <?php endif;?>
                        </div>
                        <div class="htmove-product-content">
                            <?php if( $settings['show_category'] == 'yes' ): ?>
                                <ul class="htmove-product-categories">
                                    <?php move_addons_get_taxonomie_list(2); ?>
                                </ul>
                            <?php endif; ?>
                            <h4 class="htmove-product-heading">
                                <a href="<?php echo $product->get_permalink(); ?>" class="htmove-product-title"><?php echo $product->get_title(); ?></a>
                                <?php if( $settings['layout'] != 'three' ): ?>
                                    <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" class="<?php echo $btn_class; ?>" data-product_id="<?php echo $product->get_id(); ?>"><?php echo __( $cart_btn, 'moveaddons' );?></a>
                                <?php endif; ?>
                            </h4>

                            <?php if( 0 < $rating_count && $settings['show_rating'] == 'yes' ): ?>
                                <div class="htmove-product-rattings">
                                    <span class="htmove-product-ratting">
                                        <span class="htmove-product-star" style="width:<?php echo esc_attr( $rating_width );?>%">
                                        </span>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if( $settings['show_price'] == 'yes' ): ?>
                            <div class="htmove-product-prices">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
            <?php
            }
        }else{
            echo __('<p>No product found.</p>', 'moveaddons');
        }

        wp_reset_postdata();
        return ob_get_clean();
    }

}