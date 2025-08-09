<?php
/**
 * Template Name: Legal Page
 * Template Post Type: page
 */
if ( ! defined('ABSPATH') ) exit;
get_header(); ?>

<main class="site-main">
  <div class="container mx-auto px-6 py-12">
    <?php
      // Start the loop to pull in this page’s content
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
  </div>
</main>

<?php get_footer(); ?>

