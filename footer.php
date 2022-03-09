<footer>
    <div class="contact-card h-card" rel="me" href="https://intothebook.net/">
        <h4 class="card-title">Who the heck is <a class="h-card" rel="me" href="https://intothebook.net/">Andrew Joyce</a></h4>
    <img class="u-photo" src="https://intothebook.net/wp-content/uploads/2022/02/about2020.jpg" width="100" height="100" />
        <p class="p-note">That would be me. I used to run my own web business, Mosaic, but since 2019, I work for <a href="https://www.mereagency.com" rel="dofollow">Mere Agency</a>, and we make the best church websites you've ever seen. I'm a Christian, storyteller, incurable nerd, and I needed a place to put writing on the internet. This is that place: welcome!</p>

        <div class="webring">
            <a href="https://xn--sr8hvo.ws/%F0%9F%93%AF7%EF%B8%8F%E2%83%A3%F0%9F%9A%B3/previous">←</a> Proud member of the <strong>IndieWeb WebRing 🕸💍</strong> <a href="https://xn--sr8hvo.ws/%F0%9F%93%AF7%EF%B8%8F%E2%83%A3%F0%9F%9A%B3/next">→</a>
        </div>
    </div>

    <p><?php if (is_single()) { ?>This page was first published on <?php echo get_the_date('F jS, Y'); ?>, and it was last updated on <?php echo get_the_modified_time('F jS, Y'); ?>.<br/><?php } ?>
        🄯 <?php echo date('Y'); ?>
        <span title="All the same, please don't monetize any of this writing.">I wrote this, but nobody owns the web.</span>
        <span title="Credit to Li-Chen Wang">All wrongs reserved</span>.<br/>
        <span title="Credit to Cory Doctorow">Privacy policy</span>:
        we don't collect or retain any data at all.</p>

	<?php wp_footer(); ?>

</footer>

<?php if ( is_single('4092') ) { ?>
<script>
    const varhers = document.querySelectorAll('p.her');
    for (let i = 0; i < varhers.length; i++) {
        varhers[i].setAttribute("data-aos", "fade-right");
        varhers[i].setAttribute("data-aos-duration", "800");
        varhers[i].setAttribute("data-aos-delay", "100");
    }
    const varhis = document.querySelectorAll('p.me');
    for (let i = 0; i < varhis.length; i++) {
        varhis[i].setAttribute("data-aos", "fade-left");
        varhis[i].setAttribute("data-aos-duration", "800");
        varhis[i].setAttribute("data-aos-delay", "100");
    }
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<?php } ?>

</body>
</html>