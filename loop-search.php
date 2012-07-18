<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_excerpt(); ?>
	<?php endwhile; ?>
	<?php if ($wp_query->max_num_pages > 1) : ?>
		<ul class="pager">
		  <li class="previous">
			<?php next_posts_link('&larr; Vanhemmat artikkelit'); ?>
		  </li>
		  <li class="next">
			<?php previous_posts_link('Uudemmat artikkelit &rarr;'); ?>
		  </li>
		</ul>
	<?php endif; ?>
<?php endif; ?>