<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Concierge_Widget
 * Floating back-to-top luxury concierge button with smooth scroll.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Concierge_Widget extends Widget_Base {

	public function get_name()       { return 'lre_concierge'; }
	public function get_title()      { return __( 'LRE — Floating Concierge (Back to Top)', 'luxury-re-widgets' ); }
	public function get_icon()       { return 'eicon-arrow-up'; }
	public function get_categories() { return array( 'luxury-re-widgets' ); }
	public function get_keywords()   { return array( 'back to top', 'concierge', 'scroll', 'floating', 'arrow' ); }

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================
		$this->start_controls_section( 'section_settings', array( 'label' => __( 'Button Settings', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_CONTENT ) );
		$this->add_control( 'button_label', array(
			'label'   => __( 'Accessibility Label / Title', 'luxury-re-widgets' ),
			'type'    => Controls_Manager::TEXT,
			'default' => 'Back to top',
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================
		$this->start_controls_section( 'style_button', array( 'label' => __( 'Button Style', 'luxury-re-widgets' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->start_controls_tabs( 'tabs_concierge' );

			$this->start_controls_tab( 'tab_concierge_normal', array( 'label' => __( 'Normal', 'luxury-re-widgets' ) ) );
			$this->add_control( 'icon_color', array( 'label' => __( 'Icon Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'btn_bg',     array( 'label' => __( 'Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top' => 'background-color: {{VALUE}};' ) ) );
			$this->add_control( 'border_color', array( 'label' => __( 'Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

			$this->start_controls_tab( 'tab_concierge_hover', array( 'label' => __( 'Hover', 'luxury-re-widgets' ) ) );
			$this->add_control( 'icon_color_hover', array( 'label' => __( 'Hover Icon Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top:hover' => 'color: {{VALUE}};' ) ) );
			$this->add_control( 'btn_bg_hover',     array( 'label' => __( 'Hover Background Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top:hover' => 'background-color: {{VALUE}};' ) ) );
			$this->add_control( 'border_color_hover', array( 'label' => __( 'Hover Border Color', 'luxury-re-widgets' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .back-to-top:hover' => 'border-color: {{VALUE}};' ) ) );
			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$label    = esc_attr( $settings['button_label'] );
		?>
		<button id="back-to-top" class="back-to-top" aria-label="<?php echo $label; ?>" title="<?php echo $label; ?>">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
				<path d="M12 19V5M5 12l7-7 7 7"/>
			</svg>
		</button>
		<?php
	}
}