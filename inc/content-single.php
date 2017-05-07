<div class="post-entry">
	<?php the_content(); ?>
</div>


<?php if ( is_single() ) : ?>
	<?php if ( has_tag() ) : ?>
        <div class="post-tags">
			<?php the_tags( "", "" ); ?><br/><br/>
        </div>
	<?php endif; ?>
<?php endif; ?>


<?php if ( get_option( 'theme_author_post' ) == 'checked' ) { ?>
	<?php if ( is_single() ) : ?>
		<?php get_template_part( 'inc/about_author' ); ?>
	<?php endif; ?>
<?php } ?>

<?php if ( get_option( 'theme_alsolike_post' ) == 'checked' ) { ?>
	<?php if ( is_single() ) : ?>
		<?php get_template_part( 'inc/related_posts' ); ?>
	<?php endif; ?>
<?php } ?>


<?php comments_template( '', true ); ?>
