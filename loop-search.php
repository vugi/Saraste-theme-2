<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php the_excerpt(); ?>
	<?php endwhile; ?>
	<?php if ($wp_query->max_num_pages > 1) : ?>
		<p class="post_nav">
			<?php next_posts_link('<i class="icon-arrow-left"></i> Vanhemmat artikkelit'); ?>
			<?php previous_posts_link('Uudemmat artikkelit <i class="icon-arrow-right"></i>'); ?>
		</p>
	<?php endif; ?>
<?php endif; ?>