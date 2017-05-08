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

//////////////////////////////////////////////////////////////////
// Theme set up
//////////////////////////////////////////////////////////////////
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

//////////////////////////////////////////////////////////////////
// Register & enqueue styles/scripts
//////////////////////////////////////////////////////////////////

add_action( 'wp_enqueue_scripts', 'solopine_load_scripts' );

function solopine_load_scripts() {

	// Register scripts and styles
	wp_register_style( 'sp_style', get_stylesheet_directory_uri() . '/style.css', array(), HER_VERSION, 'all' );
	wp_register_style( 'main_style', get_stylesheet_directory_uri() . '/css/main.css', array(), HER_VERSION, 'all' );
	wp_register_style( 'slicknav-css', get_template_directory_uri() . '/css/slicknav.css', array(), HER_VERSION, 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), HER_VERSION, 'all' );
	wp_register_style( 'alifonts', '//at.alicdn.com/t/font_3nut7ugnvto11yvi.css', array(), HER_VERSION, 'all' );

	wp_register_script( 'jquery_js', get_template_directory_uri() . '/js/jquery.min.js', array(), HER_VERSION, true );
	wp_register_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array(), HER_VERSION, true );
	wp_register_script( 'functions', get_template_directory_uri() . '/js/functions.js', array(), HER_VERSION, true );

	// Enqueue scripts and styles
	wp_enqueue_style( 'sp_style' );
	wp_enqueue_style( 'main_style' );
	wp_enqueue_style( 'slicknav-css' );
	wp_enqueue_style( 'alifonts' );
	wp_enqueue_style( 'responsive' );

	// JS
	wp_enqueue_script( 'jquery_js' );
	wp_enqueue_script( 'slicknav' );
	wp_enqueue_script( 'functions' );


	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}


//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

function solopine_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

        <div class="thecomment">

            <div class="author-img">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </div>

            <div class="comment-text">
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( '回复' ), 'depth' => $depth,
							'max_depth'  => $args['max_depth']
						) ), $comment->comment_ID ); ?>
						<?php edit_comment_link( __( '编辑' ) ); ?>
					</span>
                <span class="author"><?php echo get_comment_author_link(); ?></span>
                <span class="date"><?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><i class="icon-info-sign"></i> <?php _e( '评论待审核' ); ?></em>
                    <br/>
				<?php endif; ?>
				<?php comment_text(); ?>
            </div>

        </div>


    </li>

	<?php
}

//////////////////////////////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////////////////////////////
function solopine_pagination() {

	?>

    <div class="pagination">

        <div class="older"><?php next_posts_link( __( '下一页 <i class="iconfont icon-right"></i>' ) ); ?></div>
        <div class="newer"><?php previous_posts_link( __( '<i class="iconfont icon-weibiaoti6"></i> 上一页' ) ); ?></div>

    </div>

	<?php

}


//////////////////////////////////////////////////////////////////
// add more
//////////////////////////////////////////////////////////////////


add_filter( 'pre_option_link_manager_enabled', '__return_true' );


//添加设置菜单，注意add_menu_page和add_submenu_page的写法
//参考：http://lizhenzhen8911.blog.163.com/blog/static/96400189201292442712309/
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


/**
 * go to index if not author
 */
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}

add_action( 'admin_init', 'redirect_non_admin_users' );


/**
 * Cookie from the comment
 */

add_filter( 'auth_cookie_expiration', 'cookie', 99, 3 );
function cookie( $expiration, $user_id = 0, $remember = true ) {

	if ( $remember ) {

		$expiration = 31536000;

	}

	return $expiration;

}

/**
 * 禁用前端管理工具
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * description
 */

function custom_excerpt_length( $length ) {
	return 200;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function sp_string_limit_words( $string, $word_limit ) {
	$words = explode( ' ', $string, ( $word_limit + 1 ) );

	if ( count( $words ) > $word_limit ) {
		array_pop( $words );
	}

	return implode( ' ', $words );
}

/**
 * Like weibo time style
 *
 * @param string $older_date
 * @param bool $comment_date
 *
 * @return string
 */
function mutheme_time_since( $older_date, $comment_date = false ) {
	$chunks = array(
		array( 24 * 60 * 60, __( ' 天前' ) ),
		array( 60 * 60, __( '  小时前' ) ),
		array( 60, __( ' 分钟前' ) ),
		array( 1, __( ' 秒前' ) )
	);

	$newer_date = time();
	$since      = abs( $newer_date - $older_date );

	if ( $since < 30 * 24 * 60 * 60 ) {
		for ( $i = 0, $j = count( $chunks ); $i < $j; $i ++ ) {
			$seconds = $chunks[ $i ][0];
			$name    = $chunks[ $i ][1];
			if ( ( $count = floor( $since / $seconds ) ) != 0 ) {
				break;
			}
		}
		$output = $count . $name;
	} else {
		$output = $comment_date ? date( 'Y年 m月 d日 H:i', $older_date ) : date( 'Y年 m月 d日', $older_date );
	}

	return $output;
}


/**
 * WordPress post thubnail
 */
if ( ! function_exists( 'get_mypost_thumbnail' ) ) {
	function get_mypost_thumbnail( $post_ID ) {
		if ( has_post_thumbnail() ) {
			$timthumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), 'full' );
			$url          = $timthumb_src[0];
		} else {
			$post_content = '';
			if ( ! $post_content ) {
				$post         = get_post( $post_ID );
				$post_content = $post->post_content;
			}
			preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', do_shortcode( $post_content ), $matches );
			if ( $matches && isset( $matches[1] ) && isset( $matches[1][0] ) ) {
				$url = $matches[1][0];
			} else {
				$url = '';
			}
		}

		return $url;
	}
}


/**
 * add @ after the comment
 */
function ludou_comment_add_at( $comment_text, $comment = '' ) {
	if ( $comment->comment_parent > 0 ) {
		$comment_text = '<a href="#comment-' . $comment->comment_parent . '">@' . get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
	}

	return $comment_text;
}

add_filter( 'comment_text', 'ludou_comment_add_at', 20, 2 );


/**
 * Post category
 */
function sp_category( $separator ) {

	if ( get_theme_mod( 'sp_featured_cat_hide' ) == true ) {

		$excluded_cat = get_theme_mod( 'sp_featured_cat' );

		$first_time = 1;
		foreach ( ( get_the_category() ) as $category ) {
			if ( $category->cat_ID != $excluded_cat ) {
				if ( $first_time == 1 ) {
					echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "在 %s 中查看所有文章" ), $category->name ) . '" ' . '>' . $category->name . '</a>';
					$first_time = 0;
				} else {
					echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "在 %s 中查看所有文章" ), $category->name ) . '" ' . '>' . $category->name . '</a>';
				}
			}
		}

	} else {

		$first_time = 1;
		foreach ( ( get_the_category() ) as $category ) {
			if ( $first_time == 1 ) {
				echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "在 %s 中查看所有文章" ), $category->name ) . '" ' . '>' . $category->name . '</a>';
				$first_time = 0;
			} else {
				echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "在 %s 中查看所有文章" ), $category->name ) . '" ' . '>' . $category->name . '</a>';
			}
		}

	}
}

/**
 * Post views
 */
function post_views( $before = '', $after = ' 次阅读', $echo = 1 ) {
	global $post;
	$post_ID = $post->ID;
	$views   = (int) get_post_meta( $post_ID, 'views', true );
	if ( $echo ) {
		echo $before, number_format( $views ), $after;
	} else {
		return $views;
	}
}

function record_visitors() {
	if ( is_singular() ) {
		global $post;
		$post_ID = $post->ID;
		if ( $post_ID ) {
			$post_views = (int) get_post_meta( $post_ID, 'views', true );
			if ( ! update_post_meta( $post_ID, 'views', ( $post_views + 1 ) ) ) {
				add_post_meta( $post_ID, 'views', 1, true );
			}
		}
	}
}

add_action( 'wp_head', 'record_visitors' );


//////////////////////////////////////////////////////////////////
// other
//////////////////////////////////////////////////////////////////


if ( ! function_exists( 'get_mypost_thumbnail' ) ) {
	function get_mypost_thumbnail( $post_ID ) {
		if ( has_post_thumbnail() ) {
			$timthumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), 'full' );
			$url          = $timthumb_src[0];
		} else {
			if ( ! $post_content ) {
				$post         = get_post( $post_ID );
				$post_content = $post->post_content;
			}
			preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', do_shortcode( $post_content ), $matches );
			if ( $matches && isset( $matches[1] ) && isset( $matches[1][0] ) ) {
				$url = $matches[1][0];
			} else {
				$url = '';
			}
		}

		return $url;
	}
}

// 同步文章图文内容到微博 by banxia.me

function post_to_sina_weibo( $post_ID ) {
	if ( wp_is_post_revision( $post_ID ) ) {
		return;
	}

	// 替换成你的新浪微博登陆名
	$username = "id";
	// 替换成你的新浪微博密码
	$password = "password";
	// 替换成你的微博开放平台的AppKey，如果没有请不必更改。
	$appkey = "3319626145";


	/* 获取特色图片，如果没设置就抓取文章第一张图片 */
	$url = get_mypost_thumbnail( $post_ID );


	if ( get_post_status( $post_ID ) == 'publish' && $_POST['original_post_status'] != 'publish' ) {
		$request = new WP_Http;
		$status  = strip_tags( $_POST['excerpt'] ) . ' ' . get_permalink( $post_ID );

		if ( ! empty( $url ) ) {
			$api_url = 'https://api.weibo.com/2/statuses/upload_url_text.json'; /* 新的API接口地址 */
			$body    = array( 'status' => $status, 'source' => $appkey, 'url' => $url );
		} else {
			$api_url = 'https://api.weibo.com/2/statuses/update.json';
			$body    = array( 'status' => $status, 'source' => $appkey );
		}


		$headers = array( 'Authorization' => 'Basic ' . base64_encode( "$username:$password" ) );
		$result  = $request->post( $api_url, array( 'body' => $body, 'headers' => $headers ) );
	}
}

add_action( 'publish_post', 'post_to_sina_weibo', 0 );


// 文章内链 by bigfa
function fa_insert_posts( $atts, $content = null ) {
	extract( shortcode_atts( array(

		'ids' => ''

	),
		$atts ) );
	global $post;
	$content     = '';
	$postids     = explode( ',', $ids );
	$inset_posts = get_posts( array( 'post__in' => $postids ) );
	foreach ( $inset_posts as $key => $post ) {
		setup_postdata( $post );
		$content .= '

<div class="aaroninpostsbox"><div class="aaroninpostsimg"><a href="' . get_permalink() . '" target="_blank" class="mixipImage" >' . get_the_post_thumbnail() . '</a></div><a href="' . get_permalink() . '" target="_blank"><span class="aaroninpostsbox-strong">' . get_the_title() . '</span></a><em class="aaronipem">' . get_the_excerpt() . '...</em><div class="aaronipmeta"><br />发表于 ' . get_the_date() . ' - ' . get_comments_number() . ' 条评论.</div></div>
';
	}
	wp_reset_postdata();

	return $content;
}

add_shortcode( 'in_post', 'fa_insert_posts' );

/**
 * WordPress评论回复邮件提醒防垃圾评论版
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *
 *  2014年7月5日 ：
 *  首个版本
 */

function ludou_comment_mail_notify( $comment_id, $comment_status ) {
	// 评论必须经过审核才会发送通知邮件
	if ( $comment_status !== 'approve' && $comment_status !== 1 ) {
		return;
	}

	$comment = get_comment( $comment_id );

	if ( $comment->comment_parent != '0' ) {
		$parent_comment = get_comment( $comment->comment_parent );

		// 邮件接收者email
		$to = trim( $parent_comment->comment_author_email );

		// 邮件标题
		$subject = '您在[' . get_option( "blogname" ) . ']的留言有了新的回复';

		// 邮件内容，自行修改，支持HTML
		$message = '
<div style="border-bottom:3px solid #f2e929;">
<div style="border:2px solid #f2e929;  padding:10px 30px 0px 30px;">
<div style="width: 88px; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto;"><img width="100%" src="https://www.banxia.mewp-content/uploads/2016/02/aas_fav.png"></div>
<div style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 14px; line-height: 18px; color: #999; ">   
      <p>Hi, ' . $parent_comment->comment_author . '</p>
      <p>您之前在《' . get_the_title( $comment->comment_post_ID ) . '》的留言：<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#f2e929;">'
		           . $parent_comment->comment_content . '</blockquote></p>
      <p>' . $comment->comment_author . ' 给您回复:<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#f2e929;">'
		           . $comment->comment_content . '</blockquote></p>
      <p>您可以 <a href="' . htmlspecialchars( get_comment_link( $comment->comment_parent ) ) . ' " style="text-decoration: none; color: #148cf1">点此查看回复完整內容</a></p>
      <p>欢迎再度光临 <a href="' . home_url() . '" style="text-decoration: none; color: #148cf1">' . get_option( 'blogname' ) . '</a><br /><br /></p>
</div>
      
<p style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 12px; line-height: 20px; color: #999;">本邮件由AARON系统自动发出，请勿<span style="color:#f2e929">直接回复</span>哦。<br>如需联系，可发邮件至 <a href="mailto:iam@ngaaron.com" style="color: #148cf1">iam@ngaaron.com</a></p>
 <p align="center" style="margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; font-size: 12px; line-height: 20px; color: #999;">© 2015 <a href="https://www.banxia.me" style="text-decoration: none; color: #282828"><strong>AARON</strong><span style="color: #999"> · Amateur Studio</span></a></p>

</div></div>
';

		$message_headers = "Content-Type: text/html; charset=\"" . get_option( 'blog_charset' ) . "\"\n";

		// 不用给不填email的评论者和管理员发提醒邮件
		if ( $to != '' && $to != get_bloginfo( 'admin_email' ) ) {
			@wp_mail( $to, $subject, $message, $message_headers );
		}
	}
}


// 编辑和管理员的回复直接发送提醒邮件，因为编辑和管理员的评论不需要审核
add_action( 'comment_post', 'ludou_comment_mail_notify', 20, 2 );

// 普通访客发表的评论，等博主审核后再发送提醒邮件
add_action( 'wp_set_comment_status', 'ludou_comment_mail_notify', 20, 2 );


function fa_get_postlength() {
	global $post;

	return strlen( strip_shortcodes( strip_tags( apply_filters( 'the_content', $post->post_content ) ) ) );
}

function fa_get_post_img_count() {
	global $post;
	preg_match_all( '/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $post->post_content, $strResult, PREG_PATTERN_ORDER );

	return count( $strResult[1] );
}

function fa_get_post_readtime() {
	global $post;

	return ceil( fa_get_postlength() / 800 + fa_get_post_img_count() * 8 / 60 );
}