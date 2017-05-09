<?php

/* Template Name: 友情链接 */

?>
<?php get_header(); ?>
<section id="primary" class="content-area">
    <main class="full-page">
        <div class="full-content">
            <h2 style="text-align: center;">友情链接</h2>
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
            <div class="link-content">
				<?php
				$bookmarks = get_bookmarks( 'category_name=' );
				if ( ! empty( $bookmarks ) ) {
					echo '<ul class="link_ul">';
					foreach ( $bookmarks as $bookmark ) {
						echo '
                <li class="link-meta">
                    <a href="' . $bookmark->link_url . '" class="link-avator" title="' . $bookmark->link_description . '" target="_blank">' . get_avatar( $bookmark->link_notes, 64 ) . ' </a>
                    <a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >
                        <div class="link_name">
                            <span class="link-sitename">' . $bookmark->link_name . '</span>
                        </div>
                    </a>
                    
                </li>';
					}
					echo '</ul>';
				}
				?>
            </div>
        </div>
    </main>
</section>

<?php get_footer(); ?>
