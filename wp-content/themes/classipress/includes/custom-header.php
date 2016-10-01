<?php
/**
 * Implement an optional custom header.
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package ClassiPress\Header
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */


/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses cp_header_style() to style front-end.
 * @uses cp_admin_header_style() to style wp-admin form.
 * @uses cp_admin_header_image() to add custom markup to wp-admin form.
 *
 * @return void
 */
function cp_custom_header_setup() {
	global $cp_options;

	if ( strpos( $cp_options->stylesheet, 'black' ) !== false ) {
		$default_text_color = '#EFEFEF';
		$default_image = appthemes_locate_template_uri( 'images/cp_logo_white.png' );
	} else {
		$default_text_color = '#666666';
		$default_image = appthemes_locate_template_uri( 'images/cp_logo_black.png' );
	}

	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => $default_text_color,
		'header-text'            => true,
		'default-image'          => $default_image,

		'flex-height'            => true,
		'flex-width'             => true,

		// Set height and width.
		'height'                 => 80,
		'width'                  => 300,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'cp_header_style',
		'admin-preview-callback' => 'cp_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'cp_custom_header_setup' );


/**
 * Style the header text displayed on the blog.
 * get_header_textcolor() options: fff is default, hide text (returns 'blank'), or any hex value.
 *
 * @return void
 */
function cp_header_style() {
	$text_color = get_header_textcolor();

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="cp-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) {
	?>
		#logo .site-title,
		#logo .description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		} else {
	?>
		#logo h1 a,
		#logo h1 a:hover,
		#logo .description {
			color: #<?php echo $text_color; ?>;
		}
		<?php } ?>

	</style>
	<?php
}


/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @return void
 */
function cp_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		$nologo = '';
		if ( ! display_header_text() ) {
			$style = ' style="display:none;"';
		} else {
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		}
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php } elseif ( display_header_text() ) {
			$nologo = ' nologo'; ?>
			<h1 class="displaying-header-text">
				<a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
		<?php } ?>
		<?php if ( display_header_text() ) { ?>
			<div class="description displaying-header-text<?php echo $nologo; ?>"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php } ?>
	</div>
<?php }

