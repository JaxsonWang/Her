<?php
/**
 * Theme Name: Her
 * Theme URI: https://www.banxia.me
 * Author: Banxia
 * Author URI: https://www.banxia.me
 * Description: Her design and develop by Aaron in 2017.
 * Version: 2.0
 * @package WordPress
 * @subpackage Her
 * @since Her 2.0
 */
?>

<?php get_header(); ?>

    <section id="primary" class="content-area">
        <main class="full-page">
            <div class="full-content">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'inc/content-single', 'page' );


					// End of the loop.
				endwhile;
				?>
            </div>
        </main><!-- .site-main -->
    </section>

<?php get_footer(); ?>