<?php
/**
 * Slider Listings loop content.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
global $cp_options;
?>

<li>

	<span class="feat_left">

		<?php if ( $cp_options->ad_images ) cp_ad_featured_thumbnail(); ?>
											
		<span class="price_sm"><?php cp_get_price( $post->ID, 'cp_price' ); ?></span>

	</span>

	<?php appthemes_before_post_title( 'featured' ); ?>

	<p><a href="<?php the_permalink(); ?>"><?php if ( mb_strlen( get_the_title() ) >= $cp_options->featured_trim ) echo mb_substr( get_the_title(), 0, $cp_options->featured_trim ) . '...'; else the_title(); ?></a></p>

	<?php appthemes_after_post_title( 'featured' ); ?>

</li>
