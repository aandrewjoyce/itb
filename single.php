<?php get_header(); ?>

    <style>main:before { background:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'original' ); ?>) no-repeat center center; }</style>
<main>
<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) { ?>
        <article>
            <?php the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <p class="post-info">
                <span class="category">
	            <?php $cats = get_the_category();
		            if ( isset($cats[0]) ) { ?>
                        <a class="cat" href="/<?php echo $cats[0]->slug; ?>"><?php echo $cats[0]->name; ?></a>
		            <?php } ?>
                    <style> :root { --theme: var(--<?php the_field( 'theme_color', $cats[0] ); ?>); } </style>
                </span>

                <span class="tags">
                    <?php if ( get_the_tags() ) { ?>
	                    <?php echo 'Filed in: '; ?>
	                    <?php the_tags('<span class="tag">', '</span>, <span class="tag">', '</span>'); ?>
                    <?php } ?>
                </span>

                <span class="date">Posted: <time><?php the_date('F j, Y'); ?></time></span>

                <span class="wordcount"><?php echo do_shortcode('[wp-word-count]'); ?> words</span>

            </p>
            <?php the_content(); ?>

	        <?php // comments_template(); ?>
	        <?php /* Calling just comments_template() is also fine */ ?>


        </article>
    <?php } ?>
<?php } ?>
</main>
<?php get_footer(); ?>