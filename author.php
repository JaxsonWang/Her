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
		<?php
		if ( isset( $_GET['author_name'] ) ) :
			$curauth = get_userdatabylogin( $author_name );
		else :
			$curauth = get_userdata( intval( $author ) );
		endif;
		?>
        <div class="inner">
            <h1 class="post-page-title "><?php echo $curauth->display_name; ?></h1>
            <p>个人主页：<a rel="nofollow" href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
            <p>开始时间<?php the_author_meta( 'user_registered', 1 ); ?></p>
        </div>
    </header><!-- .site-header -->


    <div id="wrapper">
        <section id="content" class="main items">


        </section>
    </div>


<?php get_footer(); ?>