<?php
/*
Plugin Name: SimpleRecentThumbs
Plugin URI: http://brokenlibrarian.org/tinyplugins/simplerecentthumbs/
Description: Adds a widget that shows recent post thumbnails
Version: 1.0
Author: Christian Wagner
Author URI: http://brokenlibrarian.org/tinyplugins/
License: Apache v2
*/
?>
<?php
class WP_Widget_Recent_Thumbs extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_thumbs', 'description' => __( "The most recent thumbnails on your site") );
		parent::__construct('recent-thumbs', __('Recent thumbs'), $widget_ops);
		$this->alt_option_name = 'widget_recent_thumbs';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_thumbs', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
			}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Thumbs') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
		$category = $instance['category']; $more = $instance['more'];

		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category_name' => $category, 'meta_key' => '_thumbnail_id' ));
		if ($r->have_posts()) {

			echo $before_widget;
			if ( $title ) echo ($before_title . $title . $after_title);

			echo ('<ul>');
			
			while ($r->have_posts()) {

				$r->the_post();
				echo ('<li><a class="post-thumb" href="' . get_permalink() . '" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'">');
				echo (the_post_thumbnail('thumbnail') .'</a></li>');
				}

			if ( $more && $category ) echo ('<li><span class="thumbs-more-link"><a href="'. get_category_link( get_cat_ID ($category) ) .'">more...</a></span></li>');

			echo ('</ul>');
			
			echo $after_widget;
			
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

			}

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
		}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['more'] = !empty($new_instance['more']) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_thumbs']) )
			delete_option('widget_recent_thumbs');

		return $instance;
		}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_thumbs', 'widget');
		}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$category = isset($instance['category']) ? esc_attr($instance['category']) : '';
		$more = isset( $instance['more'] ) ? (bool) $instance['more'] : false;
		
		echo ('<p><label for="'. $this->get_field_id('title') .'">Title: </label>');
		echo ('<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="' .$title .'" /></p>');

		echo ('<p><label for="'. $this->get_field_id('number') .'">Number of thumbs to show: </label>');
		echo ('<input id="'. $this->get_field_id('number') .'" name="'. $this->get_field_name('number') .'" type="text" value="'. $number .'		" size="3" /></p>');
		
		echo ('<p><label for="'. $this->get_field_id('category') .'">Filter by category: </label>');
		echo ('<input class="widefat" id="'. $this->get_field_id('category') .'" name="'. $this->get_field_name('category') .'" type="text" value="'. $category .'" /></p>');
		
		echo ('<p><input type="checkbox" class="checkbox" id="'. $this->get_field_id('more') .'" name="'. $this->get_field_name('more') .'" '. checked( $more,true,false ) .'	/>');
		echo ('<label for="'. $this->get_field_id('more') .'"> Show "more" link?</label></p>');
		}
	}
function registerMyWidget() { register_widget('WP_Widget_Recent_Thumbs'); }
add_action( 'widgets_init', 'registerMyWidget' );
?>