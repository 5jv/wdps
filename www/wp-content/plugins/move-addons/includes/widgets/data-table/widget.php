<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Data_Table_Element extends Base {

    public function get_name() {
        return 'move-data-table';
    }

    public function get_title() {
        return esc_html__( 'Data Table', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-table';
    }

    public function get_keywords() {
        return [ 'move', 'data', 'table', 'data table' ];
    }

    public function get_style_depends() {
        return ['move-data-table'];
    }

    public function get_script_depends() {
        return ['move-data-tables'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'table_layout_section',
            [
                'label' => esc_html__( 'Table Layout', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'table_layout',
                [
                    'label' => esc_html__( 'Layout', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Layout One', 'moveaddons' ),
                        'two'   => esc_html__( 'Layout Two', 'moveaddons' ),
                        'three' => esc_html__( 'Layout Three', 'moveaddons' ),
                        'four'  => esc_html__( 'Layout Four', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'show_datatable_sorting',
                [
                    'label' => esc_html__( 'Show Sorting Options', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        // Sorting Options
        $this->start_controls_section(
            'datatable_sorting_options',
            [
                'label' => esc_html__( 'Sorting Options', 'moveaddons' ),
                'condition'=>[
                    'show_datatable_sorting'=>'yes',
                ]
            ]
        );

            $this->add_control(
                'show_datatable_paging',
                [
                    'label' => esc_html__( 'Pagination', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_datatable_searching',
                [
                    'label' => esc_html__( 'Searching', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show_datatable_ordering',
                [
                    'label' => esc_html__( 'Ordering', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_datatable_info',
                [
                    'label' => esc_html__( 'Footer Info', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'moveaddons' ),
                    'label_off' => esc_html__( 'Hide', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'table_header_section',
            [
                'label' => esc_html__( 'Table Header', 'moveaddons' ),
            ]
        );
            
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'column_name',
                [
                    'label'   => esc_html__( 'Column Name', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'header_column_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'column_name' => esc_html__( 'Rank', 'moveaddons' ),
                        ],
                        [
                            'column_name' => esc_html__( 'Movie Title', 'moveaddons' ),
                        ],
                        [
                            'column_name' => esc_html__( 'Year', 'moveaddons' ),
                        ],
                        [
                            'column_name' => esc_html__( 'Rating', 'moveaddons' ),
                        ],
                        [
                            'column_name' => esc_html__( 'Reviews', 'moveaddons' ),
                        ]

                    ],
                    'title_field' => '{{{ column_name }}}',
                ]
            );

        $this->end_controls_section();

        // Table Content
        $this->start_controls_section(
            'table_content_section',
            [
                'label' => esc_html__( 'Table Content', 'moveaddons' ),
            ]
        );
            
            $repeater_one = new \Elementor\Repeater();

            $repeater_one->add_control(
                'field_type',
                [
                    'label' => esc_html__( 'Fild Type', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'row',
                    'options' => [
                        'row'   => esc_html__( 'Row', 'moveaddons' ),
                        'col'   => esc_html__( 'Column', 'moveaddons' ),
                    ],
                    'label_block' => true,
                ]
            );

            $repeater_one->add_control(
                'content_type',
                [
                    'label' => esc_html__( 'Content Type', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'text',
                    'options' => [
                        'text'   => esc_html__( 'Text', 'moveaddons' ),
                        'image'  => esc_html__( 'Image', 'moveaddons' ),
                    ],
                    'label_block' => true,
                    'condition'=>[
                        'field_type'=>'col',
                    ],
                ]
            );

            $repeater_one->add_control(
                'cell_text',
                [
                    'label'   => esc_html__( 'Cell Content', 'moveaddons' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Cell Content', 'moveaddons' ),
                    'condition'=>[
                        'field_type'=>'col',
                        'content_type'=>'text',
                    ],
                    'label_block' => true,
                ]
            );

            $repeater_one->add_control(
                'cell_image',
                [
                    'label'   => esc_html__( 'Cell Image', 'moveaddons' ),
                    'type'    => Controls_Manager::MEDIA,
                    'condition'=>[
                        'field_type'=>'col',
                        'content_type'=>'image',
                    ],
                    'label_block' => true,
                ]
            );

            $repeater_one->add_control(
                'row_colspan',
                [
                    'label' => esc_html__( 'Colspan', 'moveaddons' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'step' => 1,
                    'default' => 1,
                    'condition'=>[
                        'field_type'=>'col',
                    ],
                ]
            );

            $this->add_control(
                'content_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater_one->get_controls(),
                    'default' => [
                        [
                            'field_type' => esc_html__( 'row', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '1', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( 'Avenger: End Game', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '2019', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '100%', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '75', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],

                        [
                            'field_type' => esc_html__( 'row', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '2', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( 'Batman Return', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '2014', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '97%', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '64', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],

                        [
                            'field_type' => esc_html__( 'row', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '3', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( 'The Dark Knight', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '2009', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '97%', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],
                        [
                            'field_type'  => esc_html__( 'col', 'moveaddons' ),
                            'cell_text'   => esc_html__( '87', 'moveaddons' ),
                            'row_colspan' => esc_html__( '1', 'moveaddons' ),
                        ],

                    ],
                    'title_field' => '{{{ field_type }}}',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'table_style_section',
            [
                'label' => esc_html__( 'Table', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'datatable_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'datatable_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table',
                ]
            );

            $this->add_responsive_control(
                'datatable_padding',
                [
                    'label' => esc_html__( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'datatable_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'datatable_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table',
                ]
            );

            $this->add_responsive_control(
                'datatable_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Table Header Style tab section
        $this->start_controls_section(
            'table_header_style_section',
            [
                'label' => esc_html__( 'Table Header', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'datatable_header_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table thead tr th' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'datatable_header_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table thead tr th' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'datatable_header_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table thead tr th',
                ]
            );

            $this->add_responsive_control(
                'datatable_header_padding',
                [
                    'label' => esc_html__( 'Table Header Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'datatable_header_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table thead tr th',
                ]
            );

            $this->add_responsive_control(
                'datatable_header_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table thead tr th' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'datatable_header_align',
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
                        '{{WRAPPER}} .htmove-data-table thead tr th' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Table Body Style tab section
        $this->start_controls_section(
            'table_body_style_section',
            [
                'label' => esc_html__( 'Table Body', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'datatable_body_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table tbody tr td',
                ]
            );

            $this->add_responsive_control(
                'datatable_body_padding',
                [
                    'label' => esc_html__( 'Table Body Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'datatable_body_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table tbody tr td',
                ]
            );

            $this->add_responsive_control(
                'datatable_body_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table tbody tr td' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'datatable_body_align',
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
                        '{{WRAPPER}} .htmove-data-table tbody tr td' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );


            $this->start_controls_tabs('cell_style_tabs');
                
                $this->start_controls_tab(
                    'cell_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'datatable_body_bg_color',
                        [
                            'label' => esc_html__( 'Background Color ( Event )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:nth-child(even)' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_odd_bg_color',
                        [
                            'label' => esc_html__( 'Background Color ( Odd )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:nth-child(odd)' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_text_color_event',
                        [
                            'label' => esc_html__( 'Text Color ( Event )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:nth-child(even) td' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_text_color_odd',
                        [
                            'label' => esc_html__( 'Text Color ( Odd )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:nth-child(odd) td' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'cell_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'datatable_body_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color ( Event )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:hover:nth-child(even) td' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_odd_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background Color ( Odd )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:hover:nth-child(odd) td' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_hover_text_color_event',
                        [
                            'label' => esc_html__( 'Text Color ( Event )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:hover:nth-child(even) td' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'datatable_body_hover_text_color_odd',
                        [
                            'label' => esc_html__( 'Text Color ( Odd )', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-data-table tbody tr:hover:nth-child(odd) td' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Table Cell image Style tab section
        $this->start_controls_section(
            'table_cell_image_style_section',
            [
                'label' => esc_html__( 'Cell image', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'cell_image_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-data-table .htmove-thumb-circle',
                ]
            );

            $this->add_responsive_control(
                'cell_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-data-table .htmove-thumb-circle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();
        $headeres   = $this->get_settings_for_display('header_column_list');
        $content_list = $this->get_settings_for_display('content_list');

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-data-table htmove-data-table-'.$settings['table_layout'] );

        $table_tr = [];
        $table_td = [];

        if( is_array($content_list) ){
            foreach( $content_list as $content_row ) {

                $row_id = rand(0, 1000);
                if( $content_row['field_type'] == 'row' ) {
                    $table_tr[] = [
                        'id'   => $id.$row_id,
                        'type' => $content_row['field_type'],
                    ];
                }
                if( $content_row['field_type'] == 'col' ) {

                    $table_tr_keys = array_keys( $table_tr );
                    $last_key      = end( $table_tr_keys );

                    $table_td[] = [
                        'row_id'  => $table_tr[$last_key]['id'],
                        'title'   => ( $content_row['content_type'] == 'image' ? wp_get_attachment_image( $content_row['cell_image']['id'], 'full', false, array( 'class'=>'htmove-thumb-circle' ) ) : $content_row['cell_text'] ),
                        'colspan' => $content_row['row_colspan'],
                    ];
                }

            }
        }

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <table class="<?php if( $settings['show_datatable_sorting'] == 'yes' ){ echo 'htmove-datatable-'.$id; } ?>">
                    <?php if( is_array( $headeres ) ): ?>
                        <thead>
                            <tr>
                                <?php 
                                    foreach ( $headeres as $header ) {
                                        echo '<th>'.esc_html__( $header['column_name'],'moveaddons' ).'</th>';
                                    }
                                ?>
                            </tr>
                        </thead>
                    <?php endif;?>

                    <tbody>
                    <?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
                        <tr>
                            <?php
                                for( $j = 0; $j < count( $table_td ); $j++ ):
                                    if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ):
                            ?>
                                <td<?php echo $table_td[$j]['colspan'] > 1 ? ' colspan="'.$table_td[$j]['colspan'].'"' : ''; ?>><?php echo $table_td[$j]['title']; ?></td>
                            <?php endif; endfor; ?>
                        </tr>
                    <?php endfor;?>
                    </tbody>

                </table>
            </div>
            <?php if( $settings['show_datatable_sorting'] == 'yes' ): ?>
                <script>
                    ;jQuery(document).ready(function($) {
                        'use strict';
                        $('.htmove-datatable-<?php echo $id; ?>').DataTable({
                            paging: <?php echo $settings['show_datatable_paging'] == 'yes' ? 'true' : 'false'; ?>,
                            searching: <?php echo $settings['show_datatable_searching'] == 'yes' ? 'true' : 'false'; ?>,
                            ordering:  <?php echo $settings['show_datatable_ordering'] == 'yes' ? 'true' : 'false'; ?>,
                            "info": <?php echo $settings['show_datatable_info'] == 'yes' ? 'true' : 'false'; ?>,
                        });
                    });
                </script>
            <?php endif;?>

        <?php

    }

}