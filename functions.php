<?php
/**
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 */

define( 'HER_VERSION', '1.0' );

//主题菜单注册
add_action( 'after_setup_theme', 'solopine_theme_setup' );

if ( ! function_exists( 'solopine_theme_setup' ) ) {

	function solopine_theme_setup() {

		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => 'Primary Menu',
			)
		);
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

		// Featured image
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-thumb', 1080, 0, true );
		add_image_size( 'misc-thumb', 520, 400, true );

		// Feed Links
		add_theme_support( 'automatic-feed-links' );

	}

}

// 禁止WordPress头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}

	return $hints;
}

add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

// 移除后台 Google Font API
function remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style( 'open-sans', '' );
}

add_action( 'init', 'remove_open_sans_from_wp_core' );

//移除wp-embed.min.js
function my_deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'my_deregister_scripts' );

//移除comment-reply.min.js
function disable_comment_js() {
	wp_deregister_script( 'comment-reply' );
}

add_action( 'init', 'disable_comment_js' );

// 精简 wp_head & 去除无用函数 & 半角转全角
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'wp_title', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );

// 禁用 emoji's表情
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// 去除emojis wpemoji插件
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

//禁用REST API/移除wp-json链接
add_filter( 'rest_enabled', '__return_false' );
add_filter( 'rest_jsonp_enabled', '__return_false' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
//禁用前端管理工具
add_filter( 'show_admin_bar', '__return_false' );

//替换Gravatar头像库
function her_get_ssl_avatar( $avatar ) {
	$avatar = str_replace( array(
		"www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"
	), "secure.gravatar.com", $avatar );

	return $avatar;
}
add_filter( 'get_avatar', 'her_get_ssl_avatar' );


//注册资源
add_action( 'wp_enqueue_scripts', 'solopine_load_scripts' );

function solopine_load_scripts() {
	//七牛CDN
	if (get_option( 'theme_static_qiniucdn' ) == 'checked' ) {
		$get_smiley_url = get_option( 'theme_qiniucdn' ) . '/her';
	} else {
		$get_smiley_url = get_template_directory_uri();
	}
	//语法高亮
	if (get_option( 'theme_highlight_style' ) == '' ) {
		$get_highlightcss_url = '//cdn.bootcss.com/highlight.js/9.11.0/styles/github.min.css';
	} else {
		$get_highlightcss_url = get_option( 'theme_highlight_style' );
	}
	//启用样式脚本
	wp_enqueue_style( 'sp_style', $get_smiley_url . '/style.css', array(), HER_VERSION, 'all' );
	wp_enqueue_style( 'alifonts', '//at.alicdn.com/t/font_3nut7ugnvto11yvi.css', array(), HER_VERSION, 'all' );
	wp_enqueue_style( 'highlightcss', $get_highlightcss_url, array(),HER_VERSION, 'all' );
	//启用js脚本
	wp_enqueue_script( 'jquery_js', '//cdn.bootcss.com/jquery/1.12.4/jquery.min.js', array(), HER_VERSION, true );
	wp_enqueue_script( 'functions', $get_smiley_url . '/js/functions.js', array(), HER_VERSION, true );
	wp_enqueue_script( 'highlightjs', '//cdn.bootcss.com/highlight.js/9.11.0/highlight.min.js',array(), HER_VERSION, true);
}

//添加设置菜单，注意add_menu_page和add_submenu_page的写法
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
add_action( 'admin_menu', 'options_admin_menu' );
function options_admin_menu() {
	add_menu_page( 'Her', 'Her', 'administrator', 'base-settings', 'BaseSettings', '', 100 );
	add_submenu_page( 'base-settings', 'Her主题设置', 'Her主题设置', 'administrator', 'base-settings', 'BaseSettings' );
	add_submenu_page( 'base-settings', 'Her主题说明', 'Her主题说明', 'administrator', 'advanced-settings', 'AdvancedSettings' );
}

//加载设置文件
add_action( 'admin_head', 'OptionFile' );
function OptionFile() {
	require_once( get_template_directory() . '/inc/opt/opt.php' ); //代码解耦
}

//载入文件
require_once('inc/functions-customize.php');