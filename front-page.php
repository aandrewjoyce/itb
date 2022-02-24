<?php get_header(); ?>

<main>
<?php
	$i = 0;
    if ( have_posts() ) { ?>
	<?php while ( have_posts() ) {
	    ?>
        <article <?php echo ($i < 1) ? 'class="first"' : ''; ?>'>
            <?php the_post(); ?>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if ( $i < 1 ) {
	            the_content('Read this Post');
            } ?>
            <p class="post-info">
                Posted: <date><?php the_date('F j, Y'); ?></date>
                Time to Read: <label><?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute"]'); ?></label>
            </p>

        </article>
    <?php $i++; } ?>
<?php } ?>
</main>
<?php get_footer(); ?>