<?php get_header(); ?>
    <div id="primary" class="content-area">
        <div class="full-page">

            <section id="search-header" class="main">
                <div class="author-content">
                    <div class="p404"><i class="iconfont icon-mengchong"></i></div>
                    <h2><?php _e( '搜索结果' ); ?>：<?php printf( __( '%s' ), get_search_query() ); ?></h2>
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
                            <h3 class="nothing"><?php _e( '抱歉，没有符合您搜索条件的结果。请换其它关键词再试。' ); ?></h3>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>