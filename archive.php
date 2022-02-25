<?php get_header(); ?>

<?php $term = get_queried_object(); ?>
<style>
    :root {
        --theme: var(--<? echo get_field('theme_color', $term); ?>);
    }
</style>
<main>
    <section class="archives">
            <h1>
                <?php the_archive_title(); echo ( is_category() ) ? 's' : '';  ?>
        </h1>
        <?php if ( get_the_archive_description() ) { ?>
            <p><?php the_archive_description(); ?></p>
        <?php } ?>
<?php if ( have_posts() ) { ?>
	    <?php while ( have_posts() ) { ?>
        <article>
		    <?php the_post(); ?>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="post-info">
                Posted: <date><?php the_date('F j, Y'); ?></date>
                Time to Read: <label><?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute"]'); ?></label>
            </p>

        </article>
    <?php } ?>
<?php } ?>
    </section>
</main>
<?php get_footer(); ?>