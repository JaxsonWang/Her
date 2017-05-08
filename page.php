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