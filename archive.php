<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<article>
		<?php if(is_category()) : ?><h2><?php single_cat_title(); ?></h2><?php endif; ?>
		<?php get_template_part('loop', 'archive'); ?>
	</article>
<?php else: ?>	
	<?php get_404_template(); ?>
<?php endif; ?>

<?php get_footer(); ?>