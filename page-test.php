<?php

/* Template Name: 测试模板 */

?>

<?php get_header(); ?>


<section id="primary" class="content-area">
    <main class="full-page">
	    <?php
	    $get_smiley_url = '';
	    if (get_option( 'theme_static_qiniucdn' ) == 'checked' ) {
		    $get_smiley_url = get_option( 'theme_qiniucdn' ) . '/her';
	    } else {
		    $get_smiley_url = get_template_directory_uri();
	    }

	    echo $get_smiley_url;
	    ?>
    </main>

</section>

<?php get_footer(); ?>
