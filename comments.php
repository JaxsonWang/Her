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

	$custom_comment_field = '<p class="comment-smilies"/>
		<a href="javascript:grin(\':?:\')"      ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_question.gif"  alt="" /></a>
		<a href="javascript:grin(\':razz:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_razz.gif"      alt="" /></a>
		<a href="javascript:grin(\':sad:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_sad.gif"       alt="" /></a>
		<a href="javascript:grin(\':evil:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_evil.gif"      alt="" /></a>
		<a href="javascript:grin(\':!:\')"      ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_exclaim.gif"   alt="" /></a>
		<a href="javascript:grin(\':smile:\')"  ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_smile.gif"     alt="" /></a>
		<a href="javascript:grin(\':oops:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_redface.gif"   alt="" /></a>
		<a href="javascript:grin(\':grin:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_biggrin.gif"   alt="" /></a>
		<a href="javascript:grin(\':eek:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_surprised.gif" alt="" /></a>
		<a href="javascript:grin(\':shock:\')"  ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_eek.gif"       alt="" /></a>
		<a href="javascript:grin(\':???:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_confused.gif"  alt="" /></a>
		<a href="javascript:grin(\':cool:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_cool.gif"      alt="" /></a>
		<a href="javascript:grin(\':lol:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_lol.gif"       alt="" /></a>
		<a href="javascript:grin(\':mad:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_mad.gif"       alt="" /></a>
		<a href="javascript:grin(\':twisted:\')"><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_twisted.gif"   alt="" /></a>
		<a href="javascript:grin(\':roll:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_rolleyes.gif"  alt="" /></a>
		<a href="javascript:grin(\':wink:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_wink.gif"      alt="" /></a>
		<a href="javascript:grin(\':idea:\')"   ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_idea.gif"      alt="" /></a>
		<a href="javascript:grin(\':arrow:\')"  ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_arrow.gif"     alt="" /></a>
		<a href="javascript:grin(\':neutral:\')"><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_neutral.gif"   alt="" /></a>
		<a href="javascript:grin(\':cry:\')"    ><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_cry.gif"       alt="" /></a>
		<a href="javascript:grin(\':mrgreen:\')"><img class="wp-smiley" src="' . get_template_directory_uri() . '/img/smilies/icon_mrgreen.gif"   alt="" /></a>
		</p>
        <p class="comment-form-comment">
        <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

	comment_form( array(
		'comment_field'        => $custom_comment_field,
		'comment_notes_after'  => '',
		'logged_in_as'         => '',
		'comment_notes_before' => '',
		'title_reply'          => __( '发表评论' ),
		'cancel_reply_link'    => __( '取消回复' ),
		'label_submit'         => __( '发送评论' ),
	) );
	?>

    <!-- 自定义表情添加入文本框js -->
    <script type="text/javascript">
        function grin(tag) {
            if (document.getElementById('comment') && document.getElementById('comment').type === 'textarea') {
                myField = document.getElementById('comment');
            } else {
                return false;
            }
            tag = ' ' + tag + ' ';
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = tag;
                myField.focus();
            }
            else if (myField.selectionStart || myField.selectionStart === '0') {
                startPos = myField.selectionStart;
                endPos = myField.selectionEnd;
                cursorPos = startPos;
                myField.value = myField.value.substring(0, startPos)
                    + tag
                    + myField.value.substring(endPos, myField.value.length);
                cursorPos += tag.length;
                myField.focus();
                myField.selectionStart = cursorPos;
                myField.selectionEnd = cursorPos;
            }
            else {
                myField.value += tag;
                myField.focus();
            }
        }
    </script>
</div> <!-- end comments div -->