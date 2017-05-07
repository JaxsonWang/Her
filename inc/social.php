<?php if ( get_option( 'theme_social' ) == 'checked' ) { ?>
	<?php if ( get_option( 'sp_weibo' ) ) : ?>
        <a rel="nofollow" href="http://weibo.com/<?php echo get_option( 'sp_weibo' ); ?>" target="_blank"><i
                    class="iconfont icon-iconfontweibowukuang"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_github' ) ) : ?>
        <a rel="nofollow" href="https://github.com/<?php echo get_option( 'sp_github' ); ?>" target="_blank"><i
                    class="iconfont icon-github"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_facebook' ) ) : ?>
        <a rel="nofollow" href="http://facebook.com/<?php echo get_option( 'sp_facebook' ); ?>" target="_blank"><i
                    class="iconfont icon-facebook"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_twitter' ) ) : ?>
        <a rel="nofollow" href="http://twitter.com/<?php echo get_option( 'sp_twitter' ); ?>" target="_blank"><i
                    class="iconfont icon-Twitter"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_instagram' ) ) : ?>
        <a rel="nofollow" href="http://instagram.com/<?php echo get_option( 'sp_instagram' ); ?>" target="_blank"><i
                    class="iconfont icon-instagram"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_tumblr' ) ) : ?>
        <a rel="nofollow" href="http://<?php echo get_option( 'sp_tumblr' ); ?>.tumblr.com/" target="_blank"><i
                    class="iconfont icon-tumblr"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_youtube' ) ) : ?>
        <a rel="nofollow" href="http://youtube.com/<?php echo get_option( 'sp_youtube' ); ?>" target="_blank"><i
                    class="iconfont icon-youtube"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_dribbble' ) ) : ?>
        <a rel="nofollow" href="http://dribbble.com/<?php echo get_option( 'sp_dribbble' ); ?>" target="_blank"><i
                    class="iconfont icon-dribbble"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_vimeo' ) ) : ?>
        <a rel="nofollow" href="http://vimeo.com/<?php echo get_option( 'sp_vimeo' ); ?>" target="_blank"><i
                    class="iconfont icon-vimeo"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_linkedin' ) ) : ?>
        <a rel="nofollow" href="<?php echo get_option( 'sp_linkedin' ); ?>" target="_blank"><i
                    class="iconfont icon-linkedin"></i></a>
	<?php endif; ?>
	<?php if ( get_option( 'sp_rss' ) ) : ?>
        <a rel="nofollow" href="<?php echo get_option( 'sp_rss' ); ?>" target="_blank"><i class="iconfont icon-rss"></i></a>
	<?php endif; ?>
<?php } ?>