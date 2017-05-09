<?php

/* Template Name: 测试模板 */

?>

<?php get_header(); ?>


<section id="primary" class="content-area">
    <main class="full-page">
	    <?php
	    echo get_option('theme_blog_track');
	    ?>
    </main>

</section>

<?php get_footer(); ?>
