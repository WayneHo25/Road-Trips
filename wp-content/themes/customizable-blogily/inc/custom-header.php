<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package customizable wpversion
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses customizable_blogily_header_style()
 */
function customizable_blogily_custom_header_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 155,
		'height'      => 44,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
		) );
	add_theme_support( 'custom-header', array(
		'default-image'			=> '%s/images/top-bg.png',
		'default-text-color'	=> 'fff',
		'width'					=> 1400,
		'height'				=> 500,
		'flex-width'			=> true,
		'flex-height'			=> true,
		'wp-head-callback'		=> 'customizable_blogily_header_style',
		) );
	register_default_headers( array(
		'header-bg' => array(
			'url'           => '%s/images/top-bg.png',
			'thumbnail_url' => '%s/images/top-bg_thumb.png',
			'description'   => _x( 'Default', 'Default header image', 'customizable-blogily' )
			),	
		) );

}
add_action( 'after_setup_theme', 'customizable_blogily_custom_header_setup' );

if ( ! function_exists( 'customizable_blogily_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see customizable_blogily_custom_header_setup().
 */
function customizable_blogily_header_style() {
	$header_text_color = get_header_textcolor();
	
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		#site-header {
			background-image: url(<?php header_image(); ?>);
		    background-size: cover;
		}


	<?php if ( ! display_header_text() ) : ?>
	.site-title,
	.site-description {
		position: absolute;
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php else : ?>
	.site-branding .site-title,
	.site-branding .site-description {
		color: #<?php echo esc_attr( $header_text_color ); ?>;
	}
	.site-branding .site-title:after {
		background: #<?php echo esc_attr( $header_text_color ); ?>;
	}
	<?php endif; ?>
	</style>
	<?php
}
endif;
