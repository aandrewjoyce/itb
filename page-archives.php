<?php get_header(); ?>

    <main>
        <section class="archives">
            <?php if ( have_posts() ) { ?>
                <?php while ( have_posts() ) { ?>
                        <?php the_post(); ?>

                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
	            <?php } ?>
            <?php } ?>

                        <?php
                            // queue up our endpoint class
                            $restPostArchives = new Rest_Post_Archives();
                            $restPostArchives->run();
                            $request = new WP_REST_Request( 'GET', '/wp/v2/posts/archives' );
                            // Set one or more request query parameters
                            $request->set_param( 'per_page', 200 );
                            $response = rest_do_request( $request );
                            $responsedata = $response->data;

                            $dates=[];
                            foreach ($responsedata as $datum) {
                                $dates[$datum->year][$datum->month] = $datum->posts;
                                $years[] = $datum->year;
                            }

                            foreach ($dates as $date) {
	                            $year_string = '';
	                            $year_total = 0;
                                $i = 1;
                                while ($i < 13) {
                                    if ( isset($date[$i]) ) {
                                        $year_string .= $date[$i] . ',';
                                        $year_total = $year_total + number_format($date[$i]);
                                    } else { $year_string .= '0,'; }
                                    $i++;
                                }
                                $yearstrings[] = $year_string;
                                $yeartotals[] = $year_total;

                                unset($year_string);
                            }
                            $uniqueyears = array_unique($years);

                            $k = 0;
                            foreach ($uniqueyears as $year) {
                                echo '<h2>' . $year . '&nbsp;<span>&times;' . $yeartotals[$k] . '</span></h2>';
                                echo '<img src="https://v1.sparkline.11ty.dev/800x80/' . $yearstrings[$k] . '/%2394b388/" alt="Sparkline" loading="lazy" decoding="async" class="spark-img" width="800" height="80">';

                                $args = array(
                                        'date_query' => array(array( 'year' => $year, )),
                                        'posts_per_page' => -1
                                );
                                $query = new WP_Query($args);

                                if ($query->have_posts()) {
                                    echo '<ul class="year-list">';
                                    while ($query->have_posts()) {
                                        $query->the_post(); ?>
                                        <li>
                                            <date><?php the_date('F j'); ?></date>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>,
                                            <?php $cats = get_the_category();
                                            if ( isset($cats[0]) ) { ?>
                                                    <?php if ($cats[0]->name === 'Update' || $cats[0]->name === 'Article' ) {
                                                        echo ' an ';
                                                    } else { echo ' a '; } ?>
                                                <a href="/<?php echo $cats[0]->slug; ?>"><?php echo $cats[0]->name; ?></a>
                                                <?php } ?>
                                            <div class="wordcount"> of <?php echo do_shortcode('[wp-word-count]'); ?> words</div>
	                                        <?php if ( get_the_tags() ) { ?>
                                                <?php echo ' filed in '; ?>
                                                <?php the_tags('<span class="tag">', '</span>, <span class="tag">', '</span>'); ?>
	                                        <?php } ?>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                }

                                $k++;
                            }
                            ?>
        </section>
</main>

<?php get_footer(); ?>