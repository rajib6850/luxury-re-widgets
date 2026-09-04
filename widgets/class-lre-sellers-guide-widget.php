<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * LRE_Sellers_Guide_Widget
 * Super-Luxury & Minimal Architectural Estate Disposition Monograph Widget.
 * Inspired by Official Partners, Knight Frank Private Office, and Christie's International Real Estate.
 *
 * Characteristics:
 * - Ultra-minimalist fine-art monograph layout (zero cards, zero boxes, zero dashboards).
 * - Generous architectural breathing room and deep obsidian atmosphere.
 * - Sequential alternating editorial chapters (I, II, III, IV).
 * - Large-format museum architectural photography with filmic aspect ratios.
 * - 100% Elementor live editor visibility guarantee (zero black screen).
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Sellers_Guide_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_sellers_guide';
	}

	public function get_title() {
		return __( 'LRE — Seller\'s Guide', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'seller', 'guide', 'disposition', 'estate', 'luxury', 'fiduciary', 'monograph', 'minimal', 'quiet luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── SECTION 1: HEADER & WATERMARK ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header & Watermark', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Typographic Watermark', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'DISPOSITION',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Section Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Estate Divestment Protocol',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Section Heading (H2)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Art of Silent Disposition',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Heading HTML Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
				),
				'default' => 'h2',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Section Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Representing premier architectural estates and generational holdings across global capital markets with absolute discretion.',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		// ── SECTION 2: EDITORIAL MONOGRAPH CHAPTERS ──
		$this->start_controls_section(
			'section_chapters',
			array(
				'label' => __( 'Editorial Chapters (The Monograph)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'chapter_num',
			array(
				'label'   => __( 'Roman Numeral / Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'I',
			)
		);

		$repeater->add_control(
			'chapter_tag',
			array(
				'label'   => __( 'Discipline Tag', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'VALUATION & PROVENANCE',
			)
		);

		$repeater->add_control(
			'chapter_title',
			array(
				'label'   => __( 'Chapter Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Pedigree, Provenance & Pricing',
			)
		);

		$repeater->add_control(
			'chapter_narrative',
			array(
				'label'   => __( 'Editorial Narrative', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every landmark estate possesses an architectural narrative that transcends conventional appraisal. We conduct exhaustive provenance forensics and global capital liquidity modeling to establish peak sovereign valuation.',
			)
		);

		$repeater->add_control(
			'chapter_detail_label',
			array(
				'label'   => __( 'Detail Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Advisory Focus',
			)
		);

		$repeater->add_control(
			'chapter_detail_val',
			array(
				'label'   => __( 'Detail Statement', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Off-market capital flow analysis & architectural lineage audit',
			)
		);

		$repeater->add_control(
			'chapter_image',
			array(
				'label'   => __( 'Museum Photograph', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=85',
				),
			)
		);

		$repeater->add_control(
			'image_align',
			array(
				'label'   => __( 'Media Alignment', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'left'  => __( 'Media Left / Narrative Right', 'luxury-re-widgets' ),
					'right' => __( 'Narrative Left / Media Right', 'luxury-re-widgets' ),
				),
				'default' => 'left',
			)
		);

		$this->add_control(
			'chapters',
			array(
				'label'       => __( 'Chapters', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'chapter_num'          => 'I',
						'chapter_tag'          => 'VALUATION & PROVENANCE',
						'chapter_title'        => 'Pedigree, Provenance & Pricing',
						'chapter_narrative'    => 'Every landmark estate possesses an architectural narrative that transcends conventional appraisal. We conduct exhaustive provenance forensics and cross-border capital liquidity modeling to establish peak sovereign valuation.',
						'chapter_detail_label' => 'Fiduciary Focus',
						'chapter_detail_val'   => 'Off-market capital flow analysis & architectural lineage audit',
						'chapter_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=85' ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => 'II',
						'chapter_tag'          => 'SOVEREIGN DISCRETION',
						'chapter_title'        => 'The Private Sovereign Salon',
						'chapter_narrative'    => 'The most valuable assets are rarely seen on public portals. We place landmark estates directly into the hands of pre-vetted family offices, sovereign wealth principals, and institutional trustees under strict bilateral non-disclosure agreements.',
						'chapter_detail_label' => 'Syndication Protocol',
						'chapter_detail_val'   => 'Direct unlisted placement across verified global family office registries',
						'chapter_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=85' ),
						'image_align'          => 'right',
					),
					array(
						'chapter_num'          => 'III',
						'chapter_tag'          => 'NARRATIVE ARCHITECTURE',
						'chapter_title'        => 'Cinematographic Architecture & Press',
						'chapter_narrative'    => 'For estates destined for international prominence, we produce director-led 8K architectural cinema and commission bespoke 50-copy clothbound hardcover monographs, distributed exclusively to qualified global collectors and top design publications.',
						'chapter_detail_label' => 'Media Standard',
						'chapter_detail_val'   => 'Director-led 8K cinema, hardcover monographs & curated AD / FT press embargo',
						'chapter_image'        => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1400&q=85' ),
						'image_align'          => 'left',
					),
					array(
						'chapter_num'          => 'IV',
						'chapter_tag'          => 'FIDUCIARY SETTLEMENT',
						'chapter_title'        => 'Anonymous Settlement & Escrow Shielding',
						'chapter_narrative'    => 'Complete fiduciary discretion from the first confidential memorandum to private wire settlement. We orchestrate blind trust entity deeds and fortified escrow channels to guarantee zero public digital footprint.',
						'chapter_detail_label' => 'Closing Architecture',
						'chapter_detail_val'   => 'Blind trust deed filings, multi-currency escrow & complete archival handover',
						'chapter_image'        => array( 'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1400&q=85' ),
						'image_align'          => 'right',
					),
				),
				'title_field' => '{{{ chapter_num }}} — {{{ chapter_title }}}',
			)
		);

		$this->end_controls_section();

		// ── SECTION 3: MINIMAL INVITATION FOOTNOTE ──
		$this->start_controls_section(
			'section_invitation',
			array(
				'label' => __( 'Fiduciary Invitation Footnote', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_invitation',
			array(
				'label'        => __( 'Show Invitation', 'luxury-re-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'invitation_text',
			array(
				'label'     => __( 'Invitation Note', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'By private appointment only.',
				'condition' => array( 'show_invitation' => 'yes' ),
			)
		);

		$this->add_control(
			'invitation_link_text',
			array(
				'label'     => __( 'Link Text', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Initiate Confidential Consultation —→',
				'condition' => array( 'show_invitation' => 'yes' ),
			)
		);

		$this->add_control(
			'invitation_url',
			array(
				'label'         => __( 'Link Destination', 'luxury-re-widgets' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( '/contact/', 'luxury-re-widgets' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '/contact/',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'     => array( 'show_invitation' => 'yes' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = esc_attr( $settings['heading_tag'] ?? 'h2' );
		$tag      = in_array( $tag, array( 'h1', 'h2', 'h3', 'div' ), true ) ? $tag : 'h2';

		// Live Editor preview visibility guarantee
		$is_edit_mode = false;
		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->editor ) ) {
			$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
		}
		$reveal_class = $is_edit_mode ? 'revealed' : 'reveal';

		$show_watermark = ( 'yes' === $settings['show_watermark'] );
		$watermark_text = ! empty( $settings['watermark_text'] ) ? $settings['watermark_text'] : 'DISPOSITION';
		$eyebrow        = ! empty( $settings['eyebrow'] ) ? $settings['eyebrow'] : 'Estate Divestment Protocol';
		$heading_raw    = ! empty( $settings['heading'] ) ? $settings['heading'] : 'The Art of Silent Disposition';
		$description    = ! empty( $settings['description'] ) ? $settings['description'] : '';

		// Split heading lines for curtain reveal
		$clean_heading = html_entity_decode( $heading_raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$raw_lines     = preg_split( '/<br\s*\/?>|\n/i', $clean_heading );
		$heading_lines = array_filter( array_map( 'trim', $raw_lines ) );
		if ( empty( $heading_lines ) ) {
			$heading_lines = array( $heading_raw );
		}

		$chapters = ! empty( $settings['chapters'] ) ? $settings['chapters'] : array();
		?>
		<section class="lre-sguide lre-sguide--monograph" id="estate-disposition" aria-label="<?php esc_attr_e( 'Estate Divestment Protocol', 'luxury-re-widgets' ); ?>">

			<?php if ( $show_watermark && ! empty( $watermark_text ) ) : ?>
			<div class="lre-sguide__watermark" aria-hidden="true"><?php echo esc_html( $watermark_text ); ?></div>
			<?php endif; ?>

			<div class="container lre-sguide__container">

				<!-- ── 1. SECTION HEADER (Center-Aligned, Symmetrical Dual Gold Bars) ── -->
				<header class="lre-sguide__header <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $eyebrow ) ) : ?>
					<div class="lre-sguide__eyebrow-wrap">
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
						<span class="lre-sguide__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
						<span class="lre-sguide__gold-bar" aria-hidden="true"></span>
					</div>
					<?php endif; ?>

					<<?php echo $tag; ?> class="lre-sguide__title">
						<?php foreach ( $heading_lines as $h_idx => $h_line ) : ?>
							<span class="title-mask <?php echo $is_edit_mode ? 'revealed' : ''; ?>"><span><?php echo esc_html( $h_line ); ?></span></span><?php if ( $h_idx < count( $heading_lines ) - 1 ) : ?><br><?php endif; ?>
						<?php endforeach; ?>
					</<?php echo $tag; ?>>

					<?php if ( ! empty( $description ) ) : ?>
					<p class="lre-sguide__description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</header>

				<!-- ── 2. SEQUENTIAL EDITORIAL MONOGRAPH CHAPTERS ── -->
				<?php if ( ! empty( $chapters ) ) : ?>
				<div class="lre-sguide__chapters">
					<?php foreach ( $chapters as $c_idx => $ch ) :
						$align     = ! empty( $ch['image_align'] ) ? $ch['image_align'] : ( 0 === $c_idx % 2 ? 'left' : 'right' );
						$c_num     = ! empty( $ch['chapter_num'] ) ? $ch['chapter_num'] : sprintf( '%02d', $c_idx + 1 );
						$c_img     = ! empty( $ch['chapter_image']['url'] ) ? $ch['chapter_image']['url'] : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1400&q=85';
						$det_label = ! empty( $ch['chapter_detail_label'] ) ? $ch['chapter_detail_label'] : '';
						$det_val   = ! empty( $ch['chapter_detail_val'] ) ? $ch['chapter_detail_val'] : '';
					?>
					<article class="lre-sguide__chapter lre-sguide__chapter--<?php echo esc_attr( $align ); ?> <?php echo esc_attr( $reveal_class ); ?>">
						
						<!-- Media Column -->
						<div class="lre-sguide__chapter-media">
							<div class="lre-sguide__media-frame">
								<img src="<?php echo esc_url( $c_img ); ?>" alt="<?php echo esc_attr( $ch['chapter_title'] ); ?>" loading="lazy" class="lre-sguide__chapter-img">
								<div class="lre-sguide__chapter-scrim" aria-hidden="true"></div>
								<span class="lre-sguide__chapter-badge-num" aria-hidden="true"><?php echo esc_html( $c_num ); ?></span>
							</div>
						</div>

						<!-- Narrative Column -->
						<div class="lre-sguide__chapter-content">
							<div class="lre-sguide__chapter-meta">
								<span class="lre-sguide__chapter-num"><?php echo esc_html( $c_num ); ?></span>
								<span class="lre-sguide__meta-sep" aria-hidden="true">/</span>
								<span class="lre-sguide__chapter-tag"><?php echo esc_html( $ch['chapter_tag'] ); ?></span>
							</div>

							<h3 class="lre-sguide__chapter-title"><?php echo esc_html( $ch['chapter_title'] ); ?></h3>

							<p class="lre-sguide__chapter-narrative"><?php echo esc_html( $ch['chapter_narrative'] ); ?></p>

							<?php if ( ! empty( $det_val ) ) : ?>
							<div class="lre-sguide__chapter-detail">
								<?php if ( ! empty( $det_label ) ) : ?>
								<span class="lre-sguide__chapter-detail-label"><?php echo esc_html( $det_label ); ?></span>
								<?php endif; ?>
								<span class="lre-sguide__chapter-detail-val"><?php echo esc_html( $det_val ); ?></span>
							</div>
							<?php endif; ?>
						</div>

					</article>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<!-- ── 3. MINIMALIST INVITATION FOOTNOTE ── -->
				<?php if ( 'yes' === ( $settings['show_invitation'] ?? 'yes' ) ) :
					$inv_url = ! empty( $settings['invitation_url']['url'] ) ? $settings['invitation_url']['url'] : '/contact/';
					$inv_target = ! empty( $settings['invitation_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
				?>
				<div class="lre-sguide__invitation <?php echo esc_attr( $reveal_class ); ?>">
					<?php if ( ! empty( $settings['invitation_text'] ) ) : ?>
					<span class="lre-sguide__invitation-text"><?php echo esc_html( $settings['invitation_text'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['invitation_link_text'] ) ) : ?>
					<a href="<?php echo esc_url( $inv_url ); ?>" class="lre-sguide__invitation-link"<?php echo $inv_target; ?>>
						<span><?php echo esc_html( $settings['invitation_link_text'] ); ?></span>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
