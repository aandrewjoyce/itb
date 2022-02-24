<?php get_header(); ?>

    <style>main:before { background:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'original' ); ?>) no-repeat center center; }</style>
<main>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { ?>
        <article>
            <?php the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <p class="post-info">
                Posted: <date><?php the_date('F j, Y'); ?></date>
                Time to Read: <label><?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute"]'); ?></label>
            </p>
            <?php the_content(); ?>



        </article>
    <?php } ?>
<?php } ?>
</main>
<?php get_footer(); ?>