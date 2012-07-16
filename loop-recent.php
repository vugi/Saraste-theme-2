<?php if ( have_posts() ) : ?>
	<div id="recent">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div>
				<img src="http://placehold.it/280x120" alt="">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
				<p><?php the_excerpt(); ?></p>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>