<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Page_List_Element extends Base {

    public function get_name() {
        return 'move-page-list';
    }

    public function get_title() {
        return esc_html__( 'Page List', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-editor-list-ul';
    }

    public function get_keywords() {
        return [ 'move', 'page', 'pages', 'page list' ];
    }

    public function get_style_depends() {
        return ['move-page-category-list'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Page List', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Select Layout', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'vertical',
                    'options' => [
                        'vertical'   => esc_html__( 'Vertical','moveaddons' ),
                        'horizontal' => esc_html__('Horizontal','moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'catorder',
                [
                    'label' => esc_html__( 'Order', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'ASC',
                    'options' => [
                        'ASC'   => esc_html__('Ascending','moveaddons'),
                        'DESC'  => esc_html__('Descending','moveaddons'),
                    ],
                ]
            );

            $this->add_control(
                'limitcount',
                [
                    'label' => esc_html__( 'Show items', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                ]
            );

        $this->end_controls_section();

        // Additional Option
        $this->start_controls_section(
            'section_additional_option',
            array(
                'label' => esc_html__( 'Additional Option', 'moveaddons' ),
            )
        );
            
            $this->add_control(
                'list_icon_style',
                [
                    'label' => esc_html__( 'Icon Style', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'one'   => esc_html__('Style One','moveaddons'),
                        'two'   => esc_html__('Style Two','moveaddons'),
                        'custom'=> esc_html__('Custom Icon','moveaddons'),
                    ],
                ]
            );

            $this->add_control(
                'list_icon',
                [
                    'label' => esc_html__( 'List Icon', 'moveaddons' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'listicon',
                    'default' => [
                        'value' => 'fas fa-plus',
                        'library' => 'solid',
                    ],
                    'condition'=>[
                        'list_icon_style'=>'custom',
                    ]
                ]
            );

            $this->add_control(
                'add_custom_subtitle',
                [
                    'label' => esc_html__( 'Custom Sub Title', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'No', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'select_page',
                [
                    'label' => esc_html__( 'Select Page', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options' => move_addons_get_post_list( 'page', ['limit'=>-1] ),
                ]
            );

            $repeater->add_control(
                'custom_subtitle',
                [
                    'label' => esc_html__( 'Sub Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );

            $repeater->add_control(
                'custom_badge',
                [
                    'label' => esc_html__( 'Badge', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'custom_subtitle_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'select_page' => '',
                        ]
                    ],
                    'title_field' => '{{{ custom_subtitle }}}',
                    'condition' => [
                        'add_custom_subtitle' => 'yes',
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
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-page-list li a' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-page-list.htmove-page-list-icon-style-one li a::before' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-page-list.htmove-page-list-icon-style-two li a::before' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'list_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-page-list li a',
                ]
            );

            $this->add_control(
                'space_between',
                [
                    'label' => esc_html__( 'Space between', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-page-list-horizontal li + li' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htmove-page-list li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'list_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-page-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'customdata_style',
            [
                'label' => esc_html__( 'Custom Title / Badge', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'add_custom_subtitle'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'custom_subtitle_heading',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'sub_title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-page-list li a small' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-page-list li a small',
                ]
            );

            $this->add_control(
                'custom_badge_heading',
                [
                    'label' => esc_html__( 'Badge', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'badge_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-page-list li a small .htmove-badge' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'badge_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-page-list li a small .htmove-badge',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'badge_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-page-list li a small .htmove-badge',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $order      = $this->get_settings_for_display('catorder');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-page-list' );
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-page-list-'.$settings['layout'] );

        if( $settings['list_icon_style'] != 'custom' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-page-list-icon-style-'.$settings['list_icon_style'] );
        }

        $arg = [
            'sort_order' => $order,
            'sort_column'=> 'post_title',
        ];
        $pages = get_pages( $arg );

        $icon = '';
        if( !empty( $settings['list_icon']['value'] ) ){
            $icon = move_addons_render_icon( $settings, 'list_icon', 'listicon' );
        }

        // Custom Title and Badge
        $customdata = [];
        if( $settings['add_custom_subtitle'] == 'yes' ){
            $subtitles = $settings['custom_subtitle_list'];
            if( is_array( $subtitles ) ){
                foreach ( $subtitles as $subtitle ) {
                    $customdata[$subtitle['select_page']] = [
                        'subtitle' => $subtitle['custom_subtitle'],
                        'badge'    => $subtitle['custom_badge'],
                    ];
                }
            }
        }

        ?>              
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
        <?php
            $i = 0;
            if( is_array( $pages ) ){
                echo '<ul>';
                    foreach ( $pages as $pagekey => $page ) {
                        $i++;
                        $link = get_page_link( $page->ID );
                        if( array_key_exists( $page->ID, $customdata ) ){

                            $subtitle = !empty( $customdata[$page->ID]['subtitle'] ) ? $customdata[$page->ID]['subtitle'] : '';
                            $badge = !empty( $customdata[$page->ID]['badge'] ) ? '<span class="htmove-badge">'.$customdata[$page->ID]['badge'].'</span>' : '';

                            echo sprintf('<li><a href="%1$s"><span>%2$s %3$s</span> <small>%4$s %5$s</small></a></li>', esc_url( $link ), $icon, esc_html__( $page->post_title, 'moveaddons' ), $subtitle, $badge  );
                        }else{
                            echo sprintf('<li><a href="%1$s"><span>%2$s %3$s</span></a></li>',esc_url( $link ),$icon,esc_html__( $page->post_title, 'moveaddons' ) );
                        }

                        if( $settings['limitcount'] == $i ){break;}
                    }
                echo '</ul>';
            }
        ?>
        </div>
        <?php

    }

}