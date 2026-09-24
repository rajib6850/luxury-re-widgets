<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LRE_Templates
 *
 * Manages front-end template overrides and administrative configuration
 * for luxury single post / insights layouts.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Templates {

	/** @var LRE_Templates|null Singleton instance */
	private static $instance = null;

	/**
	 * Returns singleton instance.
	 *
	 * @return LRE_Templates
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Constructor. */
	private function __construct() {
		// Front-end template override filter
		add_filter( 'single_template', array( $this, 'filter_single_template' ), 99 );

		// Register plugin options in wp-admin
		add_action( 'admin_init', array( $this, 'register_template_settings' ) );

		// Register dedicated admin menu under Settings > Luxury Single Post
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
	}

	/** Prevent cloning */
	public function __clone() {}

	/** Prevent unserializing */
	public function __wakeup() {}

	/**
	 * Registers dedicated admin submenu under WordPress Settings.
	 */
	public function register_admin_menu() {
		add_options_page(
			__( 'Luxury Single Post Settings', 'luxury-re-widgets' ),
			__( 'Luxury Single Post', 'luxury-re-widgets' ),
			'manage_options',
			'lre-single-post-settings',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Filters the single template path for standard WordPress posts.
	 *
	 * @param string $template Current template file path.
	 * @return string Modified template file path if custom template is enabled.
	 */
	public function filter_single_template( $template ) {
		if ( is_singular( 'post' ) ) {
			$enabled = get_option( 'lre_enable_single_post_template', 'yes' );
			if ( 'yes' === $enabled ) {
				$custom_template = LRE_PATH . 'templates/single-post.php';
				if ( file_exists( $custom_template ) ) {
					return $custom_template;
				}
			}
		}
		return $template;
	}

	/**
	 * Registers the single template options in WordPress Settings.
	 */
	public function register_template_settings() {
		// General toggle (also in Settings > General)
		register_setting( 'general', 'lre_enable_single_post_template', array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'yes',
		) );

		// Single Post Settings Group (used on options-general.php?page=lre-single-post-settings)
		$options = array(
			'lre_enable_single_post_template' => 'yes',
			'lre_author_name'                 => 'Adolfo Aguirre',
			'lre_author_role'                 => 'Luxury Real Estate Advisor | SERHANT. Los Angeles',
			'lre_author_dre'                  => 'DRE #02094212',
			'lre_author_bio'                  => 'With over 50 closed transactions and $49 Million+ in career sales volume, Adolfo Aguirre provides private clients, family trusts, and fiduciary principals with discreet, high-caliber representation across Pasadena, San Marino, and Greater Los Angeles.',
			'lre_author_phone'                => '(310) 346-6380',
			'lre_author_email'                => 'adolfo@serhant.com',
			'lre_author_btn_text'             => 'Request Private Consultation',
			'lre_author_btn_url'              => '',
			'lre_sidebar_brand'               => 'SERHANT.',
			'lre_sidebar_subbrand'            => 'LOS ANGELES',
			'lre_sidebar_eyebrow'             => 'PRIVATE REAL ESTATE ADVISORY',
			'lre_sidebar_name'                => 'Adolfo Aguirre',
			'lre_sidebar_role'                => 'Luxury Real Estate Advisor | DRE #02094212',
			'lre_sidebar_desc'                => 'Discreet fiduciary representation for luxury architectural estates, off-market trophy properties, and prime acquisitions across Pasadena, San Marino, and Greater Los Angeles.',
			'lre_sidebar_meta'                => 'Direct Principal Line | Los Angeles, CA',
			'lre_sidebar_btn_text'            => 'Initiate Confidential Inquiry',
			'lre_sidebar_btn_url'             => '',
		);

		foreach ( $options as $opt_key => $default_val ) {
			register_setting( 'lre_single_post_settings_group', $opt_key, array(
				'type'              => 'string',
				'sanitize_callback' => ( false !== strpos( $opt_key, 'bio' ) || false !== strpos( $opt_key, 'desc' ) ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
				'default'           => $default_val,
			) );
		}

		// Settings section in Settings > General
		add_settings_section(
			'lre_template_section',
			__( 'Luxury Real Estate — Single Post Template', 'luxury-re-widgets' ),
			function () {
				echo '<p>' . esc_html__( 'Control whether standard WordPress blog / market insights single posts use the custom Luxury Real Estate editorial layout or revert to the active theme single.php.', 'luxury-re-widgets' ) . '</p>';
			},
			'general'
		);

		add_settings_field(
			'lre_enable_single_post_template',
			__( 'Luxury Single Post Layout', 'luxury-re-widgets' ),
			function () {
				$val = get_option( 'lre_enable_single_post_template', 'yes' );
				?>
				<label for="lre_enable_single_post_template">
					<input type="checkbox" id="lre_enable_single_post_template" name="lre_enable_single_post_template" value="yes" <?php checked( $val, 'yes' ); ?>>
					<strong><?php esc_html_e( 'Enable Luxury Real Estate Editorial Single Post Template', 'luxury-re-widgets' ); ?></strong>
				</label>
				<p class="description">
					<?php
					printf(
						/* translators: %s: URL to dedicated settings page */
						__( 'To edit Author Card and Sidebar Card information, visit <a href="%s">Settings &rarr; Luxury Single Post</a>.', 'luxury-re-widgets' ),
						esc_url( admin_url( 'options-general.php?page=lre-single-post-settings' ) )
					);
					?>
				</p>
				<?php
			},
			'general',
			'lre_template_section'
		);
	}

	/**
	 * Renders the dedicated settings page under Settings > Luxury Single Post.
	 */
	public function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$enabled          = get_option( 'lre_enable_single_post_template', 'yes' );
		$author_name      = get_option( 'lre_author_name', 'Adolfo Aguirre' );
		$author_role      = get_option( 'lre_author_role', 'Luxury Real Estate Advisor | SERHANT. Los Angeles' );
		$author_dre       = get_option( 'lre_author_dre', 'DRE #02094212' );
		$author_bio       = get_option( 'lre_author_bio', 'With over 50 closed transactions and $49 Million+ in career sales volume, Adolfo Aguirre provides private clients, family trusts, and fiduciary principals with discreet, high-caliber representation across Pasadena, San Marino, and Greater Los Angeles.' );
		$author_phone     = get_option( 'lre_author_phone', '(310) 346-6380' );
		$author_email     = get_option( 'lre_author_email', 'adolfo@serhant.com' );
		$author_btn_text  = get_option( 'lre_author_btn_text', 'Request Private Consultation' );
		$author_btn_url   = get_option( 'lre_author_btn_url', '' );

		$sidebar_brand    = get_option( 'lre_sidebar_brand', 'SERHANT.' );
		$sidebar_subbrand = get_option( 'lre_sidebar_subbrand', 'LOS ANGELES' );
		$sidebar_eyebrow  = get_option( 'lre_sidebar_eyebrow', 'PRIVATE REAL ESTATE ADVISORY' );
		$sidebar_name     = get_option( 'lre_sidebar_name', 'Adolfo Aguirre' );
		$sidebar_role     = get_option( 'lre_sidebar_role', 'Luxury Real Estate Advisor | DRE #02094212' );
		$sidebar_desc     = get_option( 'lre_sidebar_desc', 'Discreet fiduciary representation for luxury architectural estates, off-market trophy properties, and prime acquisitions across Pasadena, San Marino, and Greater Los Angeles.' );
		$sidebar_meta     = get_option( 'lre_sidebar_meta', 'Direct Principal Line | Los Angeles, CA' );
		$sidebar_btn_text = get_option( 'lre_sidebar_btn_text', 'Initiate Confidential Inquiry' );
		$sidebar_btn_url  = get_option( 'lre_sidebar_btn_url', '' );
		?>
		<div class="wrap" style="max-width: 960px;">
			<h1 style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
				<span style="display:inline-block;width:12px;height:24px;background:#C5A059;border-radius:2px;"></span>
				<?php esc_html_e( 'Luxury Single Post & Editorial Dossier Settings', 'luxury-re-widgets' ); ?>
			</h1>

			<p style="font-size:14px;color:#555;margin-bottom:25px;">
				<?php esc_html_e( 'Customize the Author Card (at the bottom of articles and in the hero bar) and the Sticky Advisory Card (in the right sidebar) across all blog and market insights posts.', 'luxury-re-widgets' ); ?>
			</p>

			<form method="post" action="options.php">
				<?php settings_fields( 'lre_single_post_settings_group' ); ?>

				<!-- Card 1: Template Toggle -->
				<div class="postbox" style="padding: 16px 24px; margin-bottom: 24px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
					<h2 style="font-size: 16px; margin: 0 0 12px; padding-bottom: 8px; border-bottom: 1px solid #eee;">
						<?php esc_html_e( '1. Template Activation', 'luxury-re-widgets' ); ?>
					</h2>
					<label style="font-size: 14px; font-weight: 600; cursor: pointer;">
						<input type="checkbox" name="lre_enable_single_post_template" value="yes" <?php checked( $enabled, 'yes' ); ?>>
						<?php esc_html_e( 'Enable Luxury Real Estate Editorial Single Post Template', 'luxury-re-widgets' ); ?>
					</label>
					<p class="description" style="margin-top: 4px;">
						<?php esc_html_e( 'When active, single posts use the luxury architectural editorial design (Cinematic hero, Reading time, Author dossier, Right sidebar card, and Related market dispatches).', 'luxury-re-widgets' ); ?>
					</p>
				</div>

				<!-- Card 2: Author Card Settings -->
				<div class="postbox" style="padding: 16px 24px; margin-bottom: 24px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
					<h2 style="font-size: 16px; margin: 0 0 12px; padding-bottom: 8px; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between;">
						<span><?php esc_html_e( '2. Author Card Information (Article Bottom & Header Meta)', 'luxury-re-widgets' ); ?></span>
						<span style="font-size: 11px; background: #001A72; color: #fff; padding: 2px 8px; border-radius: 3px; font-weight: 500;">BOTTOM OF ARTICLE</span>
					</h2>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label for="lre_author_name"><?php esc_html_e( 'Author Name', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_name" name="lre_author_name" value="<?php echo esc_attr( $author_name ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_role"><?php esc_html_e( 'Author Role / Title', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_role" name="lre_author_role" value="<?php echo esc_attr( $author_role ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'e.g. Luxury Real Estate Advisor | SERHANT. Los Angeles', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_dre"><?php esc_html_e( 'DRE / License #', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_dre" name="lre_author_dre" value="<?php echo esc_attr( $author_dre ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'e.g. DRE #02094212', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_bio"><?php esc_html_e( 'Author Biography', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<textarea id="lre_author_bio" name="lre_author_bio" rows="4" class="large-text" style="width: 100%; max-width: 580px;"><?php echo esc_textarea( $author_bio ); ?></textarea>
								<p class="description"><?php esc_html_e( 'Dossier summary shown in the author card at the end of the post.', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_phone"><?php esc_html_e( 'Direct Phone Number', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_phone" name="lre_author_phone" value="<?php echo esc_attr( $author_phone ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'e.g. (310) 346-6380', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_email"><?php esc_html_e( 'Direct Email Address', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="email" id="lre_author_email" name="lre_author_email" value="<?php echo esc_attr( $author_email ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'e.g. adolfo@serhant.com', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_btn_text"><?php esc_html_e( 'Author CTA Button Text', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_btn_text" name="lre_author_btn_text" value="<?php echo esc_attr( $author_btn_text ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Default: Request Private Consultation', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_author_btn_url"><?php esc_html_e( 'Author CTA Button URL', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_author_btn_url" name="lre_author_btn_url" value="<?php echo esc_attr( $author_btn_url ); ?>" class="regular-text" placeholder="<?php echo esc_attr( home_url( '/contact/' ) ); ?>" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'Leave empty to link directly to /contact/', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
					</table>
				</div>

				<!-- Card 3: Sidebar Advisory Card Settings -->
				<div class="postbox" style="padding: 16px 24px; margin-bottom: 24px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
					<h2 style="font-size: 16px; margin: 0 0 12px; padding-bottom: 8px; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between;">
						<span><?php esc_html_e( '3. Right Sidebar Advisory Card Information', 'luxury-re-widgets' ); ?></span>
						<span style="font-size: 11px; background: #C5A059; color: #fff; padding: 2px 8px; border-radius: 3px; font-weight: 500;">RIGHT SIDEBAR</span>
					</h2>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label for="lre_sidebar_brand"><?php esc_html_e( 'Brand Wordmark', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_brand" name="lre_sidebar_brand" value="<?php echo esc_attr( $sidebar_brand ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'e.g. SERHANT.', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_subbrand"><?php esc_html_e( 'Sub-Brand / City', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_subbrand" name="lre_sidebar_subbrand" value="<?php echo esc_attr( $sidebar_subbrand ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'e.g. LOS ANGELES or PASADENA', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_eyebrow"><?php esc_html_e( 'Card Eyebrow', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_eyebrow" name="lre_sidebar_eyebrow" value="<?php echo esc_attr( $sidebar_eyebrow ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'e.g. PRIVATE REAL ESTATE ADVISORY', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_name"><?php esc_html_e( 'Advisor Name', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_name" name="lre_sidebar_name" value="<?php echo esc_attr( $sidebar_name ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_role"><?php esc_html_e( 'Advisor Role & License', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_role" name="lre_sidebar_role" value="<?php echo esc_attr( $sidebar_role ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'e.g. Luxury Real Estate Advisor | DRE #02094212', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_desc"><?php esc_html_e( 'Advisor Description', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<textarea id="lre_sidebar_desc" name="lre_sidebar_desc" rows="4" class="large-text" style="width: 100%; max-width: 580px;"><?php echo esc_textarea( $sidebar_desc ); ?></textarea>
								<p class="description"><?php esc_html_e( 'Concise representation statement shown on the sidebar card.', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_meta"><?php esc_html_e( 'Contact Sub-Note', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_meta" name="lre_sidebar_meta" value="<?php echo esc_attr( $sidebar_meta ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'e.g. Direct Principal Line | Los Angeles, CA', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_btn_text"><?php esc_html_e( 'Sidebar CTA Button Text', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_btn_text" name="lre_sidebar_btn_text" value="<?php echo esc_attr( $sidebar_btn_text ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Default: Initiate Confidential Inquiry', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="lre_sidebar_btn_url"><?php esc_html_e( 'Sidebar CTA Button URL', 'luxury-re-widgets' ); ?></label></th>
							<td>
								<input type="text" id="lre_sidebar_btn_url" name="lre_sidebar_btn_url" value="<?php echo esc_attr( $sidebar_btn_url ); ?>" class="regular-text" placeholder="<?php echo esc_attr( home_url( '/contact/' ) ); ?>" style="width: 100%; max-width: 450px;" />
								<p class="description"><?php esc_html_e( 'Leave empty to link directly to /contact/', 'luxury-re-widgets' ); ?></p>
							</td>
						</tr>
					</table>
				</div>

				<?php submit_button( __( 'Save All Changes', 'luxury-re-widgets' ), 'primary large' ); ?>
			</form>
		</div>
		<?php
	}
}
