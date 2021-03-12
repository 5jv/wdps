<?php
namespace PowerpackElementsLite\Modules\Twitter\Widgets;

use PowerpackElementsLite\Base\Powerpack_Widget;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Twitter Tweet Widget
 */
class Twitter_Tweet extends Powerpack_Widget {

	public function get_name() {
		return parent::get_widget_name( 'Twitter_Tweet' );
	}

	public function get_title() {
		return parent::get_widget_title( 'Twitter_Tweet' );
	}

	public function get_icon() {
		return parent::get_widget_icon( 'Twitter_Tweet' );
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
		return parent::get_widget_keywords( 'Twitter_Tweet' );
	}

	/**
	 * Retrieve the list of scripts the twitter tweet widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'pp-jquery-plugin',
			'jquery-cookie',
			'twitter-widgets',
			'powerpack-frontend',
		);
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tweet',
			array(
				'label' => __( 'Tweet', 'powerpack' ),
			)
		);

		$this->add_control(
			'tweet_url',
			array(
				'label'   => __( 'Tweet URL', 'powerpack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'theme',
			array(
				'label'   => __( 'Theme', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light' => __( 'Light', 'powerpack' ),
					'dark'  => __( 'Dark', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'expanded',
			array(
				'label'        => __( 'Expanded', 'powerpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'powerpack' ),
				'label_off'    => __( 'No', 'powerpack' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'   => __( 'Alignment', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'left'   => __( 'Left', 'powerpack' ),
					'center' => __( 'Center', 'powerpack' ),
					'right'  => __( 'Right', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'width',
			array(
				'label'      => __( 'Width', 'powerpack' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'   => __( 'Link Color', 'powerpack' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '',
			)
		);

		$this->end_controls_section();

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

	protected function render() {
		$settings = $this->get_settings();

		$attrs = array();
		$attr  = ' ';

		$url = esc_url( $settings['tweet_url'] );

		$attrs['data-theme'] = $settings['theme'];
		$attrs['data-align'] = $settings['alignment'];
		$attrs['data-lang']  = get_locale();

		if ( ! empty( $settings['width'] ) ) {
			$attrs['data-width'] = $settings['width']['size'];
		}

		if ( '' == $settings['expanded'] ) {
			$attrs['data-cards'] = 'hidden';
		}

		if ( isset( $settings['link_color'] ) && ! empty( $settings['link_color'] ) ) {
			$attrs['data-link-color'] = $settings['link_color'];
		}

		foreach ( $attrs as $key => $value ) {
			$attr .= $key;
			if ( ! empty( $value ) ) {
				$attr .= '="' . $value . '"';
			}

			$attr .= ' ';
		}

		?>
		<div class="pp-twitter-tweet" <?php echo $attr; ?>>
			<blockquote class="twitter-tweet" <?php echo $attr; ?>><a href="<?php echo $url; ?>"></a></blockquote>
		</div>
		<?php
	}

}
