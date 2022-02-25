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

                            $items=[];
                            foreach ($responsedata as $item) {
	                           // $uniqueyears = array_unique($items);
//	                            for every item whos $item->year matches $uniqueyear,
//                                add $item->month and $item->posts as a key-value pair in an array in that $uniqueyear

                                $items[$item->year][$item->month] .= $item->posts;
                                $years[] = $item->year;
                            }

                            $year_string = '';
                            $year_total = 0;

                            foreach ($items as $item) {
                                $i = 1;
                                while ($i < 13) {
                                    if ( isset($item[$i]) ) {
                                        $year_string .= $item[$i] . ',';
                                        $year_total = $year_total + number_format($item[$i]);
                                    } else { $year_string .= '0,'; }
                                    $i++;
                                }
                                $yearstrings[] = $year_string;
                                $yeartotals[] = $year_total;

                                unset($year_string);
                                unset($year_total);
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


                            <?php
            //            global $wpdb;
            //		        $result = array();
            //
            //		        $query_prepare = $wpdb->prepare("SELECT YEAR(post_date) FROM ($wpdb->posts) WHERE post_status = 'publish' AND post_type = %s GROUP BY YEAR(post_date) DESC", 'post');
            //
            //		        $years = $wpdb->get_results($query_prepare);
            //
            //		        if (is_array($years) && count($years) > 0) {
            //			        foreach ($years as $year) {
            //				        $year = preg_replace('/[^0-9.]+/', '', json_encode($year));
            //				        echo '<h4>' . $year . ': ';
            //				        $i = 1;
            //				        while ($i < 13) {
            //					        $args = array('date_query' => array(
            //						        array(
            //							        'month' => $i,
            //							        'year' => $year,
            //						        )
            //					        ));
            //					        $query = new WP_Query($args);
            //
            //					        if ($query->have_posts()) {
            //						        $j = 0;
            //						        while ($query->have_posts()) {
            //							        $query->the_post();
            //							        $j++;
            //						        }
            //						        $results[] = $j;
            //					        } else {
            //						        $results[] = 0;
            //					        }
            //
            //					        $i++;
            //				        }
            //				        echo 'x' . array_sum($results) . '</h4>';
            //				        $yearresults = implode(',', $results);
            //				        unset($results);
            //				        echo '<img src="https://v1.sparkline.11ty.dev/800x160/' . $yearresults . '/%2394b388/" alt="Sparkline" loading="lazy" decoding="async" class="spark-img" width="800" height="160">';
            //				        echo '<br/>';
            //				        echo '<br/>';
            //			        }
            //		        }
            //	        ?>
        </section>
</main>

<?php get_footer(); ?>