 <?php if ( have_posts() ) : ?>
	<article>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php
			if (has_post_thumbnail('article-big')) {
				the_post_thumbnail();
			} 
		?>
		<h2><?php the_title(); ?></h2>
		<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
		<?php the_content(); ?>
		<?php comments_template(); ?>
	<?php endwhile; ?>
	</article>
	
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>