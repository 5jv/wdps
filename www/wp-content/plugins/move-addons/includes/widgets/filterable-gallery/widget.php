<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Filterable_Gallery_Element extends Base {

    public function get_name() {
        return 'move-filterable-gallery';
    }

    public function get_title() {
        return esc_html__( 'Filterable Gallery', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-gallery-grid';
    }

    public function get_keywords() {
        return [ 'move', 'filterable', 'gallery', 'filter' ];
    }

    public function get_style_depends() {
        return [ 'move-filterable-gallery' ];
    }

    public function get_script_depends() {
        return ['magnific-popup','masonry','isotope','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Filterable Gallery', 'moveaddons' ),
            ]
        );
            
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'popuptype',
                [
                    'label' => esc_html__( 'Popup Type', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'video'  => esc_html__( 'Pop Up Video', 'moveaddons' ),
                        'image'  => esc_html__( 'Pop Up Image', 'moveaddons' ),
                        'link'   => esc_html__( 'Custom Link', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'title',
                [
                    'label'   => esc_html__( 'Title', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'label_block'=>true,
                ]
            );

            $repeater->add_control(
                'image',
                [
                    'label' => esc_html__( 'Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $repeater->add_control(
                'filtername',
                [
                    'label'   => esc_html__( 'Filter Name', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'label_block'=>true,
                    'description' => esc_html__( 'Please add seperate by comma.', 'moveaddons' ),
                ]
            );

            $repeater->add_control(
                'video_url',
                [
                    'label'     => esc_html__( 'Video Url', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'https://www.youtube.com/watch?v=yDAC3JhW4jU', 'moveaddons' ),
                    'placeholder' => esc_html__( 'https://www.youtube.com/watch?v=yDAC3JhW4jU', 'moveaddons' ),
                    'label_block' => true,
                    'condition'=>[
                        'popuptype'=>'video',
                    ],
                ]
            );

            $repeater->add_control(
                'customlink',
                [
                    'label'     => esc_html__( 'Custom Link', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition'=>[
                        'popuptype'=>'link',
                    ],
                ]
            );

            $this->add_control(
                'image_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'title' => esc_html__('Image One','moveaddons'),
                            'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                            'filtername' => 'Design,Branding,Websites',
                            'popuptype' => 'image',
                        ],
                        [
                            'title' => esc_html__('Image Two','moveaddons'),
                            'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                            'filtername' => 'Design,Websites',
                            'popuptype' => 'image',
                        ],
                        [
                            'title' => esc_html__('Image Three','moveaddons'),
                            'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                            'filtername' => 'Design,Branding',
                            'popuptype' => 'image',
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

        $this->end_controls_section();

        /* Filter Options */
        $this->start_controls_section(
            'filter_option',
            [
                'label' => esc_html__( 'Option', 'moveaddons' ),
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'imagesize',
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'show_all',
                [
                    'label' => esc_html__( 'Show All Menu', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'all_menu_text',
                [
                    'label' => esc_html__( 'All Menu Text', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'All', 'moveaddons' ),
                    'condition'=>[
                        'show_all' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'active_menu_key',
                [
                    'label' => esc_html__( 'Active Menu Key', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );

        $this->end_controls_section();

        /* Column Options */
        $this->start_controls_section(
            'column_option',
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

        // Menu Style tab section
        $this->start_controls_section(
            'menu_style_section',
            [
                'label' => esc_html__( 'Menu Style', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'menu_style',
                [
                    'label' => esc_html__( 'Menu Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'One', 'moveaddons' ),
                        'two'   => esc_html__( 'Two', 'moveaddons' ),
                        'three' => esc_html__( 'Three', 'moveaddons' ),
                        'four'  => esc_html__( 'Four', 'moveaddons' ),
                        'five'  => esc_html__( 'Five', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-gallery-filter',
                ]
            );

            $this->add_control(
                'area_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-gallery-filter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'area_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-gallery-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-gallery-filter',
                ]
            );

            $this->add_responsive_control(
                'area_alignment',
                [
                    'label'   => esc_html__( 'Alignment', 'moveaddons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'    => [
                            'title' => esc_html__( 'Left', 'moveaddons' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'moveaddons' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'Right', 'moveaddons' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-gallery-filter > ul'   => 'justify-content: {{VALUE}};',
                    ],
                    'prefix_class'=>'htmove-menu-align-%s',
                ]
            );

            $this->add_control(
                'menu_item_heading',
                [
                    'label' => esc_html__( 'Menu Item', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'menu_item_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-gallery-filter > ul > li',
                ]
            );

            $this->add_control(
                'menu_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-gallery-filter > ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'menu_item_space',
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
                    'selectors' => [
                        '{{WRAPPER}} .htmove-gallery-filter > ul > li' => 'margin: 0 {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('menu_style_tabs');
                
                $this->start_controls_tab(
                    'menu_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'menu_normal_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-gallery-filter > ul > li' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'menu_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'menu_active_color',
                        [
                            'label'     => esc_html__( 'Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-gallery-filter > ul > li.active' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-gallery-filter > ul > li:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-gallery-filter-one > ul > li::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'menu_active_bg_before_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-gallery-filter-two > ul > li::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .htmove-gallery-filter-three > ul > li::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition'=>[
                                'menu_style'=>['two','three']
                            ]
                        ]
                    );

                    $this->add_control(
                        'menu_active_bg_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'moveaddons' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-gallery-filter-four > ul > li' => 'background-color: {{VALUE}};',
                            ],
                            'condition'=>[
                                'menu_style'=>['four']
                            ]
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings  = $this->get_settings_for_display();
        $column    = $this->get_settings_for_display('column');
        $images    = $this->get_settings_for_display('image_list');
        $id        = $this->get_id();

        $collumval = 'htmove-col-3';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }

        $activemenukey = !empty( $settings['active_menu_key'] ) ? '.1_'.$settings['active_menu_key'] : '*';

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-popup-gallery htmove-gallery-grid htmove-row' );
        $this->add_render_attribute( 'area_attr', 'id', 'filterable-gallery-'.$id );
        $this->add_render_attribute( 'area_attr', 'data-gallery-active', $activemenukey );

        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        $item_class = array( 'htmove-gallery-item', $collumval );

        $size = $settings['imagesize_size'];
        $image_size = Null;
        if( $size === 'custom' ){
            $image_size = [
                $settings['imagesize_custom_dimension']['width'],
                $settings['imagesize_custom_dimension']['height']
            ];
        }else{ $image_size = $size; }

        // Class Explode
        $classes = '';
        $i = 0;
        foreach ( $images as $item ) {
            if( $i == 0 ){
                $classes .= $item['filtername'];
            }else{
                $classes .= ','.$item['filtername'];
            }
            $i++;
        }

        $alltext = ( $settings['all_menu_text'] ? $settings['all_menu_text'] : esc_html__('All','moveaddons') );

        $classes = explode( ",", $classes );
        if( $settings['show_all'] == 'yes' ){
            $classes = array( 'allfi' => $alltext ) + $classes;
        }
        $preclasses = array_map( function($value) { return '1_'.$value; }, $classes );
        $preclasses = array_unique( $preclasses );

        ?>
            <div class="htmove-gallery-filter htmove-gallery-filter-<?php echo $settings['menu_style']; ?>">
                <ul data-target="#filterable-gallery-<?php echo $id; ?>">
                    <?php
                        foreach ( $preclasses as $key => $class ) {
                            if( $key === 'allfi' ){
                                echo '<li class="active" data-filter="*">'.esc_html( $classes[$key] ).'</li>';
                            }else{
                                echo '<li data-filter=".'.esc_attr( $class ).'">'.esc_html( $classes[$key] ).'</li>';
                            }
                        }
                    ?>
                </ul>
            </div>
        <?php

        if( is_array( $images ) ){

            echo '<div '.$this->get_render_attribute_string( 'area_attr' ).'><div class="htmove-gallery-sizer"></div>';
                foreach ( $images as $image ) {

                    $filter_class = explode( ",", $image['filtername'] );
                    $filter_class = array_map( function($value) { return '1_'.$value; }, $filter_class );

                    $url = ( ( $image['popuptype'] == 'video' ) ? $image['video_url'] : ( ( $image['popuptype'] == 'link' ) ? $image['customlink'] : $image['image']['url'] ) );

                    $class = ( ( $image['popuptype'] == 'video' ) ? 'htmove-image-grid htmove-video-popup' : ( ( $image['popuptype'] == 'link' ) ? 'htmove-image-grid htmove-external-link' : 'htmove-image-grid' ) );

                    if( !empty( $image['image']['id'] ) ){
                        $imagehtml = wp_get_attachment_image( $image['image']['id'], $image_size );
                    }else{
                        $imagehtml = '<img src="'.$image['image']['url'].'" alt="'.$image['title'].'">';
                    }

                    $item = sprintf('<a href="%s" class="%s" data-elementor-open-lightbox="no">%s</a>', $url, $class, $imagehtml );

                    echo sprintf('<div class="%1$s %2$s">%3$s</div>', implode( " ", $item_class ), implode(" ", $filter_class ), $item );
                }
            echo '</div>';
        }

    }

}