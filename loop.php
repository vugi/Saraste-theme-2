 <?php if ( have_posts() ) : ?>
	<article>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<img src="http://placehold.it/580x250" alt="">
		<h2><?php the_title(); ?></h2>
		<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
		<?php the_content(); ?>
		<?php comments_template(); ?>
	<?php endwhile; ?>
	</article>
	
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>