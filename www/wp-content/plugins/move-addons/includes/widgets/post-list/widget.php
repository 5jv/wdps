<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Post_List_Element extends Base {

    public function get_name() {
        return 'move-post-list';
    }

    public function get_title() {
        return esc_html__( 'Post List', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-editor-list-ul';
    }

    public function get_keywords() {
        return [ 'move', 'post list', 'list post', 'post','news list','list' ];
    }

    public function get_style_depends() {
        return ['move-postlist'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Post List', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'list_icon',
                [
                    'label'       => esc_html__( 'List Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'default' =>[
                        'value' => 'fas fa-long-arrow-alt-right',
                        'library' => 'solid',
                    ],
                    'label_block' => true,
                    'fa4compatibility' => 'listicon',
                ]
            );

            $this->add_control(
                'inline',
                [
                    'label' => esc_html__( 'Inline Style', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        // Query Options
        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__( 'Query Option', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'categories',
                [
                    'label' => esc_html__( 'Categories', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => move_addons_get_taxonomies(),
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label' => esc_html__('Limit', 'moveaddons'),
                    'type' => Controls_Manager::NUMBER,
                    'separator'=>'before',
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
                'postorder',
                [
                    'label' => esc_html__( 'Order', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending','moveaddons'),
                        'ASC'   => esc_html__('Ascending','moveaddons'),
                    ],
                    'condition' => [
                        'custom_order!' => 'yes',
                    ]
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

        $this->end_controls_section();

        /* Column Options */
        $this->start_controls_section(
            'column_option',
            [
                'label' => esc_html__( 'Column Option', 'moveaddons' ),
                'condition'=>[
                    'inline!'=>'yes',
                ],
            ]
        );

            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
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
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-row > [class*="col-"]' => 'margin-bottom:{{SIZE}}{{UNIT}};',
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
                'list_color',
                [
                    'label' => esc_html__( 'Text Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list li a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'list_hover_color',
                [
                    'label' => esc_html__( 'Text Hover Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => esc_html__( 'Text Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-post-list li',
                ]
            );

            $this->add_control(
                'list_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list-inline li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'inline'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list li a i' => 'color: {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_hover_color',
                [
                    'label' => esc_html__( 'Icon Hover Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list li a:hover i' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-post-list li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings  = $this->get_settings_for_display();
        $column    = $this->get_settings_for_display('column');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-post-list' );

        if( $settings['inline'] == 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-post-list-inline' );
        }

        $collumval = 'htmove-col-1';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }
        if( $settings['inline'] != 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-row' );
        }
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        $this->add_render_attribute( 'item_attr', 'class', ( $settings['inline'] === 'yes' ? '' : $collumval ) );

        $listicon = ( !empty( $settings['list_icon']['value'] ) ? move_addons_render_icon( $settings, 'list_icon', 'listicon' ) : '' );


        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');
        // Query
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 10,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        $get_categories = $settings['categories'];
        $grid_cats = str_replace(' ', '', $get_categories);
        if (  !empty( $get_categories ) ) {
            if( is_array($grid_cats) && count($grid_cats) > 0 ){
                $field_name = is_numeric( $grid_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'terms' => $grid_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $posts = new \WP_Query( $args );

        ?>                
        <ul <?php echo $this->get_render_attribute_string( 'area_attr' ); ?>>
            <?php
                if( $posts->have_posts() ){
                    while( $posts->have_posts() ) { 
                        $posts->the_post();
                        echo sprintf( '<li %s><a href="%s">%s<span>%s</span></a></li>', $this->get_render_attribute_string( 'item_attr' ), get_the_permalink(), $listicon, get_the_title() );
                    }
                    wp_reset_postdata(); wp_reset_query();
                }
            ?>
        </ul>
        <?php

    }

}