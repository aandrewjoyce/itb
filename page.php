<?php get_header(); ?>

<main>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { ?>
        <article>
            <?php the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

        </article>
    <?php } ?>
<?php } ?>
</main>

<?php

    echo '<h3>Posts Published By Year</h3>';
    if (is_page('4345')) {

	global $wpdb;
	$result = array();

	$query_prepare = $wpdb->prepare("SELECT YEAR(post_date) FROM ($wpdb->posts) WHERE post_status = 'publish' AND post_type = %s GROUP BY YEAR(post_date) DESC", 'post');

	$years = $wpdb->get_results($query_prepare);

	if (is_array($years) && count($years) > 0) {
		foreach ($years as $year) {
			$year = preg_replace('/[^0-9.]+/', '', json_encode($year));
			echo '<h4>' . $year . ': ';
			$i = 1;
			while ($i < 13) {
				$args = array('date_query' => array(
					array(
						'month' => $i,
						'year' => $year,
					)
				));
				$query = new WP_Query($args);

				if ($query->have_posts()) {
					$j = 0;
					while ($query->have_posts()) {
						$query->the_post();
						$j++;
					}
					$results[] = $j;
				} else {
					$results[] = 0;
				}

				$i++;
			}
			echo 'x' . array_sum($results) . '</h4>';
			$yearresults = implode(',', $results);
			unset($results);
			echo '<img src="https://v1.sparkline.11ty.dev/800x160/' . $yearresults . '/%2394b388/" alt="Sparkline" loading="lazy" decoding="async" class="spark-img" width="800" height="160">';
			echo '<hr/>';
		}
	}

	}
?>
<?php get_footer(); ?>