<?php
namespace PowerpackElementsLite\Modules\Logos\Widgets;

use PowerpackElementsLite\Base\Powerpack_Widget;
use PowerpackElementsLite\Classes\PP_Config;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Logo Grid Widget
 */
class Logo_Grid extends Powerpack_Widget {

	/**
	 * Retrieve logo grid widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_name( 'Logo_Grid' );
	}

	/**
	 * Retrieve logo grid widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Logo_Grid' );
	}

	/**
	 * Retrieve logo grid widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Logo_Grid' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.4.13.1
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Logo_Grid' );
	}

	/**
	 * Register logo grid widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->register_controls();
	}

	/**
	 * Register logo grid widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.1.4
	 * @access protected
	 */
	protected function register_controls() {
		/* Content Tab */
		$this->register_content_logo_grid_controls();
		$this->register_content_help_docs_controls();
		$this->register_content_upgrade_controls();

		/* Style Tab */
		$this->register_content_logos_controls();
		$this->register_content_title_controls();
	}

	protected function register_content_logo_grid_controls() {
		$this->start_controls_section(
			'section_logo_grid',
			[
				'label'             => __( 'Logo Grid', 'powerpack' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'items_repeater' );

		$repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'powerpack' ) ] );

			$repeater->add_control(
				'logo_image',
				[
					'label'             => __( 'Upload Logo Image', 'powerpack' ),
					'type'              => Controls_Manager::MEDIA,
					'dynamic'           => [
						'active'   => true,
					],
					'default'           => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label'             => __( 'Title', 'powerpack' ),
					'type'              => Controls_Manager::TEXT,
					'dynamic'           => [
						'active'   => true,
					],
				]
			);

			$repeater->add_control(
				'link',
				[
					'label'             => __( 'Link', 'powerpack' ),
					'type'              => Controls_Manager::URL,
					'dynamic'           => [
						'active'   => true,
					],
					'placeholder'       => 'https://www.your-link.com',
					'default'           => [
						'url' => '',
					],
				]
			);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_style', [ 'label' => __( 'Style', 'powerpack' ) ] );

			$repeater->add_control(
				'custom_style',
				[
					'label'             => __( 'Custom Style', 'powerpack' ),
					'type'              => Controls_Manager::SWITCHER,
					'description'       => __( 'Add custom styles which will affect only this item', 'powerpack' ),
					'default'           => '',
					'label_on'          => __( 'On', 'powerpack' ),
					'label_off'         => __( 'Off', 'powerpack' ),
					'return_value'      => 'yes',
				]
			);

			$repeater->add_control(
				'custom_logo_wrapper_bg',
				[
					'label'              => __( 'Background Color', 'powerpack' ),
					'type'               => Controls_Manager::COLOR,
					'default'            => '',
					'selectors'          => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.pp-logo-grid-item-custom' => 'background-color: {{VALUE}}',
					],
					'condition'          => [
						'custom_style'   => 'yes',
					],
				]
			);

			$repeater->add_control(
				'custom_logo_wrapper_border_color',
				[
					'label'              => __( 'Border Color', 'powerpack' ),
					'type'               => Controls_Manager::COLOR,
					'default'            => '',
					'selectors'          => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.pp-logo-grid-item-custom' => 'border-color: {{VALUE}}',
					],
					'condition'          => [
						'custom_style'   => 'yes',
					],
				]
			);

			$repeater->add_control(
				'custom_logo_border_width',
				[
					'label'                 => __( 'Border Width', 'powerpack' ),
					'type'                  => Controls_Manager::SLIDER,
					'size_units'            => [ 'px' ],
					'range'                 => [
						'px' => [
							'min' => 0,
							'max' => 20,
						],
					],
					'selectors'             => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.pp-logo-grid-item-custom' => 'border-width: {{SIZE}}{{UNIT}};',
					],
					'condition'          => [
						'custom_style'   => 'yes',
					],
				]
			);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'pp_logos',
			[
				'label'     => __( 'Add Logos', 'powerpack' ),
				'type'      => Controls_Manager::REPEATER,
				'default'   => [
					[
						'logo_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'logo_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'logo_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field'   => __( 'Logo Image', 'powerpack' ),
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'                => __( 'Title HTML Tag', 'powerpack' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'h4',
				'options'              => [
					'h1'     => __( 'H1', 'powerpack' ),
					'h2'     => __( 'H2', 'powerpack' ),
					'h3'     => __( 'H3', 'powerpack' ),
					'h4'     => __( 'H4', 'powerpack' ),
					'h5'     => __( 'H5', 'powerpack' ),
					'h6'     => __( 'H6', 'powerpack' ),
					'div'    => __( 'div', 'powerpack' ),
					'span'   => __( 'span', 'powerpack' ),
					'p'      => __( 'p', 'powerpack' ),
				],
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'randomize',
			[
				'label'                 => __( 'Randomize Logos', 'powerpack' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __( 'Yes', 'powerpack' ),
				'label_off'             => __( 'No', 'powerpack' ),
				'return_value'          => 'yes',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'                 => __( 'Columns', 'powerpack' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => '3',
				'tablet_default'        => '2',
				'mobile_default'        => '1',
				'options'               => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class'          => 'elementor-grid%s-',
				'frontend_available'    => true,
			]
		);

		$this->add_responsive_control(
			'logos_spacing',
			[
				'label'                 => __( 'Logos Gap', 'powerpack' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ 'px' ],
				'default'               => [ 'size' => 10 ],
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'(desktop){{WRAPPER}} .pp-grid-item-wrap'       => 'width: calc( ( 100% - (({{columns.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}} .pp-grid-item-wrap'        => 'width: calc( ( 100% - (({{columns_tablet.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns_tablet.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pp-grid-item-wrap'        => 'width: calc( ( 100% - (({{columns_mobile.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns_mobile.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'logos_vertical_align',
			[
				'label'                 => __( 'Vertical Align', 'powerpack' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'default'               => 'top',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'powerpack' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'powerpack' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'powerpack' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-logo-grid .pp-grid-item-wrap' => 'align-items: {{VALUE}};',
				],
				'selectors_dictionary'  => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
			]
		);

		$this->add_control(
			'logos_horizontal_align',
			[
				'label'                 => __( 'Horizontal Align', 'powerpack' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'powerpack' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'           => [
						'title' => __( 'Center', 'powerpack' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'            => [
						'title' => __( 'Right', 'powerpack' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'               => 'center',
				'selectors_dictionary'  => [
					'left'     => 'flex-start',
					'center'   => 'center',
					'right'    => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-logo-grid .pp-grid-item-wrap, {{WRAPPER}} .pp-logo-grid .pp-grid-item' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'                  => 'image',
				'label'                 => __( 'Image Size', 'powerpack' ),
				'default'               => 'full',
			]
		);

		$this->add_responsive_control(
			'logos_width',
			[
				'label'             => __( 'Image Width', 'powerpack' ),
				'type'              => Controls_Manager::SLIDER,
				'size_units'            => [ 'px', '%' ],
				'range'             => [
					'px' => [
						'min'   => 10,
						'max'   => 800,
						'step'  => 1,
					],
				],
				'selectors'         => [
					'{{WRAPPER}} .pp-grid-item img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_content_help_docs_controls() {

		$help_docs = PP_Config::get_widget_help_links( 'Logo_Grid' );

		if ( ! empty( $help_docs ) ) {

			/**
			 * Content Tab: Help Docs
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

	/**
	 * Register PowerPack Upgrade in Content tab
	 *
	 * @return void
	 */
	protected function register_content_upgrade_controls() {
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
	}

	/*-----------------------------------------------------------------------------------*/
	/*	STYLE TAB
	/*-----------------------------------------------------------------------------------*/

	protected function register_content_logos_controls() {
		$this->start_controls_section(
			'section_logos_style',
			[
				'label'                 => __( 'Logos', 'powerpack' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_logos_style' );

		$this->start_controls_tab(
			'tab_logos_normal',
			[
				'label'             => __( 'Normal', 'powerpack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'logo_bg',
				'label'                 => __( 'Background', 'powerpack' ),
				'types'                 => [ 'none', 'classic', 'gradient' ],
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'logo_border',
				'label'                 => __( 'Border', 'powerpack' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap',
			]
		);

		$this->add_control(
			'logo_border_radius',
			[
				'label'                 => __( 'Border Radius', 'powerpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-grid-item-wrap, {{WRAPPER}} .pp-grid-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label'                 => __( 'Padding', 'powerpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-grid-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'grayscale_normal',
			[
				'label'             => __( 'Grayscale', 'powerpack' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_on'          => __( 'Yes', 'powerpack' ),
				'label_off'         => __( 'No', 'powerpack' ),
				'return_value'      => 'yes',
			]
		);

		$this->add_control(
			'opacity_normal',
			[
				'label'             => __( 'Opacity', 'powerpack' ),
				'type'              => Controls_Manager::SLIDER,
				'range'             => [
					'px' => [
						'min'   => 0,
						'max'   => 1,
						'step'  => 0.1,
					],
				],
				'selectors'         => [
					'{{WRAPPER}} .pp-grid-item img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'pp_logo_box_shadow_normal',
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap',
				'separator'             => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_logos_hover',
			[
				'label'                 => __( 'Hover', 'powerpack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'logos_bg_hover',
				'label'                 => __( 'Background', 'powerpack' ),
				'types'                 => [ 'none', 'classic', 'gradient' ],
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'logo_border_hover',
				'label'                 => __( 'Border', 'powerpack' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap:hover',
			]
		);

		$this->add_responsive_control(
			'translate',
			[
				'label'                 => __( 'Slide', 'powerpack' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => -40,
						'max'   => 40,
						'step'  => 1,
					],
				],
				'size_units'            => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-grid-item-wrap:hover' => 'transform:translateY({{SIZE}}{{UNIT}})',
				],
			]
		);

		$this->add_control(
			'grayscale_hover',
			[
				'label'             => __( 'Grayscale', 'powerpack' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_on'          => __( 'Yes', 'powerpack' ),
				'label_off'         => __( 'No', 'powerpack' ),
				'return_value'      => 'yes',
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label'             => __( 'Opacity', 'powerpack' ),
				'type'              => Controls_Manager::SLIDER,
				'range'             => [
					'px' => [
						'min'   => 0,
						'max'   => 1,
						'step'  => 0.1,
					],
				],
				'selectors'         => [
					'{{WRAPPER}} .pp-grid-item:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'pp_logo_box_shadow_hover',
				'selector'              => '{{WRAPPER}} .pp-grid-item-wrap:hover',
				'separator'             => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_content_title_controls() {
		$this->start_controls_section(
			'section_logo_title_style',
			[
				'label'                 => __( 'Title', 'powerpack' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'              => __( 'Color', 'powerpack' ),
				'type'               => Controls_Manager::COLOR,
				'default'            => '',
				'selectors'          => [
					'{{WRAPPER}} .pp-logo-grid-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'                 => __( 'Margin Top', 'powerpack' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ 'px' ],
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-logo-grid-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'title_typography',
				'label'                 => __( 'Typography', 'powerpack' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
				'selector'              => '{{WRAPPER}} .pp-logo-grid-title',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render logo grid widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$i = 1;

		$this->add_render_attribute( 'logo-grid', 'class', 'pp-logo-grid pp-elementor-grid clearfix' );

		if ( 'yes' === $settings['grayscale_normal'] ) {
			$this->add_render_attribute( 'logo-grid', 'class', 'grayscale-normal' );
		}

		if ( 'yes' === $settings['grayscale_hover'] ) {
			$this->add_render_attribute( 'logo-grid', 'class', 'grayscale-hover' );
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'logo-grid' ); ?>>
			<?php
			$logos = $settings['pp_logos'];

			if ( 'yes' === $settings['randomize'] ) {
				shuffle( $logos );
			}

			foreach ( $logos as $item ) :
				if ( ! empty( $item['logo_image']['url'] ) ) {

					$this->add_render_attribute( 'logo-grid-item-wrap-' . $i, 'class', 'pp-grid-item-wrap' );
					$this->add_render_attribute( 'logo-grid-item-wrap-' . $i, 'class', 'elementor-repeater-item-' . esc_attr( $item['_id'] ) );

					$this->add_render_attribute( 'logo-grid-item-' . $i, 'class', 'pp-grid-item' );

					if ( 'yes' === $item['custom_style'] ) {
						$this->add_render_attribute( 'logo-grid-item-wrap-' . $i, 'class', 'pp-logo-grid-item-custom' );
					}

					$this->add_render_attribute( 'title' . $i, 'class', 'pp-logo-grid-title' );
					?>
						<div <?php echo $this->get_render_attribute_string( 'logo-grid-item-wrap-' . $i ); ?>>
							<div <?php echo $this->get_render_attribute_string( 'logo-grid-item-' . $i ); ?>>
							<?php
							if ( ! empty( $item['link']['url'] ) ) {

								$this->add_link_attributes( 'logo-link' . $i, $item['link'] );

							}

							if ( ! empty( $item['link']['url'] ) ) {
								echo '<a ' . $this->get_render_attribute_string( 'logo-link' . $i ) . '>';
							}

								echo $this->render_image( $item, $settings );

							if ( ! empty( $item['link']['url'] ) ) {
								echo '</a>';
							}
							?>
							</div>
							<?php
							if ( ! empty( $item['title'] ) ) {
								printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'title' . $i ) );
								if ( ! empty( $item['link']['url'] ) ) {
									echo '<a ' . $this->get_render_attribute_string( 'logo-link' . $i ) . '>';
								}
									echo $item['title'];
								if ( ! empty( $item['link']['url'] ) ) {
									echo '</a>';
								}
								printf( '</%1$s>', $settings['title_html_tag'] );
							}
							?>
						</div>
						<?php
				}
				$i++;
				endforeach;
			?>
		</div>
		<?php
	}

	/**
	 *  Render Image HTML.
	 *
	 *  @param string $item image attributes.
	 *  @param string $instance settings object instance.
	 *
	 * @access protected
	 */
	protected function render_image( $item, $instance ) {

		$image_id   = $item['logo_image']['id'];
		$image_size = $instance['image_size'];
		$image_alt  = esc_attr( Control_Media::get_image_alt( $item['logo_image'] ) );

		$image_url = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image', $instance );

		if ( ! $image_url ) {
			$image_url = $item['logo_image']['url'];
		}

		return sprintf( '<img src="%s" alt="%s" />', $image_url, esc_attr( $image_alt ) );
	}

	/**
	 * Render logo grid widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			var i = 1;

			view.addRenderAttribute( 'logo-grid', {
				'class': 'pp-logo-grid pp-elementor-grid clearfix',
			});

			if ( settings.grayscale_normal == 'yes' ) {
				view.addRenderAttribute( 'logo-grid', {
					'class': 'grayscale-normal',
				});
			}

			if ( settings.grayscale_hover == 'yes' ) {
				view.addRenderAttribute( 'logo-grid', {
					'class': 'grayscale-hover',
				});
			}
		#>
		<div {{{ view.getRenderAttributeString( 'logo-grid' ) }}}>
			<# _.each( settings.pp_logos, function( item ) { #>
				<# if ( item.logo_image.url != '' ) { #>
					<#
						if ( item.custom_style == 'yes' ) {
							var custom_style_class = 'pp-logo-grid-item-custom';
						}
						else {
							var custom_style_class = '';
						}
					#>
					<div class="pp-grid-item-wrap elementor-repeater-item-{{ item._id }} {{ custom_style_class }}">
						<div class="pp-grid-item">
							<# if ( item.link && item.link.url ) { #>
								<a href="{{ item.link.url }}">
							<# } #>
							<#
							if ( item.logo_image && item.logo_image.id ) {

								var image = {
									id: item.logo_image.id,
									url: item.logo_image.url,
									size: settings.image_size,
									dimension: settings.image_custom_dimension,
									model: view.getEditModel()
								};

								var image_url = elementor.imagesManager.getImageUrl( image );

								if ( ! image_url ) {
									return;
								}
							} else {

								var image_url = item.logo_image.url;
							}
							#>
							<img src="{{{ image_url }}}" alt="{{ item.title }}"/>

							<# if ( item.link && item.link.url ) { #>
								</a>
							<# } #>
						</div>
						<#
							if ( item.title != '' ) {
								var title = item.title;

								view.addRenderAttribute( 'title' + i, 'class', 'pp-logo-grid-title' );

								if ( item.link && item.link.url ) {
									title = '<a href="' + item.link.url + '">' + item.title + '</a>';
								}

								var title_html = '<' + settings.title_html_tag  + ' ' + view.getRenderAttributeString( 'title' + i ) + '>' + title + '</' + settings.title_html_tag + '>';

								print( title_html );
							}
						#>
					</div>
				<# } #>
			<# i++ } ); #>
		</div>
		<?php
	}

	/**
	 * Render logo grid widget output in the editor.
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
