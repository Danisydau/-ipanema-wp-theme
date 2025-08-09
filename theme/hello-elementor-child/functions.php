<?php // Single opening tag at the VERY START of the file

/**
 * Enqueue parent and child theme stylesheets correctly for Ipanema Child Theme.
 */
function ipanema_child_enqueue_styles() {
	// Enqueue parent theme's main stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	// Enqueue child theme's stylesheet.
	// It depends on the parent style AND uses its own version for cache busting.
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		array( 'parent-style' ), // Ensure parent loads first
		wp_get_theme()->get( 'Version' ) // Get version from child theme's style.css
	);
}
// Hook the function into wp_enqueue_scripts action hook
add_action( 'wp_enqueue_scripts', 'ipanema_child_enqueue_styles' );


/**
 * Register navigation menus for the Ipanema Child Theme.
 */
function ipanema_child_register_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu (Desktop)', 'ipanema-child' ), // Use your child theme's text domain
			'mobile'  => __( 'Mobile Menu', 'ipanema-child' ),
		)
	);
}
// Hook the function into the init action hook
add_action( 'init', 'ipanema_child_register_menus' );


// --- Add any other custom functions below this line ---


// --- Do NOT add a closing
