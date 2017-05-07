<?php get_header(); ?>


    <div id="primary" class="content-area">
        <div class="full-page">

            <section id="search-header" class="main">
                <div class="author-content">
                    <div class="p404"><i class="fa fa-fort-awesome"></i></div>
                    <h2><?php _e( 'Search results for', 'solopine' ); ?>
                        【<?php printf( __( '%s', 'solopine' ), get_search_query() ); ?>】</h2>
                </div><!-- .page-header -->
            </section>

            <div id="wrapper" class="main">
                <div id="content" class="main items">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'inc/content-list' ); ?>
					<?php endwhile; ?>

						<?php if ( get_theme_mod( 'sp_archive_layout' ) == 'list' || get_theme_mod( 'sp_archive_layout' ) == 'full_grid' ) : ?><?php endif; ?>

						<?php solopine_pagination(); ?>

					<?php else : ?>
                        <div class="author-content">
                            <h3 class="nothing"><?php _e( 'Sorry, no posts were found. Try searching for something else.', 'solopine' ); ?></h3>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>