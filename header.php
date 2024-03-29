<!doctype HTML>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--responsive goodness-->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

    <?php if ( is_single('4092') ) { ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <?php } ?>
</head>

<body <?php body_class(); ?>>

<header>
    <?php if ( is_front_page() ) { ?>
        <h1 class="site-logo"><a href="/">Into the Book</a></h1>
    <?php } else if ( is_post_type_archive('blorps') ) { ?>
        <a href="/">&lsaquo; back to ItB</a>
        <h1 class="blorps-logo">Blorps</h1>
    <?php } else { ?>
        <div class="site-logo"><a href="/">Into the Book</a></div>
    <?php } ?>

    <?php if ( is_post_type_archive('blorps') ) { ?>
        <p>cool links, short thoughts, etc.</p>  
        <a href="https://intothebook.net/blorps/feed" title="Get it via RSS"><img src=https://intothebook.net/wp-content/uploads/2023/07/rss.svg" width="32" height="32" ></a> 
    <?php } else { ?>    
    <p><?php echo get_bloginfo('description'); ?></p>
    <?php } ?>
</header>
