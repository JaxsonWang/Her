</div><!-- .site-content -->

<!-- Footer -->
<footer id="footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
    <p class="copyright">
	    <?php esc_attr_e('Copyright ©'); ?><?php esc_attr_e(date('Y')); ?> . <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span> . <a href="<?php echo esc_url( __( 'https://wordpress.org/' ) ); ?>"><?php printf( __( 'Powered by %s' ), 'WordPress' ); ?></a><br />
        Designed & Developed by <a href="http://solopine.com/rosemary/" rel="external nofollow" target="_blank">Solo Pine</a> . Theme By <a href="https://www.banxia.me" rel="external nofollow" target="_blank">Her</a> . Make By <a href="https://iiong.com" rel="external nofollow" target="_blank">淮城一只猫</a><br/>
        <?php if (get_option('theme_icp_num') != '' ) {echo '<a href="http://www.miitbeian.gov.cn" rel="external nofollow" target="_blank">'. get_option('theme_icp_num') .'</a><br/>';}  ?>
        <?php if (get_option('theme_blog_footer_code') != '' ) { echo get_option('theme_blog_footer_code'); } ?>
    </p>
</footer>

</div>
<?php get_template_part( 'inc/mobile-nav' ); ?>
<a href="#" class="back2top"><i class="iconfont icon-huidaodingbu"></i></a>

<?php wp_footer(); ?>
</body>
</html>
