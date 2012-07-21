<?php $odd = 1; ?>
<?php if ( have_posts() ) : ?>
	<div id="recent">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article<?php if($odd) echo ' class="odd"'; ?>>
				<a href="<?php the_permalink(); ?>">
					<?php
						if (has_post_thumbnail('article-small')) {
							the_post_thumbnail();
						} else {
							echo '<img src="' . get_bloginfo( 'template_directory') . '/img/default-thumb.jpg" alt="">';
						}
					?>
				</a>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
				<?php the_excerpt(); ?>
			</article>
			<?php $odd = ($odd ? 0 : 1); ?>
		<?php endwhile; ?>
	</div>
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