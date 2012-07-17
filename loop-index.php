<?php $first = 1; ?>
<?php if ( have_posts() ) : ?>
	<article>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php if($first && is_sticky()) : ?>
			<?php
				if (has_post_thumbnail('article-big')) {
					the_post_thumbnail();
				} 
			?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
			<?php the_content('Lue lisää &rarr;'); ?> 
		<?php else : ?>
			<div>
				<?php
					if (has_post_thumbnail('article-small')) {
						the_post_thumbnail();
					} else {
						echo '<img src="' . get_bloginfo( 'template_directory') . '/img/default-thumb.jpg" alt="">';
					}
				?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="meta"><?php the_time("j.n.Y"); ?> klo <?php the_time("h:i"); ?> <?php the_author(); ?></p>
				<?php the_excerpt(); ?>
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