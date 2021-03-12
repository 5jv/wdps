<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Image_Grid_Element extends Base {

    public function get_name() {
        return 'move-image-grid';
    }

    public function get_title() {
        return esc_html__( 'Image Grid', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-gallery-grid';
    }

    public function get_keywords() {
        return [ 'move', 'image grid', 'grid', 'image', 'image gallery' ];
    }

    public function get_style_depends() {
        return ['move-imagegrid-masonry'];
    }

    public function get_script_depends() {
        return ['magnific-popup','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Image Grid', 'moveaddons' ),
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
                            'popuptype' => 'image',
                        ],
                        [
                            'title' => esc_html__('Image Two','moveaddons'),
                            'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                            'popuptype' => 'image',
                        ],
                        [
                            'title' => esc_html__('Image Three','moveaddons'),
                            'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                            'popuptype' => 'image',
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
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

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'imagesize',
                    'default' => 'full',
                    'separator' => 'none',
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
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-grid',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-image-grid',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings  = $this->get_settings_for_display();
        $column    = $this->get_settings_for_display('column');
        $images    = $this->get_settings_for_display('image_list');

        $collumval = 'htmove-col-3';
        if( $column !='' ){
            $collumval = 'htmove-col-'.$column;
        }

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-popup-gallery htmove-row' );

        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmoveno-gutters' );
        }

        $this->add_render_attribute( 'item_attr', 'class', $collumval );

        $size = $settings['imagesize_size'];
        $image_size = Null;
        if( $size === 'custom' ){
            $image_size = [
                $settings['imagesize_custom_dimension']['width'],
                $settings['imagesize_custom_dimension']['height']
            ];
        }else{ $image_size = $size; }

        if( is_array( $images ) ){

            echo '<div '.$this->get_render_attribute_string( 'area_attr' ).'>';
                foreach ( $images as $image ) {

                    $url = ( ( $image['popuptype'] == 'video' ) ? $image['video_url'] : ( ( $image['popuptype'] == 'link' ) ? $image['customlink'] : $image['image']['url'] ) );

                    $class = ( ( $image['popuptype'] == 'video' ) ? 'htmove-image-grid htmove-video-popup' : ( ( $image['popuptype'] == 'link' ) ? 'htmove-image-grid htmove-external-link' : 'htmove-image-grid' ) );

                    if( !empty( $image['image']['id'] ) ){
                        $imagehtml = wp_get_attachment_image( $image['image']['id'], $image_size );
                    }else{
                        $imagehtml = '<img src="'.$image['image']['url'].'" alt="'.$image['title'].'">';
                    }

                    $item = sprintf('<a href="%s" class="%s" data-elementor-open-lightbox="no">%s</a>', $url, $class, $imagehtml );

                    echo sprintf('<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'item_attr' ), $item );
                }
            echo '</div>';
        }

    }

}