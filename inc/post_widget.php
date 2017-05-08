<?php
/**
 * Plugin Name: Latest Posts Widget
 */

add_action( 'widgets_init', 'solopine_latest_news_load_widget' );

function solopine_latest_news_load_widget() {
	register_widget( 'solopine_latest_news_widget' );
}

class solopine_latest_news_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function solopine_latest_news_widget() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'solopine_latest_news_widget',
			'description' => __( 'A widget that displays your latest posts from all categories or a certain', 'solopine_latest_news_widget' )
		);

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'solopine_latest_news_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'solopine_latest_news_widget', __( 'Rosemary: Latest Posts', 'solopine_latest_news_widget' ), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number     = $instance['number'];


		$query = array(
			'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1,
			'cat'       => $categories
		);

		$loop = new WP_Query( $query );
		if ( $loop->have_posts() ) :

			/* Before widget (defined by themes). */
			echo $before_widget;

			/* Display the widget title if one was input (before and after defined by themes). */
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			?>
            <ul class="side-newsfeed">

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <li>

                <div class="side-item">

					<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
                        <div class="side-image">
                            <a href="<?php echo get_permalink() ?>"
                               rel="bookmark"><?php the_post_thumbnail( 'misc-thumb', array( 'class' => 'side-item-thumb' ) ); ?></a>
                        </div>
					<?php endif; ?>
                    <div class="side-item-text">
                        <h4><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                        <span class="side-item-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    </div>
                </div>

            </li>

		<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		<?php endif; ?>

        </ul>

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number']     = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __( '最新页面：' ), 'number' => 5, 'categories' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '标题：' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'categories' ); ?>">Filter by Category:</label>
            <select id="<?php echo $this->get_field_id( 'categories' ); ?>"
                    name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories"
                    style="width:100%;">
                <option value='all' <?php if ( 'all' == $instance['categories'] ) {
					echo 'selected="selected"';
				} ?>>All categories
                </option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach ( $categories as $category ) { ?>
                    <option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories'] ) {
						echo 'selected="selected"';
					} ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
            </select>
        </p>

        <!-- Number of posts -->
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( '页面：' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
                   name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>"
                   size="3"/>
        </p>


		<?php
	}
}

?>