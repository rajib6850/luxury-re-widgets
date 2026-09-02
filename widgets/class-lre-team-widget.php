<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * LRE_Team_Widget
 * Ultra-luxury "Meet The Team" executive & advisory showcase for the About page.
 * Features 3:4 cinematic portrait cards, smooth zoom & contrast transitions,
 * gold credential badges, and direct contact actions.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_team';
	}

	public function get_title() {
		return __( 'LRE — Meet The Team', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'team', 'agents', 'advisors', 'leadership', 'about', 'luxury', 'staff' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// ── HEADER ──
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Leadership & Advisory',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Main Headline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Minds Behind The Movement',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'A collective of industry veterans, market analysts, and architectural historians dedicated to executing the most complex transactions with absolute discretion and poise.',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'luxury-re-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'prefix_class'   => 'lre-team-grid--col-',
			)
		);

		$this->end_controls_section();

		// ── TEAM MEMBERS REPEATER ──
		$this->start_controls_section(
			'section_team_members',
			array(
				'label' => __( 'Team Members', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'member_photo',
			array(
				'label'   => __( 'Member Portrait (3:4 Ratio)', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=85',
				),
			)
		);

		$repeater->add_control(
			'member_name',
			array(
				'label'   => __( 'Full Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Victoria Sterling',
			)
		);

		$repeater->add_control(
			'member_role',
			array(
				'label'   => __( 'Role / Designation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Founder & Managing Partner',
			)
		);

		$repeater->add_control(
			'member_lic',
			array(
				'label'   => __( 'License / Credentials', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'DRE #01928472 | Top 1% Worldwide',
			)
		);

		$repeater->add_control(
			'member_bio',
			array(
				'label'   => __( 'Short Biography', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'With over 18 years specializing in ultra-prime estates in Beverly Hills and Malibu, Victoria provides peerless advisory to global family offices and cultural luminaries.',
			)
		);

		$repeater->add_control(
			'member_email',
			array(
				'label'   => __( 'Email Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'victoria@crestwoodre.com',
			)
		);

		$repeater->add_control(
			'member_phone',
			array(
				'label'   => __( 'Direct Phone', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '+1 (310) 849-2041',
			)
		);

		$repeater->add_control(
			'member_linkedin',
			array(
				'label'   => __( 'LinkedIn URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'members',
			array(
				'label'       => __( 'Members List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}} — {{{ member_role }}}',
				'default'     => array(
					array(
						'member_name'  => 'Victoria Sterling',
						'member_role'  => 'Founder & Managing Partner',
						'member_lic'   => 'DRE #01928472 | Top 1% Worldwide',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=85' ),
						'member_bio'   => 'With over 18 years specializing in ultra-prime estates in Beverly Hills and Malibu, Victoria provides peerless advisory to global family offices.',
						'member_email' => 'victoria@crestwoodre.com',
						'member_phone' => '+1 (310) 849-2041',
					),
					array(
						'member_name'  => 'Julian Montgomery',
						'member_role'  => 'Head of Private Acquisitions',
						'member_lic'   => 'DRE #02049182 | Architectural Specialist',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=800&q=85' ),
						'member_bio'   => 'Former real estate finance director with an intimate knowledge of mid-century architectural masterworks and discreet off-market transactions.',
						'member_email' => 'julian@crestwoodre.com',
						'member_phone' => '+1 (310) 849-2042',
					),
					array(
						'member_name'  => 'Evelyn St. Claire',
						'member_role'  => 'Director of Coastal Estates',
						'member_lic'   => 'DRE #01839201 | $850M+ Career Volume',
						'member_photo' => array( 'url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=800&q=85' ),
						'member_bio'   => 'A trusted advisor for beachfront enclaves spanning Pacific Palisades to Montecito, recognized for innovative marketing and negotiation prowess.',
						'member_email' => 'evelyn@crestwoodre.com',
						'member_phone' => '+1 (310) 849-2043',
					),
				),
			)
		);

		$this->end_controls_section();

		// =================================================================
		// TAB: STYLE
		// =================================================================

		// ── SECTION STYLE ──
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section Background & Spacing', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'     => __( 'Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#08080a',
				'selectors' => array(
					'{{WRAPPER}} .lre-team' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'luxury-re-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'top'      => '7',
					'right'    => '2',
					'bottom'   => '7',
					'left'     => '2',
					'unit'     => 'rem',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lre-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// ── CARD STYLE ──
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Team Cards Styling', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.03)',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Name Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .lre-team__name',
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => __( 'Role Badge Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c5a047',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__role' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bio_color',
			array(
				'label'     => __( 'Biography Text Color', 'luxury-re-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.5)',
				'selectors' => array(
					'{{WRAPPER}} .lre-team__bio' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$eyebrow = esc_html( $settings['eyebrow'] ?? 'Leadership & Advisory' );
		$title   = esc_html( $settings['title'] ?? 'The Minds Behind The Movement' );
		$desc    = esc_html( $settings['description'] ?? '' );
		$members = ! empty( $settings['members'] ) ? $settings['members'] : array();
		?>

		<section class="lre-team" id="our-team" aria-label="<?php esc_attr_e( 'Meet Our Advisory Team', 'luxury-re-widgets' ); ?>">
			<div class="lre-team__container">
				<!-- Header -->
				<div class="lre-team__header">
					<?php if ( ! empty( $eyebrow ) ) : ?>
						<div class="lre-team__eyebrow-wrap">
							<span class="lre-team__gold-bar"></span>
							<span class="lre-team__eyebrow"><?php echo $eyebrow; ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $title ) ) : ?>
						<h2 class="lre-team__title"><?php echo $title; ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $desc ) ) : ?>
						<p class="lre-team__desc"><?php echo $desc; ?></p>
					<?php endif; ?>
				</div>

				<!-- Grid -->
				<?php if ( ! empty( $members ) ) : ?>
					<div class="lre-team__grid">
						<?php foreach ( $members as $m ) :
							$photo_url = ! empty( $m['member_photo']['url'] ) ? esc_url( $m['member_photo']['url'] ) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=85';
							$name      = esc_html( $m['member_name'] ?? '' );
							$role      = esc_html( $m['member_role'] ?? '' );
							$lic       = esc_html( $m['member_lic'] ?? '' );
							$bio       = esc_html( $m['member_bio'] ?? '' );
							$email     = esc_attr( $m['member_email'] ?? '' );
							$phone     = esc_attr( $m['member_phone'] ?? '' );
							$linkedin  = ! empty( $m['member_linkedin']['url'] ) ? esc_url( $m['member_linkedin']['url'] ) : '';
							?>
							<article class="lre-team__card">
								<!-- Portrait Media -->
								<div class="lre-team__media">
									<img src="<?php echo $photo_url; ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
									<div class="lre-team__media-overlay"></div>
									
									<!-- Quick Contact Pills on Hover -->
									<div class="lre-team__contact-bar">
										<?php if ( ! empty( $email ) ) : ?>
											<a href="mailto:<?php echo $email; ?>" class="lre-team__contact-link" aria-label="<?php esc_attr_e( 'Email agent', 'luxury-re-widgets' ); ?>" title="<?php echo $email; ?>">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
											</a>
										<?php endif; ?>
										<?php if ( ! empty( $phone ) ) : ?>
											<a href="tel:<?php echo $phone; ?>" class="lre-team__contact-link" aria-label="<?php esc_attr_e( 'Call agent', 'luxury-re-widgets' ); ?>" title="<?php echo $phone; ?>">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
											</a>
										<?php endif; ?>
										<?php if ( ! empty( $linkedin ) ) : ?>
											<a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener" class="lre-team__contact-link" aria-label="<?php esc_attr_e( 'LinkedIn Profile', 'luxury-re-widgets' ); ?>">
												<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
											</a>
										<?php endif; ?>
									</div>
								</div>

								<!-- Info Block -->
								<div class="lre-team__info">
									<?php if ( ! empty( $role ) ) : ?>
										<div class="lre-team__role"><?php echo $role; ?></div>
									<?php endif; ?>

									<?php if ( ! empty( $name ) ) : ?>
										<h3 class="lre-team__name"><?php echo $name; ?></h3>
									<?php endif; ?>

									<?php if ( ! empty( $lic ) ) : ?>
										<div class="lre-team__lic"><?php echo $lic; ?></div>
									<?php endif; ?>

									<?php if ( ! empty( $bio ) ) : ?>
										<p class="lre-team__bio"><?php echo $bio; ?></p>
									<?php endif; ?>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
