<div style="margin:50px auto;background-color: #fff;max-width: 800px;border-bottom:3px solid #f2e929;">
    <div style="border:2px solid #f2e929;  padding:10px 30px 0px 30px;">
        <div style="width: 88px; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto;"><a
                    href="https://www.banxia.me" target="new"><img width="100%"
                                                                   src="https://img.alicdn.com/imgextra/i1/2551193784/TB2Jx10qbBmpuFjSZFuXXaG_XXa_!!2551193784.png"></a>
        </div>
        <div style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 14px; line-height: 18px; color: #999; ">
            <p>你好，这个主题的用户：</p>
            <p>很高兴你喜欢这款主题，让我来介绍一下主题的基本设置吧！</p>
            <p style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 12px; line-height: 20px; color: #999;"></p>

            <form method="POST" action="">
                <input type="hidden" name="update_options" value="true"/>
                <table class="form-table">
                    <tbody>
                    <tr id="Social" valign="top">
                        <td><h2 style="text-align:center;">基本设置</h2></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">无特色图像时默认图片</th>
                        <td><input type="text" name="def_banner" value="<?php echo get_option( 'def_banner' ); ?>"/><a
                                    id="def_banner" class="cp_upload_button button" href="#">上传</a></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_author_post">内页作者模块</label></th>
                        <td><input type="checkbox" name="theme_author_post"
                                   id="theme_author_post" <?php echo get_option( 'theme_author_post' ); ?> />如需显示，请勾选。
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_alsolike_post">内页推荐模块</label></th>
                        <td><input type="checkbox" name="theme_alsolike_post"
                                   id="theme_alsolike_post" <?php echo get_option( 'theme_alsolike_post' ); ?> />如需显示，请勾选。
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_author_index">首页作者模块</label></th>
                        <td><input type="checkbox" name="theme_author_index"
                                   id="theme_author_index" <?php echo get_option( 'theme_author_index' ); ?> />如需显示，请勾选。
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_button_post">首页按钮模块</label></th>
                        <td><input type="checkbox" name="theme_button_post"
                                   id="ctheme_button_post" <?php echo get_option( 'theme_button_post' ); ?> />如需显示，请勾选。
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_button_post_down">首页按钮文字</label></th>
                        <td>
                            <input type="input" name="theme_button_post_down" id="theme_button_post_down"
                                   class="regular-text" value="<?php echo get_option( 'theme_button_post_down' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_button_post_url">首页按钮链接</label></th>
                        <td>
                            <input type="input" name="theme_button_post_url" id="theme_button_post_url"
                                   class="regular-text" value="<?php echo get_option( 'theme_button_post_url' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_button_post_title">首页按钮标题</label></th>
                        <td>
                            <input type="input" name="theme_button_post_title" id="theme_button_post_title"
                                   class="regular-text" value="<?php echo get_option( 'theme_button_post_title' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_button_post_meta">首页按钮描述</label></th>
                        <td><textarea name="theme_button_post_meta" id="theme_button_post_meta"
                                      class="large-text"><?php echo get_option( 'theme_button_post_meta' ); ?></textarea>
                        </td>
                    </tr>


                    <tr id="Social" valign="top">
                        <td><h2 style="text-align:center;">社交媒体</h2></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="theme_social">是否显示社交媒体</label></th>
                        <td><input type="checkbox" name="theme_social"
                                   id="ctheme_social" <?php echo get_option( 'theme_social' ); ?> />如需显示，请勾选。
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_weibo">Weibo</label></th>
                        <td>
                            <input type="input" name="sp_weibo" id="sp_weibo" class="regular-text"
                                   value="<?php echo get_option( 'sp_weibo' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_github">Github</label></th>
                        <td>
                            <input type="input" name="sp_github" id="sp_github" class="regular-text"
                                   value="<?php echo get_option( 'sp_github' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_facebook">Facebook</label></th>
                        <td>
                            <input type="input" name="sp_facebook" id="sp_facebook" class="regular-text"
                                   value="<?php echo get_option( 'sp_facebook' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_twitter">Twitter</label></th>
                        <td>
                            <input type="input" name="sp_twitter" id="sp_twitter" class="regular-text"
                                   value="<?php echo get_option( 'sp_twitter' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_instagram">Instagram</label></th>
                        <td>
                            <input type="input" name="sp_instagram" id="sp_instagram" class="regular-text"
                                   value="<?php echo get_option( 'sp_instagram' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_tumblr">Tumblr</label></th>
                        <td>
                            <input type="input" name="sp_tumblr" id="sp_tumblr" class="regular-text"
                                   value="<?php echo get_option( 'sp_tumblr' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_youtube">Youtube</label></th>
                        <td>
                            <input type="input" name="sp_youtube" id="sp_youtube" class="regular-text"
                                   value="<?php echo get_option( 'sp_youtube' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_dribbble">Dribbble</label></th>
                        <td>
                            <input type="input" name="sp_dribbble" id="sp_dribbble" class="regular-text"
                                   value="<?php echo get_option( 'sp_dribbble' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_vimeo">Vimeo</label></th>
                        <td>
                            <input type="input" name="sp_vimeo" id="sp_vimeo" class="regular-text"
                                   value="<?php echo get_option( 'sp_vimeo' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_linkedin">Linkedin</label></th>
                        <td>
                            <input type="input" name="sp_linkedin" id="sp_linkedin" class="regular-text"
                                   value="<?php echo get_option( 'sp_linkedin' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="sp_rss">RSS</label></th>
                        <td>
                            <input type="input" name="sp_rss" id="sp_rss" class="regular-text"
                                   value="<?php echo get_option( 'sp_rss' ); ?>"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p style="text-align:center;"><input type="submit" class="button-primary" name="admin_options"
                                                     value="更新数据"/></p>
            </form>
        </div>

        <p style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 12px; line-height: 20px; color: #999;">
            本邮件由Banxia自动发出，请勿<span style="color:#f2e929">直接回复</span>哦。<br>如需联系，可发邮件至 <a
                    href="mailto:https://www.banxia.me" style="color: #148cf1">331380981@qq.com</a></p>
        <p align="center"
           style="margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; font-size: 12px; line-height: 20px; color: #999;">
            © 2017 <a href="https://www.banxia.me" target="new" style="text-decoration: none; color: #282828"><strong>Banxia</strong><span
                        style="color: #999"> · Amateur Studio</span></a></p>
    </div>
</div>
<?php wp_enqueue_media(); ?> <!-- 必须 -->
<script>
    //调用媒体库上传图片
    jQuery(document).ready(function () {
        var upload_frame;
        var value_id;
        jQuery('.cp_upload_button').live('click', function (event) {
            value_id = jQuery(this).attr('id');
            event.preventDefault();
            if (upload_frame) {
                upload_frame.open();
                return;
            }
            upload_frame = wp.media({
                title: '选择图片',
                button: {
                    text: '插入',
                },
                multiple: false
            });
            upload_frame.on('select', function () {
                attachment = upload_frame.state().get('selection').first().toJSON();
                jQuery('input[name=' + value_id + ']').val(attachment.url);
                //jQuery('img').attr("src",attachment.url);//图片预览
            });

            upload_frame.open();
        });
    });
</script>