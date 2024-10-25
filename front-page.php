<?php get_header(); ?>

<main>
<div class="introduction">
<h1 style="margin-bottom:1px; margin-top:1px; color:var(--quaternary); vertical-align:middle;"><img style="display:inline-block; border-radius:100px; position:relative; top:-8px; vertical-align:middle;" src="https://intothebook.net/wp-content/uploads/2024/10/andrew-2024.jpg" width="100" height="100" /> Hi, I'm Andrew.</h1>
<p>This is my garden on the web. It's perpetually being tended, sometimes frequently, sometimes sporadically. It is the thing I am most proud of on the web. I'm still trying to figure out the best way to organize everything (the best way ain't reverse-chronologically, but that's how it is for now).</p>
<p><a href="https://intothebook.net/product/currahee">I wrote a book</a> that I'd love for you to read. The first chapter <a href="https://intothebook.net/chapter-one-mountain/">is available for free</a> and I'd like to put the whole thing online, eventually. I'm married to my beautiful wife and we have two little Zs, with a third on the way.</p>
<p>I despise the current trajectory of the web (despite being a web developer my entire life), and any use of this site for LLM, SEO, or any other acronym is specifically forbidden. If you're a person, welcome! <a href="mailto:hello@intothebook.net">Email me</a> to say that you read and enjoyed something, or just to say hi. I'd love to hear from you.</p>
</div>

    <h2>Latest Posts</h2>
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

                            <li class="category <?php echo $slug; ?>"><a href="/category/<?php echo $slug; ?>"><?php echo $name; ?></a></li>

                        <style> .<?php echo $slug; ?> { --theme: var(--<?php the_field( 'theme_color', $cat ); ?>); } </style>
                <?php } ?>
            </ul>
        </div>

        <div class="organize links">
            <h2>Other Stuff</h2>
            <span class="quiet">(recommendations and other personal projects)</span>

            <ul class="tags">
                <li><a href="/blogroll">People worth Following</a></li>
                <li><a href="/cooltools">Cool Web Tools</a></li>
                <li><a>Colophon (coming soon)</a></li>
                <li><a href="/blorps">Blorps: Cool Links, Short Thoughts</a></li>
            </ul>
        </div>
<?php } ?>
</main>
<?php get_footer(); ?>