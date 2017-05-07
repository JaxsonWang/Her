<?php

/* Template Name: 测试模板 */

?>

<?php get_header(); ?>


<section id="primary" class="content-area">
    <main class="full-page">
	    <?php
	    if ( get_option( 'def_banner' ) == '' ) {
		    echo "no data";
	    } else {
		    echo "yes";
	    }
	    ?>
    </main>
</section>

<?php get_footer(); ?>
