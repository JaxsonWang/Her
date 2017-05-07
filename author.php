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

    <header id="header" class="alt" style="background-image:url(
	<?php if ( has_post_thumbnail() ) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' );
		echo $image[0]; ?>
	<?php else : ?>
		<?php
		if ( get_option( 'def_banner' ) == '' ) {
			echo get_template_directory_uri() . '/img/banner.jpg';
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
            <h1 class="post-page-title ">作者档案:<?php echo $curauth->display_name; ?></h1>
            <p>个人主页：<a rel="nofollow" href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
            <p>开始时间<?php the_author_meta( 'user_registered', 1 ); ?></p>
        </div>
    </header><!-- .site-header -->


    <div id="wrapper">
        <section id="content" class="main items">


        </section>
    </div>


<?php get_footer(); ?>