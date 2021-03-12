<?php
namespace MoveAddons\Elementor\Widget;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mailchimp_Element extends Base {

    public function get_name() {
        return 'move-mailchimp';
    }

    public function get_title() {
        return esc_html__( 'MailChimp', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-envelope';
    }

    public function get_keywords() {
        return [ 'move', 'mailchimp', 'mail', 'newsletter' ];
    }

    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid','move-mailchimp'];
    }

    public function get_script_depends() {
        return ['move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'MailChimp', 'moveaddons' ),
            ]
        );
        
            if ( ! move_addons_is_option('htmove_userdata_list','mailchimpapi','value') ) {
                $this->add_control(
                    'mailchimp_api_require_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => wp_kses_post( '<p>Please Insert Mailchimp API Key from Here</p>(<a href="'.admin_url("admin.php?page=move-elementor#userdata").'" target="_blank">Click</a>)', 'moveaddons' ),
                    ]
                );
            }else{
                $this->add_control(
                    'mailchimp_id',
                    [
                        'label' => esc_html__( 'Select list', 'moveaddons' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => array_merge( array( 0 => 'Select list'), move_addons_mailchimp() ),
                        'default' => '0'
                    ]
                );
            }

            $this->add_control(
                'style_type',
                [
                    'label'   => esc_html__( 'Layout', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'   => esc_html__( 'Layout One', 'moveaddons' ),
                        'two'   => esc_html__( 'Layout Two', 'moveaddons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // Fields Setting
        $this->start_controls_section(
            'fields_settings_section',
            [
                'label' => esc_html__( 'Settings', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'show_label',
                [
                    'label' => esc_html__( 'Show Label', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'no', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'email_heading',
                [
                    'label' => esc_html__( 'Email', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'email_label',
                [
                    'label'     => esc_html__( 'Email Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Your email', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_label'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'email_placeholder',
                [
                    'label'     => esc_html__( 'Email Placeholder', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Your email', 'moveaddons' ),
                    'default'   => esc_html__( 'Your email', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'email_icon',
                [
                    'label'       => esc_html__( 'Email Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'emailicon',
                ]
            );

            $this->add_control(
                'first_name_heading',
                [
                    'label' => esc_html__( 'First Name', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_first_name',
                [
                    'label' => esc_html__( 'Show First Name', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'no', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'first_name_label',
                [
                    'label'     => esc_html__( 'First Name Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'First Name', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_first_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'first_name_placeholder',
                [
                    'label'     => esc_html__( 'First Name Placeholder', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'First Name', 'moveaddons' ),
                    'default'   => esc_html__( 'First Name', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_first_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'firstname_icon',
                [
                    'label'       => esc_html__( 'First Name Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'firstnameicon',
                    'condition'=>[
                        'show_first_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'last_name_heading',
                [
                    'label' => esc_html__( 'Last Name', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_last_name',
                [
                    'label' => esc_html__( 'Show Last Name', 'moveaddons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'moveaddons' ),
                    'label_off' => esc_html__( 'no', 'moveaddons' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'last_name_label',
                [
                    'label'     => esc_html__( 'Last Name Label', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Last Name', 'moveaddons' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_label'=>'yes',
                        'show_last_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'last_name_placeholder',
                [
                    'label'         => esc_html__( 'Last Name Placeholder', 'moveaddons' ),
                    'type'          => Controls_Manager::TEXT,
                    'placeholder'   => esc_html__( 'Last Name', 'moveaddons' ),
                    'default'       => esc_html__( 'Last Name', 'moveaddons' ),
                    'label_block'   => true,
                    'condition'=>[
                        'show_last_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'lastname_icon',
                [
                    'label'       => esc_html__( 'Last Name Icon', 'moveaddons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'lastnameicon',
                    'condition'=>[
                        'show_last_name'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'submit_button_heading',
                [
                    'label' => esc_html__( 'Submit Button', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'submit_btn_text',
                [
                    'label'     => esc_html__( 'Submit Button Text', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Subscribe Now', 'moveaddons' ),
                    'default'   => esc_html__( 'Subscribe Now', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'submit_btn_loading_text',
                [
                    'label'     => esc_html__( 'Submit Button Loading Text', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Subscribing...', 'moveaddons' ),
                    'default'   => esc_html__( 'Subscribing...', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'message_heading',
                [
                    'label' => esc_html__( 'Message', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'success_msg',
                [
                    'label'     => esc_html__( 'Success Message', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Thank you for subscribed', 'moveaddons' ),
                    'default'   => esc_html__( 'Thank you for subscribed', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'error_msg',
                [
                    'label'     => esc_html__( 'Error Message', 'moveaddons' ),
                    'type'      => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Something went wrong', 'moveaddons' ),
                    'default'   => esc_html__( 'Something went wrong', 'moveaddons' ),
                    'label_block'=>true,
                ]
            );

        $this->end_controls_section();

        // Area Style tab section
        $this->start_controls_section(
            'area_style',
            [
                'label' => esc_html__( 'Area', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'area_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-mailchimp-form',
                ]
            );

            $this->add_control(
                'area_padding',
                [
                    'label' => __( 'Padding', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-mailchimp-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Input Box Style tab section
        $this->start_controls_section(
            'input_box_style',
            [
                'label' => esc_html__( 'Input Box', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'input_box_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'input_box_placeholder_color',
                [
                    'label' => esc_html__( 'Placeholder Text Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):-webkit-input-placeholder' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):-moz-placeholder' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])::-moz-placeholder' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):-ms-input-placeholder' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'input_box_focus_color',
                [
                    'label' => esc_html__( 'Focus Border Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):focus' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'input_box_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'input_box_border',
                    'label' => esc_html__( 'Border', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])',
                ]
            );

            $this->add_responsive_control(
                'input_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'input_box_background',
                    'label' => esc_html__( 'Background', 'moveaddons' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-form-control input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])',
                ]
            );

            $this->add_control(
                'input_box_icon_heading',
                [
                    'label' => esc_html__( 'Icon', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'input_box_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control .htmove-form-icon' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'input_box_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'moveaddons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-control .htmove-form-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Input Box Label Style tab section
        $this->start_controls_section(
            'input_box_label_style',
            [
                'label' => esc_html__( 'Label', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'input_box_label_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-label' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'input_box_label_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-form-label',
                ]
            );

            $this->add_responsive_control(
                'input_box_label_margin',
                [
                    'label' => esc_html__( 'Margin', 'moveaddons' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-form-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Submit Button Style tab section
        $this->start_controls_section(
            'submit_button_style',
            [
                'label' => esc_html__( 'Submit Button', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('submit_btn_style_tabs');
                
                $this->start_controls_tab(
                    'submit_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'submit_btn_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'submit_btn_typography',
                            'label' => esc_html__( 'Typography', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'submit_btn_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'submit_btn_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'moveaddons' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'submit_btn_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn',
                        ]
                    );

                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'submit_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'moveaddons' ),
                    ]
                );
                    
                    $this->add_control(
                        'submit_btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'moveaddons' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'submit_btn_hover_background',
                            'label' => esc_html__( 'Background', 'moveaddons' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'submit_btn_hover_border',
                            'label' => esc_html__( 'Border', 'moveaddons' ),
                            'selector' => '{{WRAPPER}} .htmove-form-control button.htmove-submit-btn:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Message Style tab section
        $this->start_controls_section(
            'message_style',
            [
                'label' => esc_html__( 'Message', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'success_message_heading',
                [
                    'label' => esc_html__( 'Success Message', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'success_msg_color',
                [
                    'label' => esc_html__( 'Success Message Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-message .htmove-success' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'success_msg_typography',
                    'label' => esc_html__( 'Success Message Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-message .htmove-success',
                ]
            );

            $this->add_control(
                'error_message_heading',
                [
                    'label' => esc_html__( 'Error Message', 'moveaddons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'error_msg_color',
                [
                    'label' => esc_html__( 'Error Message Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-message .htmove-error' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'error_msg_typography',
                    'label' => esc_html__( 'Error Message Typography', 'moveaddons' ),
                    'selector' => '{{WRAPPER}} .htmove-message .htmove-error',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-mailchimp-form htmove-mailchimp-form-'.$settings['style_type'] );

        $data_settings = [
            'mailchimpid'  => ( !empty( $settings['mailchimp_id'] ) ? $settings['mailchimp_id'] : Null ),
            'btntxt'  => ( !empty( $settings['submit_btn_text'] ) ? $settings['submit_btn_text'] : 'Subscribe Now' ),
            'loadingtxt'  => ( !empty( $settings['submit_btn_loading_text'] ) ? $settings['submit_btn_loading_text'] : Null ),
            'success_msg'  => ( !empty( $settings['success_msg'] ) ? $settings['success_msg'] : Null ),
            'error_msg'  => ( !empty( $settings['error_msg'] ) ? $settings['error_msg'] : Null )
        ];
        $this->add_render_attribute( 'area_attr', 'data-settings', wp_json_encode( $data_settings ) );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

            <div class="htmove-message" style="display: none;"></div>

            <form id="htmove-mailchimp-<?php echo $id; ?>" method="post">

                <div class="htmove-form-group">
                    <?php
                        if( $settings['show_label'] == 'yes' ){
                            echo '<label for="htmove-email-'.$id.'" class="htmove-form-label">'.esc_html__( $settings['email_label'],'moveaddons' ).'</label>';
                        }
                    ?>
                    <div class="htmove-form-control">
                        <?php 
                            if( !empty( $settings['email_icon']['value'] ) ){
                                echo '<span class="htmove-form-icon">'.move_addons_render_icon( $settings, 'email_icon', 'emailicon' ).'</span>';
                            }
                        ?>
                        <input id="htmove-email-<?php echo $id; ?>" name="email" type="email" placeholder="<?php echo esc_attr__( $settings['email_placeholder'], 'moveaddons' ); ?>" required />
                    </div>
                </div>

                <?php if( $settings['show_first_name'] == 'yes' ): ?>
                    <div class="htmove-form-group">
                        <?php
                            if( $settings['show_label'] == 'yes' ){
                                echo '<label for="htmove-first-name-'.$id.'" class="htmove-form-label">'.esc_html__( $settings['first_name_label'],'moveaddons' ).'</label>';
                            }
                        ?>
                        <div class="htmove-form-control">
                            <?php 
                                if( !empty( $settings['firstname_icon']['value'] ) ){
                                    echo '<span class="htmove-form-icon">'.move_addons_render_icon( $settings, 'firstname_icon', 'firstnameicon' ).'</span>';
                                }
                            ?>
                            <input id="htmove-first-name-<?php echo $id; ?>" 
                            name="first_name" type="text" placeholder="<?php echo esc_attr__( $settings['first_name_placeholder'], 'moveaddons' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( $settings['show_last_name'] == 'yes' ): ?>
                    <div class="htmove-form-group">
                        <?php
                            if( $settings['show_label'] == 'yes' ){
                                echo '<label for="htmove-last-name-'.$id.'" class="htmove-form-label">'.esc_html__( $settings['last_name_label'],'moveaddons' ).'</label>';
                            }
                        ?>
                        <div class="htmove-form-control">
                            <?php 
                                if( !empty( $settings['lastname_icon']['value'] ) ){
                                    echo '<span class="htmove-form-icon">'.move_addons_render_icon( $settings, 'lastname_icon', 'lastnameicon' ).'</span>';
                                }
                            ?>
                            <input id="htmove-last-name-<?php echo $id; ?>" name="last_name" type="text" placeholder="<?php echo esc_attr__( $settings['last_name_placeholder'], 'moveaddons' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="htmove-form-group">
                    <div class="htmove-form-control">
                        <button type="submit" class="htmove-submit-btn"><?php echo esc_html__( $settings['submit_btn_text'], 'moveaddons' ); ?></button>
                    </div>
                </div>

            </form>
        </div>
        <?php

    }

}