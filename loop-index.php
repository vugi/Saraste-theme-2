<?php $first = 1; ?>
<?php if ( have_posts() ) : ?>
	<article>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php if($first && is_sticky()) : ?>
			<img src="http://placehold.it/580x250" alt="">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
			<!-- Tässä pitäisi näyttää vain 2 ekaa kappaletta -->
			<?php the_content('Lue lisää &rarr;'); ?> 
		<?php else : ?>
			<div>
				<img src="http://placehold.it/280x120" alt="">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
				<p><?php the_excerpt(); ?></p>
			</div>
		<?php endif; ?>
		<?php if($first) : ?>
			<div id="recent">
		<?php endif; ?>
		<?php $first = 0; ?>
	<?php endwhile; ?>
		</div>
	</article>
<?php else: ?>
	
	<?php get_404_template(); ?>
 
 <?php endif; ?>