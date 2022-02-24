<?php /* Template Name: Super Imagey */ ?>
<?php get_header(); ?>

    <style>main:before { background:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>) no-repeat center center; }</style>
<main>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { ?>


        <article>
            <h1><?php the_title(); ?></h1>
            <?php the_post(); ?>
            <?php the_content(); ?>

        </article>
    <?php } ?>
<?php } ?>
</main>
<?php get_footer(); ?>