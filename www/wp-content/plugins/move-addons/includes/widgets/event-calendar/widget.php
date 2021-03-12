<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Event_Calendar_Element extends Base {

    public function get_name() {
        return 'move-event-calendar';
    }

    public function get_title() {
        return esc_html__( 'Event Calendar', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-calendar';
    }

    public function get_keywords() {
        return [ 'move', 'event', 'calendar', 'event calendar' ];
    }

    public function get_style_depends() {
        return [ 'elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-event-calendar' ];
    }

    public function get_script_depends() {
        return [ 'move-locales-all' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'events_section',
            [
                'label' => esc_html__( 'Event List', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'event_source',
                [
                    'label'   => esc_html__( 'Event Source', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom' => esc_html__( 'Custom', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Event Title', 'moveaddons' ),
                    'placeholder' => esc_html__( 'Type your event title here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'all_day',
                [
                    'label'        => esc_html__('All Day', 'moveaddons'),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_block'  => false,
                    'return_value' => 'yes',
                ]
            );

            $repeater->add_control(
                'start_date',
                [
                    'label'     => esc_html__('Start Date', 'moveaddons'),
                    'type'      => Controls_Manager::DATE_TIME,
                    'default'   => date('Y-m-d H:i', current_time('timestamp', 0)),
                    'condition' => [
                        'all_day' => '',
                    ],
                ]
            );

            $repeater->add_control(
                'end_date',
                [
                    'label'     => esc_html__('End Date', 'moveaddons'),
                    'type'      => Controls_Manager::DATE_TIME,
                    'default'   => date('Y-m-d H:i', strtotime("+59 minute", current_time('timestamp', 0))),
                    'condition' => [
                        'all_day' => '',
                    ],
                ]
            );

            $repeater->add_control(
                'allday_start_date',
                [
                    'label'          => esc_html__('Start Date', 'moveaddons'),
                    'type'           => Controls_Manager::DATE_TIME,
                    'picker_options' => ['enableTime' => false],
                    'default'        => date('Y-m-d', current_time('timestamp', 0)),
                    'condition'      => [
                        'all_day' => 'yes',
                    ],
                ]
            );

            $repeater->add_control(
                'allday_end_date',
                [
                    'label'          => esc_html__('End Date', 'moveaddons'),
                    'type'           => Controls_Manager::DATE_TIME,
                    'picker_options' => ['enableTime' => false],
                    'default'        => date('Y-m-d', current_time('timestamp', 0)),
                    'condition'      => [
                        'all_day' => 'yes',
                    ],
                ]
            );

            $repeater->add_control(
                'bg_color',
                [
                    'label'   => esc_html__('Background Color', 'moveaddons'),
                    'type'    => Controls_Manager::COLOR,
                ]
            );

            $repeater->add_control(
                'text_color',
                [
                    'label'   => esc_html__('Text Color', 'moveaddons'),
                    'type'    => Controls_Manager::COLOR,
                ]
            );

            $repeater->add_control(
                'location',
                [
                    'label' => esc_html__( 'Location', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your event location here', 'moveaddons' ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'moveaddons' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => esc_html__( 'BioLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.Chemistry','moveaddons' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'event_list',
                [
                    'label'       => esc_html__('Event', 'moveaddons'),
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'title' => esc_html__( 'Event Title','moveaddons' ),
                            'description' => esc_html__( 'BioLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.Chemistry','moveaddons' ),
                        ],
                    ],
                    'condition'   => [
                        'event_source' => 'custom',
                    ],
                    'title_field' => '{{ title }}',
                ]
            );

        $this->end_controls_section();

        // Setting 
        $this->start_controls_section(
            'events_settings',
            [
                'label' => esc_html__( 'Settings', 'moveaddons' ),
            ]
        );

            $this->add_control(
                'event_layout',
                [
                    'label'   => esc_html__( 'Style', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one' => esc_html__( 'Style One', 'moveaddons' ),
                        'two' => esc_html__( 'Style Two', 'moveaddons' ),
                    ],
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'default_view',
                [
                    'label'   => esc_html__('Default View', 'moveaddons'),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'timeGridDay'  => esc_html__('Day', 'moveaddons'),
                        'timeGridWeek' => esc_html__('Week', 'moveaddons'),
                        'dayGridMonth' => esc_html__('Month', 'moveaddons'),
                        'listMonth'    => esc_html__('List', 'moveaddons'),
                    ],
                    'default' => 'dayGridMonth',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'first_day',
                [
                    'label'   => esc_html__('First Day of Week', 'moveaddons'),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        '0' => esc_html__('Sunday', 'moveaddons'),
                        '1' => esc_html__('Monday', 'moveaddons'),
                        '2' => esc_html__('Tuesday', 'moveaddons'),
                        '3' => esc_html__('Wednesday', 'moveaddons'),
                        '4' => esc_html__('Thursday', 'moveaddons'),
                        '5' => esc_html__('Friday', 'moveaddons'),
                        '6' => esc_html__('Saturday', 'moveaddons'),
                    ],
                    'default' => '0',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'language',
                [
                    'label'   => esc_html__('Language', 'moveaddons'),
                    'type'    => Controls_Manager::SELECT,
                    'options' => move_addons_language_code(),
                    'default' => 'en',
                    'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // Toolbar Style tab section
        $this->start_controls_section(
            'calendar_toolbar_style',
            [
                'label' => esc_html__( 'Toolbar', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'toolbar_title_heading',
                [
                    'label' => esc_html__('Title', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'toolbar_title_typography',
                    'label'    => esc_html__('Typography', 'moveaddons'),
                    'selector' => '{{WRAPPER}} .htmove-event-calendar .fc-toolbar h2',
                ]
            );

            $this->add_control(
                'toolbar_title_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-toolbar h2' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'toolbar_button_heading',
                [
                    'label'     => esc_html__('Button', 'moveaddons'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'toolbar_button_typography',
                    'label'    => esc_html__('Typography', 'moveaddons'),
                    'selector' => '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button',
                ]
            );

            $this->add_responsive_control(
                'toolbar_button_border_radius',
                [
                    'label'      => esc_html__('Border Radius', 'moveaddons'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('toolbar_button_style_tabs');

                $this->start_controls_tab(
                    'toolbar_button_normal',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'toolbar_button_color',
                        [
                            'label'     => esc_html__('Color', 'moveaddons'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button:not(.fc-button-active)' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'toolbar_button_background',
                        [
                            'label'     => esc_html__('Background', 'moveaddons'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button:not(.fc-button-active)' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name'     => 'toolbar_button_border',
                            'label'    => esc_html__('Border', 'moveaddons'),
                            'selector' => '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button:not(.fc-button-active)',
                        ]
                    );

                $this->end_controls_tab();

                // Active Button Style
                $this->start_controls_tab(
                    'toolbar_button_active',
                    [
                        'label' => esc_html__( 'Active', 'moveaddons' ),
                    ]
                );

                    $this->add_control(
                        'button_color_active',
                        [
                            'label'     => esc_html__('Color', 'moveaddons'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button.fc-button-active' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_background_active',
                        [
                            'label'     => esc_html__('Background', 'moveaddons'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button.fc-button-active' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name'     => 'button_border_active',
                            'label'    => esc_html__('Border', 'moveaddons'),
                            'selector' => '{{WRAPPER}} .htmove-event-calendar .fc-toolbar.fc-header-toolbar .fc-button.fc-button-active',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Day Style
        $this->start_controls_section(
            'calendar_day',
            [
                'label' => esc_html__('Day', 'moveaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name'     => 'day_background',
                    'label'    => esc_html__('Background', 'moveaddons'),
                    'types'    => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header',
                    'exclude'  => [
                        'image'
                    ],
                    'fields_options'=>[
                        'color'=>[
                            'label'=> esc_html__( 'Background Color', 'moveaddons' ),
                        ],
                    ],
                ]
            );

            $this->add_control(
                'day_border_color',
                [
                    'label'     => esc_html__('Border Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header .fc-col-header-cell' => 'border-color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'day_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header,{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header .fc-col-header-cell *' => 'color: {{VALUE}} !important;',

                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'day_typography',
                    'label'    => esc_html__('Typography', 'moveaddons'),
                    'selector' => '{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header',
                ]
            );

            $this->add_responsive_control(
                'day_alignment',
                [
                    'label'     => esc_html__('Alignment', 'moveaddons'),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'left'   => [
                            'title' => esc_html__('Left', 'moveaddons'),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'moveaddons'),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => esc_html__('Right', 'moveaddons'),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'default'   => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-col-header .fc-col-header-cell a' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // date Style
        $this->start_controls_section(
            'date_style',
            [
                'label' => esc_html__('Date', 'moveaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'date_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day-top .fc-daygrid-day-number' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'date_background',
                [
                    'type'      => Controls_Manager::COLOR,
                    'label'     => esc_html__('Background', 'moveaddons'),
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day' => 'background: {{VALUE}} !important',
                    ],
                ]
            );

            $this->add_control(
                'date_border_color',
                [
                    'type'      => Controls_Manager::COLOR,
                    'label'     => esc_html__('Border Color', 'moveaddons'),
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'date_typography',
                    'label'    => esc_html__('Typography', 'moveaddons'),
                    'selector' => '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day-top .fc-daygrid-day-number',
                ]
            );

            $this->add_responsive_control(
                'date_alignment',
                [
                    'label'     => esc_html__('Alignment', 'moveaddons'),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'flex-start'   => [
                            'title' => esc_html__('Left', 'moveaddons'),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'moveaddons'),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end'  => [
                            'title' => esc_html__('Right', 'moveaddons'),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'default'   => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day-top' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'date_today_heading',
                [
                    'label'     => esc_html__('Today', 'moveaddons'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'today_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'today_background',
                [
                    'type'      => Controls_Manager::COLOR,
                    'label'     => esc_html__('Background', 'moveaddons'),
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number' => 'background: {{VALUE}} !important',
                    ],
                ]
            );

        $this->end_controls_section();

        // List Style
        $this->start_controls_section(
            'calendar_list_view',
            [
                'label' => esc_html__('List view', 'moveaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'list_view_header_heading',
                [
                    'label' => esc_html__('Header', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'list_view_header_color',
                [
                    'label'     => esc_html__('Text Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-list-table tr > th .fc-cell-shaded' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'list_header_background_color',
                [
                    'label'     => esc_html__('Background Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-list-table tr > th' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'list_view_content_heading',
                [
                    'label' => esc_html__('Content', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'list_view_text_color',
                [
                    'label'     => esc_html__('Text Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-list-table tr > td.fc-list-event-time' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-event-calendar .fc-list-table tr > td.fc-list-event-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'list_bg_color',
                [
                    'label'     => esc_html__('Background Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-calendar .fc-list-table tr.fc-list-event td' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Pop Up style
        $this->start_controls_section(
            'popup_style',
            [
                'label' => esc_html__('Popup', 'moveaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'popup_header_heading',
                [
                    'label' => esc_html__('Header', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'popup_header_title_color',
                [
                    'label'     => esc_html__('Title Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-head .htmove-event-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'popup_title_typography',
                    'label' => esc_html__( 'Title Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-event-details-head .htmove-event-title',
                ]
            );

            $this->add_control(
                'popup_header_location_color',
                [
                    'label'     => esc_html__('Location Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-head .htmove-event-location' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'popup_location_typography',
                    'label' => esc_html__( 'Location Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-event-details-head .htmove-event-location',
                ]
            );

            $this->add_responsive_control(
                'popup_location_icon_size',
                [
                    'label'      => esc_html__('Location Icon Size', 'moveaddons'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-event-details-head .htmove-event-location i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'popup_header_background_color',
                [
                    'label'     => esc_html__('Header Background Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-head' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'popup_date_heading',
                [
                    'label' => esc_html__('Date', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'popup_date_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-content .htmove-event-date-time' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'popup_date_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-event-details-content .htmove-event-date-time',
                ]
            );

            $this->add_responsive_control(
                'popup_date_icon_size',
                [
                    'label'      => esc_html__('Icon Size', 'moveaddons'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors'  => [
                        '{{WRAPPER}} .htmove-event-details-content .htmove-event-date-time i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'popup_content_heading',
                [
                    'label' => esc_html__('Content', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'popup_content_color',
                [
                    'label'     => esc_html__('Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-content .htmove-event-desc' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .htmove-event-details-content .htmove-event-desc p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'popup_content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-event-details-content .htmove-event-desc,{{WRAPPER}} .htmove-event-details-content .htmove-event-desc p',
                ]
            );

            $this->add_control(
                'popup_close_icon_heading',
                [
                    'label' => esc_html__('Close Icon', 'moveaddons'),
                    'type'  => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'popup_close_icon_color',
                [
                    'label'     => esc_html__('Close Icon Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-head .htmove-event-details-close' => 'color: {{VALUE}};border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'popup_close_icon_hover_color',
                [
                    'label'     => esc_html__('Close Icon Hover Color', 'moveaddons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-event-details-head .htmove-event-details-close:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-event-calendar' );
        $this->add_render_attribute( 'area_attr', 'id', 'htmove-event-calendar-'.$id );

        if( $settings['event_layout'] == 'two' ){
            $this->add_render_attribute( 'area_attr', 'class', 'htmove-event-calendar-dark' );
        }

        $event_list = [];
        if( $settings['event_source'] == 'custom' ){
            $events = $settings['event_list'];
            foreach ( $events as $event ) {

                if ($event['all_day'] == 'yes') {
                    $start  = $event["allday_start_date"];
                    $end    = date('Y-m-d', strtotime("+1 days", strtotime($event["allday_end_date"])));
                    $pudate = date( 'F d Y', strtotime( $event["allday_start_date"] ) );
                    $putime = '';
                } else {
                    $start  = $event["start_date"];
                    $end    = date('Y-m-d H:i', strtotime($event["end_date"])).":01";
                    $pudate = date( 'F d Y', strtotime( $event["start_date"] ) );
                    $putime = date( 'g:i a', strtotime( $event["start_date"] ) ).' - '.date( 'g:i a', strtotime( $event["end_date"] ) );
                }

                $title = ( !empty( $event['title'] ) ? $event['title'] : esc_html__( 'Event Title', 'moveaddons' ) );
                $description = ( !empty( $event['description'] ) ? $event['description'] : '' );
                $location = ( !empty( $event['location'] ) ? '<span class="htmove-event-location"><i class="fas fa-map-marker-alt"></i>'.$event['location'].'</span>' : '' );

                $event_list[] = [
                    'title' => $title,
                    'start' => $start,
                    'end'   => $end,
                    'color' => $event['bg_color'],
                    'textColor' => $event['text_color'],
                    'display'   => 'block',
                    'extendedProps'=> [
                        'eventTitle'=> $title,
                        'address'=> $location,
                        'date'=> $pudate,
                        'time'=> $putime,
                        'description'=> $description,
                    ],
                ];
            }
        }

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                
            </div>

            <script type="text/javascript">
            /* Event Calendar */
            ;jQuery(document).ready(function($) {
                'use strict';
                var EventCalendarEl = document.getElementById('htmove-event-calendar-<?php echo $id; ?>');

                var defaultview = '<?php echo $settings['default_view']; ?>',
                    language = '<?php echo $settings['language']; ?>',
                    firstDay = '<?php echo $settings['first_day']; ?>';

                var EventCalendar = new FullCalendar.Calendar(EventCalendarEl, {
                    eventClick: function(info) {
                        var {
                            eventTitle,
                            address,
                            date,
                            time,
                            description
                        } = info.event.extendedProps,
                            html = `<div class="htmove-event-details-popup">
                                <div class="htmove-event-details">
                                    <div class="htmove-event-details-head">
                                        <h3 class="htmove-event-title">${eventTitle}</h3>
                                        ${address}
                                        <button class="htmove-event-details-close"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="htmove-event-details-content">
                                        <span class="htmove-event-date-time"><i class="far fa-calendar-alt"></i>${date +", "+ time}</span>
                                        <div class="htmove-event-desc">
                                            <p>${description}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        $(EventCalendarEl).append(html);
                    },
                    initialView: defaultview,
                    headerToolbar: {
                        start: 'prev today next',
                        center: 'title',
                        end: 'timeGridDay,timeGridWeek,dayGridMonth,listMonth',
                    },
                    events: <?php echo wp_json_encode( $event_list ); ?>,
                    locale: language,
                    firstDay: firstDay,
                    height: 'auto',
                    eventTimeFormat: {
                        hour:   'numeric',
                        minute: '2-digit'
                    },
                });
                EventCalendar.render();

                $('body').on('click', '.htmove-event-details-close', function() {
                    $(this).closest('.htmove-event-details-popup').remove();
                })

            });

            </script>
        <?php

    }

}