<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tooltip_Element extends Base {

    public function get_name() {
        return 'move-tooltip';
    }

    public function get_title() {
        return esc_html__( 'Tooltip', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-alert';
    }

    public function get_keywords() {
        return [ 'move', 'tooltip', 'tool', 'alert' ];
    }

    public function get_style_depends() {
        return ['move-tooltip'];
    }

    public function get_script_depends() {
        return ['move-tippy-bundle','move-main'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'tooltip_button_section',
            [
                'label' => esc_html__( 'Tooltip Button', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'btn_image',
                [
                    'label' => esc_html__( 'Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'btn_image_size',
                    'default' => 'full',
                    'separator' => 'none',
                    'condition'=>[
                        'btn_image[url]!'=>'',
                    ]
                ]
            );

        $this->end_controls_section();

        // Tooltip Conent
        $this->start_controls_section(
            'tooltip_content_section',
            [
                'label' => esc_html__( 'Tooltip Content', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'tp_title',
                [
                    'label' => esc_html__( 'Tooltip Title', 'moveaddons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'tp_content',
                [
                    'label' => esc_html__( 'Tooltip Content', 'moveaddons' ),
                    'type' => Controls_Manager::TEXTAREA,
                ]
            );

            $this->add_control(
                'tp_image',
                [
                    'label' => esc_html__( 'Tooltip Image', 'moveaddons' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'tp_image_size',
                    'default' => 'full',
                    'separator' => 'none',
                    'condition'=>[
                        'tp_image[url]!'=>'',
                    ]
                ]
            );

        $this->end_controls_section();

        // Tooltip Setting
        $this->start_controls_section(
            'tooltip_setting_section',
            [
                'label' => esc_html__( 'Tooltip Setting', 'moveaddons' ),
            ]
        );
            
            $this->add_control(
                'tooltip_placement',
                [
                    'label' => esc_html__( 'Tooltip Position', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'right' => esc_html__( 'Right', 'moveaddons' ),
                        'left'  => esc_html__( 'Left', 'moveaddons' ),
                        'bottom'=> esc_html__( 'Bottom', 'moveaddons' ),
                        'top'   => esc_html__( 'Top', 'moveaddons' ),
                    ],
                ]
            );

            $this->add_control(
                'tooltip_theme',
                [
                    'label' => esc_html__( 'Theme', 'moveaddons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'light',
                    'options' => [
                        'light' => esc_html__( 'Light', 'moveaddons' ),
                        'dark'  => esc_html__( 'Dark', 'moveaddons' ),
                    ],
                ]
            );

        $this->end_controls_section();

        // Title Style tab section
        $this->start_controls_section(
            'tooltip_title_style',
            [
                'label' => esc_html__( 'Title', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'tp_title!'=>'',
                ],
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'tooltip_title_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

        $this->end_controls_section();

        // Content Style tab section
        $this->start_controls_section(
            'tooltip_content_style',
            [
                'label' => esc_html__( 'Content', 'moveaddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'tp_content!'=>'',
                ],
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => esc_html__( 'Typography', 'moveaddons' ),
                ]
            );

            $this->add_control(
                'tooltip_content_color',
                [
                    'label' => esc_html__( 'Color', 'moveaddons' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $id         = $this->get_id();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-tooltip-area' );

        $tooltip_att = [
            'class' => 'htmove-tooltip',
            'data-tippy-placement' => $settings['tooltip_placement'],
            'data-tippy-theme' => $settings['tooltip_theme'],
            'data-template' => 'htmove-tooltip-template-'.$id,
            'aria-describedby' => 'htmove-tooltip-area-'.$id,
        ];

        $rendered_attributes = [];
        foreach ( $tooltip_att as $att_key => $att_value ) {
            $rendered_attributes[] = sprintf( '%1$s="%2$s"', $att_key, esc_attr( $att_value ) );
        }

        $title_style = [];
        if( !empty( $settings['tooltip_title_color'] ) ){
            $title_style['color'] = 'color:'.$settings['tooltip_title_color'].';';
        }
        $title_style['typography'] = $this->generate_typography( $settings,'title_typography' );

        $content_style = [];
        if( !empty( $settings['tooltip_content_color'] ) ){
            $content_style['color'] = 'color:'.$settings['tooltip_content_color'].';';
        }
        $content_style['typography'] = $this->generate_typography( $settings,'content_typography' );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >

                <div <?php echo implode( ' ', $rendered_attributes ); ?>><?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'btn_image_size', 'btn_image' );?></div>

                <div style="display: none;">
                    <div id="htmove-tooltip-template-<?php echo $id; ?>">
                        <?php
                            if( !empty( $settings['tp_title'] ) ){
                                echo '<h5 class="htmove-tooltip-title" style="'.implode( ' ', $title_style ).'">'.$settings['tp_title'].'</h5>';
                            }

                            if( !empty( $settings['tp_content'] ) ){
                                echo '<p style="'.implode( ' ', $content_style ).'">'.$settings['tp_content'].'</p>';
                            }

                            if( !empty( $settings['tp_image']['url'] ) ){
                                echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'tp_image_size', 'tp_image' );
                            }
                        ?>
                    </div>
                </div>

            </div>

        <?php

    }

    public function generate_typography( $settings, $field ){

        $typography = [];
        if( !empty( $settings[$field.'_font_family'] ) ){
            $typography['font_family'] = 'font-family:'.$settings['title_typography_font_family'].';';
        }
        if( !empty( $settings[$field.'_font_size'] ) ){
            $typography['font_size'] = 'font-size:'.$settings[$field.'_font_size']['size'].$settings[$field.'_font_size']['unit'].';';
        }
        if( !empty( $settings[$field.'_font_weight'] ) ){
            $typography['font_weight'] = 'font-weight:'.$settings[$field.'_font_weight'].';';
        }
        if( !empty( $settings[$field.'_text_transform'] ) ){
            $typography['text_transform'] = 'text-transform:'.$settings[$field.'_text_transform'].';';
        }
        if( !empty( $settings[$field.'_font_style'] ) ){
            $typography['font_style'] = 'font-style:'.$settings[$field.'_font_style'].';';
        }
        if( !empty( $settings[$field.'_text_decoration'] ) ){
            $typography['text_decoration'] = 'text-decoration:'.$settings[$field.'_text_decoration'].';';
        }
        if( !empty( $settings[$field.'_line_height'] ) ){
            $typography['line_height'] = 'line-height:'.$settings[$field.'_line_height']['size'].$settings[$field.'_line_height']['unit'].';';
        }
        if( !empty( $settings[$field.'_letter_spacing'] ) ){
            $typography['letter_spacing'] = 'letter-spacing:'.$settings[$field.'_letter_spacing']['size'].$settings[$field.'_letter_spacing']['unit'].';';
        }
        $generate_style = implode( ' ', $typography );
        return $generate_style;

    }

}