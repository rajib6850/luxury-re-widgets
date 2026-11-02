<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * LRE_Title_Widget
 *
 * Standalone Luxury Title & Eyebrow Widget.
 * Designed for Adolfo Aguirre (SERHANT.) to maintain 100% typography
 * and aesthetic parity with all luxury sections, heroes, and modals.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_title';
	}

	public function get_title() {
		return __( 'LRE — Luxury Title & Eyebrow', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'title', 'heading', 'eyebrow', 'luxury', 'courier', 'typography', 'minimal' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. EYEBROW ---
		$this->start_controls_section(
			'section_eyebrow',
			array(
				'label' => __( 'Eyebrow / Sub-Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_eyebrow',
			array(
				'label'        => __( 'Show Eyebrow', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Show', 'luxury-re-widgets' ),
				'label_off'    => __( 'Hide', 'luxury-re-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'eyebrow_text',
			array(
				'label'       => __( 'Eyebrow Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'BESPOKE PROPERTY ALERTS', 'luxury-re-widgets' ),
				'condition'   => array( 'show_eyebrow' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'eyebrow_style',
			array(
				'label'     => __( 'Eyebrow Style', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'courier_gold',
				'options'   => array(
					'courier_gold' => __( 'Monospaced Gold (Courier)', 'luxury-re-widgets' ),
					'hanken_gold'  => __( 'Modern Grotesk Gold (Hanken)', 'luxury-re-widgets' ),
					'gold_bar'     => __( 'With Gold Accent Bar', 'luxury-re-widgets' ),
					'custom'       => __( 'Custom Styling', 'luxury-re-widgets' ),
				),
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// --- 2. MAIN TITLE ---
		$this->start_controls_section(
			'section_title',
			array(
				'label' => __( 'Main Title', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'title_text',
			array(
				'label'       => __( 'Title Text', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'TAILORED LISTINGS FOR YOU', 'luxury-re-widgets' ),
				'placeholder' => __( 'Enter title here (supports <br> for line breaks)...', 'luxury-re-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->add_control(
			'font_family_preset',
			array(
				'label'   => __( 'Typography Preset', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hanken',
				'options' => array(
					'courier' => __( 'Courier (Monospaced Luxury H1)', 'luxury-re-widgets' ),
					'hanken'  => __( 'Hanken Grotesk (Quiet Luxury H2/H3)', 'luxury-re-widgets' ),
					'custom'  => __( 'Custom Font (Style Tab)', 'luxury-re-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'luxury-re-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-title-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'mask_reveal',
			array(
				'label'        => __( 'Mask Reveal Animation', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => __( 'Applies the plugin’s staggered mask-reveal effect on page load or scroll.', 'luxury-re-widgets' ),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// --- STYLE: TITLE ---
		$this->start_controls_section(
			'style_title',
			array(
				'label' => __( 'Title Style', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#02293F',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-title' => 'color: {{VALUE}} !important; -webkit-text-fill-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lre-atomic-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0.8',
					'left'     => '0',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// --- STYLE: EYEBROW ---
		$this->start_controls_section(
			'style_eyebrow',
			array(
				'label'     => __( 'Eyebrow Style', 'luxury-re-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_eyebrow' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow_color',
			array(
				'label'     => __( 'Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#827A4A',
				'selectors' => array(
					'{{WRAPPER}} .lre-atomic-eyebrow' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .lre-atomic-gold-bar' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'eyebrow_typography',
				'selector' => '{{WRAPPER}} .lre-atomic-eyebrow',
			)
		);

		$this->add_responsive_control(
			'eyebrow_margin',
			array(
				'label'      => __( 'Margin', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0.6',
					'left'     => '0',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-atomic-eyebrow-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['title_text'] ) && ( 'yes' !== $settings['show_eyebrow'] || empty( $settings['eyebrow_text'] ) ) ) {
			return;
		}

		$tag           = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
		$font_preset   = $settings['font_family_preset'] ?? 'hanken';
		$font_class    = 'courier' === $font_preset ? 'lre-font--courier' : ( 'hanken' === $font_preset ? 'lre-font--hanken' : '' );
		$is_mask       = 'yes' === ( $settings['mask_reveal'] ?? 'no' );
		$is_edit_mode  = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$raw_title     = html_entity_decode( $settings['title_text'], ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$lines         = preg_split( '/<br\s*\/?>|\n/i', $raw_title );
		$clean_lines   = array_filter( array_map( 'trim', $lines ) );
		if ( empty( $clean_lines ) ) {
			$clean_lines = array( $settings['title_text'] );
		}
		?>
		<div class="lre-atomic-title-wrap">

			<?php if ( 'yes' === ( $settings['show_eyebrow'] ?? 'no' ) && ! empty( $settings['eyebrow_text'] ) ) : 
				$eyebrow_cls = 'lre-atomic-eyebrow';
				if ( 'courier_gold' === $settings['eyebrow_style'] ) {
					$eyebrow_cls .= ' lre-font--courier';
				} elseif ( 'hanken_gold' === $settings['eyebrow_style'] ) {
					$eyebrow_cls .= ' lre-font--hanken';
				}
			?>
				<div class="lre-atomic-eyebrow-wrap">
					<?php if ( 'gold_bar' === $settings['eyebrow_style'] ) : ?>
						<span class="lre-atomic-gold-bar" aria-hidden="true"></span>
					<?php endif; ?>
					<span class="<?php echo esc_attr( $eyebrow_cls ); ?>">
						<?php echo esc_html( $settings['eyebrow_text'] ); ?>
					</span>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['title_text'] ) ) : ?>
				<<?php echo esc_attr( $tag ); ?> class="lre-atomic-title <?php echo esc_attr( $font_class ); ?>">
					<?php if ( $is_mask ) : ?>
						<?php foreach ( $clean_lines as $idx => $line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>">
								<span><?php echo esc_html( $line ); ?></span>
							</span><?php if ( $idx < count( $clean_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php echo wp_kses_post( nl2br( $settings['title_text'] ) ); ?>
					<?php endif; ?>
				</<?php echo esc_attr( $tag ); ?>>
			<?php endif; ?>

		</div>
		<?php
	}
}
