<?php get_header(); ?>

<main>
    <h2 class="screen-reader-text">Latest Posts</h2>
<?php
	$i = 0;
    if ( have_posts() ) { ?>
	<?php while ( have_posts() ) {
	    ?>
        <article <?php echo ($i < 1) ? 'class="first"' : ''; ?>>
            <?php the_post(); ?>

            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if ( $i < 1 ) {
	            the_content('Read this Post');
            } ?>
            <p class="post-info">
                Posted: <date><?php the_date('F j, Y'); ?></date>
                Time to Read: <label><?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute"]'); ?></label>
            </p>

        </article>
    <?php $i++; } ?>
        <div class="archives">
            <a class="button" href="/archives">Browse the Archives</a>
            <span class="quiet">(if you dare)</span>
        </div>

        <div class="organize">
            <h2>Browse</h2>
            <span class="quiet">(by topic, or by type of writing)</span>

            <ul class="tags">
		        <?php $args = array(
			        'style'      => 'list',
			        'hide_empty' => 1,
		        );
			        $cats = get_tags($args);

			        foreach ($cats as $cat) {
				        $name = $cat->name;
				        $slug = $cat->slug; ?>

                        <li class="tag <?php echo $slug; ?>"><a href="/topic/<?php echo $slug; ?>"><?php echo $name; ?></a></li>
			        <?php } ?>
            </ul>
            <ul class="categories">
                <?php $args = array(
                    'style'      => 'list',
                    'hide_empty' => 1,
                    );
                    $cats = get_categories($args);

                    foreach ($cats as $cat) {
                        $name = $cat->name;
                        $slug = $cat->slug; ?>

                            <li class="category <?php echo $slug; ?>"><a href="<?php echo $slug; ?>"><?php echo $name; ?></a></li>

                        <style> .<?php echo $slug; ?> { --theme: var(--<?php the_field( 'theme_color', $cat ); ?>); } </style>
                <?php } ?>
            </ul>
        </div>
<?php } ?>
</main>
<?php get_footer(); ?>