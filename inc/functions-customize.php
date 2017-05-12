<?php

//跳转索引
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}
add_action( 'admin_init', 'redirect_non_admin_users' );

//评论回调
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

//分页
function solopine_pagination() {
	?>
	<div class="pagination">
		<div class="older"><?php next_posts_link( __( '下一页 <i class="iconfont icon-right"></i>' ) ); ?></div>
		<div class="newer"><?php previous_posts_link( __( '<i class="iconfont icon-weibiaoti6"></i> 上一页' ) ); ?></div>
	</div>
	<?php
}

//保留cookie信息
add_filter( 'auth_cookie_expiration', 'cookie', 99, 3 );
function cookie( $expiration, $user_id = 0, $remember = true ) {
	if ( $remember ) {
		$expiration = 31536000;
	}
	return $expiration;
}

//文章摘要描述
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
 * 发布时间
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

//获取文章特色图片
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

//文章类别
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

//浏览次数
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

// 引用文章
function fa_insert_posts( $atts, $content = null ){
	extract( shortcode_atts( array(

		'ids' => ''

	),
		$atts ) );
	global $post;
	$content = '';
	$postids =  explode(',', $ids);
	$inset_posts = get_posts(array('post__in'=>$postids));
	foreach ($inset_posts as $key => $post) {
		setup_postdata( $post );
		$content .=  '

<div class="aaroninpostsbox"><div class="aaroninpostsimg"><a href="' . get_permalink() . '" target="_blank" class="mixipImage" >' . get_the_post_thumbnail() . '</a></div><a href="' . get_permalink() . '" target="_blank"><span class="aaroninpostsbox-strong">' . get_the_title() . '</span></a><em class="aaronipem">' . get_the_excerpt() . '...</em><div class="aaronipmeta"><br />发表于 ' . get_the_date() . ' - ' . get_comments_number(). ' 条评论.</div></div>
';
	}
	wp_reset_postdata();
	return $content;
}
add_shortcode('in_post', 'fa_insert_posts');

//WordPress评论回复邮件提醒防垃圾评论版
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
		$message = '<div style="border-bottom:3px solid #C69F73;">
    <div style="border:2px solid #C69F73;padding:10px 30px 0 30px;">
        <div style="width: 88px; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto;">' . get_bloginfo( 'name' ) . '</div>
        <div style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 14px; line-height: 18px; color: #999; ">
            <p>Hi, ' . $parent_comment->comment_author . '</p>
            <p>您之前在《' . get_the_title( $comment->comment_post_ID ) . '》的留言：<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#C69F73;">'
		           . $parent_comment->comment_content . '</blockquote></p>
            <p>' . $comment->comment_author . ' 给您回复:<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#C69F73;">'
		           . $comment->comment_content . '</blockquote></p>
            <p>您可以 <a href="' . htmlspecialchars( get_comment_link( $comment->comment_parent ) ) . ' " style="text-decoration: none; color: #148cf1">点此查看回复完整內容</a></p>
            <p>欢迎再度光临 <a href="' . home_url() . '" style="text-decoration: none; color: #148cf1">' . get_option( 'blogname' ) . '</a><br /><br /></p>
        </div>
        <p style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 12px; line-height: 20px; color: #999;">本邮件由博客系统自动发出，请勿<span style="color:#C69F73">直接回复</span>哦。<br>如需联系，可发邮件至 <a href="mailto:' . get_bloginfo( 'admin_email' ) . ' " style="color: #148cf1">' . get_bloginfo( 'admin_email' ) . '</a></p>
        <p align="center" style="margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; font-size: 12px; line-height: 20px; color: #999;">© 2017 <a href="" style="text-decoration: none; color: #282828"><strong>' . get_bloginfo( 'name' ) . '</strong></a></p>
    </div></div>';

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

//
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

//取当前主题下smilies\下表情图片路径
function custom_smilie9s_src( $old, $img ) {
	//CDN判断
	if (get_option( 'theme_static_qiniucdn' ) == 'checked' ) {
		$get_smiley_url = get_option( 'theme_qiniucdn' ) . '/her';
	} else {
		$get_smiley_url = get_template_directory_uri();
	}
	return $get_smiley_url . '/img/smilies/' . $img;
}

function init_smilie9s() {
	global $wpsmiliestrans;
	//默认表情文本与表情图片的对应关系(可自定义修改)
	$wpsmiliestrans = array(
		':mrgreen:' => 'icon_mrgreen.gif',
		':neutral:' => 'icon_neutral.gif',
		':twisted:' => 'icon_twisted.gif',
		':arrow:'   => 'icon_arrow.gif',
		':shock:'   => 'icon_eek.gif',
		':smile:'   => 'icon_smile.gif',
		':???:'     => 'icon_confused.gif',
		':cool:'    => 'icon_cool.gif',
		':evil:'    => 'icon_evil.gif',
		':grin:'    => 'icon_biggrin.gif',
		':idea:'    => 'icon_idea.gif',
		':oops:'    => 'icon_redface.gif',
		':razz:'    => 'icon_razz.gif',
		':roll:'    => 'icon_rolleyes.gif',
		':wink:'    => 'icon_wink.gif',
		':cry:'     => 'icon_cry.gif',
		':eek:'     => 'icon_surprised.gif',
		':lol:'     => 'icon_lol.gif',
		':mad:'     => 'icon_mad.gif',
		':sad:'     => 'icon_sad.gif',
		'8-)'       => 'icon_cool.gif',
		'8-O'       => 'icon_eek.gif',
		':-('       => 'icon_sad.gif',
		':-)'       => 'icon_smile.gif',
		':-?'       => 'icon_confused.gif',
		':-D'       => 'icon_biggrin.gif',
		':-P'       => 'icon_razz.gif',
		':-o'       => 'icon_surprised.gif',
		':-x'       => 'icon_mad.gif',
		':-|'       => 'icon_neutral.gif',
		';-)'       => 'icon_wink.gif',
		'8O'        => 'icon_eek.gif',
		':('        => 'icon_sad.gif',
		':)'        => 'icon_smile.gif',
		':?'        => 'icon_confused.gif',
		':D'        => 'icon_biggrin.gif',
		':P'        => 'icon_razz.gif',
		':o'        => 'icon_surprised.gif',
		':x'        => 'icon_mad.gif',
		':|'        => 'icon_neutral.gif',
		';)'        => 'icon_wink.gif',
		':!:'       => 'icon_exclaim.gif',
		':?:'       => 'icon_question.gif',
	);

	//移除WordPress4.2版本更新所带来的Emoji前后台钩子同时挂上主题自带的表情路径
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	add_filter( 'smilies_src', 'custom_smilie9s_src', 10, 2 );
}

add_action( 'init', 'init_smilie9s', 5 );

// 评论链接跳转&新窗口打开
function add_redirect_comment_link( $text = '' ) {
	$text = str_replace( "href='", "href='" . get_option( 'home' ) . "/?r=", $text );
	$text = preg_replace( '/<a (.+?)>/i', "<a $1 target='_blank' rel='nofollow'>", $text );

	return $text;
}

function redirect_comment_link() {
	$redirect = isset( $_GET['r'] ) && $_GET['r'] ? $_GET['r'] : '';
	if ( $redirect ) {
		if ( strpos( $_SERVER['HTTP_REFERER'], get_option( 'home' ) ) !== false ) {
			header( "Location: $redirect" );
			exit;
		} else {
			header( "Location: " . bloginfo( 'url' ) . "/" );
			exit;
		}
	}
}

add_action( 'init', 'redirect_comment_link' );
add_filter( 'get_comment_author_link', 'add_redirect_comment_link', 5 );
add_filter( 'the_content', 'add_redirect_comment_link', 5 ); //nofollow文章内容的站外链接

// @父评论
add_filter( 'comment_text', 'comment_add_at_parent' );
function comment_add_at_parent( $comment_text ) {
	$comment_ID = get_comment_ID();
	$comment    = get_comment( $comment_ID );
	if ( $comment->comment_parent ) {
		$parent_comment = get_comment( $comment->comment_parent );
		$comment_text   = '<a href="#comment-' . $comment->comment_parent . '">@' . $parent_comment->comment_author . '</a> ' . $comment_text;
	}

	return $comment_text;
}

// 后台登录头像
function custom_login_logo() {
	echo '<style type="text/css">
		h1 a { background-image:url(' . esc_html( get_option( 'theme_logo' ) ) . ') !important;}
		</style>';
}
add_action( 'login_head', 'custom_login_logo' );



// 评论框信息上调
function recover_comment_fields( $comment_fields ) {
	$comment        = array_shift( $comment_fields );
	$comment_fields = array_merge( $comment_fields, array( 'comment' => $comment ) );

	return $comment_fields;
}
add_filter( 'comment_form_fields', 'recover_comment_fields' );

//搜索结果排除所有页面
function search_filter_page( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'search_filter_page' );

// 评论楼层
function her_comment_floor_css() {
	global $wp_query;
	if ( is_singular() ) {
		global $post;
		$comments = get_comments( array(
			'post_id' => get_the_ID(),
			'orderby' => 'comment_date_gmt',
			'order'   => 'ASC',
			'status'  => 'all',
		) );
		$page     = get_query_var( 'cpage' ) ? get_query_var( 'cpage' ) : get_comment_pages_count( $comments );
	}
}

add_action( 'wp_head', 'her_comment_floor_css', 10 );

//图片七牛云缓存
add_filter('upload_dir', 'wpjam_custom_upload_dir');
function wpjam_custom_upload_dir($uploads)
{
	$upload_path = '';
	$upload_url_path = get_option('theme_qiniucdn') . '/wp-content/uploads';

	if (empty($upload_path) || 'wp-content/uploads' == $upload_path) {
		$uploads['basedir'] = WP_CONTENT_DIR . '/uploads';
	} elseif (0 !== strpos($upload_path, ABSPATH)) {
		$uploads['basedir'] = path_join(ABSPATH, $upload_path);
	} else {
		$uploads['basedir'] = $upload_path;
	}

	$uploads['path'] = $uploads['basedir'] . $uploads['subdir'];

	if ($upload_url_path) {
		$uploads['baseurl'] = $upload_url_path;
		$uploads['url'] = $uploads['baseurl'] . $uploads['subdir'];
	}
	return $uploads;
}

//网站统计
function theme_track () {
	if ( get_option('theme_blog_track') != '' ) {
		echo get_option('theme_blog_track');
	}
}
add_action("wp_footer","theme_track");
