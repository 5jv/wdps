<?php
namespace MoveAddons\Elementor\Widget;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Remote_Template_Element extends Base {

    public function get_name() {
        return 'move-remote-template';
    }

    public function get_title() {
        return esc_html__( 'Remote Template', 'moveaddons' );
    }

    public function get_icon() {
        return 'move-elementor-icon eicon-select';
    }

    public function get_keywords() {
        return [ 'move', 'remote', 'template', 'selector' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Remote Template', 'moveaddons' ),
            ]
        );
            $this->add_control(
                'template_id',
                [
                    'label'   => esc_html__( 'Select Template', 'moveaddons' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => move_addons_elementor_template(),
                    'label_block'=>true,
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'htmove-remote-template-area' );

        ?>                
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <?php
                    if( !empty( $settings['template_id'] ) ){
                        echo move_addons_get_elementor()->frontend->get_builder_content_for_display( $settings['template_id'] );
                    }else{
                        echo '<p>'.esc_html__( 'Please Select template.', 'moveaddons' ).'</p>';
                    }
                ?>
            </div>
        <?php

    }

}