<?php

$orig_post = $post;
global $post;

$categories = get_the_category( $post->ID );

if ( $categories ) {

$category_ids = array();

foreach ( $categories as $individual_category ) {
	$category_ids[] = $individual_category->term_id;
}

$args = array(
	'category__in'        => $category_ids,
	'post__not_in'        => array( $post->ID ),
	'posts_per_page'      => 2, // Number of related posts that will be shown.
	'ignore_sticky_posts' => 1,
	'orderby'             => 'rand'
);

$my_query = new wp_query( $args );
if ( $my_query->have_posts() ) { ?>

<div class="post-related">
    <div class="post-box">
        <h4 class="post-box-title"><?php _e( 'You Might Also Like', 'solopine' ); ?></h4>
    </div>
	<?php while ( $my_query->have_posts() ) {
		$my_query->the_post(); ?>
        <article class="item related">
            <header>
                <a href="<?php echo get_permalink() ?>">
					<?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'misc-thumb' );
						echo $image[0]; ?>" alt="<?php the_title(); ?>"/>
					<?php else : ?>
                        <img src="<?php echo get_option( 'def_banner' ); ?>" alt="<?php the_title(); ?>">
					<?php endif; ?>
                </a>
                <h3><?php the_title(); ?><br/><?php echo mutheme_time_since( strtotime( $post->post_date_gmt ) ); ?>
                </h3>

            </header>
        </article>
		<?php
	}
	echo '</div>';
	}
	}
	$post = $orig_post;
	wp_reset_query();

	?>
        
                   
   
        
