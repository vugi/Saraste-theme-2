<?php
get_header();

query_posts('showposts=11');
get_template_part('loop', 'index');
?>
<ul class="pager"><li><a href="<?php echo get_category_link(1); ?>">Siirry arkistoon</a></li></ul>
<?php get_footer(); ?>