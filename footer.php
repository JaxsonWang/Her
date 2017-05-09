</div><!-- .site-content -->

<!-- Footer -->
<footer id="footer">
    <p class="copyright">
	    <?php esc_attr_e('Copyright ©'); ?> <?php esc_attr_e(date('Y')); ?> <?php esc_attr_e('. All rights reserved.'); ?><br />
        Make by <a href="https://iiong.com" rel="external nofollow" target="_blank">淮城一只猫</a> &amp; <a target="_blank" rel="external nofollow" href="https://www.banxia.me">半夏</a> . Theme by <a href="#" rel="external nofollow" target="_blank">Her</a><br />
        <a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank"><?php echo get_option( 'zh_cn_l10n_icp_num' ); ?></a>
        <?php if (get_option('theme_blog_footer_code') != '' ) { echo get_option('theme_blog_footer_code'); } ?>
    </p>
</footer>


<a href="#" class="back2top" style="display:none;"><i class="iconfont icon-huidaodingbu"></i></a>

<?php wp_footer(); ?>
</body>
</html>
