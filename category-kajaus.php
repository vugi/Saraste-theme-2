<?php get_header(); ?>
<div class="articles">
	<h2>Kajaus</h2>
	<p><?php echo category_description($cat->cat_ID); ?></p>
	<?php get_template_part('loop', 'archive'); ?>
</div>
<?php get_footer(); ?>