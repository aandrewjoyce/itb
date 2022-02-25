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

<?php get_footer(); ?>