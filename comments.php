<div class="post-comments" id="comments">


	<?php
	if ( comments_open() ) :
		echo '<div class="post-box"><h4 class="post-box-title">';
		comments_number( __( '暂无评论' ), __( '1条评论' ), '% ' . __( '条评论' ) );
		echo '</h4></div>';
	endif;

	echo "<div class='comments'>";

	wp_list_comments( array(
		'avatar_size' => 50,
		'max_depth'   => 5,
		'style'       => 'ul',
		'callback'    => 'solopine_comments',
		'type'        => 'all'
	) );

	echo "</div>";

	echo "<div id='comments_pagination'>";
	paginate_comments_links( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) );
	echo "</div>";

	$custom_comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';  //label removed for cleaner layout

	comment_form( array(
		'comment_field'        => $custom_comment_field,
		'comment_notes_after'  => '',
		'logged_in_as'         => '',
		'comment_notes_before' => '',
		'title_reply'          => __( '发表评论' ),
		'cancel_reply_link'    => __( '取消回复' ),
		'label_submit'         => __( '发送评论' )
	) );
	?>


</div> <!-- end comments div -->