<?php
define( 'AC_VERSION', '1.0.0' );

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	wp_die( '请升级到4.4以上版本' );
}

if ( ! function_exists( 'her_ajax_comment_scripts' ) ) :

	function her_ajax_comment_scripts() {
		wp_enqueue_script( 'ajax-comment', get_template_directory_uri() . '/js/ajax-comment.js', array(), AC_VERSION, true );
		wp_localize_script( 'ajax-comment', 'ajaxcomment', array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ),
			'order'       => get_option( 'comment_order' ),
			'formpostion' => 'bottom', //默认为bottom，如果你的表单在顶部则设置为top。
		) );
	}

endif;

if ( ! function_exists( 'her_ajax_comment_err' ) ) :

	function her_ajax_comment_err( $a ) {
		header( 'HTTP/1.0 500 Internal Server Error' );
		header( 'Content-Type: text/plain;charset=UTF-8' );
		echo $a;
		exit;
	}

endif;

if ( ! function_exists( 'her_ajax_comment_callback' ) ) :

	function her_ajax_comment_callback() {
		$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
		if ( is_wp_error( $comment ) ) {
			$data = $comment->get_error_data();
			if ( ! empty( $data ) ) {
				her_ajax_comment_err( $comment->get_error_message() );
			} else {
				exit;
			}
		}
		$user = wp_get_current_user();
		do_action( 'set_comment_cookies', $comment, $user );
		$GLOBALS['comment'] = $comment; //根据你的评论结构自行修改，如使用默认主题则无需修改
		?>
        <li <?php comment_class(); ?>>
            <article class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
						<?php echo get_avatar( $comment, $size = '56' ) ?>
                        <b class="fn">
							<?php echo get_comment_author_link(); ?>
                        </b>
                    </div>
                    <div class="comment-metadata">
						<?php echo get_comment_date(); ?>
                    </div>
                </footer>
                <div class="comment-content">
					<?php comment_text(); ?>
                </div>
            </article>
        </li>
		<?php die();
	}

endif;

add_action( 'wp_enqueue_scripts', 'her_ajax_comment_scripts' );
add_action( 'wp_ajax_nopriv_ajax_comment', 'her_ajax_comment_callback' );
add_action( 'wp_ajax_ajax_comment', 'her_ajax_comment_callback' );