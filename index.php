<?php get_header(); ?>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Banner -->
        <section id="content" class="main items">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'inc/content-grid', 'page' ); ?>
			<?php endwhile; ?>
				<?php solopine_pagination(); ?>
			<?php endif; ?>
        </section>
        <!-- CTA -->
		<?php if ( get_option( 'theme_button_post' ) == 'checked' ) { ?>
            <section id="cta" class="main special">
                <h2><?php echo get_option( 'theme_button_post_title' ); ?></h2>
                <p><?php echo get_option( 'theme_button_post_meta' ); ?></p>
                <ul class="actions">
                    <li><a href="<?php echo get_option( 'theme_button_post_url' ); ?>"
                           class="read-more"><?php echo get_option( 'theme_button_post_down' ); ?></a></li>
                </ul>
            </section>
		<?php } ?>
		<?php if ( get_option( 'theme_author_index' ) == 'checked' ) { ?>
            <section id="intro" class="main">
                <span class="major"><?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?></span>
                <div class="author-content">
                    <h2><?php the_author_posts_link(); ?></h2>
                    <p><?php the_author_meta( 'description' ); ?></p>
	                <?php get_template_part( 'inc/social' ); ?>
                </div>
            </section>
		<?php } ?>
    </div>
<?php get_footer(); ?>