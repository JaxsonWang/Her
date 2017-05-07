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


<div id="primary" class="content-area">
    <main class="full-page">
        <div class="full-content">

            <section class="error-404 not-found">
                <div class="author-content">
                    <div class="p404"><i class="fa fa-cog fa-spin"></i></div>
                    <h2><?php _e( 'Oops!<br><br> That page can&rsquo;t be found.', 'Her' ); ?></h2>
                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'Her' ); ?></p>
					<?php get_search_form(); ?>
                </div><!-- .page-header -->
            </section><!-- .error-404 -->

        </div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<div id="instagram-footer">
    <div class="instagram-widget">
        <h2 class="instagram-title">热评文章</h2>
        <ul class="instagram-pics">
			<?php
			$arr = array(
				'meta_key'            => '_thumbnail_id',
				'showposts'           => 5,        // 显示6个特色图像
				'posts_per_page'      => 5,   // 显示6个特色图像
				'orderby'             => 'comment_count',     // 按发布时间先后顺序获取特色图像，可选：'title'、'rand'、'comment_count'等
				'ignore_sticky_posts' => 1,
				'order'               => 'DESC'
			);

			$slideshow = new WP_Query( $arr );
			if ( $slideshow->have_posts() ) {
				$postCount = 0;
				while ( $slideshow->have_posts() ) {
					$slideshow->the_post();
					?>
                    <li class="inkwell">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php
							// 获取特色图像的地址
							$timthumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full-thumb' );
							echo '<img border="0" alt="' . get_the_title() . '" src="' . $timthumb_src[0] . '" /> ';
							?>
                        </a>
                    </li>
					<?php
				} // endwhile
				wp_reset_postdata();
			} // endif
			?>

        </ul>
    </div>
</div>

<?php get_footer(); ?>
