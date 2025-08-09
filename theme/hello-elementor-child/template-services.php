<?php
/**
 * Template Name: Services Landing
 * Description: Simple services landing template.
 *
 * @package ipanema-wp-theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="services">
	<section class="hero">
	<div class="wrap">
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p class="sub"><?php echo esc_html__( 'What we do best.', 'ipanema-wp-theme' ); ?></p>
	</div>
	</section>

	<section class="cards wrap" aria-label="<?php echo esc_attr__( 'Our services', 'ipanema-wp-theme' ); ?>">
	<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
		<article class="card">
		<h2 class="h4"><?php echo esc_html( sprintf( __( 'Service %d', 'ipanema-wp-theme' ), $i ) ); ?></h2>
		<p><?php echo esc_html__( 'Short description of the service goes here.', 'ipanema-wp-theme' ); ?></p>
		</article>
	<?php endfor; ?>
	</section>
</main>
<?php
get_footer();
