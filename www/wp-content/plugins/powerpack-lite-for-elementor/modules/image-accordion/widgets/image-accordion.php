<?php
namespace PowerpackElementsLite\Modules\ImageAccordion\Widgets;

use PowerpackElementsLite\Base\Powerpack_Widget;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Image Accordion Widget
 */
class Image_Accordion extends Powerpack_Widget {

	/**
	 * Retrieve image accordion widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_name( 'Image_Accordion' );
	}

	/**
	 * Retrieve image accordion widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Image_Accordion' );
	}

	/**
	 * Retrieve image accordion widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Image_Accordion' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Image_Accordion' );
	}

	/**
	 * Retrieve the list of scripts the image accordion widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'powerpack-frontend',
		);
	}

	/**
	 * Register image accordion widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		/*
		-----------------------------------------------------------------------------------*/
		/*
		  Content Tab
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Items
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_items',
			array(
				'label' => esc_html__( 'Items', 'powerpack' ),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'image_accordion_tabs' );

		$repeater->start_controls_tab( 'tab_content', array( 'label' => __( 'Content', 'powerpack' ) ) );

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Accordion Title', 'powerpack' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'powerpack' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default'     => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_image', array( 'label' => __( 'Image', 'powerpack' ) ) );

		$repeater->add_control(
			'image',
			array(
				'label'       => esc_html__( 'Choose Image', 'powerpack' ),
				'type'        => Controls_Manager::MEDIA,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_link', array( 'label' => __( 'Link', 'powerpack' ) ) );

		$repeater->add_control(
			'show_button',
			array(
				'label'        => __( 'Show Button', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Link', 'powerpack' ),
				'type'          => Controls_Manager::URL,
				'label_block'   => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
				'condition'     => array(
					'show_button' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'Get Started', 'powerpack' ),
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'select_button_icon',
			array(
				'label'            => __( 'Button Icon', 'powerpack' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'button_icon',
				'condition'        => array(
					'show_button' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'button_icon_position',
			array(
				'label'     => __( 'Icon Position', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'before' => __( 'Before', 'powerpack' ),
					'after'  => __( 'After', 'powerpack' ),
				),
				'condition' => array(
					'show_button'                => 'yes',
					'select_button_icon[value]!' => '',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'accordion_items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'seperator'   => 'before',
				'default'     => array(
					array(
						'title'       => esc_html__( 'Accordion #1', 'powerpack' ),
						'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
						'image'       => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
					array(
						'title'       => esc_html__( 'Accordion #2', 'powerpack' ),
						'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
						'image'       => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
					array(
						'title'       => esc_html__( 'Accordion #3', 'powerpack' ),
						'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
						'image'       => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
					array(
						'title'       => esc_html__( 'Accordion #4', 'powerpack' ),
						'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'powerpack' ),
						'image'       => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{title}}',
			)
		);

		$this->add_control(
			'active_tab',
			array(
				'label'       => __( 'Default Active Item', 'powerpack' ),
				'description' => __( 'Add item number to make that item active by default. For example: Add 1 to make first item active by default.', 'powerpack' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 100,
				'step'        => 1,
				'default'     => '',
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_accordion_settings',
			array(
				'label' => esc_html__( 'Settings', 'powerpack' ),
			)
		);

		$this->add_responsive_control(
			'accordion_height',
			array(
				'label'      => esc_html__( 'Height', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 50,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 400,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion' => 'height: {{SIZE}}px',
				),
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'     => __( 'Title HTML Tag', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'separator' => 'before',
				'options'   => array(
					'h1'   => __( 'H1', 'powerpack' ),
					'h2'   => __( 'H2', 'powerpack' ),
					'h3'   => __( 'H3', 'powerpack' ),
					'h4'   => __( 'H4', 'powerpack' ),
					'h5'   => __( 'H5', 'powerpack' ),
					'h6'   => __( 'H6', 'powerpack' ),
					'div'  => __( 'div', 'powerpack' ),
					'span' => __( 'span', 'powerpack' ),
					'p'    => __( 'p', 'powerpack' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image',
				'label'   => __( 'Image Size', 'powerpack' ),
				'default' => 'full',
			)
		);

		$this->add_control(
			'accordion_action',
			array(
				'label'              => esc_html__( 'Accordion Action', 'powerpack' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'on-hover',
				'label_block'        => false,
				'options'            => array(
					'on-hover' => esc_html__( 'On Hover', 'powerpack' ),
					'on-click' => esc_html__( 'On Click', 'powerpack' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'orientation',
			array(
				'label'              => esc_html__( 'Orientation', 'powerpack' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'vertical',
				'label_block'        => false,
				'options'            => array(
					'vertical'   => esc_html__( 'Vertical', 'powerpack' ),
					'horizontal' => esc_html__( 'Horizontal', 'powerpack' ),
				),
				'frontend_available' => true,
				'prefix_class'       => 'pp-image-accordion-orientation-',
			)
		);

		$this->add_control(
			'stack_on',
			array(
				'label'              => esc_html__( 'Stack On', 'powerpack' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'tablet',
				'label_block'        => false,
				'options'            => array(
					'tablet' => esc_html__( 'Tablet', 'powerpack' ),
					'mobile' => esc_html__( 'Mobile', 'powerpack' ),
					'none'   => esc_html__( 'None', 'powerpack' ),
				),
				'frontend_available' => true,
				'prefix_class'       => 'pp-image-accordion-stack-on-',
				'condition'          => array(
					'orientation' => 'vertical',
				),
			)
		);

		$this->end_controls_section();

		if ( ! is_pp_elements_active() ) {
			$this->start_controls_section(
				'section_upgrade_powerpack',
				array(
					'label' => apply_filters( 'upgrade_powerpack_title', __( 'Get PowerPack Pro', 'powerpack' ) ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'upgrade_powerpack_notice',
				array(
					'label'           => '',
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => apply_filters( 'upgrade_powerpack_message', sprintf( __( 'Upgrade to %1$s Pro Version %2$s for 70+ widgets, exciting extensions and advanced features.', 'powerpack' ), '<a href="#" target="_blank" rel="noopener">', '</a>' ) ),
					'content_classes' => 'upgrade-powerpack-notice elementor-panel-alert elementor-panel-alert-info',
				)
			);

			$this->end_controls_section();
		}

		/*
		-----------------------------------------------------------------------------------*/
		/*
		  Style Tab
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Items
		 */
		$this->start_controls_section(
			'section_items_style',
			array(
				'label' => esc_html__( 'Items', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'items_spacing',
			array(
				'label'      => esc_html__( 'Items Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '',
					'unit' => 'px',
				),
				'selectors'  => array(
					'(desktop){{WRAPPER}}.pp-image-accordion-orientation-vertical .pp-image-accordion-item:not(:last-child)' => 'margin-right: {{SIZE}}px',
					'(desktop){{WRAPPER}}.pp-image-accordion-orientation-horizontal .pp-image-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}px',
					'(tablet){{WRAPPER}}.pp-image-accordion-orientation-vertical.pp-image-accordion-stack-on-tablet .pp-image-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}px;',
					'(mobile){{WRAPPER}}.pp-image-accordion-orientation-vertical.pp-image-accordion-stack-on-mobile .pp-image-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_items_style' );

		$this->start_controls_tab(
			'tab_items_normal',
			array(
				'label' => __( 'Normal', 'powerpack' ),
			)
		);

		$this->add_control(
			'accordion_img_overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.3)',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-item .pp-image-accordion-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'items_border',
				'label'    => esc_html__( 'Border', 'powerpack' ),
				'selector' => '{{WRAPPER}} .pp-image-accordion-item',
			)
		);

		$this->add_control(
			'items_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'items_box_shadow',
				'selector' => '{{WRAPPER}} .pp-image-accordion-item',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_items_hover',
			array(
				'label' => __( 'Hover', 'powerpack' ),
			)
		);

		$this->add_control(
			'accordion_img_hover_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-item:hover .pp-image-accordion-overlay' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pp-image-accordion-item.pp-image-accordion-active .pp-image-accordion-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'items_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-item:hover, {{WRAPPER}} .pp-image-accordion-item.pp-image-accordion-active' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'items_box_shadow_hover',
				'selector' => '{{WRAPPER}} .pp-image-accordion-item:hover, {{WRAPPER}} .pp-image-accordion-item.pp-image-accordion-active',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Content
		 */
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'label'     => esc_html__( 'Border', 'powerpack' ),
				'selector'  => '{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_vertical_align',
			array(
				'label'                => __( 'Vertical Align', 'powerpack' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'middle',
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'powerpack' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'powerpack' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'powerpack' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-overlay' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
				),
				'separator'            => 'before',
			)
		);

		$this->add_responsive_control(
			'content_horizontal_align',
			array(
				'label'                => __( 'Horizontal Align', 'powerpack' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => true,
				'options'              => array(
					'left'   => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'              => 'center',
				'selectors_dictionary' => array(
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-overlay' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content-wrap' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Text Align', 'powerpack' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => ' center',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_width',
			array(
				'label'      => esc_html__( 'Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => '',
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'  => 'before',
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_style_heading',
			array(
				'label'     => __( 'Title', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .pp-image-accordion .pp-image-accordion-title',
			)
		);

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'      => esc_html__( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => '',
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-title' => 'margin-bottom: {{SIZE}}px',
				),
			)
		);

		$this->add_control(
			'description_style_heading',
			array(
				'label'     => __( 'Description', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion .pp-image-accordion-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .pp-image-accordion .pp-image-accordion-description',
			)
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => __( 'Button', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'   => __( 'Size', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => array(
					'xs' => __( 'Extra Small', 'powerpack' ),
					'sm' => __( 'Small', 'powerpack' ),
					'md' => __( 'Medium', 'powerpack' ),
					'lg' => __( 'Large', 'powerpack' ),
					'xl' => __( 'Extra Large', 'powerpack' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_spacing',
			array(
				'label'      => esc_html__( 'Button Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 15,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion-button' => 'margin-top: {{SIZE}}px',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'powerpack' ),
			)
		);

		$this->add_control(
			'button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-image-accordion-button .pp-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border_normal',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pp-image-accordion-button',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'powerpack' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pp-image-accordion-button',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-image-accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .pp-image-accordion-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'powerpack' ),
			)
		);

		$this->add_control(
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-image-accordion-button:hover .pp-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-image-accordion-button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label' => __( 'Animation', 'powerpack' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .pp-image-accordion-button:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'button_icon_heading',
			array(
				'label'     => __( 'Icon', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			array(
				'label'      => esc_html__( 'Icon Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 2,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-button-icon-before .pp-button-icon' => 'margin-right: {{SIZE}}px',
					'{{WRAPPER}} .pp-button-icon-after .pp-button-icon' => 'margin-left: {{SIZE}}px',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render_button_icon( $item ) {
		$settings = $this->get_settings_for_display();

		$migration_allowed = Icons_Manager::is_migration_allowed();

		// add old default
		if ( ! isset( $item['button_icon'] ) && ! $migration_allowed ) {
			$item['hotspot_icon'] = '';
		}

		$migrated = isset( $item['__fa4_migrated']['select_button_icon'] );
		$is_new   = ! isset( $item['button_icon'] ) && $migration_allowed;

		if ( ! empty( $item['button_icon'] ) || ( ! empty( $item['select_button_icon']['value'] ) && $is_new ) ) {
			?>
			<span class="pp-button-icon pp-icon pp-no-trans">
				<?php
				if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $item['select_button_icon'], array( 'aria-hidden' => 'true' ) );
				} else {
					?>
						<i class="<?php echo esc_attr( $item['button_icon'] ); ?>" aria-hidden="true"></i>
				<?php } ?>
			</span>
			<?php
		}
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'image-accordion',
			array(
				'class' => array( 'pp-image-accordion', 'pp-image-accordion-' . $settings['accordion_action'] ),
				'id'    => 'pp-image-accordion-' . $this->get_id(),
			)
		);

		if ( ! empty( $settings['accordion_items'] ) ) {
			?>
			<div <?php echo $this->get_render_attribute_string( 'image-accordion' ); ?>>
				<?php foreach ( $settings['accordion_items'] as $index => $item ) { ?>
					<?php
						$item_key = $this->get_repeater_setting_key( 'item', 'accordion_items', $index );

						$this->add_render_attribute(
							$item_key,
							array(
								'class' => array( 'pp-image-accordion-item', 'elementor-repeater-item-' . esc_attr( $item['_id'] ) ),
							)
						);

					if ( $item['image']['url'] ) {

						$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'image', $settings );

						if ( ! $image_url ) {
							$image_url = $item['image']['url'];
						}

						$this->add_render_attribute(
							$item_key,
							array(
								'style' => 'background-image: url(' . $image_url . ');',
							)
						);
					}

						$content_key = $this->get_repeater_setting_key( 'content', 'accordion_items', $index );

						$this->add_render_attribute( $content_key, 'class', 'pp-image-accordion-content-wrap' );

					if ( $item['show_button'] == 'yes' && ! empty( $item['link']['url'] ) ) {
						$button_key = $this->get_repeater_setting_key( 'button', 'accordion_items', $index );

						$this->add_render_attribute(
							$button_key,
							'class',
							array(
								'pp-image-accordion-button',
								'pp-button-icon-' . $item['button_icon_position'],
								'elementor-button',
								'elementor-size-' . $settings['button_size'],
							)
						);

						if ( $settings['button_hover_animation'] ) {
							$this->add_render_attribute( $button_key, 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
						}

						$this->add_link_attributes( $button_key, $item['link'] );
					}

					if ( $settings['active_tab'] ) {
						$tab_count = $settings['active_tab'] - 1;
						if ( $index === $tab_count ) {
							$this->add_render_attribute(
								$item_key,
								array(
									'class' => 'pp-image-accordion-active',
									'style' => 'flex: 3 1 0;',
								)
							);
							$this->add_render_attribute(
								$content_key,
								array(
									'class' => 'pp-image-accordion-content-active',
								)
							);
						}
					}
					?>
					<div <?php echo $this->get_render_attribute_string( $item_key ); ?>>
						<div class="pp-image-accordion-overlay">
							<div <?php echo $this->get_render_attribute_string( $content_key ); ?>>
								<div class="pp-image-accordion-content">
									<?php
										printf( '<%1$s class="pp-image-accordion-title">', $settings['title_html_tag'] );
											echo $item['title'];
										printf( '</%1$s>', $settings['title_html_tag'] );
									?>
									<div class="pp-image-accordion-description">
										<?php echo $item['description']; ?>
									</div>
								</div>
								<?php if ( $item['show_button'] == 'yes' && $item['link']['url'] != '' ) { ?>
								<div class="pp-image-accordion-button-wrap">
									<a <?php echo $this->get_render_attribute_string( $button_key ); ?>>
										<?php
										if ( $item['button_icon_position'] == 'before' ) {
											$this->render_button_icon( $item );
										}
										?>
										<?php if ( ! empty( $item['button_text'] ) ) { ?>
											<span class="pp-button-text">
												<?php echo esc_attr( $item['button_text'] ); ?>
											</span>
										<?php } ?>
										<?php
										if ( $item['button_icon_position'] == 'after' ) {
											$this->render_button_icon( $item );
										}
										?>
									</a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}

	protected function content_template() {
	}
}
