</div><!-- .site-content -->

<!-- Footer -->
<footer id="footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
    <p class="copyright">
	    <?php esc_attr_e('Copyright ©'); ?><?php esc_attr_e(date('Y')); ?> . <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span> . Theme by <a href="#" rel="external nofollow" target="_blank">Her</a><br />
        <a href="<?php echo esc_url( __( 'https://wordpress.org/' ) ); ?>"><?php printf( __( 'Powered by %s' ), 'WordPress' ); ?></a> .
        <?php if (get_option('theme_icp_num') != '' ) {echo '<a href="http://www.miitbeian.gov.cn" rel="external nofollow" target="_blank">'. get_option('theme_icp_num') .'</a><br/>';}  ?>
        <?php if (get_option('theme_blog_footer_code') != '' ) { echo get_option('theme_blog_footer_code'); } ?>
    </p>
</footer>


<a href="#" class="back2top" style="display:none;"><i class="iconfont icon-huidaodingbu"></i></a>

<?php wp_footer(); ?>
</body>
</html>
