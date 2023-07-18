<?php get_header(); ?>

    <main>
        <section class="archives">
            <?php if ( have_posts() ) { ?>
                <?php while ( have_posts() ) { ?>
                        <?php the_post(); ?>
                        <article class="blorp">
                                <h6><?php the_date(); ?></h6>
                                <h2><a href="<?php the_field('blorp_link'); ?>" rel="dofollow"><?php the_title(); ?></a></h2>
                                <?php the_content(); ?>
                        </article>
	            <?php } ?>
            <?php } ?>

        </section>
</main>

<?php get_footer(); ?>