<?php
define( 'SuccessInfo', '<div class="updated"><p><strong>设置已保存。</strong></p></div>' );

//主题设置
function BaseSettings() {
	if ( isset( $_POST['update_options'] ) && $_POST['update_options'] == 'true' ) {
		// 基本设置
		if ( isset( $_POST['theme_button_post'] ) && $_POST['theme_button_post'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_button_post', $display ); //button-index
		update_option( 'theme_button_post_down', $_POST['theme_button_post_down'] ? $_POST['theme_button_post_down'] : '' ); //input
		update_option( 'theme_button_post_url', isset( $_POST['theme_button_post_url'] ) && $_POST['theme_button_post_url'] ? $_POST['theme_button_post_url'] : '' ); //input
		update_option( 'theme_button_post_title', isset( $_POST['theme_button_post_title'] ) && $_POST['theme_button_post_title'] ? $_POST['theme_button_post_title'] : '' ); //input
		update_option( 'theme_qiniucdn', isset( $_POST['theme_qiniucdn'] ) && $_POST['theme_qiniucdn'] ? $_POST['theme_qiniucdn'] : '' ); //input
		update_option( 'theme_icp_num', isset( $_POST['theme_icp_num'] ) && $_POST['theme_icp_num'] ? $_POST['theme_icp_num'] : '' ); //input

		update_option( 'theme_button_post_meta', isset( $_POST['theme_button_post_meta'] ) && $_POST['theme_button_post_meta'] ? stripslashes($_POST['theme_button_post_meta']) : '' ); //textarea
		update_option( 'theme_blog_description', isset( $_POST['theme_blog_description'] ) && $_POST['theme_blog_description'] ? stripslashes($_POST['theme_blog_description']) : '' ); //textarea
		update_option( 'theme_blog_keywords', isset( $_POST['theme_blog_keywords'] ) && $_POST['theme_blog_keywords'] ? stripslashes($_POST['theme_blog_keywords']) : '' ); //textarea
		update_option( 'theme_blog_track', isset( $_POST['theme_blog_track'] ) && $_POST['theme_blog_track'] ? stripslashes($_POST['theme_blog_track']) : '' ); //textarea
		update_option( 'theme_blog_footer_code', isset( $_POST['theme_blog_footer_code'] ) && $_POST['theme_blog_footer_code'] ? stripslashes($_POST['theme_blog_footer_code']) : '' ); //textarea
		if ( isset( $_POST['theme_author_index'] ) && $_POST['theme_author_index'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_author_index', $display ); //author-index
		if ( isset( $_POST['theme_author_post'] ) && $_POST['theme_author_post'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_author_post', $display ); //author-post
		if ( isset( $_POST['theme_alsolike_post'] ) && $_POST['theme_alsolike_post'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_alsolike_post', $display ); //alsolike-post
		if ( isset( $_POST['theme_static_qiniucdn'] ) && $_POST['theme_static_qiniucdn'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_static_qiniucdn', $display ); //七牛CDN静态资源云缓存
		update_option( 'def_banner', isset($_POST['def_banner']) && $_POST['def_banner'] ? $_POST['def_banner'] : '' ); //Upload
		update_option( 'theme_logo', isset($_POST['theme_logo']) && $_POST['theme_logo'] ? $_POST['theme_logo'] : '' ); //Upload
		echo SuccessInfo;

		// 社交媒体
		if ( isset( $_POST['theme_social'] ) && $_POST['theme_social'] == 'on' ) {
			$display = 'checked';
		} else {
			$display = '';
		}
		update_option( 'theme_social', $display ); //checkbox
		update_option( 'sp_weibo', isset( $_POST['sp_weibo'] ) && $_POST['sp_weibo'] ? $_POST['sp_weibo'] : '' ); //input
		update_option( 'sp_github', isset( $_POST['sp_github'] ) && $_POST['sp_github'] ? $_POST['sp_github'] : '' ); //input
		update_option( 'sp_facebook', isset( $_POST['sp_twitter'] ) && $_POST['sp_twitter'] ? $_POST['sp_twitter'] : '' ); //input
		update_option( 'sp_twitter', isset( $_POST['sp_twitter'] ) && $_POST['sp_twitter'] ? $_POST['sp_twitter'] : '' ); //input
		update_option( 'sp_instagram', isset( $_POST['sp_instagram'] ) && $_POST['sp_instagram'] ? $_POST['sp_instagram'] : '' ); //input
		update_option( 'sp_tumblr', isset( $_POST['sp_tumblr'] ) && $_POST['sp_tumblr'] ? $_POST['sp_tumblr'] : '' ); //input
		update_option( 'sp_youtube', isset( $_POST['sp_youtube'] ) && $_POST['sp_youtube'] ? $_POST['sp_youtube'] : '' ); //input
		update_option( 'sp_dribbble', isset( $_POST['sp_dribbble'] ) && $_POST['sp_dribbble'] ? $_POST['sp_dribbble'] : '' ); //input
		update_option( 'sp_vimeo', isset( $_POST['sp_vimeo'] ) && $_POST['sp_vimeo'] ? $_POST['sp_vimeo'] : '' ); //input
		update_option( 'sp_linkedin', isset( $_POST['sp_linkedin'] ) && $_POST['sp_linkedin'] ? $_POST['sp_linkedin'] : $_POST['sp_linkedin'] ); //input
		update_option( 'sp_rss', isset( $_POST['sp_rss'] ) && $_POST['sp_rss'] ? $_POST['sp_rss'] : '' ); //input
	}
	require_once( get_template_directory() . '/inc/opt/opt-theme.php' ); //代码解耦
	add_action( 'admin_menu', 'BaseSettings' );
}

//主题说明
function AdvancedSettings() {
	if ( isset( $_POST['update_options'] ) && $_POST['update_options'] == 'true' ) {

	}
	require_once( get_template_directory() . '/inc/opt/opt-author.php' );  //代码解耦
	add_action( 'admin_menu', 'AdvancedSettings' );
}

?>