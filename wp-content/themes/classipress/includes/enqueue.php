<?php
/**
 * Enqueue of scripts and styles.
 *
 * @package ClassiPress\Enqueue
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */


/**
 * Enqueue scripts.
 *
 * @return void
 */
if ( ! function_exists( 'cp_load_scripts' ) ) :
function cp_load_scripts() {
	global $cp_options;

	// load google cdn hosted scripts if enabled
	if ( $cp_options->google_jquery ) {
		wp_deregister_script( 'jquery' );
		$protocol = is_ssl() ? 'https' : 'http';
		wp_register_script( 'jquery', $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2' );
	}

	// needed for single ad sidebar email & comments on pages, edit ad & profile pages, ads, blog posts
	if ( is_singular() ) {
		wp_enqueue_script( 'validate' );
		wp_enqueue_script( 'validate-lang' );
	}

	// search autocomplete and slider on certain pages
	wp_enqueue_script( 'jquery-ui-autocomplete' );

	// advanced search sidebar and home page carousel
	wp_enqueue_script( 'jquery-ui-slider' );

	// used to convert header menu into select list on mobile devices
	wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/includes/js/jquery.tinynav.js', array( 'jquery' ), '1.1' );
	// used to transform tables on mobile devices
	wp_enqueue_script( 'footable' );

	// adds touch events to jQuery UI on mobile devices
	if ( wp_is_mobile() ) {
		wp_enqueue_script( 'jquery-touch-punch' );
	}

	if ( ! wp_is_mobile() && $cp_options->selectbox ) {
		// styles select elements
		wp_enqueue_script( 'selectbox', get_template_directory_uri() . '/includes/js/jquery.selectBox.min.js', array( 'jquery' ), '1.2.0' );
	}

	if ( $cp_options->enable_featured && is_page_template( 'tpl-ads-home.php' ) ) {
		wp_enqueue_script( 'jqueryeasing', get_template_directory_uri() . '/includes/js/easing.js', array( 'jquery' ), '1.3' );
		wp_enqueue_script( 'jcarousellite', get_template_directory_uri() . '/includes/js/jcarousellite.min.js', array( 'jquery', 'jquery-ui-slider' ), '1.9.2' );
	}

	wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/includes/js/theme-scripts.js', array( 'jquery' ), '3.3.3' );

	// only load the general.js if available in child theme
	if ( file_exists( get_stylesheet_directory() . '/general.js' ) ) {
		wp_enqueue_script( 'general', get_stylesheet_directory_uri() . '/general.js', array( 'jquery' ), '1.0' );
	}

	// only load cufon if it's been enabled
	if ( $cp_options->cufon_enable ) {
		wp_enqueue_script( 'cufon-yui', get_template_directory_uri() . '/includes/js/cufon-yui.js', array( 'jquery' ), '1.0.9i' );
		wp_enqueue_script( 'cufon-font-vegur', get_template_directory_uri() . '/includes/fonts/Vegur_400-Vegur_700.font.js', array( 'cufon-yui' ) );
		wp_enqueue_script( 'cufon-font-liberation', get_template_directory_uri() . '/includes/fonts/Liberation_Serif_400.font.js', array( 'cufon-yui' ) );
	}

	// load the gravatar hovercards
	if ( $cp_options->use_hovercards ) {
		wp_enqueue_script( 'gprofiles', 'http://s.gravatar.com/js/gprofiles.js', array( 'jquery' ), '1.0', true );
	}

	// only load gmaps when we need it
	if ( is_singular( APP_POST_TYPE ) ) {
		$cp_gmaps_lang = esc_attr( $cp_options->gmaps_lang );
		$cp_gmaps_region = esc_attr( $cp_options->gmaps_region );
		$google_maps_url = ( is_ssl() ? 'https' : 'http' ) . '://maps.googleapis.com/maps/api/js';
		$google_maps_url = add_query_arg( array( 'sensor' => 'false', 'language' => $cp_gmaps_lang, 'region' => $cp_gmaps_region ), $google_maps_url );

		wp_enqueue_script( 'google-maps', $google_maps_url, array( 'jquery' ), '3.0' );
	}

	if ( is_singular() || is_home() ) {
		wp_enqueue_script( 'colorbox' );
	}

	/* Script variables */
	$params = array(
		'appTaxTag' => APP_TAX_TAG,
		'require_images' => ( $cp_options->ad_images && $cp_options->require_images ),
		'ad_parent_posting' => $cp_options->ad_parent_posting,
		'ad_currency' => $cp_options->curr_symbol,
		'currency_position' => $cp_options->currency_position,
		'home_url' => home_url( '/' ),
		'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
		'text_processing' => __( 'تنفيذ...', APP_TD ),
		'text_require_images' => __( 'Please upload at least 1 image.', APP_TD ),
		'text_before_delete_ad' => __( 'Are you sure you want to delete this ad?', APP_TD ),
		'text_mobile_navigation' => __( 'Navigation', APP_TD ),
	);
	wp_localize_script( 'theme-scripts', 'classipress_params', $params );

	$params = array(
		'empty' => __( 'Strength indicator', APP_TD ),
		'short' => __( 'Very weak', APP_TD ),
		'bad' => __( 'Weak', APP_TD ),
		'good' => __( 'Medium', APP_TD ),
		'strong' => __( 'Strong', APP_TD ),
		'mismatch' => __( 'Mismatch', APP_TD ),
	);
	wp_localize_script( 'password-strength-meter', 'pwsL10n', $params );

}
endif;
add_action( 'wp_enqueue_scripts', 'cp_load_scripts' );


/**
 * Enqueue Add New page form scripts.
 *
 * @return void
 */
if ( ! function_exists( 'cp_load_form_scripts' ) ) :
function cp_load_form_scripts() {

	wp_enqueue_script( 'validate' );
	wp_enqueue_script( 'validate-lang' );

	wp_enqueue_script( 'easytooltip', get_template_directory_uri() . '/includes/js/easyTooltip.js', array( 'jquery' ), '1.0' );

}
endif;



/**
 * Enqueue color scheme styles.
 *
 * @return void
 */
if ( ! function_exists( 'cp_style_changer' ) ) :
function cp_style_changer() {
	global $cp_options;

	wp_enqueue_style( 'at-main', get_stylesheet_uri(), false );

	// turn off stylesheets if customers want to use child themes
	if ( ! $cp_options->disable_stylesheet ) {
		wp_enqueue_style( 'at-color', get_template_directory_uri() . '/styles/' . $cp_options->stylesheet, false );
	}

	if ( file_exists( get_template_directory() . '/styles/custom.css' ) ) {
		wp_enqueue_style( 'at-custom', get_template_directory_uri() . '/styles/custom.css', false );
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'cp_style_changer' );


/**
 * Enqueue styles.
 *
 * @return void
 */
if ( ! function_exists( 'cp_load_styles' ) ) :
function cp_load_styles() {

	// load colorbox only on single page
	if ( is_singular() || is_home() ) {
		wp_enqueue_style( 'colorbox' );
	}

	wp_enqueue_style( 'jquery-ui-style' );

}
endif;
add_action( 'wp_enqueue_scripts', 'cp_load_styles' );


