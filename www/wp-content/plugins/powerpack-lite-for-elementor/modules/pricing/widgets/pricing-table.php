<?php
namespace PowerpackElementsLite\Modules\Pricing\Widgets;

use PowerpackElementsLite\Base\Powerpack_Widget;
use PowerpackElementsLite\Classes\PP_Config;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pricing Table Widget
 */
class Pricing_Table extends Powerpack_Widget {

	/**
	 * Retrieve pricing table widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_name( 'Pricing_Table' );
	}

	/**
	 * Retrieve pricing table widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Pricing_Table' );
	}

	/**
	 * Retrieve pricing table widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Pricing_Table' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.3.7
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Pricing_Table' );
	}

	/**
	 * Retrieve the list of scripts the pricing table widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 2.2.5
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'pp-tooltip',
			'powerpack-frontend',
		);
	}

	/**
	 * Register pricing table widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->register_controls();
	}

	/**
	 * Register pricing table widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.2.5
	 * @access protected
	 */
	protected function register_controls() {
		/* Content Tab */
		$this->register_content_header_controls();
		$this->register_content_pricing_controls();
		$this->register_content_features_controls();
		$this->register_content_ribbon_controls();
		$this->register_content_tooltip_controls();
		$this->register_content_button_controls();
		$this->register_content_help_docs_controls();
		$this->register_content_upgrade_pro_controls();

		/* Style Tab */
		$this->register_style_table_controls();
		$this->register_style_header_controls();
		$this->register_style_pricing_controls();
		$this->register_style_features_controls();
		$this->register_style_tooltip_controls();
		$this->register_style_ribbon_controls();
		$this->register_style_button_controls();
		$this->register_style_footer_controls();
	}

	/*-----------------------------------------------------------------------------------*/
	/*	CONTENT TAB
	/*-----------------------------------------------------------------------------------*/

	protected function register_content_header_controls() {
		/**
		 * Content Tab: Header
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header', 'powerpack' ),
			)
		);

		$this->add_control(
			'icon_type',
			array(
				'label'       => esc_html__( 'Icon Type', 'powerpack' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => esc_html__( 'None', 'powerpack' ),
						'icon'  => 'fa fa-ban',
					),
					'icon'  => array(
						'title' => esc_html__( 'Icon', 'powerpack' ),
						'icon'  => 'fa fa-star',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'powerpack' ),
						'icon'  => 'fa fa-picture-o',
					),
				),
				'default'     => 'none',
			)
		);

		$this->add_control(
			'select_table_icon',
			array(
				'label'            => __( 'Icon', 'powerpack' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'table_icon',
				'default'          => array(
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				),
				'condition'        => array(
					'icon_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'icon_image',
			array(
				'label'     => __( 'Image', 'powerpack' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Usage: '{name}_size' and '{name}_custom_dimension', in this case 'image_size' and 'image_custom_dimension'.
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_control(
			'table_title',
			array(
				'label'   => __( 'Title', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Title', 'powerpack' ),
				'title'   => __( 'Enter table title', 'powerpack' ),
			)
		);

		$this->add_control(
			'table_subtitle',
			array(
				'label'   => __( 'Subtitle', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Subtitle', 'powerpack' ),
				'title'   => __( 'Enter table subtitle', 'powerpack' ),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_pricing_controls() {
		/**
		 * Content Tab: Pricing
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_pricing',
			array(
				'label' => __( 'Pricing', 'powerpack' ),
			)
		);

		$this->add_control(
			'currency_symbol',
			array(
				'label'   => __( 'Currency Symbol', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''             => __( 'None', 'powerpack' ),
					'dollar'       => '&#36; ' . __( 'Dollar', 'powerpack' ),
					'euro'         => '&#128; ' . __( 'Euro', 'powerpack' ),
					'baht'         => '&#3647; ' . __( 'Baht', 'powerpack' ),
					'franc'        => '&#8355; ' . __( 'Franc', 'powerpack' ),
					'guilder'      => '&fnof; ' . __( 'Guilder', 'powerpack' ),
					'krona'        => 'kr ' . __( 'Krona', 'powerpack' ),
					'lira'         => '&#8356; ' . __( 'Lira', 'powerpack' ),
					'peseta'       => '&#8359 ' . __( 'Peseta', 'powerpack' ),
					'peso'         => '&#8369; ' . __( 'Peso', 'powerpack' ),
					'pound'        => '&#163; ' . __( 'Pound Sterling', 'powerpack' ),
					'real'         => 'R$ ' . __( 'Real', 'powerpack' ),
					'ruble'        => '&#8381; ' . __( 'Ruble', 'powerpack' ),
					'rupee'        => '&#8360; ' . __( 'Rupee', 'powerpack' ),
					'indian_rupee' => '&#8377; ' . __( 'Rupee (Indian)', 'powerpack' ),
					'shekel'       => '&#8362; ' . __( 'Shekel', 'powerpack' ),
					'yen'          => '&#165; ' . __( 'Yen/Yuan', 'powerpack' ),
					'won'          => '&#8361; ' . __( 'Won', 'powerpack' ),
					'custom'       => __( 'Custom', 'powerpack' ),
				),
				'default' => 'dollar',
			)
		);

		$this->add_control(
			'currency_symbol_custom',
			array(
				'label'     => __( 'Custom Symbol', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '',
				'condition' => array(
					'currency_symbol' => 'custom',
				),
			)
		);

		$this->add_control(
			'table_price',
			array(
				'label'   => __( 'Price', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => '49.99',
			)
		);

		$this->add_control(
			'currency_format',
			array(
				'label'   => __( 'Currency Format', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'raised',
				'options' => array(
					'raised' => __( 'Raised', 'powerpack' ),
					''       => __( 'Normal', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'discount',
			array(
				'label'        => __( 'Discount', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'On', 'powerpack' ),
				'label_off'    => __( 'Off', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'table_original_price',
			array(
				'label'     => __( 'Original Price', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '69',
				'condition' => array(
					'discount' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_duration',
			array(
				'label'   => __( 'Duration', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'per month', 'powerpack' ),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_features_controls() {
		/**
		 * Content Tab: Features
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_features',
			array(
				'label' => __( 'Features', 'powerpack' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'feature_text',
			array(
				'label'       => __( 'Text', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Feature', 'powerpack' ),
				'default'     => __( 'Feature', 'powerpack' ),
			)
		);

		$repeater->add_control(
			'exclude',
			array(
				'label'        => __( 'Exclude', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'tooltip_content',
			array(
				'label'       => __( 'Tooltip Content', 'powerpack' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'This is a tooltip', 'powerpack' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'select_feature_icon',
			array(
				'label'            => __( 'Icon', 'powerpack' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => array(
					'value'   => 'far fa-arrow-alt-circle-right',
					'library' => 'fa-regular',
				),
				'fa4compatibility' => 'feature_icon',
			)
		);

		$repeater->add_control(
			'feature_icon_color',
			array(
				'label'     => __( 'Icon Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pp-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pp-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'select_feature_icon[value]!' => '',
				),
			)
		);

		$repeater->add_control(
			'feature_text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'feature_bg_color',
			array(
				'name'      => 'feature_bg_color',
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'table_features',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'feature_text'        => __( 'Feature #1', 'powerpack' ),
						'select_feature_icon' => 'fa fa-check',
					),
					array(
						'feature_text'        => __( 'Feature #2', 'powerpack' ),
						'select_feature_icon' => 'fa fa-check',
					),
					array(
						'feature_text'        => __( 'Feature #3', 'powerpack' ),
						'select_feature_icon' => 'fa fa-check',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ feature_text }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Pricing Table Tooltip Controls
	 *
	 * @since 2.2.5
	 * @return void
	 */
	protected function register_content_tooltip_controls() {
		$this->start_controls_section(
			'section_tooltip',
			[
				'label'                 => __( 'Tooltip', 'powerpack' ),
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label'                 => __( 'Enable Tooltip', 'powerpack' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __( 'Yes', 'powerpack' ),
				'label_off'             => __( 'No', 'powerpack' ),
				'return_value'          => 'yes',
			]
		);

		$this->add_control(
			'tooltip_trigger',
			[
				'label'              => __( 'Trigger', 'powerpack' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'hover',
				'options'            => array(
					'hover' => __( 'Hover', 'powerpack' ),
					'click' => __( 'Click', 'powerpack' ),
				),
				'frontend_available' => true,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_size',
			array(
				'label'   => __( 'Size', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'powerpack' ),
					'tiny'    => __( 'Tiny', 'powerpack' ),
					'small'   => __( 'Small', 'powerpack' ),
					'large'   => __( 'Large', 'powerpack' ),
				),
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->add_control(
			'tooltip_position',
			array(
				'label'   => __( 'Position', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => array(
					'top'          => __( 'Top', 'powerpack' ),
					'bottom'       => __( 'Bottom', 'powerpack' ),
					'left'         => __( 'Left', 'powerpack' ),
					'right'        => __( 'Right', 'powerpack' ),
				),
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->add_control(
			'tooltip_arrow',
			array(
				'label'   => __( 'Show Arrow', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => array(
					'yes' => __( 'Yes', 'powerpack' ),
					'no'  => __( 'No', 'powerpack' ),
				),
				'frontend_available' => true,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->add_control(
			'tooltip_display_on',
			array(
				'label'   => __( 'Display On', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text' => __( 'Text', 'powerpack' ),
					'icon' => __( 'Icon', 'powerpack' ),
				),
				'frontend_available' => true,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->add_control(
			'tooltip_icon',
			[
				'label'     => __( 'Icon', 'powerpack' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-info-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_tooltip'       => 'yes',
					'tooltip_display_on' => 'icon',
				],
			]
		);

		$this->add_control(
			'tooltip_distance',
			array(
				'label'       => __( 'Distance', 'powerpack' ),
				'description' => __( 'The distance between the text/icon and the tooltip.', 'powerpack' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array(
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-top' => 'transform: translateY(-{{SIZE}}{{UNIT}});',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-bottom' => 'transform: translateY({{SIZE}}{{UNIT}});',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-left' => 'transform: translateX(-{{SIZE}}{{UNIT}});',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-right' => 'transform: translateX({{SIZE}}{{UNIT}});',
				),
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$tooltip_animations = array(
			''                  => __( 'Default', 'powerpack' ),
			'bounce'            => __( 'Bounce', 'powerpack' ),
			'flash'             => __( 'Flash', 'powerpack' ),
			'pulse'             => __( 'Pulse', 'powerpack' ),
			'rubberBand'        => __( 'rubberBand', 'powerpack' ),
			'shake'             => __( 'Shake', 'powerpack' ),
			'swing'             => __( 'Swing', 'powerpack' ),
			'tada'              => __( 'Tada', 'powerpack' ),
			'wobble'            => __( 'Wobble', 'powerpack' ),
			'bounceIn'          => __( 'bounceIn', 'powerpack' ),
			'bounceInDown'      => __( 'bounceInDown', 'powerpack' ),
			'bounceInLeft'      => __( 'bounceInLeft', 'powerpack' ),
			'bounceInRight'     => __( 'bounceInRight', 'powerpack' ),
			'bounceInUp'        => __( 'bounceInUp', 'powerpack' ),
			'bounceOut'         => __( 'bounceOut', 'powerpack' ),
			'bounceOutDown'     => __( 'bounceOutDown', 'powerpack' ),
			'bounceOutLeft'     => __( 'bounceOutLeft', 'powerpack' ),
			'bounceOutRight'    => __( 'bounceOutRight', 'powerpack' ),
			'bounceOutUp'       => __( 'bounceOutUp', 'powerpack' ),
			'fadeIn'            => __( 'fadeIn', 'powerpack' ),
			'fadeInDown'        => __( 'fadeInDown', 'powerpack' ),
			'fadeInDownBig'     => __( 'fadeInDownBig', 'powerpack' ),
			'fadeInLeft'        => __( 'fadeInLeft', 'powerpack' ),
			'fadeInLeftBig'     => __( 'fadeInLeftBig', 'powerpack' ),
			'fadeInRight'       => __( 'fadeInRight', 'powerpack' ),
			'fadeInRightBig'    => __( 'fadeInRightBig', 'powerpack' ),
			'fadeInUp'          => __( 'fadeInUp', 'powerpack' ),
			'fadeInUpBig'       => __( 'fadeInUpBig', 'powerpack' ),
			'fadeOut'           => __( 'fadeOut', 'powerpack' ),
			'fadeOutDown'       => __( 'fadeOutDown', 'powerpack' ),
			'fadeOutDownBig'    => __( 'fadeOutDownBig', 'powerpack' ),
			'fadeOutLeft'       => __( 'fadeOutLeft', 'powerpack' ),
			'fadeOutLeftBig'    => __( 'fadeOutLeftBig', 'powerpack' ),
			'fadeOutRight'      => __( 'fadeOutRight', 'powerpack' ),
			'fadeOutRightBig'   => __( 'fadeOutRightBig', 'powerpack' ),
			'fadeOutUp'         => __( 'fadeOutUp', 'powerpack' ),
			'fadeOutUpBig'      => __( 'fadeOutUpBig', 'powerpack' ),
			'flip'              => __( 'flip', 'powerpack' ),
			'flipInX'           => __( 'flipInX', 'powerpack' ),
			'flipInY'           => __( 'flipInY', 'powerpack' ),
			'flipOutX'          => __( 'flipOutX', 'powerpack' ),
			'flipOutY'          => __( 'flipOutY', 'powerpack' ),
			'lightSpeedIn'      => __( 'lightSpeedIn', 'powerpack' ),
			'lightSpeedOut'     => __( 'lightSpeedOut', 'powerpack' ),
			'rotateIn'          => __( 'rotateIn', 'powerpack' ),
			'rotateInDownLeft'  => __( 'rotateInDownLeft', 'powerpack' ),
			'rotateInDownLeft'  => __( 'rotateInDownRight', 'powerpack' ),
			'rotateInUpLeft'    => __( 'rotateInUpLeft', 'powerpack' ),
			'rotateInUpRight'   => __( 'rotateInUpRight', 'powerpack' ),
			'rotateOut'         => __( 'rotateOut', 'powerpack' ),
			'rotateOutDownLeft' => __( 'rotateOutDownLeft', 'powerpack' ),
			'rotateOutDownLeft' => __( 'rotateOutDownRight', 'powerpack' ),
			'rotateOutUpLeft'   => __( 'rotateOutUpLeft', 'powerpack' ),
			'rotateOutUpRight'  => __( 'rotateOutUpRight', 'powerpack' ),
			'hinge'             => __( 'Hinge', 'powerpack' ),
			'rollIn'            => __( 'rollIn', 'powerpack' ),
			'rollOut'           => __( 'rollOut', 'powerpack' ),
			'zoomIn'            => __( 'zoomIn', 'powerpack' ),
			'zoomInDown'        => __( 'zoomInDown', 'powerpack' ),
			'zoomInLeft'        => __( 'zoomInLeft', 'powerpack' ),
			'zoomInRight'       => __( 'zoomInRight', 'powerpack' ),
			'zoomInUp'          => __( 'zoomInUp', 'powerpack' ),
			'zoomOut'           => __( 'zoomOut', 'powerpack' ),
			'zoomOutDown'       => __( 'zoomOutDown', 'powerpack' ),
			'zoomOutLeft'       => __( 'zoomOutLeft', 'powerpack' ),
			'zoomOutRight'      => __( 'zoomOutRight', 'powerpack' ),
			'zoomOutUp'         => __( 'zoomOutUp', 'powerpack' ),
		);

		$this->add_control(
			'tooltip_animation_in',
			array(
				'label'   => __( 'Animation In', 'powerpack' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => '',
				'options' => $tooltip_animations,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->add_control(
			'tooltip_animation_out',
			array(
				'label'   => __( 'Animation Out', 'powerpack' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => '',
				'options' => $tooltip_animations,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_ribbon_controls() {
		/**
		 * Content Tab: Ribbon
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_ribbon',
			array(
				'label' => __( 'Ribbon', 'powerpack' ),
			)
		);

		$this->add_control(
			'show_ribbon',
			array(
				'label'        => __( 'Show Ribbon', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'ribbon_style',
			array(
				'label'     => __( 'Style', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => __( 'Default', 'powerpack' ),
					'2' => __( 'Circle', 'powerpack' ),
					'3' => __( 'Flag', 'powerpack' ),
				),
				'condition' => array(
					'show_ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_title',
			array(
				'label'     => __( 'Title', 'powerpack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'New', 'powerpack' ),
				'condition' => array(
					'show_ribbon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'ribbon_size',
			array(
				'label'      => __( 'Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
					'em' => array(
						'min' => 1,
						'max' => 15,
					),
				),
				'default'    => array(
					'size' => 4,
					'unit' => 'em',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-ribbon-2' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_ribbon'  => 'yes',
					'ribbon_style' => array( '2' ),
				),
			)
		);

		$this->add_responsive_control(
			'top_distance',
			array(
				'label'      => __( 'Distance from Top', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => 20,
					'unit' => '%',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-ribbon' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_ribbon'  => 'yes',
					'ribbon_style' => array( '2', '3' ),
				),
			)
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			array(
				'label'     => __( 'Distance', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				),
				'condition' => array(
					'show_ribbon'  => 'yes',
					'ribbon_style' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'ribbon_position',
			array(
				'label'       => __( 'Position', 'powerpack' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => array(
					'left'  => array(
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'     => 'right',
				'condition'   => array(
					'show_ribbon'  => 'yes',
					'ribbon_style' => array( '1', '2', '3' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_button_controls() {
		/**
		 * Content Tab: Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'powerpack' ),
			)
		);

		$this->add_control(
			'table_button_position',
			array(
				'label'   => __( 'Button Position', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'below',
				'options' => array(
					'above' => __( 'Above Features', 'powerpack' ),
					'below' => __( 'Below Features', 'powerpack' ),
					'none'  => __( 'None', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'table_button_text',
			array(
				'label'   => __( 'Button Text', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Get Started', 'powerpack' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'powerpack' ),
				'label_block' => true,
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => 'https://www.your-link.com',
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'table_additional_info',
			array(
				'label'   => __( 'Additional Info', 'powerpack' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Enter additional info here', 'powerpack' ),
				'title'   => __( 'Additional Info', 'powerpack' ),
			)
		);

		$this->end_controls_section();
	}

	protected function register_content_help_docs_controls() {

		$help_docs = PP_Config::get_widget_help_links( 'Pricing_Table' );
		if ( ! empty( $help_docs ) ) {
			/**
			 * Content Tab: Docs Links
			 *
			 * @since 1.4.8
			 * @access protected
			 */
			$this->start_controls_section(
				'section_help_docs',
				[
					'label' => __( 'Help Docs', 'powerpack' ),
				]
			);

			$hd_counter = 1;
			foreach ( $help_docs as $hd_title => $hd_link ) {
				$this->add_control(
					'help_doc_' . $hd_counter,
					[
						'type'            => Controls_Manager::RAW_HTML,
						'raw'             => sprintf( '%1$s ' . $hd_title . ' %2$s', '<a href="' . $hd_link . '" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'pp-editor-doc-links',
					]
				);

				$hd_counter++;
			}

			$this->end_controls_section();
		}
	}

	protected function register_content_upgrade_pro_controls() {

		if ( ! is_pp_elements_active() ) {
			/**
			 * Content Tab: Upgrade PowerPack
			 *
			 * @since 1.2.9.4
			 */
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
	}

	/*-----------------------------------------------------------------------------------*/
	/*	STYLE TAB
	/*-----------------------------------------------------------------------------------*/

	protected function register_style_table_controls() {
		/**
		 * Content Tab: Table
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_style',
			array(
				'label' => __( 'Table', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_align',
			array(
				'label'        => __( 'Alignment', 'powerpack' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => array(
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
				'default'      => '',
				'prefix_class' => 'pp-pricing-table-align-',
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_header_controls() {
		/**
		 * Style Tab: Header
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_header_style',
			array(
				'label' => __( 'Header', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_title_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-head' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'table_header_border',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'condition'   => array(
					'table_button_text!' => '',
				),
				'selector'    => '{{WRAPPER}} .pp-pricing-table-head',
			)
		);

		$this->add_responsive_control(
			'table_title_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_title_icon',
			array(
				'label'     => __( 'Icon', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'icon_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'table_icon_size',
			array(
				'label'      => __( 'Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
					'size' => 26,
				),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em' ),
				'condition'  => array(
					'icon_type'                 => 'icon',
					'select_table_icon[value]!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_icon_image_width',
			array(
				'label'      => __( 'Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 120,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'icon_type'   => 'image',
					'icon_image!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'table_icon_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'icon_type!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'table_icon_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => array(
					'icon_type'                 => 'icon',
					'select_table_icon[value]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-pricing-table-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_icon_margin',
			array(
				'label'      => __( 'Margin', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'icon_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'table_icon_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'icon_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'table_icon_border',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'condition'   => array(
					'icon_type!' => 'none',
				),
				'selector'    => '{{WRAPPER}} .pp-pricing-table-icon',
			)
		);

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'icon_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-icon, {{WRAPPER}} .pp-pricing-table-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_title_heading',
			array(
				'label'     => __( 'Title', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'table_title_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'table_title_typography',
				'label'    => __( 'Typography', 'powerpack' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pp-pricing-table-title',
			)
		);

		$this->add_control(
			'table_subtitle_heading',
			array(
				'label'     => __( 'Sub Title', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'table_subtitle!' => '',
				),
			)
		);

		$this->add_control(
			'table_subtitle_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'condition' => array(
					'table_subtitle!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-subtitle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'table_subtitle_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'condition' => array(
					'table_subtitle!' => '',
				),
				'selector'  => '{{WRAPPER}} .pp-pricing-table-subtitle',
			)
		);

		$this->add_responsive_control(
			'table_subtitle_spacing',
			array(
				'label'      => __( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'table_subtitle!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-subtitle' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_pricing_controls() {
		/**
		 * Style Tab: Pricing
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_pricing_style',
			array(
				'label' => __( 'Pricing', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'table_pricing_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .pp-pricing-table-price',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'table_price_color_normal',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'table_price_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'price_border_normal',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pp-pricing-table-price',
			)
		);

		$this->add_control(
			'pricing_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'table_pricing_width',
			array(
				'label'      => __( 'Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => 25,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_price_margin',
			array(
				'label'      => __( 'Margin', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'table_price_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pa_logo_wrapper_shadow',
				'selector' => '{{WRAPPER}} .pp-pricing-table-price',
			)
		);

		$this->add_control(
			'table_curreny_heading',
			array(
				'label'     => __( 'Currency Symbol', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'currency_symbol!' => '',
				),
			)
		);

		$this->add_control(
			'currency_size',
			array(
				'label'     => __( 'Size', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-price-prefix' => 'font-size: calc({{SIZE}}em/100)',
				),
				'condition' => array(
					'currency_symbol!' => '',
				),
			)
		);

		$this->add_control(
			'currency_position',
			array(
				'label'       => __( 'Position', 'powerpack' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'before',
				'options'     => array(
					'before' => array(
						'title' => __( 'Before', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					),
					'after'  => array(
						'title' => __( 'After', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_control(
			'currency_vertical_position',
			array(
				'label'                => __( 'Vertical Position', 'powerpack' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
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
				'default'              => 'top',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .pp-pricing-table-price-prefix' => 'align-self: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'table_duration_heading',
			array(
				'label'     => __( 'Duration', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'duration_position',
			array(
				'label'        => __( 'Duration Position', 'powerpack' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'nowrap',
				'options'      => array(
					'nowrap' => __( 'Same Line', 'powerpack' ),
					'wrap'   => __( 'Next Line', 'powerpack' ),
				),
				'prefix_class' => 'pp-pricing-table-price-duration-',
			)
		);

		$this->add_control(
			'duration_text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-price-duration' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'duration_typography',
				'label'    => __( 'Typography', 'powerpack' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .pp-pricing-table-price-duration',
			)
		);

		$this->add_responsive_control(
			'duration_spacing',
			array(
				'label'      => __( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}}.pp-pricing-table-price-duration-wrap .pp-pricing-table-price-duration' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'duration_position' => 'wrap',
				),
			)
		);

		$this->add_control(
			'table_original_price_style_heading',
			array(
				'label'     => __( 'Original Price', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'discount' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_original_price_text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'discount' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-price-original' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_original_price_text_size',
			array(
				'label'      => __( 'Font Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em' ),
				'condition'  => array(
					'discount' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-price-original' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_features_controls() {
		/**
		 * Style Tab: Features
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_features_style',
			array(
				'label' => __( 'Features', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_features_align',
			array(
				'label'       => __( 'Alignment', 'powerpack' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
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
				'default'     => '',
				'selectors'   => array(
					'{{WRAPPER}} .pp-pricing-table-features'   => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'table_features_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'table_features_text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_3,
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_features_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'      => '20',
					'right'    => '',
					'bottom'   => '20',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'table_features_margin',
			array(
				'label'      => __( 'Margin Bottom', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-features' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'table_features_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .pp-pricing-table-features',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'table_features_icon_heading',
			array(
				'label'     => __( 'Icon', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'table_features_icon_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-fature-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-pricing-table-fature-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_features_icon_size',
			array(
				'label'      => __( 'Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-fature-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_features_icon_spacing',
			array(
				'label'      => __( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-fature-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_features_rows_heading',
			array(
				'label'     => __( 'Rows', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'table_features_spacing',
			array(
				'label'      => __( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-features li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_features_alternate',
			array(
				'label'        => __( 'Striped Rows', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'table_features_rows_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_features_style' );

		$this->start_controls_tab(
			'tab_features_even',
			array(
				'label'     => __( 'Even', 'powerpack' ),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_features_bg_color_even',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features li:nth-child(even)' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_features_text_color_even',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features li:nth-child(even)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_features_odd',
			array(
				'label'     => __( 'Odd', 'powerpack' ),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_features_bg_color_odd',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features li:nth-child(odd)' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->add_control(
			'table_features_text_color_odd',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-features li:nth-child(odd)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'table_features_alternate' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'table_divider_heading',
			array(
				'label'     => __( 'Divider', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'table_feature_divider',
				'label'       => __( 'Divider', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pp-pricing-table-features li',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Tooltip Style Controls
	 *
	 * @since 2.2.5
	 * @return void
	 */
	protected function register_style_tooltip_controls() {

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label'     => __( 'Tooltip', 'powerpack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'background-color: {{VALUE}};',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-top .pp-tooltip-callout:after'    => 'border-top-color: {{VALUE}};',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-bottom .pp-tooltip-callout:after' => 'border-bottom-color: {{VALUE}};',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-left .pp-tooltip-callout:after'   => 'border-left-color: {{VALUE}};',
					'.pp-tooltip.pp-tooltip-{{ID}}.tt-right .pp-tooltip-callout:after'  => 'border-right-color: {{VALUE}};',
				],
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_width',
			[
				'label'     => __( 'Width', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 50,
						'max'  => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'.pp-tooltip.pp-tooltip-{{ID}}' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'render_type'        => 'template',
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'tooltip_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '.pp-tooltip.pp-tooltip-{{ID}}',
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'tooltip_border',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content',
				'condition'   => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_border_radius',
			[
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tooltip_box_shadow',
				'selector'  => '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content',
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_icon_style_heading',
			[
				'label'     => __( 'Tooltip Icon', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_tooltip'       => 'yes',
					'tooltip_display_on' => 'icon',
				],
			]
		);

		$this->add_control(
			'tooltip_icon_color',
			[
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-pricing-table-features .pp-pricing-table-tooltip-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_tooltip'       => 'yes',
					'tooltip_display_on' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_icon_size',
			[
				'label'      => __( 'Size', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'   => 5,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .pp-pricing-table-features .pp-pricing-table-tooltip-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'show_tooltip'       => 'yes',
					'tooltip_display_on' => 'icon',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_ribbon_controls() {
		/**
		 * Style Tab: Ribbon
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_ribbon_style',
			array(
				'label' => __( 'Ribbon', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'ribbon_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-ribbon .pp-pricing-table-ribbon-inner' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pp-pricing-table-ribbon-3.pp-pricing-table-ribbon-right:before' => 'border-left-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'ribbon_text_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-ribbon .pp-pricing-table-ribbon-inner' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .pp-pricing-table-ribbon .pp-pricing-table-ribbon-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .pp-pricing-table-ribbon .pp-pricing-table-ribbon-inner',
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_button_controls() {
		/**
		 * Style Tab: Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_button_style',
			array(
				'label'     => __( 'Button', 'powerpack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_control(
			'table_button_size',
			array(
				'label'     => __( 'Size', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => array(
					'xs' => __( 'Extra Small', 'powerpack' ),
					'sm' => __( 'Small', 'powerpack' ),
					'md' => __( 'Medium', 'powerpack' ),
					'lg' => __( 'Large', 'powerpack' ),
					'xl' => __( 'Extra Large', 'powerpack' ),
				),
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_spacing',
			array(
				'label'      => __( 'Spacing', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-button-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'table_button_text!'    => '',
					'table_button_position' => 'above',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => __( 'Normal', 'powerpack' ),
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-button' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'table_button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-button' => 'color: {{VALUE}}',
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
				'condition'   => array(
					'table_button_text!' => '',
				),
				'selector'    => '{{WRAPPER}} .pp-pricing-table-button',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'condition' => array(
					'table_button_text!' => '',
				),
				'selector'  => '{{WRAPPER}} .pp-pricing-table-button',
			)
		);

		$this->add_responsive_control(
			'table_button_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'table_button_text!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pa_pricing_table_button_shadow',
				'selector'  => '{{WRAPPER}} .pp-pricing-table-button',
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'powerpack' ),
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'table_button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'table_button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border_hover',
				'label'       => __( 'Border', 'powerpack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'condition'   => array(
					'table_button_text!' => '',
				),
				'selector'    => '{{WRAPPER}} .pp-pricing-table-button:hover',
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label'     => __( 'Animation', 'powerpack' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'table_button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_footer_controls() {
		/**
		 * Style Tab: Footer
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_table_footer_style',
			array(
				'label' => __( 'Footer', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_footer_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-footer' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'table_footer_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'       => '30',
					'right'     => '30',
					'bottom'    => '30',
					'left'      => '30',
					'unit'      => 'px',
					'isLinked'  => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_additional_info_heading',
			array(
				'label'     => __( 'Additional Info', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'table_additional_info!' => '',
				),
			)
		);

		$this->add_control(
			'additional_info_color',
			array(
				'label'     => __( 'Text Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'scheme'    => array(
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-additional-info' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'table_additional_info!' => '',
				),
			)
		);

		$this->add_control(
			'additional_info_bg_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-pricing-table-additional-info' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'table_additional_info!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'additional_info_margin',
			array(
				'label'      => __( 'Margin Top', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-additional-info' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'table_additional_info!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'additional_info_padding',
			array(
				'label'      => __( 'Padding', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'table_additional_info!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pp-pricing-table-additional-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'additional_info_typography',
				'label'     => __( 'Typography', 'powerpack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => array(
					'table_additional_info!' => '',
				),
				'selector'  => '{{WRAPPER}} .pp-pricing-table-additional-info',
			)
		);

		$this->end_controls_section();

	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'pound'        => '&#163;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'baht'         => '&#3647;',
			'yen'          => '&#165;',
			'won'          => '&#8361;',
			'guilder'      => '&fnof;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'rupee'        => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real'         => 'R$',
			'krona'        => 'kr',
		);
		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	/**
	 * Render pricing table widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function get_tooltip_attributes( $item, $tooltip_key ) {
		$settings = $this->get_settings_for_display();
		$tooltip_position = 'tt-' . $settings['tooltip_position'];

		$this->add_render_attribute(
			$tooltip_key,
			array(
				'class'                 => 'pp-pricing-table-tooptip',
				'data-tooltip'          => $item['tooltip_content'],
				'data-tooltip-position' => $tooltip_position,
				'data-tooltip-size'     => $settings['tooltip_size'],
			)
		);

		if ( $settings['tooltip_width'] ) {
			$this->add_render_attribute( $tooltip_key, 'data-tooltip-width', $settings['tooltip_width']['size'] );
		}

		if ( $settings['tooltip_animation_in'] ) {
			$this->add_render_attribute( $tooltip_key, 'data-tooltip-animation-in', $settings['tooltip_animation_in'] );
		}

		if ( $settings['tooltip_animation_out'] ) {
			$this->add_render_attribute( $tooltip_key, 'data-tooltip-animation-out', $settings['tooltip_animation_out'] );
		}
	}

	/**
	 * Render pricing table widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$symbol = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		if ( ! isset( $settings['table_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['table_icon'] = 'fa fa-star';
		}

		$has_icon = ! empty( $settings['table_icon'] );

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['table_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		if ( ! $has_icon && ! empty( $settings['select_table_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['select_table_icon'] );
		$is_new = ! isset( $settings['table_icon'] ) && Icons_Manager::is_migration_allowed();

		$this->add_inline_editing_attributes( 'table_title', 'none' );
		$this->add_render_attribute( 'table_title', 'class', 'pp-pricing-table-title' );

		$this->add_inline_editing_attributes( 'table_subtitle', 'none' );
		$this->add_render_attribute( 'table_subtitle', 'class', 'pp-pricing-table-subtitle' );

		$this->add_render_attribute( 'table_price', 'class', 'pp-pricing-table-price-value' );

		$this->add_inline_editing_attributes( 'table_duration', 'none' );
		$this->add_render_attribute( 'table_duration', 'class', 'pp-pricing-table-price-duration' );

		$this->add_inline_editing_attributes( 'table_additional_info', 'none' );
		$this->add_render_attribute( 'table_additional_info', 'class', 'pp-pricing-table-additional-info' );

		$this->add_render_attribute( 'pricing-table', 'class', 'pp-pricing-table' );

		$this->add_render_attribute( 'feature-list-item', 'class', '' );

		$this->add_inline_editing_attributes( 'table_button_text', 'none' );

		$this->add_render_attribute( 'table_button_text', 'class', [
			'pp-pricing-table-button',
			'elementor-button',
			'elementor-size-' . $settings['table_button_size'],
		] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'table_button_text', $settings['link'] );
		}

		$this->add_render_attribute( 'pricing-table-duration', 'class', 'pp-pricing-table-price-duration' );
		if ( 'wrap' === $settings['duration_position'] ) {
			$this->add_render_attribute( 'pricing-table-duration', 'class', 'next-line' );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'table_button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		if ( 'raised' === $settings['currency_format'] ) {
			$price = explode( '.', $settings['table_price'] );
			$intvalue = $price[0];
			$fraction = '';
			if ( 2 === count( $price ) ) {
				$fraction = $price[1];
			}
		} else {
			$intvalue = $settings['table_price'];
			$fraction = '';
		}
		?>
		<div class="pp-pricing-table-container">
			<div <?php echo $this->get_render_attribute_string( 'pricing-table' ); ?>>
				<div class="pp-pricing-table-head">
					<?php if ( 'none' !== $settings['icon_type'] ) { ?>
						<div class="pp-pricing-table-icon-wrap">
							<?php if ( 'icon' === $settings['icon_type'] && $has_icon ) { ?>
								<span class="pp-pricing-table-icon pp-icon">
									<?php
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $settings['select_table_icon'], [ 'aria-hidden' => 'true' ] );
									} elseif ( ! empty( $settings['table_icon'] ) ) {
										?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
									}
									?>
								</span>
							<?php } elseif ( 'image' === $settings['icon_type'] ) { ?>
								<?php $image = $settings['icon_image'];
								if ( $image['url'] ) { ?>
									<span class="pp-pricing-table-icon pp-pricing-table-icon-image">
										<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'icon_image' ); ?>
									</span>
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="pp-pricing-table-title-wrap">
						<?php if ( $settings['table_title'] ) { ?>
							<h3 <?php echo $this->get_render_attribute_string( 'table_title' ); ?>>
								<?php echo $settings['table_title']; ?>
							</h3>
						<?php } ?>
						<?php if ( $settings['table_subtitle'] ) { ?>
							<h4 <?php echo $this->get_render_attribute_string( 'table_subtitle' ); ?>>
								<?php echo $settings['table_subtitle']; ?>
							</h4>
						<?php } ?>
					</div>
				</div>
				<div class="pp-pricing-table-price-wrap">
					<div class="pp-pricing-table-price">
						<?php if ( 'yes' === $settings['discount'] && $settings['table_original_price'] ) { ?>
							<span class="pp-pricing-table-price-original">
								<?php
								if ( $symbol && 'after' === $settings['currency_position'] ) {
									echo $settings['table_original_price'] . $symbol;
								} else {
									echo $symbol . $settings['table_original_price'];
								}
								?>
							</span>
						<?php } ?>
						<?php if ( $symbol && ( 'before' === $settings['currency_position'] || '' === $settings['currency_position'] ) ) { ?>
							<span class="pp-pricing-table-price-prefix">
								<?php echo $symbol; ?>
							</span>
						<?php } ?>
						<span <?php echo $this->get_render_attribute_string( 'table_price' ); ?>>
							<span class="pp-pricing-table-integer-part">
								<?php echo $intvalue; ?>
							</span>
							<?php if ( $fraction ) { ?>
								<span class="pp-pricing-table-after-part">
									<?php echo $fraction; ?>
								</span>
							<?php } ?>
						</span>
						<?php if ( $symbol && 'after' === $settings['currency_position'] ) { ?>
							<span class="pp-pricing-table-price-prefix">
								<?php echo $symbol; ?>
							</span>
						<?php } ?>
						<?php if ( $settings['table_duration'] ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'table_duration' ); ?>>
								<?php echo $settings['table_duration']; ?>
							</span>
						<?php } ?>
					</div>
				</div>
				<?php if ( 'above' === $settings['table_button_position'] ) { ?>
					<div class="pp-pricing-table-button-wrap">
						<?php if ( $settings['table_button_text'] ) { ?>
							<a <?php echo $this->get_render_attribute_string( 'table_button_text' ); ?>>
								<?php echo $settings['table_button_text']; ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<ul class="pp-pricing-table-features">
					<?php foreach ( $settings['table_features'] as $index => $item ) : ?>
						<?php
						$fallback_defaults = [
							'fa fa-check',
							'fa fa-times',
							'fa fa-dot-circle-o',
						];

						$migration_allowed = Icons_Manager::is_migration_allowed();

						// add old default
						if ( ! isset( $item['feature_icon'] ) && ! $migration_allowed ) {
							$item['feature_icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
						}

						$migrated = isset( $item['__fa4_migrated']['select_feature_icon'] );
						$is_new = ! isset( $item['feature_icon'] ) && $migration_allowed;

						$feature_list_key = $this->get_repeater_setting_key( 'feature_list_key', 'table_features', $index );
						$this->add_render_attribute( $feature_list_key, 'class', 'elementor-repeater-item-' . $item['_id'] );

						$feature_content_key = $this->get_repeater_setting_key( 'feature_content_key', 'table_features', $index );
						$this->add_render_attribute( $feature_content_key, 'class', 'pp-pricing-table-feature-content' );

						$tooltip_icon_key = $this->get_repeater_setting_key( 'tooltip_icon_key', 'table_features', $index );
						$this->add_render_attribute( $tooltip_icon_key, 'class', 'pp-pricing-table-tooltip-icon' );

						if ( 'yes' === $settings['show_tooltip'] && $item['tooltip_content'] ) {
							if ( 'text' === $settings['tooltip_display_on'] ) {
								$this->get_tooltip_attributes( $item, $feature_content_key );
								if ( 'click' === $settings['tooltip_trigger'] ) {
									$this->add_render_attribute( $feature_content_key, 'class', 'pp-tooltip-click' );
								}
							} else {
								$this->get_tooltip_attributes( $item, $tooltip_icon_key );
								if ( 'click' === $settings['tooltip_trigger'] ) {
									$this->add_render_attribute( $tooltip_icon_key, 'class', 'pp-tooltip-click' );
								}
							}
						}

						$feature_key = $this->get_repeater_setting_key( 'feature_text', 'table_features', $index );
						$this->add_render_attribute( $feature_key, 'class', 'pp-pricing-table-feature-text' );
						$this->add_inline_editing_attributes( $feature_key, 'none' );

						if ( 'yes' === $item['exclude'] ) {
							$this->add_render_attribute( $feature_list_key, 'class', 'excluded' );
						}
						?>
						<li <?php echo $this->get_render_attribute_string( $feature_list_key ); ?>>
							<div <?php echo $this->get_render_attribute_string( $feature_content_key ); ?>>
								<?php
								if ( ! empty( $item['select_feature_icon'] ) || ( ! empty( $item['feature_icon']['value'] ) && $is_new ) ) :
									echo '<span class="pp-pricing-table-fature-icon pp-icon">';
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $item['select_feature_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
										<i class="<?php echo $item['feature_icon']; ?>" aria-hidden="true"></i>
										<?php
									}
									echo '</span>';
									endif;
								?>
								<?php if ( $item['feature_text'] ) { ?>
									<span <?php echo $this->get_render_attribute_string( $feature_key ); ?>>
										<?php echo $item['feature_text']; ?>
									</span>
								<?php } ?>
								<?php if ( 'yes' === $settings['show_tooltip'] && 'icon' === $settings['tooltip_display_on'] && $item['tooltip_content'] ) { ?>
									<span <?php echo $this->get_render_attribute_string( $tooltip_icon_key ); ?>>
										<?php \Elementor\Icons_Manager::render_icon( $settings['tooltip_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
								<?php } ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="pp-pricing-table-footer">
					<?php if ( 'below' === $settings['table_button_position'] ) { ?>
						<?php if ( $settings['table_button_text'] ) { ?>
							<a <?php echo $this->get_render_attribute_string( 'table_button_text' ); ?>>
								<?php echo $settings['table_button_text']; ?>
							</a>
						<?php } ?>
					<?php } ?>
					<?php if ( $settings['table_additional_info'] ) { ?>
						<div <?php echo $this->get_render_attribute_string( 'table_additional_info' ); ?>>
							<?php echo $this->parse_text_editor( $settings['table_additional_info'] ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if ( 'yes' === $settings['show_ribbon'] && $settings['ribbon_title'] ) { ?>
				<?php
					$classes = [
						'pp-pricing-table-ribbon',
						'pp-pricing-table-ribbon-' . $settings['ribbon_style'],
						'pp-pricing-table-ribbon-' . $settings['ribbon_position'],
					];
					$this->add_render_attribute( 'ribbon', 'class', $classes );
					?>
				<div <?php echo $this->get_render_attribute_string( 'ribbon' ); ?>>
					<div class="pp-pricing-table-ribbon-inner">
						<div class="pp-pricing-table-ribbon-title">
							<?php echo $settings['ribbon_title']; ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render pricing table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			var buttonClasses = 'pp-pricing-table-button elementor-button elementor-size-' + settings.table_button_size + ' elementor-animation-' + settings.button_hover_animation;
		   
			var $i = 1,
				symbols = {
					dollar: '&#36;',
					euro: '&#128;',
					franc: '&#8355;',
					pound: '&#163;',
					ruble: '&#8381;',
					shekel: '&#8362;',
					baht: '&#3647;',
					yen: '&#165;',
					won: '&#8361;',
					guilder: '&fnof;',
					peso: '&#8369;',
					peseta: '&#8359;',
					lira: '&#8356;',
					rupee: '&#8360;',
					indian_rupee: '&#8377;',
					real: 'R$',
					krona: 'kr'
				},
				symbol = '',
				iconHTML = {},
				iconsHTML = {},
				migrated = {},
				iconsMigrated = {},
				tooltipIconHTML = {};

			if ( settings.currency_symbol ) {
				if ( 'custom' !== settings.currency_symbol ) {
					symbol = symbols[ settings.currency_symbol ] || '';
				} else {
					symbol = settings.currency_symbol_custom;
				}
			}
		   
			if ( settings.currency_format == 'raised' ) {
				var table_price = settings.table_price.toString(),
					price = table_price.split( '.' ),
					intvalue = price[0],
					fraction = price[1];
			} else {
				var intvalue = settings.table_price,
					fraction = '';
			}

			function get_tooltip_attributes( item, toolTipKey ) {
				view.addRenderAttribute( toolTipKey, 'class', 'pp-pricing-table-tooptip' );
				view.addRenderAttribute( toolTipKey, 'data-tooltip', item.tooltip_content );
				view.addRenderAttribute( toolTipKey, 'data-tooltip-position', 'tt-' + settings.tooltip_position );
				view.addRenderAttribute( toolTipKey, 'data-tooltip-size', settings.tooltip_size );

				if ( settings.tooltip_width.size ) {
					view.addRenderAttribute( toolTipKey, 'data-tooltip-width', settings.tooltip_width.size );
				}

				if ( settings.tooltip_animation_in ) {
					view.addRenderAttribute( toolTipKey, 'data-tooltip-animation-in', settings.tooltip_animation_in );
				}

				if ( settings.tooltip_animation_out ) {
					view.addRenderAttribute( toolTipKey, 'data-tooltip-animation-out', settings.tooltip_animation_out );
				}
			}
		#>
		<div class="pp-pricing-table-container">
			<div class="pp-pricing-table">
				<div class="pp-pricing-table-head">
					<# if ( settings.icon_type != 'none' ) { #>
						<div class="pp-pricing-table-icon-wrap">
							<# if ( settings.icon_type == 'icon' ) { #>
								<# if ( settings.table_icon || settings.select_table_icon ) { #>
									<span class="pp-pricing-table-icon pp-icon">
										<# if ( iconHTML && iconHTML.rendered && ( ! settings.table_icon || migrated ) ) { #>
										{{{ iconHTML.value }}}
										<# } else { #>
											<i class="{{ settings.table_icon }}" aria-hidden="true"></i>
										<# } #>
									</span>
								<# } #>
							<# } else if ( settings.icon_type == 'image' ) { #>
								<span class="pp-pricing-table-icon pp-pricing-table-icon-image">
									<# if ( settings.icon_image.url != '' ) { #>
										<#
										var image = {
											id: settings.icon_image.id,
											url: settings.icon_image.url,
											size: settings.image_size,
											dimension: settings.image_custom_dimension,
											model: view.getEditModel()
										};
										var image_url = elementor.imagesManager.getImageUrl( image );
										#>
										<img src="{{{ image_url }}}" />
									<# } #>
								</span>
							<# } #>
						</div>
					<# } #>
					<div class="pp-pricing-table-title-wrap">
						<# if ( settings.table_title ) { #>
							<h3 class="pp-pricing-table-title elementor-inline-editing" data-elementor-setting-key="table_title" data-elementor-inline-editing-toolbar="none">
								{{{ settings.table_title }}}
							</h3>
						<# } #>
						<# if ( settings.table_subtitle ) { #>
							<h4 class="pp-pricing-table-subtitle elementor-inline-editing" data-elementor-setting-key="table_subtitle" data-elementor-inline-editing-toolbar="none">
								{{{ settings.table_subtitle }}}
							</h4>
						<# } #>
					</div>
				</div>
				<div class="pp-pricing-table-price-wrap">
					<div class="pp-pricing-table-price">
						<# if ( settings.discount === 'yes' && settings.table_original_price > 0 ) { #>
							<span class="pp-pricing-table-price-original">
								<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
									{{{ settings.table_original_price + symbol }}}
								<# } else { #>
									{{{ symbol + settings.table_original_price }}}
								<# } #>
							</span>
						<# } #>
						<# if ( ! _.isEmpty( symbol ) && ( 'before' == settings.currency_position || _.isEmpty( settings.currency_position ) ) ) { #>
							<span class="pp-pricing-table-price-prefix">{{{ symbol }}}</span>
						<# } #>
						<span class="pp-pricing-table-price-value">
							<span class="pp-pricing-table-integer-part">
								{{{ intvalue }}}
							</span>
							<# if ( fraction ) { #>
								<span class="pp-pricing-table-after-part">
									{{{ fraction }}}
								</span>
							<# } #>
						</span>
						<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
							<span class="pp-pricing-table-price-prefix">{{{ symbol }}}</span>
						<# } #>
						<# if ( settings.table_duration ) { #>
							<span class="pp-pricing-table-price-duration elementor-inline-editing" data-elementor-setting-key="table_duration" data-elementor-inline-editing-toolbar="none">
								{{{ settings.table_duration }}}
							</span>
						<# } #>
					</div>
				</div>
				<# if ( settings.table_button_position == 'above' ) { #>
					<div class="pp-pricing-table-button-wrap">
						<#
						if ( settings.table_button_text ) {
						var button_text = settings.table_button_text;

						view.addRenderAttribute( 'table_button_text', 'class', buttonClasses );

						view.addInlineEditingAttributes( 'table_button_text' );

						var button_text_html = '<a ' + 'href="' + settings.link.url + '"' + view.getRenderAttributeString( 'table_button_text' ) + '>' + button_text + '</a>';

						print( button_text_html );
						}
						#>
					</div>
				<# } #>
				<ul class="pp-pricing-table-features">
					<# var i = 1; #>
					<# _.each( settings.table_features, function( item, index ) {
						var featureContentKey = view.getRepeaterSettingKey( 'feature_content_key', 'table_features', index );
						view.addRenderAttribute( featureContentKey, 'class', 'pp-pricing-table-feature-content' );

						var tooltipIconKey = view.getRepeaterSettingKey( 'tooltip_icon_key', 'table_features', index );
						view.addRenderAttribute( tooltipIconKey, 'class', 'pp-pricing-table-tooltip-icon' );

						if ( 'yes' === settings.show_tooltip && item.tooltip_content ) {
							if ( 'text' === settings.tooltip_display_on ) {
								get_tooltip_attributes( item, featureContentKey );
								if ( 'click' === settings.tooltip_trigger ) {
									view.addRenderAttribute( featureContentKey, 'class', 'pp-tooltip-click' );
								}
							} else {
								get_tooltip_attributes( item, tooltipIconKey );
								if ( 'click' === settings.tooltip_trigger ) {
									view.addRenderAttribute( tooltipIconKey, 'class', 'pp-tooltip-click' );
								}
							}
						} #>
						<li class="elementor-repeater-item-{{ item._id }} <# if ( item.exclude == 'yes' ) { #> excluded <# } #>">
							<div {{{ view.getRenderAttributeString( featureContentKey ) }}}>
								<# if ( item.select_feature_icon || item.feature_icon.value ) { #>
									<span class="pp-pricing-table-fature-icon pp-icon">
									<#
										iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.select_feature_icon, { 'aria-hidden': true }, 'i', 'object' );
										iconsMigrated[ index ] = elementor.helpers.isIconMigrated( item, 'select_feature_icon' );
										if ( iconsHTML[ index ] && iconsHTML[ index ].rendered && ( ! item.feature_icon || iconsMigrated[ index ] ) ) { #>
											{{{ iconsHTML[ index ].value }}}
										<# } else { #>
											<i class="{{ item.feature_icon }}" aria-hidden="true"></i>
										<# }
									#>
									</span>
								<# } #>

								<#
									var feature_text = item.feature_text;

									view.addRenderAttribute( 'table_features.' + (i - 1) + '.feature_text', 'class', 'pp-pricing-table-feature-text' );

									view.addInlineEditingAttributes( 'table_features.' + (i - 1) + '.feature_text' );

									var feature_text_html = '<span' + ' ' + view.getRenderAttributeString( 'table_features.' + (i - 1) + '.feature_text' ) + '>' + feature_text + '</span>';

									print( feature_text_html );
								#>

								<#
								if ( 'yes' === settings.show_tooltip && 'icon' === settings.tooltip_display_on && item.tooltip_content ) {
									tooltipIconHTML = elementor.helpers.renderIcon( view, settings.tooltip_icon, { 'aria-hidden': true }, 'i', 'object' );
									var tooltip_icon_html = '<span' + ' ' + view.getRenderAttributeString( tooltipIconKey ) + '>' + tooltipIconHTML.value + '</span>';

									print( tooltip_icon_html );
								}
								#>
							</div>
						</li>
					<# i++ } ); #>
				</ul>
				<div class="pp-pricing-table-footer">
					<#
					if ( settings.table_button_position == 'below' ) {
						if ( settings.table_button_text ) {
						var button_text = settings.table_button_text;

						view.addRenderAttribute( 'table_button_text', 'class', buttonClasses );

						view.addInlineEditingAttributes( 'table_button_text' );

						var button_text_html = '<a ' + 'href="' + settings.link.url + '"' + view.getRenderAttributeString( 'table_button_text' ) + '>' + button_text + '</a>';

						print( button_text_html );
						}
					}

					if ( settings.table_additional_info ) {
					var additional_info_text = settings.table_additional_info;

					view.addRenderAttribute( 'table_additional_info', 'class', 'pp-pricing-table-additional-info' );

					view.addInlineEditingAttributes( 'table_additional_info' );

					var additional_info_text_html = '<div ' + view.getRenderAttributeString( 'table_additional_info' ) + '>' + additional_info_text + '</div>';

					print( additional_info_text_html );
					}
					#>
				</div>
			</div>
			<# if ( settings.show_ribbon == 'yes' && settings.ribbon_title != '' ) { #>
				<div class="pp-pricing-table-ribbon pp-pricing-table-ribbon-{{ settings.ribbon_style }} pp-pricing-table-ribbon-{{ settings.ribbon_position }}">
					<div class="pp-pricing-table-ribbon-inner">
						<div class="pp-pricing-table-ribbon-title">
							<# print( settings.ribbon_title ); #>
						</div>
					</div>
				</div>
			<# } #>
		</div>
		<?php
	}

	/**
	 * Render pricing table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * Remove this after Elementor v3.3.0
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->content_template();
	}

}
