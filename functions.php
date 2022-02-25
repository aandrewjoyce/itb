<?php
// Enqueue our stylesheet
function itb_theme() {
	wp_enqueue_style('style', get_stylesheet_uri(), '2.0.8');
}   add_action('wp_enqueue_scripts', 'itb_theme');

// Let WordPress deal with titles
add_theme_support( 'title-tag' );
// Yes, we image and so can you
add_theme_support( 'post-thumbnails' );


function ed_if_featured_image_class($classes) {
	if ( has_post_thumbnail() ) {
		array_push($classes, 'has-featured-image');
	}
	return $classes;
}   add_action('body_class', 'ed_if_featured_image_class' );


function unlimited_archives( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		// Not a query for an admin page.
		if ( is_archive() ) {
			// It's the main query for anarchive.
			$query->set( 'posts_per_page', -1 );
		}
	}
}
add_action( 'pre_get_posts', 'unlimited_archives' );



function errorsea_archive_title( $title ) {
	if ( is_category() ) {
		// Remove prefix in category archive page
		$title = single_cat_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'errorsea_archive_title' );

// Fancy archive nonsense
class Rest_Post_Archives {
		/**
		 * Run WordPress filters
		 */
		public function run() {
			add_action( 'rest_api_init', function () {
				register_rest_route( 'wp/v2', '/posts/archives', array(
					'methods' => 'GET',
					'callback' => array($this, 'get_rest_post_archives'),
					'permission_callback' => '__return_true',
				) );
			} );
		}

		/**
		 * Get the post archives from rest api
		 *
		 * @param $request
		 *
		 * @return mixed|\WP_REST_Response
		 */
		public function get_rest_post_archives( $request ) {
			global $wpdb;

			$defaults = array(
				'type' => 'monthly', 'limit' => '',
				'format' => 'html', 'before' => '',
				'after' => '', 'show_post_count' => false,
				'echo' => 1, 'order' => 'DESC',
				'post_type' => 'post'
			);

			$r = wp_parse_args( $request, $defaults );

			$post_type_object = get_post_type_object( $r['post_type'] );
			if ( ! is_post_type_viewable( $post_type_object ) ) {
				return;
			}
			$r['post_type'] = $post_type_object->name;

			if ( '' == $r['type'] ) {
				$r['type'] = 'monthly';
			}

			if ( ! empty( $r['limit'] ) ) {
				$r['limit'] = absint( $r['limit'] );
				$r['limit'] = ' LIMIT ' . $r['limit'];
			}

			$order = strtoupper( $r['order'] );
			if ( $order !== 'ASC' ) {
				$order = 'DESC';
			}

			$sql_where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );

			/**
			 * Filters the SQL WHERE clause for retrieving archives.
			 *
			 * @since 2.2.0
			 *
			 * @param string $sql_where Portion of SQL query containing the WHERE clause.
			 * @param array  $r         An array of default arguments.
			 */
			$where = apply_filters( 'getarchives_where', $sql_where, $r );

			/**
			 * Filters the SQL JOIN clause for retrieving archives.
			 *
			 * @since 2.2.0
			 *
			 * @param string $sql_join Portion of SQL query containing JOIN clause.
			 * @param array  $r        An array of default arguments.
			 */
			$join = apply_filters( 'getarchives_join', '', $r );

			$last_changed = wp_cache_get_last_changed( 'posts' );

			$limit = $r['limit'];

			$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
			$key = md5( $query );
			$key = "wp_get_archives:$key:$last_changed";
			if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
				$results = $wpdb->get_results( $query );
				wp_cache_set( $key, $results, 'posts', 86400);
			}

			return rest_ensure_response( $results );
		}

}