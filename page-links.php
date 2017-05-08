<?php

/* Template Name: 友情链接 */

?>
<?php get_header(); ?>
<section id="primary" class="content-area">
    <main class="full-page">
        <div class="full-content">
            <div class="link-content">
                <h2 style="text-align: center;">友情链接</h2>
				<?php
				$bookmarks = get_bookmarks( 'category_name=' );
				if ( ! empty( $bookmarks ) ) {
					echo '<ul>';
					foreach ( $bookmarks as $bookmark ) {
						echo '
                <li class="link-meta">
                    <a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >
                    <img class="link-img" src="//api.thumbalizr.com/?url=' . $bookmark->link_url . '&width=250">
                    </a>
                    <span class="link-sitename">' . $bookmark->link_name . '</span>
                    <a class="link-avator">' . get_avatar( $bookmark->link_notes, 64 ) . ' </a>
                </li>';
					}
					echo '</ul>';
				}
				?>
            </div>

            <div>
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
					// Include the page content template.
					get_template_part( 'inc/content-single', 'page' );
					// End of the loop.
				endwhile;
				?>
            </div>
        </div>
    </main>
</section>

<?php get_footer(); ?>
