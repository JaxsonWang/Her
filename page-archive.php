<?php

/* Template Name: 文章归档 */

?>
<?php get_header(); ?>
    <section id="primary" class="content-area">
        <main class="full-page">
            <div class="full-content">
                <div class="archive-review">
                    <div class="archive-year">
                        <h2><?php the_author_meta( 'description' ); ?></h2>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-dianyuan"></i>
                        </div>
                        <span><?php echo floor( ( time() - strtotime( get_option('theme_birthday') ) ) / 86400 ); ?>天</span>
                        <p class="block-postMeta"></p>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-tiezi"></i>
                        </div>
                        <span><?php $count_pages = wp_count_posts( 'page' );
							echo $page_posts = $count_pages->publish; ?>个页面</span>
                        <p class="block-postMeta"></p>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-fenlei"></i>
                        </div>
                        <span><?php echo $count_categories = wp_count_terms( 'category' ); ?>个分类</span>
                        <p class="block-postMeta"></p>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-biaoqian"></i>
                        </div>
                        <span><?php echo $count_tags = wp_count_terms( 'post_tag' ); ?>个标签</span>
                        <p class="block-postMeta"></p>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-article"></i>
                        </div>
                        <span><?php $count_posts = wp_count_posts();
							echo $published_posts = $count_posts->publish; ?>篇文章</span>
                        <p class="block-postMeta"></p>
                    </div>
                    <div class="archive-grid">
                        <div class="iconxxx">
                            <i class="iconfont icon-pinglun"></i>
                        </div>
                        <span><?php $total_comments = get_comment_count();
							echo $total_comments['approved']; ?>评论</span>
                        <p class="block-postMeta"></p>
                    </div>
                </div>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php endwhile; ?>
				<?php
				$args          = array(
					'post_type'           => 'post',
					'posts_per_page'      => - 1,
					'ignore_sticky_posts' => 1
				);
				$the_query     = new WP_Query( $args );
				$posts_rebuild = array();
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$post_year                                  = get_the_time( 'Y' );
					$post_mon                                   = get_the_time( 'm' );
					$posts_rebuild[ $post_year ][ $post_mon ][] = '
                        <li class="archive-item">
                            <a class="archive-item-title" href="' . get_permalink() . '">' . get_the_title() . '</a>
                            <span class="archive-item-meta"> ' . get_comments_number( '0', '1', '%' ) . ' 条评论</span>
                        </li>
                        ';
				endwhile;
				wp_reset_postdata();
				$output      = '';
				$postresults = '';
				foreach ( $posts_rebuild as $key => $value ) {
					$output .= '<h1 class="archive-year">' . $key . '</h1>';
					$year   = $key;
					foreach ( $value as $key_m => $value_m ) {
						$output .= '
                            <p class="archive-month">' . $year . ' - ' . $key_m . '
                                <a class="archive-floatRight" href="' . $year . '/' . $key_m . '">查看当月全部文章</a>
                            </p>
                            <ul class="archive-posts">
                            ';
						foreach ( $value_m as $key => $value_d ) {
							$output .= $value_d;
						}
						$output .= '<div class="archive-comments-count">' . count( $postresults ) . ' Nothinng gone change. </div></ul>';
					}
				}
				echo $output;
				?>
            </div>
        </main>
    </section>
<?php get_footer(); ?>