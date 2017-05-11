<div class="post-entry">
	<?php the_content(); ?>
</div>


<?php if ( is_single() ) : ?>
	<?php if ( has_tag() ) : ?>
        <div class="post-tags">
			<?php the_tags( "", "" ); ?><br/><br/>
        </div>
        <!--版权声明-->
        <div class="creative-commons">
            <p>文章最后编辑时间为: <?php the_modified_time('Y/n/j H:m'); ?></p>
            <p>本文由 <a href="<?php echo home_url(); ?>" ><?php the_author_meta('nickname'); ?></a> 创作，采用 <a href="https://creativecommons.org/licenses/by/4.0/deed.zh" target="_blank" rel="nofollow">知识共享署名 4.0</a>国际许可协议进行许可</p>
            <p>可自由转载、引用，但需署名作者且注明文章出处</p>
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
