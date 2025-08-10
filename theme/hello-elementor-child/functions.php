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


/**
 * Enqueue Services CSS only on the Services Landing template.
 *
 * @package ipanema-wp-theme
 */
function ipanema_services_assets() {
	if ( is_page_template( 'template-services.php' ) ) {
		$base = get_stylesheet_directory();
		$uri  = get_stylesheet_directory_uri();
		$css  = $base . '/assets/css/services.css';
		if ( file_exists( $css ) ) {
			wp_enqueue_style(
				'ipanema-services',
				$uri . '/assets/css/services.css',
				array(),
				filemtime( $css )
			);
		}

	}
}
add_action( 'wp_enqueue_scripts', 'ipanema_services_assets' );


/**
 * Enqueue Landing Page CSS only on the Ipanema Custom Landing Page template.
 *
 * @package ipanema-wp-theme
 */
function ipanema_landing_assets() {
	if ( is_page_template( 'template-ipanema-landing.php' ) ) {
		// Enqueue 3rd party Styles
		wp_enqueue_style( 'google-fonts-dm-sans', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap', array(), null );
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
		wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), null );

		// Enqueue 3rd party Scripts
		// Note: TailwindCSS is a utility-first CSS framework, the CDN version is a script that generates styles on the fly.
		wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false );
		wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true );

		$base = get_stylesheet_directory();
		$uri  = get_stylesheet_directory_uri();
		$css  = $base . '/assets/css/ipanema-landing.css';
		if ( file_exists( $css ) ) {
			wp_enqueue_style(
				'ipanema-landing',
				$uri . '/assets/css/ipanema-landing.css',
				array( 'google-fonts-dm-sans', 'font-awesome', 'aos-css' ),
				filemtime( $css )
			);
		}

		$js = $base . '/assets/js/ipanema-landing.js';
		if ( file_exists( $js ) ) {
			wp_enqueue_script(
				'ipanema-landing-js',
				$uri . '/assets/js/ipanema-landing.js',
				array( 'aos-js' ),
				filemtime( $js ),
				true
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ipanema_landing_assets' );
