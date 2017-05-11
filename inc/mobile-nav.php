<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
	<aside class="mobile-sidebar sidebar-hide">
	<div class="author">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
    </div>
    	<?php get_search_form(); ?>
		<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
			<nav class="mobile-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'container'      => '',
					'menu_id'        => 'primary-menu-mobile',
					'menu_class'     => 'primary-menu-mobile',
				) );
				?>
			</nav>
		<?php endif; ?>
	</aside>
<?php endif; ?>