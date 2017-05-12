<?php get_header(); ?>

    <header id="header" class="alt" itemscope="itemscope" itemtype="https://schema.org/WPHeader" style="background-image:url(
	<?php if ( has_post_thumbnail() ) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' );
		echo $image[0]; ?>
	<?php else : ?>
		<?php
		if ( get_option( 'def_banner' ) == '' ) {
		    if (get_option( 'theme_static_qiniucdn' ) == 'checked') {
				echo get_option( 'theme_qiniucdn' ) . '/her/img/banner.jpg';
			} else {
			    echo get_template_directory_uri() . '/img/banner.jpg';
            }
		} else {
			echo get_option( "def_banner" );
		}
		?>
	<?php endif; ?>
            );">
        <div class="inner">
            <h1 class="post-page-title "><?php printf( __( '%s' ), single_cat_title( '', false ) ); ?></h1>
            <p>最近更新：<?php the_title(); ?>/<?php the_time( get_option( 'date_format' ) ); ?></p>
            <p><?php _e( '浏览分类' ); ?></p>
        </div>
    </header><!-- .site-header -->


    <div id="wrapper">
        <section id="content" class="main items">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'inc/content-grid', 'page' ); ?>
			<?php endwhile; ?>
				<?php solopine_pagination(); ?>
			<?php endif; ?>
        </section>
    </div>


<?php get_footer(); ?>