<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

/**
 * LRE_Community_Widget
 *
 * Ultra-Luxury, Minimal, and Editorial Reusable Community Template Widget.
 * Designed for Adolfo Aguirre (SERHANT.) to showcase Pasadena, San Marino,
 * Los Angeles, and future Southern California enclaves with real architectural data.
 *
 * @package Luxury_RE_Widgets
 */
class LRE_Community_Widget extends Widget_Base {

	public function get_name() {
		return 'lre_community';
	}

	public function get_title() {
		return __( 'LRE — Luxury Community Monograph', 'luxury-re-widgets' );
	}

	public function get_icon() {
		return 'eicon-map-pin';
	}

	public function get_categories() {
		return array( 'luxury-re-widgets' );
	}

	public function get_keywords() {
		return array( 'community', 'pasadena', 'san marino', 'los angeles', 'enclave', 'luxury', 'architectural', 'editorial', 'quiet luxury' );
	}

	protected function register_controls() {

		// =================================================================
		// TAB: CONTENT
		// =================================================================

		// --- 1. MASTHEAD & HERO ---
		$this->start_controls_section(
			'section_hero',
			array(
				'label' => __( '1. Masthead & Hero', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'breadcrumb_parent',
			array(
				'label'   => __( 'Breadcrumb Parent', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'COMMUNITIES',
			)
		);

		$this->add_control(
			'breadcrumb_parent_url',
			array(
				'label'   => __( 'Breadcrumb Parent URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/communities/' ) ),
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'SOUTHERN CALIFORNIA ARCHITECTURAL ENCLAVE • DRE# 02094212',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Community Title (H1)', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Pasadena',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'       => __( 'Architectural Subtitle', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => 'The Crown City of Historic Character, Estate Acreage & Architectural Grandeur',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'coordinates',
			array(
				'label'   => __( 'Geographic Coordinates', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '34.1478° N, 118.1445° W • ELEVATION 864 FT',
			)
		);

		$this->add_control(
			'hero_image',
			array(
				'label'   => __( 'Hero Architectural Photography', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-3.jpg' ),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'   => __( 'Typographic Watermark', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PASADENA',
			)
		);

		$this->end_controls_section();

		// --- 2. INTELLIGENCE STRIP ---
		$this->start_controls_section(
			'section_intelligence',
			array(
				'label' => __( '2. Intelligence Strip (4 Metrics)', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater_metrics = new Repeater();

		$repeater_metrics->add_control(
			'label',
			array(
				'label'   => __( 'Metric Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'MEDIAN ESTATE VALUATION',
			)
		);

		$repeater_metrics->add_control(
			'value',
			array(
				'label'   => __( 'Metric Value', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$2.4M – $14.5M+',
			)
		);

		$repeater_metrics->add_control(
			'detail',
			array(
				'label'   => __( 'Subtle Detail', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Historic Craftsman & Revival premiums',
			)
		);

		$this->add_control(
			'intelligence_metrics',
			array(
				'label'       => __( 'Metrics Items', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_metrics->get_controls(),
				'default'     => array(
					array(
						'label'  => 'MEDIAN ESTATE VALUATION',
						'value'  => '$2.4M – $14.5M+',
						'detail' => 'Historic Craftsman & Revival premiums',
					),
					array(
						'label'  => 'ARCHITECTURAL PEDIGREE',
						'value'  => 'Greene & Greene • Blick',
						'detail' => 'Wallace Neff & Mid-Century icons',
					),
					array(
						'label'  => 'ENCLAVE CHARACTER',
						'value'  => 'Historic Arroyo & Manors',
						'detail' => 'Canopied avenues & bluff estates',
					),
					array(
						'label'  => 'REPRESENTATION RECORD',
						'value'  => '$49M+ Career Volume',
						'detail' => 'Landmark 6-day sale at 555 S. Grand',
					),
				),
				'title_field' => '{{{ label }}}: {{{ value }}}',
			)
		);

		$this->end_controls_section();

		// --- 3. ARCHITECTURAL NARRATIVE & INSIDER HERITAGE ---
		$this->start_controls_section(
			'section_narrative',
			array(
				'label' => __( '3. Narrative & Insider Heritage', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'quote_eyebrow',
			array(
				'label'   => __( 'Quote Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'A CURATOR’S PERSPECTIVE',
			)
		);

		$this->add_control(
			'quote_text',
			array(
				'label'   => __( 'Adolfo’s Statement Quote', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => '“Pasadena is not simply a location; it is an architectural preserve. From the storied bluffs of the Arroyo Seco to the historic estates of South Grand, representing properties here requires a curator’s eye and an uncompromising respect for provenance.”',
			)
		);

		$this->add_control(
			'quote_author',
			array(
				'label'   => __( 'Quote Author', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ADOLFO AGUIRRE',
			)
		);

		$this->add_control(
			'quote_author_sub',
			array(
				'label'   => __( 'Author Title / Accreditation', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Luxury Real Estate Advisor • SERHANT. • DRE# 02094212',
			)
		);

		$this->add_control(
			'story_eyebrow',
			array(
				'label'   => __( 'Story Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'LOCAL HERITAGE & DISCRETION',
			)
		);

		$this->add_control(
			'story_title',
			array(
				'label'   => __( 'Story Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Preserving Provenance in Southern California’s Cultural Capital',
			)
		);

		$this->add_control(
			'story_p1',
			array(
				'label'   => __( 'Narrative Paragraph 1', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'Framed by the San Gabriel Mountains and the dramatic Arroyo Seco bluffs, Pasadena stands as Southern California’s premier sanctuary of preserved architectural integrity. Unlike homogenized suburban developments, Pasadena’s streetscapes are an evolving dialogue between early 20th-century visionary architects and contemporary custodians.',
			)
		);

		$this->add_control(
			'story_p2',
			array(
				'label'   => __( 'Narrative Paragraph 2', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'With over 50 closed transactions and $49 Million+ in career sales volume, Adolfo Aguirre provides private clients, family trusts, and fiduciary principals with discreet, high-caliber representation. From securing competitive off-market acquisitions along South Orange Grove to orchestrating record-setting campaigns—such as 555 S. Grand Ave, which closed in just 6 days for $100,000 over asking price—every transaction is executed with bespoke strategy and global SERHANT. media power.',
			)
		);

		$this->add_control(
			'stat1_num',
			array(
				'label'   => __( 'Stat 1 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1886',
			)
		);

		$this->add_control(
			'stat1_label',
			array(
				'label'   => __( 'Stat 1 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FOUNDED HERITAGE',
			)
		);

		$this->add_control(
			'stat2_num',
			array(
				'label'   => __( 'Stat 2 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '100+',
			)
		);

		$this->add_control(
			'stat2_label',
			array(
				'label'   => __( 'Stat 2 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'HISTORIC LANDMARKS',
			)
		);

		$this->add_control(
			'stat3_num',
			array(
				'label'   => __( 'Stat 3 Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5M+',
			)
		);

		$this->add_control(
			'stat3_label',
			array(
				'label'   => __( 'Stat 3 Label', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SERHANT. MEDIA AUDIENCE',
			)
		);

		$this->end_controls_section();

		// --- 4. ENCLAVES DIRECTORY ---
		$this->start_controls_section(
			'section_enclaves',
			array(
				'label' => __( '4. Micro-Enclaves Directory', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'enclaves_eyebrow',
			array(
				'label'   => __( 'Enclaves Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'DISTRICT DOSSIER',
			)
		);

		$this->add_control(
			'enclaves_title',
			array(
				'label'   => __( 'Enclaves Section Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Curated Micro-Enclaves & Neighborhoods',
			)
		);

		$this->add_control(
			'enclaves_subtitle',
			array(
				'label'   => __( 'Enclaves Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Explore the distinct architectural signatures, lot scales, and community ambiance that define Pasadena’s most distinguished residential territories.',
			)
		);

		$repeater_enclaves = new Repeater();

		$repeater_enclaves->add_control(
			'index_num',
			array(
				'label'   => __( 'Index Number', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater_enclaves->add_control(
			'name',
			array(
				'label'   => __( 'Enclave Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'South Grand & Arroyo Seco',
			)
		);

		$repeater_enclaves->add_control(
			'tag',
			array(
				'label'   => __( 'Enclave Tag / Moniker', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ESTATE ROW • BLUFF SANCTUARY',
			)
		);

		$repeater_enclaves->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Perched above the dramatic Arroyo Seco bluffs, South Grand Avenue is celebrated for grand Craftsman, Tudor, and Mediterranean revival estates crafted by master architects J.J. Blick, Myron Hunt, and Greene & Greene. Site of Adolfo’s landmark sales at 555 and 788 S. Grand Ave.',
			)
		);

		$repeater_enclaves->add_control(
			'style',
			array(
				'label'   => __( 'Architectural Style', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Craftsman, Prairie & Spanish Revival',
			)
		);

		$repeater_enclaves->add_control(
			'image',
			array(
				'label'   => __( 'Enclave Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-1.jpg' ),
				),
			)
		);

		$this->add_control(
			'enclaves_list',
			array(
				'label'       => __( 'Enclaves List', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_enclaves->get_controls(),
				'default'     => array(
					array(
						'index_num'   => '01',
						'name'        => 'South Grand & Arroyo Seco',
						'tag'         => 'ESTATE ROW • BLUFF SANCTUARY',
						'description' => 'Perched above the historic Arroyo Seco bluffs, South Grand Avenue is celebrated for grand Craftsman, Tudor, and Mediterranean revival estates crafted by master architects J.J. Blick, Myron Hunt, and Greene & Greene. Site of Adolfo’s landmark sales at 555 and 788 S. Grand Ave.',
						'style'       => 'Craftsman, Prairie & Spanish Revival',
						'image'       => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
					),
					array(
						'index_num'   => '02',
						'name'        => 'South Orange Grove Boulevard',
						'tag'         => 'MILLIONAIRE\'S ROW • GARDEN ESTATES',
						'description' => 'Historically revered as Pasadena’s "Millionaire’s Row", this majestic palm-lined avenue showcases expansive luxury garden estates, classic architectural pedigree, and direct proximity to the historic Tournament House.',
						'style'       => 'Mid-Century Modern & Grand Traditional',
						'image'       => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ),
					),
					array(
						'index_num'   => '03',
						'name'        => 'Madison Heights',
						'tag'         => 'CANOPIED OAKS • ARCHITECTURAL CHARM',
						'description' => 'One of Pasadena’s most sought-after neighborhood pockets, characterized by towering jacaranda and live oak canopies, pristine Craftsman bungalows, and gracious Colonial Revival family estates.',
						'style'       => 'Ultimate Craftsman & Colonial Revival',
						'image'       => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
					),
					array(
						'index_num'   => '04',
						'name'        => 'Linda Vista & Annandale',
						'tag'         => 'HILLSIDE DISCRETION • GOLF VIEWS',
						'description' => 'Tucked into the western hills overlooking the Rose Bowl and Annandale Golf Club, Linda Vista offers secluded privacy, generous acreage, and dramatic Mid-Century Modern architectural view properties.',
						'style'       => 'Post-and-Beam & Contemporary Hillside',
						'image'       => array( 'url' => lre_asset_url( 'images/property-7.jpg' ) ),
					),
				),
				'title_field' => '{{{ index_num }}} — {{{ name }}}',
			)
		);

		$this->end_controls_section();

		// --- 5. LOCAL SALES LEDGER ---
		$this->start_controls_section(
			'section_sales',
			array(
				'label' => __( '5. Local Landmark Sales Ledger', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sales_eyebrow',
			array(
				'label'   => __( 'Sales Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'LOCAL PROVENANCE • RECORD SALES',
			)
		);

		$this->add_control(
			'sales_title',
			array(
				'label'   => __( 'Sales Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Landmark Pasadena Transactions',
			)
		);

		$this->add_control(
			'sales_subtitle',
			array(
				'label'   => __( 'Sales Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'A verified record of discreet representation, record prices, and swift dispositions across Pasadena’s most storied avenues.',
			)
		);

		$repeater_sales = new Repeater();

		$repeater_sales->add_control(
			'address',
			array(
				'label'   => __( 'Property Address', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '555 S. Grand Ave, Pasadena',
			)
		);

		$repeater_sales->add_control(
			'price',
			array(
				'label'   => __( 'Sold Price / Record', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$2,500,000+',
			)
		);

		$repeater_sales->add_control(
			'badge',
			array(
				'label'   => __( 'Achievement Badge', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SOLD IN 6 DAYS • $100K OVER ASKING',
			)
		);

		$repeater_sales->add_control(
			'specs',
			array(
				'label'   => __( 'Property Specs', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '5 BEDS • 4.5 BATHS • 4,820 SQFT • 1910 J.J. BLICK',
			)
		);

		$repeater_sales->add_control(
			'narrative',
			array(
				'label'   => __( 'Transaction Insight', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => '1910 J.J. Blick Landmark Estate. Dual agency representation (Buyer & Seller). Generated intense competitive private interest and closed over asking price.',
			)
		);

		$repeater_sales->add_control(
			'image',
			array(
				'label'   => __( 'Property Photo', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-6.jpg' ),
				),
			)
		);

		$this->add_control(
			'sales_list',
			array(
				'label'       => __( 'Landmark Transactions', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_sales->get_controls(),
				'default'     => array(
					array(
						'address'   => '555 S. Grand Ave, Pasadena',
						'price'     => '$2,500,000+',
						'badge'     => 'SOLD IN 6 DAYS • $100K OVER ASKING',
						'specs'     => '5 BEDS • 4.5 BATHS • 4,820 SQFT • 1910 J.J. BLICK',
						'narrative' => '1910 J.J. Blick Landmark Estate. Dual agency representation (Buyer & Seller). Generated intense competitive private interest and closed over asking price.',
						'image'     => array( 'url' => lre_asset_url( 'images/property-6.jpg' ) ),
					),
					array(
						'address'   => 'The Villetta — 788 S. Grand Ave, Pasadena',
						'price'     => '$3,800,000',
						'badge'     => 'CLOSED IN 16 DAYS • ALL-CASH',
						'specs'     => 'HISTORIC MEDITERRANEAN ESTATE • SOUTH GRAND',
						'narrative' => 'Represented the Buyer on an ultra-rare architectural treasure. Coordinated discreet sovereign escrow protocol and secured prompt 16-day closing.',
						'image'     => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
					),
					array(
						'address'   => '1485 Lombardy Rd, Pasadena',
						'price'     => '$4,600,000',
						'badge'     => 'PREMIER ESTATE CORRIDOR',
						'specs'     => 'ESTATE GROUNDS • POOL • PRIVATE GROVE',
						'narrative' => 'Prime estate corridor representation with uncompromising client discretion and contract execution.',
						'image'     => array( 'url' => lre_asset_url( 'images/property-8.jpg' ) ),
					),
					array(
						'address'   => '1205 S. Orange Grove Blvd, Pasadena',
						'price'     => '$2,150,000',
						'badge'     => 'MILLIONAIRE’S ROW RECORD',
						'specs'     => '3 BEDS • 3 BATHS • LUXURY RESIDENCE',
						'narrative' => 'Represented Sellers on Millionaire’s Row, generating competitive multi-buyer interest through targeted media distribution.',
						'image'     => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
					),
				),
				'title_field' => '{{{ address }}} — {{{ price }}}',
			)
		);

		$this->end_controls_section();

		// --- 6. LIFESTYLE & CULTURAL FABRIC ---
		$this->start_controls_section(
			'section_lifestyle',
			array(
				'label' => __( '6. Lifestyle & Cultural Fabric', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'lifestyle_eyebrow',
			array(
				'label'   => __( 'Lifestyle Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'THE PASADENA MANNER',
			)
		);

		$this->add_control(
			'lifestyle_title',
			array(
				'label'   => __( 'Lifestyle Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Institutions, Culture & Private Leisure',
			)
		);

		$this->add_control(
			'lifestyle_subtitle',
			array(
				'label'   => __( 'Lifestyle Subtitle', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => 'Life in Pasadena is anchored by storied private athletic clubs, internationally renowned cultural institutions, and effortless proximity to natural preserves.',
			)
		);

		$repeater_life = new Repeater();

		$repeater_life->add_control(
			'category',
			array(
				'label'   => __( 'Pillar Category', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'PRIVATE CLUBS & RECREATION',
			)
		);

		$repeater_life->add_control(
			'title',
			array(
				'label'   => __( 'Pillar Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Valley Hunt Club & Annandale',
			)
		);

		$repeater_life->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Founded in 1888 (the birthplace of the Rose Parade), The Valley Hunt Club and the private fairways of Annandale Golf Club anchor Pasadena’s quiet, multi-generational social calendar.',
			)
		);

		$repeater_life->add_control(
			'image',
			array(
				'label'   => __( 'Pillar Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-9.jpg' ),
				),
			)
		);

		$this->add_control(
			'lifestyle_list',
			array(
				'label'       => __( 'Lifestyle Pillars', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_life->get_controls(),
				'default'     => array(
					array(
						'category'    => 'PRIVATE CLUBS & RECREATION',
						'title'       => 'The Valley Hunt Club & Annandale',
						'description' => 'Founded in 1888 (the birthplace of the Rose Parade), The Valley Hunt Club and the private fairways of Annandale Golf Club anchor Pasadena’s quiet, multi-generational social calendar.',
						'image'       => array( 'url' => lre_asset_url( 'images/property-9.jpg' ) ),
					),
					array(
						'category'    => 'CULTURAL MASTERPIECES',
						'title'       => 'The Norton Simon & Gamble House',
						'description' => 'Home to one of the world’s most distinguished European and Asian art collections, alongside Greene & Greene’s ultimate architectural masterpiece, The Gamble House, and the historic Pasadena Playhouse.',
						'image'       => array( 'url' => lre_asset_url( 'images/property-1.jpg' ) ),
					),
					array(
						'category'    => 'NATURAL PRESERVES & BOTANY',
						'title'       => 'Arroyo Seco Trails & Huntington Border',
						'description' => 'Miles of secluded equestrian and hiking trails through the dramatic Arroyo Seco basin, moments away from the 120-acre botanical sanctuaries of the adjacent Huntington Library.',
						'image'       => array( 'url' => lre_asset_url( 'images/property-2.jpg' ) ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		// --- 7. PRIVATE VALUATION & ADVISORY CTA ---
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => __( '7. Private Advisory & Valuation CTA', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'cta_eyebrow',
			array(
				'label'   => __( 'CTA Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'CONFIDENTIAL ESTATE REPRESENTATION • SERHANT.',
			)
		);

		$this->add_control(
			'cta_title',
			array(
				'label'   => __( 'CTA Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Considering Acquiring or Representing an Estate in Pasadena?',
			)
		);

		$this->add_control(
			'cta_description',
			array(
				'label'   => __( 'CTA Description', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => 'Whether orchestrating a confidential probate disposition, evaluating an off-market architectural treasure, or assessing current market liquidity, Adolfo Aguirre offers bespoke private advisory backed by the global reach of SERHANT.',
			)
		);

		$this->add_control(
			'cta_btn1_text',
			array(
				'label'   => __( 'Primary Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REQUEST CONFIDENTIAL VALUATION',
			)
		);

		$this->add_control(
			'cta_btn1_url',
			array(
				'label'   => __( 'Primary Button URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/home-valuation/' ) ),
			)
		);

		$this->add_control(
			'cta_btn2_text',
			array(
				'label'   => __( 'Secondary Button Text', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SCHEDULE A PRIVATE CONVERSATION',
			)
		);

		$this->add_control(
			'cta_btn2_url',
			array(
				'label'   => __( 'Secondary Button URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/contact/' ) ),
			)
		);

		$this->end_controls_section();

		// --- 8. SISTER ENCLAVES SWITCHER ---
		$this->start_controls_section(
			'section_switcher',
			array(
				'label' => __( '8. Sister Enclaves Switcher', 'luxury-re-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'switcher_eyebrow',
			array(
				'label'   => __( 'Switcher Eyebrow', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REGIONAL PORTFOLIO',
			)
		);

		$this->add_control(
			'switcher_title',
			array(
				'label'   => __( 'Switcher Title', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore Neighboring Territories',
			)
		);

		$repeater_switch = new Repeater();

		$repeater_switch->add_control(
			'name',
			array(
				'label'   => __( 'Community Name', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'San Marino',
			)
		);

		$repeater_switch->add_control(
			'tagline',
			array(
				'label'   => __( 'Tagline', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
			)
		);

		$repeater_switch->add_control(
			'link',
			array(
				'label'   => __( 'Link URL', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/communities/san-marino/' ) ),
			)
		);

		$repeater_switch->add_control(
			'image',
			array(
				'label'   => __( 'Community Image', 'luxury-re-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => lre_asset_url( 'images/property-4.jpg' ),
				),
			)
		);

		$this->add_control(
			'switcher_list',
			array(
				'label'       => __( 'Sister Communities', 'luxury-re-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_switch->get_controls(),
				'default'     => array(
					array(
						'name'    => 'San Marino',
						'tagline' => 'Enduring Prestige, Generational Acreage & Quiet Grandeur',
						'link'    => array( 'url' => home_url( '/communities/san-marino/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-4.jpg' ) ),
					),
					array(
						'name'    => 'Los Angeles',
						'tagline' => 'Iconic Modernism, Hillside Sanctuaries & Cultural Capital',
						'link'    => array( 'url' => home_url( '/communities/los-angeles/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-5.jpg' ) ),
					),
					array(
						'name'    => 'All Communities Hub',
						'tagline' => 'View Full Southern California Architectural Enclaves',
						'link'    => array( 'url' => home_url( '/communities/' ) ),
						'image'   => array( 'url' => lre_asset_url( 'images/property-3.jpg' ) ),
					),
				),
				'title_field' => '{{{ name }}}',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$hero_img_url = ! empty( $settings['hero_image']['url'] ) ? lre_resolve_image_url( $settings['hero_image']['url'] ) : lre_asset_url( 'images/property-3.jpg' );
		$parent_url   = ! empty( $settings['breadcrumb_parent_url']['url'] ) ? esc_url( $settings['breadcrumb_parent_url']['url'] ) : home_url( '/communities/' );
		?>
		<article class="lre-community" id="community-monograph">

			<!-- =================================================================
			     1. MASTHEAD & HERO SECTION
			================================================================== -->
			<header class="lre-community__hero">
				<div class="lre-community__hero-bg">
					<img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?> Architectural Estate" class="lre-community__hero-img" loading="eager" />
					<div class="lre-community__hero-scrim"></div>
				</div>

				<?php if ( ! empty( $settings['watermark_text'] ) ) : ?>
					<div class="lre-community__watermark" aria-hidden="true">
						<?php echo esc_html( $settings['watermark_text'] ); ?>
					</div>
				<?php endif; ?>

				<div class="lre-community__hero-inner">
					<div class="lre-community__breadcrumbs">
						<a href="<?php echo $parent_url; ?>" class="lre-community__crumb"><?php echo esc_html( $settings['breadcrumb_parent'] ); ?></a>
						<span class="lre-community__crumb-sep">/</span>
						<span class="lre-community__crumb lre-community__crumb--active"><?php echo esc_html( $settings['title'] ); ?></span>
					</div>

					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<p class="lre-community__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
					<?php endif; ?>

					<h1 class="lre-community__title"><?php echo esc_html( $settings['title'] ); ?></h1>

					<?php if ( ! empty( $settings['tagline'] ) ) : ?>
						<p class="lre-community__tagline"><?php echo esc_html( $settings['tagline'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $settings['coordinates'] ) ) : ?>
						<div class="lre-community__coordinates">
							<span class="lre-community__coord-dot"></span>
							<?php echo esc_html( $settings['coordinates'] ); ?>
						</div>
					<?php endif; ?>
				</div>
			</header>

			<!-- =================================================================
			     2. MINIMALIST 4-POINT INTELLIGENCE STRIP
			================================================================== -->
			<?php if ( ! empty( $settings['intelligence_metrics'] ) ) : ?>
				<section class="lre-community__intel" aria-label="Community Market Intelligence">
					<div class="lre-community__intel-grid">
						<?php foreach ( $settings['intelligence_metrics'] as $metric ) : ?>
							<div class="lre-community__intel-item">
								<span class="lre-community__intel-label"><?php echo esc_html( $metric['label'] ); ?></span>
								<span class="lre-community__intel-val"><?php echo esc_html( $metric['value'] ); ?></span>
								<?php if ( ! empty( $metric['detail'] ) ) : ?>
									<span class="lre-community__intel-detail"><?php echo esc_html( $metric['detail'] ); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endif; ?>

			<!-- =================================================================
			     3. ARCHITECTURAL NARRATIVE & INSIDER HERITAGE
			================================================================== -->
			<section class="lre-community__narrative">
				<div class="lre-community__container">
					<div class="lre-community__narrative-grid">
						
						<!-- Left: Statement Quote -->
						<div class="lre-community__quote-card">
							<div class="lre-community__gold-line"></div>
							<?php if ( ! empty( $settings['quote_eyebrow'] ) ) : ?>
								<span class="lre-community__quote-eyebrow"><?php echo esc_html( $settings['quote_eyebrow'] ); ?></span>
							<?php endif; ?>
							<blockquote class="lre-community__quote-body">
								<?php echo wp_kses_post( $settings['quote_text'] ); ?>
							</blockquote>
							<cite class="lre-community__quote-cite">
								<strong><?php echo esc_html( $settings['quote_author'] ); ?></strong>
								<span><?php echo esc_html( $settings['quote_author_sub'] ); ?></span>
							</cite>
						</div>

						<!-- Right: Curated Story & Stats -->
						<div class="lre-community__story-content">
							<?php if ( ! empty( $settings['story_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['story_eyebrow'] ); ?></span>
							<?php endif; ?>

							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['story_title'] ); ?></h2>

							<div class="lre-community__prose">
								<p><?php echo esc_html( $settings['story_p1'] ); ?></p>
								<p><?php echo esc_html( $settings['story_p2'] ); ?></p>
							</div>

							<div class="lre-community__stats-row">
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat1_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat1_label'] ); ?></span>
								</div>
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat2_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat2_label'] ); ?></span>
								</div>
								<div class="lre-community__stat-box">
									<span class="lre-community__stat-num"><?php echo esc_html( $settings['stat3_num'] ); ?></span>
									<span class="lre-community__stat-label"><?php echo esc_html( $settings['stat3_label'] ); ?></span>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>

			<!-- =================================================================
			     4. MICRO-ENCLAVES DIRECTORY
			================================================================== -->
			<?php if ( ! empty( $settings['enclaves_list'] ) ) : ?>
				<section class="lre-community__enclaves" id="enclaves">
					<div class="lre-community__container">
						<div class="lre-community__section-head">
							<?php if ( ! empty( $settings['enclaves_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['enclaves_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['enclaves_title'] ); ?></h2>
							<?php if ( ! empty( $settings['enclaves_subtitle'] ) ) : ?>
								<p class="lre-community__section-sub"><?php echo esc_html( $settings['enclaves_subtitle'] ); ?></p>
							<?php endif; ?>
						</div>

						<div class="lre-community__enclaves-grid">
							<?php foreach ( $settings['enclaves_list'] as $enclave ) : 
								$enc_img = ! empty( $enclave['image']['url'] ) ? lre_resolve_image_url( $enclave['image']['url'] ) : lre_asset_url( 'images/property-1.jpg' );
							?>
								<div class="lre-community__enclave-card">
									<div class="lre-community__enclave-media">
										<img src="<?php echo esc_url( $enc_img ); ?>" alt="<?php echo esc_attr( $enclave['name'] ); ?>" class="lre-community__enclave-img" loading="lazy" />
										<span class="lre-community__enclave-num"><?php echo esc_html( $enclave['index_num'] ); ?></span>
									</div>
									<div class="lre-community__enclave-content">
										<span class="lre-community__enclave-tag"><?php echo esc_html( $enclave['tag'] ); ?></span>
										<h3 class="lre-community__enclave-name"><?php echo esc_html( $enclave['name'] ); ?></h3>
										<p class="lre-community__enclave-desc"><?php echo esc_html( $enclave['description'] ); ?></p>
										<?php if ( ! empty( $enclave['style'] ) ) : ?>
											<div class="lre-community__enclave-style">
												<span class="lre-community__style-label">ARCHITECTURAL SIGNATURE</span>
												<span class="lre-community__style-val"><?php echo esc_html( $enclave['style'] ); ?></span>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<!-- =================================================================
			     5. LOCAL LANDMARK SALES LEDGER
			================================================================== -->
			<?php if ( ! empty( $settings['sales_list'] ) ) : ?>
				<section class="lre-community__sales" id="notable-sales">
					<div class="lre-community__container">
						<div class="lre-community__section-head lre-community__section-head--center">
							<?php if ( ! empty( $settings['sales_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['sales_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['sales_title'] ); ?></h2>
							<?php if ( ! empty( $settings['sales_subtitle'] ) ) : ?>
								<p class="lre-community__section-sub"><?php echo esc_html( $settings['sales_subtitle'] ); ?></p>
							<?php endif; ?>
						</div>

						<div class="lre-community__sales-grid">
							<?php foreach ( $settings['sales_list'] as $sale ) : 
								$sale_img = ! empty( $sale['image']['url'] ) ? lre_resolve_image_url( $sale['image']['url'] ) : lre_asset_url( 'images/property-6.jpg' );
							?>
								<div class="lre-community__sale-card">
									<div class="lre-community__sale-media">
										<img src="<?php echo esc_url( $sale_img ); ?>" alt="<?php echo esc_attr( $sale['address'] ); ?>" class="lre-community__sale-img" loading="lazy" />
										<?php if ( ! empty( $sale['badge'] ) ) : ?>
											<span class="lre-community__sale-badge"><?php echo esc_html( $sale['badge'] ); ?></span>
										<?php endif; ?>
									</div>
									<div class="lre-community__sale-content">
										<div class="lre-community__sale-top">
											<h3 class="lre-community__sale-address"><?php echo esc_html( $sale['address'] ); ?></h3>
											<span class="lre-community__sale-price"><?php echo esc_html( $sale['price'] ); ?></span>
										</div>
										<?php if ( ! empty( $sale['specs'] ) ) : ?>
											<div class="lre-community__sale-specs"><?php echo esc_html( $sale['specs'] ); ?></div>
										<?php endif; ?>
										<p class="lre-community__sale-narrative"><?php echo esc_html( $sale['narrative'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<!-- =================================================================
			     6. LIFESTYLE & CULTURAL FABRIC
			================================================================== -->
			<?php if ( ! empty( $settings['lifestyle_list'] ) ) : ?>
				<section class="lre-community__lifestyle">
					<div class="lre-community__container">
						<div class="lre-community__section-head">
							<?php if ( ! empty( $settings['lifestyle_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['lifestyle_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['lifestyle_title'] ); ?></h2>
							<?php if ( ! empty( $settings['lifestyle_subtitle'] ) ) : ?>
								<p class="lre-community__section-sub"><?php echo esc_html( $settings['lifestyle_subtitle'] ); ?></p>
							<?php endif; ?>
						</div>

						<div class="lre-community__life-grid">
							<?php foreach ( $settings['lifestyle_list'] as $pillar ) : 
								$life_img = ! empty( $pillar['image']['url'] ) ? lre_resolve_image_url( $pillar['image']['url'] ) : lre_asset_url( 'images/property-9.jpg' );
							?>
								<div class="lre-community__life-card">
									<div class="lre-community__life-media">
										<img src="<?php echo esc_url( $life_img ); ?>" alt="<?php echo esc_attr( $pillar['title'] ); ?>" class="lre-community__life-img" loading="lazy" />
									</div>
									<div class="lre-community__life-body">
										<span class="lre-community__life-cat"><?php echo esc_html( $pillar['category'] ); ?></span>
										<h3 class="lre-community__life-title"><?php echo esc_html( $pillar['title'] ); ?></h3>
										<p class="lre-community__life-desc"><?php echo esc_html( $pillar['description'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<!-- =================================================================
			     7. PRIVATE ADVISORY & VALUATION CTA
			================================================================== -->
			<section class="lre-community__cta">
				<div class="lre-community__container">
					<div class="lre-community__cta-card">
						<div class="lre-community__cta-glow"></div>
						<div class="lre-community__cta-content">
							<?php if ( ! empty( $settings['cta_eyebrow'] ) ) : ?>
								<span class="lre-community__cta-eyebrow"><?php echo esc_html( $settings['cta_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__cta-title"><?php echo esc_html( $settings['cta_title'] ); ?></h2>
							<p class="lre-community__cta-desc"><?php echo esc_html( $settings['cta_description'] ); ?></p>
							
							<div class="lre-community__cta-actions">
								<?php if ( ! empty( $settings['cta_btn1_text'] ) ) : 
									$btn1_url = ! empty( $settings['cta_btn1_url']['url'] ) ? esc_url( $settings['cta_btn1_url']['url'] ) : home_url( '/home-valuation/' );
								?>
									<a href="<?php echo $btn1_url; ?>" class="lre-community__btn lre-community__btn--primary">
										<span><?php echo esc_html( $settings['cta_btn1_text'] ); ?></span>
									</a>
								<?php endif; ?>

								<?php if ( ! empty( $settings['cta_btn2_text'] ) ) : 
									$btn2_url = ! empty( $settings['cta_btn2_url']['url'] ) ? esc_url( $settings['cta_btn2_url']['url'] ) : home_url( '/contact/' );
								?>
									<a href="<?php echo $btn2_url; ?>" class="lre-community__btn lre-community__btn--secondary">
										<span><?php echo esc_html( $settings['cta_btn2_text'] ); ?></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- =================================================================
			     8. SISTER ENCLAVES SWITCHER
			================================================================== -->
			<?php if ( ! empty( $settings['switcher_list'] ) ) : ?>
				<section class="lre-community__switcher">
					<div class="lre-community__container">
						<div class="lre-community__switcher-head">
							<?php if ( ! empty( $settings['switcher_eyebrow'] ) ) : ?>
								<span class="lre-community__section-eyebrow"><?php echo esc_html( $settings['switcher_eyebrow'] ); ?></span>
							<?php endif; ?>
							<h2 class="lre-community__section-title"><?php echo esc_html( $settings['switcher_title'] ); ?></h2>
						</div>

						<div class="lre-community__switcher-grid">
							<?php foreach ( $settings['switcher_list'] as $sister ) : 
								$sis_img = ! empty( $sister['image']['url'] ) ? lre_resolve_image_url( $sister['image']['url'] ) : lre_asset_url( 'images/property-4.jpg' );
								$sis_url = ! empty( $sister['link']['url'] ) ? esc_url( $sister['link']['url'] ) : '#';
							?>
								<a href="<?php echo $sis_url; ?>" class="lre-community__sister-card">
									<div class="lre-community__sister-media">
										<img src="<?php echo esc_url( $sis_img ); ?>" alt="<?php echo esc_attr( $sister['name'] ); ?>" class="lre-community__sister-img" loading="lazy" />
										<div class="lre-community__sister-scrim"></div>
									</div>
									<div class="lre-community__sister-content">
										<span class="lre-community__sister-eyebrow">ENCLAVE</span>
										<h3 class="lre-community__sister-name"><?php echo esc_html( $sister['name'] ); ?></h3>
										<p class="lre-community__sister-tagline"><?php echo esc_html( $sister['tagline'] ); ?></p>
										<span class="lre-community__sister-arrow">EXPLORE TERRITORY &rarr;</span>
									</div>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>

		</article>
		<?php
	}
}
