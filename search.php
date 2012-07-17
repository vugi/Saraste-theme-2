<?php get_header(); ?>

<article>
	<h2>Haku: <?php the_search_query(); ?></h2>
	<?php get_search_form(); ?>
	<?php get_template_part('loop', 'search'); ?>
</article>
<?php get_footer(); ?>